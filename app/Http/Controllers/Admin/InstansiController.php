<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index(Request $request)
        {
            $query = Instansi::with('users.role');

            // ------FILTER------ //
            //filter kategori dari admin untuk menampilkan instansi sesuai kategori yang dipilih
            if ($request->filled('kategori')) {
                $query->where('kategori', $request->kategori);
            }
            //filter status dari admin untuk menampilkan instansi sesuai status yang dipilih
            if($request->filled('status')){
                $query->where('status', $request->status);
            }
            //filter search
            if ($request->filled('search')) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q ->where('nama_instansi', 'like', "%{$search}%");
                    $q ->orWhere('kode_instansi', 'like', "%{$search}%");
                });
            }

            //mengambil data instansi, mengurutkan data, membatasi jml yg ditampilkan menjadi 7
            $instansi = $query->orderBy('id_instansi', 'asc')->paginate(7)->withQueryString();
            return view ('admin.instansi.index', ['instansi' => $instansi]);
        }
    public function create()
    {
        return view('admin.instansi.create');
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'kode_instansi' => 'required|string|max:50|unique:instansi,kode_instansi',
            'kategori' => 'required|string|max:100',
            'website' => 'nullable|url|max:255',
            'alamat' => 'nullable|string|max:255',
            'status' => 'required|in:AKTIF,NONAKTIF',
        ]);

        // Simpan data instansi ke database.
        $instansi = Instansi::create($validatedData);

        // Catat aktivitas admin ke audit log.
        AuditLog::create([
            'id_user' => auth()->id(),
            'aksi' => 'TAMBAH',
            'tabel_target' => 'instansi',
            'id_target' => $instansi->id_instansi,
            'deskripsi' => 'Menambahkan instansi ' . $instansi->nama_instansi,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Redirect ke halaman index dengan pesan sukses.
        return redirect()
            ->route('admin.instansi.index')
            ->with('success', 'Instansi berhasil ditambahkan.');
    }

    public function edit($id_instansi)
{
    // Ambil data instansi yang akan diedit.
    $instansi = Instansi::findOrFail($id_instansi);

    return view('admin.instansi.edit', [
        'instansi' => $instansi,
    ]);
}

    public function update(Request $request, $id_instansi)
    {
        // Cari instansi yang akan diperbarui.
        $instansi = Instansi::findOrFail($id_instansi);

        // Validasi data yang dikirim dari form edit.
        $validatedData = $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'kode_instansi' => 'required|string|max:50|unique:instansi,kode_instansi,' . $id_instansi . ',id_instansi',
            'kategori' => 'required|string|max:100',
            'website' => 'nullable|url|max:255',
            'alamat' => 'nullable|string|max:255',
            'status' => 'required|in:AKTIF,NONAKTIF',
        ]);

        // Simpan perubahan data instansi.
        $instansi->update($validatedData);

        // Catat aktivitas admin ke audit log.
        AuditLog::create([
            'id_user' => auth()->id(),
            'aksi' => 'UBAH',
            'tabel_target' => 'instansi',
            'id_target' => $instansi->id_instansi,
            'deskripsi' => 'Mengubah data instansi ' . $instansi->nama_instansi,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()
            ->route('admin.instansi.show', $instansi->id_instansi)
            ->with('success', 'Data instansi berhasil diperbarui.');
    }
    public function show($id_instansi)
    {
        // Cari satu instansi berdasarkan ID yang dikirim dari URL
        $instansi = Instansi::with('users.role')->findOrFail($id_instansi);

        // Kirim data instansi ke halaman detail
        return view('admin.instansi.show', ['instansi' => $instansi]);
    }
}
