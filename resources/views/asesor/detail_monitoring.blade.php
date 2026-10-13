@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">

        <div>

            <a href="{{ route('asesor.monitoring') }}"
               class="inline-flex items-center gap-2 text-sm theme-muted hover:theme-title transition mb-4">

                <i class="fas fa-arrow-left"></i>

                Kembali ke Monitoring

            </a>

            <h1 class="text-3xl font-bold theme-title tracking-tight">
                Detail Monitoring
            </h1>

            <p class="text-sm theme-muted mt-2">
                Monitoring hasil penilaian Pemerintah Digital pada instansi
            </p>

        </div>


        {{-- STATUS --}}
        <div>

            @if(($instansi->status ?? '') === 'Selesai')

                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                             bg-green-100 text-green-700 text-sm font-semibold">

                    <span class="w-2 h-2 rounded-full bg-green-500"></span>

                    Selesai

                </span>

            @elseif(($instansi->jumlah_terisi ?? 0) > 0)

                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                             bg-yellow-100 text-yellow-700 text-sm font-semibold">

                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>

                    Sedang Berlangsung

                </span>

            @else

                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                             bg-gray-100 text-gray-600 text-sm font-semibold">

                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>

                    Belum Dimulai

                </span>

            @endif

        </div>

    </div>



    {{-- =========================================================
        INFORMASI INSTANSI
    ========================================================== --}}
    <div class="theme-card rounded-2xl border theme-border overflow-hidden">

        <div class="p-6">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                {{-- IDENTITAS INSTANSI --}}
                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-2xl bg-gray-100
                                flex items-center justify-center flex-shrink-0">

                        <i class="fas fa-building text-2xl text-gray-500"></i>

                    </div>


                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider theme-muted mb-1">
                            Instansi Pemerintah
                        </p>

                        <h2 class="text-2xl font-bold theme-title">
                            {{ $instansi->nama_instansi }}
                        </h2>

                        <p class="text-sm theme-muted mt-1">
                            Monitoring Penilaian Pemerintah Digital
                        </p>

                    </div>

                </div>


                {{-- INDEKS PM --}}
                <div class="lg:text-right">

                    <p class="text-sm theme-muted mb-1">
                        Indeks PM
                    </p>

                    <div class="flex items-baseline lg:justify-end gap-2">

                        <span class="text-4xl font-bold theme-title">

                            @if(!is_null($instansi->indeks_pm))

                                {{ number_format($instansi->indeks_pm, 2, ',', '.') }}

                            @else

                                -

                            @endif

                        </span>

                        <span class="text-sm theme-muted">
                            / 5,00
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- PROGRESS KESELURUHAN --}}
        <div class="border-t theme-border px-6 py-5">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">

                <div>

                    <p class="text-sm font-semibold theme-title">
                        Progress Penilaian
                    </p>

                    <p class="text-xs theme-muted mt-1">
                        Berdasarkan indikator yang telah memiliki bukti disetujui
                    </p>

                </div>


                <p class="text-sm font-semibold theme-title">

                    {{ $instansi->jumlah_terisi ?? 0 }}

                    dari

                    {{ $instansi->jumlah_indikator ?? 0 }}

                    indikator

                </p>

            </div>


            @php

                $totalIndikator = $instansi->jumlah_indikator ?? 0;

                $jumlahTerisi = $instansi->jumlah_terisi ?? 0;

                $progress = $totalIndikator > 0
                    ? round(($jumlahTerisi / $totalIndikator) * 100)
                    : 0;

            @endphp


            <div class="w-full h-2.5 bg-gray-200 rounded-full overflow-hidden">

                <div
                    class="h-full rounded-full bg-blue-600 transition-all duration-500"
                    style="width: {{ $progress }}%">
                </div>

            </div>


            <div class="flex justify-between mt-2">

                <span class="text-xs theme-muted">
                    0%
                </span>

                <span class="text-xs font-semibold theme-title">
                    {{ $progress }}%
                </span>

            </div>

        </div>

    </div>



    {{-- =========================================================
        RINGKASAN
    ========================================================== --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- TOTAL INDIKATOR --}}
        <div class="theme-card rounded-2xl border theme-border p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm theme-muted">
                        Total Indikator
                    </p>

                    <p class="text-3xl font-bold theme-title mt-2">
                        {{ $instansi->jumlah_indikator ?? 0 }}
                    </p>

                </div>


                <div class="w-11 h-11 rounded-xl bg-blue-50
                            flex items-center justify-center">

                    <i class="fas fa-list-check text-blue-600"></i>

                </div>

            </div>

        </div>


        {{-- INDIKATOR DINILAI --}}
        <div class="theme-card rounded-2xl border theme-border p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm theme-muted">
                        Indikator Dinilai
                    </p>

                    <p class="text-3xl font-bold theme-title mt-2">
                        {{ $instansi->jumlah_terisi ?? 0 }}
                    </p>

                </div>


                <div class="w-11 h-11 rounded-xl bg-green-50
                            flex items-center justify-center">

                    <i class="fas fa-circle-check text-green-600"></i>

                </div>

            </div>

        </div>


        {{-- BELUM DINILAI --}}
        <div class="theme-card rounded-2xl border theme-border p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm theme-muted">
                        Belum Dinilai
                    </p>

                    <p class="text-3xl font-bold theme-title mt-2">

                        {{ max(
                            0,
                            ($instansi->jumlah_indikator ?? 0)
                            - ($instansi->jumlah_terisi ?? 0)
                        ) }}

                    </p>

                </div>


                <div class="w-11 h-11 rounded-xl bg-gray-100
                            flex items-center justify-center">

                    <i class="fas fa-hourglass-half text-gray-500"></i>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
        PENILAIAN PER ASPEK
    ========================================================== --}}
    <div class="theme-card rounded-2xl border theme-border p-6">

        <div class="mb-6">

            <h2 class="text-xl font-bold theme-title">
                Penilaian Per Aspek
            </h2>

            <p class="text-sm theme-muted mt-1">
                Ringkasan indikator dan data dukung pada setiap aspek penilaian
            </p>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

            @forelse($aspek as $item)

                @php

                    $totalIndikatorAspek = $item['total'] ?? 0;

                    $indikatorTerisi = $item['terisi'] ?? 0;

                    $progressIndikator = $totalIndikatorAspek > 0
                        ? round(
                            ($indikatorTerisi / $totalIndikatorAspek) * 100
                        )
                        : 0;


                    $totalDataDukung = $item['total_data_dukung'] ?? 0;

                    $dataDukungTerisi = $item['data_dukung_terverifikasi'] ?? 0;

                    $progressDataDukung = $item['progres_data_dukung'] ?? 0;

                @endphp


                <div class="border theme-border rounded-xl p-5">

                    {{-- HEADER ASPEK --}}
                    <div class="flex items-start justify-between gap-4">

                        <div class="min-w-0">

                            <p class="text-xs font-semibold uppercase tracking-wider theme-muted mb-1">
                                Aspek Penilaian
                            </p>

                            <h3 class="font-semibold theme-title leading-snug">
                                {{ $item['nama'] }}
                            </h3>

                        </div>


                        {{-- JUMLAH INDIKATOR --}}
                        <div class="text-right flex-shrink-0">

                            <p class="text-xl font-bold theme-title">
                                {{ $indikatorTerisi }}/{{ $totalIndikatorAspek }}
                            </p>

                            <p class="text-xs theme-muted">
                                indikator
                            </p>

                        </div>

                    </div>



                    {{-- =================================================
                        PROGRESS INDIKATOR
                    ================================================== --}}
                    <div class="mt-5">

                        <div class="flex items-center justify-between mb-2">

                            <span class="text-xs theme-muted">
                                Indikator Dinilai
                            </span>

                            <span class="text-xs font-semibold theme-title">

                                {{ $indikatorTerisi }}
                                /
                                {{ $totalIndikatorAspek }}

                            </span>

                        </div>


                        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">

                            <div
                                class="h-full rounded-full bg-blue-500"
                                style="width: {{ $progressIndikator }}%">
                            </div>

                        </div>


                        <p class="text-xs theme-muted mt-2">
                            {{ $progressIndikator }}% indikator telah dinilai
                        </p>

                    </div>



                    {{-- =================================================
                        DATA DUKUNG
                    ================================================== --}}
                    <div class="mt-5 pt-4 border-t theme-border">

                        <div class="flex items-center justify-between mb-2">

                            <span class="text-xs theme-muted">
                                Data Dukung Diverifikasi
                            </span>

                            <span class="text-xs font-semibold theme-title">

                                {{ $dataDukungTerisi }}
                                /
                                {{ $totalDataDukung }}

                            </span>

                        </div>


                        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">

                            <div
                                class="h-full rounded-full bg-green-500"
                                style="width: {{ $progressDataDukung }}%">
                            </div>

                        </div>


                        <p class="text-xs theme-muted mt-2">
                            {{ $progressDataDukung }}% data dukung telah diverifikasi
                        </p>

                    </div>

                </div>

            @empty

                <div class="md:col-span-2 xl:col-span-3 text-center py-10 theme-muted">

                    Belum terdapat data aspek penilaian.

                </div>

            @endforelse

        </div>

    </div>



    <!-- {{-- =========================================================
        DETAIL INDIKATOR
    ========================================================== --}}
    <div class="theme-card rounded-2xl border theme-border overflow-hidden">

        <div class="p-6 border-b theme-border">

            <h2 class="text-xl font-bold theme-title">
                Detail Indikator Penilaian
            </h2>

            <p class="text-sm theme-muted mt-1">
                Daftar indikator dan hasil penilaian instansi
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>

                    <tr class="border-b theme-border">

                        <th class="text-left py-4 px-5 theme-muted font-semibold whitespace-nowrap">
                            No
                        </th>

                        <th class="text-left py-4 px-5 theme-muted font-semibold min-w-[280px]">
                            Indikator
                        </th>

                        <th class="text-left py-4 px-5 theme-muted font-semibold min-w-[180px]">
                            Aspek
                        </th>

                        <th class="text-center py-4 px-5 theme-muted font-semibold whitespace-nowrap">
                            Status
                        </th>

                        <th class="text-center py-4 px-5 theme-muted font-semibold whitespace-nowrap">
                            Nilai
                        </th>

                        <th class="text-center py-4 px-5 theme-muted font-semibold min-w-[180px]">
                            Tingkat Kematangan
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($indikator as $item)

                        <tr class="border-b theme-border last:border-b-0 hover:bg-gray-50 transition">

                            {{-- NO --}}
                            <td class="py-4 px-5 theme-title font-medium">
                                {{ $item['no'] }}
                            </td>


                            {{-- INDIKATOR --}}
                            <td class="py-4 px-5">

                                <p class="font-medium theme-title leading-relaxed">
                                    {{ $item['nama'] }}
                                </p>

                            </td>


                            {{-- ASPEK --}}
                            <td class="py-4 px-5 theme-muted">

                                {{ $item['aspek'] }}

                            </td>


                            {{-- STATUS --}}
                            <td class="py-4 px-5 text-center">

                                @if($item['status'] === 'TERKIRIM')

                                    <span class="inline-flex items-center gap-1.5
                                                 px-3 py-1.5 rounded-full
                                                 text-xs font-semibold
                                                 bg-blue-100 text-blue-700">

                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                                        Terkirim

                                    </span>

                                @elseif($item['status'] === 'DISETUJUI' || $item['status'] === 'DIVERIFIKASI')

                                    <span class="inline-flex items-center gap-1.5
                                                 px-3 py-1.5 rounded-full
                                                 text-xs font-semibold
                                                 bg-green-100 text-green-700">

                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                        Diverifikasi

                                    </span>

                                @elseif($item['status'] === 'PERLU_PERBAIKAN')

                                    <span class="inline-flex items-center gap-1.5
                                                 px-3 py-1.5 rounded-full
                                                 text-xs font-semibold
                                                 bg-red-100 text-red-700">

                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                        Perlu Perbaikan

                                    </span>

                                @elseif($item['status'] === 'DRAFT')

                                    <span class="inline-flex items-center gap-1.5
                                                 px-3 py-1.5 rounded-full
                                                 text-xs font-semibold
                                                 bg-yellow-100 text-yellow-700">

                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>

                                        Draft

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5
                                                 px-3 py-1.5 rounded-full
                                                 text-xs font-semibold
                                                 bg-gray-100 text-gray-600">

                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>

                                        Belum Diisi

                                    </span>

                                @endif

                            </td>


                            {{-- NILAI --}}
                            <td class="py-4 px-5 text-center">

                                @if(isset($item['nilai']) && $item['nilai'] !== null)

                                    <span class="font-bold theme-title">

                                        {{ number_format($item['nilai'], 2, ',', '.') }}

                                    </span>

                                @else

                                    <span class="theme-muted">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- TINGKAT KEMATANGAN --}}
                            <td class="py-4 px-5 text-center">

                                @if(!empty($item['tingkat']))

                                    <span class="font-medium theme-title">
                                        {{ $item['tingkat'] }}
                                    </span>

                                @else

                                    <span class="theme-muted">
                                        -
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="py-12 text-center theme-muted">

                                <div class="flex flex-col items-center">

                                    <i class="fas fa-clipboard-list text-3xl mb-3 opacity-40"></i>

                                    <p>
                                        Belum terdapat data indikator.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div> -->

@endsection