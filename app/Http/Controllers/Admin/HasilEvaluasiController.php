<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodeEvaluasi;
use Illuminate\Http\Request;

class HasilEvaluasiController extends Controller
{
    /**
     * Menampilkan halaman hasil evaluasi.
     */
    public function index()
    {
        // Mengambil periode terbaru yang sudah dikonfigurasi.
        // Data ini digunakan untuk menampilkan target nasional.
        $periode = PeriodeEvaluasi::query()
            ->orderByDesc('tahun_anggaran')
            ->first();

        return view('admin.hasil-evaluasi.index', [
            'periode' => $periode,
        ]);
    }

    /**
     * Menyimpan target indeks nasional.
     */
    public function updateTarget(Request $request)
    {
        // Validasi data target yang diinput Admin.
        $validatedData = $request->validate([
            'tahun_anggaran' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'target_indeks_nasional' => [
                'required',
                'numeric',
                'min:0',
                'max:5',
            ],
        ]);

        // Simpan target berdasarkan tahun anggaran.
        // Kalau tahun tersebut sudah ada, datanya diperbarui.
        PeriodeEvaluasi::updateOrCreate(
            [
                'tahun_anggaran' => $validatedData['tahun_anggaran'],
            ],
            [
                'target_indeks_nasional' => $validatedData['target_indeks_nasional'],
            ]
        );

        return redirect()
            ->route('admin.hasil-evaluasi.index')
            ->with('success', 'Target nasional berhasil diperbarui.');
    }
}