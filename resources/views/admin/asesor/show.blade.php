@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- =========================================================
        HEADER DETAIL
        ========================================================= --}}
    <div class="flex items-center justify-between">

        {{-- Tombol kembali --}}
        <a
            href="{{ route('admin.asesor.index') }}"
            class="inline-flex items-center gap-2 text-[13px] font-medium text-[#006671] transition hover:text-[#004F57]"
        >
            ←
            Kembali
        </a>


        {{-- Tombol aksi --}}
        <div class="flex items-center gap-3">

            {{-- Edit Asesor --}}
            <a
                href="{{ route('admin.asesor.edit', $asesor->id_asesor) }}"
                class="inline-flex items-center gap-2 rounded-[8px] border border-[#BCC9CB] bg-white px-5 py-2.5 text-[13px] font-medium text-[#006671] transition hover:bg-[#F1FAF9]"
            >
                ✎
                Edit Asesor
            </a>

            {{-- Tombol status --}}
            @if ($asesor->status === 'AKTIF')

                <form
                    action="{{ route('admin.asesor.toggle-status', $asesor->id_asesor) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-[8px] bg-[#FFDAD6] px-5 py-2.5 text-[13px] font-medium text-[#BA1A1A] transition hover:bg-[#FFC9C4]"
                    >
                        ⊘
                        Nonaktifkan Akses
                    </button>
                </form>

            @else

                <form
                    action="{{ route('admin.asesor.toggle-status', $asesor->id_asesor) }}"
                    method="POST"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-[8px] bg-[#E6F4EA] px-5 py-2.5 text-[13px] font-medium text-[#137333] transition hover:bg-[#D7ECD9]"
                    >
                        ●
                        Aktifkan Akses
                    </button>
                </form>

            @endif 
       </div>
    </div>


    {{-- =========================================================
        PROFIL UTAMA ASESOR
        ========================================================= --}}
    <div class="mt-6 rounded-[12px] border border-[#BCC9CB] bg-[#F5FCFA] px-7 py-6">

        <div class="flex flex-col gap-5 lg:flex-row lg:items-center">

            {{-- FOTO / AVATAR --}}
            <div class="relative shrink-0">

                <div class="flex h-[96px] w-[96px] items-center justify-center overflow-hidden rounded-full border-[3px] border-white bg-[#DDF5F2] shadow">

                    {{-- Jika user memiliki foto --}}
                    @if ($asesor->user && $asesor->user->foto)

                        <img
                            src="{{ asset('storage/' . $asesor->user->foto) }}"
                            alt="{{ $asesor->user->name }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        {{-- Avatar default --}}
                        <span class="text-[30px] font-semibold text-[#008F8A]">
                            {{ strtoupper(substr($asesor->user->name ?? 'A', 0, 1)) }}
                        </span>

                    @endif

                </div>


                {{-- Indikator aktif --}}
                <span class="absolute bottom-0 right-0 h-[22px] w-[22px] rounded-full border-[3px] border-white bg-[#22C55E]"></span>

            </div>


            {{-- INFORMASI UTAMA --}}
            <div class="flex-1">

                <div class="flex flex-wrap items-center gap-3">

                    <h1 class="text-[24px] font-semibold text-[#14213D]">
                        {{ $asesor->user->name ?? '-' }}
                    </h1>


                    {{-- Badge status --}}
                    @if ($asesor->status === 'AKTIF')

                        <span class="inline-flex items-center gap-2 rounded-full bg-[#DDF8EA] px-3 py-1 text-[11px] font-medium text-[#008F5D]">
                            <span class="h-[6px] w-[6px] rounded-full bg-[#00A86B]"></span>
                            Asesor Aktif
                        </span>

                    @else

                        <span class="inline-flex items-center gap-2 rounded-full bg-[#FFE4E1] px-3 py-1 text-[11px] font-medium text-[#BA1A1A]">
                            <span class="h-[6px] w-[6px] rounded-full bg-[#D92D20]"></span>
                            Asesor Nonaktif
                        </span>

                    @endif

                </div>


                {{-- Informasi singkat --}}
                <div class="mt-4 flex flex-wrap gap-3">

                    {{-- NIP --}}
                    <div class="inline-flex items-center gap-2 rounded-[8px] border border-[#CBD5E1] bg-[#EFF5FB] px-4 py-2 text-[13px] text-[#334155]">
                        ▣
                        {{ $asesor->nip ?: '-' }}
                    </div>


                    {{-- Email --}}
                    <div class="inline-flex items-center gap-2 rounded-[8px] border border-[#CBD5E1] bg-[#EFF5FB] px-4 py-2 text-[13px] text-[#334155]">
                        ✉
                        {{ $asesor->user->email ?? '-' }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        CONTENT DETAIL
        ========================================================= --}}
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,2fr)_minmax(280px,0.9fr)]">


        {{-- =====================================================
            KOLOM KIRI
            ===================================================== --}}
        <div class="space-y-6">


            {{-- =================================================
                INFORMASI DASAR ASESOR
                ================================================= --}}
            <div class="overflow-hidden rounded-[12px] border border-[#BCC9CB] bg-white">

                {{-- Header card --}}
                <div class="flex items-center gap-3 border-b border-[#D9D9D9] px-6 py-5">

                    <div class="flex h-[42px] w-[42px] items-center justify-center rounded-full bg-[#E8FBF5] text-[18px] text-[#00A884]">
                        ♙
                    </div>

                    <div>

                        <h2 class="text-[18px] font-semibold text-[#14213D]">
                            Informasi Dasar Asesor
                        </h2>

                        <p class="mt-0.5 text-[13px] text-[#64748B]">
                            Data profil personal yang terdaftar dalam sistem.
                        </p>

                    </div>

                </div>


                {{-- Isi --}}
                <div class="grid grid-cols-1 gap-x-10 gap-y-7 px-6 py-6 md:grid-cols-2">

                    {{-- Nama Lengkap --}}
                    <div>

                        <p class="text-[13px] text-[#434654]">
                            Nama Lengkap
                        </p>

                        <p class="mt-1 text-[15px] font-medium text-[#14213D]">
                            {{ $asesor->user->name ?? '-' }}
                        </p>

                    </div>


                    {{-- Username --}}
                    <div>

                        <p class="text-[13px] text-[#434654]">
                            Username
                        </p>

                        <p class="mt-1 text-[15px] font-medium text-[#14213D]">
                            {{ $asesor->user->username ?? '-' }}
                        </p>

                    </div>


                    {{-- Email --}}
                    <div>

                        <p class="text-[13px] text-[#434654]">
                            Email
                        </p>

                        <p class="mt-1 text-[15px] font-medium text-[#14213D]">
                            {{ $asesor->user->email ?? '-' }}
                        </p>

                    </div>


                    {{-- Status --}}
                    <div class="border-t border-dashed border-[#D9D9D9] pt-4">

                        <p class="text-[13px] text-[#434654]">
                            Status Akun
                        </p>

                        @if ($asesor->status === 'AKTIF')

                            <span class="mt-2 inline-flex items-center gap-2 rounded-[6px] border border-[#A7F3D0] bg-[#F0FDF4] px-3 py-1.5 text-[12px] font-medium text-[#008F5D]">
                                <span class="h-[7px] w-[7px] rounded-full bg-[#16A34A]"></span>
                                Aktif
                            </span>

                        @else

                            <span class="mt-2 inline-flex items-center gap-2 rounded-[6px] border border-[#FECACA] bg-[#FEF2F2] px-3 py-1.5 text-[12px] font-medium text-[#BA1A1A]">
                                <span class="h-[7px] w-[7px] rounded-full bg-[#DC2626]"></span>
                                Nonaktif
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- =================================================
                INFORMASI KEDINASAN
                ================================================= --}}
            <div class="overflow-hidden rounded-[12px] border border-[#BCC9CB] bg-white">

                {{-- Header card --}}
                <div class="flex items-center gap-3 border-b border-[#D9D9D9] px-6 py-5">

                    <div class="flex h-[42px] w-[42px] items-center justify-center rounded-full bg-[#E8FBF5] text-[18px] text-[#00A884]">
                        ▣
                    </div>

                    <div>

                        <h2 class="text-[18px] font-semibold text-[#14213D]">
                            Informasi Kedinasan
                        </h2>

                        <p class="mt-0.5 text-[13px] text-[#64748B]">
                            Detail instansi dan spesialisasi asesor.
                        </p>

                    </div>

                </div>


                {{-- Isi --}}
                <div class="grid grid-cols-1 gap-x-10 gap-y-7 px-6 py-6 md:grid-cols-2">

                    {{-- NIP --}}
                    <div>

                        <p class="text-[13px] text-[#434654]">
                            NIP (Nomor Induk Pegawai)
                        </p>

                        <p class="mt-1 text-[15px] font-medium text-[#14213D]">
                            {{ $asesor->nip ?: '-' }}
                        </p>

                    </div>


                    {{-- Instansi Asal --}}
                    <div>

                        <p class="text-[13px] text-[#434654]">
                            Instansi Asal
                        </p>

                        <p class="mt-1 text-[15px] font-medium text-[#14213D]">
                            {{ $asesor->instansi->nama_instansi ?? '-' }}
                        </p>

                    </div>


                    {{-- Keahlian --}}
                    <div class="md:col-span-2">

                        <p class="text-[13px] text-[#434654]">
                            Keahlian / Spesialisasi
                        </p>

                        @php
                            $namaAspek = [
                                'ASPEK_1' => 'Tata Kelola dan Manajemen',
                                'ASPEK_2' => 'Penyelenggaraan',
                                'ASPEK_3' => 'Data',
                                'ASPEK_4' => 'Keamanan Siber',
                                'ASPEK_5' => 'Teknologi Digital',
                                'ASPEK_6' => 'Keterpaduan Layanan Digital Pemerintah',
                                'ASPEK_7' => 'Kepuasan Pengguna Layanan Digital Pemerintah',
                            ];
                        @endphp

                        <div class="mt-2 flex flex-wrap gap-2">

                            @forelse ($asesor->keahlian ?? [] as $aspek)

                                <span class="inline-flex rounded-[6px] bg-[#E8F0FF] px-3 py-1.5 text-[12px] font-medium text-[#263A73]">
                                    {{ $namaAspek[$aspek] ?? $aspek }}
                                </span>

                            @empty

                                <span class="text-[15px] font-medium text-[#14213D]">
                                    -
                                </span>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            KOLOM KANAN
            ===================================================== --}}
        <div class="space-y-6">


            {{-- =================================================
                PERAN & AKSES
                ================================================= --}}
            <div class="overflow-hidden rounded-[12px] border border-[#BCC9CB] bg-white">

                {{-- Header --}}
                <div class="flex items-center gap-3 border-b border-[#D9D9D9] px-6 py-5">

                    <div class="flex h-[42px] w-[42px] items-center justify-center rounded-full bg-[#8EF0D1] text-[17px] text-[#006671]">
                        ♙
                    </div>

                    <h2 class="text-[18px] font-semibold text-[#14213D]">
                        Peran & Akses
                    </h2>

                </div>


                {{-- Isi --}}
                <div class="space-y-6 px-6 py-6">

                    {{-- Role --}}
                    <div>

                        <p class="text-[13px] text-[#434654]">
                            Role Sistem
                        </p>

                        <span class="mt-2 inline-flex rounded-[6px] border border-[#B9C4FF] bg-[#EEF1FF] px-3 py-1.5 text-[12px] font-semibold uppercase text-[#4A45D6]">
                            {{ $asesor->user->role->nama_role ?? 'ASESOR' }}
                        </span>

                    </div>


                    {{-- Wilayah Penugasan --}}
                    <div>

                        <p class="text-[13px] text-[#434654]">
                            Wilayah Penugasan
                        </p>

                        <div class="mt-2 space-y-2">

                            @forelse ($asesor->wilayahPenugasan as $wilayah)

                                <div class="flex items-center gap-3 rounded-[8px] border border-[#D9E0E0] bg-white px-3 py-2.5 text-[13px] text-[#14213D]">

                                    <span class="text-[#434654]">
                                        ●
                                    </span>

                                    <span>
                                        {{ $wilayah->nama_wilayah }}
                                    </span>

                                </div>

                            @empty

                                <div class="rounded-[8px] border border-[#D9E0E0] px-3 py-2.5 text-[13px] text-[#64748B]">
                                    Belum ada wilayah penugasan.
                                </div>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                INFO SISTEM
                ================================================= --}}
            <div class="overflow-hidden rounded-[12px] border border-[#C7D4E8] bg-[#EEF4FF]">

                {{-- Header --}}
                <div class="flex items-center gap-3 px-6 py-5">

                    <span class="text-[15px] text-[#434654]">
                        ●
                    </span>

                    <h2 class="text-[17px] font-semibold text-[#14213D]">
                        Info Sistem
                    </h2>

                </div>


                {{-- Isi --}}
                <div class="px-6 pb-6">

                    {{-- Terakhir Login --}}
                    <div class="flex items-center justify-between border-t border-[#D4DEED] py-4">

                        <span class="text-[13px] text-[#434654]">
                            Terakhir Login
                        </span>

                        <span class="text-[13px] font-medium text-[#14213D]">
                            @if ($asesor->user && $asesor->user->last_login)

                                {{ \Carbon\Carbon::parse($asesor->user->last_login)->format('d M Y, H:i') }} WIB

                            @else

                                Belum login

                            @endif
                        </span>

                    </div>


                    {{-- Tanggal Dibuat --}}
                    <div class="flex items-center justify-between border-t border-[#D4DEED] py-4">

                        <span class="text-[13px] text-[#434654]">
                            Tanggal Dibuat
                        </span>

                        <span class="text-[13px] font-medium text-[#14213D]">
                            {{ $asesor->created_at?->format('d M Y') ?? '-' }}
                        </span>

                    </div>


                    {{-- Dibuat Oleh --}}
                    <div class="flex items-center justify-between border-t border-[#D4DEED] pt-4">

                        <span class="text-[13px] text-[#434654]">
                            Dibuat Oleh
                        </span>

                        <span class="text-[13px] font-medium text-[#14213D]">
                            Admin
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection