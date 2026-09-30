@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full max-w-[1500px] mx-auto space-y-8">


    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-teal-600 via-teal-500 to-cyan-500 p-8 text-white shadow-sm">

        {{-- DECORATION --}}
        <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-20 left-1/3 h-40 w-40 rounded-full bg-white/10"></div>
        <div class="absolute right-1/4 top-10 h-16 w-16 rounded-full bg-white/5"></div>

        <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

            {{-- TEXT --}}
            <div>

                <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1.5 text-xs font-medium backdrop-blur">

                    <span class="h-2 w-2 rounded-full bg-white"></span>

                    Dashboard Asesor

                </div>

                <h1 class="text-[28px] leading-tight font-semibold tracking-tight">    
                    Selamat Datang, {{ Auth::user()->name }}
                </h1>

                <p class="mt-2 max-w-2xl text-[15px] leading-6 text-teal-50">
                    Berikut adalah ringkasan aktivitas dan penugasan evaluasi Anda hari ini.
                </p>

            </div>

        </div>

    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

        {{-- TOTAL INSTANSI --}}
        <div class="theme-card rounded-3xl border p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md">

            <div class="flex items-center gap-4">

                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-teal-100 text-teal-600">

                    <svg class="h-7 w-7"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2m-2 4h2m2-4h2m-2 4h2M8 21v-4h8v4"/>

                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="theme-muted text-sm font-medium">
                        Total Instansi
                    </p>

                    <p class="theme-title mt-1 text-3xl font-bold">
                        {{ $totalInstansi ?? 0 }}
                    </p>

                </div>

            </div>

        </div>


        {{-- PROSES VERIFIKASI --}}
        <div class="theme-card rounded-3xl border p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md">

            <div class="flex items-center gap-4">

                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-sky-100 text-sky-600">

                    <svg class="h-7 w-7"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.038-.133-2.044-.382-3.016z"/>

                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="theme-muted text-sm font-medium">
                        Proses Verifikasi
                    </p>

                    <p class="theme-title mt-1 text-3xl font-bold">
                        {{ $prosesVerifikasi ?? 0 }}
                    </p>

                </div>

            </div>

        </div>


        {{-- EVALUASI SELESAI --}}
        <div class="theme-card rounded-3xl border p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-md">

            <div class="flex items-center gap-4">

                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-500">

                    <svg class="h-7 w-7"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>

                    </svg>

                </div>

                <div class="min-w-0">

                    <p class="theme-muted text-sm font-medium">
                        Evaluasi Selesai
                    </p>

                    <p class="theme-title mt-1 text-3xl font-bold">
                        {{ $evaluasiSelesai ?? 0 }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3 xl:items-start">

        <div class="theme-card overflow-hidden rounded-3xl border shadow-sm xl:col-span-2">

            {{-- HEADER --}}
            <div class="theme-border border-b px-6 py-4">

                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                    {{-- TITLE --}}
                    <div>

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-teal-100 text-teal-600">

                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>

                                </svg>

                            </div>

                            <div>

                                <h2 class="theme-title text-[16px] font-semibold">
                                    Tugas Verifikasi Terbaru
                                </h2>

                                <p class="theme-muted mt-1 text-sm">
                                    Daftar dokumen yang perlu Anda periksa.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- SEARCH REAL-TIME + BUTTON --}}
                    <div class="flex w-full flex-col gap-3 sm:flex-row lg:w-auto">

                        <div class="flex-1">

                            <div class="relative">

                                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-400"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>

                                </svg>

                                <input type="text"
                                       id="search-input"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari instansi / indikator..."
                                       autocomplete="off"
                                       class="theme-input w-full rounded-xl border py-2.5 pl-10 pr-4 text-sm sm:w-64">

                            </div>

                        </div>


                        <a href="{{ route('asesor.verifikasi') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl bg-teal-600 px-4 py-2.5 text-sm font-medium text-white transition duration-200 hover:bg-teal-700">

                            <svg class="h-4 w-4"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 4v16m8-8H4"/>

                            </svg>

                            Mulai Verifikasi

                        </a>

                    </div>

                </div>

            </div>


            {{-- CONTAINER TABEL (DIPERBARUI LEWAT FETCH API) --}}
            <div id="table-container">

                @include('asesor.partials.tugas-verifikasi')

            </div>

        </div>


        {{-- AKTIVITAS TERBARU --}}
            <div class="theme-card overflow-hidden rounded-3xl border shadow-sm xl:self-start">
            {{-- HEADER --}}
            <div class="theme-border border-b px-6 py-4">

                <div class="flex items-center gap-2">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-100 text-sky-600">

                        <svg class="h-5 w-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="1.8"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="theme-title text-[16px] font-semibold">
                            Aktivitas Terbaru
                        </h2>

                        <p class="theme-muted mt-1 text-sm">
                            Riwayat aktivitas Anda.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ACTIVITY LIST --}}
            <div class="px-6 py-2">

                @forelse ($aktivitasTerbaru as $aktivitas)

                    <div class="theme-border group flex gap-3 border-b py-3 last:border-0">

                        {{-- ICON --}}
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-teal-100 text-teal-600 transition duration-200 group-hover:scale-105">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                        </div>


                        {{-- CONTENT --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex items-start justify-between gap-3">

                                <p class="theme-title text-sm font-semibold">
                                    {{ $aktivitas->aksi }}
                                </p>

                            </div>

                            <p class="theme-muted mt-1 text-sm leading-5">
                                {{ $aktivitas->deskripsi }}
                            </p>

                            <div class="mt-2 flex items-center gap-1.5">

                                <svg class="h-3.5 w-3.5 text-gray-400"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0"/>

                                </svg>

                                <p class="theme-muted text-xs">
                                    {{ \Carbon\Carbon::parse($aktivitas->created_at)->diffForHumans() }}
                                </p>

                            </div>

                        </div>

                    </div>

                @empty

                    {{-- EMPTY STATE --}}
                    <div class="py-12 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-teal-100 text-teal-600 dark:bg-teal-900/20 dark:text-teal-400">

                            <svg class="h-7 w-7"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>

                            </svg>

                        </div>

                        <p class="theme-title mt-4 text-sm font-semibold">
                            Belum Ada Aktivitas
                        </p>

                        <p class="theme-muted mt-1 text-xs">
                            Belum ada aktivitas terbaru.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- FOOTER --}}
            <div class="theme-border border-t px-6 py-3">

                <a href="{{ route('asesor.aktivitas') }}"
                   class="inline-flex items-center gap-2 text-sm font-semibold text-teal-600 transition hover:text-teal-700">

                    Lihat semua aktivitas

                    <svg class="h-4 w-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>

                    </svg>

                </a>

            </div>

        </div>

    </div>

</div>

{{-- SCRIPT FETCH API UNTUK REAL-TIME SEARCH TANPA RELOAD --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const searchInput = document.getElementById('search-input');
        const tableContainer = document.getElementById('table-container');


        // =====================================================
        // LOAD DATA
        // =====================================================
        function loadData(url) {

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {

                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }

                return response.text();

            })
            .then(html => {

                // Update tabel tanpa reload halaman
                tableContainer.innerHTML = html;

                // Update URL browser
                window.history.pushState(
                    null,
                    '',
                    url
                );

            })
            .catch(error => {

                console.error(
                    'Error fetching data:',
                    error
                );

            });

        }


        // =====================================================
        // BUILD URL
        // =====================================================
        function buildUrl(overrideParams = {}) {

            const url = new URL(
                "{{ route('asesor.dashboard') }}",
                window.location.origin
            );

            const currentUrlParams =
                new URLSearchParams(
                    window.location.search
                );


            // Ambil parameter yang sedang aktif
            for (
                const [key, value]
                of currentUrlParams.entries()
            ) {

                url.searchParams.set(
                    key,
                    value
                );

            }


            // =================================================
            // SEARCH
            // =================================================
            if (searchInput) {

                const searchValue =
                    searchInput.value.trim();

                if (searchValue) {

                    url.searchParams.set(
                        'search',
                        searchValue
                    );

                } else {

                    url.searchParams.delete(
                        'search'
                    );

                }

            }


            // =================================================
            // OVERRIDE FILTER
            // =================================================
            for (
                const [key, value]
                of Object.entries(overrideParams)
            ) {

                if (value) {

                    url.searchParams.set(
                        key,
                        value
                    );

                } else {

                    url.searchParams.delete(
                        key
                    );

                }

            }


            // Kalau search baru,
            // kembali ke halaman pertama
            url.searchParams.delete('page');


            return url.toString();

        }


        // =====================================================
        // REAL-TIME SEARCH
        // =====================================================
        if (searchInput) {

            searchInput.addEventListener(
                'input',
                function () {

                    // LANGSUNG FETCH SETIAP KALI MENGETIK
                    loadData(
                        buildUrl()
                    );

                }
            );

        }


        // =====================================================
        // FILTER STATUS
        // =====================================================
        document.addEventListener(
            'change',
            function (e) {

                if (
                    e.target &&
                    e.target.id === 'status-filter'
                ) {

                    loadData(
                        buildUrl({
                            status: e.target.value
                        })
                    );

                }


                // =================================================
                // FILTER TANGGAL
                // =================================================
                if (
                    e.target &&
                    e.target.id === 'tanggal-filter'
                ) {

                    loadData(
                        buildUrl({
                            tanggal: e.target.value
                        })
                    );

                }

            }
        );


        // =====================================================
        // CLICK EVENT
        // =====================================================
        document.addEventListener(
            'click',
            function (e) {


                // =================================================
                // RESET TANGGAL
                // =================================================
                const resetBtn =
                    e.target.closest(
                        '#reset-tanggal'
                    );

                if (resetBtn) {

                    e.preventDefault();

                    loadData(
                        buildUrl({
                            tanggal: ''
                        })
                    );

                }


                // =================================================
                // PAGINATION
                // =================================================
                const pageLink =
                    e.target.closest(
                        '#table-container .pagination-container a'
                    );

                if (pageLink) {

                    e.preventDefault();

                    loadData(
                        pageLink.getAttribute(
                            'href'
                        )
                    );

                }


                // =================================================
                // SORTING
                // =================================================
                const sortLink =
                    e.target.closest(
                        '#table-container a.ajax-sort'
                    );

                if (sortLink) {

                    e.preventDefault();

                    loadData(
                        sortLink.getAttribute(
                            'href'
                        )
                    );

                }

            }
        );

    });
</script>
@endsection