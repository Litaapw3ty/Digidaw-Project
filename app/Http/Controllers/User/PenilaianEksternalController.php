<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\AuditLog;

class PenilaianEksternalController extends Controller
{
    private function externalConfig(object $indikator): array
    {
        return match ($indikator->kode_indikator) {

            'IND-05', 'IND-18' => [
                'min' => 0,
                'max' => 100,
                'step' => '0.01',
                'suffix' => 'SDI',
                'source_scale' => '0–100',
            ],

            'IND-06' => [
                'min' => 0,
                'max' => 5,
                'step' => '0.01',
                'suffix' => 'SJIG',
                'source_scale' => '0–5',
            ],

            'IND-07' => [
                'min' => 0,
                'max' => 5,
                'step' => '0.01',
                'suffix' => 'IPS',
                'source_scale' => '0–5',
            ],

            default => [
                'min' => 0,
                'max' => 5,
                'step' => '0.01',
                'suffix' => null,
                'source_scale' => '0–5',
            ],
        };
    }

    private function convertToLevel(object $indikator, float $value): int
    {
        return match ($indikator->kode_indikator) {

            'IND-05', 'IND-18' => match (true) {
                $value < 30 => 1,
                $value < 50 => 2,
                $value < 70 => 3,
                $value < 90 => 4,
                default => 5,
            },

            'IND-06' => match (true) {
                $value < 1.50 => 1,
                $value < 2.50 => 2,
                $value < 3.50 => 3,
                $value < 4.00 => 4,
                default => 5,
            },

            'IND-07' => match (true) {
                $value < 1.80 => 1,
                $value < 2.60 => 2,
                $value < 3.50 => 3,
                $value < 4.20 => 4,
                default => 5,
            },

            default => (int) max(1, min(5, round($value))),
        };
    }

    private function levelLabel(int $level): string
    {
        return match ($level) {
            1 => 'Level 1',
            2 => 'Level 2',
            3 => 'Level 3',
            4 => 'Level 4',
            5 => 'Level 5',
            default => 'Level 1',
        };
    }

    public function show($id)
    {
        $user = Auth::user();

        $instansi = DB::table('instansi')
            ->where('id_instansi', $user->id_instansi)
            ->where('status', 'AKTIF')
            ->first();

        if (!$instansi) {
            abort(404, 'Instansi user belum ditemukan.');
        }

        $tahun = now()->year;

        $evaluasi = DB::table('evaluasi')
            ->where('id_instansi', $instansi->id_instansi)
            ->where('tahun', $tahun)
            ->first();

        if (!$evaluasi) {
            abort(404, 'Evaluasi tahun berjalan belum tersedia.');
        }

        $indikator = DB::table('indikator_penilaian')
            ->where('id_indikator', $id)
            ->where('status', 'AKTIF')
            ->where('sumber_indikator', 'EKSTERNAL')
            ->first();

        if (!$indikator) {
            abort(404, 'Indikator eksternal tidak ditemukan.');
        }

        $aspek = DB::table('aspek_penilaian')
            ->where('id_aspek', $indikator->id_aspek)
            ->where('status', 'AKTIF')
            ->first();

        $evaluasiIndikator = DB::table('evaluasi_indikator')
            ->where('id_evaluasi', $evaluasi->id_evaluasi)
            ->where('id_indikator', $indikator->id_indikator)
            ->first();

        if (!$evaluasiIndikator) {
            abort(404, 'Data evaluasi indikator belum tersedia.');
        }

        $config = $this->externalConfig($indikator);

        $bukti = DB::table('dokumen_bukti as db')
            ->join(
                'evaluasi_data_dukung as edd',
                'edd.id_evaluasi_data_dukung',
                '=',
                'db.id_evaluasi_data_dukung'
            )
            ->join(
                'data_dukung as dd',
                'dd.id_data_dukung',
                '=',
                'edd.id_data_dukung'
            )
            ->where(
                'edd.id_evaluasi_indikator',
                $evaluasiIndikator->id_evaluasi_indikator
            )
            ->where('dd.id_indikator', $indikator->id_indikator)
            ->where('db.status', 'AKTIF')
            ->orderByDesc('db.versi')
            ->select('db.*')
            ->first();

        $hasSavedResult = in_array(
            $evaluasiIndikator->status_pengisian,
            [
                'TERKIRIM',
                'DIVERIFIKASI',
                'PERLU_PERBAIKAN',
            ],
            true
        );

        $savedRawValue = $evaluasiIndikator->nilai_eksternal;
        $savedLevel = $evaluasiIndikator->level_kematangan;

        return view('user.penilaian.eksternal', [
            'instansi' => $instansi,
            'periode' => null,
            'evaluasi' => $evaluasi,
            'indikator' => $indikator,
            'aspek' => $aspek,
            'evaluasiIndikator' => $evaluasiIndikator,
            'config' => $config,
            'bukti' => $bukti,
            'hasSavedResult' => $hasSavedResult,
            'savedRawValue' => $savedRawValue,
            'savedLevel' => $savedLevel,
        ]);
    }

    public function store(Request $request, $id)
    {
        $user = Auth::user();

        $instansi = DB::table('instansi')
            ->where('id_instansi', $user->id_instansi)
            ->where('status', 'AKTIF')
            ->first();

        if (!$instansi) {
            abort(403, 'Instansi user tidak valid.');
        }

        $tahun = now()->year;

        $evaluasi = DB::table('evaluasi')
            ->where('id_instansi', $instansi->id_instansi)
            ->where('tahun', $tahun)
            ->first();

        if (!$evaluasi) {
            abort(404, 'Evaluasi belum tersedia.');
        }

        $indikator = DB::table('indikator_penilaian')
            ->where('id_indikator', $id)
            ->where('status', 'AKTIF')
            ->where('sumber_indikator', 'EKSTERNAL')
            ->first();

        if (!$indikator) {
            abort(404, 'Indikator eksternal tidak ditemukan.');
        }

        $config = $this->externalConfig($indikator);

        $request->validate([
            'nilai_eksternal' => [
                'required',
                'numeric',
                'min:' . $config['min'],
                'max:' . $config['max'],
            ],

            'dokumen' => [
                'required',
                'file',
                'max:51200',
                'mimes:pdf',
            ],

        ], [
            'nilai_eksternal.required' => 'Nilai eksternal wajib diisi.',
            'nilai_eksternal.numeric' => 'Nilai eksternal harus berupa angka.',
            'nilai_eksternal.min' => 'Nilai eksternal berada di bawah batas minimum.',
            'nilai_eksternal.max' => 'Nilai eksternal melebihi batas maksimum.',
            'dokumen.required' => 'Bukti pendukung wajib diupload.',
            'dokumen.mimes' => 'Bukti pendukung harus berupa file PDF.',
            'dokumen.max' => 'Ukuran bukti pendukung maksimal 50 MB.',
        ]);

        $rawValue = (float) $request->nilai_eksternal;
        $level = $this->convertToLevel($indikator, $rawValue);

        DB::beginTransaction();

        try {

            $evaluasiIndikator = DB::table('evaluasi_indikator')
                ->where('id_evaluasi', $evaluasi->id_evaluasi)
                ->where('id_indikator', $indikator->id_indikator)
                ->lockForUpdate()
                ->first();

            if (!$evaluasiIndikator) {
                DB::rollBack();
                abort(404, 'Data evaluasi indikator belum tersedia.');
            }

            DB::table('evaluasi_indikator')
                ->where(
                    'id_evaluasi_indikator',
                    $evaluasiIndikator->id_evaluasi_indikator
                )
                ->update([
                    'nilai_eksternal' => $rawValue,
                    'nilai' => $level,
                    'level_kematangan' => $level,
                    'status_pengisian' => 'TERKIRIM',
                    'updated_at' => now(),
                ]);

            $dataDukung = DB::table('data_dukung')
                ->where('id_indikator', $indikator->id_indikator)
                ->where('status', 'AKTIF')
                ->where(
                    'nama_data_dukung',
                    'Bukti Pendukung Indikator Eksternal'
                )
                ->first();

            if (!$dataDukung) {

                $idTingkat = DB::table('tingkat_kematangan')
                    ->where('level', 1)
                    ->value('id_tingkat');

                if (!$idTingkat) {
                    DB::rollBack();
                    abort(500, 'Master tingkat kematangan tidak ditemukan.');
                }

                $idDataDukung = DB::table('data_dukung')->insertGetId([
                    'id_indikator' => $indikator->id_indikator,
                    'id_tingkat' => $idTingkat,
                    'nomor' => 1,
                    'nama_data_dukung' => 'Bukti Pendukung Indikator Eksternal',
                    'bobot' => 0,
                    'deskripsi' => 'Bukti pendukung wajib untuk nilai indikator eksternal.',
                    'format_file' => 'pdf',
                    'status' => 'AKTIF',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $dataDukung = DB::table('data_dukung')
                    ->where('id_data_dukung', $idDataDukung)
                    ->first();
            }

            $evaluasiDataDukung = DB::table('evaluasi_data_dukung')
                ->where(
                    'id_evaluasi_indikator',
                    $evaluasiIndikator->id_evaluasi_indikator
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
                        $evaluasiIndikator->id_evaluasi_indikator,

                    'id_data_dukung' =>
                        $dataDukung->id_data_dukung,

                    'status' => 'TERKIRIM',

                    'keterangan' =>
                        'Bukti pendukung penilaian eksternal.',

                    'created_at' => now(),
                    'updated_at' => now(),
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

                DB::table('evaluasi_data_dukung')
                    ->where(
                        'id_evaluasi_data_dukung',
                        $evaluasiDataDukung->id_evaluasi_data_dukung
                    )
                    ->update([
                        'status' => 'TERKIRIM',
                        'keterangan' =>
                            'Bukti pendukung penilaian eksternal.',
                        'updated_at' => now(),
                    ]);
            }

            $versiTerakhir = DB::table('dokumen_bukti')
                ->where(
                    'id_evaluasi_data_dukung',
                    $evaluasiDataDukung->id_evaluasi_data_dukung
                )
                ->max('versi');

            $versi = ($versiTerakhir ?? 0) + 1;

            DB::table('dokumen_bukti')
                ->where(
                    'id_evaluasi_data_dukung',
                    $evaluasiDataDukung->id_evaluasi_data_dukung
                )
                ->where('status', 'AKTIF')
                ->update([
                    'status' => 'DIGANTI'
                ]);

            $file = $request->file('dokumen');

            $path = $file->store(
                'dokumen-bukti/' . $instansi->id_instansi,
                'public'
            );

            DB::table('dokumen_bukti')->insert([
                'id_evaluasi_data_dukung' =>
                    $evaluasiDataDukung->id_evaluasi_data_dukung,

                'uploaded_by' => $user->id_user,

                'file_name' =>
                    $file->getClientOriginalName(),

                'file_path' => $path,

                'file_type' =>
                    $file->getClientMimeType(),

                'file_size' =>
                    $file->getSize(),

                'catatan_user' =>
                    'Bukti pendukung penilaian eksternal.',

                'versi' => $versi,

                'status' => 'AKTIF',

                'created_at' => now(),
            ]);

            // AUDIT LOG
            AuditLog::create([
                'id_user' => Auth::id(),
                'aksi' => 'UPLOAD_DATA_DUKUNG',
                'tabel_target' => 'dokumen_bukti',
                'id_target' => $evaluasiDataDukung->id_evaluasi_data_dukung,
                'deskripsi' => 'Mengunggah dokumen data dukung.',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            DB::commit();

            return redirect()
                ->route('user.penilaian.eksternal', $id)
                ->with(
                    'success',
                    'Penilaian indikator berhasil disimpan.'
                )
                ->with('eksternal_saved', true)
                ->with('eksternal_raw_value', $rawValue)
                ->with('eksternal_level', $level);

        } catch (\Throwable $e) {

            DB::rollBack();

            report($e);

            return back()
                ->withInput()
                ->withErrors([
                    'dokumen' =>
                        'Penilaian gagal disimpan. Silakan coba lagi.',
                ]);
        }
    }

    public function destroyDocument($id)
    {
        $user = Auth::user();

        $instansi = DB::table('instansi')
            ->where('id_instansi', $user->id_instansi)
            ->where('status', 'AKTIF')
            ->first();

        if (!$instansi) {
            abort(403, 'Instansi user tidak valid.');
        }

        $evaluasi = DB::table('evaluasi')
            ->where('id_instansi', $instansi->id_instansi)
            ->where('tahun', now()->year)
            ->first();

        $indikator = DB::table('indikator_penilaian')
            ->where('id_indikator', $id)
            ->where('status', 'AKTIF')
            ->where('sumber_indikator', 'EKSTERNAL')
            ->first();

        if (!$evaluasi || !$indikator) {
            abort(404);
        }

        $document = DB::table('dokumen_bukti as db')
            ->join(
                'evaluasi_data_dukung as edd',
                'edd.id_evaluasi_data_dukung',
                '=',
                'db.id_evaluasi_data_dukung'
            )
            ->join(
                'evaluasi_indikator as ei',
                'ei.id_evaluasi_indikator',
                '=',
                'edd.id_evaluasi_indikator'
            )
            ->where(
                'db.id_dokumen',
                request()->route('document')
            )
            ->where('db.status', 'AKTIF')
            ->where('ei.id_evaluasi', $evaluasi->id_evaluasi)
            ->where('ei.id_indikator', $indikator->id_indikator)
            ->select('db.*')
            ->first();

        if (!$document) {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        DB::table('dokumen_bukti')
            ->where('id_dokumen', $document->id_dokumen)
            ->update([
                'status' => 'DIHAPUS'
            ]);

        DB::table('evaluasi_data_dukung as edd')
            ->join(
                'dokumen_bukti as db',
                'db.id_evaluasi_data_dukung',
                '=',
                'edd.id_evaluasi_data_dukung'
            )
            ->where('db.id_dokumen', $document->id_dokumen)
            ->update([
                'edd.status' => 'BELUM_DIISI',
                'edd.updated_at' => now()
            ]);

        DB::table('evaluasi_indikator')
            ->where('id_evaluasi_indikator', function ($query) use ($document) {

                $query->select('edd.id_evaluasi_indikator')
                    ->from('evaluasi_data_dukung as edd')
                    ->where(
                        'edd.id_evaluasi_data_dukung',
                        $document->id_evaluasi_data_dukung
                    );
            })
            ->update([
                'nilai_eksternal' => null,
                'nilai' => 1,
                'level_kematangan' => 1,
                'status_pengisian' => 'BELUM_DIISI',
                'updated_at' => now(),
            ]);

        // AUDIT LOG
        AuditLog::create([
            'id_user' => Auth::id(),
            'aksi' => 'HAPUS_DOKUMEN',
            'tabel_target' => 'dokumen_bukti',
            'id_target' => $document->id_dokumen,
            'deskripsi' => 'Menghapus bukti pendukung penilaian eksternal.',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()
            ->route('user.penilaian.eksternal', $id)
            ->with(
                'success',
                'Bukti pendukung dihapus. Silakan upload kembali karena bukti wajib.'
            );
    }
}