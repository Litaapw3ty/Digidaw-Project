<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Nanti di sini bisa ditambah data beneran, contoh:
        // $totalUser = \App\Models\User::count();
        // $totalInstansi = \App\Models\Instansi::count();
        // return view('admin.dashboard', compact('totalUser', 'totalInstansi'));

        return view('admin.dashboard');
    }
}
