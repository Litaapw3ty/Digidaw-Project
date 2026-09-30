<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // =========================================================
        // 1. DAPATKAN ID ASESOR
        // =========================================================
        $asesor = DB::table('asesor')
            ->where('id_user', $userId)
            ->first();

        $idAsesor = $asesor ? $asesor->id_asesor : null;


        // =========================================================
        // 2. STATISTIK
        // =========================================================
        $totalInstansi = DB::table('evaluasi')
            ->where('id_asesor', $idAsesor)
            ->distinct('id_instansi')
            ->count('id_instansi');

        $prosesVerifikasi = DB::table('evaluasi')
            ->where('id_asesor', $idAsesor)
            ->whereIn('status', [
                'MENUNGGU_VERIFIKASI',
                'DALAM_PENILAIAN'
            ])
            ->count();

        $evaluasiSelesai = DB::table('evaluasi')
            ->where('id_asesor', $idAsesor)
            ->where('status', 'SELESAI')
            ->count();


        // =========================================================
        // 3. QUERY TUGAS VERIFIKASI
        // =========================================================
        $query = DB::table('dokumen_bukti as db')
            ->join(
                'evaluasi_data_dukung as edd',
                'db.id_evaluasi_data_dukung',
                '=',
                'edd.id_evaluasi_data_dukung'
            )
            ->join(
                'evaluasi_indikator as ei',
                'edd.id_evaluasi_indikator',
                '=',
                'ei.id_evaluasi_indikator'
            )
            ->join(
                'evaluasi as e',
                'ei.id_evaluasi',
                '=',
                'e.id_evaluasi'
            )
            ->join(
                'instansi as i',
                'e.id_instansi',
                '=',
                'i.id_instansi'
            )
            ->join(
                'indikator_penilaian as ip',
                'ei.id_indikator',
                '=',
                'ip.id_indikator'
            )
            ->where('e.id_asesor', $idAsesor)
            ->select(
                'db.id_dokumen',
                'i.nama_instansi',
                'ip.kode_indikator',
                'ip.nama_indikator',
                'db.created_at',
                'ei.status_pengisian'
            );


        // =========================================================
        // 4. SEARCH
        // =========================================================
        if ($request->has('search')) {

            $search = trim($request->search);

            if ($search !== '') {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'i.nama_instansi',
                        'LIKE',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'ip.kode_indikator',
                        'LIKE',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'ip.nama_indikator',
                        'LIKE',
                        "%{$search}%"
                    );

                });
            }
        }


        // =========================================================
        // 5. FILTER STATUS
        // =========================================================
        if ($request->filled('status')) {

            if ($request->status == 'SELESAI') {

                $query->where(
                    'ei.status_pengisian',
                    'DIVERIFIKASI'
                );

            } elseif ($request->status == 'MENUNGGU') {

                $query->where(
                    'ei.status_pengisian',
                    '!=',
                    'DIVERIFIKASI'
                );
            }
        }


        // =========================================================
        // 6. FILTER TANGGAL
        // =========================================================
        if ($request->filled('tanggal')) {

            $query->whereDate(
                'db.created_at',
                $request->tanggal
            );
        }


        // =========================================================
        // 7. SORTING
        // =========================================================
        $sortColumn = $request->get(
            'sort',
            'created_at'
        );

        $sortDirection = $request->get(
            'direction',
            'desc'
        );

        $allowedSorts = [

            'instansi' => 'i.nama_instansi',

            'indikator' => 'ip.kode_indikator',

            'created_at' => 'db.created_at',

            'status' => 'ei.status_pengisian',

        ];


        // =========================================================
        // PRIORITAS HASIL SEARCH
        // =========================================================
        if ($request->filled('search')) {

            $search = trim($request->search);

            if ($search !== '') {

                $query->orderByRaw(
                    "CASE
                        WHEN i.nama_instansi LIKE ? THEN 1
                        WHEN ip.kode_indikator LIKE ? THEN 2
                        WHEN ip.nama_indikator LIKE ? THEN 3
                        ELSE 4
                    END",
                    [
                        $search . '%',
                        $search . '%',
                        $search . '%'
                    ]
                );
            }
        }


        // =========================================================
        // SORTING NORMAL
        // =========================================================
        if (array_key_exists(
            $sortColumn,
            $allowedSorts
        )) {

            $query->orderBy(
                $allowedSorts[$sortColumn],
                $sortDirection
            );

        } else {

            $query->orderBy(
                'db.created_at',
                'desc'
            );
        }


        // =========================================================
        // 8. PAGINATION
        // =========================================================
        $tugasVerifikasi = $query
            ->paginate(5)
            ->withQueryString();


        // =========================================================
        // 9. AKTIVITAS TERBARU
        // =========================================================
        $aktivitasTerbaru = DB::table('audit_log')
            ->where('id_user', $userId)
            ->orderBy(
                'created_at',
                'desc'
            )
            ->take(4)
            ->get();


        // =========================================================
        // 10. JIKA REQUEST AJAX
        // KIRIM HANYA BAGIAN TABEL
        // =========================================================
        if ($request->ajax()) {

            return view(
                'asesor.partials.tugas-verifikasi',
                compact('tugasVerifikasi')
            );
        }


        // =========================================================
        // 11. VIEW DASHBOARD
        // =========================================================
        return view(
            'asesor.dashboard',
            compact(
                'totalInstansi',
                'prosesVerifikasi',
                'evaluasiSelesai',
                'tugasVerifikasi',
                'aktivitasTerbaru'
            )
        );
    }
}