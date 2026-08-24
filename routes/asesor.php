<?php

use App\Http\Controllers\Asesor\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/instansi-binaan', [InstansiBinaanController::class, 'index'])->name('instansi.index');
// Route::get('/verifikasi/{id}', [VerifikasiController::class, 'show'])->name('verifikasi.show');
