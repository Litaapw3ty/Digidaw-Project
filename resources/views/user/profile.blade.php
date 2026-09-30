@extends('layouts.sidebar.sidebar-user')

@section('content')

<div class="w-full px-4 py-6 sm:px-6 lg:px-8 lg:py-8 space-y-6">

    {{-- =========================================================
        PROFILE HEADER
    ========================================================== --}}
    <div class="relative overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

        {{-- Decorative Background --}}
        <div class="pointer-events-none absolute -right-24 -top-24 h-64 w-64 rounded-full bg-[#12a89d]/5 dark:bg-[#12a89d]/10"></div>

        <div class="pointer-events-none absolute -bottom-28 -left-20 h-56 w-56 rounded-full bg-[#f4b728]/5 dark:bg-[#f4b728]/10"></div>

        <div class="relative px-6 py-6 lg:px-8 lg:py-7">

            <div class="flex flex-col gap-7 xl:flex-row xl:items-center xl:justify-between">

                {{-- =================================================
                    USER INFO
                ================================================== --}}
                <div class="flex items-center gap-6">

  
                    
                    {{-- AVATAR --}}
<div class="relative shrink-0">

    {{-- Soft ring + avatar --}}
    <div class="relative rounded-full bg-gradient-to-br from-[#59c9c8] via-[#b8eeee] to-transparent p-[3px] shadow-[0_8px_24px_rgba(18,168,157,0.18)]">

        <div class="flex h-[110px] w-[110px] items-center justify-center overflow-hidden rounded-full border-[4px] border-white bg-[#e9f9f7] dark:border-gray-800 dark:bg-teal-900/30">

            @if($user->foto_profil)

                <img
                    src="{{ asset('storage/' . $user->foto_profil) }}"
                    alt="Foto Profil"
                    class="h-full w-full object-cover"
                >

            @else

                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'U') }}&background=e9f9f7&color=12a89d"
                    alt="Foto Profil"
                    class="h-full w-full object-cover"
                >

            @endif

        </div>

    </div>

</div>
                    


                    {{-- NAME & ROLE --}}
                    <div class="min-w-0">

                        <h1 class="text-2xl font-bold tracking-tight text-[#12a89d] dark:text-teal-400 lg:text-[27px]">
                            {{ $user->name }}
                        </h1>

                        <p class="mt-1 max-w-[360px] truncate text-sm text-gray-500 dark:text-gray-400">
                            {{ $user->email }}
                        </p>

                        <div class="mt-2.5">

                            <span class="inline-flex items-center rounded-full bg-[#f4b728] px-4 py-1 text-[10px] font-bold uppercase tracking-wider text-white shadow-sm">
                                {{ $user->role->nama_role ?? 'USER' }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    SUMMARY
                ================================================== --}}
                <div class="flex flex-wrap items-center gap-6 lg:gap-8">

                    {{-- BERGABUNG --}}
                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-teal-50 text-[#12a89d] dark:bg-teal-900/30 dark:text-teal-400">

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
                                    height="18"
                                    rx="2"
                                    stroke-width="1.8"
                                />

                                <path
                                    stroke-width="1.8"
                                    d="M16 2v4M8 2v4M3 10h18"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-[13px] font-semibold text-gray-900 dark:text-gray-200">
                                Bergabung sejak
                            </p>

                            <p class="mt-0.5 text-[13px] text-gray-500 dark:text-gray-400">
                                {{ $user->created_at?->translatedFormat('d F Y') ?? '-' }}
                            </p>

                        </div>

                    </div>


                    {{-- ROLE --}}
                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-teal-50 text-[#12a89d] dark:bg-teal-900/30 dark:text-teal-400">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    cx="12"
                                    cy="8"
                                    r="3"
                                    stroke-width="1.8"
                                />

                                <path
                                    stroke-width="1.8"
                                    d="M5 21a7 7 0 0114 0"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-[13px] font-semibold text-gray-900 dark:text-gray-200">
                                Role
                            </p>

                            <p class="mt-0.5 text-[13px] text-gray-500 dark:text-gray-400">
                                {{ $user->role->nama_role ?? '-' }}
                            </p>

                        </div>

                    </div>


                    {{-- INSTANSI --}}
                    <div class="flex max-w-[260px] items-center gap-3">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-teal-50 text-[#12a89d] dark:bg-teal-900/30 dark:text-teal-400">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-width="1.8"
                                    d="M3 21h18M5 21V8l7-4 7 4v13M9 21v-4h6v4M9 10h1M14 10h1M9 13h1M14 13h1"
                                />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-[13px] font-semibold text-gray-900 dark:text-gray-200">
                                Instansi
                            </p>

                            <p class="mt-0.5 truncate text-[13px] text-gray-500 dark:text-gray-400">
                                {{ $user->instansi->nama_instansi ?? '-' }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        SUCCESS ALERT
    ========================================================== --}}
    @if(session('success'))

        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 dark:border-emerald-800/50 dark:bg-emerald-900/20">

            <div class="flex items-center gap-3">

                <svg
                    class="h-5 w-5 text-emerald-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                <p class="text-sm font-semibold text-emerald-800 dark:text-emerald-400">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- =========================================================
        DETAIL SECTION
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

        {{-- TAB HEADER --}}
        <div class="border-b border-gray-200 px-7 dark:border-gray-700">

            <div class="flex h-[58px] items-center">

                <div class="relative flex h-full items-center gap-2 text-sm font-bold text-[#12a89d] dark:text-teal-400">

                    <svg
                        class="h-[18px] w-[18px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-width="1.8"
                            d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z"
                        />

                        <path
                            stroke-width="1.8"
                            d="M9 12l2 2 4-4"
                        />
                    </svg>

                    Detail

                    <div class="absolute bottom-0 left-0 right-0 h-[2px] bg-[#12a89d] dark:bg-teal-400"></div>

                </div>

            </div>

        </div>


        {{-- CONTENT --}}
        <div class="p-6 lg:p-8">

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

                {{-- =================================================
                    INFORMASI USER
                ================================================== --}}
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">

                    {{-- HEADER --}}
                    <div class="flex items-center justify-between gap-4 border-b border-gray-200 bg-gray-50/50 px-6 py-5 dark:border-gray-700 dark:bg-gray-800/50">

                        <div class="flex items-center gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-teal-50 text-[#12a89d] dark:bg-teal-900/30 dark:text-teal-400">

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        cx="12"
                                        cy="8"
                                        r="3"
                                        stroke-width="1.8"
                                    />

                                    <path
                                        stroke-width="1.8"
                                        d="M5 21a7 7 0 0114 0"
                                    />
                                </svg>

                            </div>

                            <div>

                                <h2 class="text-[17px] font-bold text-gray-900 dark:text-white">
                                    Informasi User
                                </h2>

                                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                    Informasi akun pengguna
                                </p>

                            </div>

                        </div>


                        <a
                            href="{{ route('user.profile.edit') }}"
                            class="inline-flex shrink-0 items-center gap-2 rounded-lg bg-[#12a89d] px-3.5 py-2 text-xs font-semibold text-white transition-colors hover:bg-[#0e9187]"
                        >

                            <svg
                                class="h-3.5 w-3.5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11v-5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                />
                            </svg>

                            Edit Profil

                        </a>

                    </div>


                    {{-- DATA --}}
                    <div class="space-y-4 px-6 py-6">

                        <div class="grid grid-cols-[100px_15px_1fr] items-start sm:grid-cols-[120px_15px_1fr]">

                            <span class="text-[13px] font-medium text-gray-500 dark:text-gray-400">
                                Nama Lengkap
                            </span>

                            <span class="text-gray-400 dark:text-gray-500">
                                :
                            </span>

                            <span class="break-words text-[14px] font-semibold text-gray-900 dark:text-white">
                                {{ $user->name ?? '-' }}
                            </span>

                        </div>


                        <div class="grid grid-cols-[100px_15px_1fr] items-start sm:grid-cols-[120px_15px_1fr]">

                            <span class="text-[13px] font-medium text-gray-500 dark:text-gray-400">
                                Username
                            </span>

                            <span class="text-gray-400 dark:text-gray-500">
                                :
                            </span>

                            <span class="break-words text-[14px] font-semibold text-gray-900 dark:text-white">
                                {{ $user->username ?? '-' }}
                            </span>

                        </div>


                        <div class="grid grid-cols-[100px_15px_1fr] items-start sm:grid-cols-[120px_15px_1fr]">

                            <span class="text-[13px] font-medium text-gray-500 dark:text-gray-400">
                                Email
                            </span>

                            <span class="text-gray-400 dark:text-gray-500">
                                :
                            </span>

                            <span class="break-words text-[14px] font-semibold text-gray-900 dark:text-white">
                                {{ $user->email ?? '-' }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    INSTANSI
                ================================================== --}}
                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">

                    {{-- HEADER --}}
                    <div class="flex items-center gap-4 border-b border-gray-200 bg-gray-50/50 px-6 py-5 dark:border-gray-700 dark:bg-gray-800/50">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-teal-50 text-[#12a89d] dark:bg-teal-900/30 dark:text-teal-400">

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-width="1.8"
                                    d="M3 21h18M5 21V8l7-4 7 4v13M9 21v-4h6v4M9 10h1M14 10h1M9 13h1M14 13h1"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2 class="text-[17px] font-bold text-gray-900 dark:text-white">
                                Instansi
                            </h2>

                            <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                Informasi instansi user
                            </p>

                        </div>

                    </div>


                    {{-- DATA --}}
                    <div class="space-y-4 px-6 py-6">

                        <div class="grid grid-cols-[100px_15px_1fr] items-start sm:grid-cols-[120px_15px_1fr]">

                            <span class="text-[13px] font-medium text-gray-500 dark:text-gray-400">
                                Kode
                            </span>

                            <span class="text-gray-400 dark:text-gray-500">
                                :
                            </span>

                            <span class="break-words text-[14px] font-semibold text-gray-900 dark:text-white">
                                {{ $user->instansi->kode_instansi ?? '-' }}
                            </span>

                        </div>


                        <div class="grid grid-cols-[100px_15px_1fr] items-start sm:grid-cols-[120px_15px_1fr]">

                            <span class="text-[13px] font-medium text-gray-500 dark:text-gray-400">
                                Akronim
                            </span>

                            <span class="text-gray-400 dark:text-gray-500">
                                :
                            </span>

                            <span class="break-words text-[14px] font-semibold text-gray-900 dark:text-white">
                                -
                            </span>

                        </div>


                        <div class="grid grid-cols-[100px_15px_1fr] items-start sm:grid-cols-[120px_15px_1fr]">

                            <span class="text-[13px] font-medium text-gray-500 dark:text-gray-400">
                                Instansi
                            </span>

                            <span class="text-gray-400 dark:text-gray-500">
                                :
                            </span>

                            <span class="break-words text-[14px] font-semibold text-gray-900 dark:text-white">
                                {{ $user->instansi->nama_instansi ?? '-' }}
                            </span>

                        </div>


                        <div class="grid grid-cols-[100px_15px_1fr] items-start sm:grid-cols-[120px_15px_1fr]">

                            <span class="text-[13px] font-medium text-gray-500 dark:text-gray-400">
                                Kategori
                            </span>

                            <span class="text-gray-400 dark:text-gray-500">
                                :
                            </span>

                            <span class="break-words text-[14px] font-semibold text-gray-900 dark:text-white">

                                @switch($user->instansi->kategori ?? null)

                                    @case('PUSAT')
                                        Pemerintah Pusat
                                        @break

                                    @case('PROVINSI')
                                        Pemerintah Provinsi
                                        @break

                                    @case('KABUPATEN')
                                        Pemerintah Kabupaten
                                        @break

                                    @case('KOTA')
                                        Pemerintah Kota
                                        @break

                                    @case('LAINNYA')
                                        Lainnya
                                        @break

                                    @default
                                        -

                                @endswitch

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection