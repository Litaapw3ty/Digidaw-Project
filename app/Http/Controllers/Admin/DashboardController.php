<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asesor;
use App\Models\AuditLog;
use App\Models\Evaluasi;
use App\Models\Instansi;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah seluruh instansi yang terdaftar.
        $totalInstansi = Instansi::count();

        // Mengambil jumlah asesor yang statusnya masih aktif.
        $asesorAktif = Asesor::where('status', 'AKTIF')->count();

        // Mengambil rata-rata indeks dari evaluasi yang sudah memiliki nilai akhir.
        $rataRataIndeks = Evaluasi::whereNotNull('indeks_akhir')
            ->avg('indeks_akhir');

        // Mengambil instansi yang sudah memiliki evaluasi.
        $instansi = Instansi::query()
            // Hanya tampilkan instansi yang sudah ikut evaluasi.
            ->whereHas('evaluasi')
            ->with([
                // Ambil hanya satu evaluasi terbaru.
                'evaluasiTerbaru.asesor.user',

                // Ambil indikator untuk menghitung progress.
                'evaluasiTerbaru.evaluasiIndikator',
            ])
            ->get();

        // Menyiapkan data instansi agar mudah digunakan oleh Blade.
        $instansi = $instansi->map(function ($item, $index) {

            // Ambil evaluasi terbaru milik instansi.
            $evaluasi = $item->evaluasiTerbaru;

            // Kalau belum ada indikator, progress dianggap 0%.
            $progress = 0;

            if ($evaluasi && $evaluasi->evaluasiIndikator->count() > 0) {

                // Hitung indikator yang sudah melewati tahap pengisian.
                $indikatorTerisi = $evaluasi->evaluasiIndikator
                    ->whereIn('status_pengisian', [
                        'TERKIRIM',
                        'DIVERIFIKASI',
                        'PERLU_PERBAIKAN',
                    ])
                    ->count();

                // Hitung persentase progress.
                $progress = round(
                    ($indikatorTerisi / $evaluasi->evaluasiIndikator->count()) * 100
                );
            }

            return [
                'no' => $index + 1,
                'nama' => $item->nama_instansi,
                'kategori' => $item->kategori,
                'progress' => $progress,
                'status' => $evaluasi?->status,
                'asesor' => $evaluasi?->asesor?->user?->name ?? '-',
                'nilai' => $evaluasi?->indeks_akhir,
            ];
        });

        // Menghitung jumlah evaluasi berdasarkan statusnya.
        $totalEvaluasi = Evaluasi::count();

        $selesaiEvaluasi = Evaluasi::where('status', 'SELESAI')
            ->count();

        $sedangEvaluasi = Evaluasi::whereIn('status', [
            'PENGISIAN',
            'DALAM_PENILAIAN',
        ])->count();

        $menungguVerifikasi = Evaluasi::where(
            'status',
            'MENUNGGU_VERIFIKASI'
        )->count();

        $belumMengisi = Evaluasi::where('status', 'DRAFT')
            ->count();

        // Fungsi untuk menghitung persentase.
        $persentase = function ($jumlah) use ($totalEvaluasi) {
            return $totalEvaluasi > 0
                ? round(($jumlah / $totalEvaluasi) * 100, 1)
                : 0;
        };

        // Menyiapkan data progress untuk Dashboard.
        $progressEvaluasi = [
            'total' => $totalEvaluasi,

            'selesai' => [
                'jumlah' => $selesaiEvaluasi,
                'persentase' => $persentase($selesaiEvaluasi),
            ],

            'sedang' => [
                'jumlah' => $sedangEvaluasi,
                'persentase' => $persentase($sedangEvaluasi),
            ],

            'menunggu' => [
                'jumlah' => $menungguVerifikasi,
                'persentase' => $persentase($menungguVerifikasi),
            ],

            'belum' => [
                'jumlah' => $belumMengisi,
                'persentase' => $persentase($belumMengisi),
            ],
        ];
        // Mengambil aktivitas terbaru yang tercatat di audit log.
        $riwayatAktivitas = AuditLog::query()
            ->with('user')
            ->latest('id_log')
            ->take(5)
            ->get()
            ->map(function ($log) {
                return [
                    'judul' => $log->deskripsi,
                    'waktu' => $log->created_at
                        ? $log->created_at->format('d M Y H.i') . ' WIB'
                        : '-',
                ];
            });

        return view('admin.dashboard', [
            'title' => 'Digitama Dashboard',
            'pageTitle' => 'Home',
            'totalInstansi' => $totalInstansi,
            'asesorAktif' => $asesorAktif,
            'rataRataIndeks' => $rataRataIndeks,
            'instansi' => $instansi,
            'progressEvaluasi' => $progressEvaluasi,
            'riwayatAktivitas' => $riwayatAktivitas,
        ]);
    }
}