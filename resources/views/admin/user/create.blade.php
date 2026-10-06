@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- Menampilkan pesan error validasi jika ada input yang tidak sesuai --}}
    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
            <p class="font-semibold text-red-700">
                Data tidak tersimpan, masukkan data baru!
            </p>

            <ul class="mt-2 list-disc pl-5 text-sm text-red-600">
                {{-- Menampilkan semua pesan error dari validasi Laravel --}}
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- JUDUL HALAMAN --}}
    <h1 class="text-[28px] font-semibold text-[#1F1F1F]">
        Tambah User
    </h1>

    {{-- BREADCRUMB --}}
    <div class="mt-2 flex items-center gap-3 text-[14px]">
        <span class="text-[#64748B]">
            Data Master
        </span>

        <span class="text-[#94A3B8]">
            >
        </span>

        <span class="text-[#64748B]">
            User
        </span>

        <span class="text-[#94A3B8]">
            >
        </span>

        <span class="font-medium text-[#12AFA9]">
            Tambah User
        </span>
    </div>

    {{-- FORM TAMBAH USER --}}
    <form action="{{ route('admin.user.store') }}" method="POST" class="mt-5">
        @csrf

        {{-- =========================
            CARD INFORMASI USER
        ========================== --}}
        <div class="rounded-[12px] border border-[#BCC9CB] bg-white px-7 py-6">

            {{-- HEADER CARD --}}
            <div class="flex items-center gap-4">

                {{-- ICON USER --}}
                <div class="flex h-[38px] w-[38px] shrink-0 items-center justify-center rounded-full bg-[#E8F0FF] text-[#008F8A]">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-[18px] w-[18px]"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5Z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-[16px] font-semibold text-[#172B4D]">
                        Informasi User
                    </h2>

                    <p class="mt-0.5 text-[13px] text-[#6D797B]">
                        Lengkapi informasi dasar pengguna
                    </p>
                </div>

            </div>

            <div class="mt-4 border-t border-[#D9D9D9]"></div>

            {{-- GRID FORM --}}
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-5 md:grid-cols-2">

                {{-- NAMA LENGKAP --}}
                <div>
                    <label
                        for="name"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                    @error('name')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- USERNAME --}}
                <div>
                    <label
                        for="username"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Username <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Masukkan username"
                        required
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                    @error('username')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div>
                    <label
                        for="email"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Email <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        required
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                    @error('email')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- NO. TELEPON --}}
                <div>
                    <label
                        for="no_hp"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        No. Telepon
                    </label>

                    <input
                        type="text"
                        id="no_hp"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        placeholder="Masukkan nomor telepon"
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                    @error('no_hp')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- STATUS AKUN --}}
                <div>
                    <label
                        for="status"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Status Akun <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none focus:border-[#006671]">

                        <option value="">
                            Pilih status akun
                        </option>

                        <option value="AKTIF" {{ old('status') == 'AKTIF' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="NONAKTIF" {{ old('status') == 'NONAKTIF' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>

                    @error('status')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>


        {{-- =========================
            CARD INFORMASI KEDINASAN
        ========================== --}}
        <div class="mt-5 rounded-[12px] border border-[#BCC9CB] bg-white px-7 py-6">

            {{-- HEADER CARD --}}
            <div class="flex items-center gap-4">

                {{-- ICON KEDINASAN --}}
                <div class="flex h-[38px] w-[38px] shrink-0 items-center justify-center rounded-full bg-[#E8F0FF] text-[#008F8A]">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-[18px] w-[18px]"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M9 4a3 3 0 0 1 6 0v1h3a3 3 0 0 1 3 3v3.5a20.3 20.3 0 0 1-6 1.35V11h-6v1.85A20.3 20.3 0 0 1 3 11.5V8a3 3 0 0 1 3-3h3V4Zm2 1h2V4a1 1 0 0 0-2 0v1ZM3 13.5V17a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3v-3.5a22.4 22.4 0 0 1-6 1.3V15h-6v-.7a22.4 22.4 0 0 1-6-1.3Z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-[16px] font-semibold text-[#172B4D]">
                        Informasi Kedinasan
                    </h2>

                    <p class="mt-0.5 text-[13px] text-[#6D797B]">
                        Lengkapi informasi kedinasan pengguna
                    </p>
                </div>

            </div>

            <div class="mt-4 border-t border-[#D9D9D9]"></div>

            {{-- GRID FORM --}}
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-5 md:grid-cols-2">

                {{-- NIP --}}
                <div>
                    <label
                        for="nip"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        NIP
                    </label>

                    <input
                        type="text"
                        id="nip"
                        name="nip"
                        value="{{ old('nip') }}"
                        placeholder="Masukkan NIP"
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                    @error('nip')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- INSTANSI --}}
                <div>
                    <label
                        for="id_instansi"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Instansi <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="id_instansi"
                        name="id_instansi"
                        required
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none focus:border-[#006671]">

                        <option value="">
                            Pilih instansi
                        </option>

                        {{-- Data instansi berasal dari UserController --}}
                        @foreach ($instansi as $item)
                            <option
                                value="{{ $item->id_instansi }}"
                                {{ old('id_instansi') == $item->id_instansi ? 'selected' : '' }}>
                                {{ $item->nama_instansi }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_instansi')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- UNIT KERJA / BIDANG --}}
                <div>
                    <label
                        for="unit_kerja"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Unit Kerja / Bidang
                    </label>

                    <input
                        type="text"
                        id="unit_kerja"
                        name="unit_kerja"
                        value="{{ old('unit_kerja') }}"
                        placeholder="Masukkan unit kerja atau bidang"
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                    @error('unit_kerja')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- JABATAN --}}
                <div>
                    <label
                        for="jabatan"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Jabatan <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="jabatan"
                        name="jabatan"
                        value="{{ old('jabatan') }}"
                        placeholder="Masukkan jabatan"
                        required
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                    @error('jabatan')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- ROLE --}}
                <div>
                    <label
                        for="id_role"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Role <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="id_role"
                        name="id_role"
                        required
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none focus:border-[#006671]">

                        <option value="">
                            Pilih role
                        </option>

                        {{-- Data role berasal dari UserController --}}
                        @foreach ($roles as $role)
                            <option
                                value="{{ $role->id_role }}"
                                {{ old('id_role') == $role->id_role || (!old('id_role') && $role->nama_role === 'USER') ? 'selected' : '' }}>
                                {{ ucfirst(strtolower($role->nama_role)) }}
                            </option>
                        @endforeach

                    </select>

                    @error('id_role')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>


        {{-- =========================
            CARD KEAMANAN AKUN
        ========================== --}}
        <div class="mt-5 rounded-[12px] border border-[#BCC9CB] bg-white px-7 py-6">

            {{-- HEADER CARD --}}
            <div class="flex items-center gap-4">

                {{-- ICON KEAMANAN --}}
                <div class="flex h-[38px] w-[38px] shrink-0 items-center justify-center rounded-full bg-[#E8F0FF] text-[#008F8A]">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-[18px] w-[18px]"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M17 9V7a5 5 0 0 0-10 0v2H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2h-2Zm-8-2a3 3 0 0 1 6 0v2H9V7Zm3 7a2 2 0 1 0 1 3.73V19h-2v-1.27A2 2 0 0 0 12 14Z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-[16px] font-semibold text-[#172B4D]">
                        Keamanan Akun
                    </h2>

                    <p class="mt-0.5 text-[13px] text-[#6D797B]">
                        Atur password untuk akses akun pengguna
                    </p>
                </div>

            </div>

            <div class="mt-4 border-t border-[#D9D9D9]"></div>

            {{-- GRID PASSWORD --}}
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-5 md:grid-cols-2">

                {{-- PASSWORD --}}
                <div>
                    <label
                        for="password"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Password <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            minlength="8"
                            required
                            class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 pr-10 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                        {{-- Tombol untuk menampilkan/menyembunyikan password --}}
                        <button
                            type="button"
                            id="togglePassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[#6D797B] transition hover:text-[#006671]"
                            aria-label="Tampilkan password">

                            {{-- Icon mata --}}
                            <svg
                                id="passwordEye"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-[18px] w-[18px]"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                                <circle cx="12" cy="12" r="2.5"/>
                            </svg>
                        </button>
                    </div>

                    <p class="mt-1 text-[12px] text-[#6D797B]">
                        Minimal 8 karakter, kombinasi huruf, angka dan simbol
                    </p>

                    @error('password')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div>
                    <label
                        for="password_confirmation"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Konfirmasi password"
                            minlength="8"
                            required
                            class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 pr-10 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                        {{-- Tombol untuk menampilkan/menyembunyikan konfirmasi password --}}
                        <button
                            type="button"
                            id="togglePasswordConfirmation"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[#6D797B] transition hover:text-[#006671]"
                            aria-label="Tampilkan konfirmasi password">

                            {{-- Icon mata --}}
                            <svg
                                id="confirmationEye"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-[18px] w-[18px]"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/>
                                <circle cx="12" cy="12" r="2.5"/>
                            </svg>
                        </button>
                    </div>

                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>


        {{-- BUTTON --}}
        <div class="mt-8 flex justify-end gap-3 border-t border-[#D9D9D9] pt-5">

            <a
                href="{{ route('admin.user.index') }}"
                class="rounded-[7px] border border-[#BCC9CB] bg-white px-5 py-2.5 text-[13px] font-medium text-[#008F8A] transition hover:bg-[#F5F5F5]">
                Batal
            </a>

            <button
                type="submit"
                class="rounded-[7px] bg-gradient-to-r from-[#12C6BD] to-[#09605C] px-6 py-2.5 text-[13px] font-medium text-white transition hover:opacity-90">
                Simpan User
            </button>

        </div>

    </form>

    {{-- VALIDASI PASSWORD DI SISI CLIENT --}}
    <script>
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');

        // Cek apakah password dan konfirmasi password sama.
        function checkPasswordMatch() {
            const password = passwordInput.value;
            const confirmation = passwordConfirmationInput.value;

            // Hapus status sebelumnya.
            passwordConfirmationInput.classList.remove('border-red-500');
            passwordConfirmationInput.classList.remove('border-[#BCC9CB]');

            const oldMessage = document.getElementById('password-match-message');

            if (oldMessage) {
                oldMessage.remove();
            }

            // Jangan tampilkan pesan kalau konfirmasi masih kosong.
            if (confirmation === '') {
                passwordConfirmationInput.classList.add('border-[#BCC9CB]');
                return;
            }

            // Kalau password tidak sama, tampilkan warna merah dan pesan.
            if (password !== confirmation) {
                passwordConfirmationInput.classList.add('border-red-500');

                const message = document.createElement('p');

                message.id = 'password-match-message';
                message.className = 'mt-1 text-sm text-red-700';
                message.textContent = 'Konfirmasi password tidak sama dengan password.';

                passwordConfirmationInput.insertAdjacentElement('afterend', message);

                return;
            }

            // Kalau sama, kembali ke border normal.
            passwordConfirmationInput.classList.add('border-[#BCC9CB]');
        }

        // Cek setiap kali user mengetik password.
        passwordInput.addEventListener('input', checkPasswordMatch);

        // Cek setiap kali user mengetik konfirmasi password.
        passwordConfirmationInput.addEventListener('input', checkPasswordMatch);
    </script>

    <script>
    // ==========================================
    // TOGGLE PASSWORD
    // ==========================================

    const togglePassword = document.getElementById('togglePassword');
    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');

    const passwordEye = document.getElementById('passwordEye');
    const confirmationEye = document.getElementById('confirmationEye');

    // Menampilkan atau menyembunyikan password utama.
    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';

        passwordEye.style.opacity = isPassword ? '0.6' : '1';
    });

    // Menampilkan atau menyembunyikan konfirmasi password.
    togglePasswordConfirmation.addEventListener('click', function () {
        const isPassword = passwordConfirmationInput.type === 'password';

        passwordConfirmationInput.type = isPassword ? 'text' : 'password';

        confirmationEye.style.opacity = isPassword ? '0.6' : '1';
    });
    </script>
@endsection