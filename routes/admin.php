<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// File ini otomatis kepasang prefix 'admin' dan middleware auth+role:ADMIN
// dari routes/web.php, jadi di sini cukup nulis path-nya aja (tanpa /admin di depan)

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Nanti tambah di sini kalau bikin fitur baru, contoh:
// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.index');
