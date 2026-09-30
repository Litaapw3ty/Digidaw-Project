@extends('layouts.sidebar.sidebar-asesor')

@section('content')
<style>
    .verifikasi-detail-page {
        --detail-surface: #ffffff;
        --detail-subtle-surface: #f8fafc;
        --detail-preview-surface: rgba(241, 245, 249, 0.7);
        --detail-text: #1f2937;
        --detail-muted: #64748b;
        --detail-border: rgba(15, 23, 42, 0.06);
        color: var(--detail-text);
    }

    body.dark-mode .verifikasi-detail-page {
        --detail-surface: #1f2937;
        --detail-subtle-surface: #172131;
        --detail-preview-surface: rgba(23, 33, 49, 0.7);
        --detail-text: #f3f4f6;
        --detail-muted: #9ca3af;
        --detail-border: rgba(255, 255, 255, 0.05);
    }

    .verifikasi-detail-page .bg-white {
        background-color: var(--detail-surface) !important;
    }

    .verifikasi-detail-page .bg-slate-100\/70 {
        background-color: var(--detail-preview-surface) !important;
    }

    .verifikasi-detail-page .bg-slate-100 {
        background-color: var(--detail-subtle-surface) !important;
    }

    .verifikasi-detail-page [class*="border-slate-"] {
        border-color: var(--detail-border) !important;
    }

    .verifikasi-detail-page .text-slate-900,
    .verifikasi-detail-page .text-slate-800 {
        color: var(--detail-text) !important;
    }

    .verifikasi-detail-page .text-slate-700,
    .verifikasi-detail-page .text-slate-600,
    .verifikasi-detail-page .text-slate-500,
    .verifikasi-detail-page .text-slate-400 {
        color: var(--detail-muted) !important;
    }

    .verifikasi-detail-page textarea,
    .verifikasi-detail-page input {
        background-color: var(--detail-surface);
        border-color: var(--detail-border) !important;
        color: var(--detail-text);
    }

    .verifikasi-detail-page textarea::placeholder {
        color: var(--detail-muted);
    }

    body.dark-mode .verifikasi-detail-page .ring-white {
        --tw-ring-color: var(--detail-surface) !important;
    }
</style>

<div class="verifikasi-detail-page w-full max-w-[1500px] mx-auto space-y-6 p-4 lg:p-6 text-slate-800">

    {{-- TOMBOL KEMBALI (Mengarah ke detail indikator instansi) --}}
    <div>
        <a href="{{ route('asesor.verifikasi.indikator', ['id_instansi' => $id_instansi]) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-teal-600 transition hover:text-teal-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>

    {{-- HEADER JUDUL & BADGE --}}
    <div class="flex flex-wrap items-center gap-3">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Detail Verifikasi Bukti</h1>
        <span class="rounded-full px-3 py-1 text-xs font-medium border {{ $indikator->status_verifikasi === 'DISETUJUI' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-slate-100 text-slate-600 border-slate-200/60' }}">
            • {{ $indikator->status_verifikasi === 'DISETUJUI' ? 'Terverifikasi' : 'Menunggu Verifikasi' }}
        </span>
    </div>

    {{-- MAIN GRID 12 KOLOM (KIRI 7 : KANAN 5) --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 items-start">

        {{-- KOLOM KIRI (7 COLS): INFORMASI & PREVIEW DOKUMEN --}}
        <div class="space-y-6 lg:col-span-7">

            {{-- CARD 1: INFORMASI INDIKATOR --}}
            <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
                <div class="mb-5 flex items-center gap-2 text-teal-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h2 class="text-base font-semibold text-slate-900">Informasi Indikator</h2>
                </div>

                <div class="grid grid-cols-1 gap-3 text-sm">
                    <div class="grid grid-cols-12 gap-2">
                        <span class="col-span-4 text-slate-500 font-medium">Nama Instansi</span>
                        <span class="col-span-8 font-semibold text-slate-900">: {{ $instansi->nama_instansi ?? 'Pemerintah Prov. Jatim' }}</span>
                    </div>
                    <div class="grid grid-cols-12 gap-2">
                        <span class="col-span-4 text-slate-500 font-medium">Kode Indikator</span>
                        <span class="col-span-8 font-semibold text-slate-900">: {{ $no_indikator }}</span>
                    </div>
                    <div class="grid grid-cols-12 gap-2">
                        <span class="col-span-4 text-slate-500 font-medium">Aspek Penilaian</span>
                        <span class="col-span-8 font-semibold text-slate-900">: {{ $indikator->aspek ?? 'Tata Kelola dan Manajemen' }}</span>
                    </div>
                    <div class="grid grid-cols-12 gap-2">
                        <span class="col-span-4 text-slate-500 font-medium">Nama Indikator</span>
                        <span class="col-span-8 font-semibold text-teal-700 leading-snug">: {{ $indikator->nama_indikator ?? 'Tingkat Kematangan Kebijakan Internal Arsitektur SPBE' }}</span>
                    </div>
                </div>
            </div>

            {{-- CARD 2: PREVIEW DOKUMEN BUKTI --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200/80 bg-slate-100/70 p-4 shadow-sm space-y-4">
                
                {{-- FILE HEADER & UNDUH --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 rounded-xl bg-white p-4 border border-slate-200/60 shadow-xs">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-rose-50 text-rose-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="truncate text-sm font-semibold text-slate-900">{{ $dokumen->file_name ?? 'Belum ada dokumen' }}</h3>
                            @if ($dokumen)
                                <p class="text-xs text-slate-400 mt-0.5">
                                    {{ number_format(($dokumen->file_size ?? 0) / 1048576, 2) }} MB
                                    • Diunggah {{ date('d M Y H:i', strtotime($dokumen->created_at)) }}
                                </p>
                            @endif
                        </div>
                    </div>

                    @if($dokumen && $dokumen->file_exists)
                        <a href="{{ $dokumen->file_url }}" download class="inline-flex shrink-0 items-center justify-center gap-1.5 rounded-xl bg-teal-600 px-4 py-2 text-xs font-medium text-white transition hover:bg-teal-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Unduh
                        </a>
                    @endif
                </div>

                {{-- DOCUMENT VIEWER CANVAS --}}
                <div class="relative min-h-[500px] w-full rounded-xl border border-slate-200/80 bg-white p-8 shadow-inner flex flex-col justify-between overflow-hidden">
                    @if($dokumen && $dokumen->file_exists && Str::endsWith(Str::lower($dokumen->file_path), '.pdf'))
                        <iframe src="{{ $dokumen->file_url }}" class="w-full h-[500px] rounded-lg"></iframe>
                    @elseif($dokumen && $dokumen->file_exists)
                        <div class="flex h-full min-h-[420px] flex-col items-center justify-center gap-3 text-center">
                            <p class="text-sm text-slate-500">Pratinjau file ini belum tersedia.</p>
                            <a href="{{ $dokumen->file_url }}" target="_blank" class="inline-flex items-center gap-2 rounded-lg bg-teal-600 px-4 py-2 text-xs font-medium text-white transition hover:bg-teal-700">
                                Buka Dokumen
                            </a>
                        </div>
                    @elseif($dokumen)
                        <div class="flex h-full min-h-[420px] items-center justify-center text-center text-sm italic text-slate-400">
                            File dokumen belum tersedia di penyimpanan.
                        </div>
                    @else
                        <div class="flex h-full min-h-[420px] items-center justify-center text-sm italic text-slate-400">
                            Belum ada dokumen yang dikirim user.
                        </div>
                    @endif
                </div>

            </div>

        </div>

        {{-- KOLOM KANAN (5 COLS): PANEL VERIFIKASI & RIWAYAT AKTIVITAS --}}
        <div class="space-y-6 lg:col-span-5">

            {{-- CARD 1: PANEL VERIFIKASI --}}
            <form action="{{ route('asesor.verifikasi.verify', ['id_instansi' => $id_instansi, 'no_indikator' => $no_indikator, 'id_data_dukung' => $id_data_dukung]) }}" method="POST" class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm space-y-5">
                @csrf
                <div class="flex items-center gap-2 text-teal-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.038-.133-2.044-.382-3.016z"/>
                    </svg>
                    <h2 class="text-base font-semibold text-slate-900">Panel Verifikasi</h2>
                </div>

                {{-- RADIO OPTIONS --}}
                <div class="space-y-3">
                    <label class="group relative flex cursor-pointer items-start gap-3.5 rounded-xl border border-slate-200 p-4 transition hover:border-teal-500 has-[:checked]:border-teal-600 has-[:checked]:bg-teal-50/20">
                        <input type="radio" name="status_verifikasi" value="Disetujui" class="mt-0.5 h-4 w-4 text-teal-600 focus:ring-teal-500 border-slate-300" required>
                        <div>
                            <span class="block text-sm font-semibold text-slate-900">Disetujui</span>
                            <span class="block text-xs text-slate-500 mt-0.5">Bukti memenuhi persyaratan indikator.</span>
                        </div>
                    </label>

                    <label class="group relative flex cursor-pointer items-start gap-3.5 rounded-xl border border-slate-200 p-4 transition hover:border-teal-500 has-[:checked]:border-teal-600 has-[:checked]:bg-teal-50/20">
                        <input type="radio" name="status_verifikasi" value="Perlu Perbaikan" class="mt-0.5 h-4 w-4 text-teal-600 focus:ring-teal-500 border-slate-300" required>
                        <div>
                            <span class="block text-sm font-semibold text-slate-900">Perlu Perbaikan</span>
                            <span class="block text-xs text-slate-500 mt-0.5">Bukti kurang lengkap, perlu revisi.</span>
                        </div>
                    </label>
                </div>

                {{-- CATATAN --}}
                <div class="space-y-2">
                    <label for="catatan" class="block text-xs font-bold uppercase tracking-wider text-slate-500">Catatan Verifikasi</label>
                    <textarea id="catatan" name="catatan" rows="3" placeholder="Masukkan catatan atau alasan keputusan..." class="w-full rounded-xl border border-slate-200 p-3 text-sm focus:border-teal-500 focus:outline-none resize-none placeholder:text-slate-400"></textarea>
                </div>

                {{-- SUBMIT BUTTON --}}
                <div class="flex justify-end pt-2">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-teal-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700 focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Simpan Verifikasi
                    </button>
                </div>
            </form>

            {{-- CARD 2: RIWAYAT AKTIVITAS --}}
            <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm space-y-5">
                <h2 class="text-base font-semibold text-teal-700">Riwayat Aktivitas</h2>

                <div class="relative border-l-2 border-slate-200 ml-2.5 space-y-6 pl-5">
                    @forelse ($riwayatAktivitas ?? [] as $riwayat)
                        <div class="relative">
                            <span class="absolute -left-[27px] top-1 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-white ring-4 ring-white">
                                <span class="h-2.5 w-2.5 rounded-full bg-teal-700"></span>
                            </span>
                            <h3 class="text-sm font-bold text-slate-900">{{ $riwayat->judul }}</h3>
                            <p class="text-xs text-slate-400 mt-0.5">{{ $riwayat->created_at }}</p>
                            @if(isset($riwayat->oleh))
                                <p class="text-xs italic text-slate-500 mt-1">Oleh: {{ $riwayat->oleh }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="relative">
                            <span class="absolute -left-[27px] top-1 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-white ring-4 ring-white">
                                <span class="h-2.5 w-2.5 rounded-full bg-teal-700"></span>
                            </span>
                            <h3 class="text-sm font-bold text-slate-900">Tinjauan awal selesai</h3>
                            <p class="text-xs text-slate-400 mt-0.5">4 Ags 2026 09.10 WIB</p>
                        </div>
                        <div class="relative">
                            <span class="absolute -left-[27px] top-1 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-white ring-4 ring-white">
                                <span class="h-2.5 w-2.5 rounded-full bg-teal-700"></span>
                            </span>
                            <h3 class="text-sm font-bold text-slate-900">Dokumen Diunggah</h3>
                            <p class="text-xs text-slate-400 mt-0.5">4 Ags 2026 09.10 WIB</p>
                            <p class="text-xs italic text-slate-500 mt-1">Oleh: Admin Prov Jatim</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</div>
@endsection