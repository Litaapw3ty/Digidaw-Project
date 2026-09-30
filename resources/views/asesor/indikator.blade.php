@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full space-y-6">

    {{-- Header --}}
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold theme-title tracking-tight">
                Penilaian Mandiri Pemerintah Digital
            </h1>
            <p class="text-base theme-muted mt-1">
                Dashboard evaluasi dan pengukuran tingkat kematangan digital instansi.
            </p>
        </div>

        {{-- Tombol Kembali --}}
        <a href="{{ route('asesor.verifikasi') }}"
           class="shrink-0 inline-flex items-center justify-center px-5 py-2.5 text-base font-medium text-rose-500 border border-rose-400 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors">
            Kembali
        </a>
    </div>

    {{-- Informasi Instansi --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Detail Instansi --}}
        <div class="lg:col-span-2 theme-card border theme-border rounded-xl shadow-sm px-8 py-5">
            <div class="grid grid-cols-12 gap-y-3 text-base">
                <span class="col-span-3 font-semibold theme-title">Kode</span>
                <span class="col-span-1 text-center theme-muted">:</span>
                <span class="col-span-8 theme-text">{{ $instansi->kode_instansi ?? '-' }}</span>

                <span class="col-span-3 font-semibold theme-title">Nama Instansi</span>
                <span class="col-span-1 text-center theme-muted">:</span>
                <span class="col-span-8 theme-title font-semibold">{{ $instansi->nama_instansi ?? '-' }}</span>

                <span class="col-span-3 font-semibold theme-title">Status</span>
                <span class="col-span-1 text-center theme-muted">:</span>
                <span class="col-span-8 theme-text">{{ $instansi->status ?? '-' }}</span>
            </div>
        </div>

        {{-- Indeks PM Card (Dinamis) --}}
        <div class="relative overflow-hidden bg-[#12a89d] rounded-xl text-white px-6 py-5 shadow-sm">
            <div class="absolute -right-5 -top-5 w-24 h-24 bg-white/10 rotate-45"></div>
            <div class="relative z-10 flex items-center gap-5 h-full">
                <div class="w-14 h-14 rounded-full border-2 border-white flex items-center justify-center shrink-0 bg-white/10">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="8" stroke-width="1.8"/>
                        <circle cx="12" cy="12" r="3" stroke-width="1.8"/>
                    </svg>
                </div>
                <div>
                    <p class="text-base font-medium opacity-90">Indeks PM</p>
                    <p class="text-4xl font-bold leading-none mt-1">{{ $indeks_pm }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Judul Aspek --}}
    <div>
        <h2 class="text-xl font-bold theme-title">
            Aspek Penilaian
        </h2>
    </div>

    {{-- Semua Aspek --}}
    <div class="space-y-6">
        @foreach ($aspek as $item)
            <div class="theme-card border theme-border rounded-xl overflow-hidden shadow-sm">

                {{-- Header Aspek --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-4 py-3 bg-[#59d1ce] text-white">
                    <div class="flex items-center gap-2 text-base">
                        <span class="font-bold">{{ $item['no'] }}</span>
                        <span class="font-normal">{{ $item['nama'] }}</span>
                    </div>

                    <div class="flex items-center gap-3 shrink-0">
                        <span class="px-3.5 py-1 rounded-full bg-white/50 text-[#247c7b] text-sm font-semibold">
                            Bobot : {{ $item['bobot'] }}
                        </span>
                        <span class="px-3.5 py-1 rounded-full bg-white/50 text-[#247c7b] text-sm font-semibold">
                            Progres : {{ $item['progres'] }}
                        </span>
                    </div>
                </div>

                {{-- Table Penilaian --}}
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[950px] border-collapse theme-table">
                        <tbody class="divide-y theme-border">
                            @foreach ($item['items'] as $data)
                                <tr class="theme-table-row transition-colors">

                                    {{-- Nomor --}}
                                    <td class="w-[50px] border-r theme-border px-3 py-3.5 text-center text-base theme-muted font-medium">
                                        {{ $data['no'] }}
                                    </td>

                                    {{-- Nama Indikator --}}
                                    <td class="w-[38%] border-r theme-border px-4 py-3.5 text-base theme-title">
                                        {{ $data['nama'] }}
                                    </td>

                                    {{-- Tipe Badge --}}
                                    <td class="w-[100px] border-r theme-border px-3 text-center">
                                        @if ($data['tipe'] === 'INTERNAL')
                                            <span class="inline-flex px-3 py-1 rounded-full bg-[#fff0c7] text-[#d99b00] text-xs font-bold">
                                                Internal
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 rounded-full bg-[#d8f5f4] text-[#149c99] text-xs font-bold">
                                                Eksternal
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Bobot --}}
                                    <td class="w-[100px] border-r theme-border px-3 text-center text-sm theme-muted">
                                        Bobot {{ $data['bobot'] }}
                                    </td>

                                    {{-- Progress Bar / PI --}}
                                    <td class="w-[240px] border-r theme-border px-4 py-3">
                                        @if (isset($data['pi']) && $data['pi'] !== null)
                                            <div class="text-center text-sm font-medium theme-muted">
                                                {{ $data['pi'] }}
                                            </div>
                                        @else
                                            <div class="w-full">
                                                <div class="relative h-4 w-full rounded-full border theme-border theme-card overflow-hidden shadow-inner">
                                                    <div class="h-full rounded-full transition-all duration-300 {{ $data['progress'] == 100 ?  'bg-emerald-600' : 'bg-[#185798]' }}"
                                                         style="width: {{ $data['progress'] }}%">
                                                    </div>
                                                    <span class="absolute inset-0 flex items-center justify-center text-[10px] font-bold text-dark dark:text-gray-200">
                                                        {{ $data['progress'] }}%
                                                    </span>
                                                </div>
                                                <div class="mt-1.5 text-right text-xs font-medium theme-muted">
                                                    {{ $data['data'] }}
                                                </div>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Tombol Lihat --}}
                                    <td class="w-[90px] px-3 text-center">
                                        <a href="{{ route('asesor.verifikasi.show', ['id_instansi' => $instansi->id_instansi, 'no_indikator' => $data['no']]) }}" 
                                           class="inline-flex items-center justify-center min-w-[65px] h-8 px-3.5 rounded-md border border-[#59c9c8] theme-card text-[#159b99] theme-hover text-xs font-medium transition-colors">
                                            Lihat
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @endforeach
    </div>
</div>

@endsection