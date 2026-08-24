<?php

use App\Http\Controllers\User\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/evaluasi', [EvaluasiController::class, 'index'])->name('evaluasi.index');
// Route::get('/evaluasi/{id}/upload', [DataDukungController::class, 'upload'])->name('evaluasi.upload');
