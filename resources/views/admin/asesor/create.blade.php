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
        Tambah Asesor
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
            Asesor
        </span>

        <span class="text-[#94A3B8]">
            >
        </span>

        <span class="font-medium text-[#12AFA9]">
            Tambah Asesor
        </span>
    </div>

    {{-- FORM TAMBAH ASESOR --}}
    <form action="{{ route('admin.asesor.store') }}" method="POST" class="mt-5">
        @csrf

        {{-- =========================
            CARD INFORMASI ASESOR
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
                        Informasi Asesor
                    </h2>

                    <p class="mt-0.5 text-[13px] text-[#6D797B]">
                        Lengkapi informasi dasar asesor
                    </p>
                </div>

            </div>

            <div class="mt-4 border-t border-[#D9D9D9]"></div>

            {{-- GRID FORM --}}
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-5 md:grid-cols-3">

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
                        Lengkapi informasi kedinasan asesor
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
                        NIP <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="nip"
                        name="nip"
                        value="{{ old('nip') }}"
                        placeholder="Masukkan NIP"
                        required
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

                        {{-- Data instansi berasal dari AsesorController --}}
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

                <!-- {{-- UNIT KERJA / BIDANG --}}
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
                </div> -->

                <!-- {{-- JABATAN --}}
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
                </div> -->

                {{-- KEAHLIAN / SPESIALISASI --}}
                <div>
                    <label
                        for="keahlian"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Keahlian / Spesialisasi <span class="text-red-500">*</span>
                    </label>

                    {{-- Wrapper dropdown --}}
                    <div class="relative" id="keahlian-wrapper">

                        {{-- Tombol untuk membuka dropdown --}}
                        <button
                            type="button"
                            id="keahlian-button"
                            class="flex w-full items-center justify-between rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-left text-[13px] text-[#434654] outline-none focus:border-[#006671]">

                            <span id="keahlian-label">
                                Pilih aspek penilaian
                            </span>

                            {{-- Icon dropdown --}}
                            <svg
                                class="h-4 w-4 text-[#6B7280]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m19 9-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Isi dropdown --}}
                        <div
                            id="keahlian-dropdown"
                            class="absolute left-0 z-20 mt-1 hidden w-full rounded-[7px] border border-[#BCC9CB] bg-white p-2 shadow-lg">

                            @php
                                $aspek = [
                                    'ASPEK_1' => 'Aspek 1 - Tata Kelola dan Manajemen',
                                    'ASPEK_2' => 'Aspek 2 - Penyelenggaran',
                                    'ASPEK_3' => 'Aspek 3 - Data',
                                    'ASPEK_4' => 'Aspek 4 - Keamanan Siber',
                                    'ASPEK_5' => 'Aspek 5 - Teknologi Digital',
                                    'ASPEK_6' => 'Aspek 6 - Keterpaduan Layanan Digital Pemerintah',
                                    'ASPEK_7' => 'Aspek 7 - Kepuasan Pengguna Layanan Digital Pemerintah',
                                ];
                            @endphp

                            @foreach ($aspek as $value => $label)
                                <label class="flex cursor-pointer items-start gap-2 rounded-[5px] px-2 py-2 hover:bg-gray-50">

                                    <input
                                        type="checkbox"
                                        name="keahlian[]"
                                        value="{{ $value }}"
                                        class="keahlian-checkbox mt-0.5 h-4 w-4 rounded border-gray-300 text-[#006671] focus:ring-[#006671]"
                                        {{ in_array($value, old('keahlian', [])) ? 'checked' : '' }}>

                                    <span class="text-[13px] text-[#434654]">
                                        {{ $label }}
                                    </span>

                                </label>
                            @endforeach

                        </div>
                    </div>

                    <p class="mt-1 text-[12px] text-gray-500">
                        Pilih satu atau lebih aspek yang menjadi bidang penilaian asesor.
                    </p>

                    @error('keahlian')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>


        {{-- =========================
            CARD PERAN & AKSES
        ========================== --}}
        <div class="mt-5 rounded-[12px] border border-[#BCC9CB] bg-white px-7 py-6">

            {{-- HEADER CARD --}}
            <div class="flex items-center gap-4">

                {{-- ICON PERAN --}}
                <div class="flex h-[38px] w-[38px] shrink-0 items-center justify-center rounded-full bg-[#E8F0FF] text-[#008F8A]">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-[18px] w-[18px]"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M12 2 4 5v6c0 5.25 3.41 10.17 8 11 4.59-.83 8-5.75 8-11V5l-8-3Zm0 4 4 1.5V11c0 3.45-2.08 6.82-4 7.72C10.08 17.82 8 14.45 8 11V7.5L12 6Z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-[16px] font-semibold text-[#172B4D]">
                        Peran & Akses
                    </h2>

                    <p class="mt-0.5 text-[13px] text-[#6D797B]">
                        Atur peran dan hak akses asesor dalam sistem
                    </p>
                </div>

            </div>

            <div class="mt-4 border-t border-[#D9D9D9]"></div>

            {{-- GRID FORM --}}
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-5 md:grid-cols-2">

                {{-- ROLE --}}
                <div>
                    <label
                        for="role"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Role <span class="text-red-500">*</span>
                    </label>

                    {{-- Role otomatis Asesor karena halaman ini khusus untuk Asesor --}}
                    <input
                        type="text"
                        id="role"
                        value="Asesor"
                        readonly
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-[#F5F7F8] px-3 py-2.5 text-[13px] text-[#64748B] outline-none">

                </div>

                {{-- WILAYAH PENUGASAN --}}
                <div>
                    <label
                        for="wilayah"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Wilayah Penugasan
                    </label>

                    {{-- Wrapper dropdown --}}
                    <div class="relative" id="wilayah-wrapper">

                        {{-- Tombol dropdown --}}
                        <button
                            type="button"
                            id="wilayah-button"
                            class="flex w-full items-center justify-between rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-left text-[13px] text-[#434654] outline-none focus:border-[#006671]">

                            <span id="wilayah-label">
                                Pilih wilayah penugasan
                            </span>

                            {{-- Icon panah --}}
                            <svg
                                class="h-4 w-4 text-[#6D797B]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m19 9-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Dropdown wilayah --}}
                        <div
                            id="wilayah-dropdown"
                            class="absolute left-0 z-20 mt-1 hidden w-full rounded-[7px] border border-[#BCC9CB] bg-white shadow-lg">

                            {{-- Header dropdown --}}
                            <div class="border-b border-[#E5E7E8] px-3 py-2">
                                <label class="flex cursor-pointer items-center gap-2">

                                    <input
                                        type="checkbox"
                                        id="wilayah-select-all"
                                        class="h-4 w-4 rounded border-gray-300 text-[#006671] focus:ring-[#006671]">

                                    <span class="text-[13px] font-medium text-[#434654]">
                                        Pilih semua wilayah
                                    </span>

                                </label>
                            </div>

                            {{-- Daftar provinsi --}}
                            <div class="max-h-52 overflow-y-auto p-2">

                                @foreach ($wilayah as $item)
                                    <label
                                        class="flex cursor-pointer items-start gap-2 rounded-[5px] px-2 py-2 hover:bg-gray-50">

                                        <input
                                            type="checkbox"
                                            name="wilayah[]"
                                            value="{{ $item->id_wilayah }}"
                                            class="wilayah-checkbox mt-0.5 h-4 w-4 rounded border-gray-300 text-[#006671] focus:ring-[#006671]"
                                            {{ in_array($item->id_wilayah, old('wilayah', [])) ? 'checked' : '' }}>

                                        <span class="text-[13px] text-[#434654]">
                                            {{ $item->nama_wilayah }}
                                        </span>

                                    </label>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <p class="mt-1 text-[12px] text-[#6D797B]">
                        Pilih satu atau lebih wilayah penugasan asesor.
                    </p>

                    @error('wilayah')
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
                        Atur password untuk akses akun asesor
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
                href="{{ route('admin.asesor.index') }}"
                class="rounded-[7px] border border-[#BCC9CB] bg-white px-5 py-2.5 text-[13px] font-medium text-[#008F8A] transition hover:bg-[#F5F5F5]">
                Batal
            </a>

            <button
                type="submit"
                class="rounded-[7px] bg-gradient-to-r from-[#12C6BD] to-[#09605C] px-6 py-2.5 text-[13px] font-medium text-white transition hover:opacity-90">
                Simpan Asesor
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

        // Ambil elemen dropdown aspek.
        const keahlianButton = document.getElementById('keahlian-button');
        const keahlianDropdown = document.getElementById('keahlian-dropdown');
        const keahlianLabel = document.getElementById('keahlian-label');
        const keahlianWrapper = document.getElementById('keahlian-wrapper');
        const keahlianCheckboxes = document.querySelectorAll('.keahlian-checkbox');

        // Buka/tutup dropdown ketika tombol diklik.
        keahlianButton.addEventListener('click', function () {
            keahlianDropdown.classList.toggle('hidden');
        });

        // Tutup dropdown jika user klik di luar area dropdown.
        document.addEventListener('click', function (event) {
            if (!keahlianWrapper.contains(event.target)) {
                keahlianDropdown.classList.add('hidden');
            }
        });

        // Update tulisan tombol berdasarkan aspek yang dipilih.
        function updateKeahlianLabel() {
            const selected = Array.from(keahlianCheckboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.parentElement.querySelector('span').textContent.trim());

            if (selected.length === 0) {
                keahlianLabel.textContent = 'Pilih aspek penilaian';
                return;
            }

            if (selected.length === 1) {
                keahlianLabel.textContent = selected[0];
                return;
            }

            keahlianLabel.textContent = `${selected.length} aspek dipilih`;
        }

        // Jalankan ketika checkbox berubah.
        keahlianCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateKeahlianLabel);
        });

        // Tampilkan pilihan lama jika validasi form sebelumnya gagal.
        updateKeahlianLabel();

        // =========================================================
        // DROPDOWN WILAYAH PENUGASAN
        // =========================================================

        // Ambil elemen dropdown.
        const wilayahButton = document.getElementById('wilayah-button');
        const wilayahDropdown = document.getElementById('wilayah-dropdown');
        const wilayahLabel = document.getElementById('wilayah-label');
        const wilayahWrapper = document.getElementById('wilayah-wrapper');
        const wilayahSelectAll = document.getElementById('wilayah-select-all');
        const wilayahCheckboxes = document.querySelectorAll('.wilayah-checkbox');

        // Buka atau tutup dropdown ketika tombol diklik.
        wilayahButton.addEventListener('click', function () {
            wilayahDropdown.classList.toggle('hidden');
        });

        // Tutup dropdown ketika user klik di luar area dropdown.
        document.addEventListener('click', function (event) {
            if (!wilayahWrapper.contains(event.target)) {
                wilayahDropdown.classList.add('hidden');
            }
        });

        // Update tulisan tombol berdasarkan jumlah wilayah yang dipilih.
        function updateWilayahLabel() {
            const selected = Array.from(wilayahCheckboxes)
                .filter(checkbox => checkbox.checked);

            if (selected.length === 0) {
                wilayahLabel.textContent = 'Pilih wilayah penugasan';
            } else if (selected.length === 1) {
                wilayahLabel.textContent =
                    selected[0].parentElement.querySelector('span').textContent.trim();
            } else {
                wilayahLabel.textContent =
                    `${selected.length} wilayah dipilih`;
            }

            // Update status checkbox "Pilih semua".
            wilayahSelectAll.checked =
                selected.length === wilayahCheckboxes.length &&
                wilayahCheckboxes.length > 0;
        }

        // Ketika checkbox wilayah dipilih/dibatalkan.
        wilayahCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                updateWilayahLabel();
            });
        });

        // Pilih atau batalkan semua wilayah.
        wilayahSelectAll.addEventListener('change', function () {

            wilayahCheckboxes.forEach(function (checkbox) {
                checkbox.checked = wilayahSelectAll.checked;
            });

            updateWilayahLabel();
        });

        // Tampilkan kembali pilihan lama setelah validasi gagal.
        updateWilayahLabel();
    </script>
    

@endsection