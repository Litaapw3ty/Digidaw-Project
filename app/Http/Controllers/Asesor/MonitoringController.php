<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function index()
    {
        $monitoringList = DB::table('instansi')
            ->leftJoin(
                'evaluasi',
                'instansi.id_instansi',
                '=',
                'evaluasi.id_instansi'
            )
            ->select(
                'instansi.id_instansi',
                'instansi.nama_instansi',
                'evaluasi.indeks_akhir'
            )
            ->orderBy('instansi.nama_instansi')
            ->get();

        $totalInstansi = $monitoringList->count();

        $sudahDinilai = $monitoringList
            ->whereNotNull('indeks_akhir')
            ->count();

        $belumDinilai = $totalInstansi - $sudahDinilai;

        return view('asesor.monitoring', compact(
            'monitoringList',
            'totalInstansi',
            'sudahDinilai',
            'belumDinilai'
        ));
    }

    public function detail($id_instansi)
    {
        // Ambil data instansi dan evaluasi
        $instansi = DB::table('instansi')
            ->leftJoin(
                'evaluasi',
                'instansi.id_instansi',
                '=',
                'evaluasi.id_instansi'
            )
            ->where('instansi.id_instansi', $id_instansi)
            ->select(
                'instansi.*',
                'evaluasi.id_evaluasi',
                'evaluasi.tahun',
                'evaluasi.indeks_akhir'
            )
            ->first();

        if (!$instansi) {
            abort(404, 'Data instansi tidak ditemukan');
        }

        // Ambil data indikator
        $indikatorData = collect();

        if ($instansi->id_evaluasi) {
            $indikatorData = DB::table('evaluasi_indikator')
                ->join(
                    'indikator_penilaian',
                    'evaluasi_indikator.id_indikator',
                    '=',
                    'indikator_penilaian.id_indikator'
                )
                ->where(
                    'evaluasi_indikator.id_evaluasi',
                    $instansi->id_evaluasi
                )
                ->select(
                    'evaluasi_indikator.*',
                    'indikator_penilaian.nomor_indikator',
                    'indikator_penilaian.nama_indikator',
                    'indikator_penilaian.id_aspek'
                )
                ->orderBy('indikator_penilaian.nomor_indikator')
                ->get();
        }

        // Total seluruh indikator
        $jumlahIndikator = DB::table('indikator_penilaian')
            ->where('status', 'AKTIF')
            ->count();

        // Jumlah indikator yang sudah mempunyai nilai
        $jumlahTerisi = $indikatorData
            ->whereNotNull('nilai')
            ->count();

        // Hitung progres keseluruhan
        $progres = $jumlahIndikator > 0
            ? round(($jumlahTerisi / $jumlahIndikator) * 100)
            : 0;

        // Ambil data aspek
        $aspekData = DB::table('aspek_penilaian')
            ->leftJoin(
                'indikator_penilaian',
                'aspek_penilaian.id_aspek',
                '=',
                'indikator_penilaian.id_aspek'
            )
            ->where('indikator_penilaian.status', 'AKTIF')
            ->select(
                'aspek_penilaian.id_aspek',
                'aspek_penilaian.nama_aspek',
                DB::raw('COUNT(indikator_penilaian.id_indikator) as total')
            )
            ->groupBy(
                'aspek_penilaian.id_aspek',
                'aspek_penilaian.nama_aspek'
            )
            ->orderBy('aspek_penilaian.id_aspek')
            ->get();

        // Hitung progres masing-masing aspek
        $aspek = $aspekData->map(function ($item) use ($indikatorData) {

            $indikatorAspek = $indikatorData->where(
                'id_aspek',
                $item->id_aspek
            );

            $terisi = $indikatorAspek
                ->whereNotNull('nilai')
                ->count();

            $total = (int) $item->total;

            return [
                'id_aspek' => $item->id_aspek,
                'nama' => $item->nama_aspek,
                'total' => $total,
                'terisi' => $terisi,
                'progres' => $total > 0
                    ? round(($terisi / $total) * 100)
                    : 0,
            ];
        });

        // Format data indikator untuk Blade
        $indikator = $indikatorData->map(function ($item) {

            return [
                'no' => $item->nomor_indikator,
                'nama' => $item->nama_indikator,
                'aspek' => $item->id_aspek,
                'status' => $item->status_pengisian,
                'nilai' => $item->nilai,
                'tingkat' => $item->level_kematangan,
            ];
        });

        // Data tambahan untuk halaman detail
        $instansi->jumlah_indikator = $jumlahIndikator;
        $instansi->jumlah_terisi = $jumlahTerisi;
        $instansi->progres = $progres;
        $instansi->indeks_pm = $instansi->indeks_akhir;

        return view('asesor.detail_monitoring', compact(
            'instansi',
            'aspek',
            'indikator'
        ));
    }
}