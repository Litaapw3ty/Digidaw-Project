
@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full max-w-[1600px] mx-auto space-y-6 px-1 sm:px-2 lg:px-4">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-6 rounded-full bg-[#12a89d]"></div>

                <span class="text-xs font-semibold uppercase tracking-wider text-[#12a89d]">
                    Pengaturan Akun
                </span>
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold theme-title tracking-tight">
                Edit Profil Akun
            </h1>

            <p class="text-sm sm:text-base theme-muted mt-1.5">
                Perbarui informasi pribadi dan keamanan akun Anda.
            </p>
        </div>

        {{-- KEMBALI --}}
        <a href="{{ route('asesor.profil') }}"
        class="shrink-0 inline-flex items-center justify-center px-5 py-2.5 text-base font-medium text-rose-500 border border-rose-400 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors">
            Kembali
        </a>
    </div>


    {{-- =========================================================
        INFO UNIT KERJA
    ========================================================== --}}
    <div class="theme-card border theme-border rounded-2xl shadow-sm overflow-hidden">

        <div class="px-5 sm:px-6 lg:px-8 py-4">

            <div class="flex items-center gap-4">

                {{-- ICON --}}
                <div class="w-11 h-11 rounded-xl
                            bg-[#12a89d]/10
                            text-[#12a89d]
                            dark:bg-[#14b8a6]/20
                            dark:text-[#14b8a6]
                            flex items-center justify-center shrink-0">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0v-4m0 4h5m-5-4h5m-5 0V9m5 4V9m0 0H10">
                        </path>

                    </svg>

                </div>

                {{-- INFO --}}
                <div class="flex-1 min-w-0">

                    <p class="text-[11px] font-semibold uppercase tracking-wider theme-muted">
                        Unit Kerja & Wilayah
                    </p>

                    <p class="text-sm sm:text-base font-semibold theme-title mt-1 truncate">
                        {{ $user->unit_kerja ?? 'Unit Kerja Belum Set' }}

                        <span class="theme-muted font-normal">
                            ({{ $user->wilayah ?? '-' }})
                        </span>
                    </p>

                    <p class="text-xs theme-muted mt-1">
                        NIP: {{ $user->nip ?? '-' }}
                    </p>

                </div>

                {{-- READ ONLY --}}
                <div class="hidden sm:flex items-center gap-2
                            text-xs font-medium
                            text-[#12a89d]
                            dark:text-[#14b8a6]
                            px-3 py-1.5
                            rounded-lg
                            bg-[#12a89d]/10
                            dark:bg-[#14b8a6]/15">

                    <span class="w-1.5 h-1.5 rounded-full
                                 bg-[#12a89d]
                                 dark:bg-[#14b8a6]">
                    </span>

                    Read-Only

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN FORM
    ========================================================== --}}
    <form action="{{ route('asesor.edit.update') }}"
          method="POST"
          enctype="multipart/form-data"
          class="theme-card border theme-border rounded-2xl shadow-sm overflow-hidden">

        @csrf
        @method('PUT')


        {{-- =====================================================
            FOTO PROFIL
        ====================================================== --}}
        <div class="px-5 sm:px-6 lg:px-10 py-7 sm:py-8">

            <div class="flex flex-col sm:flex-row sm:items-center gap-6">

                {{-- FOTO --}}
                <div class="relative shrink-0 mx-auto sm:mx-0">

                    <div class="relative">

                        <img id="avatarPreview"
                             src="{{ $user->profile_photo_url ?? asset('asesor_img/default-profile.svg') }}"
                             alt="Profile Preview"
                             class="w-24 h-24 sm:w-28 sm:h-28
                                    rounded-full object-cover
                                    border-4 border-[#12a89d]/15
                                    shadow-sm">

                        {{-- BUTTON CAMERA --}}
                        <label for="avatarInput"
       class="absolute right-0 bottom-0
              w-9 h-9
              rounded-full
              bg-[#12a89d]
              hover:bg-[#0e8a81]
              text-white
              flex items-center justify-center
              cursor-pointer
              shadow-md
              ring-2 ring-[#12a89d]/20
              dark:ring-[#14b8a6]/25
              transition-all duration-200
              hover:scale-105">

    <svg class="w-4 h-4"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
        </path>

        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="1.8"
              d="M15 13a3 3 0 11-6 0 3 3 0 016 0z">
        </path>

    </svg>

</label>
                    </div>

                    <input id="avatarInput"
                           type="file"
                           name="avatar"
                           class="hidden"
                           accept="image/png,image/jpeg,image/webp"
                           onchange="previewImage(event)">

                </div>


                {{-- INFO FOTO --}}
                <div class="text-center sm:text-left flex-1">

                    <div class="flex flex-col sm:flex-row sm:items-center gap-2">

                        <h3 class="text-lg font-semibold theme-title">
                            Foto Profil
                        </h3>

                        <span class="w-fit mx-auto sm:mx-0
                                     text-[11px] font-medium
                                     px-2 py-1 rounded-md
                                     bg-[#12a89d]/10
                                     text-[#12a89d]
                                     dark:bg-[#14b8a6]/15
                                     dark:text-[#14b8a6]">
                            Profil
                        </span>

                    </div>

                    <p class="text-sm theme-muted mt-1">
                        Gunakan foto yang jelas dan mudah dikenali.
                    </p>

                    <p class="text-xs theme-muted mt-1">
                        PNG, JPG, atau WEBP · Maksimal 2MB
                    </p>

                    <label for="avatarInput"
                           class="inline-flex items-center gap-2
                                  mt-4 px-4 py-2.5
                                  rounded-xl
                                  bg-[#12a89d]/10
                                  hover:bg-[#12a89d]/20
                                  text-[#12a89d]
                                  dark:text-[#14b8a6]
                                  text-sm font-medium
                                  cursor-pointer
                                  transition-colors">

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                            </path>

                        </svg>

                        Pilih Foto Baru

                    </label>

                </div>

            </div>

        </div>


        {{-- DIVIDER --}}
        <div class="border-t theme-border"></div>


        {{-- =====================================================
            INFORMASI PENGGUNA
        ====================================================== --}}
        <div class="px-5 sm:px-6 lg:px-10 py-7 sm:py-8">

            {{-- SECTION HEADER --}}
            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 rounded-xl
                            bg-[#12a89d]/10
                            text-[#12a89d]
                            dark:bg-[#14b8a6]/20
                            dark:text-[#14b8a6]
                            flex items-center justify-center shrink-0">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                        </path>

                    </svg>

                </div>

                <div>

                    <h3 class="text-base sm:text-lg font-semibold theme-title">
                        Informasi Pengguna
                    </h3>

                    <p class="text-xs sm:text-sm theme-muted mt-0.5">
                        Pastikan data akun Anda sudah benar.
                    </p>

                </div>

            </div>


            {{-- FORM GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                {{-- NAMA --}}
                <div>

                    <label class="block text-sm font-medium theme-title mb-2">
                        Nama Lengkap
                        <span class="text-rose-500">*</span>
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name', $user->name ?? '') }}"
                           required
                           class="theme-input w-full
                                  border theme-border
                                  rounded-xl
                                  px-4 py-2.5
                                  text-sm sm:text-base
                                  outline-none
                                  focus:border-[#12a89d]
                                  focus:ring-2
                                  focus:ring-[#12a89d]/10
                                  transition-all">

                    @error('name')
                        <p class="mt-1.5 text-xs text-rose-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- EMAIL --}}
                <div>

                    <label class="block text-sm font-medium theme-title mb-2">
                        Alamat Email
                        <span class="text-rose-500">*</span>
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email', $user->email ?? '') }}"
                           required
                           class="theme-input w-full
                                  border theme-border
                                  rounded-xl
                                  px-4 py-2.5
                                  text-sm sm:text-base
                                  outline-none
                                  focus:border-[#12a89d]
                                  focus:ring-2
                                  focus:ring-[#12a89d]/10
                                  transition-all">

                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- =====================================================
            KEAMANAN AKUN
        ====================================================== --}}
        <div class="border-t theme-border
                    px-5 sm:px-6 lg:px-10
                    py-7 sm:py-8">

            {{-- SECTION HEADER --}}
            <div class="flex items-center gap-3 mb-6">

                <div class="w-10 h-10 rounded-xl
                            bg-amber-100
                            text-amber-600
                            dark:bg-amber-500/15
                            dark:text-amber-400
                            flex items-center justify-center shrink-0">

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M12 15v2m-6 4h12a2 2 0 002-2V7a6 6 0 00-12 0v12a2 2 0 002 2z">
                        </path>

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M8 10h8">
                        </path>

                    </svg>

                </div>

                <div>

                    <h3 class="text-base sm:text-lg font-semibold theme-title">
                        Keamanan Akun
                    </h3>

                    <p class="text-xs sm:text-sm theme-muted mt-0.5">
                        Perbarui password untuk menjaga keamanan akun.
                    </p>

                </div>

            </div>


            {{-- PASSWORD GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                {{-- PASSWORD BARU --}}
                <div>

                    <label class="block text-sm font-medium theme-title mb-2">
                        Password Baru
                    </label>

                    <input type="password"
                           name="password"
                           placeholder="Masukkan password baru"
                           autocomplete="new-password"
                           class="theme-input w-full
                                  border theme-border
                                  rounded-xl
                                  px-4 py-2.5
                                  text-sm sm:text-base
                                  outline-none
                                  focus:border-[#12a89d]
                                  focus:ring-2
                                  focus:ring-[#12a89d]/10
                                  transition-all">

                    @error('password')
                        <p class="mt-1.5 text-xs text-rose-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- KONFIRMASI --}}
                <div>

                    <label class="block text-sm font-medium theme-title mb-2">
                        Konfirmasi Password
                    </label>

                    <input type="password"
                           name="password_confirmation"
                           placeholder="Ulangi password baru"
                           autocomplete="new-password"
                           class="theme-input w-full
                                  border theme-border
                                  rounded-xl
                                  px-4 py-2.5
                                  text-sm sm:text-base
                                  outline-none
                                  focus:border-[#12a89d]
                                  focus:ring-2
                                  focus:ring-[#12a89d]/10
                                  transition-all">

                </div>

            </div>


            {{-- INFO PASSWORD --}}
            <div class="mt-5 flex items-start gap-2.5
                        rounded-xl
                        bg-gray-50
                        dark:bg-gray-800/50
                        px-4 py-3
                        text-xs theme-muted">

                <svg class="w-4 h-4 shrink-0 mt-0.5 text-[#12a89d]"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <circle cx="12"
                            cy="12"
                            r="9"
                            stroke-width="1.5">
                    </circle>

                    <path stroke-linecap="round"
                          stroke-width="1.5"
                          d="M12 11v5">
                    </path>

                    <circle cx="12"
                            cy="8"
                            r=".5"
                            fill="currentColor">
                    </circle>

                </svg>

                <span>
                    Kosongkan kedua kolom password jika tidak ingin mengubah password.
                </span>

            </div>

        </div>


        {{-- =====================================================
            FOOTER ACTION
        ====================================================== --}}
        <div class="border-t theme-border
                    theme-footer
                    px-5 sm:px-6 lg:px-10
                    py-4 sm:py-5
                    flex flex-col-reverse sm:flex-row
                    sm:items-center
                    sm:justify-end
                    gap-3">

            {{-- BATAL --}}
            <a href="{{ route('asesor.profil') }}"
               class="inline-flex items-center justify-center
                      gap-2
                      px-5 py-2.5
                      rounded-xl
                      border theme-border
                      theme-text
                      text-sm font-medium
                      hover:bg-gray-100
                      dark:hover:bg-gray-700
                      transition-all duration-200">

                Batal

            </a>


            {{-- SIMPAN --}}
            <button type="submit"
                    class="inline-flex items-center justify-center
                           gap-2
                           px-6 py-2.5
                           rounded-xl
                           bg-[#12a89d]
                           hover:bg-[#0e8a81]
                           text-white
                           text-sm font-medium
                           shadow-sm
                           hover:shadow-md
                           transition-all duration-200
                           active:scale-[0.98]">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7">
                    </path>

                </svg>

                Simpan Perubahan

            </button>

        </div>

    </form>

</div>


{{-- =========================================================
    IMAGE PREVIEW
========================================================== --}}
<script>
    function previewImage(event) {

        const file = event.target.files[0];

        if (!file) return;

        const output = document.getElementById('avatarPreview');

        const reader = new FileReader();

        reader.onload = function () {
            output.src = reader.result;
        };

        reader.readAsDataURL(file);
    }
</script>

@endsection
