@extends('layouts.sidebar.sidebar-user')

@section('content')

<div class="w-full px-4 pt-3 pb-6 sm:px-6 lg:px-8 lg:pt-4 lg:pb-8 space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div>
        <a href="{{ route('user.profile') }}"
           class="mb-4 inline-flex items-center gap-2 text-sm font-medium text-gray-500 transition-colors hover:text-[#12a89d] dark:text-gray-400 dark:hover:text-[#12a89d]">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white lg:text-[28px]">
                Edit Profil
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Perbarui informasi akun, foto profil, dan keamanan password Anda.
            </p>
        </div>
    </div>

    {{-- =========================================================
        ERROR ALERTS
    ========================================================== --}}
    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 dark:border-red-900/50 dark:bg-red-900/20">
            <div class="flex gap-3">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M10.29 3.86l-8.82 15a2 2 0 001.71 3h17.64a1.99 1.99 0 001.71-3l-8.82-15a2 2 0 00-3.42 0z"/>
                </svg>

                <div>
                    <p class="text-sm font-bold text-red-800 dark:text-red-400">
                        Terdapat kesalahan
                    </p>

                    <ul class="mt-1 list-inside list-disc space-y-1 text-sm text-red-700 dark:text-red-300">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- =========================================================
        FORM
    ========================================================== --}}
    <form action="{{ route('user.profile.update') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        {{-- =====================================================
    PROFILE SUMMARY
====================================================== --}}
<div
    class="relative overflow-hidden rounded-2xl
           border border-gray-200
           bg-white
           shadow-sm
           dark:border-gray-700
           dark:bg-[#1f2937]"
>

    {{-- Decorative Background --}}
    <div
        class="absolute -left-12 bottom-[-72px] h-44 w-44 rounded-full
               bg-[#f6c400]/10
               dark:bg-[#f6c400]/10"
    ></div>

    <div
        class="absolute -right-16 -top-20 h-56 w-56 rounded-full
               bg-[#12a89d]/10
               dark:bg-[#12a89d]/10"
    ></div>


    {{-- =================================================
        CONTENT
    ================================================== --}}
    <div
        class="relative flex flex-col gap-6
               px-6 py-6
               sm:px-8
               lg:flex-row lg:items-center lg:gap-10
               lg:px-9 lg:py-7"
    >

        {{-- =================================================
            USER INFO
        ================================================== --}}
        <div class="flex min-w-0 items-center gap-5">


            {{-- =================================================
                FOTO PROFIL
            ================================================== --}}
            <div class="relative shrink-0">

                {{-- Outer Stroke --}}
                <div
                    class="rounded-full
                           bg-gradient-to-br from-[#2dd4bf] via-[#59c9c8] to-[#123d45]
                           p-[3px]
                           shadow-[0_0_0_2px_rgba(45,212,191,0.12),0_8px_22px_rgba(18,168,157,0.22)]
                           dark:shadow-[0_0_0_2px_rgba(45,212,191,0.10),0_8px_24px_rgba(0,0,0,0.35)]"
                >

                    <img
                        id="preview-foto"
                        src="{{ $user->foto_profil
                            ? asset('storage/' . $user->foto_profil)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&background=e9f9f7&color=12a89d' }}"
                        alt="Foto Profil"
                        class="h-[120px] w-[120px]
                               rounded-full
                               border-[3px] border-white
                               bg-[#e9f9f7]
                               object-cover
                               shadow-sm
                               dark:border-[#1f2937]
                               dark:bg-[#123d45]"
                    >

                </div>


                {{-- CAMERA BUTTON --}}
                <label
                    for="foto_profil"
                    class="absolute bottom-1 right-1
                           flex h-11 w-11 cursor-pointer items-center justify-center
                           rounded-full
                           border-2 border-white
                           bg-[#12a89d]
                           text-white
                           shadow-md
                           transition-all duration-200
                           hover:scale-105
                           hover:bg-[#0d857c]
                           dark:border-[#1f2937]
                           dark:bg-[#12a89d]
                           dark:hover:bg-[#0d857c]"
                    title="Ganti foto profil"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M4 7h3l1.5-2h7L17 7h3a1 1 0 011 1v10a1 1 0 01-1 1H4a1 1 0 01-1-1V8a1 1 0 011-1z"
                        />

                        <circle
                            cx="12"
                            cy="13"
                            r="3.5"
                            stroke-width="1.8"
                        />

                    </svg>

                </label>


                {{-- FILE INPUT --}}
                <input
                    type="file"
                    id="foto_profil"
                    name="foto_profil"
                    accept="image/jpeg,image/png,image/jpg,image/webp"
                    class="hidden"
                    onchange="previewImage(this)"
                >

            </div>


            {{-- =================================================
                NAME & ROLE
            ================================================== --}}
            <div class="min-w-0">

                <h2
                    class="truncate text-2xl font-bold
                           text-[#12a89d]
                           sm:text-[27px]
                           dark:text-[#2dd4bf]"
                >
                    {{ $user->name ?? 'User' }}
                </h2>

                <p
                    class="mt-1 truncate text-[15px] font-medium
                           text-gray-600
                           dark:text-gray-200"
                >
                    {{ $user->email ?? '-' }}
                </p>

                <span
                    class="mt-3 inline-flex rounded-full
                           bg-[#f6c400]
                           px-4 py-1
                           text-[11px]
                           font-bold
                           uppercase
                           text-white"
                >
                    {{ $user->role->nama_role ?? $user->role->name ?? 'USER' }}
                </span>

            </div>

        </div>


        {{-- =================================================
            USER SUMMARY
        ================================================== --}}
        <div
            class="grid w-full max-w-[700px]
                   grid-cols-1 gap-4
                   border-t border-gray-200
                   pt-5
                   sm:grid-cols-3 sm:gap-5
                   lg:ml-auto lg:flex-1
                   lg:border-l lg:border-t-0
                   lg:border-gray-200
                   lg:pl-10 lg:pt-0
                   dark:border-gray-700"
        >

            {{-- BERGABUNG --}}
            <div class="flex min-w-0 items-center gap-2.5">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center
                           rounded-full
                           bg-teal-50
                           text-[#12a89d]
                           dark:bg-[#123d45]
                           dark:text-[#2dd4bf]"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <rect
                            x="3"
                            y="4"
                            width="18"
                            height="17"
                            rx="2"
                            stroke-width="1.6"
                        />

                        <path
                            stroke-width="1.6"
                            d="M16 2v4M8 2v4M3 9h18"
                        />

                    </svg>

                </div>

                <div class="min-w-0">

                    <p
                        class="text-[12px] font-semibold
                               text-gray-800
                               dark:text-white"
                    >
                        Bergabung sejak
                    </p>

                    <p
                        class="mt-1 truncate text-[13px] font-medium
                               text-gray-500
                               dark:text-gray-300"
                    >
                        {{ $user->created_at ? $user->created_at->format('d F Y') : '-' }}
                    </p>

                </div>

            </div>


            {{-- ROLE --}}
            <div class="flex min-w-0 items-center gap-2.5">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center
                           rounded-full
                           bg-teal-50
                           text-[#12a89d]
                           dark:bg-[#123d45]
                           dark:text-[#2dd4bf]"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.6"
                            d="M20 21a8 8 0 10-16 0M12 13a4 4 0 100-8 4 4 0 000 8z"
                        />

                    </svg>

                </div>

                <div class="min-w-0">

                    <p
                        class="text-[12px] font-semibold
                               text-gray-800
                               dark:text-white"
                    >
                        Role
                    </p>

                    <p
                        class="mt-1 truncate text-[13px] font-medium uppercase
                               text-gray-500
                               dark:text-gray-300"
                    >
                        {{ $user->role->nama_role ?? $user->role->name ?? 'USER' }}
                    </p>

                </div>

            </div>


            {{-- INSTANSI --}}
            <div class="flex min-w-0 items-center gap-2.5">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center
                           rounded-full
                           bg-teal-50
                           text-[#12a89d]
                           dark:bg-[#123d45]
                           dark:text-[#2dd4bf]"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.6"
                            d="M4 21h16M6 21V5l6-3 6 3v16M9 21v-5h6v5M9 8h.01M15 8h.01M9 11h.01M15 11h.01"
                        />

                    </svg>

                </div>

                <div class="min-w-0">

                    <p
                        class="text-[12px] font-semibold
                               text-gray-800
                               dark:text-white"
                    >
                        Instansi
                    </p>

                    <p
                        class="mt-1 truncate text-[13px] font-medium
                               text-gray-500
                               dark:text-gray-300"
                    >
                        {{ $user->instansi->nama_instansi ?? '-' }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =================================================
        PHOTO INFO
    ================================================== --}}
    <div
        class="relative border-t
               border-gray-200
               px-6 py-2.5
               text-[11px]
               text-gray-500
               sm:px-8
               lg:px-9
               dark:border-gray-700
               dark:text-gray-400"
    >
        JPG, JPEG, PNG, WEBP · Maks. 2MB · Klik ikon kamera pada foto profil untuk mengganti foto
    </div>

</div>


        {{-- =====================================================
            INFORMASI AKUN CARD
        ====================================================== --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

            {{-- HEADER CARD --}}
            <div class="flex items-center gap-4 border-b border-gray-200 bg-gray-50/50 px-6 py-5 dark:border-gray-700 dark:bg-gray-800/50">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-teal-50 text-[#12a89d] dark:bg-teal-900/30 dark:text-teal-400">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 12a4 4 0 100-8 4 4 0 000 8zm-7 9a7 7 0 0114 0"
                        />

                    </svg>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        Informasi Akun
                    </h2>

                    <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                        Perbarui nama dan alamat email akun Anda.
                    </p>

                </div>

            </div>

            {{-- CONTENT CARD --}}
            <div class="p-6 lg:p-8">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- NAMA --}}
                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-sm font-semibold text-gray-900 dark:text-gray-200"
                        >
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 transition-all placeholder:text-gray-400 focus:border-[#12a89d] focus:outline-none focus:ring-2 focus:ring-[#12a89d]/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-teal-400"
                        >

                        @error('name')
                            <p class="mt-2 text-xs font-medium text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- USERNAME --}}
                    <div>

                        <label
                            for="username"
                            class="mb-2 block text-sm font-semibold text-gray-900 dark:text-gray-200"
                        >
                            Username
                        </label>

                        <div class="relative">

                            <input
                                type="text"
                                id="username"
                                value="{{ $user->username }}"
                                readonly
                                class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 pr-11 text-sm text-gray-500 dark:border-gray-700 dark:bg-gray-800/60 dark:text-gray-400"
                            >

                            {{-- LOCK ICON --}}
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500">

                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                    <rect
                                        x="4"
                                        y="11"
                                        width="16"
                                        height="10"
                                        rx="2"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        stroke-width="1.8"
                                        d="M8 11V7a4 4 0 018 0v4"
                                    />

                                </svg>

                            </div>

                        </div>

                        <p class="mt-2 text-[11px] text-gray-500 dark:text-gray-400">
                            Username tidak dapat diubah.
                        </p>

                    </div>

                    {{-- EMAIL --}}
                    <div class="md:col-span-2">

                        <label
                            for="email"
                            class="mb-2 block text-sm font-semibold text-gray-900 dark:text-gray-200"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 transition-all placeholder:text-gray-400 focus:border-[#12a89d] focus:outline-none focus:ring-2 focus:ring-[#12a89d]/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-teal-400"
                        >

                        @error('email')
                            <p class="mt-2 text-xs font-medium text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            KEAMANAN AKUN CARD
        ========================================================== --}}
        <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

            {{-- HEADER CARD --}}
            <div class="flex items-center gap-4 border-b border-gray-200 bg-gray-50/50 px-6 py-5 dark:border-gray-700 dark:bg-gray-800/50">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-teal-50 text-[#12a89d] dark:bg-teal-900/30 dark:text-teal-400">

                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <rect
                            x="4"
                            y="10"
                            width="16"
                            height="11"
                            rx="2"
                            stroke-width="1.8"
                        />

                        <path
                            stroke-width="1.8"
                            d="M8 10V7a4 4 0 018 0v3"
                        />

                    </svg>

                </div>

                <div>

                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                        Keamanan Akun
                    </h2>

                    <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                        Ubah password akun Anda.
                    </p>

                </div>

            </div>

            {{-- CONTENT CARD --}}
            <div class="space-y-6 p-6 lg:p-8">

                {{-- PASSWORD LAMA --}}
                <div>

                    <label
                        for="password_lama"
                        class="mb-2 block text-sm font-semibold text-gray-900 dark:text-gray-200"
                    >
                        Password Lama
                    </label>

                    <input
                        type="password"
                        id="password_lama"
                        name="password_lama"
                        autocomplete="current-password"
                        class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 transition-all focus:border-[#12a89d] focus:outline-none focus:ring-2 focus:ring-[#12a89d]/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-teal-400"
                    >

                    @error('password_lama')
                        <p class="mt-2 text-xs font-medium text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                    <p class="mt-2 text-[11px] text-gray-500 dark:text-gray-400">
                        Wajib diisi jika ingin mengganti password.
                    </p>

                </div>

                {{-- PASSWORD BARU & KONFIRMASI --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold text-gray-900 dark:text-gray-200"
                        >
                            Password Baru
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 transition-all focus:border-[#12a89d] focus:outline-none focus:ring-2 focus:ring-[#12a89d]/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-teal-400"
                        >

                        @error('password')
                            <p class="mt-2 text-xs font-medium text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-2 text-[11px] text-gray-500 dark:text-gray-400">
                            Minimal 8 karakter.
                        </p>

                    </div>

                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-semibold text-gray-900 dark:text-gray-200"
                        >
                            Konfirmasi Password Baru
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            autocomplete="new-password"
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 transition-all focus:border-[#12a89d] focus:outline-none focus:ring-2 focus:ring-[#12a89d]/20 dark:border-gray-600 dark:bg-gray-900 dark:text-white dark:focus:border-teal-400"
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            ACTION BUTTONS
        ========================================================== --}}
        <div class="flex items-center justify-end gap-4 pt-4 pb-8">

            <a
                href="{{ route('user.profile') }}"
                class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-6 py-2.5 text-sm font-bold text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700"
            >
                Batal
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#12a89d] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition-all hover:bg-[#0d857c] hover:shadow-md dark:shadow-none"
            >
                Simpan
            </button>

        </div>

    </form>

</div>


{{-- =========================================================
    SCRIPT UNTUK PREVIEW FOTO
========================================================= --}}
<script>

    function previewImage(input) {

        if (input.files && input.files[0]) {

            const reader = new FileReader();

            reader.onload = function(e) {

                const preview = document.getElementById('preview-foto');

                if (preview) {
                    preview.src = e.target.result;
                }

            };

            reader.readAsDataURL(input.files[0]);
        }

    }

</script>

@endsection