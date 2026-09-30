<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VerifikasiController extends Controller
{
    public function verifikasiBukti(Request $request)
    {
        $userId = Auth::id();

        // 1. Ambil id_asesor milik user yang sedang login
        $asesor = DB::table('asesor')
            ->where('id_user', $userId)
            ->first();

        $idAsesor = $asesor ? $asesor->id_asesor : 1;

        // 2. Query data instansi
        $query = DB::table('instansi as i')
            ->join('evaluasi as e', 'e.id_instansi', '=', 'i.id_instansi')
            ->leftJoin('users as u', 'u.id_user', '=', 'e.id_asesor')
            ->where('e.id_asesor', $idAsesor)
            ->select(
                'i.id_instansi',
                'i.kode_instansi',
                'i.nama_instansi',
                'i.status',
                'u.name as pic_name',
                'u.email as pic_email'
            )
            ->distinct();

        // Filter Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('i.nama_instansi', 'like', "%{$search}%")
                    ->orWhere('i.kode_instansi', 'like', "%{$search}%");
            });
        }

        $instansiList = $query->paginate(10);

        if ($request->ajax()) {
            return view(
                'asesor.partials.verifikasi-table',
                compact('instansiList')
            )->render();
        }

        return view(
            'asesor.verifikasi',
            compact('instansiList')
        );
    }


    /**
     * Menampilkan daftar Aspek & Indikator Penilaian Mandiri
     * milik Instansi tertentu.
     */
    public function detailPenilaian($idInstansi)
    {
        // 1. Ambil detail instansi
        $instansi = DB::table('instansi')
            ->where('id_instansi', $idInstansi)
            ->first();

        if (!$instansi) {
            abort(404, 'Instansi tidak ditemukan');
        }

        // 2. Ambil evaluasi terbaru
        $evaluasi = DB::table('evaluasi')
            ->where('id_instansi', $idInstansi)
            ->orderBy('tahun', 'desc')
            ->first();

        // 3. Hitung Indeks PM
        $indeks_pm = ($evaluasi && $evaluasi->indeks_akhir !== null)
            ? number_format($evaluasi->indeks_akhir, 2, ',', '.')
            : '0,00';

        // 4. Total ringkasan
        $totalIndikator = DB::table('indikator_penilaian')
            ->where('status', 'AKTIF')
            ->count();

        $totalTingkat = DB::table('tingkat_kematangan')
            ->count();

        $totalDataDukung = DB::table('data_dukung')
            ->where('status', 'AKTIF')
            ->count();

        $totalPanduan = DB::table('panduan')
            ->where('status', 'AKTIF')
            ->count();

        // 5. Ambil semua aspek aktif
        $aspekData = DB::table('aspek_penilaian')
            ->where('status', 'AKTIF')
            ->orderBy('nomor_aspek')
            ->get();

        // 6. Bentuk struktur sesuai kebutuhan indikator.blade.php
        $aspek = [];

        foreach ($aspekData as $asp) {

            $indikators = DB::table('indikator_penilaian')
                ->where('id_aspek', $asp->id_aspek)
                ->where('status', 'AKTIF')
                ->orderBy('nomor_indikator')
                ->get();

            $items = [];

            foreach ($indikators as $ind) {

                // Ambil total data dukung
                $totalData = DB::table('data_dukung')
                    ->where('id_indikator', $ind->id_indikator)
                    ->where('status', 'AKTIF')
                    ->count();

                // Ambil data dukung yang sudah diisi pada evaluasi
                $totalTerisi = 0;

                if ($evaluasi) {

                    $evalIndikator = DB::table('evaluasi_indikator')
                        ->where('id_evaluasi', $evaluasi->id_evaluasi)
                        ->where('id_indikator', $ind->id_indikator)
                        ->first();

                    if ($evalIndikator) {

                        $totalTerisi = DB::table('evaluasi_data_dukung')
                            ->where(
                                'id_evaluasi_indikator',
                                $evalIndikator->id_evaluasi_indikator
                            )
                            ->whereIn('status', [
                                'TERKIRIM',
                                'DIVERIFIKASI'
                            ])
                            ->count();
                    }
                }

                // Hitung progress
                $progress = $totalData > 0
                    ? round(($totalTerisi / $totalData) * 100)
                    : 0;

                $items[] = [
                    'no'       => $ind->nomor_indikator,
                    'nama'     => $ind->nama_indikator,
                    'tipe'     => $ind->sumber_indikator,
                    'bobot'    => $ind->bobot ?? 0,
                    'progress' => $progress,
                    'data'     => $totalTerisi . ' / ' . $totalData,
                    'pi'       => null,
                ];
            }

            // Progress aspek
            $totalItemAspek = count($items);
            $totalProgress = 0;

            foreach ($items as $item) {
                $totalProgress += $item['progress'];
            }

            $progresAspek = $totalItemAspek > 0
                ? round($totalProgress / $totalItemAspek) . '%'
                : '0%';

            $aspek[] = [
                'no'      => $asp->nomor_aspek,
                'nama'    => $asp->nama_aspek,
                'bobot'   => $asp->bobot ?? 0,
                'progres' => $progresAspek,
                'items'   => $items,
            ];
        }

        return view(
            'asesor.indikator',
            compact(
                'instansi',
                'aspek',
                'indeks_pm',
                'totalIndikator',
                'totalTingkat',
                'totalDataDukung',
                'totalPanduan'
            )
        );
    }


    /**
     * Detail Indikator Penilaian Mandiri untuk Verifikasi Asesor
     */
    public function showIndikator($idInstansi, $noIndikator)
    {
        // 1. Detail Instansi
        $instansi = DB::table('instansi')
            ->where('id_instansi', $idInstansi)
            ->first();

        if (!$instansi) {
            abort(404, 'Instansi tidak ditemukan');
        }

        // 2. Evaluasi Instansi
        $evaluasi = DB::table('evaluasi')
            ->where('id_instansi', $idInstansi)
            ->orderBy('tahun', 'desc')
            ->first();

        if (!$evaluasi) {
            abort(404, 'Evaluasi instansi tidak ditemukan');
        }

        // 3. Detail Indikator & Aspek
        $indikator = DB::table('indikator_penilaian as ip')
            ->join(
                'aspek_penilaian as ap',
                'ap.id_aspek',
                '=',
                'ip.id_aspek'
            )
            ->where('ip.nomor_indikator', $noIndikator)
            ->select(
                'ip.*',
                'ap.nama_aspek',
                'ap.nomor_aspek',
                'ap.deskripsi as deskripsi_aspek'
            )
            ->first();

        if (!$indikator) {
            abort(404, 'Indikator tidak ditemukan');
        }

        // 4. Tingkat Kematangan Master (5 Level)
        $tingkatKematangan = DB::table('tingkat_kematangan')
            ->orderBy('level')
            ->get();

        $levelLabels = [
            1 => 'Initiate / Kurang',
            2 => 'Emerging / Cukup',
            3 => 'Developing / Baik',
            4 => 'Advancing / Sangat Baik',
            5 => 'Digital Leading / Unggul',
        ];

        // 5. Ambil hasil Penilaian Mandiri User
        //
        // Nilai User TIDAK dihitung ulang di halaman Asesor.
        // Kita mengambil hasil yang sudah tersimpan di evaluasi_indikator.
        $evalIndikator = DB::table('evaluasi_indikator')
            ->where('id_evaluasi', $evaluasi->id_evaluasi)
            ->where('id_indikator', $indikator->id_indikator)
            ->first();

        $nilaiUser = $evalIndikator->nilai ?? 0;
        $levelUser = $evalIndikator->level_kematangan ?? 0;

        // 6. Ambil panduan indikator
        $panduanFiles = DB::table('panduan')
            ->where('id_indikator', $indikator->id_indikator)
            ->where('status', 'AKTIF')
            ->get();

        $hasPanduan = $panduanFiles->contains('jenis', 'panduan');
        $hasTemplate = $panduanFiles->contains('jenis', 'template');

        // 7. Kelompokkan Data Dukung berdasarkan Tingkat Kematangan
        $dataDukungGroup = [];

        foreach ($tingkatKematangan as $tk) {

            $listDataDukung = DB::table('data_dukung as dd')
                ->where('dd.id_indikator', $indikator->id_indikator)
                ->where('dd.id_tingkat', $tk->id_tingkat)
                ->where('dd.status', 'AKTIF')
                ->orderBy('dd.nomor')
                ->get();

            $items = [];

            $totalBobotTerisi = 0;
            $totalBobotTingkat = 0;

            foreach ($listDataDukung as $dd) {

                $bobot = floatval($dd->bobot);

                $totalBobotTingkat += $bobot;

                // Ambil data dukung milik evaluasi User
                $evalDd = $evalIndikator
                    ? DB::table('evaluasi_data_dukung')
                        ->where(
                            'id_evaluasi_indikator',
                            $evalIndikator->id_evaluasi_indikator
                        )
                        ->where(
                            'id_data_dukung',
                            $dd->id_data_dukung
                        )
                        ->first()
                    : null;

                // Ambil dokumen bukti
                $dokumen = $evalDd
                    ? DB::table('dokumen_bukti as db')
                        ->leftJoin(
                            'verifikasi_bukti as vb',
                            'vb.id_dokumen',
                            '=',
                            'db.id_dokumen'
                        )
                        ->leftJoin(
                            'asesor as a',
                            'a.id_asesor',
                            '=',
                            'vb.id_asesor'
                        )
                        ->leftJoin(
                            'users as u',
                            'u.id_user',
                            '=',
                            'a.id_user'
                        )
                        ->where(
                            'db.id_evaluasi_data_dukung',
                            $evalDd->id_evaluasi_data_dukung
                        )
                        ->where('db.status', 'AKTIF')
                        ->select(
                            'db.*',
                            'vb.keputusan',
                            'vb.catatan',
                            'vb.verified_at',
                            'u.name as nama_asesor'
                        )
                        ->first()
                    : null;

                $statusText = $evalDd
                    ? $evalDd->status
                    : 'BELUM_DIISI';

                // Hitung progress data dukung
                if (in_array($statusText, [
                    'TERKIRIM',
                    'DIVERIFIKASI'
                ])) {
                    $totalBobotTerisi += $bobot;
                }

                $items[] = [
                    'id_data_dukung' => $dd->id_data_dukung,
                    'nomor'          => $dd->nomor,
                    'nama'           => $dd->nama_data_dukung,
                    'bobot'          => $bobot,
                    'status'         => $statusText,

                    // Status hasil verifikasi asesor
                    'is_verified'    => $dokumen &&
                        $dokumen->keputusan === 'DISETUJUI',

                    'dokumen'        => $dokumen,

                    'has_panduan'    => $hasPanduan,
                    'has_template'   => $hasTemplate,
                ];
            }

            $terisiCount = count(
                array_filter(
                    $items,
                    fn ($i) => in_array(
                        $i['status'],
                        ['TERKIRIM', 'DIVERIFIKASI']
                    )
                )
            );

            $itemCount = count($items);

            $dataDukungGroup[$tk->level] = [
                'level'        => $tk->level,
                'label'        => $levelLabels[$tk->level]
                    ?? $tk->nama_level,
                'total_terisi' => $terisiCount,
                'total_item'   => $itemCount,

                'pm_score'     =>
                    number_format($totalBobotTerisi, 1)
                    . ' / '
                    . number_format($totalBobotTingkat, 1),

                'items'        => $items,
            ];
        }

        // 8. Kirim data ke halaman Blade Asesor
        return view(
            'asesor.verifikasi_indikator',
            compact(
                'instansi',
                'indikator',
                'dataDukungGroup',
                'tingkatKematangan',
                'nilaiUser',
                'levelUser'
            )
        );
    }


    /**
     * Proses Verifikasi Bukti oleh Asesor
     */
    public function verify(
        Request $request,
        $idInstansi,
        $noIndikator,
        $idDataDukung
    ) {
        $request->validate([
            'status_verifikasi' => [
                'required',
                'in:Disetujui,Perlu Perbaikan'
            ],
            'catatan' => [
                'nullable',
                'string'
            ],
        ]);

        // 1. Ambil asesor yang sedang login
        $asesor = DB::table('asesor')
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // 2. Ambil evaluasi instansi
        $evaluasi = DB::table('evaluasi')
            ->where('id_instansi', $idInstansi)
            ->orderByDesc('tahun')
            ->firstOrFail();

        // 3. Ambil indikator
        $indikator = DB::table('indikator_penilaian')
            ->where('nomor_indikator', $noIndikator)
            ->firstOrFail();

        // 4. Ambil evaluasi indikator
        $evalIndikator = DB::table('evaluasi_indikator')
            ->where(
                'id_evaluasi',
                $evaluasi->id_evaluasi
            )
            ->where(
                'id_indikator',
                $indikator->id_indikator
            )
            ->firstOrFail();

        // 5. Ambil data dukung evaluasi
        $evalDataDukung = DB::table('evaluasi_data_dukung')
            ->where(
                'id_evaluasi_indikator',
                $evalIndikator->id_evaluasi_indikator
            )
            ->where(
                'id_data_dukung',
                $idDataDukung
            )
            ->firstOrFail();

        // 6. Ambil dokumen bukti
        $dokumen = DB::table('dokumen_bukti')
            ->where(
                'id_evaluasi_data_dukung',
                $evalDataDukung->id_evaluasi_data_dukung
            )
            ->where('status', 'AKTIF')
            ->firstOrFail();

        // 7. Tentukan keputusan
        $keputusan = $request->status_verifikasi === 'Disetujui'
            ? 'DISETUJUI'
            : 'PERLU_PERBAIKAN';

        // 8. Simpan verifikasi
        DB::transaction(function () use (
            $evalDataDukung,
            $dokumen,
            $asesor,
            $keputusan,
            $request
        ) {

            // Update status data dukung
            DB::table('evaluasi_data_dukung')
                ->where(
                    'id_evaluasi_data_dukung',
                    $evalDataDukung->id_evaluasi_data_dukung
                )
                ->update([
                    'status' => $keputusan === 'DISETUJUI'
                        ? 'DIVERIFIKASI'
                        : 'PERLU_PERBAIKAN'
                ]);

            // Simpan / update verifikasi bukti
            DB::table('verifikasi_bukti')->updateOrInsert(
                [
                    'id_dokumen' => $dokumen->id_dokumen
                ],
                [
                    'id_asesor' => $asesor->id_asesor,
                    'keputusan' => $keputusan,
                    'catatan' => $request->catatan,
                    'verified_at' => now(),
                ]
            );
        });

        return redirect()->route(
            'asesor.verifikasi.indikator',
            [
                'id_instansi' => $idInstansi,
                'no_indikator' => $noIndikator,
            ]
        );
    }

    public function showVerificationDetail($idInstansi, $noIndikator, $idDataDukung)
{
    // =====================================================
    // 1. INSTANSI
    // =====================================================
    $instansi = DB::table('instansi')
        ->where('id_instansi', $idInstansi)
        ->first();

    if (!$instansi) {
        abort(404, 'Instansi tidak ditemukan.');
    }


    // =====================================================
    // 2. EVALUASI
    // =====================================================
    $evaluasi = DB::table('evaluasi')
        ->where('id_instansi', $idInstansi)
        ->orderByDesc('id_evaluasi')
        ->first();

    if (!$evaluasi) {
        abort(404, 'Evaluasi tidak ditemukan.');
    }


    // =====================================================
    // 3. INDIKATOR
    // =====================================================
    $indikator = DB::table('indikator_penilaian')
        ->where('nomor_indikator', $noIndikator)
        ->first();

    if (!$indikator) {
        abort(404, 'Indikator tidak ditemukan.');
    }


    // =====================================================
    // 4. EVALUASI INDIKATOR
    // =====================================================
    $evaluasiIndikator = DB::table('evaluasi_indikator')
        ->where('id_evaluasi', $evaluasi->id_evaluasi)
        ->where('id_indikator', $indikator->id_indikator)
        ->first();

    if (!$evaluasiIndikator) {
        abort(404, 'Data evaluasi indikator tidak ditemukan.');
    }


    // =====================================================
    // 5. DATA DUKUNG
    // =====================================================
    $dataDukung = DB::table('data_dukung')
        ->where('id_data_dukung', $idDataDukung)
        ->first();

    if (!$dataDukung) {
        abort(404, 'Data dukung tidak ditemukan.');
    }


    // =====================================================
    // 6. EVALUASI DATA DUKUNG
    // =====================================================
    $evaluasiDataDukung = DB::table('evaluasi_data_dukung')
        ->where('id_evaluasi_indikator', $evaluasiIndikator->id_evaluasi_indikator)
        ->where('id_data_dukung', $idDataDukung)
        ->first();

    if (!$evaluasiDataDukung) {
        abort(404, 'Evaluasi data dukung tidak ditemukan.');
    }


    // =====================================================
    // 7. DOKUMEN BUKTI AKTIF
    // =====================================================
    $dokumen = DB::table('dokumen_bukti')
        ->where(
            'id_evaluasi_data_dukung',
            $evaluasiDataDukung->id_evaluasi_data_dukung
        )
        ->where('status', 'AKTIF')
        ->orderByDesc('id_dokumen')
        ->first();


    // =====================================================
    // 7.1 CEK FILE FISIK + URL FILE
    // =====================================================
    if ($dokumen) {

        $dokumen->file_exists = Storage::disk('public')
            ->exists($dokumen->file_path);

        $dokumen->file_url = Storage::disk('public')
            ->url($dokumen->file_path);
    }

    // =====================================================
    // 8. DATA VERIFIKASI
    // =====================================================
    $verifikasi = null;

    if ($dokumen) {

        $verifikasi = DB::table('verifikasi_bukti as vb')
            ->leftJoin(
                'asesor as a',
                'vb.id_asesor',
                '=',
                'a.id_asesor'
            )
            ->leftJoin(
                'users as u',
                'a.id_user',
                '=',
                'u.id_user'
            )
            ->where('vb.id_dokumen', $dokumen->id_dokumen)
            ->select(
                'vb.*',
                'u.name as nama_asesor'
            )
            ->orderByDesc('vb.id_verifikasi')
            ->first();
    }


    // =====================================================
    // 9. STATUS VERIFIKASI UNTUK BLADE
    // =====================================================
    $indikator->status_verifikasi = $verifikasi->keputusan ?? null;


    // =====================================================
    // 10. ID UNTUK BLADE
    // =====================================================
    return view('asesor.verifikasi_detail', compact(
        'instansi',
        'evaluasi',
        'indikator',
        'evaluasiIndikator',
        'dataDukung',
        'evaluasiDataDukung',
        'dokumen',
        'verifikasi'
    ))->with([
        'id_instansi' => $idInstansi,
        'no_indikator' => $noIndikator,
        'id_data_dukung' => $idDataDukung,
    ]);
}
}