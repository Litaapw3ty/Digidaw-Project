<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home');})->name('home');

Route::middleware('auth')->get('/dashboard', function () {
    $role = auth()->user()->role->nama_role;

    return match ($role) {
        'ADMIN' => redirect()->route('admin.dashboard'),
        'ASESOR' => redirect()->route('asesor.dashboard'),
        'USER' => redirect()->route('user.dashboard'),
        default => abort(403),
    };
})->name('dashboard');

// Grup route per role
Route::middleware(['auth', 'role:ADMIN'])
    ->prefix('admin')
    ->name('admin.')
    ->group(base_path('routes/admin.php'));

Route::middleware(['auth', 'role:ASESOR'])
    ->prefix('asesor')
    ->name('asesor.')
    ->group(base_path('routes/asesor.php'));

Route::middleware(['auth', 'role:USER'])
    ->prefix('user')
    ->name('user.')
    ->group(base_path('routes/user.php'));


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
