@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- =========================================================
        HEADER HALAMAN
        ========================================================= --}}
    <div class="flex items-start justify-between">

        <div>
            <h1 class="text-[28px] font-semibold text-[#14213D]">
                Data Asesor
            </h1>

            <p class="mt-1 text-[14px] text-[#64748B]">
                Kelola data asesor, instansi asal, dan status asesor dalam sistem.
            </p>
        </div>

        {{-- Tombol tambah asesor --}}
        <a
            href="{{ route('admin.asesor.create') }}"
            class="inline-flex items-center gap-2 rounded-[8px] bg-gradient-to-r from-[#12C6BD] to-[#09605C] px-5 py-3 text-[13px] font-medium text-white transition hover:opacity-90"
        >
            + Tambah Asesor
        </a>

    </div>


    {{-- =========================================================
        CARD DATA ASESOR
        Filter + Search + Table + Pagination
        ========================================================= --}}
    <div class="mt-6 overflow-hidden rounded-[12px] border border-[#BCC9CB] bg-white">

        {{-- =====================================================
            FILTER & SEARCH
            ===================================================== --}}
        <div class="border-b border-[#D9D9D9] px-5 py-4">

            <form
                id="filterForm"
                action="{{ route('admin.asesor.index') }}"
                method="GET"
                class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between"
            >

                {{-- SEARCH --}}
                <div class="relative">

                    <input
                        type="text"
                        name="search"
                        id="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau ID asesor..."
                        autocomplete="off"
                        class="h-[36px] w-full rounded-[7px] border border-[#BCC9CB] bg-white py-2 pl-10 pr-3 text-[13px] text-[#434654] outline-none placeholder:text-[#8A9395] focus:border-[#006671] sm:w-[480px]"
                    >

                    {{-- Icon search --}}
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[16px] text-[#434654]">
                        ⌕
                    </span>

                </div>


                {{-- FILTER STATUS + RESET --}}
                <div class="flex items-center gap-3">

                    <select
                        name="status"
                        id="status"
                        class="h-[36px] rounded-[7px] border border-[#BCC9CB] bg-[#F7F9FC] px-3 text-[13px] text-[#434654] outline-none focus:border-[#006671]">                    >
                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="AKTIF"
                            {{ request('status') == 'AKTIF' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option
                            value="NONAKTIF"
                            {{ request('status') == 'NONAKTIF' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>


                    {{-- Tombol reset --}}
                    <a
                        id="refreshFilter"
                        href="{{ route('admin.asesor.index') }}"
                        class="inline-flex h-[36px] items-center justify-center rounded-[7px] border border-[#BCC9CB] px-4 text-[13px] font-medium text-[#434654] transition hover:bg-[#F4F7F8]">
                        Reset
                    </a>

                </div>

            </form>

        </div>


        {{-- =====================================================
            TABLE
            ===================================================== --}}
        <div id="asesorTable">

            @include('admin.asesor._table', [
                'asesors' => $asesors
            ])

        </div>

    </div>


    {{-- =========================================================
        JAVASCRIPT FILTER
        ========================================================= --}}
    <script>

        // =========================================================
        // ELEMENT HALAMAN
        // =========================================================

        // Form filter asesor.
        const filterForm = document.getElementById('filterForm');

        // Dropdown status.
        const statusSelect = document.getElementById('status');

        // Input pencarian.
        const searchInput = document.getElementById('search');

        // Container tabel + pagination.
        const asesorTable = document.getElementById('asesorTable');

        // Tombol reset filter.
        const refreshFilter = document.getElementById('refreshFilter');

        // Timer untuk live search.
        let searchTimer;


        // =========================================================
        // FUNGSI FILTER ASESOR
        // =========================================================

        function filterAsesor(url = null) {

            // Jika URL tidak diberikan,
            // buat URL berdasarkan isi form filter.
            const requestUrl =
                url ??
                `${filterForm.action}?${new URLSearchParams(new FormData(filterForm))}`;


            // Request data ke server menggunakan AJAX.
            fetch(requestUrl, {

                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html'
                }

            })

                // Ubah response menjadi text HTML.
                .then(response => response.text())

                .then(html => {

                    // Buat dokumen HTML sementara.
                    const parser = new DOMParser();

                    const documentHtml =
                        parser.parseFromString(html, 'text/html');


                    // Ambil container tabel dari response.
                    const newTable =
                        documentHtml.getElementById('asesorTable');


                    // Ganti isi tabel lama dengan hasil filter.
                    if (newTable) {
                        asesorTable.innerHTML = newTable.innerHTML;
                    }


                    // Ubah URL browser tanpa reload.
                    window.history.replaceState(
                        {},
                        '',
                        requestUrl
                    );

                })

                .catch(error => {

                    // Tampilkan error di console.
                    console.error(
                        'Gagal memuat data asesor:',
                        error
                    );

                });

        }


        // =========================================================
        // FILTER STATUS
        // =========================================================

        statusSelect.addEventListener('change', function () {

            filterAsesor();

        });


        // =========================================================
        // LIVE SEARCH
        // =========================================================

        searchInput.addEventListener('input', function () {

            // Batalkan timer sebelumnya.
            clearTimeout(searchTimer);


            // Tunggu 300ms setelah user berhenti mengetik.
            searchTimer = setTimeout(function () {

                filterAsesor();

            }, 300);

        });


        // =========================================================
        // PAGINATION AJAX
        // =========================================================

        asesorTable.addEventListener('click', function (event) {

            // Cari link yang diklik.
            const link = event.target.closest('a[href]');


            // Jika bukan link, hentikan.
            if (!link) {
                return;
            }


            // Ubah href menjadi object URL.
            const url = new URL(
                link.href,
                window.location.origin
            );


            // Hanya proses link pagination.
            if (!url.searchParams.has('page')) {
                return;
            }


            // Cegah reload halaman.
            event.preventDefault();


            // Ambil halaman menggunakan AJAX.
            filterAsesor(link.href);

        });


        // =========================================================
        // RESET FILTER
        // =========================================================

        refreshFilter.addEventListener('click', function (event) {

            // Cegah reload halaman.
            event.preventDefault();


            // Kosongkan filter.
            statusSelect.value = '';
            searchInput.value = '';


            // Ambil semua data asesor.
            filterAsesor(filterForm.action);

        });

    </script>

@endsection