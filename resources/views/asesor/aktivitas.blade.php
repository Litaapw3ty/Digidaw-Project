@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full max-w-[1500px] mx-auto space-y-5">

    {{-- HERO HEADER --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-teal-600 via-teal-500 to-cyan-500 p-8 text-white">
        <div class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-white/10"></div>
        <div class="absolute left-1/2 -bottom-10 h-32 w-32 rounded-full bg-white/10"></div>

        <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-medium text-teal-100">
                    Dashboard Asesor
                </p>
                <h1 class="mt-2 text-4xl font-bold tracking-tight">
                    Riwayat Aktivitas
                </h1>
                <p class="mt-3 max-w-xl text-teal-50">
                    Pantau seluruh rekam jejak verifikasi dan evaluasi yang telah Anda lakukan.
                </p>
            </div>

            <a href="{{ route('asesor.dashboard') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-white/15 px-5 py-3 text-sm font-medium backdrop-blur transition hover:bg-white/25">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Dashboard
            </a>
        </div>
    </div>

    {{-- QUICK STATS --}}
    <div class="grid gap-4 md:grid-cols-3">
        <div class="theme-card rounded-3xl border p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="rounded-2xl bg-teal-100 p-3 text-teal-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/>
                    </svg>
                </div>
                <div>
                    <p class="theme-muted text-sm">Total Aktivitas</p>
                    <p class="theme-title text-2xl font-bold">{{ $aktivitasList->total() }}</p>
                </div>
            </div>
        </div>

        <div class="theme-card rounded-3xl border p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="rounded-2xl bg-emerald-100 p-3 text-emerald-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="theme-muted text-sm">Halaman</p>
                    <p class="theme-title text-2xl font-bold">{{ $aktivitasList->currentPage() }}</p>
                </div>
            </div>
        </div>

        <div class="theme-card rounded-3xl border p-5 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="rounded-2xl bg-sky-100 p-3 text-sky-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 11h14M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="theme-muted text-sm">Hari Ini</p>
                    <p class="theme-title text-2xl font-bold">{{ now()->translatedFormat('d M') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CONTAINER: FILTER + TIMELINE IN 1 CARD --}}
    <div class="theme-card rounded-2xl border p-5 shadow-sm">

        {{-- FORM FILTER UTAMA --}}
        <form id="filter-form" method="GET" action="{{ route('asesor.aktivitas') }}" class="mb-6 flex flex-col gap-3 border-b pb-5 xl:flex-row xl:items-center xl:justify-between">

            {{-- HIDDEN INPUT UNTUK SORTING --}}
            <input type="hidden" name="sort" value="{{ request('sort', 'created_at') }}">
            <input type="hidden" name="direction" id="direction-input" value="{{ request('direction', 'desc') }}">

            {{-- FILTER KIRI (JENIS & TANGGAL) --}}
            <div class="flex flex-wrap items-center gap-2.5">
                {{-- SELECT JENIS AKTIVITAS --}}
                <select name="jenis" onchange="this.form.submit()" class="theme-input rounded-xl border px-3.5 py-2 text-xs font-medium cursor-pointer focus:ring-2 focus:ring-teal-500/20">
                    <option value="">Semua Jenis Aktivitas</option>
                    <option value="verifikasi" {{ request('jenis') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                    <option value="evaluasi" {{ request('jenis') == 'evaluasi' ? 'selected' : '' }}>Evaluasi</option>
                    <option value="upload" {{ request('jenis') == 'upload' ? 'selected' : '' }}>Upload</option>
                    <option value="catatan" {{ request('jenis') == 'catatan' ? 'selected' : '' }}>Catatan</option>
                </select>

                {{-- INPUT TANGGAL --}}
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" onchange="this.form.submit()" class="theme-input rounded-xl border px-3.5 py-2 text-xs font-medium cursor-pointer focus:ring-2 focus:ring-teal-500/20">

                {{-- TOMBOL RESET FILTER --}}
                @if(request('jenis') || request('tanggal') || request('q'))
                    <a href="{{ route('asesor.aktivitas') }}" class="inline-flex items-center gap-1 text-xs text-rose-500 hover:text-rose-700 font-medium px-2 py-1 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Reset Filter
                    </a>
                @endif
            </div>

            {{-- SORT + SEARCH (KANAN) --}}
            <div class="flex flex-col gap-2.5 sm:flex-row sm:items-center">
                @php
                    $currentDir = request('direction', 'desc');
                    $nextDir = $currentDir === 'asc' ? 'desc' : 'asc';
                @endphp

                {{-- TOMBOL TOGGLE URUTAN TANGGAL --}}
                <button type="button" 
                        onclick="document.getElementById('direction-input').value='{{ $nextDir }}'; this.form.submit();"
                        class="inline-flex items-center justify-center gap-1.5 rounded-xl border px-3.5 py-2 text-xs font-medium theme-muted transition hover:border-teal-400 hover:text-teal-600 bg-white dark:bg-gray-800">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>
                    <span>{{ $currentDir === 'asc' ? 'Terlama' : 'Terbaru' }}</span>
                </button>

                {{-- INPUT SEARCH BOX --}}
                <div class="relative">
                    <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                    </svg>

                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari pencarian lalu tekan Enter..." class="theme-input w-full rounded-xl border py-2 pl-9 pr-3 text-xs sm:w-72 focus:ring-2 focus:ring-teal-500/20">
                </div>
            </div>

        </form>

        {{-- TIMELINE LIST --}}
        <div class="relative space-y-2.5">

            @forelse($aktivitasList as $act)

                @php
                    $aksiLower = strtolower($act->aksi);

                    if (str_contains($aksiLower, 'verifikasi') || str_contains($aksiLower, 'selesai')) {
                        $iconSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
                        $iconStyle = 'bg-emerald-500 text-white';
                        $badge = 'Verifikasi';
                        $badgeStyle = 'bg-emerald-100 text-emerald-700';
                    } elseif (str_contains($aksiLower, 'evaluasi') || str_contains($aksiLower, 'status')) {
                        $iconSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>';
                        $iconStyle = 'bg-sky-500 text-white';
                        $badge = 'Evaluasi';
                        $badgeStyle = 'bg-sky-100 text-sky-700';
                    } elseif (str_contains($aksiLower, 'upload') || str_contains($aksiLower, 'unggah')) {
                        $iconSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>';
                        $iconStyle = 'bg-indigo-500 text-white';
                        $badge = 'Upload';
                        $badgeStyle = 'bg-indigo-100 text-indigo-700';
                    } elseif (str_contains($aksiLower, 'tolak') || str_contains($aksiLower, 'batal')) {
                        $iconSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
                        $iconStyle = 'bg-rose-500 text-white';
                        $badge = 'Ditolak';
                        $badgeStyle = 'bg-rose-100 text-rose-700';
                    } else {
                        $iconSvg = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>';
                        $iconStyle = 'bg-amber-500 text-white';
                        $badge = 'Catatan';
                        $badgeStyle = 'bg-amber-100 text-amber-700';
                    }
                @endphp

                <div class="group relative flex items-center gap-4">

                    {{-- GARIS TIMELINE --}}
                    @if(!$loop->last)
                        <div class="absolute -bottom-3 left-4 top-9 w-0.5 bg-gray-200 dark:bg-gray-700"></div>
                    @endif

                    {{-- IKON TIMELINE --}}
                    <div class="relative z-10 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl shadow-sm transition-all duration-200 group-hover:scale-105 {{ $iconStyle }}">
                        {!! $iconSvg !!}
                    </div>

                    {{-- KARTU KONTEN --}}
                    <div class="theme-card flex-1 rounded-xl border px-4 py-3 transition-all duration-200 hover:border-teal-400">
                        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex flex-col justify-center gap-0.5">
                                <div class="flex items-center gap-2">
                                    <h3 class="theme-title text-sm font-semibold tracking-tight">
                                        {{ $act->aksi }}
                                    </h3>
                                    <span class="rounded-md px-2 py-0.5 text-[10px] font-medium leading-none {{ $badgeStyle }}">
                                        {{ $badge }}
                                    </span>
                                </div>

                                <p class="theme-muted text-xs leading-normal">
                                    {{ $act->deskripsi }}
                                </p>
                            </div>

                            {{-- WAKTU & TANGGAL --}}
                            <div class="mt-1 flex shrink-0 items-center gap-3 sm:mt-0 sm:flex-col sm:items-end sm:gap-0">
                                <p class="theme-muted text-[11px]">
                                    {{ \Carbon\Carbon::parse($act->created_at)->translatedFormat('d M Y, H:i') }}
                                </p>
                                <p class="text-xs font-semibold text-teal-600">
                                    {{ \Carbon\Carbon::parse($act->created_at)->diffForHumans() }}
                                </p>
                            </div>

                        </div>
                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}
                <div class="py-10 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 dark:bg-gray-800">
                        <svg class="h-7 w-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13M9 5h13M5 5h.01M5 11h.01M5 17h.01"/>
                        </svg>
                    </div>

                    <h3 class="theme-title mt-3 text-base font-semibold">
                        Belum Ada Aktivitas
                    </h3>

                    <p class="theme-muted mt-0.5 text-xs">
                        Belum ada riwayat aktivitas yang sesuai dengan filter yang dipilih.
                    </p>
                </div>

            @endforelse

        </div>

        {{-- PAGINATION --}}
        @if($aktivitasList->hasPages() || $aktivitasList->total() > 0)
            <div class="mt-5 flex flex-col items-center justify-between gap-3 border-t pt-4 sm:flex-row">
                <p class="theme-muted text-xs">
                    Menampilkan
                    <span class="font-semibold">{{ $aktivitasList->firstItem() ?? 0 }}</span>
                    –
                    <span class="font-semibold">{{ $aktivitasList->lastItem() ?? 0 }}</span>
                    dari
                    <span class="font-semibold">{{ $aktivitasList->total() }}</span>
                    aktivitas.
                </p>

                {{ $aktivitasList->links('pagination::tailwind') }}
            </div>
        @endif

    </div>

</div>

@endsection