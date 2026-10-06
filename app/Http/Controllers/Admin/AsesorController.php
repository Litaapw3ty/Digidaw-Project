<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asesor;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Role;
use App\Models\Wilayah;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsesorController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data asesor sekaligus relasi user dan instansi.
        $query = Asesor::with(['user', 'instansi']);

        // FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Cari berdasarkan ID asesor.
                $q->where('id_asesor', 'like', "%{$search}%")

                    // Atau cari berdasarkan nama user yang menjadi asesor.
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // SORTING + PAGINATION
        $asesors = $query
            ->orderBy('id_asesor', 'asc')
            ->paginate(7)
            ->withQueryString();

        // Kirim data asesor ke halaman index.
        return view('admin.asesor.index', [
            'asesors' => $asesors,
        ]);
    }
    public function create()
    {
        // Ambil user yang memiliki role ASESOR.
        $users = User::whereHas('role', function ($query) {
            $query->where('nama_role', 'ASESOR');
        })
            ->orderBy('name')
            ->get();

        // Ambil instansi aktif untuk pilihan pada form.
        $instansi = Instansi::where('status', 'AKTIF')
            ->orderBy('nama_instansi')
            ->get();

        // Ambil semua wilayah untuk pilihan penugasan asesor.
        $wilayah = Wilayah::orderBy('nama_wilayah')
            ->get();

        return view('admin.asesor.create', [
            'users' => $users,
            'instansi' => $instansi,
            'wilayah' => $wilayah,
        ]);
    }
        public function store(Request $request)
        {
            // Validasi data yang dikirim dari form Tambah Asesor.
            $validatedData = $request->validate([

                // ==========================
                // DATA AKUN
                // ==========================
                'name' => 'required|string|max:150',

                'email' => 'required|email|max:150|unique:users,email',

                'status' => 'required|in:AKTIF,NONAKTIF',


                // ==========================
                // DATA KEDINASAN
                // ==========================
                'nip' => 'required|string|max:50',

                'id_instansi' => 'required|exists:instansi,id_instansi',

                'unit_kerja' => 'nullable|string|max:200',


                // ==========================
                // ASPEK PENILAIAN
                // ==========================
                // Asesor wajib memilih minimal satu aspek.
                'keahlian' => 'required|array|min:1',

                // Setiap aspek harus menggunakan kode aspek
                // yang sudah kita tentukan.
                'keahlian.*' => [
                    'required',
                    'string',
                    'in:ASPEK_1,ASPEK_2,ASPEK_3,ASPEK_4,ASPEK_5,ASPEK_6,ASPEK_7',
                ],


                // ==========================
                // WILAYAH PENUGASAN
                // ==========================
                // Wilayah boleh kosong jika asesor belum
                // memiliki wilayah penugasan tertentu.
                'wilayah' => 'nullable|array',

                // Setiap wilayah harus benar-benar ada
                // di tabel wilayah.
                'wilayah.*' => [
                    'integer',
                    'exists:wilayah,id_wilayah',
                ],


                // ==========================
                // PASSWORD
                // ==========================
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


            // =========================================================
            // BUAT USER + ASESOR + WILAYAH
            // DALAM SATU TRANSACTION
            // =========================================================

            DB::transaction(function () use ($validatedData) {

                // -----------------------------------------------------
                // Ambil role ASESOR
                // -----------------------------------------------------

                $roleAsesor = Role::where('nama_role', 'ASESOR')
                    ->firstOrFail();


                // -----------------------------------------------------
                // Buat username otomatis dari email
                // -----------------------------------------------------

                // Contoh:
                // budi@gmail.com
                // menjadi:
                // budi
                $usernameDasar = explode('@', $validatedData['email'])[0];

                $username = $usernameDasar;

                $nomor = 1;

                // Kalau username sudah digunakan,
                // tambahkan angka di belakangnya.
                //
                // Contoh:
                // budi
                // budi1
                // budi2
                while (User::where('username', $username)->exists()) {
                    $username = $usernameDasar . $nomor;
                    $nomor++;
                }


                // -----------------------------------------------------
                // BUAT USER
                // -----------------------------------------------------

                $user = User::create([

                    // Role otomatis menjadi ASESOR.
                    'id_role' => $roleAsesor->id_role,

                    // Instansi asal asesor.
                    'id_instansi' => $validatedData['id_instansi'],

                    'name' => $validatedData['name'],

                    // Username dibuat otomatis.
                    'username' => $username,

                    'email' => $validatedData['email'],

                    // Password akan di-hash otomatis oleh
                    // cast pada model User.
                    'password' => $validatedData['password'],

                    // Tidak ada nomor telepon di form.
                    'no_hp' => null,

                    // NIP disimpan pada User.
                    'nip' => $validatedData['nip'],

                    'status' => $validatedData['status'],
                ]);


                // -----------------------------------------------------
                // BUAT DATA ASESOR
                // -----------------------------------------------------

                $asesor = Asesor::create([

                    // Hubungkan dengan User yang baru dibuat.
                    'id_user' => $user->id_user,

                    // Instansi asal asesor.
                    'id_instansi' => $validatedData['id_instansi'],

                    // NIP asesor.
                    'nip' => $validatedData['nip'],

                    // Jabatan sudah tidak digunakan.
                    'jabatan' => null,

                    // Simpan beberapa aspek penilaian.
                    // Model Asesor sudah memiliki cast array,
                    // sehingga Laravel akan menyimpannya sebagai JSON.
                    'keahlian' => $validatedData['keahlian'],

                    // Unit kerja masih digunakan.
                    'unit_kerja' => $validatedData['unit_kerja'] ?? null,

                    // Status asesor mengikuti status akun.
                    'status' => $validatedData['status'],

                    // Kolom lama masih NOT NULL.
                    // Wilayah sebenarnya disimpan melalui
                    // tabel asesor_wilayah.
                    'wilayah' => '',
                ]);


                // -----------------------------------------------------
                // SIMPAN WILAYAH PENUGASAN
                // -----------------------------------------------------

                // Satu asesor bisa memiliki banyak wilayah.
                //
                // Contoh:
                // Jawa Barat + Banten
                //
                // Keduanya akan disimpan ke tabel asesor_wilayah.
                if (!empty($validatedData['wilayah'])) {

                    $asesor->wilayahPenugasan()
                        ->sync($validatedData['wilayah']);
                }
            });


            // =========================================================
            // SELESAI
            // =========================================================

            return redirect()
                ->route('admin.asesor.index')
                ->with('success', 'Asesor berhasil ditambahkan.');
        }
    public function show($id_asesor)
    {
        // Ambil data asesor beserta user, instansi asal,
        // dan wilayah yang menjadi penugasannya.
        $asesor = Asesor::with([
            'user',
            'instansi',
            'wilayahPenugasan',
        ])->findOrFail($id_asesor);

        return view('admin.asesor.show', [
            'asesor' => $asesor,
        ]);
    }
    public function edit($id_asesor)
    {
        // Ambil data asesor beserta user, instansi asal,
        // dan wilayah yang menjadi penugasannya.
        $asesor = Asesor::with([
            'user',
            'instansi',
            'wilayahPenugasan',
        ])->findOrFail($id_asesor);

        // Ambil instansi aktif untuk pilihan instansi asal.
        $instansi = Instansi::where('status', 'AKTIF')
            ->orderBy('nama_instansi')
            ->get();

        // Ambil semua wilayah/provinsi untuk pilihan penugasan.
        $wilayah = Wilayah::orderBy('nama_wilayah')
            ->get();

        return view('admin.asesor.edit', [
            'asesor' => $asesor,
            'instansi' => $instansi,
            'wilayah' => $wilayah,
        ]);
    }
    public function update(Request $request, $id_asesor)
    {
        // Ambil data asesor yang akan diperbarui.
        $asesor = Asesor::with('user')
            ->findOrFail($id_asesor);

        // Validasi data yang dikirim dari form edit.
        $validatedData = $request->validate([
            // =========================
            // INFORMASI USER
            // =========================
            'name' => 'required|string|max:255',

            // Email harus unik, tetapi email milik user yang sedang diedit
            // tidak dianggap sebagai duplikat.
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($asesor->id_user, 'id_user'),
            ],

            'status' => 'required|in:AKTIF,NONAKTIF',

            // =========================
            // INFORMASI KEDINASAN
            // =========================
            'nip' => 'required|string|max:50',

            'id_instansi' => [
                'required',
                'exists:instansi,id_instansi',
            ],

            'unit_kerja' => 'nullable|string|max:200',

            // Keahlian sekarang berupa array.
            'keahlian' => 'required|array|min:1',

            // Setiap keahlian harus berasal dari daftar aspek yang tersedia.
            'keahlian.*' => [
                'required',
                Rule::in([
                    'ASPEK_1',
                    'ASPEK_2',
                    'ASPEK_3',
                    'ASPEK_4',
                    'ASPEK_5',
                    'ASPEK_6',
                    'ASPEK_7',
                ]),
            ],

            // Wilayah sekarang berupa array.
            'wilayah' => 'nullable|array',

            // Setiap wilayah harus merupakan ID wilayah yang valid.
            'wilayah.*' => 'integer|exists:wilayah,id_wilayah',

            // =========================
            // PASSWORD
            // =========================
            // Password boleh kosong ketika edit.
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

        // Gunakan transaction supaya perubahan user, asesor,
        // dan wilayah pivot tersimpan secara aman sebagai satu proses.
        DB::transaction(function () use ($validatedData, $asesor) {

            // =====================================================
            // UPDATE DATA USER
            // =====================================================

            $userData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'status' => $validatedData['status'],
            ];

            // Kalau password diisi, maka password ikut diperbarui.
            // Kalau kosong, password lama tetap digunakan.
            if (!empty($validatedData['password'])) {
                $userData['password'] = $validatedData['password'];
            }

            // Simpan perubahan data user.
            $asesor->user->update($userData);


            // =====================================================
            // UPDATE DATA ASESOR
            // =====================================================

            $asesor->update([
                'id_instansi' => $validatedData['id_instansi'],
                'nip' => $validatedData['nip'],
                'unit_kerja' => $validatedData['unit_kerja'] ?? null,

                // Simpan keahlian sebagai array.
                // Model Asesor akan mengubahnya menjadi JSON.
                'keahlian' => $validatedData['keahlian'],

                'status' => $validatedData['status'],

                // Kolom wilayah lama masih NOT NULL di database.
                // Karena sekarang wilayah disimpan melalui tabel pivot,
                // kolom lama kita isi string kosong.
                'wilayah' => '',
            ]);


            // =====================================================
            // UPDATE WILAYAH PENUGASAN
            // =====================================================

            // Sinkronkan wilayah asesor dengan tabel pivot asesor_wilayah.
            // Wilayah lama yang tidak dipilih lagi akan otomatis dilepas.
            $asesor->wilayahPenugasan()->sync(
                $validatedData['wilayah'] ?? []
            );

        });

        // Setelah berhasil, kembali ke halaman detail asesor.
        return redirect()
            ->route('admin.asesor.show', $asesor->id_asesor)
            ->with('success', 'Data asesor berhasil diperbarui.');
    }
    public function toggleStatus($id_asesor)
    {
        // Ambil data asesor beserta akun user-nya.
        $asesor = Asesor::with('user')
            ->findOrFail($id_asesor);

        // Tentukan status baru berdasarkan status saat ini.
        $statusBaru = $asesor->status === 'AKTIF'
            ? 'NONAKTIF'
            : 'AKTIF';

        // Gunakan transaction supaya status asesor dan user
        // selalu berubah secara bersamaan.
        DB::transaction(function () use ($asesor, $statusBaru) {

            // Ubah status pada tabel asesor.
            $asesor->update([
                'status' => $statusBaru,
            ]);

            // Ubah status pada tabel users.
            $asesor->user->update([
                'status' => $statusBaru,
            ]);

        });

        // Kembali ke halaman detail asesor.
        return redirect()
            ->route('admin.asesor.show', $asesor->id_asesor)
            ->with(
                'success',
                $statusBaru === 'AKTIF'
                    ? 'Akses asesor berhasil diaktifkan.'
                    : 'Akses asesor berhasil dinonaktifkan.'
            );
    }
}