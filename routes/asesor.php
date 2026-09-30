<?php

use App\Http\Controllers\Asesor\DashboardController;
use App\Http\Controllers\Asesor\AktivitasController;
use App\Http\Controllers\Asesor\ProfileController;
use App\Http\Controllers\Asesor\VerifikasiController;
use App\Http\Controllers\Asesor\PanduanController;
use App\Http\Controllers\Asesor\MonitoringController;
use Illuminate\Support\Facades\Route;


// =====================================================
// DASHBOARD
// =====================================================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


// =====================================================
// VERIFIKASI
// =====================================================

Route::middleware(['auth'])->group(function () {

    Route::get('/verifikasi', [VerifikasiController::class, 'verifikasiBukti'])
        ->name('verifikasi');

    Route::get('/verifikasi/{id_instansi}', [VerifikasiController::class, 'detailPenilaian'])
        ->name('verifikasi.detail');

    Route::get('/verifikasi/{id_instansi}/indikator', [VerifikasiController::class, 'detailPenilaian'])
        ->name('verifikasi.indikator');

    Route::get('/verifikasi/{id_instansi}/indikator/{no_indikator}', [VerifikasiController::class, 'showIndikator'])
        ->name('verifikasi.show');

    Route::post(
        '/verifikasi/{id_instansi}/indikator/{no_indikator}/verifikasi/{id_data_dukung}',
        [VerifikasiController::class, 'verify']
    )->name('verifikasi.verify');

    Route::get(
        '/verifikasi/{id_instansi}/detail/{no_indikator}/{id_data_dukung}',
        [VerifikasiController::class, 'showVerificationDetail']
    )->name('verifikasi.detail.page');
});


// =====================================================
// MONITORING
// =====================================================

Route::get('/monitoring', [MonitoringController::class, 'index'])
    ->name('monitoring');

Route::get('/monitoring/{id_instansi}', [MonitoringController::class, 'detail'])
    ->name('monitoring.detail');


// =====================================================
// KELOLA PANDUAN
// =====================================================

Route::prefix('kelola_panduan')->group(function () {

    Route::get('/', [PanduanController::class, 'index'])
        ->name('kelola_panduan');

    Route::get('/{idAspek}', [PanduanController::class, 'detail'])
        ->name('panduan.detail');

    Route::get(
        '/{idAspek}/indikator/{idIndikator}/data-dukung/{idDataDukung}/upload',
        [PanduanController::class, 'create']
    )->name('panduan.upload');

    Route::post(
        '/upload',
        [PanduanController::class, 'store']
    )->name('panduan.store');

Route::delete(
    '/panduan/{id}',
    [PanduanController::class, 'destroy']
)->name('panduan.destroy');

Route::get(
    '/panduan/{id}/file',
    [PanduanController::class, 'file']
)->name('panduan.file');

});



// =====================================================
// AKTIVITAS
// =====================================================

Route::get('/aktivitas', [AktivitasController::class, 'index'])
    ->name('aktivitas');


// =====================================================
// PROFILE
// =====================================================

Route::get('/profil', [ProfileController::class, 'index'])
    ->name('profil');


// =====================================================
// EDIT PROFILE
// =====================================================

Route::get('/edit_asesor', [ProfileController::class, 'edit'])
    ->name('edit');

Route::put('/edit_asesor', [ProfileController::class, 'update'])
    ->name('edit.update');


// =====================================================
// PERIODE
// =====================================================

Route::get('/periode', function () {
    return view('asesor.periode');
})->name('periode');


// =====================================================
// INDIKATOR
// =====================================================

// Route::get('/indikator', function () {
//     return view('asesor.indikator');
// })->name('indikator');