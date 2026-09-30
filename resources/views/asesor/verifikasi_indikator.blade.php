@extends('layouts.sidebar.sidebar-asesor')

@section('content')
<style>
    .verifikasi-indikator-page {
        --indicator-surface: #ffffff;
        --indicator-subtle-surface: #f8fafc;
        --indicator-table-head: #f1f5f9;
        --indicator-text: #1f2937;
        --indicator-muted: #6b7280;
        --indicator-border: rgba(15, 23, 42, 0.06);
        color: var(--indicator-text);
    }

    body.dark-mode .verifikasi-indikator-page {
        --indicator-surface: #1f2937;
        --indicator-subtle-surface: #172131;
        --indicator-table-head: #263244;
        --indicator-text: #f3f4f6;
        --indicator-muted: #9ca3af;
        --indicator-border: rgba(255, 255, 255, 0.05);
    }

    .verifikasi-indikator-page .theme-border {
        border-color: var(--indicator-border) !important;
    }

    .verifikasi-indikator-page .bg-white {
        background-color: var(--indicator-surface) !important;
    }

    .verifikasi-indikator-page .bg-gray-50 {
        background-color: var(--indicator-subtle-surface) !important;
    }

    .verifikasi-indikator-page .bg-gray-100 {
        background-color: var(--indicator-table-head) !important;
    }

    .verifikasi-indikator-page .text-gray-900,
    .verifikasi-indikator-page .text-gray-800,
    .verifikasi-indikator-page .text-gray-700,
    .verifikasi-indikator-page .text-gray-600 {
        color: var(--indicator-text) !important;
    }

    .verifikasi-indikator-page .text-gray-500,
    .verifikasi-indikator-page .text-gray-400 {
        color: var(--indicator-muted) !important;
    }

    .verifikasi-indikator-page table {
        border-color: var(--indicator-border) !important;
    }

    .verifikasi-indikator-page table th,
    .verifikasi-indikator-page table td,
    .verifikasi-indikator-page table tr,
    .verifikasi-indikator-page tbody.divide-y > :not([hidden]) ~ :not([hidden]) {
        border-color: var(--indicator-border) !important;
        border-width: 1px !important;
    }

    .verifikasi-indikator-page .hover\:bg-gray-50\/50:hover {
        background-color: rgba(15, 23, 42, 0.025) !important;
    }

    body.dark-mode .verifikasi-indikator-page .hover\:bg-gray-50\/50:hover {
        background-color: rgba(255, 255, 255, 0.025) !important;
    }
</style>

<div class="verifikasi-indikator-page w-full space-y-6"
    x-data="{ activeTab: {{ $tingkatKematangan->first()->level ?? 1 }} }"
    x-cloak>

    <!-- {{-- Breadcrumb & Tombol Kembali --}}
    <div class="flex items-center justify-between gap-4">
        <nav class="flex text-sm font-medium text-gray-500 gap-2 items-center">
            <a href="#" class="hover:text-teal-600">Penilaian</a>
            <span>&rsaquo;</span>
            <a href="{{ route('asesor.verifikasi') }}" class="hover:text-teal-600">Penilaian Mandiri</a>
            <span>&rsaquo;</span>
            <span class="text-gray-800 font-semibold">Indikator Penilaian Mandiri</span>
        </nav>

        <a href="{{ route('asesor.verifikasi.show', ['id_instansi' => $instansi->id_instansi, 'no_indikator' => $indikator->nomor_indikator]) }}"
           class="inline-flex items-center justify-center px-5 py-2 text-sm font-medium text-rose-500 border border-rose-400 rounded-lg hover:bg-rose-50 transition-colors">
            Kembali
        </a>
    </div> -->

    {{-- Badge Aspek --}}
    <div>
        <span class="inline-block px-4 py-1.5 rounded-full bg-[#fef3c7] text-[#92400e] font-semibold text-xs tracking-wide">
            Aspek {{ $indikator->nomor_aspek }}: {{ $indikator->nama_aspek }}
        </span>
    </div>

    {{-- Judul Indikator --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
            {{ $indikator->nomor_indikator }}. {{ $indikator->nama_indikator }}
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Detail Indikator yang digunakan dalam penilaian mandiri pemerintah digital
        </p>
    </div>

    {{-- Kartu Informasi Indikator --}}
    <div class="bg-white border theme-border rounded-xl p-6 shadow-sm space-y-4">
        <h3 class="text-base font-bold text-gray-800">Informasi Indikator</h3>
        <div class="border-t theme-border pt-4 text-sm space-y-2.5">
            <div class="grid grid-cols-12 gap-2">
                <span class="col-span-2 font-medium text-gray-600">Kode</span>
                <span class="col-span-1 text-center text-gray-400">:</span>
                <span class="col-span-9 text-gray-800 font-medium">{{ $instansi->kode_instansi ?? '-' }}</span>
            </div>
            <div class="grid grid-cols-12 gap-2">
                <span class="col-span-2 font-medium text-gray-600">Nama Instansi</span>
                <span class="col-span-1 text-center text-gray-400">:</span>
                <span class="col-span-9 text-gray-800 font-bold">{{ $instansi->nama_instansi ?? '-' }}</span>
            </div>
            <div class="grid grid-cols-12 gap-2">
                <span class="col-span-2 font-medium text-gray-600">Kategori</span>
                <span class="col-span-1 text-center text-gray-400">:</span>
                <span class="col-span-9 text-gray-800">{{ $instansi->kategori ?? '-' }}</span>
            </div>
        </div>

        <div class="border-t theme-border pt-4 text-sm">
            <div class="grid grid-cols-12 gap-2">
                <span class="col-span-2 font-medium text-gray-600">Deskripsi</span>
                <span class="col-span-1 text-center text-gray-400">:</span>
                <span class="col-span-9 text-gray-700 leading-relaxed">
                    Tata kelola Pemdi adalah kerangka kerja yang memastikan terlaksananya perencanaan, pelaksanaan, dan pengendalian dalam penerapan Pemdi secara terpadu.<br>
                    Tata Kelola Pemdi terdiri dari:
                    <ol class="list-decimal list-inside mt-2 space-y-1 text-gray-700">
                        <li>Rencana Aksi Nasional Pemdi, sebagai referensi Rencana Aksi pada Instansi Pemerintah; dan</li>
                        <li>Arsitektur Pemdi Instansi Pemerintah untuk transformasi tata kelola Pemdi untuk pembangunan nasional.</li>
                    </ol>
                </span>
            </div>
        </div>
    </div>

    {{-- Kartu Rekomendasi Indikator & Tab Tingkat Kematangan --}}
    <div class="bg-white border theme-border rounded-xl p-6 shadow-sm space-y-6">
        <h3 class="text-base font-bold text-gray-800">Rekomendasi Indikator</h3>

        {{-- Tab Header --}}
        <div class="flex overflow-x-auto border-b theme-border space-x-8 text-sm font-medium">
            @foreach ($tingkatKematangan as $tk)
                @php
                    $group = $dataDukungGroup[$tk->level] ?? ['label' => '', 'total_terisi' => 0, 'total_item' => 0];
                @endphp
                <button 
                    @click="activeTab = {{ $tk->level }}"
                    :aria-selected="activeTab === {{ $tk->level }}"
                    type="button"
                    :class="activeTab === {{ $tk->level }} ? 'text-teal-600 border-b-2 border-teal-500 font-bold pb-3' : 'text-gray-500 hover:text-gray-700 pb-3'"
                    class="whitespace-nowrap transition-colors">
                    {{ $group['label'] }} ({{ $group['total_terisi'] }}/{{ $group['total_item'] }})
                </button>
            @endforeach
        </div>

        {{-- Tab Body per Level --}}
        @foreach ($tingkatKematangan as $tk)
            @php
                $group = $dataDukungGroup[$tk->level] ?? ['pm_score' => '0.0 / 0.0', 'items' => []];
            @endphp

            <div x-show="activeTab === {{ $tk->level }}" x-cloak class="space-y-4">
                
                {{-- Score PM & Detail --}}
                <div class="flex justify-end items-center gap-3">
                    <span class="text-sm font-bold text-gray-800">PM : <span class="text-teal-600">{{ $group['pm_score'] }}</span></span>
                    <button class="inline-flex items-center gap-1.5 px-3 py-1.5 border border-teal-400 text-teal-600 text-xs font-medium rounded-md hover:bg-teal-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Detail
                    </button>
                </div>

                {{-- Tabel Data Dukung --}}
                <div class="overflow-x-auto border theme-border rounded-lg">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead class="bg-gray-100 text-gray-500 font-bold uppercase tracking-wider border-b theme-border">
                            <tr>
                                <th class="py-3 px-3 w-[50px] text-center border-r theme-border">NO</th>
                                <th class="py-3 px-4 border-r theme-border w-[35%]">DATA DUKUNG</th>
                                <th class="py-3 px-4 border-r theme-border w-[220px]">TEMPLATE DOKUMEN</th>
                                <th class="py-3 px-3 border-r theme-border w-[100px] text-center">PANDUAN</th>
                                <th class="py-3 px-3 border-r theme-border w-[110px] text-center">STATUS</th>
                                <th class="py-3 px-3 border-r theme-border w-[70px] text-center">VALUE</th>
                                <th class="py-3 px-3 w-[90px] text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y theme-border text-gray-700">
                            @forelse ($group['items'] as $item)
                                <tr class="hover:bg-gray-50/50">
                                    <td class="py-3.5 px-3 text-center align-middle font-medium border-r theme-border">{{ $item['nomor'] }}</td>
                                    <td class="py-3.5 px-4 align-middle leading-relaxed border-r theme-border">
                                        {{ $item['nama'] }}
                                    </td>
                                    <td class="py-3.5 px-4 align-middle border-r theme-border">
                                        @if ($item['dokumen'])
                                            <div class="flex items-center gap-2 p-2 border theme-border rounded-md bg-gray-50">
                                                <svg class="w-5 h-5 text-gray-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                </svg>
                                                <div class="truncate text-[11px]">
                                                    <a href="{{ asset($item['dokumen']->file_path) }}" target="_blank" class="font-bold text-gray-800 hover:underline truncate block">
                                                        {{ $item['dokumen']->file_name }}
                                                    </a>
                                                    <span class="text-gray-400 text-[10px]">{{ round(($item['dokumen']->file_size ?? 45000) / 1024) }} KB</span>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-gray-400 italic text-[11px]">Belum ada file</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-3 text-center align-middle border-r theme-border">
                                        <a href="#" class="inline-flex items-center gap-1 text-[11px] text-teal-600 font-medium border border-teal-200 px-2.5 py-1 rounded bg-teal-50/50 hover:bg-teal-100">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            Panduan
                                        </a>
                                    </td>
                                    <td class="py-3.5 px-3 text-center align-middle border-r theme-border">
                                        @if ($item['status'] === 'PERLU_PERBAIKAN')
                                            <span class="inline-block px-2.5 py-1 text-[10px] font-bold rounded bg-rose-100 text-rose-500 border border-rose-200">Perlu Diperbaiki</span>
                                        @elseif($item['is_verified'])
                                            <span class="inline-block px-2.5 py-1 text-[10px] font-bold rounded bg-emerald-100 text-emerald-600 border border-emerald-200">Terverifikasi</span>
                                        @elseif($item['status'] === 'TERKIRIM')
                                            <span class="inline-block px-2.5 py-1 text-[10px] font-bold rounded bg-sky-100 text-sky-600 border border-sky-200">Terkirim</span>
                                        @else
                                            <span class="inline-block px-2.5 py-1 text-[10px] font-bold rounded bg-gray-100 text-gray-500">Belum Diisi</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-3 text-center align-middle font-medium border-r theme-border">{{ $item['bobot'] }}</td>
                                    <td class="py-3.5 px-3 text-center align-middle">
                                        @if ($item['is_verified'])
                                            <span class="inline-flex items-center gap-1 rounded bg-emerald-500 px-3 py-1 text-[11px] font-bold text-white shadow-sm">
                                                ✓ Sudah Terverifikasi
                                            </span>
                                        @elseif (!$item['dokumen'])
                                            <button type="button" disabled title="Dokumen belum dikirim" aria-disabled="true"
                                                    class="inline-flex cursor-not-allowed items-center gap-1 rounded bg-gray-300 px-3 py-1 text-[11px] font-bold text-gray-500 shadow-sm">
                                                Verifikasi
                                            </button>
                                        @else
                                            <a href="{{ route('asesor.verifikasi.detail.page', [
                                                'id_instansi' => $instansi->id_instansi,
                                                'no_indikator' => $indikator->nomor_indikator,
                                                'id_data_dukung' => $item['id_data_dukung']
                                            ]) }}"
                                               class="inline-flex items-center gap-1 rounded bg-amber-400 px-3 py-1 text-[11px] font-bold text-white shadow-sm transition-colors hover:bg-amber-500">
                                                Verifikasi
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                {{-- Baris Catatan Asesor --}}
                                @if ($item['dokumen'] && $item['dokumen']->catatan)
                                    <tr class="bg-rose-50/70 border-b theme-border">
                                        <td colspan="7" class="px-6 py-2.5">
                                            <div class="flex items-center justify-between text-xs text-rose-700">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-bold flex items-center gap-1 text-rose-600">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        Catatan Asesor
                                                    </span>
                                                    <span>{{ $item['dokumen']->catatan }}</span>
                                                </div>
                                                <span class="text-gray-400 text-[10px]">
                                                    {{ $item['dokumen']->nama_asesor ?? 'Asesor' }} - {{ $item['dokumen']->verified_at ? \Carbon\Carbon::parse($item['dokumen']->verified_at)->format('d M Y') : '' }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="7" class="py-6 text-center text-gray-400 italic">Tidak ada data dukung pada tingkat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        @endforeach
    </div>

</div>
@endsection