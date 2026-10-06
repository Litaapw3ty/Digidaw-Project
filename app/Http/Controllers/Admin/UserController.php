<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Instansi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data user sekaligus relasi role dan instansi.
        $query = User::with(['role', 'instansi']);

        // FILTER ROLE
        if ($request->filled('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('nama_role', $request->role);
            });
        }

        // FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // SORTING + PAGINATION
        $users = $query
            ->orderBy('id_user', 'asc')
            ->paginate(7)
            ->withQueryString();

        return view('admin.user.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        // Ambil instansi aktif untuk pilihan pada form.
        $instansi = Instansi::where('status', 'AKTIF')
            ->orderBy('nama_instansi')
            ->get();

        // Ambil semua role untuk pilihan peran user.
        $roles = Role::orderBy('nama_role')
            ->get();

        return view('admin.user.create', [
            'instansi' => $instansi,
            'roles' => $roles,
        ]);
    }

    public function show($id_user)
    {
        // Cari satu user berdasarkan ID sekaligus mengambil relasi role dan instansi.
        $user = User::with(['role', 'instansi'])
            ->findOrFail($id_user);

        return view('admin.user.show', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi semua data yang dikirim dari form.
        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'required|email|max:150|unique:users,email',

            'no_hp' => 'nullable|string|max:30',
            'nip' => 'nullable|string|max:50',

            'unit_kerja' => 'nullable|string|max:150',
            'jabatan' => 'required|string|max:150',

            'id_instansi' => 'required|exists:instansi,id_instansi',
            'id_role' => 'required|exists:roles,id_role',

            'status' => 'required|in:AKTIF,NONAKTIF',

            // Password minimal 8 karakter dan harus mengandung
            // huruf, angka, dan simbol.
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'regex:/[^A-Za-z0-9]/',
                'confirmed',
            ],
        ]);

        // Simpan user baru ke database.
        // Password akan otomatis di-hash karena User model
        // menggunakan cast 'hashed'.
        User::create($validatedData);

        // Setelah berhasil, kembali ke halaman Data User.
        return redirect()
            ->route('admin.user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }
    public function edit($id_user)
    {
        // Ambil user yang akan diedit beserta role dan instansinya.
        $user = User::with(['role', 'instansi'])
            ->findOrFail($id_user);

        // Ambil instansi aktif untuk pilihan pada form.
        $instansi = Instansi::where('status', 'AKTIF')
            ->orderBy('nama_instansi')
            ->get();

        // Ambil semua role untuk pilihan peran user.
        $roles = Role::orderBy('nama_role')
            ->get();

        return view('admin.user.edit', [
            'user' => $user,
            'instansi' => $instansi,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id_user)
    {
        // Cari user yang akan diperbarui.
        $user = User::findOrFail($id_user);

        $validatedData = $request->validate([
            'name' => 'required|string|max:150',
            'username' => 'required|string|max:100|unique:users,username,' . $id_user . ',id_user',
            'email' => 'required|email|max:150|unique:users,email,' . $id_user . ',id_user',

            'no_hp' => 'nullable|string|max:30',
            'nip' => 'nullable|string|max:50',

            'unit_kerja' => 'nullable|string|max:150',
            'jabatan' => 'required|string|max:150',

            'id_instansi' => 'required|exists:instansi,id_instansi',
            'id_role' => 'required|exists:roles,id_role',

            'status' => 'required|in:AKTIF,NONAKTIF',

            // Password dibuat optional saat edit.
            // Kalau kosong, password lama tetap digunakan.
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/[A-Za-z]/',
                'regex:/[0-9]/',
                'regex:/[^A-Za-z0-9]/',
                'confirmed',
            ],
        ]);

        // Kalau password kosong, jangan timpa password lama.
        if (empty($validatedData['password'])) {
            unset($validatedData['password']);
        }

        // Simpan perubahan user.
        // Password baru otomatis di-hash oleh cast 'hashed'
        // pada model User.
        $user->update($validatedData);

        return redirect()
            ->route('admin.user.show', $user->id_user)
            ->with('success', 'Data user berhasil diperbarui.');
    }
}