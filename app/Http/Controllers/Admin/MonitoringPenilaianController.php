<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MonitoringPenilaian;
use Illuminate\Http\Request;

class MonitoringPenilaianController extends Controller
{
    /**
     * Menampilkan monitoring progress dan hasil evaluasi instansi.
     */
    public function index(Request $request)
    {
        // View monitoring menjadi sumber utama data tabel.
        // Kita join ke instansi + wilayah agar nama provinsi tersedia.
        $query = MonitoringPenilaian::query()
            ->from('vw_ringkasan_instansi as m')
            ->leftJoin('instansi as i', 'i.id_instansi', '=', 'm.id_instansi')
            ->leftJoin('wilayah as w', 'w.id_wilayah', '=', 'i.id_wilayah')
            ->select(
                'm.*',
                'w.nama_wilayah as provinsi'
            );

        // =========================================================
        // FILTER KABUPATEN / KOTA
        // =========================================================
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('m.nama_instansi', 'like', "%{$search}%")
                    ->orWhere('m.kode_instansi', 'like', "%{$search}%");
            });
        }

        // =========================================================
        // FILTER PROVINSI
        // =========================================================
        if ($request->filled('provinsi')) {
            $query->where('w.id_wilayah', $request->provinsi);
        }

        // =========================================================
        // FILTER TAHUN
        // =========================================================
        if ($request->filled('tahun')) {
            $query->where('m.tahun', $request->tahun);
        }

        // =========================================================
        // SORTING
        // =========================================================

        // Hanya kolom ini yang boleh digunakan untuk sorting.
        // Ini supaya parameter URL tidak bisa sembarang menjadi nama kolom SQL.
        $allowedSorts = [
            'nama_instansi' => 'm.nama_instansi',
            'provinsi' => 'w.nama_wilayah',
            'progress' => 'm.progress_persen',
            'nilai' => 'm.indeks_akhir',
        ];

        $sort = $request->get('sort', 'nama_instansi');
        $direction = $request->get('direction', 'asc');

        if (! array_key_exists($sort, $allowedSorts)) {
            $sort = 'nama_instansi';
        }

        if (! in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'asc';
        }

        $query->orderBy($allowedSorts[$sort], $direction);


        // =========================================================
        // DATA CARD
        // =========================================================

        $summaryQuery = clone $query;

        $totalInstansi = (clone $summaryQuery)->count();

        $selesai = (clone $summaryQuery)
            ->where('m.status_evaluasi', 'SELESAI')
            ->count();

        $sedangBerjalan = (clone $summaryQuery)
            ->whereIn('m.status_evaluasi', [
                'PENGISIAN',
                'MENUNGGU_VERIFIKASI',
                'DALAM_PENILAIAN',
            ])
            ->count();

        $belumMulai = (clone $summaryQuery)
            ->whereNull('m.id_evaluasi')
            ->count();

        $rataRataNilai = (clone $summaryQuery)
            ->whereNotNull('m.indeks_akhir')
            ->avg('m.indeks_akhir');


        // =========================================================
        // DATA TABEL
        // =========================================================

        $monitoring = $query
            ->paginate(10)
            ->withQueryString();


        // =========================================================
        // DATA DROPDOWN PROVINSI
        // =========================================================

        $provinsi = \App\Models\Wilayah::query()
            ->orderBy('nama_wilayah')
            ->get();


        // =========================================================
        // DATA TAHUN
        // =========================================================

        $tahun = MonitoringPenilaian::query()
            ->select('tahun')
            ->whereNotNull('tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');


        return view('admin.monitoring-penilaian.index', [
            'monitoring' => $monitoring,

            'totalInstansi' => $totalInstansi,
            'selesai' => $selesai,
            'sedangBerjalan' => $sedangBerjalan,
            'belumMulai' => $belumMulai,
            'rataRataNilai' => $rataRataNilai,

            'provinsi' => $provinsi,
            'tahun' => $tahun,
        ]);
    }
}