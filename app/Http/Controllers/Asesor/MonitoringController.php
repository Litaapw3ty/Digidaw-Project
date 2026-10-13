<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    /**
     * Halaman utama monitoring
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Ambil evaluasi terbaru setiap instansi
        |--------------------------------------------------------------------------
        */

        $monitoringList = DB::table('evaluasi as e')
            ->join(
                'instansi as i',
                'e.id_instansi',
                '=',
                'i.id_instansi'
            )
            ->whereIn('e.id_evaluasi', function ($query) {
                $query->select(DB::raw('MAX(id_evaluasi)'))
                    ->from('evaluasi')
                    ->groupBy('id_instansi');
            })
            ->select(
                'e.id_evaluasi',
                'e.id_instansi',
                'e.tahun',
                'e.status',
                'e.indeks_akhir',
                'i.nama_instansi'
            )
            ->orderBy('i.nama_instansi')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | 2. Total indikator aktif
        |--------------------------------------------------------------------------
        */

        $totalIndikator = DB::table('indikator_penilaian')
            ->where('status', 'AKTIF')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 3. Tentukan status setiap instansi
        |--------------------------------------------------------------------------
        |
        | indeks_akhir TIDAK digunakan untuk menentukan status.
        |
        | Nilai 1.00 merupakan nilai awal.
        |
        | Status "Sudah Dinilai" hanya jika seluruh indikator aktif
        | sudah memiliki bukti yang DISETUJUI.
        |
        */

        $monitoringList = $monitoringList->map(function ($item) use (
            $totalIndikator
        ) {

            /*
            |----------------------------------------------------------------------
            | Hitung indikator yang sudah memiliki bukti DISETUJUI
            |----------------------------------------------------------------------
            */

            $jumlahTerverifikasi = DB::table(
                'evaluasi_indikator as ei'
            )
                ->join(
                    'evaluasi_data_dukung as edd',
                    'ei.id_evaluasi_indikator',
                    '=',
                    'edd.id_evaluasi_indikator'
                )
                ->join(
                    'dokumen_bukti as db',
                    'edd.id_evaluasi_data_dukung',
                    '=',
                    'db.id_evaluasi_data_dukung'
                )
                ->join(
                    'verifikasi_bukti as vb',
                    'db.id_dokumen',
                    '=',
                    'vb.id_dokumen'
                )
                ->where(
                    'ei.id_evaluasi',
                    $item->id_evaluasi
                )
                ->where(
                    'db.status',
                    'AKTIF'
                )
                ->where(
                    'vb.keputusan',
                    'DISETUJUI'
                )
                ->distinct()
                ->count('ei.id_indikator');


            /*
            |----------------------------------------------------------------------
            | Status monitoring
            |----------------------------------------------------------------------
            */

            if (
                $totalIndikator > 0 &&
                $jumlahTerverifikasi >= $totalIndikator
            ) {

                $item->status_monitoring = 'SELESAI';

            } else {

                $item->status_monitoring = 'PROSES';
            }


            /*
            |----------------------------------------------------------------------
            | Simpan jumlah indikator
            |---------------------------------------------------------------------- 
            */

            $item->jumlah_terverifikasi =
                $jumlahTerverifikasi;

            $item->total_indikator =
                $totalIndikator;


            return $item;
        });


        /*
        |--------------------------------------------------------------------------
        | 4. Statistik
        |--------------------------------------------------------------------------
        */

        $totalInstansi = $monitoringList->count();

        $sudahDinilai = $monitoringList
            ->where(
                'status_monitoring',
                'SELESAI'
            )
            ->count();

        $proses = $monitoringList
            ->where(
                'status_monitoring',
                'PROSES'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 5. Kirim data ke Blade
        |--------------------------------------------------------------------------
        */

        return view(
            'asesor.monitoring',
            compact(
                'monitoringList',
                'totalInstansi',
                'sudahDinilai',
                'proses'
            )
        );
    }


    /**
     * Detail penilaian berdasarkan aspek
     */
    public function detailAspek(
        $id_instansi,
        $id_aspek
    ) {
        $evaluasi = DB::table('evaluasi as e')
            ->join(
                'instansi as i',
                'e.id_instansi',
                '=',
                'i.id_instansi'
            )
            ->where(
                'e.id_instansi',
                $id_instansi
            )
            ->orderByDesc('e.tahun')
            ->orderByDesc('e.id_evaluasi')
            ->select(
                'e.*',
                'i.nama_instansi'
            )
            ->first();

        if (!$evaluasi) {
            abort(
                404,
                'Data evaluasi tidak ditemukan.'
            );
        }


        $aspek = DB::table('aspek_penilaian')
            ->where(
                'id_aspek',
                $id_aspek
            )
            ->first();

        if (!$aspek) {
            abort(
                404,
                'Data aspek tidak ditemukan.'
            );
        }


        $indikator = DB::table(
            'evaluasi_indikator as ei'
        )
            ->join(
                'indikator_penilaian as ip',
                'ei.id_indikator',
                '=',
                'ip.id_indikator'
            )
            ->where(
                'ei.id_evaluasi',
                $evaluasi->id_evaluasi
            )
            ->where(
                'ip.id_aspek',
                $id_aspek
            )
            ->where(
                'ip.status',
                'AKTIF'
            )
            ->select(
                'ei.id_evaluasi_indikator',
                'ei.id_indikator',
                'ei.nilai',
                'ei.level_kematangan',
                'ei.status_pengisian',
                'ip.nomor_indikator',
                'ip.kode_indikator',
                'ip.nama_indikator'
            )
            ->orderBy(
                'ip.nomor_indikator'
            )
            ->get();


        return view(
            'asesor.detail_penilaian',
            compact(
                'evaluasi',
                'aspek',
                'indikator'
            )
        );
    }


    /**
     * Detail monitoring
     */
    public function detail($id_instansi)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Ambil evaluasi terbaru
        |--------------------------------------------------------------------------
        */

        $evaluasi = DB::table('evaluasi as e')
            ->join(
                'instansi as i',
                'e.id_instansi',
                '=',
                'i.id_instansi'
            )
            ->where(
                'e.id_instansi',
                $id_instansi
            )
            ->orderByDesc('e.tahun')
            ->orderByDesc('e.id_evaluasi')
            ->select(
                'e.*',
                'i.nama_instansi'
            )
            ->first();

        if (!$evaluasi) {
            abort(
                404,
                'Data evaluasi tidak ditemukan.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | 2. Total indikator aktif
        |--------------------------------------------------------------------------
        */

        $totalIndikator = DB::table(
            'indikator_penilaian'
        )
            ->where(
                'status',
                'AKTIF'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | 3. Indikator yang sudah DISETUJUI
        |--------------------------------------------------------------------------
        */

        $indikatorTerverifikasi = DB::table(
            'evaluasi_indikator as ei'
        )
            ->join(
                'evaluasi_data_dukung as edd',
                'ei.id_evaluasi_indikator',
                '=',
                'edd.id_evaluasi_indikator'
            )
            ->join(
                'dokumen_bukti as db',
                'edd.id_evaluasi_data_dukung',
                '=',
                'db.id_evaluasi_data_dukung'
            )
            ->join(
                'verifikasi_bukti as vb',
                'db.id_dokumen',
                '=',
                'vb.id_dokumen'
            )
            ->where(
                'ei.id_evaluasi',
                $evaluasi->id_evaluasi
            )
            ->where(
                'db.status',
                'AKTIF'
            )
            ->where(
                'vb.keputusan',
                'DISETUJUI'
            )
            ->distinct()
            ->pluck(
                'ei.id_indikator'
            )
            ->toArray();


        $jumlahTerisi =
            count(
                $indikatorTerverifikasi
            );


        $jumlahBelum = max(
            0,
            $totalIndikator - $jumlahTerisi
        );


        /*
        |--------------------------------------------------------------------------
        | 4. Status instansi
        |--------------------------------------------------------------------------
        */

        $statusInstansi =
            'Belum Dimulai';

        if (
            $jumlahTerisi >= $totalIndikator &&
            $totalIndikator > 0
        ) {

            $statusInstansi =
                'Selesai';

        } elseif (
            $jumlahTerisi > 0
        ) {

            $statusInstansi =
                'Sedang Berlangsung';
        }


        /*
        |--------------------------------------------------------------------------
        | 5. Object instansi
        |--------------------------------------------------------------------------
        */

        $instansi = (object) [

            'id_instansi' =>
                $evaluasi->id_instansi,

            'nama_instansi' =>
                $evaluasi->nama_instansi,

            /*
             * Tetap tampilkan indeks_akhir.
             * Nilai 1.00 merupakan nilai awal.
             */

            'indeks_pm' =>
                $evaluasi->indeks_akhir,

            'jumlah_indikator' =>
                $totalIndikator,

            'jumlah_terisi' =>
                $jumlahTerisi,

            'status' =>
                $statusInstansi,
        ];


        /*
        |--------------------------------------------------------------------------
        | 6. Data aspek
        |--------------------------------------------------------------------------
        */

        $aspekData = DB::table(
            'aspek_penilaian'
        )
            ->orderBy(
                'id_aspek'
            )
            ->get();


        $aspek = $aspekData->map(
            function ($item) use (
                $evaluasi,
                $indikatorTerverifikasi
            ) {

                /*
                |------------------------------------------------------------------
                | Total indikator pada aspek
                |------------------------------------------------------------------
                */

                $totalIndikatorAspek =
                    DB::table(
                        'indikator_penilaian'
                    )
                        ->where(
                            'id_aspek',
                            $item->id_aspek
                        )
                        ->where(
                            'status',
                            'AKTIF'
                        )
                        ->count();


                /*
                |------------------------------------------------------------------
                | Indikator yang sudah diverifikasi
                |------------------------------------------------------------------
                */

                $indikatorTerisi = 0;

                if (
                    !empty(
                        $indikatorTerverifikasi
                    )
                ) {

                    $indikatorTerisi =
                        DB::table(
                            'indikator_penilaian'
                        )
                            ->where(
                                'id_aspek',
                                $item->id_aspek
                            )
                            ->where(
                                'status',
                                'AKTIF'
                            )
                            ->whereIn(
                                'id_indikator',
                                $indikatorTerverifikasi
                            )
                            ->distinct()
                            ->count(
                                'id_indikator'
                            );
                }


                /*
                |------------------------------------------------------------------
                | Progress indikator
                |------------------------------------------------------------------
                */

                $progresIndikator =
                    $totalIndikatorAspek > 0
                        ? round(
                            (
                                $indikatorTerisi
                                /
                                $totalIndikatorAspek
                            ) * 100
                        )
                        : 0;


                /*
                |------------------------------------------------------------------
                | Total data dukung
                |------------------------------------------------------------------
                */

                $totalDataDukung =
                    DB::table(
                        'data_dukung as dd'
                    )
                        ->join(
                            'indikator_penilaian as ip',
                            'dd.id_indikator',
                            '=',
                            'ip.id_indikator'
                        )
                        ->where(
                            'ip.id_aspek',
                            $item->id_aspek
                        )
                        ->where(
                            'ip.status',
                            'AKTIF'
                        )
                        ->where(
                            'dd.status',
                            'AKTIF'
                        )
                        ->count(
                            'dd.id_data_dukung'
                        );


                /*
                |------------------------------------------------------------------
                | Data dukung yang sudah disetujui
                |------------------------------------------------------------------
                */

                $dataDukungTerverifikasi =
                    DB::table(
                        'data_dukung as dd'
                    )
                        ->join(
                            'indikator_penilaian as ip',
                            'dd.id_indikator',
                            '=',
                            'ip.id_indikator'
                        )
                        ->join(
                            'evaluasi_data_dukung as edd',
                            'dd.id_data_dukung',
                            '=',
                            'edd.id_data_dukung'
                        )
                        ->join(
                            'evaluasi_indikator as ei',
                            'edd.id_evaluasi_indikator',
                            '=',
                            'ei.id_evaluasi_indikator'
                        )
                        ->join(
                            'dokumen_bukti as db',
                            'edd.id_evaluasi_data_dukung',
                            '=',
                            'db.id_evaluasi_data_dukung'
                        )
                        ->join(
                            'verifikasi_bukti as vb',
                            'db.id_dokumen',
                            '=',
                            'vb.id_dokumen'
                        )
                        ->where(
                            'ei.id_evaluasi',
                            $evaluasi->id_evaluasi
                        )
                        ->where(
                            'ip.id_aspek',
                            $item->id_aspek
                        )
                        ->where(
                            'ip.status',
                            'AKTIF'
                        )
                        ->where(
                            'dd.status',
                            'AKTIF'
                        )
                        ->where(
                            'db.status',
                            'AKTIF'
                        )
                        ->where(
                            'vb.keputusan',
                            'DISETUJUI'
                        )
                        ->distinct()
                        ->count(
                            'dd.id_data_dukung'
                        );


                /*
                |------------------------------------------------------------------
                | Progress data dukung
                |------------------------------------------------------------------
                */

                $progresDataDukung =
                    $totalDataDukung > 0
                        ? round(
                            (
                                $dataDukungTerverifikasi
                                /
                                $totalDataDukung
                            ) * 100,
                            2
                        )
                        : 0;


                /*
                |------------------------------------------------------------------
                | Nama aspek
                |------------------------------------------------------------------
                */

                $namaAspek =
                    $item->nama_aspek
                    ??
                    $item->nama
                    ??
                    (
                        'Aspek '
                        .
                        $item->id_aspek
                    );


                return [

                    'id_aspek' =>
                        $item->id_aspek,

                    'nama' =>
                        $namaAspek,

                    'total' =>
                        $totalIndikatorAspek,

                    'terisi' =>
                        $indikatorTerisi,

                    'progres' =>
                        $progresIndikator,

                    'total_data_dukung' =>
                        $totalDataDukung,

                    'data_dukung_terverifikasi' =>
                        $dataDukungTerverifikasi,

                    'progres_data_dukung' =>
                        $progresDataDukung,
                ];
            }
        );


        /*
        |--------------------------------------------------------------------------
        | 7. Detail indikator
        |--------------------------------------------------------------------------
        */

        $indikatorQuery = DB::table(
            'evaluasi_indikator as ei'
        )
            ->join(
                'indikator_penilaian as ip',
                'ei.id_indikator',
                '=',
                'ip.id_indikator'
            )
            ->leftJoin(
                'evaluasi_data_dukung as edd',
                'ei.id_evaluasi_indikator',
                '=',
                'edd.id_evaluasi_indikator'
            )
            ->leftJoin(
                'data_dukung as dd',
                'edd.id_data_dukung',
                '=',
                'dd.id_data_dukung'
            )
            ->leftJoin(
                'dokumen_bukti as db',
                function ($join) {

                    $join->on(
                        'edd.id_evaluasi_data_dukung',
                        '=',
                        'db.id_evaluasi_data_dukung'
                    );

                    $join->where(
                        'db.status',
                        'AKTIF'
                    );
                }
            )
            ->leftJoin(
                'verifikasi_bukti as vb',
                'db.id_dokumen',
                '=',
                'vb.id_dokumen'
            )
            ->where(
                'ei.id_evaluasi',
                $evaluasi->id_evaluasi
            )
            ->where(
                'ip.status',
                'AKTIF'
            )
            ->select(

                'ei.id_evaluasi_indikator',
                'ei.id_indikator',
                'ei.nilai',
                'ei.level_kematangan',
                'ei.status_pengisian',

                'ip.id_aspek',
                'ip.nomor_indikator',
                'ip.kode_indikator',
                'ip.nama_indikator',

                'edd.id_evaluasi_data_dukung',
                'edd.id_data_dukung',
                'edd.status as status_data_dukung',
                'edd.keterangan',
                'edd.catatan_asesor',

                'dd.nomor as nomor_data_dukung',
                'dd.nama_data_dukung',

                'db.id_dokumen',
                'db.file_name',
                'db.file_path',

                'vb.id_verifikasi',
                'vb.keputusan',
                'vb.catatan as catatan_verifikasi',
                'vb.verified_at'
            )
            ->orderBy(
                'ip.id_aspek'
            )
            ->orderBy(
                'ip.nomor_indikator'
            )
            ->orderBy(
                'dd.nomor'
            );


        $indikatorRows =
            $indikatorQuery->get();


        /*
        |--------------------------------------------------------------------------
        | 8. Kelompokkan indikator
        |--------------------------------------------------------------------------
        */

        $indikator = $indikatorRows
            ->groupBy(
                'id_evaluasi_indikator'
            )
            ->map(function ($items) {

                $first =
                    $items->first();


                /*
                |------------------------------------------------------------------
                | Keputusan verifikasi
                |------------------------------------------------------------------
                */

                $keputusan = $items
                    ->pluck(
                        'keputusan'
                    )
                    ->filter()
                    ->unique()
                    ->values()
                    ->toArray();


                /*
                |------------------------------------------------------------------
                | Status data dukung
                |------------------------------------------------------------------
                */

                $statusDataDukung =
                    $items
                        ->pluck(
                            'status_data_dukung'
                        )
                        ->filter()
                        ->unique()
                        ->values()
                        ->toArray();


                /*
                |------------------------------------------------------------------
                | Status indikator
                |------------------------------------------------------------------
                */

                if (
                    in_array(
                        'DISETUJUI',
                        $keputusan
                    )
                ) {

                    $status =
                        'DISETUJUI';

                } elseif (
                    in_array(
                        'PERLU_PERBAIKAN',
                        $keputusan
                    )
                ) {

                    $status =
                        'PERLU_PERBAIKAN';

                } elseif (
                    in_array(
                        'TERKIRIM',
                        $statusDataDukung
                    )
                ) {

                    $status =
                        'TERKIRIM';

                } elseif (
                    in_array(
                        'DIVERIFIKASI',
                        $statusDataDukung
                    )
                ) {

                    $status =
                        'DIVERIFIKASI';

                } else {

                    $status =
                        $first->status_pengisian
                        ?: 'BELUM_DIISI';
                }


                /*
                |------------------------------------------------------------------
                | Data dukung
                |------------------------------------------------------------------
                */

                $dataDukung =
                    $items
                        ->filter(function ($item) {

                            return !is_null(
                                $item->id_data_dukung
                            );
                        })
                        ->unique(
                            'id_data_dukung'
                        )
                        ->values();


                /*
                |------------------------------------------------------------------
                | Tingkat kematangan
                |------------------------------------------------------------------
                */

                $tingkat =
                    $first->level_kematangan;


                return [

                    'no' =>
                        $first->nomor_indikator,

                    'id_indikator' =>
                        $first->id_indikator,

                    'nama' =>
                        $first->nama_indikator,

                    'aspek' =>
                        $first->id_aspek,

                    'status' =>
                        $status,

                    'nilai' =>
                        $first->nilai,

                    'tingkat' =>
                        $tingkat,

                    'data_dukung' =>
                        $dataDukung,

                    'jumlah_data_dukung' =>
                        $dataDukung->count(),

                    'jumlah_data_dukung_disetujui' =>
                        $items
                            ->filter(function ($item) {

                                return
                                    !is_null(
                                        $item->id_data_dukung
                                    )
                                    &&
                                    $item->keputusan
                                        === 'DISETUJUI';
                            })
                            ->unique(
                                'id_data_dukung'
                            )
                            ->count(),
                ];
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | 9. Kirim semua data ke Blade
        |--------------------------------------------------------------------------
        */

        return view(
            'asesor.detail_monitoring',
            compact(
                'instansi',
                'aspek',
                'indikator'
            )
        );
    }
}