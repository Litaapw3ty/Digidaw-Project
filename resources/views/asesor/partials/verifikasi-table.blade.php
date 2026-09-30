@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full max-w-[1500px] mx-auto space-y-5">

    {{-- HERO HEADER --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-teal-600 via-teal-500 to-cyan-500 p-6 text-white">
        <div class="absolute -right-12 -top-12 h-36 w-36 rounded-full bg-white/10"></div>
        <div class="absolute left-1/2 -bottom-10 h-28 w-28 rounded-full bg-white/10"></div>

        <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-medium text-teal-100">
                    Dashboard Asesor
                </p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight">
                    Riwayat Aktivitas
                </h1>
                <p class="mt-1 max-w-xl text-xs text-teal-50">
                    Pantau seluruh rekam jejak verifikasi dan evaluasi yang telah Anda lakukan.
                </p>
            </div>

            <a href="{{ route('asesor.dashboard') }}"
               class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-white/15 px-4 py-2 text-xs font-medium backdrop-blur transition hover:bg-white/25">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Dashboard
            </a>
        </div>
    </div>

    {{-- QUICK STATS --}}
    <div class="grid gap-3 md:grid-cols-3">
        <div class="theme-card rounded-2xl border p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-teal-100 p-2.5 text-teal-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/>
                    </svg>
                </div>
                <div>
                    <p class="theme-muted text-xs">Total Aktivitas</p>
                    <p class="theme-title text-xl font-bold">{{ $aktivitasList->total() }}</p>
                </div>
            </div>
        </div>

        <div class="theme-card rounded-2xl border p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-emerald-100 p-2.5 text-emerald-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="theme-muted text-xs">Halaman</p>
                    <p class="theme-title text-xl font-bold">{{ $aktivitasList->currentPage() }}</p>
                </div>
            </div>
        </div>

        <div class="theme-card rounded-2xl border p-4 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="rounded-xl bg-sky-100 p-2.5 text-sky-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M5 11h14M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="theme-muted text-xs">Hari Ini</p>
                    <p class="theme-title text-xl font-bold">{{ now()->translatedFormat('d M') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CARD TABEL DENGAN FILTER & SEARCH DARI ATAS --}}
    <div class="theme-card rounded-2xl border p-5 shadow-sm">

        <form method="GET" action="{{ route('asesor.aktivitas') }}">
            <input type="hidden" name="sort" value="{{ request('sort') }}">
            <input type="hidden" name="direction" value="{{ request('direction') }}">

            {{-- TOOLBAR ATAS: PER PAGE & FILTER KIRI, SEARCH KANAN --}}
            <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                
                {{-- KIRI: FILTER JENIS & TANGGAL --}}
                <div class="flex flex-wrap items-center gap-2">
                    <select name="jenis" onchange="this.form.submit()" class="theme-input rounded-lg border px-3 py-1.5 text-xs">
                        <option value="">Semua Aktivitas</option>
                        <option value="verifikasi" {{ request('jenis') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                        <option value="evaluasi" {{ request('jenis') == 'evaluasi' ? 'selected' : '' }}>Evaluasi</option>
                        <option value="upload" {{ request('jenis') == 'upload' ? 'selected' : '' }}>Upload</option>
                        <option value="catatan" {{ request('jenis') == 'catatan' ? 'selected' : '' }}>Catatan</option>
                    </select>

                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" onchange="this.form.submit()" class="theme-input rounded-lg border px-3 py-1.5 text-xs">
                </div>

                {{-- KANAN: SEARCH BOX DENGAN LABEL DARI SAMPING --}}
                <div class="flex items-center justify-end gap-2">
                    <label for="search-input" class="theme-muted text-xs font-medium">Search:</label>
                    <input id="search-input" type="text" name="q" value="{{ request('q') }}" onchange="this.form.submit()" placeholder="Cari..." class="theme-input rounded-lg border px-3 py-1.5 text-xs sm:w-60">
                </div>
            </div>
        </form>

        {{-- TABEL DATA --}}
        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="w-full text-left text-xs">
                @php
                    $nextDir = request('direction') == 'asc' ? 'desc' : 'asc';
                    $sortUrl = route('asesor.aktivitas', array_merge(request()->query(), ['sort' => 'created_at', 'direction' => $nextDir]));
                @endphp

                <thead class="bg-gray-50 text-gray-700 dark:bg-gray-800 dark:text-gray-200">
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="col" class="px-4 py-3 font-bold">Aktivitas</th>
                        <th scope="col" class="px-4 py-3 font-bold">Kategori</th>
                        <th scope="col" class="px-4 py-3 font-bold">Deskripsi</th>
                        <th scope="col" class="px-4 py-3 font-bold text-right">
                            <a href="{{ $sortUrl }}" class="inline-flex items-center gap-1 hover:text-teal-600">
                                Waktu
                                <span>{{ request('direction') == 'asc' ? '▲' : '▼' }}</span>
                            </a>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($aktivitasList as $act)
                        @php
                            $aksiLower = strtolower($act->aksi);

                            if (str_contains($aksiLower, 'verifikasi') || str_contains($aksiLower, 'selesai')) {
                                $badge = 'Verifikasi';
                                $badgeStyle = 'bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300';
                            } elseif (str_contains($aksiLower, 'evaluasi') || str_contains($aksiLower, 'status')) {
                                $badge = 'Evaluasi';
                                $badgeStyle = 'bg-sky-100 text-sky-700 dark:bg-sky-950 dark:text-sky-300';
                            } elseif (str_contains($aksiLower, 'upload') || str_contains($aksiLower, 'unggah')) {
                                $badge = 'Upload';
                                $badgeStyle = 'bg-indigo-100 text-indigo-700 dark:bg-indigo-950 dark:text-indigo-300';
                            } elseif (str_contains($aksiLower, 'tolak') || str_contains($aksiLower, 'batal')) {
                                $badge = 'Ditolak';
                                $badgeStyle = 'bg-rose-100 text-rose-700 dark:bg-rose-950 dark:text-rose-300';
                            } else {
                                $badge = 'Catatan';
                                $badgeStyle = 'bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-300';
                            }
                        @endphp

                        {{-- EFOK SELANG-SELING BARIS STRIPED --}}
                        <tr class="odd:bg-white even:bg-gray-50/60 dark:odd:bg-gray-900 dark:even:bg-gray-800/40 hover:bg-teal-50/50 dark:hover:bg-teal-950/20 transition-colors">
                            <td class="px-4 py-3 font-semibold text-gray-900 dark:text-gray-100">
                                {{ $act->aksi }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="rounded px-2 py-0.5 text-[10px] font-medium {{ $badgeStyle }}">
                                    {{ $badge }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                {{ $act->deskripsi }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="font-medium text-gray-800 dark:text-gray-200">
                                    {{ \Carbon\Carbon::parse($act->created_at)->translatedFormat('Y-m-d H:i:s') }}
                                </div>
                                <div class="text-[10px] text-teal-600">
                                    {{ \Carbon\Carbon::parse($act->created_at)->diffForHumans() }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data aktivitas yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION BOTTOM BAR --}}
        @if($aktivitasList->hasPages() || $aktivitasList->total() > 0)
            <div class="mt-4 flex flex-col items-center justify-between gap-3 pt-2 sm:flex-row">
                <p class="theme-muted text-xs">
                    Showing <span class="font-semibold">{{ $aktivitasList->firstItem() ?? 0 }}</span> to <span class="font-semibold">{{ $aktivitasList->lastItem() ?? 0 }}</span> of <span class="font-semibold">{{ number_format($aktivitasList->total()) }}</span> entries
                </p>

                {{ $aktivitasList->links('pagination::tailwind') }}
            </div>
        @endif

    </div>

</div>

@endsection