<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AktivitasController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $query = DB::table('audit_log')
            ->where('id_user', $userId);

        // Filter berdasarkan jenis jika ada
        if ($request->filled('jenis')) {
            $query->where('aksi', 'LIKE', '%' . $request->jenis . '%');
        }

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Pencarian keyword jika ada
        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('aksi', 'LIKE', '%' . $request->q . '%')
                  ->orWhere('deskripsi', 'LIKE', '%' . $request->q . '%');
            });
        }

        $aktivitasList = $query->orderBy('created_at', 'desc')->paginate(6);

        return view('asesor.aktivitas', compact('aktivitasList'));
    }
}