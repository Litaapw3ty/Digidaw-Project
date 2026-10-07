<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['role', 'instansi']);
        $aktivitas = DB::table('audit_log')
            ->where('id_user', Auth::id())
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('user.dashboard', compact('user', 'aktivitas'));
    }

}
