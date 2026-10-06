@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- WELCOME --}}
    <div
        class="mb-6 overflow-hidden rounded-[20px]
               bg-gradient-to-r from-[#12C6BD] to-[#006671]
               px-7 py-6 text-white">

        <h1 class="text-[28px] font-semibold leading-tight">
            Selamat Datang, Admin
        </h1>

        <p class="mt-2 text-[18px] text-white/85">
            Pantau dan kelola proses evaluasi Pemerintah Digital secara menyeluruh.
        </p>

    </div>


    {{-- STATISTIK --}}
    <div class="mb-6 grid grid-cols-1 gap-5 lg:grid-cols-3">

        {{-- TOTAL INSTANSI --}}
        <div
            class="rounded-[12px] border border-[#BCC9CB]
                   bg-white px-5 py-5">

            <div class="flex items-center gap-5">

                <div
                    class="flex h-[54px] w-[54px] shrink-0
                           items-center justify-center rounded-full
                           bg-[#12C6BD]/20 text-[#006671]">

                    <svg
                        class="h-[27px] w-[27px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.6"
                            d="M4 21h16M6 21V5h8v16M14 9h4v12M9 8h2m-2 4h2m-2 4h2m5-4h1m-1 4h1" />

                    </svg>

                </div>

                <div>

                    <p
                        class="text-[15px] font-semibold
                               uppercase tracking-[0.08em]
                               text-[#434654]">
                        Total Instansi
                    </p>

                    <p
                        class="mt-1 text-[30px] font-semibold
                               text-[#1F1F1F]">
                        {{ $totalInstansi }}
                    </p>

                </div>

            </div>

        </div>


        {{-- ASESOR AKTIF --}}
        <div
            class="rounded-[12px] border border-[#BCC9CB]
                   bg-white px-5 py-5">

            <div class="flex items-center gap-5">

                <div
                    class="flex h-[54px] w-[54px] shrink-0
                           items-center justify-center rounded-full
                           bg-[#12C6BD]/20 text-[#006671]">

                    <svg
                        class="h-[27px] w-[27px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <circle
                            cx="12"
                            cy="8"
                            r="3.5"
                            stroke-width="1.6" />

                        <path
                            stroke-linecap="round"
                            stroke-width="1.6"
                            d="M5 21c0-4 3-6.5 7-6.5s7 2.5 7 6.5" />

                    </svg>

                </div>

                <div>

                    <p
                        class="text-[15px] font-semibold
                               uppercase tracking-[0.08em]
                               text-[#434654]">
                        Asesor Aktif
                    </p>

                    <p
                        class="mt-1 text-[30px] font-semibold
                               text-[#1F1F1F]">
                        {{ $asesorAktif }}
                    </p>

                </div>

            </div>

        </div>


        {{-- RATA-RATA INDEKS --}}
        <div
            class="rounded-[12px] border border-[#BCC9CB]
                   bg-white px-5 py-5">

            <div class="flex items-center gap-5">

                <div
                    class="flex h-[54px] w-[54px] shrink-0
                           items-center justify-center rounded-full
                           bg-[#EFBA35]/20 text-[#EFBA35]">

                    <svg
                        class="h-[28px] w-[28px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 16l4-5 4 3 5-7 5 3" />

                        <circle cx="3" cy="16" r="1" fill="currentColor" />
                        <circle cx="7" cy="11" r="1" fill="currentColor" />
                        <circle cx="11" cy="14" r="1" fill="currentColor" />
                        <circle cx="16" cy="7" r="1" fill="currentColor" />
                        <circle cx="21" cy="10" r="1" fill="currentColor" />

                    </svg>

                </div>

                <div>

                    <p
                        class="text-[15px] font-semibold
                               uppercase tracking-[0.08em]
                               text-[#434654]">
                        Rata-Rata Indeks Instansi
                    </p>

                    <p
                        class="mt-1 text-[30px] font-semibold
                               text-[#1F1F1F]">
                        {{ $rataRataIndeks !== null ? number_format($rataRataIndeks, 2) : '—' }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- CONTENT --}}
    <div class="grid grid-cols-1 gap-5 xl:grid-cols-[minmax(0,1.9fr)_minmax(350px,1fr)]">


        {{-- KOLOM KIRI --}}
        <div
            class="overflow-hidden rounded-[12px]
                   border border-[#BCC9CB] bg-white">


            {{-- HEADER --}}
            <div
                class="flex flex-col gap-4 border-b border-[#D9D9D9]
                       px-5 py-5 lg:flex-row lg:items-center
                       lg:justify-between">

                <h2
                    class="text-[18px] font-semibold
                           text-[#11468F]">
                    Ringkasan Instansi
                </h2>


                <div class="flex flex-col gap-2 sm:flex-row">

                    {{-- FILTER --}}
                    <select
                        class="h-[36px] rounded-[7px]
                               border border-[#BCC9CB]
                               bg-white px-3 text-[13px]
                               text-[#4B4B4B]
                               outline-none focus:border-[#006671]">

                        <option>Semua Kategori</option>
                        <option>Provinsi</option>
                        <option>Kabupaten</option>
                        <option>Kota</option>

                    </select>


                    {{-- SEARCH --}}
                    <div class="relative">

                        <input
                            type="text"
                            placeholder="Cari instansi..."
                            class="h-[36px] w-full rounded-[7px]
                                   border border-[#BCC9CB]
                                   bg-white py-2 pl-3 pr-10
                                   text-[13px] text-[#4B4B4B]
                                   outline-none
                                   placeholder:text-[#6D797B]
                                   focus:border-[#006671]
                                   sm:w-[215px]">

                        <svg
                            class="absolute right-3 top-1/2
                                   h-[17px] w-[17px]
                                   -translate-y-1/2
                                   text-[#6D797B]"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <circle
                                cx="11"
                                cy="11"
                                r="6"
                                stroke-width="1.8" />

                            <path
                                stroke-linecap="round"
                                stroke-width="1.8"
                                d="M16 16l4 4" />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="w-full min-w-[800px]">

                    <thead class="border-b border-[#D9D9D9]">

                        <tr
                            class="text-left text-[12px]
                                   font-semibold text-[#434654]">

                            <th class="px-4 py-3">No</th>

                            <th class="px-4 py-3">
                                <span class="block">Nama</span>
                                <span class="block">Instansi</span>
                            </th>

                            <th class="px-4 py-3">
                                Kategori
                            </th>

                            <th class="px-4 py-3">
                                Progress
                            </th>

                            <th class="px-4 py-3">
                                Status Evaluasi
                            </th>

                            <th class="px-4 py-3">
                                Asesor
                            </th>

                            <th class="px-4 py-3 text-center">
                                Nilai
                            </th>

                        </tr>

                    </thead>

                    <tbody class="text-[13px] text-[#434654]">

                        @forelse ($instansi as $item)

                            <tr class="border-b border-[#D9D9D9]">

                                {{-- Nomor urut --}}
                                <td class="px-4 py-3">
                                    {{ $item['no'] }}
                                </td>

                                {{-- Nama instansi --}}
                                <td class="px-4 py-3 leading-[19px]">
                                    {{ $item['nama'] }}
                                </td>

                                {{-- Kategori --}}
                                <td class="px-4 py-3">
                                    {{ $item['kategori'] }}
                                </td>

                                {{-- Progress evaluasi --}}
                                <td class="px-4 py-3">

                                    <div class="flex items-center gap-2">

                                        <div
                                            class="h-[6px] w-[76px]
                                                overflow-hidden rounded-full
                                                bg-[#D9D9D9]">

                                            <div
                                                class="h-full rounded-full bg-[#006671]"
                                                style="width: {{ $item['progress'] }}%">
                                            </div>

                                        </div>

                                        <span
                                            class="text-[11px]
                                                font-medium text-[#434654]">
                                            {{ $item['progress'] }}%
                                        </span>

                                    </div>

                                </td>

                                {{-- Status evaluasi --}}
                                <td class="px-4 py-3">

                                    @php
                                        $statusLabel = match ($item['status']) {
                                            'SELESAI' => 'Selesai',
                                            'DALAM_PENILAIAN' => 'Proses Asesor',
                                            'MENUNGGU_VERIFIKASI' => 'Menunggu Verifikasi',
                                            'PENGISIAN' => 'Pengisian',
                                            'DRAFT' => 'Belum Mulai',
                                            'DITUTUP' => 'Ditutup',
                                            default => '-',
                                        };
                                    @endphp

                                    <span
                                        class="rounded-[5px]
                                            bg-[#E6F4EA]
                                            px-3 py-[5px]
                                            text-[11px] font-medium
                                            text-[#137333]">
                                        {{ $statusLabel }}
                                    </span>

                                </td>

                                {{-- Asesor --}}
                                <td class="px-4 py-3">
                                    {{ $item['asesor'] }}
                                </td>

                                {{-- Nilai akhir --}}
                                <td class="px-4 py-3 text-center">

                                    <span
                                        class="inline-flex min-w-[52px]
                                            justify-center rounded-[6px]
                                            border border-[#006671]
                                            px-2 py-[4px]
                                            text-[12px] font-medium
                                            text-[#006671]">

                                        {{ $item['nilai'] !== null
                                            ? number_format($item['nilai'], 2)
                                            : '-' }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            {{-- Kondisi ketika belum ada evaluasi --}}
                            <tr>

                                <td
                                    colspan="7"
                                    class="px-4 py-10 text-center
                                        text-[13px] text-[#6D797B]">

                                    Belum ada data evaluasi instansi.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- FOOTER --}}
            <div
                class="flex justify-center border-t
                       border-[#D9D9D9] px-5 py-4">

                <a
                    href="#"
                    class="inline-flex items-center gap-2
                           text-[12px] font-medium text-[#006671]">

                    Lihat Semua Penilaian

                    <span class="text-[16px]">
                        →
                    </span>

                </a>

            </div>

        </div>


        {{-- KOLOM KANAN --}}
        <div class="flex flex-col gap-4">


            {{-- PROGRESS EVALUASI --}}
            <div
                class="overflow-hidden rounded-[12px]
                       border border-[#BCC9CB] bg-white">

                <div
                    class="border-b border-[#D9D9D9]
                           px-5 py-4">

                    <h2
                        class="text-[18px] font-semibold
                               text-[#11468F]">
                        Progress Evaluasi Instansi
                    </h2>

                </div>


                <div
                    class="flex flex-col items-center gap-6
                           px-5 py-4 sm:flex-row xl:flex-row">

                    {{-- DONUT --}}
                    @php
                        // Persentase evaluasi yang sudah selesai.
                        $persentaseSelesai = $progressEvaluasi['total'] > 0
                            ? ($progressEvaluasi['selesai']['jumlah'] / $progressEvaluasi['total']) * 100
                            : 0;

                        // Ubah persentase menjadi derajat untuk conic-gradient.
                        $derajatSelesai = $persentaseSelesai * 3.6;
                    @endphp

                    <div
                        class="relative flex h-[164px] w-[164px]
                            shrink-0 items-center justify-center
                            rounded-full"
                        style="
                            background:
                            conic-gradient(
                                #006671 0deg {{ $derajatSelesai }}deg,
                                #D9D9D9 {{ $derajatSelesai }}deg 360deg
                            );
                        ">

                        <div
                            class="flex h-[132px] w-[132px]
                                flex-col items-center justify-center
                                rounded-full bg-white">

                            <span
                                class="text-[27px] font-semibold
                                    text-[#11468F]">
                                {{ $progressEvaluasi['total'] > 0
                                    ? round(($progressEvaluasi['selesai']['jumlah'] / $progressEvaluasi['total']) * 100)
                                    : 0 }}%
                            </span>

                            <span
                                class="mt-1 text-center
                                    text-[11px] font-medium
                                    text-[#6D797B]">
                                Rata-rata
                                <br>
                                Progress
                            </span>

                        </div>

                    </div>

                    {{-- LEGEND --}}
                    <div class="w-full space-y-3 text-[12px]">

                        <div class="flex gap-3">

                            <span
                                class="mt-[5px] h-[10px] w-[10px]
                                       shrink-0 rounded-full bg-[#006671]">
                            </span>

                            <div>

                                <p class="font-medium text-[#11468F]">
                                    Selesai Evaluasi
                                </p>

                                <p class="text-[#6D797B]">
                                    {{ $progressEvaluasi['selesai']['jumlah'] }}
                                    Instansi
                                    ({{ number_format($progressEvaluasi['selesai']['persentase'], 1) }}%)
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-3">

                            <span
                                class="mt-[5px] h-[10px] w-[10px]
                                       shrink-0 rounded-full bg-[#214AE2]">
                            </span>

                            <div>

                                <p class="font-medium text-[#11468F]">
                                    Sedang Dievaluasi
                                </p>

                                <p class="text-[#6D797B]">
                                    {{ $progressEvaluasi['sedang']['jumlah'] }}
                                    Instansi
                                    ({{ number_format($progressEvaluasi['sedang']['persentase'], 1) }}%)
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-3">

                            <span
                                class="mt-[5px] h-[10px] w-[10px]
                                       shrink-0 rounded-full bg-[#FFBA45]">
                            </span>

                            <div>

                                <p class="font-medium text-[#11468F]">
                                    Menunggu Verifikasi
                                </p>

                                <p class="text-[#6D797B]">
                                    {{ $progressEvaluasi['menunggu']['jumlah'] }}
                                    Instansi
                                    ({{ number_format($progressEvaluasi['menunggu']['persentase'], 1) }}%)
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-3">

                            <span
                                class="mt-[5px] h-[10px] w-[10px]
                                       shrink-0 rounded-full bg-[#BA1A1A]">
                            </span>

                            <div>

                                <p class="font-medium text-[#11468F]">
                                    Belum Mengisi
                                </p>

                                <p class="text-[#6D797B]">
                                    {{ $progressEvaluasi['belum']['jumlah'] }}
                                    Instansi
                                    ({{ number_format($progressEvaluasi['belum']['persentase'], 1) }}%)
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- RIWAYAT AKTIVITAS --}}
            <div
                class="overflow-hidden rounded-[12px]
                       border border-[#BCC9CB] bg-white">

                <div
                    class="border-b border-[#D9D9D9]
                           px-6 py-3">

                    <h2
                        class="text-[22px] font-semibold
                               text-[#11468F]">
                        Riwayat Aktivitas
                    </h2>

                </div>


                <div class="px-6 py-2">

                        @forelse ($riwayatAktivitas as $aktivitas)

                            <div
                                class="flex gap-4 border-b
                                    border-[#D9D9D9] py-4 last:border-b-0">

                                {{-- Ikon aktivitas --}}
                                <div
                                    class="flex h-[36px] w-[36px]
                                        shrink-0 items-center justify-center
                                        rounded-full border-2
                                        border-[#C3C6D6]">

                                    <div
                                        class="h-[18px] w-[18px]
                                            rounded-full border-[4px]
                                            border-[#11468F]">
                                    </div>

                                </div>

                                <div>

                                    {{-- Deskripsi aktivitas dari audit_log --}}
                                    <p
                                        class="text-[18px] font-medium
                                            text-[#1F1F1F]">
                                        {{ $aktivitas['judul'] }}
                                    </p>

                                    {{-- Waktu aktivitas dari audit_log --}}
                                    <p
                                        class="mt-1 text-[13px]
                                            text-[#6D797B]">
                                        {{ $aktivitas['waktu'] }}
                                    </p>

                                </div>

                            </div>

                        @empty

                            {{-- Kondisi ketika belum ada aktivitas --}}
                            <div class="py-6 text-center">

                                <p class="text-[13px] text-[#6D797B]">
                                    Belum ada aktivitas.
                                </p>

                            </div>

                        @endforelse
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection