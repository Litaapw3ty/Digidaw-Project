<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Menampilkan Halaman Profil Asesor
     */
    public function index()
    {
        $userId = Auth::id();

        $user = DB::table('users as u')
            ->leftJoin('asesor as a', 'u.id_user', '=', 'a.id_user')
            ->where('u.id_user', $userId)
            ->select(
                'u.id_user',
                'u.name',
                'u.email',
                'u.created_at',
                'u.foto_profile',
                'a.nip',
                'a.jabatan',
                'a.unit_kerja',
                'a.wilayah',
                'a.status as status_asesor'
            )
            ->first();

        if ($user) {
            $user->profile_photo_url = ! empty($user->foto_profile) && file_exists(public_path($user->foto_profile))
                ? asset($user->foto_profile)
                : asset('asesor_img/default-profile.svg');
        }

        return view('asesor.profil', compact('user'));
    }

    /**
     * Menampilkan Form Edit Profil Asesor
     */
    public function edit()
    {
        $userId = Auth::id();

        $user = DB::table('users as u')
            ->leftJoin('asesor as a', 'u.id_user', '=', 'a.id_user')
            ->where('u.id_user', $userId)
            ->select(
                'u.id_user',
                'u.name',
                'u.email',
                'u.foto_profile',
                'a.nip',
                'a.jabatan',
                'a.unit_kerja',
                'a.wilayah'
            )
            ->first();

        if ($user) {
            $user->profile_photo_url = ! empty($user->foto_profile) && file_exists(public_path($user->foto_profile))
                ? asset($user->foto_profile)
                : asset('asesor_img/default-profile.svg');
        }

        return view('asesor.edit_asesor', compact('user'));
    }

    /**
     * Memproses Perubahan Data Profil
     */
    public function update(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'password' => 'nullable|min:6|confirmed',
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $updateUser = [
            'name'       => $request->name,
            'email'      => $request->email,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $updateUser['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $currentUser = DB::table('users')->where('id_user', $userId)->first();

            if (! empty($currentUser->foto_profile) && $currentUser->foto_profile !== 'asesor_img/default-profile.svg' && file_exists(public_path($currentUser->foto_profile))) {
                unlink(public_path($currentUser->foto_profile));
            }

            $file = $request->file('avatar');
            $filename = 'avatar-'.$userId.'-'.time().'.'.$file->getClientOriginalExtension();
            $directory = 'asesor_img/profile';
            $destination = public_path($directory);

            if (! is_dir($destination)) {
                mkdir($destination, 0777, true);
            }

            $file->move($destination, $filename);
            $updateUser['foto_profile'] = $directory.'/'.$filename;
        }

        DB::table('users')
            ->where('id_user', $userId)
            ->update($updateUser);

        return redirect()->route('asesor.profil')->with('success', 'Profil berhasil diperbarui!');
    }
}