@extends('layouts.sidebar.sidebar-user')

@section('content')
<div class="space-y-6">

    <div class="rounded-2xl bg-gradient-to-r from-teal-500 to-teal-600 px-7 py-6 text-white">
        <h1 class="text-2xl font-bold">Selamat Datang, {{ $user->name ?? 'User' }}</h1>
        <p class="mt-1 text-base text-white/90">
            Selamat datang di Portal SPBE. Berikut data statistik evaluasi.
        </p>
    </div>

    {{-- 4 STATISTIK: sementara kosong --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-xl border border-gray-300 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-teal-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Target Nasional</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">-</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-gray-300 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l5-5 4 3 7-8"/>
                        <circle cx="4" cy="16" r="1.5" fill="currentColor"/><circle cx="9" cy="11" r="1.5" fill="currentColor"/>
                        <circle cx="13" cy="14" r="1.5" fill="currentColor"/><circle cx="20" cy="6" r="1.5" fill="currentColor"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Indeks Nasional</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">-</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-gray-300 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-teal-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Target Instansi</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">-</p>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-gray-300 bg-white p-5 dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l5-5 4 3 7-8"/>
                        <circle cx="4" cy="16" r="1.5" fill="currentColor"/><circle cx="9" cy="11" r="1.5" fill="currentColor"/>
                        <circle cx="13" cy="14" r="1.5" fill="currentColor"/><circle cx="20" cy="6" r="1.5" fill="currentColor"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-300">Indeks Instansi</p>
                    <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-white">-</p>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 gap-4 xl:grid-cols-4">

        {{-- ANALISIS TAHUNAN: frame tetap, data kosong --}}
        <div class="overflow-hidden rounded-xl border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-800 xl:col-span-3">

            <div class="flex flex-col gap-4 border-b border-gray-200 px-6 py-4 dark:border-gray-700 lg:flex-row lg:items-center lg:justify-between">
                <h2 class="text-xl font-bold text-blue-900 dark:text-blue-300">Analisis Indeks Tahunan</h2>

                <div class="flex flex-wrap items-center gap-5">
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                        <span class="h-4 w-4 rounded-full bg-blue-800"></span>
                        <span>Indeks Nasional</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                        <span class="h-4 w-4 rounded-full bg-red-600"></span>
                        <span>Indeks Instansi</span>
                    </div>
                    <button type="button" class="flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                        1 Tahun Terakhir
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="px-6 py-6">
                <div class="relative h-[390px] w-full">

                    <div class="absolute inset-x-14 top-4 bottom-12 flex flex-col justify-between">
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                        <div class="border-t border-gray-100 dark:border-gray-700"></div>
                    </div>

                    <div class="absolute left-0 top-2 bottom-12 flex flex-col justify-between text-sm text-gray-700 dark:text-gray-300">
                        <span>2.5</span><span>2.0</span><span>1.5</span><span>1.0</span><span>0.5</span><span>0.0</span>
                    </div>

                    <div class="absolute left-12 right-4 top-4 bottom-8 flex items-center justify-center">
                        <p class="text-sm font-medium text-gray-400 dark:text-gray-500">
                            Belum ada data analisis tahunan
                        </p>
                    </div>

                    <div class="absolute bottom-0 left-12 right-4 flex justify-between text-sm font-medium text-gray-800 dark:text-gray-300">
                        <span>2026</span><span>2027</span><span>2028</span>
                        <span>2029</span><span>2030</span><span>2031</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- AKTIVITAS --}}
        <div class="overflow-hidden rounded-xl border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-800">

            <div class="border-b border-gray-200 px-6 py-5 dark:border-gray-700">
                <h2 class="text-xl font-bold text-blue-900 dark:text-blue-300">
                    Aktivitas Anda
                </h2>
            </div>

            <div class="px-6">

                @forelse($aktivitas as $item)

                    <div class="flex gap-4 border-b border-gray-200 py-5 last:border-b-0 dark:border-gray-700">

                        {{-- ICON --}}
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border-2 border-blue-200 dark:border-blue-800">
                            <div class="h-4 w-4 rounded-full border-2 border-blue-700 bg-white dark:bg-gray-800"></div>
                        </div>

                        {{-- INFORMASI AKTIVITAS --}}
                        <div class="min-w-0">

                            <p class="text-base font-medium text-gray-900 dark:text-white">
                                {{ $item->deskripsi ?? $item->aksi }}
                            </p>

                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d M Y H.i') }}
                                WIB
                            </p>

                        </div>

                    </div>

                @empty

                    <div class="flex gap-4 py-5">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border-2 border-gray-200 dark:border-gray-700">
                            <div class="h-4 w-4 rounded-full border-2 border-gray-400 bg-white dark:bg-gray-800"></div>
                        </div>

                        <div class="min-w-0">

                            <p class="text-base font-medium text-gray-500 dark:text-gray-400">
                                Belum ada aktivitas
                            </p>

                            <p class="mt-1 text-sm text-gray-400 dark:text-gray-500">
                                Aktivitas Anda akan tampil di sini.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>
@endsection
