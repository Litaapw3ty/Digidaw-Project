@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full space-y-5">

```
{{-- =========================================================
    PROFILE HERO
========================================================== --}}
<div class="relative overflow-hidden rounded-2xl
            bg-white dark:bg-[#101827]
            shadow-[0_1px_8px_rgba(15,23,42,0.04)]
            dark:shadow-[0_2px_12px_rgba(0,0,0,0.15)]">

    {{-- Decorative Background --}}
    <div class="absolute inset-0 pointer-events-none overflow-hidden">

        <div class="absolute -top-28 -right-20
                    w-80 h-80 rounded-full
                    bg-[#12a89d]/[0.045]
                    dark:bg-[#12a89d]/[0.06]
                    blur-3xl">
        </div>

        <div class="absolute -bottom-32 -left-20
                    w-72 h-72 rounded-full
                    bg-[#12a89d]/[0.025]
                    dark:bg-[#12a89d]/[0.035]
                    blur-3xl">
        </div>

        <div class="absolute top-0 left-0 right-0 h-[2px]
                    bg-gradient-to-r
                    from-[#12a89d]/80
                    via-[#18c4b8]/40
                    to-transparent">
        </div>

    </div>


    <div class="relative p-5 sm:p-6 lg:p-7">

        <div class="flex flex-col xl:flex-row
                    xl:items-center
                    justify-between gap-7">


            {{-- =================================================
                PROFILE
            ================================================== --}}
            <div class="flex flex-col lg:flex-row
                        lg:items-center gap-6">


                {{-- FOTO + NAMA --}}
                <div class="flex items-center gap-4 shrink-0">

                    <div class="relative shrink-0">

                        {{-- PHOTO --}}
                        <div class="w-[82px] h-[82px]
                                    rounded-full p-[3px]
                                    bg-gradient-to-br
                                    from-[#12a89d]
                                    via-[#18c4b8]
                                    to-[#0e8a81]
                                    shadow-sm">

                            <div class="w-full h-full
                                        rounded-full overflow-hidden
                                        bg-white dark:bg-[#182233]">

                                <img
                                    src="{{ $user->profile_photo_url ?? asset('asesor_img/default-profile.svg') }}"
                                    alt="Profile"
                                    class="w-full h-full object-cover"
                                >

                            </div>

                        </div>


                        {{-- EDIT FOTO --}}
                        <a href="{{ url('/asesor/edit_asesor') }}"
                           class="absolute -bottom-1 -right-1
                                  w-8 h-8
                                  rounded-full
                                  bg-[#12a89d]
                                  hover:bg-[#0e8a81]
                                  text-white
                                  flex items-center justify-center
                                  border-[3px]
                                  border-white
                                  dark:border-[#101827]
                                  shadow-sm
                                  transition-all duration-200
                                  hover:scale-105"
                           title="Ubah Foto">

                            <svg class="w-3.5 h-3.5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0118.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                </path>

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>

                            </svg>

                        </a>

                    </div>


                    {{-- NAME --}}
                    <div class="min-w-0">

                        <div class="flex flex-wrap
                                    items-center gap-2.5">

                            <h2 class="text-xl sm:text-2xl
                                       font-bold
                                       theme-title
                                       tracking-tight">

                                {{ $user->name ?? 'User' }}

                            </h2>


                            <span class="inline-flex
                                         items-center
                                         px-2.5 py-1
                                         rounded-lg
                                         bg-[#f6c400]/10
                                         text-[#a17c00]
                                         dark:text-[#f6c400]
                                         text-[10px] sm:text-xs
                                         font-bold
                                         uppercase
                                         tracking-wider">

                                <span class="w-1.5 h-1.5
                                             rounded-full
                                             bg-[#f6c400]
                                             mr-1.5">
                                </span>

                                {{ $user->status_asesor ?? 'ASESOR' }}

                            </span>

                        </div>


                        <p class="text-sm theme-muted
                                  mt-1.5
                                  truncate
                                  max-w-[280px]
                                  sm:max-w-none">

                            {{ $user->email ?? '-' }}

                        </p>

                    </div>

                </div>


                {{-- SOFT DIVIDER --}}
                <div class="hidden lg:block
                            w-px h-12
                            bg-gray-100
                            dark:bg-white/[0.035]">
                </div>


                {{-- =================================================
                    METADATA
                ================================================== --}}
                <div class="grid grid-cols-1
                            sm:grid-cols-3
                            gap-3 sm:gap-4">


                    {{-- BERGABUNG --}}
                    <div class="flex items-center gap-3
                                rounded-xl
                                px-3.5 py-3
                                bg-gray-50/70
                                dark:bg-white/[0.025]
                                shadow-[0_1px_4px_rgba(15,23,42,0.02)]
                                dark:shadow-none">

                        <div class="w-9 h-9 rounded-lg
                                    bg-[#12a89d]/10
                                    text-[#12a89d]
                                    dark:bg-[#12a89d]/15
                                    flex items-center
                                    justify-center
                                    shrink-0">

                            <svg class="w-4.5 h-4.5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-[10px]
                                      uppercase
                                      tracking-wide
                                      font-semibold
                                      theme-muted">

                                Bergabung Sejak

                            </p>

                            <p class="text-sm
                                      font-semibold
                                      theme-title
                                      mt-0.5
                                      truncate">

                                {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->translatedFormat('j F Y') : '-' }}

                            </p>

                        </div>

                    </div>


                    {{-- ROLE --}}
                    <div class="flex items-center gap-3
                                rounded-xl
                                px-3.5 py-3
                                bg-gray-50/70
                                dark:bg-white/[0.025]
                                shadow-[0_1px_4px_rgba(15,23,42,0.02)]
                                dark:shadow-none">

                        <div class="w-9 h-9 rounded-lg
                                    bg-[#12a89d]/10
                                    text-[#12a89d]
                                    dark:bg-[#12a89d]/15
                                    flex items-center
                                    justify-center
                                    shrink-0">

                            <svg class="w-4.5 h-4.5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                </path>

                            </svg>

                        </div>

                        <div>

                            <p class="text-[10px]
                                      uppercase
                                      tracking-wide
                                      font-semibold
                                      theme-muted">

                                Role

                            </p>

                            <p class="text-sm
                                      font-semibold
                                      theme-title
                                      mt-0.5">

                                Asesor

                            </p>

                        </div>

                    </div>


                    {{-- WILAYAH --}}
                    <div class="flex items-center gap-3
                                rounded-xl
                                px-3.5 py-3
                                bg-gray-50/70
                                dark:bg-white/[0.025]
                                shadow-[0_1px_4px_rgba(15,23,42,0.02)]
                                dark:shadow-none">

                        <div class="w-9 h-9 rounded-lg
                                    bg-[#12a89d]/10
                                    text-[#12a89d]
                                    dark:bg-[#12a89d]/15
                                    flex items-center
                                    justify-center
                                    shrink-0">

                            <svg class="w-4.5 h-4.5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                </path>

                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-[10px]
                                      uppercase
                                      tracking-wide
                                      font-semibold
                                      theme-muted">

                                Wilayah

                            </p>

                            <p class="text-sm
                                      font-semibold
                                      theme-title
                                      mt-0.5
                                      truncate">

                                {{ $user->wilayah ?? '-' }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- EDIT BUTTON --}}
            <div class="xl:self-center">

                <a href="{{ url('/asesor/edit_asesor') }}"
                   class="group inline-flex
                          items-center justify-center
                          gap-2
                          w-full xl:w-auto
                          bg-[#12a89d]
                          hover:bg-[#0e8a81]
                          text-white
                          text-sm
                          font-semibold
                          px-5 py-2.5
                          rounded-xl
                          shadow-sm
                          hover:shadow-md
                          transition-all duration-200
                          active:scale-[0.98]">

                    <svg class="w-4 h-4
                                transition-transform
                                group-hover:rotate-[-8deg]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                        </path>

                    </svg>

                    <span>Edit Akun</span>

                </a>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
    DETAIL PROFIL
========================================================== --}}
<div class="rounded-2xl
            bg-white dark:bg-[#101827]
            shadow-[0_1px_8px_rgba(15,23,42,0.035)]
            dark:shadow-[0_2px_12px_rgba(0,0,0,0.12)]
            overflow-hidden">


    {{-- HEADER --}}
    <div class="px-5 sm:px-6 py-4
                flex items-center justify-between">

        <div>

            <h3 class="text-base sm:text-lg
                       font-bold theme-title">

                Detail Profil

            </h3>

            <p class="text-xs sm:text-sm
                      theme-muted mt-0.5">

                Informasi akun dan data kepegawaian asesor

            </p>

        </div>


        <div class="hidden sm:flex
                    items-center gap-2
                    px-3 py-1.5
                    rounded-lg
                    bg-[#12a89d]/[0.07]
                    text-[#12a89d]
                    text-xs font-semibold">

            <span class="w-1.5 h-1.5
                         rounded-full
                         bg-[#12a89d]">
            </span>

            Profil Aktif

        </div>

    </div>


    {{-- CONTENT --}}
    <div class="px-5 sm:px-6 pb-6">

        <div class="grid grid-cols-1
                    lg:grid-cols-2
                    gap-5">


            {{-- =================================================
                INFORMASI AKUN
            ================================================== --}}
            <div class="rounded-xl
                        bg-gray-50/70
                        dark:bg-white/[0.025]
                        p-5
                        shadow-[0_1px_5px_rgba(15,23,42,0.025)]
                        dark:shadow-none">

                {{-- HEADER --}}
                <div class="flex items-center
                            gap-3 mb-5">

                    <div class="w-10 h-10
                                rounded-xl
                                bg-[#12a89d]/10
                                text-[#12a89d]
                                dark:bg-[#12a89d]/15
                                flex items-center
                                justify-center
                                shrink-0">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                            </path>

                        </svg>

                    </div>


                    <div>

                        <h3 class="text-sm sm:text-base
                                   font-bold theme-title">

                            Informasi Akun

                        </h3>

                        <p class="text-xs theme-muted mt-0.5">

                            Detail identitas pengguna

                        </p>

                    </div>

                </div>


                {{-- DATA --}}
                <div class="space-y-1">


                    {{-- NAMA --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                gap-1 sm:gap-4
                                py-3">

                        <span class="text-xs
                                     font-semibold
                                     theme-muted
                                     sm:w-32
                                     shrink-0">

                            Nama Lengkap

                        </span>

                        <span class="hidden sm:block
                                     theme-muted
                                     opacity-40">

                            :

                        </span>

                        <span class="text-sm
                                     font-semibold
                                     theme-title">

                            {{ $user->name ?? '-' }}

                        </span>

                    </div>


                    {{-- EMAIL --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                gap-1 sm:gap-4
                                py-3">

                        <span class="text-xs
                                     font-semibold
                                     theme-muted
                                     sm:w-32
                                     shrink-0">

                            Email

                        </span>

                        <span class="hidden sm:block
                                     theme-muted
                                     opacity-40">

                            :

                        </span>

                        <span class="text-sm
                                     font-medium
                                     theme-title
                                     break-all">

                            {{ $user->email ?? '-' }}

                        </span>

                    </div>


                    {{-- STATUS --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                gap-2 sm:gap-4
                                py-3">

                        <span class="text-xs
                                     font-semibold
                                     theme-muted
                                     sm:w-32
                                     shrink-0">

                            Status Akun

                        </span>

                        <span class="hidden sm:block
                                     theme-muted
                                     opacity-40">

                            :

                        </span>


                        <span class="inline-flex
                                     items-center
                                     w-fit
                                     gap-1.5
                                     px-2.5 py-1
                                     rounded-lg
                                     bg-emerald-100
                                     text-emerald-700
                                     dark:bg-emerald-500/10
                                     dark:text-emerald-400
                                     text-xs
                                     font-semibold">

                            <span class="w-1.5 h-1.5
                                         rounded-full
                                         bg-emerald-500">
                            </span>

                            {{ $user->status_asesor ?? 'AKTIF' }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                DATA KEPEGAWAIAN
            ================================================== --}}
            <div class="rounded-xl
                        bg-gray-50/70
                        dark:bg-white/[0.025]
                        p-5
                        shadow-[0_1px_5px_rgba(15,23,42,0.025)]
                        dark:shadow-none">

                {{-- HEADER --}}
                <div class="flex items-center
                            gap-3 mb-5">

                    <div class="w-10 h-10
                                rounded-xl
                                bg-[#12a89d]/10
                                text-[#12a89d]
                                dark:bg-[#12a89d]/15
                                flex items-center
                                justify-center
                                shrink-0">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0v-4m0 4h5m-5-4h5m-5 0V9m5 4V9m0 0H10">
                            </path>

                        </svg>

                    </div>


                    <div>

                        <h3 class="text-sm sm:text-base
                                   font-bold theme-title">

                            Data Kepegawaian

                        </h3>

                        <p class="text-xs theme-muted mt-0.5">

                            Informasi jabatan dan unit kerja

                        </p>

                    </div>

                </div>


                {{-- DATA --}}
                <div class="space-y-1">


                    {{-- NIP --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                gap-1 sm:gap-4
                                py-3">

                        <span class="text-xs
                                     font-semibold
                                     theme-muted
                                     sm:w-32
                                     shrink-0">

                            NIP

                        </span>

                        <span class="hidden sm:block
                                     theme-muted
                                     opacity-40">

                            :

                        </span>

                        <span class="text-sm
                                     font-semibold
                                     theme-title">

                            {{ $user->nip ?? '-' }}

                        </span>

                    </div>


                    {{-- JABATAN --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                gap-1 sm:gap-4
                                py-3">

                        <span class="text-xs
                                     font-semibold
                                     theme-muted
                                     sm:w-32
                                     shrink-0">

                            Jabatan

                        </span>

                        <span class="hidden sm:block
                                     theme-muted
                                     opacity-40">

                            :

                        </span>

                        <span class="text-sm
                                     font-semibold
                                     theme-title">

                            {{ $user->jabatan ?? '-' }}

                        </span>

                    </div>


                    {{-- UNIT KERJA --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                gap-1 sm:gap-4
                                py-3">

                        <span class="text-xs
                                     font-semibold
                                     theme-muted
                                     sm:w-32
                                     shrink-0">

                            Unit Kerja

                        </span>

                        <span class="hidden sm:block
                                     theme-muted
                                     opacity-40">

                            :

                        </span>

                        <span class="text-sm
                                     font-semibold
                                     theme-title">

                            {{ $user->unit_kerja ?? '-' }}

                        </span>

                    </div>


                    {{-- WILAYAH --}}
                    <div class="flex flex-col sm:flex-row
                                sm:items-center
                                gap-1 sm:gap-4
                                py-3">

                        <span class="text-xs
                                     font-semibold
                                     theme-muted
                                     sm:w-32
                                     shrink-0">

                            Wilayah

                        </span>

                        <span class="hidden sm:block
                                     theme-muted
                                     opacity-40">

                            :

                        </span>

                        <span class="text-sm
                                     font-semibold
                                     theme-title">

                            {{ $user->wilayah ?? '-' }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
```

</div>
@endsection
