@extends('layouts.sidebar.sidebar-user')

@section('content')

<div class="min-h-screen bg-[#f7fafa] px-6 py-6 dark:bg-gray-900">
    <div class="mb-6">
        {{-- BREADCRUMB --}}
        <div class="mb-5 flex items-center gap-3 text-sm">
            <a href="{{ route('user.penilaian') }}" class="font-semibold text-[#0f246b] hover:underline dark:text-blue-300">
                Penilaian
            </a>

            <span class="text-gray-400">
                ›
            </span>

            <a href="{{ route('user.penilaian') }}" class="font-semibold text-[#0f246b] hover:underline dark:text-blue-300">
                Penilaian Mandiri
            </a>

            <span class="text-gray-400">
                ›
            </span>

            <span class="text-gray-500 dark:text-gray-300">
                Indikator Penilaian Mandiri
            </span>
        </div>


        <div class="flex items-start justify-between gap-4">

            <div>

                {{-- ASPEK --}}
                <div
                    class="mb-2 inline-flex rounded-full bg-[#fff0c7] px-4 py-1 text-sm font-semibold text-[#d99b00] dark:bg-yellow-900/30 dark:text-yellow-300"
                >

                    Aspek {{ $aspek->nomor_aspek ?? $aspek->id_aspek }}:
                    {{ $aspek->nama_aspek }}

                </div>


                {{-- JUDUL --}}
                <h1 class="text-[28px] font-bold leading-tight text-gray-900 dark:text-white">

                    {{ $indikator->nomor ?? $indikator->id_indikator }}.
                    {{ $indikator->nama_indikator }}

                </h1>


                <p class="mt-1 text-base text-gray-700 dark:text-gray-300">

                    Detail Indikator yang digunakan dalam penilaian mandiri
                    pemerintah digital

                </p>

            </div>


            {{-- KEMBALI --}}
            <a
                href="{{ route('user.penilaian') }}"
                class="inline-flex h-9 shrink-0 items-center justify-center rounded-lg border border-red-500 px-6 text-sm font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30"
            >
                Kembali
            </a>

        </div>

    </div>


    {{-- =========================================================
         INFORMASI INDIKATOR
    ========================================================== --}}

    <div
        class="mb-8 overflow-hidden rounded-xl border border-gray-300 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
    >

        <div
            class="border-b border-gray-200 px-8 py-4 dark:border-gray-700"
        >

            <h2 class="text-lg font-bold text-gray-800 dark:text-white">
                Informasi Indikator
            </h2>

        </div>


        <div class="px-8 py-5">

            {{-- KODE --}}
            <div class="grid grid-cols-1 gap-y-3 text-sm md:grid-cols-[160px_25px_1fr]">

                <span class="text-gray-700 dark:text-gray-300">
                    Kode
                </span>

                <span class="text-gray-700 dark:text-gray-300">
                    :
                </span>

                <span class="font-medium text-gray-800 dark:text-white">
                    {{ $instansi->kode_instansi ?? '-' }}
                </span>

            </div>


            {{-- NAMA INSTANSI --}}
            <div class="mt-2 grid grid-cols-1 gap-y-3 text-sm md:grid-cols-[160px_25px_1fr]">

                <span class="text-gray-700 dark:text-gray-300">
                    Nama Instansi
                </span>

                <span class="text-gray-700 dark:text-gray-300">
                    :
                </span>

                <span class="font-medium text-gray-800 dark:text-white">
                    {{ $instansi->nama_instansi ?? '-' }}
                </span>

            </div>


            {{-- KATEGORI --}}
            <div class="mt-2 grid grid-cols-1 gap-y-3 text-sm md:grid-cols-[160px_25px_1fr]">

                <span class="text-gray-700 dark:text-gray-300">
                    Kategori
                </span>

                <span class="text-gray-700 dark:text-gray-300">
                    :
                </span>

                <span class="font-medium text-gray-800 dark:text-white">

                    @switch($instansi->kategori)

                        @case('KABUPATEN')
                            Pemerintah Kabupaten
                            @break

                        @case('KOTA')
                            Pemerintah Kota
                            @break

                        @case('PROVINSI')
                            Pemerintah Provinsi
                            @break

                        @case('PUSAT')
                            Pemerintah Pusat
                            @break

                        @default
                            {{ $instansi->kategori ?? '-' }}

                    @endswitch

                </span>

            </div>


            {{-- GARIS --}}
            <div
                class="my-5 border-t border-dotted border-gray-400 dark:border-gray-600"
            ></div>


            {{-- DESKRIPSI --}}
            <div class="grid grid-cols-1 gap-y-3 text-sm md:grid-cols-[160px_25px_1fr]">

                <span class="text-gray-700 dark:text-gray-300">
                    Deskripsi
                </span>

                <span class="text-gray-700 dark:text-gray-300">
                    :
                </span>

                <div
                    class="leading-6 text-gray-700 dark:text-gray-300"
                >

                    {!! nl2br(e($indikator->deskripsi ?? '')) !!}

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         REKOMENDASI INDIKATOR
    ========================================================== --}}

    <div
        class="overflow-hidden rounded-xl border border-gray-300 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
    >

        {{-- TITLE --}}
        <div class="px-8 pt-6">

            <h2 class="text-lg font-bold text-[#17256b] dark:text-blue-400">
                Rekomendasi Indikator
            </h2>

        </div>


        {{-- =====================================================
             TABS TINGKAT KEMATANGAN
        ====================================================== --}}

        <div
            class="mt-4 border-b border-gray-200 px-4 dark:border-gray-700"
        >

            <div class="flex overflow-x-auto scrollbar-thin">

                @foreach($tingkat as $index => $level)

                    @php

                        $progressData =
                            $progressPerTingkat[
                                $level->id_tingkat
                            ] ?? [
                                'total' => 0,
                                'terisi' => 0,
                                'progress' => 0,
                            ];

                        /*
                        |--------------------------------------------------------------------------
                        | AMBIL TOTAL / TERISI
                        |--------------------------------------------------------------------------
                        */

                        if (is_array($progressData)) {

                            $total =
                                $progressData['total']
                                ?? 0;

                            $terisi =
                                $progressData['terisi']
                                ?? 0;

                        } else {

                            $total = 0;
                            $terisi = 0;

                        }


                        $label =
                            $namaLevel[
                                $level->level
                            ]
                            ?? 'Tingkat Kematangan';


                        $isActive =
                            $index === 0;

                    @endphp


                    <button
                        type="button"
                        id="tab-{{ $level->id_tingkat }}"
                        onclick="switchLevel({{ $level->id_tingkat }})"
                        class="level-tab shrink-0 whitespace-nowrap border-b-2 px-5 py-4 text-sm font-medium transition-colors
                        {{ $isActive
                            ? 'border-[#12a89d] text-[#12a89d]'
                            : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300'
                        }}"
                    >

                        {{ $label }}

                        <span class="ml-1">
                            ({{ $terisi }}/{{ $total }})
                        </span>

                    </button>

                @endforeach

            </div>

        </div>


        {{-- =====================================================
             CONTENT SETIAP LEVEL
        ====================================================== --}}

        @foreach($tingkat as $index => $level)

            @php

                $items =
                    $dataDukungPerTingkat->get(
                        $level->id_tingkat,
                        collect()
                    );


                $pm =
                    $pmPerTingkat[
                        $level->id_tingkat
                    ]
                    ?? [
                        'diperoleh' => 0,
                        'maksimal' => 0,
                    ];

            @endphp


            <div
                id="level-content-{{ $level->id_tingkat }}"
                class="{{ $index !== 0 ? 'hidden' : '' }}"
            >

                {{-- =================================================
                     PM
                ================================================== --}}

                <div
                    class="flex items-center justify-end gap-3 px-6 py-5"
                >

                    <div
                        class="text-sm font-bold text-gray-800 dark:text-gray-200"
                    >

                        PM :

                        <span class="text-[#12a89d]">

                            {{
                                rtrim(
                                    rtrim(
                                        number_format(
                                            (float) ($pm['diperoleh'] ?? 0),
                                            2,
                                            '.',
                                            ''
                                        ),
                                        '0'
                                    ),
                                    '.'
                                )
                            }}

                        </span>

                        /

                        {{
                            rtrim(
                                rtrim(
                                    number_format(
                                        (float) ($pm['maksimal'] ?? 0),
                                        2,
                                        '.',
                                        ''
                                    ),
                                    '0'
                                ),
                                '.'
                            )
                        }}

                    </div>


                    {{-- DETAIL KRITERIA --}}
                    <button
                        type="button"
                        onclick="openCriteriaModal({{ $level->id_tingkat }})"
                        class="inline-flex items-center gap-1.5 rounded-md border border-[#59c9c8] bg-white px-3 py-1.5 text-xs font-semibold text-[#159b99] transition hover:bg-[#eafafa] dark:bg-gray-800 dark:hover:bg-teal-950/30"
                    >

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7z"
                            />

                            <circle
                                cx="12"
                                cy="12"
                                r="3"
                                stroke-width="2"
                            />

                        </svg>

                        Detail

                    </button>

                </div>


                {{-- =================================================
                     TABLE
                ================================================== --}}

                <div class="overflow-x-auto px-6 pb-6">
                    <table class="w-full border-collapse rounded-t-lg overflow-hidden shadow-sm">
                        
                        {{-- HEADER TABEL --}}
                        <thead class="bg-gray-100 dark:bg-slate-700">
                            <tr>
                                <th class="border-b-[3px] border-[#12a89d] px-4 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700 dark:border-[#0f8f88] dark:text-white">
                                    No
                                </th>

                                <th class="border-b-[3px] border-[#12a89d] px-4 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-700 dark:border-[#0f8f88] dark:text-white">
                                    Data Dukung
                                </th>

                                <th class="border-b-[3px] border-[#12a89d] px-4 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700 dark:border-[#0f8f88] dark:text-white">
                                    Template Dokumen
                                </th>

                                <th class="border-b-[3px] border-[#12a89d] px-4 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700 dark:border-[#0f8f88] dark:text-white">
                                    Panduan
                                </th>

                                <th class="border-b-[3px] border-[#12a89d] px-4 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700 dark:border-[#0f8f88] dark:text-white">
                                    Status
                                </th>

                                <th class="border-b-[3px] border-[#12a89d] px-4 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700 dark:border-[#0f8f88] dark:text-white">
                                    Value
                                </th>

                                <th class="border-b-[3px] border-[#12a89d] px-4 py-4 text-center text-xs font-bold uppercase tracking-wider text-gray-700 dark:border-[#0f8f88] dark:text-white">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        {{-- BODY TABEL --}}
                        <tbody class="bg-white dark:bg-slate-900/80">

                            @forelse($items as $item)

                                @php
                                    $sudahUpload = in_array(
                                        $item->status_data_dukung,
                                        ['TERKIRIM', 'DIVERIFIKASI', 'PERLU_PERBAIKAN'],
                                        true
                                    ) && $item->dokumen->isNotEmpty();

                                    $template = $panduan->where('tipe', 'TEMPLATE')->first();
                                @endphp

                                <tr class="border-b border-gray-200 transition hover:bg-gray-50 dark:border-slate-700/80 dark:hover:bg-slate-800/70">

                                    {{-- NO --}}
                                    <td class="border-r border-gray-200 px-3 py-5 text-center text-xs text-gray-600 dark:border-slate-700/50 dark:text-gray-300">
                                        {{ $loop->iteration }}
                                    </td>

                                    {{-- DATA DUKUNG --}}
                                    <td class="border-r border-gray-200 px-4 py-5 dark:border-slate-700/50">
                                        <div class="text-xs leading-relaxed text-gray-700 dark:text-gray-300">
                                            {{ $item->nama_data_dukung }}
                                        </div>
                                    </td>

                                    {{-- TEMPLATE --}}
                                    <td class="border-r border-gray-200 px-4 py-5 dark:border-slate-700/50">
                                        @if($template)
                                            <a href="{{ asset('storage/' . $template->file_path) }}" target="_blank" class="flex items-start justify-center gap-2 text-xs font-semibold text-gray-700 hover:text-[#159b99] dark:text-gray-300">
                                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                                    <polyline points="14 2 14 8 20 8" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                                </svg>
                                                <span class="min-w-0 text-left">
                                                    <span class="block break-words">
                                                        {{ $template->judul ?? $template->nama ?? 'Template Dokumen' }}
                                                    </span>
                                                    <span class="mt-0.5 block text-[10px] font-normal text-gray-400">DOCX</span>
                                                </span>
                                            </a>
                                        @else
                                            <div class="text-center text-xs text-gray-400 dark:text-gray-500">-</div>
                                        @endif
                                    </td>

                                    {{-- PANDUAN --}}
                                    <td class="border-r border-gray-200 px-3 py-5 text-center dark:border-slate-700/50">
                                        @if($panduanPenilaian)
                                            <button type="button" onclick="openGuideModal()" class="inline-flex items-center gap-1 rounded-md border border-[#d9eeee] bg-white px-2.5 py-1.5 text-[11px] font-semibold text-[#159b99] transition hover:bg-[#eafafa] dark:border-teal-900 dark:bg-slate-800 dark:hover:bg-teal-950">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                                                </svg>
                                                Panduan
                                            </button>
                                        @else
                                            <span class="text-xs text-gray-400 dark:text-gray-500">-</span>
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="border-r border-gray-200 px-3 py-5 text-center dark:border-slate-700/50">
                                        @switch($item->status_data_dukung)
                                            @case('DIVERIFIKASI')
                                                <span class="inline-flex rounded-md bg-[#d9f7df] px-2 py-1 text-[10px] font-semibold text-green-700 dark:bg-green-900/40 dark:text-green-400 border border-transparent dark:border-green-800">
                                                    Terverifikasi
                                                </span>
                                                @break
                                            @case('PERLU_PERBAIKAN')
                                                <span class="inline-flex rounded-md bg-[#ffe1e1] px-2 py-1 text-[10px] font-semibold text-red-600 dark:bg-red-900/40 dark:text-red-400 border border-transparent dark:border-red-800">
                                                    Perlu Diperbaiki
                                                </span>
                                                @break
                                            @case('TERKIRIM')
                                                <span class="inline-flex rounded-md bg-[#dcecff] px-2 py-1 text-[10px] font-semibold text-blue-600 dark:bg-blue-900/40 dark:text-blue-400 border border-transparent dark:border-blue-800">
                                                    Sudah Diupload
                                                </span>
                                                @break
                                            @default
                                                <span class="inline-flex rounded-md bg-[#ffdfe1] px-2 py-1 text-[10px] font-semibold text-red-600 dark:bg-red-900/40 dark:text-red-400 border border-transparent dark:border-red-800">
                                                    Belum<br>Diupload
                                                </span>
                                        @endswitch
                                    </td>

                                    {{-- VALUE --}}
                                    <td class="border-r border-gray-200 px-3 py-5 text-center text-xs text-gray-700 dark:border-slate-700/50 dark:text-gray-300">
                                        {{ rtrim(rtrim(number_format((float) ($item->value ?? 0), 2, '.', ''), '0'), '.') }}
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-3 py-5 text-center">
                                        <div class="flex items-center justify-center gap-1">
                                            @if($sudahUpload)
                                                <button type="button" onclick="openDocumentDetail({{ $item->id_data_dukung }})" class="inline-flex items-center gap-1 rounded-md bg-[#12a89d] px-2.5 py-1.5 text-[10px] font-bold text-white shadow-sm transition hover:bg-[#0f8f88] dark:hover:bg-[#12a89d]/80">
                                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7z" />
                                                        <circle cx="12" cy="12" r="3" stroke-width="2" />
                                                    </svg>
                                                    Detail
                                                </button>
                                            @else
                                                <button type="button" onclick="openUploadModal({{ $item->id_data_dukung }})" class="inline-flex items-center gap-1 rounded-md bg-[#12a89d] px-2.5 py-1.5 text-[10px] font-bold text-white shadow-sm transition hover:bg-[#0f8f88] dark:hover:bg-[#12a89d]/80">
                                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                    </svg>
                                                    Upload
                                                </button>
                                            @endif

                                            <button type="button" onclick="openEditModal({{ $item->id_data_dukung }})" class="inline-flex items-center gap-1 rounded-md bg-[#f5bd18] px-2.5 py-1.5 text-[10px] font-bold text-white shadow-sm transition hover:bg-[#dfa900] dark:hover:bg-[#f5bd18]/80">
                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h5" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1-1-4 9.5-9.5z" />
                                                </svg>
                                                Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                {{-- CATATAN ASESOR --}}
                                @if(!empty($item->catatan_asesor))
                                    <tr>
                                        <td colspan="7" class="border-b border-gray-200 bg-[#fff9f9] px-5 py-3 dark:border-slate-700/80 dark:bg-red-950/20">
                                            <div class="flex items-start gap-2">
                                                <svg class="mt-0.5 h-4 w-4 shrink-0 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4h2v5h-2V6zm0 6h2v2h-2v-2z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-xs font-bold text-red-600 dark:text-red-400">Catatan Asesor:</span>
                                                <span class="text-xs text-gray-700 dark:text-gray-300">{{ $item->catatan_asesor }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endif

                            @empty
                                <tr>
                                    <td colspan="7" class="border-b border-gray-200 px-5 py-12 text-center text-sm text-gray-400 dark:border-slate-700/80 dark:text-gray-500">
                                        Belum ada Data Dukung pada tingkat ini.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>


                {{-- =================================================
                     PANDUAN PENILAIAN
                ================================================--}}
                <div class="-mt-3 mx-6 mb-6 rounded-lg border border-[#00cece] bg-[#f2fcfc] p-4 shadow-sm dark:border-teal-700 dark:bg-teal-950/30">
                    <div class="flex items-start gap-2">
                        
                        {{-- Icon Info --}}
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#00baba]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
                        </svg>

                        <div class="min-w-0 flex-1">
                            <div class="text-xs font-bold text-gray-800 dark:text-gray-100">
                                Panduan Penilaian:
                            </div>

                            <div class="mt-1 break-words text-xs leading-relaxed text-gray-700 dark:text-gray-300">
                                Upload dokumen rancangan perencanaan instansi pemerintah yang memuat substansi Rencana Aksi Nasional Pemerintah Digital secara lengkap. Dokumen dapat berupa draft atau rancangan awal yang masih dalam tahap penyusunan.
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        @endforeach

    </div>

</div>


@include(
    'user.penilaian.internal.upload',
    [
        'indikator' => $indikator,
        'dataDukung' => $dataDukung,
    ]
)


@include(
    'user.penilaian.internal.detail',
    [
        'indikator' => $indikator,
        'dataDukung' => $dataDukung,
    ]
)


@include(
    'user.penilaian.internal.edit',
    [
        'indikator' => $indikator,
        'dataDukung' => $dataDukung,
    ]
)


{{-- =========================================================
     MODAL DETAIL KRITERIA
========================================================= --}}

<div
    id="criteriaModal"
    class="fixed inset-0 z-[9999] hidden items-center justify-center bg-gray-900/60 p-4 backdrop-blur-sm"
>
    <div
        class="flex w-full max-w-3xl flex-col overflow-hidden rounded-xl bg-white shadow-2xl dark:bg-gray-800"
    >
        {{-- HEADER --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-gray-700">
            <div>
                <h3 id="criteriaModalTitle" class="text-xl font-extrabold text-gray-900 dark:text-white">
                    Tingkat Kematangan Level 1
                </h3>
                {{-- Subtitle dihilangkan karena pada gambar design menyatu dengan Title --}}
            </div>

            <button
                type="button"
                onclick="closeCriteriaModal()"
                class="text-2xl leading-none text-gray-400 hover:text-gray-700 dark:hover:text-white"
            >
                &times;
            </button>
        </div>

        {{-- CONTENT --}}
        <div
            id="criteriaModalContent"
            class="overflow-y-auto px-6 py-6 max-h-[65vh]"
        ></div>

        {{-- FOOTER --}}
        <div class="flex justify-end border-t border-gray-200 px-6 py-4 dark:border-gray-700">
            <button
                type="button"
                onclick="closeCriteriaModal()"
                class="rounded-md bg-[#00baba] px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#009e9e]"
            >
                Tutup
            </button>
        </div>
    </div>
</div>


{{-- =========================================================
     MODAL PANDUAN
========================================================= --}}

@if($panduanPenilaian)

    <div
        id="guideModal"
        class="fixed inset-0 z-[9999] hidden items-center justify-center bg-gray-900/60 p-4 backdrop-blur-sm"
    >

        <div
            class="flex max-h-[90vh] w-full max-w-2xl flex-col overflow-hidden rounded-xl bg-white shadow-2xl dark:bg-gray-800"
        >

            <div
                class="flex items-center justify-between border-b border-gray-200 px-6 py-4 dark:border-gray-700"
            >

                <h3
                    class="text-lg font-bold text-gray-900 dark:text-white"
                >
                    Panduan Penilaian
                </h3>


                <button
                    type="button"
                    onclick="closeGuideModal()"
                    class="text-2xl leading-none text-gray-400 hover:text-gray-700 dark:hover:text-white"
                >
                    &times;
                </button>

            </div>


            <div class="overflow-y-auto p-6">

                <div
                    class="whitespace-pre-line text-sm leading-relaxed text-gray-700 dark:text-gray-300"
                >
                    {{ $panduanPenilaian }}
                </div>

            </div>

        </div>

    </div>

@endif


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | DATA KRITERIA
    |--------------------------------------------------------------------------
    */

    const criteriaData =
        @json($detailData);


    /*
    |--------------------------------------------------------------------------
    | SWITCH LEVEL
    |--------------------------------------------------------------------------
    */

    function switchLevel(levelId) {

        document
            .querySelectorAll(
                '[id^="level-content-"]'
            )
            .forEach(function (element) {

                element.classList.add(
                    'hidden'
                );

            });


        document
            .querySelectorAll(
                '.level-tab'
            )
            .forEach(function (element) {

                element.classList.remove(
                    'border-[#12a89d]',
                    'text-[#12a89d]'
                );

                element.classList.add(
                    'border-transparent',
                    'text-gray-500'
                );

            });


        const content =
            document.getElementById(
                'level-content-' + levelId
            );


        const tab =
            document.getElementById(
                'tab-' + levelId
            );


        if (content) {

            content.classList.remove(
                'hidden'
            );

        }


        if (tab) {

            tab.classList.remove(
                'border-transparent',
                'text-gray-500'
            );

            tab.classList.add(
                'border-[#12a89d]',
                'text-[#12a89d]'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL KRITERIA
    |--------------------------------------------------------------------------
    */

    function openCriteriaModal(levelId) {
        const data = criteriaData[levelId];

        if (!data) return;

        const modal = document.getElementById('criteriaModal');
        const content = document.getElementById('criteriaModalContent');
        const titleEl = document.getElementById('criteriaModalTitle');

        // Set Title sesuai level
        titleEl.textContent = 'Tingkat Kematangan Level ' + data.level;
        
        content.innerHTML = '';

        if (!data.items || data.items.length === 0) {
            content.innerHTML = `
                <div class="py-6 text-center text-sm text-gray-500">
                    Kriteria untuk tingkat ini belum tersedia.
                </div>
            `;
        } else {
            let fullHtml = '';

            data.items.forEach(function (item) {
                let text = item.kriteria || '';
                const lines = text.replace(/\r\n/g, '\n').replace(/\r/g, '\n').split('\n');

                let sections = [];
                let currentSection = null;

                // 1. Parsing: Mengelompokkan teks berdasarkan Judul (Kriteria/Kondisi)
                lines.forEach(line => {
                    const trimmed = line.trim();
                    if (trimmed === '') return;

                    const isHeading = !/^\d+\.\s*/.test(trimmed) && /:$/.test(trimmed);

                    if (isHeading) {
                        if (currentSection) sections.push(currentSection);
                        currentSection = {
                            title: trimmed,
                            items: []
                        };
                    } else {
                        if (!currentSection) {
                            currentSection = { title: '', items: [] };
                        }

                        const numberMatch = trimmed.match(/^(\d+)\.\s*(.*)$/);
                        if (numberMatch) {
                            currentSection.items.push({
                                type: 'number',
                                num: numberMatch[1],
                                text: numberMatch[2]
                            });
                        } else {
                            // Jika ini baris lanjutan dari nomor sebelumnya, gabungkan.
                            let lastItem = currentSection.items[currentSection.items.length - 1];
                            if (lastItem && lastItem.type === 'number') {
                                lastItem.text += '\n' + trimmed;
                            } else {
                                currentSection.items.push({
                                    type: 'text',
                                    text: trimmed
                                });
                            }
                        }
                    }
                });
                
                if (currentSection) sections.push(currentSection);
                const iconSvg = `
                    <svg class="mt-0.5 h-4 w-4 shrink-0 text-[#00baba]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                `;

                sections.forEach(sec => {
                    fullHtml += `
                        <div class="mb-5 rounded-lg border border-[#00cece] bg-[#f2fcfc] p-5 shadow-sm last:mb-0 dark:border-teal-700 dark:bg-teal-950/20">
                            ${sec.title ? `
                                <div class="mb-3 flex items-start gap-2.5">
                                    ${iconSvg}
                                    <span class="text-[15px] font-bold text-gray-800 dark:text-gray-100">${escapeHtml(sec.title)}</span>
                                </div>
                            ` : ''}
                            
                            <div class="${sec.title ? 'ml-[26px]' : ''} text-sm text-gray-700 leading-relaxed dark:text-gray-300">
                    `;

                    sec.items.forEach(it => {
                        if (it.type === 'number') {
                            fullHtml += `
                                <div class="mb-1.5 flex items-start gap-2">
                                    <div class="w-4 shrink-0 text-right">${it.num}.</div>
                                    <div class="min-w-0 flex-1 whitespace-pre-line">${escapeHtml(it.text)}</div>
                                </div>
                            `;
                        } else {
                            fullHtml += `
                                <div class="mb-1.5 whitespace-pre-line">${escapeHtml(it.text)}</div>
                            `;
                        }
                    });

                    fullHtml += `
                            </div>
                        </div>
                    `;
                });
            });

            content.innerHTML = fullHtml;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }



    /*
    |--------------------------------------------------------------------------
    | CLOSE DETAIL KRITERIA
    |--------------------------------------------------------------------------
    */

    function closeCriteriaModal() {

        const modal =
            document.getElementById(
                'criteriaModal'
            );


        modal.classList.remove(
            'flex'
        );

        modal.classList.add(
            'hidden'
        );


        document.body.style.overflow =
            '';

    }


    /*
    |--------------------------------------------------------------------------
    | GUIDE
    |--------------------------------------------------------------------------
    */

    function openGuideModal() {

        const modal =
            document.getElementById(
                'guideModal'
            );


        if (!modal) {
            return;
        }


        modal.classList.remove(
            'hidden'
        );

        modal.classList.add(
            'flex'
        );


        document.body.style.overflow =
            'hidden';

    }


    function closeGuideModal() {

        const modal =
            document.getElementById(
                'guideModal'
            );


        if (!modal) {
            return;
        }


        modal.classList.remove(
            'flex'
        );

        modal.classList.add(
            'hidden'
        );


        document.body.style.overflow =
            '';

    }


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        if (
            value === null ||
            value === undefined
        ) {

            return '';

        }


        return String(value)

            .replace(
                /&/g,
                '&amp;'
            )

            .replace(
                /</g,
                '&lt;'
            )

            .replace(
                />/g,
                '&gt;'
            )

            .replace(
                /"/g,
                '&quot;'
            )

            .replace(
                /'/g,
                '&#039;'
            );

    }


    /*
    |--------------------------------------------------------------------------
    | ESC
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key !== 'Escape'
            ) {
                return;
            }


            closeCriteriaModal();

            closeGuideModal();


            /*
            |--------------------------------------------------------------------------
            | Popup dari partial
            |--------------------------------------------------------------------------
            */

            if (
                typeof closeUploadModal ===
                'function'
            ) {

                closeUploadModal();

            }


            if (
                typeof closeDocumentDetail ===
                'function'
            ) {

                closeDocumentDetail();

            }


            if (
                typeof closeEditModal ===
                'function'
            ) {

                closeEditModal();

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CLICK OUTSIDE CRITERIA
    |--------------------------------------------------------------------------
    */

    document
        .getElementById(
            'criteriaModal'
        )
        .addEventListener(
            'click',
            function (event) {

                if (
                    event.target === this
                ) {

                    closeCriteriaModal();

                }

            }
        );


    /*
    |--------------------------------------------------------------------------
    | CLICK OUTSIDE GUIDE
    |--------------------------------------------------------------------------
    */

    const guideModal =
        document.getElementById(
            'guideModal'
        );


    if (guideModal) {

        guideModal.addEventListener(
            'click',
            function (event) {

                if (
                    event.target === this
                ) {

                    closeGuideModal();

                }

            }
        );

    }

</script>

@endsection
