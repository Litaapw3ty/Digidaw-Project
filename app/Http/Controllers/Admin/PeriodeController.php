<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodeEvaluasi;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Menampilkan halaman pengaturan periode evaluasi.
     */
    public function index()
    {
        // Ambil periode dengan tahun anggaran terbaru.
        // Ini memungkinkan Admin mengatur periode tahun berjalan
        // maupun periode tahun berikutnya.
        $periode = PeriodeEvaluasi::query()
            ->orderByDesc('tahun_anggaran')
            ->first();

        return view('admin.periode.index', [
            'periode' => $periode,
        ]);
    }
    /**
     * Menyimpan perubahan periode evaluasi.
     */
    public function update(Request $request)
    {
        // Validasi data yang dikirim dari form.
        $validatedData = $request->validate([
            'tahun_anggaran' => 'required|integer|min:2000|max:2100',

            'tanggal_mulai_pengisian' => 'required|date',

            'tanggal_selesai_pengisian' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai_pengisian',
            ],

            'status_pengisian_aktif' => 'required|boolean',

            'tanggal_mulai_asesor' => 'required|date',

            'tanggal_selesai_asesor' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai_asesor',
            ],
        ]);

        // Cari periode berdasarkan tahun anggaran.
        // Kalau belum ada, buat periode baru.
        $periode = PeriodeEvaluasi::updateOrCreate(
            [
                'tahun_anggaran' => $validatedData['tahun_anggaran'],
            ],
            $validatedData
        );

        return redirect()
            ->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan sistem berhasil diperbarui.');
    }
}