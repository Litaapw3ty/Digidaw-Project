<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenilaianMandiriController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | INSTANSI USER
        |--------------------------------------------------------------------------
        */

        $instansi = DB::table('instansi')
            ->where('id_instansi', $user->id_instansi)
            ->where('status', 'AKTIF')
            ->first();

        if (!$instansi) {
            abort(404, 'Instansi user belum ditemukan.');
        }

        /*
        |--------------------------------------------------------------------------
        | TAHUN / PERIODE
        |--------------------------------------------------------------------------
        */

        $tahun = now()->year;

        /*
        |--------------------------------------------------------------------------
        | EVALUASI
        |--------------------------------------------------------------------------
        |
        | Satu instansi memiliki satu evaluasi untuk satu tahun.
        |
        */

        $evaluasi = DB::table('evaluasi')
            ->where('id_instansi', $instansi->id_instansi)
            ->where('tahun', $tahun)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | BUAT EVALUASI JIKA BELUM ADA
        |--------------------------------------------------------------------------
        */

        if (!$evaluasi) {

            $idEvaluasi = DB::table('evaluasi')->insertGetId([
                'id_instansi' => $instansi->id_instansi,
                'id_asesor' => null,
                'tahun' => $tahun,
                'status' => 'DRAFT',
                'indeks_akhir' => 1.00,
                'predikat' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $evaluasi = DB::table('evaluasi')
                ->where('id_evaluasi', $idEvaluasi)
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | SEMUA INDIKATOR AKTIF
        |--------------------------------------------------------------------------
        */

        $indikatorList = DB::table('indikator_penilaian')
            ->where('status', 'AKTIF')
            ->orderBy('id_aspek')
            ->orderBy('nomor_indikator')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PASTIKAN SETIAP INDIKATOR MEMILIKI EVALUASI
        |--------------------------------------------------------------------------
        |
        | Nilai awal indikator = 1.00
        |
        | Catatan:
        | Nilai 1.00 ini untuk kebutuhan perhitungan baseline.
        | Tampilan di halaman tidak harus menampilkan angka 1.00.
        |
        */

        foreach ($indikatorList as $indikator) {

            $cekEvaluasiIndikator = DB::table('evaluasi_indikator')
                ->where('id_evaluasi', $evaluasi->id_evaluasi)
                ->where('id_indikator', $indikator->id_indikator)
                ->first();

            if (!$cekEvaluasiIndikator) {

                DB::table('evaluasi_indikator')->insert([
                    'id_evaluasi' => $evaluasi->id_evaluasi,
                    'id_indikator' => $indikator->id_indikator,
                    'status_pengisian' => 'BELUM_DIISI',

                    /*
                    |--------------------------------------------------------------------------
                    | BASELINE PERHITUNGAN
                    |--------------------------------------------------------------------------
                    |
                    | Nilai awal indikator = 1.00
                    |
                    */

                    'nilai' => 1.00,
                    'level_kematangan' => 1,
                    'catatan_asesor' => null,
                    'updated_at' => now(),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL EVALUASI INDIKATOR
        |--------------------------------------------------------------------------
        */

        $evaluasiIndikator = DB::table('evaluasi_indikator')
            ->where('id_evaluasi', $evaluasi->id_evaluasi)
            ->get()
            ->keyBy('id_indikator');

        /*
        |--------------------------------------------------------------------------
        | ASPEK PENILAIAN
        |--------------------------------------------------------------------------
        */

        $aspekList = DB::table('aspek_penilaian')
            ->where('status', 'AKTIF')
            ->orderBy('nomor_aspek')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | HITUNG NILAI ASPEK
        |--------------------------------------------------------------------------
        |
        | Setiap aspek memiliki baseline nilai 1.00.
        |
        | Jika indikator sudah memiliki nilai hasil penilaian,
        | nilai indikator tersebut digunakan.
        |
        | Nilai aspek dihitung berdasarkan bobot indikator
        | di dalam aspek tersebut.
        |
        */

        $aspekData = [];

        foreach ($aspekList as $aspek) {

            $indikatorAspek = $indikatorList
                ->where('id_aspek', $aspek->id_aspek);

            /*
            |--------------------------------------------------------------------------
            | TOTAL BOBOT INDIKATOR DALAM ASPEK
            |--------------------------------------------------------------------------
            */

            $totalBobotIndikator = $indikatorAspek->sum(
                fn ($indikator) => (float) $indikator->bobot
            );

            /*
            |--------------------------------------------------------------------------
            | NILAI ASPEK
            |--------------------------------------------------------------------------
            |
            | Default = 1.00
            |
            */

            $nilaiAspek = 1.00;

            if ($totalBobotIndikator > 0) {

                $totalNilaiTertimbang = 0;

                foreach ($indikatorAspek as $indikator) {

                    $evalIndikator = $evaluasiIndikator
                        ->get($indikator->id_indikator);

                    /*
                    |--------------------------------------------------------------------------
                    | NILAI BASELINE
                    |--------------------------------------------------------------------------
                    */

                    $nilaiIndikator = $evalIndikator
                        ? (float) ($evalIndikator->nilai ?? 1.00)
                        : 1.00;

                    $totalNilaiTertimbang +=
                        $nilaiIndikator *
                        (float) $indikator->bobot;
                }

                $nilaiAspek = $totalNilaiTertimbang
                    / $totalBobotIndikator;
            }

            /*
            |--------------------------------------------------------------------------
            | DATA INDIKATOR UNTUK TABEL
            |--------------------------------------------------------------------------
            */

            $items = [];

            foreach ($indikatorAspek as $indikator) {

                $evalIndikator = $evaluasiIndikator
                    ->get($indikator->id_indikator);

                /*
                |--------------------------------------------------------------------------
                | TOTAL DATA DUKUNG
                |--------------------------------------------------------------------------
                */

                $dataTotal = DB::table('data_dukung')
                    ->where('id_indikator', $indikator->id_indikator)
                    ->where('status', 'AKTIF')
                    ->count();

                /*
                |--------------------------------------------------------------------------
                | DATA DUKUNG TERISI
                |--------------------------------------------------------------------------
                |
                | PERLU_PERBAIKAN tetap dianggap sudah memiliki
                | pengisian/data karena dokumen sudah pernah dikirim.
                |
                */

                $dataTerisi = 0;

                if ($evalIndikator) {

                    $dataTerisi = DB::table(
                        'evaluasi_data_dukung as edd'
                    )
                        ->join(
                            'data_dukung as dd',
                            'dd.id_data_dukung',
                            '=',
                            'edd.id_data_dukung'
                        )
                        ->where(
                            'edd.id_evaluasi_indikator',
                            $evalIndikator->id_evaluasi_indikator
                        )
                        ->where(
                            'dd.status',
                            'AKTIF'
                        )
                        ->whereIn(
                            'edd.status',
                            [
                                'TERKIRIM',
                                'DIVERIFIKASI',
                                'PERLU_PERBAIKAN',
                            ]
                        )
                        ->count();
                }

                /*
                |--------------------------------------------------------------------------
                | PROGRESS
                |--------------------------------------------------------------------------
                */

                $progress = $dataTotal > 0
                    ? round(($dataTerisi / $dataTotal) * 100)
                    : 0;

                /*
                |--------------------------------------------------------------------------
                | NILAI INDIKATOR UNTUK PERHITUNGAN
                |--------------------------------------------------------------------------
                */

                $nilaiIndikator = $evalIndikator
                    ? (float) ($evalIndikator->nilai ?? 1.00)
                    : 1.00;

                /*
                |--------------------------------------------------------------------------
                | DATA UNTUK VIEW
                |--------------------------------------------------------------------------
                */

                $items[] = [
                    'id_indikator' => $indikator->id_indikator,
                    'no' => $indikator->nomor_indikator,
                    'nama' => $indikator->nama_indikator,
                    'tipe' => $indikator->sumber_indikator,
                    'bobot' => (float) $indikator->bobot,

                    /*
                    |--------------------------------------------------------------------------
                    | NILAI UNTUK PERHITUNGAN
                    |--------------------------------------------------------------------------
                    */

                    'nilai' => $nilaiIndikator,

                    /*
                    |--------------------------------------------------------------------------
                    | PROGRESS DATA DUKUNG
                    |--------------------------------------------------------------------------
                    */

                    'progress' => $progress,
                    'data_terisi' => $dataTerisi,
                    'data_total' => $dataTotal,
                    'pi' => ($indikator->sumber_indikator === 'EKSTERNAL' && $evalIndikator && $evalIndikator->status_pengisian !== 'BELUM_DIISI')
                        ? $nilaiIndikator
                        : 0.00,
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | SIMPAN DATA ASPEK
            |--------------------------------------------------------------------------
            */

            $aspekData[] = [
                'id_aspek' => $aspek->id_aspek,
                'no' => $aspek->nomor_aspek,
                'nama' => $aspek->nama_aspek,
                'bobot' => (float) $aspek->bobot,

                /*
                |--------------------------------------------------------------------------
                | NILAI UNTUK PERHITUNGAN
                |--------------------------------------------------------------------------
                */

                'nilai' => round($nilaiAspek, 2),

                'items' => $items,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | HITUNG INDEKS PM
        |--------------------------------------------------------------------------
        |
        | Indeks PM adalah agregasi nilai aspek berdasarkan bobot aspek.
        |
        | Contoh kondisi awal:
        |
        | Aspek 1 = 1.00 × 10% = 0.10
        | Aspek 2 = 1.00 × 10% = 0.10
        | Aspek 3 = 1.00 × 15% = 0.15
        | Aspek 4 = 1.00 × 15% = 0.15
        | Aspek 5 = 1.00 × 10% = 0.10
        | Aspek 6 = 1.00 × 15% = 0.15
        | Aspek 7 = 1.00 × 25% = 0.25
        |
        | Total = 1.00
        |
        */

        $totalBobotAspek = collect($aspekData)->sum(
            fn ($aspek) => (float) $aspek['bobot']
        );

        $totalNilaiAspekTertimbang = collect($aspekData)->sum(
            fn ($aspek) =>
                (float) $aspek['nilai'] *
                (float) $aspek['bobot']
        );

        /*
        |--------------------------------------------------------------------------
        | INDEKS PM
        |--------------------------------------------------------------------------
        */

        $indeksPM = $totalBobotAspek > 0
            ? $totalNilaiAspekTertimbang / $totalBobotAspek
            : 1.00;

        $indeksPM = round($indeksPM, 2);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN INDEKS KE EVALUASI
        |--------------------------------------------------------------------------
        */

        DB::table('evaluasi')
            ->where('id_evaluasi', $evaluasi->id_evaluasi)
            ->update([
                'indeks_akhir' => $indeksPM,
                'updated_at' => now(),
            ]);

        /*
        |--------------------------------------------------------------------------
        | PERIODE
        |--------------------------------------------------------------------------
        */

        $periode = $tahun;

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'user.penilaian',
            [
                'instansi' => $instansi,
                'evaluasi' => $evaluasi,
                'tahun' => $tahun,
                'periode' => $periode,
                'aspek' => $aspekData,

                /*
                |--------------------------------------------------------------------------
                | INDEKS PM TETAP 1.00 PADA KONDISI AWAL
                |--------------------------------------------------------------------------
                */

                'indeksPM' => $indeksPM,
            ]
        );
    }
}