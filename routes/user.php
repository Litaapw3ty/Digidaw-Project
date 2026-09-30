<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PenilaianMandiriController;
use App\Http\Controllers\User\PenilaianInternalController;
use App\Http\Controllers\User\PenilaianEksternalController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Penilaian Mandiri
|--------------------------------------------------------------------------
*/

Route::get('/penilaian', [PenilaianMandiriController::class, 'index'])
    ->name('penilaian');


/*
|--------------------------------------------------------------------------
| Penilaian Internal
|--------------------------------------------------------------------------
*/

Route::get('/penilaian/internal/{id}', [PenilaianInternalController::class, 'show'])
    ->name('penilaian.internal');


/*
|--------------------------------------------------------------------------
| Upload Data Dukung
|--------------------------------------------------------------------------
*/

Route::post('/penilaian/internal/{id}/upload', [PenilaianInternalController::class, 'upload'])
    ->name('penilaian.internal.upload');


/*
|--------------------------------------------------------------------------
| Edit Data Dukung
|--------------------------------------------------------------------------
*/

Route::put('/penilaian/internal/{id}/edit/{dataDukung}', [PenilaianInternalController::class, 'update'])
    ->name('penilaian.internal.edit.update');


/*
|--------------------------------------------------------------------------
| Hapus Dokumen
|--------------------------------------------------------------------------
*/

Route::delete(
    '/penilaian/internal/{id}/edit/{dataDukung}/document/{document}',
    [PenilaianInternalController::class, 'destroyDocument']
)->name('penilaian.internal.document.destroy');


/*
|--------------------------------------------------------------------------
| Penilaian Eksternal
|--------------------------------------------------------------------------
*/

Route::get('/penilaian/eksternal/{id}', [PenilaianEksternalController::class, 'show'])
    ->name('penilaian.eksternal');

Route::post('/penilaian/eksternal/{id}', [PenilaianEksternalController::class, 'store'])
    ->name('penilaian.eksternal.store');

Route::delete('/penilaian/eksternal/{id}/bukti', [PenilaianEksternalController::class, 'destroyBukti'])
    ->name('penilaian.eksternal.bukti.destroy');

/*
|--------------------------------------------------------------------------
| Monitoring
|--------------------------------------------------------------------------
*/

Route::get('/monitoring', function () {
    return view('user.monitoring');
})->name('monitoring');


/*
|--------------------------------------------------------------------------
| Laporan
|--------------------------------------------------------------------------
*/

Route::get('/laporan', function () {
    return view('user.laporan');
})->name('laporan');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::get('/profile', [UserProfileController::class, 'index'])
    ->name('profile');

Route::get('/profile/edit', [UserProfileController::class, 'edit'])
    ->name('profile.edit');

Route::put('/profile', [UserProfileController::class, 'update'])
    ->name('profile.update');

Route::post('/profile/foto', [UserProfileController::class, 'updateFoto'])
    ->name('profile.foto.update');

Route::delete('/profile/foto', [UserProfileController::class, 'deleteFoto'])
    ->name('profile.foto.delete');

/*
|--------------------------------------------------------------------------
| Periode
|--------------------------------------------------------------------------
*/

Route::get('/periode', function () {
    return view('user.periode');
})->name('periode');


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');