@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full space-y-6">

    {{-- Header --}}
    <div class="flex items-start justify-between gap-4">
        <div>
            <a href="{{ route('asesor.monitoring') }}"
               class="inline-flex items-center gap-2 theme-muted hover:theme-title mb-3">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Monitoring
            </a>

            <h1 class="text-3xl font-bold theme-title tracking-tight">
                Detail Monitoring Penilaian
            </h1>

            <p class="text-base theme-muted mt-1">
                Monitoring hasil penilaian instansi pemerintah
            </p>
        </div>
    </div>


    {{-- Hero Instansi --}}
    <div class="theme-card rounded-2xl border theme-border p-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            {{-- Informasi Instansi --}}
            <div class="flex items-center gap-5">

                <div class="w-16 h-16 rounded-xl bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-building text-2xl text-gray-500"></i>
                </div>

                <div>

                    <h2 class="text-2xl font-bold theme-title">
                        {{ $instansi->nama_instansi }}
                    </h2>

                    <p class="theme-muted mt-1">
                        Monitoring Penilaian Pemerintah Digital
                    </p>

                    <div class="mt-3">

                        @if(($instansi->status ?? '') === 'Selesai')

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                                Selesai
                            </span>

                        @elseif(($instansi->jumlah_terisi ?? 0) > 0)

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">
                                Sedang Berlangsung
                            </span>

                        @else

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                Belum Dimulai
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Ringkasan --}}
            <div class="flex flex-wrap gap-8">

                {{-- Indikator --}}
                <div>

                    <p class="text-sm theme-muted mb-1">
                        Indikator Dinilai
                    </p>

                    <p class="text-2xl font-bold theme-title">

                        {{ $instansi->jumlah_terisi ?? 0 }}

                        <span class="text-base font-normal theme-muted">
                            / {{ $instansi->jumlah_indikator ?? 0 }}
                        </span>

                    </p>

                </div>


                {{-- Indeks PM --}}
                <div>

                    <p class="text-sm theme-muted mb-1">
                        Indeks PM
                    </p>

                    <p class="text-2xl font-bold theme-title">

                        @if(!is_null($instansi->indeks_pm))

                            {{ number_format($instansi->indeks_pm, 2, ',', '.') }}

                        @else

                            -

                        @endif

                    </p>

                </div>

            </div>

        </div>

    </div>



    {{-- Ringkasan Per Aspek --}}
    <div class="theme-card rounded-2xl border theme-border p-6">

        <div class="mb-6">

            <h2 class="text-xl font-bold theme-title">
                Penilaian Per Aspek
            </h2>

            <p class="text-sm theme-muted mt-1">
                Jumlah indikator yang telah memiliki nilai pada setiap aspek
            </p>

        </div>


        <div class="space-y-4">

            @forelse($aspek as $item)

                <div class="border theme-border rounded-xl p-4">

                    <div class="flex items-center justify-between gap-4">

                        <div>

                            <h3 class="font-semibold theme-title">
                                {{ $item['nama'] }}
                            </h3>

                            <p class="text-sm theme-muted mt-1">
                                {{ $item['terisi'] }}
                                dari
                                {{ $item['total'] }}
                                indikator telah dinilai
                            </p>

                        </div>


                        <div class="text-right">

                            <p class="text-2xl font-bold theme-title">

                                {{ $item['terisi'] }}

                                <span class="text-sm font-normal theme-muted">
                                    / {{ $item['total'] }}
                                </span>

                            </p>

                            <p class="text-xs theme-muted">
                                Indikator Dinilai
                            </p>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-10 theme-muted">

                    Belum terdapat data aspek penilaian.

                </div>

            @endforelse

        </div>

    </div>



    {{-- Detail Indikator --}}
    <div class="theme-card rounded-2xl border theme-border p-6">

        <div class="mb-6">

            <h2 class="text-xl font-bold theme-title">
                Detail Indikator Penilaian
            </h2>

            <p class="text-sm theme-muted mt-1">
                Daftar indikator dan nilai hasil penilaian instansi
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>

                    <tr class="border-b theme-border">

                        <th class="text-left py-3 px-4 theme-muted font-semibold">
                            No
                        </th>

                        <th class="text-left py-3 px-4 theme-muted font-semibold">
                            Indikator
                        </th>

                        <th class="text-left py-3 px-4 theme-muted font-semibold">
                            Aspek
                        </th>

                        <th class="text-center py-3 px-4 theme-muted font-semibold">
                            Status
                        </th>

                        <th class="text-center py-3 px-4 theme-muted font-semibold">
                            Nilai
                        </th>

                        <th class="text-center py-3 px-4 theme-muted font-semibold">
                            Tingkat Kematangan
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($indikator as $item)

                        <tr class="border-b theme-border">

                            {{-- No --}}
                            <td class="py-4 px-4 theme-title">
                                {{ $item['no'] }}
                            </td>


                            {{-- Nama Indikator --}}
                            <td class="py-4 px-4 theme-title">
                                {{ $item['nama'] }}
                            </td>


                            {{-- Aspek --}}
                            <td class="py-4 px-4 theme-muted">
                                {{ $item['aspek'] }}
                            </td>


                            {{-- Status --}}
                            <td class="py-4 px-4 text-center">

                                @if($item['status'] === 'TERKIRIM')

                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        Terkirim
                                    </span>

                                @elseif($item['status'] === 'DIVERIFIKASI')

                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        Diverifikasi
                                    </span>

                                @elseif($item['status'] === 'PERLU_PERBAIKAN')

                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                        Perlu Perbaikan
                                    </span>

                                @elseif($item['status'] === 'DRAFT')

                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                        Draft
                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        Belum Diisi
                                    </span>

                                @endif

                            </td>


                            {{-- Nilai --}}
                            <td class="py-4 px-4 text-center font-semibold theme-title">

                                @if(isset($item['nilai']) && $item['nilai'] !== null)

                                    {{ number_format($item['nilai'], 2, ',', '.') }}

                                @else

                                    -

                                @endif

                            </td>


                            {{-- Tingkat Kematangan --}}
                            <td class="py-4 px-4 text-center theme-title">

                                {{ $item['tingkat'] ?? '-' }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="py-10 text-center theme-muted">

                                Belum terdapat data indikator.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection