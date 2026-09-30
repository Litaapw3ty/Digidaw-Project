<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    /**
     * Menampilkan profile user.
     */
    public function index()
    {
        $user = Auth::user()->load([
            'role',
            'instansi',
        ]);

        return view('user.profile', compact('user'));
    }

    /**
     * Menampilkan halaman edit profile.
     */
    public function edit()
    {
        $user = Auth::user()->load([
            'role',
            'instansi',
        ]);

        return view('user.profile.profile-edit', compact('user'));
    }

    /**
     * Update profile user.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id_user, 'id_user'),
            ],

            'foto_profil' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'password_lama' => [
                'nullable',
                'string',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' =>
                'Nama lengkap wajib diisi.',

            'name.max' =>
                'Nama lengkap maksimal 255 karakter.',

            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'email.unique' =>
                'Email sudah digunakan.',

            'foto_profil.image' =>
                'File foto harus berupa gambar.',

            'foto_profil.mimes' =>
                'Format foto harus JPG, JPEG, PNG, atau WEBP.',

            'foto_profil.max' =>
                'Ukuran foto maksimal 2 MB.',

            'password.min' =>
                'Password baru minimal 8 karakter.',

            'password.confirmed' =>
                'Konfirmasi password tidak cocok.',
        ]);

        // Update data dasar
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // ==========================================
        // UPDATE FOTO PROFILE
        // ==========================================
        if ($request->hasFile('foto_profil')) {

            // Hapus foto lama
            if (
                $user->foto_profil &&
                Storage::disk('public')->exists($user->foto_profil)
            ) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Simpan foto baru
            $path = $request
                ->file('foto_profil')
                ->store('profile', 'public');

            $user->foto_profil = $path;
        }

        // ==========================================
        // UPDATE PASSWORD
        // ==========================================
        if (!empty($validated['password'])) {

            if (empty($validated['password_lama'])) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'password_lama' =>
                            'Password lama wajib diisi untuk mengubah password.',
                    ]);
            }

            if (!Hash::check(
                $validated['password_lama'],
                $user->password
            )) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'password_lama' =>
                            'Password lama tidak sesuai.',
                    ]);
            }

            $user->password = Hash::make(
                $validated['password']
            );
        }

        $user->save();

        return redirect()
            ->route('user.profile')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    /**
     * Update foto profile.
     *
     * Tetap disediakan jika nantinya ingin upload foto
     * melalui form terpisah.
     */
    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto_profil' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'foto_profil.required' =>
                'Silakan pilih foto profile.',

            'foto_profil.image' =>
                'File harus berupa gambar.',

            'foto_profil.mimes' =>
                'Format foto harus JPG, JPEG, PNG, atau WEBP.',

            'foto_profil.max' =>
                'Ukuran foto maksimal 2 MB.',
        ]);

        $user = Auth::user();

        // Hapus foto lama
        if (
            $user->foto_profil &&
            Storage::disk('public')->exists($user->foto_profil)
        ) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        // Simpan foto baru
        $path = $request
            ->file('foto_profil')
            ->store('profile', 'public');

        $user->foto_profil = $path;
        $user->save();

        return back()->with(
            'success',
            'Foto profile berhasil diperbarui.'
        );
    }

    /**
     * Hapus foto profile user.
     */
    public function deleteFoto()
    {
        $user = Auth::user();

        if (
            $user->foto_profil &&
            Storage::disk('public')->exists($user->foto_profil)
        ) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        $user->foto_profil = null;
        $user->save();

        return back()->with(
            'success',
            'Foto profile berhasil dihapus.'
        );
    }
}