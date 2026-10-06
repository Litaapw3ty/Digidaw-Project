<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class VerifikasiController extends Controller
{
    /**
     * Menampilkan halaman hasil verifikasi bukti.
     *
     * Untuk tahap awal kita fokus membangun struktur halaman
     * terlebih dahulu. Data verifikasi akan kita sambungkan
     * setelah tampilan dasarnya sudah sesuai desain.
     */
    public function index()
    {
        return view('admin.hasil-verifikasi.index');
    }
}