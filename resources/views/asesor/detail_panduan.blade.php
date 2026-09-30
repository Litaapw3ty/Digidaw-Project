@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full space-y-6">

{{-- =====================================================
     BREADCRUMB
====================================================== --}}

<div class="flex items-center gap-2 text-sm theme-muted">

    <a
        href="{{ url('/asesor/kelola_panduan') }}"
        class="hover:text-[#12a89d] dark:hover:text-[#14b8a6] transition-colors">

        Panduan & Template

    </a>

    <span>/</span>

    <span class="theme-title font-medium">
        Detail Aspek
    </span>

</div>


{{-- =====================================================
     HEADER
====================================================== --}}

<div>

    <div class="flex items-center gap-3">

        <span
            class="inline-flex items-center justify-center
                   w-10 h-10 rounded-full
                   border-2
                   border-[#12a89d]
                   text-[#12a89d]
                   dark:border-[#14b8a6]
                   dark:text-[#14b8a6]
                   font-bold">

            {{ $aspek->nomor_aspek }}

        </span>

        <div>

            <h1 class="text-3xl font-bold theme-title tracking-tight">
                {{ $aspek->nama_aspek }}
            </h1>

            <p class="text-lg theme-muted mt-1">
                Daftar indikator, tingkat penilaian, data dukung,
                dan panduan pendukung.
            </p>

        </div>

    </div>

</div>


{{-- =====================================================
     SUMMARY CARD
====================================================== --}}

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

    {{-- TOTAL INDIKATOR --}}

    <div class="theme-card border theme-border rounded-2xl shadow-sm p-6">

        <p class="text-sm font-medium theme-muted">
            Total Indikator
        </p>

        <p class="mt-2 text-3xl font-bold theme-title">
            {{ $totalIndikator }}
        </p>

    </div>


    {{-- TOTAL TINGKAT --}}

    <div class="theme-card border theme-border rounded-2xl shadow-sm p-6">

        <p class="text-sm font-medium theme-muted">
            Total Tingkat
        </p>

        <p class="mt-2 text-3xl font-bold theme-title">
            {{ $totalTingkat }}
        </p>

    </div>


    {{-- TOTAL DATA DUKUNG --}}

    <div class="theme-card border theme-border rounded-2xl shadow-sm p-6">

        <p class="text-sm font-medium theme-muted">
            Total Data Dukung
        </p>

        <p class="mt-2 text-3xl font-bold theme-title">
            {{ $totalDataDukung }}
        </p>

    </div>


    {{-- TOTAL PANDUAN --}}

    <div class="theme-card border theme-border rounded-2xl shadow-sm p-6">

        <p class="text-sm font-medium theme-muted">
            Total Panduan
        </p>

        <p class="mt-2 text-3xl font-bold theme-title">
            {{ $totalPanduan }}
        </p>

    </div>

</div>


{{-- =====================================================
     DAFTAR INDIKATOR
====================================================== --}}

<div class="theme-card border theme-border rounded-2xl shadow-sm overflow-hidden">

    {{-- HEADER --}}

    <div class="px-6 py-5 border-b theme-border">

        <h2 class="text-lg font-bold theme-title">
            Daftar Indikator
        </h2>

        <p class="text-sm theme-muted mt-1">
            Buka indikator untuk melihat tingkat penilaian,
            data dukung, dan panduan.
        </p>

    </div>


    {{-- =================================================
         INDIKATOR
    ================================================== --}}

    <div class="divide-y theme-border">

        @forelse($indikatorList as $indikator)

            <details class="group">


                {{-- =========================================
                     HEADER INDIKATOR
                ========================================== --}}

                <summary
                    class="list-none cursor-pointer
                           px-6 py-5
                           hover:bg-[#12a89d]/5
                           dark:hover:bg-[#14b8a6]/10
                           transition-colors">

                    <div class="flex items-center justify-between gap-4">

                        <div class="flex items-start gap-4">

                            {{-- NOMOR INDIKATOR --}}

                            <span
                                class="flex-shrink-0
                                       inline-flex items-center justify-center
                                       w-9 h-9 rounded-lg
                                       bg-[#12a89d]/10
                                       dark:bg-[#14b8a6]/20
                                       text-[#12a89d]
                                       dark:text-[#14b8a6]
                                       font-bold text-sm">

                                {{ $indikator->nomor_indikator }}

                            </span>


                            {{-- INFORMASI INDIKATOR --}}

                            <div>

                                <p class="font-semibold theme-title">
                                    {{ $indikator->nama_indikator }}
                                </p>

                                <p class="text-sm theme-muted mt-1">

                                    {{ $indikator->tingkatList->count() }}
                                    Tingkat

                                    <span class="mx-1">•</span>

                                    {{ $indikator->tingkatList->sum(fn($tingkat) => $tingkat->dataDukungList->count()) }}
                                    Data Dukung

                                    <span class="mx-1">•</span>

                                    {{ $indikator->panduanList->count() }}
                                    Panduan

                                </p>

                            </div>

                        </div>


                        {{-- CHEVRON --}}

                        <svg
                            class="w-5 h-5 theme-muted
                                   transition-transform duration-200
                                   group-open:rotate-180
                                   flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m6 9 6 6 6-6" />

                        </svg>

                    </div>

                </summary>


                {{-- =========================================
                     ISI INDIKATOR
                ========================================== --}}

                <div class="px-6 pb-6 space-y-6">

                    {{-- =====================================
                         TINGKAT PENILAIAN
                    ====================================== --}}

                    <div class="ml-4">

                        <div class="mb-4">

                            <h3 class="text-sm font-bold theme-title">
                                Tingkat Penilaian
                            </h3>

                            <p class="text-xs theme-muted mt-1">
                                Kriteria data dukung berdasarkan tingkat pencapaian.
                            </p>

                        </div>


                        @if($indikator->tingkatList->count())

                            <div class="space-y-3">

                                @foreach($indikator->tingkatList as $tingkat)

                                    {{-- =================================
                                         ACCORDION TINGKAT
                                    ================================== --}}

                                    <details class="group/tingkat">


                                        {{-- HEADER TINGKAT --}}

                                        <summary
                                            style="border: 1px solid rgba(229, 231, 235, 0.4) !important;"
                                            class="list-none cursor-pointer rounded-xl px-5 py-4 hover:bg-[#12a89d]/5 dark:hover:bg-[#14b8a6]/10 transition-colors">

                                            <div class="flex items-center justify-between gap-4">

                                                <div class="flex items-center gap-3">

                                                    <span
                                                        class="inline-flex items-center justify-center
                                                               min-w-9 h-9 px-2 rounded-lg
                                                               bg-[#12a89d]/10 dark:bg-[#14b8a6]/20
                                                               text-[#12a89d] dark:text-[#14b8a6]
                                                               text-xs font-bold">

                                                        {{ $tingkat->id_tingkat }}

                                                    </span>

                                                    <div>

                                                        <p class="text-sm font-semibold theme-title">
                                                            {{ $tingkat->nama_tingkat }}
                                                        </p>

                                                        <p class="text-xs theme-muted mt-0.5">
                                                            {{ $tingkat->dataDukungList->count() }} Kriteria
                                                        </p>

                                                    </div>

                                                </div>


                                                <svg
                                                    class="w-5 h-5 theme-muted
                                                           transition-transform duration-200
                                                           group-open/tingkat:rotate-180"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="m6 9 6 6 6-6" />

                                                </svg>

                                            </div>

                                        </summary>


                                        {{-- =================================
                                             DATA DUKUNG
                                        ================================== --}}

                                        <div class="pt-3 pl-5">

                                            <div class="space-y-2">

                                                @foreach($tingkat->dataDukungList as $dataDukung)

                                                    @php
                                                        // Filter panduan khusus untuk data dukung ini
                                                        $panduanDD = ($indikator->panduanList ?? collect())->where('id_data_dukung', $dataDukung->id_data_dukung);

                                                        $ddHasPanduan = $panduanDD->contains(function ($item) {
                                                            return strtolower($item->jenis ?? $item->tipe ?? '') === 'panduan';
                                                        });

                                                        $ddHasTemplate = $panduanDD->contains(function ($item) {
                                                            return strtolower($item->jenis ?? $item->tipe ?? '') === 'template';
                                                        });
                                                    @endphp

                                                    <div
                                                        style="border: 1px solid rgba(229, 231, 235, 0.4) !important;"
                                                        class="flex items-center justify-between gap-4 px-4 py-3 rounded-lg">

                                                        {{-- INFORMASI DATA DUKUNG --}}

                                                        <div class="flex items-start gap-4 flex-1">

                                                            {{-- NOMOR --}}

                                                            <span
                                                                class="flex-shrink-0 text-sm font-bold
                                                                       text-[#12a89d] dark:text-[#14b8a6]">

                                                                {{ $dataDukung->nomor }}.

                                                            </span>


                                                            {{-- DATA DUKUNG --}}

                                                            <div class="flex-1">

                                                                <p class="text-sm font-medium theme-title">
                                                                    {{ $dataDukung->nama_data_dukung }}
                                                                </p>


                                                                @if(!empty($dataDukung->deskripsi))

                                                                    <p class="text-xs theme-muted mt-1">
                                                                        {{ $dataDukung->deskripsi }}
                                                                    </p>

                                                                @endif


                                                                <div class="flex flex-wrap items-center gap-2 mt-2">

                                                                    @if($dataDukung->bobot !== null)

                                                                        <span class="text-xs font-medium text-[#12a89d] dark:text-[#14b8a6]">
                                                                            Bobot:
                                                                            {{ rtrim(rtrim(number_format($dataDukung->bobot, 2, ',', '.'), '0'), ',') }}%
                                                                        </span>

                                                                    @endif


                                                                    @if(!empty($dataDukung->format_file))

                                                                        <span class="text-xs theme-muted">
                                                                            • Format:
                                                                            {{ $dataDukung->format_file }}
                                                                        </span>

                                                                    @endif

                                                                    {{-- BADGE WARNA SAMA DENGAN "MENUNGGU" DASHBOARD --}}
                                                                    @if($ddHasPanduan && $ddHasTemplate)
                                                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                                                            <i class="fa-solid fa-circle-check text-[9px]"></i> Panduan & Template Lengkap
                                                                        </span>
                                                                    @elseif($ddHasPanduan && !$ddHasTemplate)
                                                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                                                            <i class="fa-solid fa-triangle-exclamation text-[9px]"></i> Kurang Template
                                                                        </span>
                                                                    @elseif(!$ddHasPanduan && $ddHasTemplate)
                                                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                                                            <i class="fa-solid fa-triangle-exclamation text-[9px]"></i> Kurang Panduan
                                                                        </span>
                                                                    @else
                                                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">
                                                                            Belum Ada File
                                                                        </span>
                                                                    @endif

                                                                </div>

                                                            </div>

                                                        </div>

                                                        {{-- TOMBOL AKSI KELOLA --}}

                                                        <div class="flex-shrink-0">

                                                            <a
                                                                href="{{ route('asesor.panduan.upload', ['idAspek' => $aspek->id_aspek, 'idIndikator' => $indikator->id_indikator, 'idDataDukung' => $dataDukung->id_data_dukung]) }}"
                                                                class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-[#12a89d] hover:bg-[#0f9188] text-white text-xs font-semibold shadow-sm transition-all duration-200 active:scale-95"
                                                            >
                                                                <i class="fa-solid fa-file-arrow-up text-[11px]"></i>
                                                                Kelola Panduan &amp; Template
                                                            </a>

                                                        </div>

                                                    </div>

                                                @endforeach

                                            </div>

                                        </div>

                                    </details>

                                @endforeach

                            </div>

                        @else

                            <div class="px-4 py-4 rounded-lg border border-dashed theme-border">

                                <p class="text-sm theme-muted">
                                    Belum ada tingkat penilaian untuk indikator ini.
                                </p>

                            </div>

                        @endif

                    </div>

                </div>

            </details>

        @empty

            <div class="py-12 text-center">

                <p class="theme-muted">
                    Belum ada indikator untuk aspek ini.
                </p>

            </div>

        @endforelse

    </div>

</div>

</div>

@endsection