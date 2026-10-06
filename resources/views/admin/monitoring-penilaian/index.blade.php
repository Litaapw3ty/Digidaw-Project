@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- =========================================================
         HEADER HALAMAN
    ========================================================== --}}
    <div class="mb-7 flex flex-col justify-between gap-4 lg:flex-row lg:items-start">

        <div>
            <h1 class="text-[28px] font-semibold leading-tight text-[#202B3C]">
                Monitoring Penilaian
            </h1>

            <p class="mt-1 text-[16px] text-[#667793]">
                Pantau progres dan nilai penilaian mandiri dari setiap instansi secara real-time.
            </p>
        </div>


        {{-- ACTION BUTTON --}}
        <div class="flex items-center gap-3">

            {{-- Tombol Filter --}}
            <button
                type="button"
                class="flex h-[50px] items-center gap-2 rounded-[10px]
                    border border-[#DCE4EC] bg-white px-5
                    text-[15px] font-medium text-[#26354A]
                    shadow-sm transition hover:bg-gray-50"
            >
                <svg
                    class="h-[18px] w-[18px]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M4 6h16M7 12h10M10 18h4"
                    />
                </svg>

                Filter
            </button>


            {{-- Tombol Ekspor --}}
            <button
                type="button"
                class="flex h-[50px] items-center gap-2 rounded-[10px]
                    bg-[#0E9F95] px-5
                    text-[15px] font-medium text-white
                    transition hover:bg-[#0B8D84]"
            >
                <svg
                    class="h-[18px] w-[18px]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"
                    />
                </svg>

                Ekspor Laporan
            </button>

        </div>

    </div>


    {{-- =========================================================
         STATISTIK
    ========================================================== --}}
    <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-5">

        {{-- TOTAL INSTANSI --}}
        <div class="rounded-[12px] border border-[#BCC9CB] bg-white px-5 py-5">

            <div class="flex items-center gap-4">

                <div
                    class="flex h-[52px] w-[52px] shrink-0 items-center
                        justify-center rounded-full bg-[#12C6BD]/20 text-[#006671]"
                >
                    <svg
                        class="h-[26px] w-[26px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.6"
                            d="M4 21h16M6 21V5h8v16M14 9h4v12M9 8h2m-2 4h2m-2 4h2m5-4h1m-1 4h1"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-[13px] font-semibold uppercase tracking-[0.08em] text-[#434654]">
                        Total Instansi
                    </p>

                    <p class="mt-1 text-[28px] font-semibold text-[#1F1F1F]">
                        {{ $totalInstansi }}
                    </p>
                </div>

            </div>

        </div>


        {{-- SELESAI --}}
        <div class="rounded-[12px] border border-[#BCC9CB] bg-white px-5 py-5">

            <div class="flex items-center gap-4">

                <div
                    class="flex h-[52px] w-[52px] shrink-0 items-center
                        justify-center rounded-full bg-[#12C6BD]/20 text-[#006671]"
                >
                    <svg
                        class="h-[26px] w-[26px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="m5 12 4 4L19 6"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-[13px] font-semibold uppercase tracking-[0.08em] text-[#434654]">
                        Selesai
                    </p>

                    <p class="mt-1 text-[28px] font-semibold text-[#1F1F1F]">
                        {{ $selesai }}
                    </p>
                </div>

            </div>

        </div>


        {{-- SEDANG BERJALAN --}}
        <div class="rounded-[12px] border border-[#BCC9CB] bg-white px-5 py-5">

            <div class="flex items-center gap-4">

                <div
                    class="flex h-[52px] w-[52px] shrink-0 items-center
                        justify-center rounded-full bg-[#12C6BD]/20 text-[#006671]"
                >
                    <svg
                        class="h-[26px] w-[26px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M4 12a8 8 0 0 1 14.9-4M20 12a8 8 0 0 1-14.9 4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M19 4v4h-4M5 20v-4h4"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-[13px] font-semibold uppercase tracking-[0.08em] text-[#434654]">
                        Sedang Berjalan
                    </p>

                    <p class="mt-1 text-[28px] font-semibold text-[#1F1F1F]">
                        {{ $sedangBerjalan }}
                    </p>
                </div>

            </div>

        </div>


        {{-- BELUM MULAI --}}
        <div class="rounded-[12px] border border-[#BCC9CB] bg-white px-5 py-5">

            <div class="flex items-center gap-4">

                <div
                    class="flex h-[52px] w-[52px] shrink-0 items-center
                        justify-center rounded-full bg-[#12C6BD]/20 text-[#006671]"
                >
                    <svg
                        class="h-[26px] w-[26px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="8"
                            stroke-width="1.7"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-width="1.7"
                            d="M12 8v4l2.5 2"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-[13px] font-semibold uppercase tracking-[0.08em] text-[#434654]">
                        Belum Mulai
                    </p>

                    <p class="mt-1 text-[28px] font-semibold text-[#1F1F1F]">
                        {{ $belumMulai }}
                    </p>
                </div>

            </div>

        </div>


        {{-- RATA-RATA NILAI --}}
        <div class="rounded-[12px] border border-[#BCC9CB] bg-white px-5 py-5">

            <div class="flex items-center gap-4">

                <div
                    class="flex h-[52px] w-[52px] shrink-0 items-center
                        justify-center rounded-full bg-[#EFBA35]/20 text-[#EFBA35]"
                >
                    <svg
                        class="h-[27px] w-[27px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M3 16l4-5 4 3 5-7 5 3"
                        />

                        <circle cx="3" cy="16" r="1" fill="currentColor" />
                        <circle cx="7" cy="11" r="1" fill="currentColor" />
                        <circle cx="11" cy="14" r="1" fill="currentColor" />
                        <circle cx="16" cy="7" r="1" fill="currentColor" />
                        <circle cx="21" cy="10" r="1" fill="currentColor" />
                    </svg>
                </div>

                <div>
                    <p class="text-[13px] font-semibold uppercase tracking-[0.08em] text-[#434654]">
                        Rata-Rata Nilai
                    </p>

                    <p class="mt-1 text-[28px] font-semibold text-[#1F1F1F]">
                        {{ $rataRataNilai !== null
                            ? number_format($rataRataNilai, 2)
                            : '-' }}
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         TABEL MONITORING
    ========================================================== --}}
    <div class="overflow-hidden rounded-[15px] border border-[#DCE4EC] bg-white shadow-sm">

        {{-- =====================================================
             FILTER
        ====================================================== --}}
        <form
            method="GET"
            action="{{ route('admin.monitoring-penilaian.index') }}"
            class="border-b border-[#D9D9D9] px-5 py-4"
        >

            <div class="grid grid-cols-1 gap-3 md:grid-cols-[minmax(0,1fr)_185px_185px]">

                {{-- CARI KABUPATEN / KOTA --}}
                <div>

                    <label class="mb-1.5 block text-[13px] font-medium text-[#60718A]">
                        Cari Kabupaten
                    </label>

                    <div class="relative">

                        <svg
                            class="absolute left-4 top-1/2 h-[17px] w-[17px]
                                -translate-y-1/2 text-[#718198]"
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
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama kabupaten/kota..."
                            class="h-[40px] w-full rounded-[8px]
                                border border-[#DCE4EC]
                                bg-white pl-11 pr-4
                                text-[13px] text-[#26354A]
                                outline-none
                                placeholder:text-[#8A98AA]
                                focus:border-[#0E9F95]"
                        >

                    </div>

                </div>


                {{-- PROVINSI --}}
                <div>

                    <label class="mb-1.5 block text-[13px] font-medium text-[#60718A]">
                        Provinsi
                    </label>

                    <select
                        name="provinsi"
                        onchange="this.form.submit()"
                        class="h-[40px] w-full rounded-[8px]
                            border border-[#DCE4EC]
                            bg-white px-3
                            text-[13px] text-[#26354A]
                            outline-none
                            focus:border-[#0E9F95]"
                    >

                        <option value="">
                            Semua Provinsi
                        </option>

                        @foreach ($provinsi as $wilayah)

                            <option
                                value="{{ $wilayah->id_wilayah }}"
                                {{ request('provinsi') == $wilayah->id_wilayah ? 'selected' : '' }}
                            >
                                {{ $wilayah->nama_wilayah }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- STATUS --}}
                <div>

                    <label class="mb-1.5 block text-[13px] font-medium text-[#60718A]">
                        Status
                    </label>

                    <select
                        name="status"
                        onchange="this.form.submit()"
                        class="h-[40px] w-full rounded-[8px]
                            border border-[#DCE4EC]
                            bg-white px-3
                            text-[13px] text-[#26354A]
                            outline-none
                            focus:border-[#0E9F95]"
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="BELUM_MULAI"
                            {{ request('status') === 'BELUM_MULAI' ? 'selected' : '' }}
                        >
                            Belum Mulai
                        </option>

                        <option
                            value="BERJALAN"
                            {{ request('status') === 'BERJALAN' ? 'selected' : '' }}
                        >
                            Sedang Berjalan
                        </option>

                        <option
                            value="SELESAI"
                            {{ request('status') === 'SELESAI' ? 'selected' : '' }}
                        >
                            Selesai
                        </option>

                    </select>

                </div>

            </div>


            {{-- TAHUN --}}
            @if ($tahun->count() > 0)

                <div class="mt-3 flex items-center gap-2">

                    <select
                        name="tahun"
                        class="h-[34px] rounded-[7px]
                            border border-[#DCE4EC]
                            bg-white px-3
                            text-[12px] text-[#52647C]
                            outline-none
                            focus:border-[#0E9F95]"
                    >

                        <option value="">
                            Semua Tahun
                        </option>

                        @foreach ($tahun as $itemTahun)

                            <option
                                value="{{ $itemTahun }}"
                                {{ request('tahun') == $itemTahun ? 'selected' : '' }}
                            >
                                {{ $itemTahun }}
                            </option>

                        @endforeach

                    </select>


                    <button
                        type="submit"
                        class="h-[34px] rounded-[7px]
                            bg-[#0E9F95] px-4
                            text-[12px] font-medium text-white
                            hover:bg-[#0B8D84]"
                    >
                        Terapkan
                    </button>


                    @if (request()->hasAny(['search', 'provinsi', 'status', 'tahun']))

                        <a
                            href="{{ route('admin.monitoring-penilaian.index') }}"
                            class="px-2 text-[12px] font-medium text-[#718198]
                                hover:text-[#0E9F95]"
                        >
                            Reset
                        </a>

                    @endif

                </div>

            @endif

        </form>


        {{-- =====================================================
             TABLE
        ====================================================== --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] table-fixed">

                {{-- Lebar setiap kolom dikontrol dari sini --}}
                <colgroup>
                    <col class="w-[65px]">
                    <col class="w-[20%]">
                    <col class="w-[15%]">
                    <col class="w-[20%]">
                    <col class="w-[12%]">
                    <col class="w-[11%]">
                    <col class="w-[15%]">
                </colgroup>


                {{-- =================================================
                     HEADER TABEL
                ================================================== --}}
                <thead class="border-b border-[#E5EAF0] bg-[#F8FAFC]">

                    <tr>

                        {{-- NO --}}
                        <th
                            class="px-3 py-3.5 text-center
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#60718A]"
                        >
                            No.
                        </th>


                        {{-- KABUPATEN / KOTA --}}
                        <th
                            class="relative px-3 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#60718A]"
                        >

                            <details class="relative">

                                <summary
                                    class="flex cursor-pointer list-none
                                        select-none items-center gap-1"
                                >
                                    Kabupaten/Kota

                                    <svg
                                        class="h-[13px] w-[13px]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m7 10 5 5 5-5"
                                        />
                                    </svg>
                                </summary>


                                {{-- DROPDOWN SORT --}}
                                <div
                                    class="absolute left-0 top-[26px] z-50
                                        w-[210px] rounded-[10px]
                                        border border-[#DCE4EC]
                                        bg-white p-2 text-left
                                        shadow-lg"
                                >

                                    <p
                                        class="px-2 py-2 text-[10px]
                                            font-semibold uppercase
                                            text-[#8A98AA]"
                                    >
                                        Urutkan
                                    </p>


                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'nama_instansi',
                                            'direction' => 'asc',
                                            'page' => 1
                                        ]) }}"
                                        class="block rounded-[6px] px-2 py-2
                                            text-[12px] text-[#52647C]
                                            hover:bg-[#F4F8F8]"
                                    >
                                        ↑ A → Z
                                    </a>


                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'nama_instansi',
                                            'direction' => 'desc',
                                            'page' => 1
                                        ]) }}"
                                        class="block rounded-[6px] px-2 py-2
                                            text-[12px] text-[#52647C]
                                            hover:bg-[#F4F8F8]"
                                    >
                                        ↓ Z → A
                                    </a>

                                </div>

                            </details>

                        </th>


                        {{-- PROVINSI --}}
                        <th
                            class="relative px-3 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#60718A]"
                        >

                            <details class="relative">

                                <summary
                                    class="flex cursor-pointer list-none
                                        select-none items-center gap-1"
                                >
                                    Provinsi

                                    <svg
                                        class="h-[13px] w-[13px]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m7 10 5 5 5-5"
                                        />
                                    </svg>
                                </summary>


                                {{-- DROPDOWN PROVINSI --}}
                                <div
                                    class="absolute left-0 top-[26px] z-50
                                        max-h-[300px] w-[220px]
                                        overflow-y-auto rounded-[10px]
                                        border border-[#DCE4EC]
                                        bg-white p-2 text-left
                                        shadow-lg"
                                >

                                    {{-- SEMUA PROVINSI --}}
                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'provinsi' => null,
                                            'page' => 1
                                        ]) }}"

                                        class="h-[36px] rounded-[7px] border border-[#BCC9CB]
                                            {{ !request('provinsi')
                                                ? 'bg-[#F7F9FC] font-medium text-[#0E9F95]'
                                                : 'text-[#434654] outline-none focus:border-[#006671]">' }}
                                            hover:bg-[#F4F8F8]">
                                        Semua Provinsi
                                    </a>


                                    @foreach ($provinsi as $wilayah)

                                        <a
                                            href="{{ request()->fullUrlWithQuery([
                                                'provinsi' => $wilayah->id_wilayah,
                                                'page' => 1
                                            ]) }}"
                                            class="block rounded-[6px] px-3 py-2
                                                text-[12px]
                                                {{ request('provinsi') == $wilayah->id_wilayah
                                                    ? 'bg-[#E8F8F6] font-medium text-[#0E9F95]'
                                                    : 'text-[#52647C]' }}
                                                hover:bg-[#F4F8F8]"
                                        >
                                            {{ $wilayah->nama_wilayah }}
                                        </a>

                                    @endforeach

                                </div>

                            </details>

                        </th>


                        {{-- PROGRESS --}}
                        <th
                            class="px-3 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#60718A]"
                        >

                            <details class="relative inline-block">

                                <summary
                                    class="flex cursor-pointer list-none
                                        select-none items-center gap-1"
                                >
                                    Progress

                                    <svg
                                        class="h-[13px] w-[13px]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m7 10 5 5 5-5"
                                        />
                                    </svg>
                                </summary>


                                {{-- DROPDOWN PROGRESS --}}
                                <div
                                    class="absolute left-0 top-[26px] z-50
                                        w-[205px] rounded-[10px]
                                        border border-[#DCE4EC]
                                        bg-white p-2 shadow-lg"
                                >

                                    <p
                                        class="px-2 py-2 text-[10px]
                                            font-semibold uppercase
                                            text-[#8A98AA]"
                                    >
                                        Urutkan Progress
                                    </p>


                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'progress',
                                            'direction' => 'asc',
                                            'page' => 1
                                        ]) }}"
                                        class="block rounded-[6px] px-3 py-2
                                            text-[12px] text-[#52647C]
                                            hover:bg-[#F4F8F8]"
                                    >
                                        ↑ Terendah → Tertinggi
                                    </a>


                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'progress',
                                            'direction' => 'desc',
                                            'page' => 1
                                        ]) }}"
                                        class="block rounded-[6px] px-3 py-2
                                            text-[12px] text-[#52647C]
                                            hover:bg-[#F4F8F8]"
                                    >
                                        ↓ Tertinggi → Terendah
                                    </a>

                                </div>

                            </details>

                        </th>


                        {{-- NILAI SAAT INI --}}
                        <th
                            class="px-3 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#60718A]"
                        >

                            <details class="relative inline-block">

                                <summary
                                    class="flex cursor-pointer list-none
                                        select-none items-center gap-1"
                                >
                                    Nilai Saat Ini

                                    <svg
                                        class="h-[13px] w-[13px]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m7 10 5 5 5-5"
                                        />
                                    </svg>
                                </summary>


                                {{-- DROPDOWN NILAI --}}
                                <div
                                    class="absolute right-0 top-[26px] z-50
                                        w-[210px] rounded-[10px]
                                        border border-[#DCE4EC]
                                        bg-white p-2 shadow-lg"
                                >

                                    <p
                                        class="px-2 py-2 text-[10px]
                                            font-semibold uppercase
                                            text-[#8A98AA]"
                                    >
                                        Urutkan Nilai
                                    </p>


                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'nilai',
                                            'direction' => 'asc',
                                            'page' => 1
                                        ]) }}"
                                        class="block rounded-[6px] px-3 py-2
                                            text-[12px] text-[#52647C]
                                            hover:bg-[#F4F8F8]"
                                    >
                                        ↑ Terendah → Tertinggi
                                    </a>


                                    <a
                                        href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'nilai',
                                            'direction' => 'desc',
                                            'page' => 1
                                        ]) }}"
                                        class="block rounded-[6px] px-3 py-2
                                            text-[12px] text-[#52647C]
                                            hover:bg-[#F4F8F8]"
                                    >
                                        ↓ Tertinggi → Terendah
                                    </a>

                                </div>

                            </details>

                        </th>


                        {{-- NILAI MAKSIMAL --}}
                        <th
                            class="px-3 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#60718A]"
                        >
                            Nilai Maksimal
                        </th>


                        {{-- STATUS --}}
                        <th
                            class="px-3 py-3.5 text-left
                                text-[11px] font-semibold uppercase
                                tracking-[0.03em] text-[#60718A]"
                        >
                            Status
                        </th>

                    </tr>

                </thead>


                {{-- =================================================
                     ISI TABEL
                ================================================== --}}
                <tbody>

                    @forelse ($monitoring as $item)

                        <tr
                            class="border-b border-[#EDF1F4]
                                last:border-b-0 hover:bg-[#FAFCFC]"
                        >

                            {{-- NOMOR --}}
                            <td
                                class="px-3 py-4 text-center
                                    text-[13px] font-medium text-[#26354A]"
                            >
                                {{ $monitoring->firstItem() + $loop->index }}
                            </td>


                            {{-- KABUPATEN / KOTA --}}
                            <td class="px-3 py-4">

                                <p
                                    class="truncate text-[14px]
                                        font-semibold text-[#26354A]"
                                >
                                    {{ $item->nama_instansi }}
                                </p>

                                <p class="mt-0.5 text-[11px] text-[#718198]">
                                    ID: {{ $item->kode_instansi }}
                                </p>

                            </td>


                            {{-- PROVINSI --}}
                            <td
                                class="truncate px-3 py-4
                                    text-[13px] text-[#52647C]"
                            >
                                {{ $item->provinsi ?? '-' }}
                            </td>


                            {{-- PROGRESS --}}
                            <td class="px-3 py-4">

                                <div class="flex items-center gap-2">

                                    <span
                                        class="min-w-[38px] text-[13px]
                                            font-semibold text-[#0E9F95]"
                                    >
                                        {{ number_format($item->progress_persen, 0) }}%
                                    </span>


                                    <div
                                        class="h-[6px] flex-1 overflow-hidden
                                            rounded-full bg-[#E7EBEF]"
                                    >

                                        <div
                                            class="h-full rounded-full bg-[#0E9F95]"
                                            style="width: {{ min((float) $item->progress_persen, 100) }}%"
                                        ></div>

                                    </div>

                                </div>

                            </td>


                            {{-- NILAI SAAT INI --}}
                            <td class="px-3 py-4">

                                @if ($item->indeks_akhir !== null)

                                    <p
                                        class="text-[14px]
                                            font-semibold text-[#26354A]"
                                    >
                                        {{ number_format($item->indeks_akhir, 2) }}
                                    </p>

                                    <p class="mt-0.5 text-[11px] text-[#0E9F95]">
                                        {{ number_format(($item->indeks_akhir / 5) * 100, 2) }}%
                                    </p>

                                @else

                                    <span class="text-[13px] text-[#8A98AA]">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- NILAI MAKSIMAL --}}
                            <td
                                class="px-3 py-4
                                    text-[13px] text-[#60718A]"
                            >
                                5
                            </td>


                            {{-- STATUS --}}
                            <td class="px-3 py-4">

                                @if ($item->id_evaluasi === null)

                                    {{-- BELUM MULAI --}}
                                    <span
                                        class="inline-flex items-center gap-1.5
                                            whitespace-nowrap rounded-full
                                            bg-[#F1F3F5] px-2.5 py-1.5
                                            text-[11px] font-medium
                                            text-[#687587]"
                                    >
                                        <span
                                            class="h-[6px] w-[6px]
                                                rounded-full bg-[#9AA5B1]"
                                        ></span>

                                        Belum Mulai
                                    </span>

                                @elseif ($item->status_evaluasi === 'SELESAI')

                                    {{-- SELESAI --}}
                                    <span
                                        class="inline-flex items-center gap-1.5
                                            whitespace-nowrap rounded-full
                                            bg-[#E8FAF0] px-2.5 py-1.5
                                            text-[11px] font-medium
                                            text-[#149447]"
                                    >
                                        <span
                                            class="h-[6px] w-[6px]
                                                rounded-full bg-[#22A55A]"
                                        ></span>

                                        Selesai
                                    </span>

                                @elseif (in_array($item->status_evaluasi, [
                                    'PENGISIAN',
                                    'MENUNGGU_VERIFIKASI',
                                    'DALAM_PENILAIAN',
                                ]))

                                    {{-- SEDANG BERJALAN --}}
                                    <span
                                        class="inline-flex items-center gap-1.5
                                            whitespace-nowrap rounded-full
                                            bg-[#FFF5D9] px-2.5 py-1.5
                                            text-[11px] font-medium
                                            text-[#A17200]"
                                    >
                                        <span
                                            class="h-[6px] w-[6px]
                                                rounded-full bg-[#E8AA00]"
                                        ></span>

                                        Sedang Berjalan
                                    </span>

                                @else

                                    {{-- STATUS LAINNYA --}}
                                    <span
                                        class="inline-flex items-center gap-1.5
                                            whitespace-nowrap rounded-full
                                            bg-[#F1F3F5] px-2.5 py-1.5
                                            text-[11px] font-medium
                                            text-[#687587]"
                                    >
                                        {{ $item->status_evaluasi ?? '-' }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-12 text-center
                                    text-[14px] text-[#718198]"
                            >
                                Belum ada data monitoring penilaian.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             PAGINATION
        ====================================================== --}}
        <div class="border-t border-[#E5EAF0] px-6 py-4">
            {{ $monitoring->links() }}
        </div>

    </div>

@endsection