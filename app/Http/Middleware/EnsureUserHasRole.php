<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

//berfungsi untuk memeriksa role user yang sedang login, dipakai di route group per role
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Ambil role user yang lagi login. Relasi role() sudah ada
        // di Model User (belongsTo Role), jadi tinggal panggil.
        $roleUserSaatIni = $request->user()?->role?->nama_role;

        // Kalau role-nya tidak ada di daftar yang diizinkan -> tolak akses (403)
        if (! in_array($roleUserSaatIni, $roles)) {
            abort(403, 'Kamu tidak punya akses ke halaman ini.');
        }

        // Kalau lolos, lanjut ke halaman yang dituju
        return $next($request);
    }
}
