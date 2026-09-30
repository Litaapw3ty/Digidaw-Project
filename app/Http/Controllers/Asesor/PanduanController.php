<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PanduanController extends Controller
{
    // =====================================================
    // HALAMAN KELOLA PANDUAN
    // =====================================================

    public function index()
    {
        $aspekList = DB::table('aspek_penilaian as ap')
            ->leftJoin('panduan as p', function ($join) {
                $join->on('p.id_aspek', '=', 'ap.id_aspek')
                    ->where('p.status', 'AKTIF');
            })
            ->select(
                'ap.id_aspek',
                'ap.nomor_aspek',
                'ap.nama_aspek',
                'ap.bobot',
                DB::raw('COUNT(p.id_panduan) as jumlah_panduan')
            )
            ->where('ap.status', 'AKTIF')
            ->groupBy(
                'ap.id_aspek',
                'ap.nomor_aspek',
                'ap.nama_aspek',
                'ap.bobot'
            )
            ->orderBy('ap.nomor_aspek')
            ->get();

        return view(
            'asesor.kelola_panduan',
            compact('aspekList')
        );
    }


    // =====================================================
    // HALAMAN UPLOAD PANDUAN
    // =====================================================

    public function create($idAspek, $idIndikator, $idDataDukung = null)
    {
        // -------------------------------------------------
        // AMBIL ASPEK
        // -------------------------------------------------

        $aspek = DB::table('aspek_penilaian')
            ->where('id_aspek', $idAspek)
            ->where('status', 'AKTIF')
            ->first();

        if (!$aspek) {
            abort(404, 'Aspek tidak ditemukan');
        }


        // -------------------------------------------------
        // AMBIL INDIKATOR SESUAI ASPEK
        // -------------------------------------------------

        $indikator = DB::table('indikator_penilaian')
            ->where('id_indikator', $idIndikator)
            ->where('id_aspek', $idAspek)
            ->where('status', 'AKTIF')
            ->first();

        if (!$indikator) {
            abort(404, 'Indikator tidak ditemukan atau tidak sesuai dengan aspek');
        }

        $dataDukung = null;

        if ($idDataDukung) {
            $dataDukung = DB::table('data_dukung')
                ->where('id_data_dukung', $idDataDukung)
                ->where('id_indikator', $idIndikator)
                ->where('status', 'AKTIF')
                ->first();

            if (!$dataDukung) {
                abort(404, 'Data dukung tidak ditemukan atau tidak sesuai dengan indikator');
            }
        }


        $editPanduan = null;

        if (request()->filled('edit')) {
            $editPanduan = DB::table('panduan')
                ->where('id_panduan', request()->query('edit'))
                ->where('id_indikator', $idIndikator)
                ->when($idDataDukung, function ($query) use ($idDataDukung) {
                    $query->where('id_data_dukung', $idDataDukung);
                })
                ->where('status', 'AKTIF')
                ->first();
        }


        // =================================================
        // CEK PANDUAN / TEMPLATE YANG SUDAH ADA
        // =================================================

        $existingTypes = DB::table('panduan')
            ->where('id_indikator', $idIndikator)
            ->when($idDataDukung, function ($query) use ($idDataDukung) {
                $query->where('id_data_dukung', $idDataDukung);
            })
            ->where('status', 'AKTIF')
            ->pluck('tipe')
            ->toArray();

        $hasPanduan = in_array('PANDUAN', $existingTypes);
        $hasTemplate = in_array('TEMPLATE', $existingTypes);
        $defaultTipe = $editPanduan?->tipe ?? (request()->query('jenis') === 'template'
            ? 'TEMPLATE'
            : 'PANDUAN');


        // =================================================
        // AMBIL PANDUAN UNTUK INDIKATOR YANG SEDANG DIBUKA
        // =================================================

        $panduan = DB::table('panduan')
            ->where('id_indikator', $idIndikator)
            ->when($idDataDukung, function ($query) use ($idDataDukung) {
                $query->where('id_data_dukung', $idDataDukung);
            })
            ->where('status', 'AKTIF')
            ->orderBy('id_panduan')
            ->first();


        // =================================================
        // CEK FILE PANDUAN
        // =================================================

        if ($panduan) {

            if (!empty($panduan->file_path)) {

                $panduan->file_url = Storage::disk('public')
                    ->url($panduan->file_path);

                $panduan->file_exists = Storage::disk('public')
                    ->exists($panduan->file_path);

            } else {

                $panduan->file_url = null;
                $panduan->file_exists = false;
            }

        }


        // =================================================
        // PANDUAN AKTIF UNTUK SIDEBAR
        // =================================================

        $panduanList = DB::table('panduan as p')
            ->leftJoin(
                'aspek_penilaian as ap',
                'ap.id_aspek',
                '=',
                'p.id_aspek'
            )
            ->leftJoin(
                'indikator_penilaian as ip',
                'ip.id_indikator',
                '=',
                'p.id_indikator'
            )
            ->where('p.status', 'AKTIF')
            ->where('p.id_indikator', $idIndikator)
            ->select(
                'p.*',
                'ap.nomor_aspek',
                'ap.nama_aspek',
                'ip.nomor_indikator',
                'ip.nama_indikator'
            )
            ->orderByDesc('p.created_at')
            ->get();


        // =================================================
        // CEK FILE PADA PANDUAN SIDEBAR
        // =================================================

        foreach ($panduanList as $item) {

            if (!empty($item->file_path)) {

                $item->file_url = Storage::disk('public')
                    ->url($item->file_path);

                $item->file_exists = Storage::disk('public')
                    ->exists($item->file_path);

            } else {

                $item->file_url = null;
                $item->file_exists = false;
            }
        }


        // =================================================
        // KIRIM DATA KE VIEW
        // =================================================

        return view(
            'asesor.upload_panduan',
            compact(
                'aspek',
                'indikator',
                'panduan',
                'panduanList',
                'hasPanduan',
                'hasTemplate',
                'defaultTipe',
                'editPanduan',
                'dataDukung'
            )
        );
    }


    // =====================================================
    // SIMPAN PANDUAN
    // =====================================================

    public function store(Request $request)
    {
        // -------------------------------------------------
        // VALIDASI
        // -------------------------------------------------

        $request->validate([
            'id_aspek' => [
                'required',
                'integer',
                'exists:aspek_penilaian,id_aspek'
            ],

            'id_indikator' => [
                'required',
                'integer',
                'exists:indikator_penilaian,id_indikator'
            ],

            'id_data_dukung' => [
                'required',
                'integer',
                'exists:data_dukung,id_data_dukung'
            ],

            'judul' => [
                'required',
                'string',
                'max:255'
            ],

            'deskripsi' => [
                'nullable',
                'string'
            ],

            'tipe' => [
                'required',
                'in:PANDUAN,TEMPLATE'
            ],

            'edit_id' => [
                'nullable',
                'integer',
                'exists:panduan,id_panduan'
            ],

            'file' => [
                'nullable',
                'required_without:edit_id',
                'file',
                'max:10240',
                'mimes:pdf,doc,docx,xls,xlsx'
            ],
        ], [
            'id_aspek.required' => 'Aspek penilaian wajib dipilih.',
            'id_indikator.required' => 'Indikator terkait wajib dipilih.',
            'id_data_dukung.required' => 'Data dukung wajib dipilih.',
            'judul.required' => 'Judul panduan wajib diisi.',
            'tipe.required' => 'Tipe dokumen wajib dipilih.',
            'file.required_without' => 'File wajib diunggah untuk dokumen baru.',
            'file.max' => 'Ukuran file maksimal 10MB.',
            'file.mimes' => 'File harus berupa PDF, DOC, DOCX, XLS, atau XLSX.',
        ]);


        // -------------------------------------------------
        // PASTIKAN INDIKATOR SESUAI DENGAN ASPEK
        // -------------------------------------------------

        $indikator = DB::table('indikator_penilaian')
            ->where('id_indikator', $request->id_indikator)
            ->where('id_aspek', $request->id_aspek)
            ->where('status', 'AKTIF')
            ->first();

        if (!$indikator) {

            return back()
                ->withInput()
                ->withErrors([
                    'id_indikator' =>
                        'Indikator tidak sesuai dengan aspek yang dipilih.'
                ]);
        }

        $dataDukung = DB::table('data_dukung')
            ->where('id_data_dukung', $request->id_data_dukung)
            ->where('id_indikator', $request->id_indikator)
            ->where('status', 'AKTIF')
            ->first();

        if (!$dataDukung) {
            return back()
                ->withInput()
                ->withErrors([
                    'id_data_dukung' => 'Data dukung tidak sesuai dengan indikator yang dipilih.'
                ]);
        }


        if ($request->filled('edit_id')) {
            $editPanduan = DB::table('panduan')
                ->where('id_panduan', $request->edit_id)
                ->where('id_indikator', $request->id_indikator)
                ->where('id_data_dukung', $request->id_data_dukung)
                ->where('status', 'AKTIF')
                ->first();

            if (!$editPanduan) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'edit_id' => 'Dokumen tidak sesuai dengan indikator yang dipilih.'
                    ]);
            }
        }


        // -------------------------------------------------
        // CEK APAKAH TIPE SUDAH PERNAH DIUPLOAD
        // -------------------------------------------------

        $existingPanduanQuery = DB::table('panduan')
            ->where('id_indikator', $request->id_indikator)
            ->where('id_data_dukung', $request->id_data_dukung)
            ->where('tipe', $request->tipe)
            ->where('status', 'AKTIF')
            ->when($request->filled('edit_id'), function ($query) use ($request) {
                $query->where('id_panduan', '!=', $request->edit_id);
            });

        $existingPanduan = $existingPanduanQuery->exists();

        if ($existingPanduan) {

            return back()
                ->withInput()
                ->withErrors([
                    'tipe' => $request->tipe === 'PANDUAN'
                        ? 'Panduan untuk indikator ini sudah pernah diupload.'
                        : 'Template untuk indikator ini sudah pernah diupload.'
                ]);
        }


        // -------------------------------------------------
        // CARI DATA ASESOR BERDASARKAN USER LOGIN
        // -------------------------------------------------

        $asesor = DB::table('asesor')
            ->where('id_user', auth()->id())
            ->where('status', 'AKTIF')
            ->first();

        if (!$asesor) {

            return back()
                ->withInput()
                ->withErrors([
                    'file' =>
                        'Data asesor untuk akun yang sedang login tidak ditemukan.'
                ]);
        }


        // -------------------------------------------------
        // UPLOAD FILE
        // -------------------------------------------------

        $file = $request->file('file');
        $filePath = null;

        if ($file) {
            $fileName = time()
                . '_'
                . preg_replace(
                    '/[^A-Za-z0-9\-_\.]/',
                    '_',
                    $file->getClientOriginalName()
                );

            $filePath = $file->storeAs(
                'panduan',
                $fileName,
                'public'
            );
        }


        // =================================================
        // CEK DATA LAMA
        // =================================================

        $existing = DB::table('panduan')
            ->when($request->filled('edit_id'), function ($query) use ($request) {
                $query->where('id_panduan', $request->edit_id);
            }, function ($query) use ($request) {
                $query->where('id_indikator', $request->id_indikator)
                    ->where('id_data_dukung', $request->id_data_dukung)
                    ->where('tipe', $request->tipe)
                    ->where('status', 'AKTIF');
            })
            ->first();


        // =================================================
        // JIKA DATA SUDAH ADA → UPDATE
        // =================================================

        if ($existing) {

            // Hapus file lama
            if ($file &&
                $existing->file_path &&
                Storage::disk('public')->exists($existing->file_path)
            ) {
                Storage::disk('public')->delete(
                    $existing->file_path
                );
            }


            $updateData = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tipe' => $request->tipe,
                'updated_at' => now(),
            ];

            if ($file) {
                $updateData['file_path'] = $filePath;
                $updateData['file_name'] = $file->getClientOriginalName();
            }

            DB::table('panduan')
                ->where('id_panduan', $existing->id_panduan)
                ->update($updateData);

        }


        // =================================================
        // JIKA BELUM ADA → INSERT
        // =================================================

        else {

            DB::table('panduan')->insert([
                'id_asesor' => $asesor->id_asesor,
                'id_aspek' => $request->id_aspek,
                'id_indikator' => $request->id_indikator,
                'id_data_dukung' => $request->id_data_dukung,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tipe' => $request->tipe,
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
                'status' => 'AKTIF',
                'created_by' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // =================================================
        // REDIRECT KE DETAIL ASPEK
        // =================================================

        return redirect()
            ->route('asesor.panduan.detail', [
                'idAspek' => $request->id_aspek
            ])
            ->with(
                'success',
                $request->filled('edit_id')
                    ? 'Dokumen berhasil diperbarui.'
                    : 'Panduan berhasil ditambahkan.'
            );
    }


    // =====================================================
    // DETAIL PANDUAN BERDASARKAN ASPEK
    // =====================================================

    public function detail($idAspek)
    {
        // -------------------------------------------------
        // AMBIL ASPEK
        // -------------------------------------------------

        $aspek = DB::table('aspek_penilaian')
            ->where('id_aspek', $idAspek)
            ->where('status', 'AKTIF')
            ->first();

        if (!$aspek) {
            abort(404, 'Aspek tidak ditemukan');
        }


        // -------------------------------------------------
        // AMBIL INDIKATOR
        // -------------------------------------------------

        $indikatorList = DB::table('indikator_penilaian as ip')
            ->where('ip.id_aspek', $idAspek)
            ->where('ip.status', 'AKTIF')
            ->orderBy('ip.nomor_indikator')
            ->get();


        // -------------------------------------------------
        // AMBIL DATA DUKUNG & PANDUAN
        // -------------------------------------------------

        foreach ($indikatorList as $indikator) {

            // ---------------------------------------------
            // DATA DUKUNG
            // ---------------------------------------------

            $dataDukungList = DB::table('data_dukung as dd')
                ->where(
                    'dd.id_indikator',
                    $indikator->id_indikator
                )
                ->where('dd.status', 'AKTIF')
                ->orderBy('dd.id_tingkat')
                ->orderBy('dd.nomor')
                ->get();


            $indikator->tingkatList = $dataDukungList
                ->groupBy('id_tingkat')
                ->map(function ($items, $idTingkat) {

                    return (object) [
                        'id_tingkat' => $idTingkat,
                        'nama_tingkat' => 'Tingkat ' . $idTingkat,
                        'dataDukungList' => $items->values(),
                    ];

                })
                ->values();


            // ---------------------------------------------
            // PANDUAN
            // ---------------------------------------------

            $indikator->panduanList = DB::table('panduan as p')
                ->where(
                    'p.id_indikator',
                    $indikator->id_indikator
                )
                ->where('p.status', 'AKTIF')
                ->orderBy('p.id_panduan')
                ->get();


            // ---------------------------------------------
            // CEK FILE PANDUAN
            // ---------------------------------------------

            foreach ($indikator->panduanList as $panduan) {

                if (!empty($panduan->file_path)) {

                    $panduan->file_url = Storage::disk('public')
                        ->url($panduan->file_path);

                    $panduan->file_exists = Storage::disk('public')
                        ->exists($panduan->file_path);

                } else {

                    $panduan->file_url = null;
                    $panduan->file_exists = false;
                }
            }
        }


        // =================================================
        // TOTAL DATA
        // =================================================

        $totalIndikator = $indikatorList->count();


        $totalDataDukung = $indikatorList->sum(
            function ($indikator) {

                return $indikator->tingkatList->sum(
                    function ($tingkat) {

                        return $tingkat->dataDukungList->count();
                    }
                );
            }
        );


        $totalTingkat = $indikatorList->sum(
            function ($indikator) {

                return $indikator->tingkatList->count();
            }
        );


        $totalPanduan = $indikatorList->sum(
            function ($indikator) {

                return $indikator->panduanList->count();
            }
        );


        // =================================================
        // RETURN VIEW
        // =================================================

        return view(
            'asesor.detail_panduan',
            compact(
                'aspek',
                'indikatorList',
                'totalIndikator',
                'totalTingkat',
                'totalDataDukung',
                'totalPanduan'
            )
        );
    }


    // =====================================================
    // HAPUS PANDUAN
    // =====================================================

    public function destroy($id)
    {
        // -------------------------------------------------
        // CARI DATA PANDUAN
        // -------------------------------------------------

        $panduan = DB::table('panduan')
            ->where('id_panduan', $id)
            ->first();

        if (!$panduan) {
            abort(404);
        }


        // -------------------------------------------------
        // HAPUS FILE
        // -------------------------------------------------

        if (
            $panduan->file_path &&
            Storage::disk('public')->exists(
                $panduan->file_path
            )
        ) {
            Storage::disk('public')->delete(
                $panduan->file_path
            );
        }


        // -------------------------------------------------
        // HAPUS DATA DATABASE
        // -------------------------------------------------

        DB::table('panduan')
            ->where('id_panduan', $id)
            ->delete();


        return back()->with(
            'success',
            'Dokumen berhasil dihapus.'
        );
    }


    public function file($id)
    {
        $panduan = DB::table('panduan')
            ->where('id_panduan', $id)
            ->where('status', 'AKTIF')
            ->first();

        if (!$panduan || !$panduan->file_path) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        $disk = Storage::disk('public');

        if (!$disk->exists($panduan->file_path)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        return response()->file(
            $disk->path($panduan->file_path),
            [
                'Content-Disposition' => 'inline; filename="' . addslashes($panduan->file_name) . '"',
            ]
        );
    }
}