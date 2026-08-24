<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * Catatan: role default selalu 'USER'. Akun ASESOR/ADMIN sengaja
     * TIDAK bisa dibuat lewat form registrasi publik ini -- harus dibuat
     * oleh Admin lewat panel manajemen user (atau tinker/seeder saat
     * development).
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $idRoleUser = Role::where('nama_role', 'USER')->value('id_role');

        // Kolom `username` di tabel users NOT NULL tanpa default -- generate
        // otomatis dari bagian lokal email, pastikan unik (tambah angka kalau bentrok).
        $baseUsername = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', strstr($request->email, '@', true)));
        $username = $baseUsername;
        $suffix = 1;
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername.$suffix;
            $suffix++;
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_role' => $idRoleUser,
            'status' => 'AKTIF',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
