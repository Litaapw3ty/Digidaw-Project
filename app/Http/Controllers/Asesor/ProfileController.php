<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
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
                'u.profile_photo_path',
                'a.nip',
                'a.jabatan',
                'a.unit_kerja',
                'a.wilayah',
                'a.status as status_asesor'
            )
            ->first();

        if ($user) {
            $user->profile_photo_url = !empty($user->profile_photo_path)
                && file_exists(public_path($user->profile_photo_path))
                ? asset($user->profile_photo_path)
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
                'u.profile_photo_path',
                'a.nip',
                'a.jabatan',
                'a.unit_kerja',
                'a.wilayah'
            )
            ->first();

        if ($user) {
            $user->profile_photo_url = !empty($user->profile_photo_path)
                && file_exists(public_path($user->profile_photo_path))
                ? asset($user->profile_photo_path)
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

        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD
        |--------------------------------------------------------------------------
        */
        if ($request->filled('password')) {
            $updateUser['password'] = Hash::make($request->password);
        }

        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO PROFIL
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('avatar')) {

            $currentUser = DB::table('users')
                ->where('id_user', $userId)
                ->first();

            /*
            | Hapus foto lama jika memang ada
            */
            if (
                !empty($currentUser->profile_photo_path) &&
                $currentUser->profile_photo_path !== 'asesor_img/default-profile.svg' &&
                file_exists(public_path($currentUser->profile_photo_path))
            ) {
                unlink(public_path($currentUser->profile_photo_path));
            }

            /*
            | Folder penyimpanan
            */
            $directory = 'asesor_img/profile';
            $destination = public_path($directory);

            if (!is_dir($destination)) {
                mkdir($destination, 0777, true);
            }

            /*
            | Nama file
            */
            $file = $request->file('avatar');

            $filename = 'avatar-' . $userId . '-' . time() . '.' .
                $file->getClientOriginalExtension();

            /*
            | Pindahkan file ke public/asesor_img/profile
            */
            $file->move($destination, $filename);

            /*
            | Simpan lokasi file ke database
            */
            $updateUser['profile_photo_path'] =
                $directory . '/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA USER
        |--------------------------------------------------------------------------
        */
        DB::table('users')
            ->where('id_user', $userId)
            ->update($updateUser);

        /*
        |--------------------------------------------------------------------------
        | AUDIT LOG
        |--------------------------------------------------------------------------
        */
        AuditLog::record(
            'PERBARUI_PROFIL',
            'users',
            $userId,
            'Asesor memperbarui informasi profil.'
        );

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('asesor.profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
