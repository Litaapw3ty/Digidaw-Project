@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- =========================================================
         HEADER HALAMAN
    ========================================================== --}}
    <div class="mb-7">

        <h1 class="text-[28px] font-semibold leading-tight text-[#202B3C]">
            Verifikasi Bukti
        </h1>

        <p class="mt-1 text-[16px] text-[#667793]">
            Periksa dan validasi dokumen bukti yang diunggah oleh instansi
            untuk setiap indikator penilaian dalam 7 aspek evaluasi pemerintahan digital.
        </p>

    </div>


    {{-- =========================================================
         CARD TABEL
    ========================================================== --}}
    <div class="overflow-hidden rounded-[15px] border border-[#DCE4EC] bg-white shadow-sm">

        {{-- =====================================================
             FILTER BAR
        ====================================================== --}}
        <div class="flex flex-col gap-3 border-b border-[#D9D9D9] px-5 py-4 lg:flex-row lg:items-center lg:justify-between">

            {{-- FILTER KIRI --}}
            <div class="flex flex-wrap items-center gap-3">

                {{-- SEMUA INSTANSI --}}
                <select
                    class="h-[38px] rounded-[8px]
                        border border-[#C9D3DD]
                        bg-white px-3
                        text-[13px] text-[#26354A]
                        outline-none
                        focus:border-[#0E9F95]"
                >
                    <option>
                        Semua Instansi
                    </option>
                </select>


                {{-- SEMUA STATUS --}}
                <select
                    class="h-[38px] rounded-[8px]
                        border border-[#C9D3DD]
                        bg-white px-3
                        text-[13px] text-[#26354A]
                        outline-none
                        focus:border-[#0E9F95]"
                >
                    <option>
                        Semua Status
                    </option>

                    <option>
                        Menunggu
                    </option>

                    <option>
                        Terverifikasi
                    </option>

                    <option>
                        Ditolak
                    </option>
                </select>


                {{-- RESET --}}
                <button
                    type="button"
                    class="flex h-[38px] w-[38px]
                        items-center justify-center
                        rounded-[8px]
                        text-[#0E9F95]
                        transition
                        hover:bg-[#E8F8F6]"
                    title="Reset filter"
                >

                    <svg
                        class="h-[19px] w-[19px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M20 11a8 8 0 0 0-14.9-4M4 13a8 8 0 0 0 14.9 4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M5 3v4h4M19 21v-4h-4"
                        />
                    </svg>

                </button>

            </div>


            {{-- SEARCH --}}
            <div class="relative w-full lg:w-[315px]">

                <svg
                    class="absolute left-3.5 top-1/2
                        h-[17px] w-[17px]
                        -translate-y-1/2
                        text-[#718198]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <circle
                        cx="11"
                        cy="11"
                        r="6"
                        stroke-width="1.8"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-width="1.8"
                        d="m16 16 4 4"
                    />
                </svg>

                <input
                    type="text"
                    placeholder="Cari nama atau kode instansi..."
                    class="h-[38px] w-full rounded-[8px]
                        border border-[#C9D3DD]
                        bg-white
                        pl-10 pr-4
                        text-[13px] text-[#26354A]
                        outline-none
                        placeholder:text-[#8A98AA]
                        focus:border-[#0E9F95]"
                >

            </div>

        </div>


        {{-- =====================================================
             TABEL
        ====================================================== --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[1100px]">

                <thead class="border-b border-[#E5EAF0] bg-[#F3F6F9]">

                    <tr>

                        {{-- NO --}}
                        <th
                            class="w-[65px] px-4 py-3.5 text-center
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#52647C]"
                        >
                            No
                        </th>


                        {{-- KODE INSTANSI --}}
                        <th
                            class="w-[130px] px-4 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#52647C]"
                        >
                            Kode Instansi
                        </th>


                        {{-- NAMA INSTANSI --}}
                        <th
                            class="w-[220px] px-4 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#52647C]"
                        >
                            Nama Instansi
                        </th>


                        {{-- ASPEK --}}
                        <th
                            class="w-[190px] px-4 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#52647C]"
                        >
                            Aspek
                        </th>


                        {{-- INDIKATOR --}}
                        <th
                            class="w-[230px] px-4 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#52647C]"
                        >
                            Indikator
                        </th>


                        {{-- DOKUMEN --}}
                        <th
                            class="w-[180px] px-4 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#52647C]"
                        >
                            Dokumen
                        </th>


                        {{-- STATUS --}}
                        <th
                            class="w-[140px] px-4 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#52647C]"
                        >
                            Status
                        </th>


                        {{-- AKSI --}}
                        <th
                            class="w-[100px] px-4 py-3.5 text-center
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#52647C]"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    {{-- DATA CONTOH SEMENTARA --}}
                    {{-- Nanti bagian ini kita ganti dengan data database. --}}

                    <tr class="border-b border-[#E5EAF0] hover:bg-[#FAFCFC]">

                        {{-- NO --}}
                        <td class="px-4 py-5 text-center text-[14px] text-[#26354A]">
                            1
                        </td>


                        {{-- KODE --}}
                        <td class="px-4 py-5 text-[13px] text-[#52647C]">
                            INST-001
                        </td>


                        {{-- INSTANSI --}}
                        <td class="px-4 py-5">

                            <p class="text-[14px] font-medium text-[#26354A]">
                                Provinsi Jawa Timur
                            </p>

                        </td>


                        {{-- ASPEK --}}
                        <td class="px-4 py-5">

                            <span class="inline-flex rounded-[5px]
                                bg-[#DCEAFF]
                                px-2 py-1
                                text-[12px] text-[#52647C]"
                            >
                                Tata Kelola dan Manajemen
                            </span>

                        </td>


                        {{-- INDIKATOR --}}
                        <td class="px-4 py-5 text-[13px] text-[#52647C]">
                            IND-01: Kebijakan SPBE
                        </td>


                        {{-- DOKUMEN --}}
                        <td class="px-4 py-5">

                            <div class="flex items-center gap-2">

                                <svg
                                    class="h-[16px] w-[16px] shrink-0 text-[#0E8E8A]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M6 3h8l4 4v14H6V3z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M14 3v5h5"
                                    />
                                </svg>

                                <span class="text-[13px] text-[#0E7774]">
                                    SK_Kebijakan.pdf
                                </span>

                            </div>

                        </td>


                        {{-- STATUS --}}
                        <td class="px-4 py-5">

                            <span
                                class="inline-flex items-center gap-2
                                    rounded-full
                                    bg-[#DCEAFF]
                                    px-3 py-1.5
                                    text-[12px] font-medium
                                    text-[#52647C]"
                            >

                                <span class="h-[6px] w-[6px] rounded-full bg-[#7895C2]"></span>

                                Menunggu

                            </span>

                        </td>


                        {{-- AKSI --}}
                        <td class="px-4 py-5 text-center">

                            <button
                                type="button"
                                class="rounded-[7px]
                                    border border-[#C9D3DD]
                                    px-3 py-1.5
                                    text-[12px] font-medium
                                    text-[#52647C]
                                    transition
                                    hover:bg-[#F4F8F8]"
                            >
                                Detail
                            </button>

                        </td>

                    </tr>


                    <tr class="border-b border-[#E5EAF0] hover:bg-[#FAFCFC]">

                        <td class="px-4 py-5 text-center text-[14px] text-[#26354A]">
                            2
                        </td>

                        <td class="px-4 py-5 text-[13px] text-[#52647C]">
                            INST-002
                        </td>

                        <td class="px-4 py-5">

                            <p class="text-[14px] font-medium text-[#26354A]">
                                Provinsi Jawa Timur
                            </p>

                        </td>

                        <td class="px-4 py-5">

                            <span class="inline-flex rounded-[5px]
                                bg-[#DCEAFF]
                                px-2 py-1
                                text-[12px] text-[#52647C]"
                            >
                                Penyelenggara
                            </span>

                        </td>

                        <td class="px-4 py-5 text-[13px] text-[#52647C]">
                            IND-01: Kebijakan SPBE
                        </td>

                        <td class="px-4 py-5">

                            <div class="flex items-center gap-2">

                                <svg
                                    class="h-[16px] w-[16px] shrink-0 text-[#0E8E8A]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M6 3h8l4 4v14H6V3z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M14 3v5h5"
                                    />
                                </svg>

                                <span class="text-[13px] text-[#0E7774]">
                                    SK_Kebijakan.pdf
                                </span>

                            </div>

                        </td>

                        <td class="px-4 py-5">

                            <span
                                class="inline-flex items-center gap-2
                                    rounded-full
                                    bg-[#E8F6ED]
                                    px-3 py-1.5
                                    text-[12px] font-medium
                                    text-[#27854A]"
                            >

                                <span class="h-[6px] w-[6px] rounded-full bg-[#36A65E]"></span>

                                Terverifikasi

                            </span>

                        </td>

                        <td class="px-4 py-5 text-center">

                            <button
                                type="button"
                                class="rounded-[7px]
                                    border border-[#C9D3DD]
                                    px-3 py-1.5
                                    text-[12px] font-medium
                                    text-[#52647C]
                                    transition
                                    hover:bg-[#F4F8F8]"
                            >
                                Detail
                            </button>

                        </td>

                    </tr>


                    <tr class="hover:bg-[#FAFCFC]">

                        <td class="px-4 py-5 text-center text-[14px] text-[#26354A]">
                            3
                        </td>

                        <td class="px-4 py-5 text-[13px] text-[#52647C]">
                            INST-003
                        </td>

                        <td class="px-4 py-5">

                            <p class="text-[14px] font-medium text-[#26354A]">
                                Provinsi Jawa Timur
                            </p>

                        </td>

                        <td class="px-4 py-5">

                            <span class="inline-flex rounded-[5px]
                                bg-[#DCEAFF]
                                px-2 py-1
                                text-[12px] text-[#52647C]"
                            >
                                Data
                            </span>

                        </td>

                        <td class="px-4 py-5 text-[13px] text-[#52647C]">
                            IND-01: Kebijakan SPBE
                        </td>

                        <td class="px-4 py-5">

                            <div class="flex items-center gap-2">

                                <svg
                                    class="h-[16px] w-[16px] shrink-0 text-[#0E8E8A]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M6 3h8l4 4v14H6V3z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M14 3v5h5"
                                    />
                                </svg>

                                <span class="text-[13px] text-[#52647C]">
                                    SK_Kebijakan.pdf
                                </span>

                            </div>

                        </td>

                        <td class="px-4 py-5">

                            <span
                                class="inline-flex items-center gap-2
                                    rounded-full
                                    bg-[#FFE2E2]
                                    px-3 py-1.5
                                    text-[12px] font-medium
                                    text-[#D14343]"
                            >

                                <span class="h-[6px] w-[6px] rounded-full bg-[#E05252]"></span>

                                Ditolak

                            </span>

                        </td>

                        <td class="px-4 py-5 text-center">

                            <button
                                type="button"
                                class="rounded-[7px]
                                    border border-[#C9D3DD]
                                    px-3 py-1.5
                                    text-[12px] font-medium
                                    text-[#52647C]
                                    transition
                                    hover:bg-[#F4F8F8]"
                            >
                                Detail
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             FOOTER / PAGINATION
        ====================================================== --}}
        <div
            class="flex flex-col gap-3
                border-t border-[#E5EAF0]
                bg-[#F8FAFC]
                px-5 py-4
                sm:flex-row sm:items-center sm:justify-between"
        >

            <p class="text-[12px] text-[#60718A]">
                Menampilkan 1–3 dari 45 bukti
            </p>


            <div class="flex items-center gap-1">

                <button
                    type="button"
                    class="flex h-[28px] w-[28px]
                        items-center justify-center
                        rounded-[5px]
                        border border-[#D8E0E8]
                        text-[12px] text-[#A3AFBD]"
                >
                    ‹
                </button>

                <button
                    type="button"
                    class="flex h-[28px] w-[28px]
                        items-center justify-center
                        rounded-[5px]
                        bg-[#0E9F95]
                        text-[12px] font-medium text-white"
                >
                    1
                </button>

                <button
                    type="button"
                    class="flex h-[28px] w-[28px]
                        items-center justify-center
                        rounded-[5px]
                        border border-[#D8E0E8]
                        text-[12px] text-[#52647C]"
                >
                    2
                </button>

                <button
                    type="button"
                    class="flex h-[28px] w-[28px]
                        items-center justify-center
                        rounded-[5px]
                        border border-[#D8E0E8]
                        text-[12px] text-[#52647C]"
                >
                    3
                </button>

                <button
                    type="button"
                    class="flex h-[28px] w-[28px]
                        items-center justify-center
                        rounded-[5px]
                        border border-[#D8E0E8]
                        text-[12px] text-[#52647C]"
                >
                    ›
                </button>

            </div>

        </div>

    </div>

@endsection