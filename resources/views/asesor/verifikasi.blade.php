@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full max-w-[1600px] mx-auto">

{{-- =========================================================
    HEADER
========================================================== --}}
<div class="mb-7">

    <h1 class="text-[30px] leading-tight font-semibold theme-title tracking-tight">
        Verifikasi Bukti
    </h1>

    <p class="mt-2 text-[16px] theme-muted">
        Kelola dan verifikasi bukti evaluasi dari instansi yang menjadi tanggung jawab Anda.
    </p>

</div>


{{-- =========================================================
    SEARCH
========================================================== --}}
<div class="theme-card border theme-border rounded-xl mb-5">

    <div class="p-4 sm:p-5">

        <form method="GET"
              action="{{ route('asesor.verifikasi') }}"
              class="w-full">

            <div class="relative max-w-[480px]">

                <svg
                    class="absolute left-3.5 top-1/2 -translate-y-1/2 w-[18px] h-[18px] theme-muted pointer-events-none"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="m21 21-4.35-4.35m2.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>

                </svg>


                <input
                    type="text"
                    id="search-instansi"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau kode instansi..."
                    class="theme-input w-full
                           h-12
                           rounded-lg
                           border theme-border
                           pl-10 pr-4
                           text-sm
                           outline-none
                           transition
                           focus:border-[#12a89d]
                           focus:ring-2
                           focus:ring-[#12a89d]/10"
                >

            </div>

        </form>

    </div>

</div>


{{-- =========================================================
    TABLE
========================================================== --}}
<div id="table-container"
     class="theme-card border theme-border rounded-xl overflow-hidden">

    {{-- TABLE TOP --}}
    <div class="px-5 sm:px-6 py-4 border-b theme-border
                flex flex-col sm:flex-row
                sm:items-center sm:justify-between gap-2">

        <div>

            <h2 class="text-[16px] font-semibold theme-title">
                Daftar Instansi
            </h2>

            <p class="text-xs theme-muted mt-1">
                {{ $instansiList->total() }} instansi terdaftar
            </p>

        </div>


        @if(request('search'))

            <div class="text-xs theme-muted">

                Hasil pencarian:
                <span class="font-medium theme-title">
                    "{{ request('search') }}"
                </span>

            </div>

        @endif

    </div>


    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full border-collapse">

            <thead>

                <tr class="border-b theme-border">

                    <th class="px-5 sm:px-6 py-3.5
                               text-left
                               text-[14px]
                               font-semibold
                               uppercase
                               tracking-[0.04em]
                               theme-muted
                               w-[70px]">
                        No
                    </th>

                    <th class="px-5 sm:px-6 py-3.5
                               text-left
                               text-[14px]
                               font-semibold
                               uppercase
                               tracking-[0.04em]
                               theme-muted
                               whitespace-nowrap">
                        Kode Instansi
                    </th>

                    <th class="px-5 sm:px-6 py-3.5
                               text-left
                               text-[14px]
                               font-semibold
                               uppercase
                               tracking-[0.04em]
                               theme-muted
                               min-w-[280px]">
                        Nama Instansi
                    </th>

                    <th class="px-5 sm:px-6 py-3.5
                               text-left
                               text-[14px]
                               font-semibold
                               uppercase
                               tracking-[0.04em]
                               theme-muted
                               min-w-[230px]">
                        User / PIC
                    </th>

                    <th class="px-5 sm:px-6 py-3.5
                               text-center
                               text-[14px]
                               font-semibold
                               uppercase
                               tracking-[0.04em]
                               theme-muted
                               whitespace-nowrap">
                        Status
                    </th>

                    <th class="px-5 sm:px-6 py-3.5
                               text-center
                               text-[14px]
                               font-semibold
                               uppercase
                               tracking-[0.04em]
                               theme-muted
                               whitespace-nowrap">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y theme-border">

                @forelse($instansiList as $index => $item)

                    <tr class="theme-table-row
                        transition-colors
                        hover:bg-[#12a89d]/5
                        dark:hover:bg-[#14b8a6]/10">


                        {{-- NO --}}
                        <td class="px-5 sm:px-6 py-4
                                   text-sm
                                   theme-muted">

                            {{ $instansiList->firstItem() + $index }}

                        </td>


                        {{-- KODE --}}
                        <td class="px-5 sm:px-6 py-4">

                            <span class="text-sm
                                         font-medium
                                         theme-title
                                         whitespace-nowrap">

                                {{ $item->kode_instansi }}

                            </span>

                        </td>


                        {{-- NAMA INSTANSI --}}
                        <td class="px-5 sm:px-6 py-4">

                            <div class="max-w-[360px]">

                                <p class="text-sm
                                          font-semibold
                                          theme-title
                                          leading-5">

                                    {{ $item->nama_instansi }}

                                </p>

                                <p class="text-xs
                                          theme-muted
                                          mt-1">

                                    Instansi terdaftar

                                </p>

                            </div>

                        </td>


                        {{-- PIC --}}
                        <td class="px-5 sm:px-6 py-4">

                            <div class="max-w-[280px]">

                                <p class="text-sm
                                          font-medium
                                          theme-title
                                          truncate">

                                    {{ $item->pic_name ?? 'Belum Ditentukan' }}

                                </p>

                                <p class="text-xs
                                          theme-muted
                                          mt-1
                                          truncate">

                                    {{ $item->pic_email ?? '-' }}

                                </p>

                            </div>

                        </td>


                        {{-- STATUS --}}
                        <td class="px-5 sm:px-6 py-4 text-center">

                            @if(strtoupper($item->status ?? '') === 'AKTIF')

                                <span class="inline-flex
                                             items-center
                                             gap-1.5
                                             px-2.5
                                             py-1
                                             rounded-md
                                             bg-[#12a89d]/10
                                             dark:bg-[#14b8a6]/15
                                             text-[#0d9188]
                                             dark:text-[#2dd4bf]
                                             text-xs
                                             font-medium">

                                    <span class="w-1.5 h-1.5
                                                 rounded-full
                                                 bg-[#12a89d]
                                                 dark:bg-[#2dd4bf]">
                                    </span>

                                    Aktif

                                </span>

                            @else

                                <span class="inline-flex
                                             items-center
                                             gap-1.5
                                             px-2.5
                                             py-1
                                             rounded-md
                                             bg-gray-100
                                             dark:bg-gray-800
                                             text-gray-500
                                             dark:text-gray-400
                                             text-xs
                                             font-medium">

                                    <span class="w-1.5 h-1.5
                                                 rounded-full
                                                 bg-gray-400">
                                    </span>

                                    Nonaktif

                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="px-5 sm:px-6 py-4 text-right">

                            <a href="{{ route('asesor.verifikasi.indikator', ['id_instansi' => $item->id_instansi]) }}"
                                class="inline-flex
                                       items-center
                                       gap-1.5
                                       px-3
                                       py-2
                                       rounded-lg
                                       text-sm
                                       font-medium
                                       text-[#0d9188]
                                       dark:text-[#2dd4bf]
                                       hover:bg-[#12a89d]/10
                                       dark:hover:bg-[#14b8a6]/10
                                       transition-colors">

                                Lihat Detail

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="m9 18 6-6-6-6"/>

                                </svg>

                            </a>

                        </td>

                    </tr>


                @empty

                    {{-- EMPTY STATE --}}
                    <tr>

                        <td colspan="6" class="px-6 py-16">

                            <div class="text-center">

                                <div class="w-12 h-12
                                            mx-auto
                                            mb-4
                                            rounded-xl
                                            bg-gray-100
                                            dark:bg-gray-800
                                            flex items-center
                                            justify-center">

                                    <svg
                                        class="w-6 h-6 theme-muted"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.6"
                                            d="M20 13V7a2 2 0 0 0-2-2h-3l-1-2H10L9 5H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8"/>

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.6"
                                            d="m16 19 2 2 4-4"/>

                                    </svg>

                                </div>


                                @if(request('search'))

                                    <h3 class="text-sm
                                               font-semibold
                                               theme-title">

                                        Data tidak ditemukan

                                    </h3>

                                    <p class="mt-1 text-sm theme-muted">

                                        Tidak ada instansi yang sesuai dengan
                                        pencarian tersebut.

                                    </p>

                                    <a
                                        href="{{ route('asesor.verifikasi') }}"
                                        class="inline-block
                                               mt-4
                                               text-sm
                                               font-medium
                                               text-[#12a89d]
                                               dark:text-[#2dd4bf]
                                               hover:underline">

                                        Hapus pencarian

                                    </a>

                                @else

                                    <h3 class="text-sm
                                               font-semibold
                                               theme-title">

                                        Belum ada data instansi

                                    </h3>

                                    <p class="mt-1 text-sm theme-muted">

                                        Belum terdapat instansi yang dapat
                                        ditampilkan untuk proses verifikasi.

                                    </p>

                                @endif

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- =====================================================
        FOOTER
    ====================================================== --}}
    @if($instansiList->total() > 0)

        <div class="px-5 sm:px-6 py-4
                    border-t theme-border
                    flex flex-col sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-3">

            <p class="text-xs sm:text-sm theme-muted">

                Menampilkan
                <span class="font-medium theme-title">
                    {{ $instansiList->firstItem() }}
                </span>
                –
                <span class="font-medium theme-title">
                    {{ $instansiList->lastItem() }}
                </span>
                dari
                <span class="font-medium theme-title">
                    {{ $instansiList->total() }}
                </span>
                instansi

            </p>


            @if($instansiList->hasPages())

                <div>

                    {{ $instansiList->withQueryString()->links('pagination::tailwind') }}

                </div>

            @endif

        </div>

    @endif

</div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('search-instansi');
    const tableContainer = document.getElementById('table-container');

    let searchTimeout;

    searchInput.addEventListener('input', function () {

        clearTimeout(searchTimeout);

        const search = this.value.trim();

        // Kalau search dikosongkan, langsung ambil semua data
        if (search === '') {
            loadData('');
            return;
        }

        searchTimeout = setTimeout(function () {
            loadData(search);
        }, 300);

    });

    function loadData(search) {

        const url = new URL(
            "{{ route('asesor.verifikasi') }}",
            window.location.origin
        );

        if (search !== '') {
            url.searchParams.set('search', search);
        }

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal mengambil data');
            }

            return response.text();
        })
        .then(html => {
            tableContainer.innerHTML = html;
        })
        .catch(error => {
            console.error('Search error:', error);
        });
    }

});
</script>

@endsection

