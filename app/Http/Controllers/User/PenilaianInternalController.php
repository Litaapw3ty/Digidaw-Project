<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenilaianInternalController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | INSTANSI
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
        | EVALUASI
        |--------------------------------------------------------------------------
        */

        $tahun = now()->year;

        $evaluasi = DB::table('evaluasi')
            ->where('id_instansi', $instansi->id_instansi)
            ->where('tahun', $tahun)
            ->first();

        if (!$evaluasi) {
            abort(404, 'Evaluasi tahun berjalan belum tersedia.');
        }

        /*
        |--------------------------------------------------------------------------
        | INDIKATOR
        |--------------------------------------------------------------------------
        */

        $indikator = DB::table('indikator_penilaian')
            ->where('id_indikator', $id)
            ->where('status', 'AKTIF')
            ->where('sumber_indikator', 'INTERNAL')
            ->first();

        if (!$indikator) {
            abort(404, 'Indikator internal tidak ditemukan.');
        }

        /*
        |--------------------------------------------------------------------------
        | ASPEK
        |--------------------------------------------------------------------------
        */

        $aspek = DB::table('aspek_penilaian')
            ->where('id_aspek', $indikator->id_aspek)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | EVALUASI INDIKATOR
        |--------------------------------------------------------------------------
        */

        $evaluasiIndikator = DB::table('evaluasi_indikator')
            ->where('id_evaluasi', $evaluasi->id_evaluasi)
            ->where('id_indikator', $indikator->id_indikator)
            ->first();

        if (!$evaluasiIndikator) {
            abort(404, 'Data evaluasi indikator belum tersedia.');
        }

        /*
        |--------------------------------------------------------------------------
        | TINGKAT KEMATANGAN
        |--------------------------------------------------------------------------
        */

        $tingkat = DB::table('tingkat_kematangan')
            ->orderBy('level')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | NAMA LEVEL
        |--------------------------------------------------------------------------
        */

        $namaLevel = [
            1 => 'Initiate / Kurang',
            2 => 'Emerging / Cukup',
            3 => 'Developing / Baik',
            4 => 'Advancing / Sangat Baik',
            5 => 'Digital Leading / Unggul',
        ];

        /*
        |--------------------------------------------------------------------------
        | KRITERIA
        |--------------------------------------------------------------------------
        */

        $kriteria = DB::table('indikator_kriteria')
            ->where('id_indikator', $indikator->id_indikator)
            ->get()
            ->groupBy('id_tingkat');

        /*
        |--------------------------------------------------------------------------
        | DATA DUKUNG
        |--------------------------------------------------------------------------
        */

        $dataDukung = DB::table('data_dukung as dd')
            ->leftJoin(
                'evaluasi_data_dukung as edd',
                function ($join) use ($evaluasiIndikator) {
                    $join->on(
                        'edd.id_data_dukung',
                        '=',
                        'dd.id_data_dukung'
                    );

                    $join->where(
                        'edd.id_evaluasi_indikator',
                        '=',
                        $evaluasiIndikator->id_evaluasi_indikator
                    );
                }
            )
            ->where('dd.id_indikator', $indikator->id_indikator)
            ->where('dd.status', 'AKTIF')
            ->select(
                'dd.id_data_dukung',
                'dd.id_indikator',
                'dd.id_tingkat',
                'dd.nomor',
                'dd.nama_data_dukung',
                'dd.bobot',
                'dd.deskripsi',
                'dd.format_file',

                'edd.id_evaluasi_data_dukung',
                'edd.status as status_data_dukung',
                'edd.keterangan',
                'edd.catatan_asesor'
            )
            ->orderBy('dd.id_tingkat')
            ->orderBy('dd.nomor')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DOKUMEN
        |--------------------------------------------------------------------------
        */

        foreach ($dataDukung as $item) {
            $item->dokumen = collect();

            if ($item->id_evaluasi_data_dukung) {
                $item->dokumen = DB::table('dokumen_bukti')
                    ->where(
                        'id_evaluasi_data_dukung',
                        $item->id_evaluasi_data_dukung
                    )
                    ->where('status', 'AKTIF')
                    ->orderByDesc('versi')
                    ->get();
            }

            /*
            |--------------------------------------------------------------------------
            | VALUE
            |--------------------------------------------------------------------------
            |
            | Belum upload              = 0
            | Sudah upload              = bobot
            | Perlu Perbaikan           = bobot
            | Sudah Diverifikasi        = bobot
            |
            */

            $sudahUpload = in_array(
                $item->status_data_dukung,
                [
                    'TERKIRIM',
                    'DIVERIFIKASI',
                    'PERLU_PERBAIKAN',
                ],
                true
            );

            // Value selalu menampilkan bobot data dukung.
            // Kontribusi aktual untuk PM disimpan terpisah di $item->terpenuhi.
            $item->value = (float) $item->bobot;
            $item->terpenuhi = $sudahUpload
                ? (float) $item->bobot
                : 0;
            $item->sudah_upload = $sudahUpload;
        }

        /*
        |--------------------------------------------------------------------------
        | GROUP DATA DUKUNG
        |--------------------------------------------------------------------------
        */

        $dataDukungPerTingkat = $dataDukung->groupBy(
            'id_tingkat'
        );

        /*
        |--------------------------------------------------------------------------
        | PM PER TINGKAT
        |--------------------------------------------------------------------------
        |
        | Contoh:
        |
        | Bobot data dukung:
        | 0.5
        |
        | Belum upload:
        | PM = 0 / 0.5
        |
        | Sudah upload:
        | PM = 0.5 / 0.5
        |
        */

        $pmPerTingkat = [];

        foreach ($tingkat as $level) {
            $items = $dataDukungPerTingkat->get(
                $level->id_tingkat,
                collect()
            );

            $maksimal = $items->sum(function ($item) {
                return (float) $item->bobot;
            });

            $diperoleh = $items->sum(function ($item) {
                return (float) $item->terpenuhi;
            });

            $pmPerTingkat[$level->id_tingkat] = [
                'diperoleh' => $diperoleh,
                'maksimal' => $maksimal,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | PROGRESS PER TINGKAT
        |--------------------------------------------------------------------------
        */

        $progressPerTingkat = [];

        foreach ($tingkat as $level) {
            $items = $dataDukungPerTingkat->get(
                $level->id_tingkat,
                collect()
            );

            $total = $items->count();

            $terisi = $items->filter(function ($item) {
                return in_array(
                    $item->status_data_dukung,
                    [
                        'TERKIRIM',
                        'DIVERIFIKASI',
                        'PERLU_PERBAIKAN',
                    ],
                    true
                );
            })->count();

            $progressPerTingkat[$level->id_tingkat] = [
                'total' => $total,
                'terisi' => $terisi,
                'progress' => $total > 0
                    ? round(($terisi / $total) * 100)
                    : 0,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | DATA DETAIL KRITERIA UNTUK MODAL
        |--------------------------------------------------------------------------
        */

        $detailData = [];

        foreach ($tingkat as $level) {
            $items = $kriteria->get(
                $level->id_tingkat,
                collect()
            );

            $detailData[$level->id_tingkat] = [
                'level' => $level->level,

                'nama' => $namaLevel[$level->level]
                    ?? 'Tingkat Kematangan',

                'items' => $items->map(function ($item) {
                    return [
                        'kriteria' => $item->kriteria,
                        'bukti' => $item->bukti_yang_dibutuhkan,
                    ];
                })->values()->toArray(),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | NILAI INDIKATOR
        |--------------------------------------------------------------------------
        |
        | Nilai awal tetap 1.
        |
        */

        $nilai = (float) (
            $evaluasiIndikator->nilai ?? 1.00
        );

        /*
        |--------------------------------------------------------------------------
        | PANDUAN / TEMPLATE
        |--------------------------------------------------------------------------
        */

        $panduan = DB::table('panduan')
            ->where('id_indikator', $indikator->id_indikator)
            ->where('status', 'AKTIF')
            ->orderByRaw("
                CASE tipe
                    WHEN 'TEMPLATE' THEN 1
                    WHEN 'PANDUAN' THEN 2
                    ELSE 3
                END
            ")
            ->get();

        $panduanPenilaian = null;

        $panduanUmum = $panduan->firstWhere(
            'tipe',
            'PANDUAN'
        );

        if ($panduanUmum) {
            $panduanPenilaian = $panduanUmum->deskripsi;
        }

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'user.penilaian.internal',
            compact(
                'instansi',
                'evaluasi',
                'indikator',
                'aspek',
                'evaluasiIndikator',
                'tingkat',
                'namaLevel',
                'dataDukung',
                'dataDukungPerTingkat',
                'progressPerTingkat',
                'pmPerTingkat',
                'kriteria',
                'detailData',
                'nilai',
                'panduan',
                'panduanPenilaian'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD DOKUMEN
    |--------------------------------------------------------------------------
    */

    public function upload(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'id_data_dukung' => [
                'required',
                'integer',
            ],

            'dokumen' => [
                'required',
                'file',
                'max:10240',
                'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png',
            ],

            'catatan_user' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | INSTANSI
        |--------------------------------------------------------------------------
        */

        $instansi = DB::table('instansi')
            ->where('id_instansi', $user->id_instansi)
            ->where('status', 'AKTIF')
            ->first();

        if (!$instansi) {
            abort(403, 'Instansi user tidak valid.');
        }

        /*
        |--------------------------------------------------------------------------
        | EVALUASI
        |--------------------------------------------------------------------------
        */

        $evaluasi = DB::table('evaluasi')
            ->where('id_instansi', $instansi->id_instansi)
            ->where('tahun', now()->year)
            ->first();

        if (!$evaluasi) {
            abort(404, 'Evaluasi belum tersedia.');
        }

        /*
        |--------------------------------------------------------------------------
        | EVALUASI INDIKATOR
        |--------------------------------------------------------------------------
        */

        $evaluasiIndikator = DB::table('evaluasi_indikator')
            ->where(
                'id_evaluasi',
                $evaluasi->id_evaluasi
            )
            ->where(
                'id_indikator',
                $id
            )
            ->first();

        if (!$evaluasiIndikator) {
            abort(
                404,
                'Evaluasi indikator tidak ditemukan.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA DUKUNG
        |--------------------------------------------------------------------------
        */

        $dataDukung = DB::table('data_dukung')
            ->where(
                'id_data_dukung',
                $request->id_data_dukung
            )
            ->where(
                'id_indikator',
                $id
            )
            ->where(
                'status',
                'AKTIF'
            )
            ->first();

        if (!$dataDukung) {
            abort(
                404,
                'Data dukung tidak ditemukan.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | EVALUASI DATA DUKUNG
        |--------------------------------------------------------------------------
        */

        $evaluasiDataDukung = DB::table(
            'evaluasi_data_dukung'
        )
            ->where(
                'id_evaluasi_indikator',
                $evaluasiIndikator
                    ->id_evaluasi_indikator
            )
            ->where(
                'id_data_dukung',
                $dataDukung->id_data_dukung
            )
            ->first();

        if (!$evaluasiDataDukung) {

            $idEvaluasiDataDukung = DB::table(
                'evaluasi_data_dukung'
            )->insertGetId([
                'id_evaluasi_indikator' =>
                    $evaluasiIndikator
                        ->id_evaluasi_indikator,

                'id_data_dukung' =>
                    $dataDukung->id_data_dukung,

                'status' =>
                    'TERKIRIM',

                'keterangan' =>
                    $request->catatan_user,

                'created_at' =>
                    now(),

                'updated_at' =>
                    now(),
            ]);

            $evaluasiDataDukung = DB::table(
                'evaluasi_data_dukung'
            )
                ->where(
                    'id_evaluasi_data_dukung',
                    $idEvaluasiDataDukung
                )
                ->first();

        } else {

            DB::table(
                'evaluasi_data_dukung'
            )
                ->where(
                    'id_evaluasi_data_dukung',
                    $evaluasiDataDukung
                        ->id_evaluasi_data_dukung
                )
                ->update([
                    'status' => 'TERKIRIM',

                    'keterangan' =>
                        $request->catatan_user,

                    'updated_at' =>
                        now(),
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VERSI FILE
        |--------------------------------------------------------------------------
        */

        $versiTerakhir = DB::table(
            'dokumen_bukti'
        )
            ->where(
                'id_evaluasi_data_dukung',
                $evaluasiDataDukung
                    ->id_evaluasi_data_dukung
            )
            ->max('versi');

        $versi = ($versiTerakhir ?? 0) + 1;

        /*
        |--------------------------------------------------------------------------
        | NONAKTIFKAN FILE LAMA
        |--------------------------------------------------------------------------
        */

        DB::table('dokumen_bukti')
            ->where(
                'id_evaluasi_data_dukung',
                $evaluasiDataDukung
                    ->id_evaluasi_data_dukung
            )
            ->where(
                'status',
                'AKTIF'
            )
            ->update([
                'status' => 'DIGANTI',
            ]);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN FILE
        |--------------------------------------------------------------------------
        */

        $file = $request->file('dokumen');

        $path = $file->store(
            'dokumen-bukti/' . $instansi->id_instansi,
            'public'
        );

        /*
        |--------------------------------------------------------------------------
        | INSERT DOKUMEN
        |--------------------------------------------------------------------------
        */

        DB::table('dokumen_bukti')->insert([
            'id_evaluasi_data_dukung' =>
                $evaluasiDataDukung
                    ->id_evaluasi_data_dukung,

            'uploaded_by' =>
                $user->id_user,

            'file_name' =>
                $file->getClientOriginalName(),

            'file_path' =>
                $path,

            'file_type' =>
                $file->getClientMimeType(),

            'file_size' =>
                $file->getSize(),

            'catatan_user' =>
                $request->catatan_user,

            'versi' =>
                $versi,

            'status' =>
                'AKTIF',

            'created_at' =>
                now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'user.penilaian.internal',
                $id
            )
            ->with(
                'success',
                'Dokumen berhasil diupload.'
            );
    }
}