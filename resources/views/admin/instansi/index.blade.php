@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- =========================================================
        HEADER HALAMAN
        ========================================================= --}}
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-[28px] font-semibold text-[#1F1F1F]">
                Data Instansi
            </h1>

            <p class="mt-1 text-[14px] text-[#64748B]">
                Kelola data instansi yang terdaftar dalam sistem evaluasi Pemerintah Digital.
            </p>
        </div>

        {{-- Tombol tambah instansi --}}
        <a href="{{ route('admin.instansi.create') }}"
        class="rounded-[8px] bg-gradient-to-r from-[#12C6BD] to-[#09605C] px-5 py-3 text-[13px] font-medium text-white transition hover:opacity-90">
            + Tambah Instansi
        </a>
    </div>


    {{-- =========================================================
        FILTER & SEARCH
        ========================================================= --}}
    <div class="mt-6 rounded-[12px] border border-[#BCC9CB] bg-white px-4 py-4">

        <form id="filterForm" action="{{ route('admin.instansi.index') }}" method="GET" class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

            {{-- FILTER KATEGORI & STATUS --}}
            <div class="flex flex-col gap-3 sm:flex-row">

                {{-- Filter kategori --}}
                <select name="kategori" id="kategori"
                        class="h-[36px] rounded-[7px] border border-[#BCC9CB] bg-[#F7F9FC] px-3 text-[13px] text-[#434654] outline-none focus:border-[#006671]">
                    <option value="">Semua Kategori</option>                    <option value="PROVINSI" {{ request('kategori') == 'PROVINSI' ? 'selected' : '' }}>Provinsi</option>
                    <option value="KABUPATEN" {{ request('kategori') == 'KABUPATEN' ? 'selected' : '' }}>Kabupaten</option>
                    <option value="KOTA" {{ request('kategori') == 'KOTA' ? 'selected' : '' }}>Kota</option>
                    <option value="LAINNYA" {{ request('kategori') == 'LAINNYA' ? 'selected' : '' }}>Lainnya</option>
                </select>


                {{-- Filter status --}}
                <select name="status" id="status" 
                        class="h-[36px] rounded-[7px] border border-[#BCC9CB] bg-[#F7F9FC] px-3 text-[13px] text-[#434654] outline-none focus:border-[#006671]">
                    <option value="">Semua Status</option>
                    <option value="AKTIF" {{ request('status') == 'AKTIF' ? 'selected' : '' }}>Aktif</option>
                    <option value="NONAKTIF" {{ request('status') == 'NONAKTIF' ? 'selected' : '' }}>Nonaktif</option>
                </select>


                {{-- Tombol refresh / reset filter --}}
                <a id="refreshFilter" href="{{ route('admin.instansi.index') }}" class="flex h-[36px] w-[36px] items-center justify-center rounded-[7px] text-[#008F8A] transition hover:bg-[#E6F7F6]" title="Refresh data">
                    ↻
                </a>
            </div>


            {{-- SEARCH --}}
            <div class="relative">
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari nama atau kode instansi..." autocomplete="off" class="h-[36px] w-full rounded-[7px] border border-[#BCC9CB] bg-white py-2 pl-3 pr-9 text-[13px] text-[#434654] outline-none placeholder:text-[#8A9395] focus:border-[#006671] sm:w-[250px]">

                {{-- Icon search --}}
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-[#6D797B]">
                    ⌕
                </span>
            </div>

        </form>
    </div>


    {{-- =========================================================
        TABLE DATA INSTANSI
        ========================================================= --}}
    <div id="instansiTable">
    @include('admin.instansi._table', ['instansi' => $instansi])
    </div>


    {{-- =========================================================
        JAVASCRIPT FILTER OTOMATIS
        ========================================================= --}}
<script>
    // =========================================================
    // ELEMENT HALAMAN
    // =========================================================

    // Form yang berisi filter kategori, status, dan search.
    const filterForm = document.getElementById('filterForm');

    // Dropdown kategori.
    const kategoriSelect = document.getElementById('kategori');

    // Dropdown status.
    const statusSelect = document.getElementById('status');

    // Input pencarian.
    const searchInput = document.getElementById('search');

    // Container yang berisi tabel dan pagination.
    const instansiTable = document.getElementById('instansiTable');

    // Tombol refresh / reset filter.
    const refreshFilter = document.getElementById('refreshFilter');


    // Timer untuk live search.
    let searchTimer;


    // =========================================================
    // FUNGSI FILTER INSTANSI
    // =========================================================

    function filterInstansi(url = null) {

        // Kalau URL tidak diberikan, gunakan URL dari form.
        // Contoh:
        // /admin/instansi?search=provinsi
        const requestUrl = url ?? `${filterForm.action}?${new URLSearchParams(new FormData(filterForm))}`;


        // Kirim request ke server menggunakan fetch().
        fetch(requestUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })

            // Mengubah response dari server menjadi HTML/text.
            .then(response => response.text())

            .then(html => {

                // Membuat dokumen HTML sementara dari response.
                const parser = new DOMParser();
                const documentHtml = parser.parseFromString(html, 'text/html');

                // Mengambil container tabel dari response server.
                const newTable = documentHtml.getElementById('instansiTable');


                // Kalau container tabel ditemukan,
                // ganti isi tabel lama dengan tabel baru.
                if (newTable) {
                    instansiTable.innerHTML = newTable.innerHTML;
                }


                // Mengubah URL browser tanpa reload halaman.
                window.history.replaceState({}, '', requestUrl);

            })

            // Menampilkan error di console kalau request gagal.
            .catch(error => {
                console.error('Gagal memuat data instansi:', error);
            });
    }


    // =========================================================
    // FILTER KATEGORI
    // =========================================================

    kategoriSelect.addEventListener('change', function () {

        // Jalankan filter ketika kategori berubah.
        filterInstansi();

    });


    // =========================================================
    // FILTER STATUS
    // =========================================================

    statusSelect.addEventListener('change', function () {

        // Jalankan filter ketika status berubah.
        filterInstansi();

    });


    // =========================================================
    // LIVE SEARCH
    // =========================================================

    searchInput.addEventListener('input', function () {

        // Membatalkan timer sebelumnya.
        //
        // Contoh admin mengetik:
        // p
        // po
        // pov
        //
        // Request untuk "p" dan "po" akan dibatalkan
        // jika admin langsung lanjut mengetik.
        clearTimeout(searchTimer);


        // Tunggu 300ms setelah admin berhenti mengetik.
        searchTimer = setTimeout(function () {

            // Jalankan filter tanpa reload halaman.
            filterInstansi();

        }, 300);

    });

    // =========================================================
// PAGINATION AJAX
// =========================================================
instansiTable.addEventListener('click', function (event) {
    // Cari link yang diklik user
    const link = event.target.closest('a[href]');

    // Kalau yang diklik bukan link, hentikan
    if (!link) {
        return;
    }

    // Ubah href link menjadi URL yang bisa kita baca
    const url = new URL(link.href, window.location.origin);

    // Kita hanya ingin menangkap link pagination
    // Pagination Laravel menggunakan parameter "page"
    if (!url.searchParams.has('page')) {
        return;
    }

    // Cegah browser melakukan reload halaman
    event.preventDefault();

    // Ambil data halaman menggunakan AJAX
    filterInstansi(link.href);
});

// =========================================================
// REFRESH DATA AJAX
// =========================================================
refreshFilter.addEventListener('click', function (event) {
    // Cegah browser membuka ulang halaman
    event.preventDefault();

    // Kembalikan semua filter ke kondisi awal
    kategoriSelect.value = '';
    statusSelect.value = '';
    searchInput.value = '';

    // Ambil kembali seluruh data instansi
    filterInstansi(filterForm.action);
});
</script>
@endsection