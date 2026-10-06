<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AsesorController;
use App\Http\Controllers\Admin\MonitoringPenilaianController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\HasilEvaluasiController;
use App\Http\Controllers\Admin\PeriodeController;

use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.index');

Route::get('/instansi/create', [InstansiController::class, 'create'])->name('instansi.create');
Route::post('/instansi', [InstansiController::class, 'store'])->name('instansi.store');
Route::get('/instansi/{id_instansi}/edit', [InstansiController::class, 'edit'])->name('instansi.edit');
Route::put('/instansi/{id_instansi}', [InstansiController::class, 'update'])->name('instansi.update');
Route::get('/instansi/{id_instansi}', [InstansiController::class, 'show'])->name('instansi.show');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{id_user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id_user}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/{id_user}', [UserController::class, 'show'])->name('user.show');

Route::get('/asesor', [AsesorController::class, 'index'])->name('asesor.index');
Route::get('/asesor/create', [AsesorController::class, 'create'])->name('asesor.create');
Route::post('/asesor', [AsesorController::class, 'store'])->name('asesor.store');
Route::get('/asesor/{id_asesor}/edit', [AsesorController::class, 'edit'])->name('asesor.edit');
Route::put('/asesor/{id_asesor}', [AsesorController::class, 'update'])->name('asesor.update');
Route::patch('/asesor/{id_asesor}/toggle-status', [AsesorController::class, 'toggleStatus'])->name('asesor.toggle-status');
Route::get('/asesor/{id_asesor}', [AsesorController::class, 'show'])->name('asesor.show');

Route::get('/monitoring-penilaian', [MonitoringPenilaianController::class, 'index'])->name('monitoring-penilaian.index');

Route::get('/hasil-verifikasi', [VerifikasiController::class, 'index'])->name('hasil-verifikasi.index');

Route::get('/hasil-evaluasi', [HasilEvaluasiController::class, 'index'])->name('hasil-evaluasi.index');
Route::put('/hasil-evaluasi/target', [HasilEvaluasiController::class, 'updateTarget'])->name('hasil-evaluasi.target.update');

Route::get('/pengaturan', [PeriodeController::class, 'index'])->name('pengaturan.index');
Route::put('/pengaturan', [PeriodeController::class, 'update'])->name('pengaturan.update');