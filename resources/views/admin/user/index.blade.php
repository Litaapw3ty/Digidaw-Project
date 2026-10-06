@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- HEADER HALAMAN --}}
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-[28px] font-semibold text-[#14213D]">
                Data User
            </h1>

            <p class="mt-1 text-[14px] text-[#64748B]">
                Kelola pengguna sistem, peran, dan status akses mereka dalam platform.
            </p>
        </div>

        <a href="{{ route('admin.user.create') }}" class="inline-flex items-center gap-2 rounded-[8px] bg-gradient-to-r from-[#12C6BD] to-[#09605C] px-5 py-3 text-[13px] font-medium text-white transition hover:opacity-90">
            + Tambah User
        </a>
    </div>

    {{-- FILTER --}}
    <div class="mt-6 rounded-[12px] border border-[#BCC9CB] bg-white px-4 py-4">
        <form id="filterForm" action="{{ route('admin.user.index') }}" method="GET" class="flex flex-col gap-3 lg:flex-row lg:items-center">

            {{-- SEARCH --}}
            <div class="relative flex-1">
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." autocomplete="off" class="h-[36px] w-full rounded-[7px] border border-[#BCC9CB] bg-[#F4F7FA] py-2 pl-10 pr-3 text-[13px] text-[#434654] outline-none placeholder:text-[#8A9395] focus:border-[#006671]">

                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[#6D797B]">
                    ⌕
                </span>
            </div>

            {{-- FILTER ROLE --}}
            <select name="role" id="role" 
                    class="h-[36px] rounded-[7px] border border-[#BCC9CB] bg-[#F7F9FC] px-3 text-[13px] text-[#434654] outline-none focus:border-[#006671]">
                <option value="">Semua Peran</option>
                <option value="ADMIN" {{ request('role') == 'ADMIN' ? 'selected' : '' }}>
                    Administrator
                </option>
                <option value="USER" {{ request('role') == 'USER' ? 'selected' : '' }}>
                    PIC Instansi
                </option>
                <option value="ASESOR" {{ request('role') == 'ASESOR' ? 'selected' : '' }}>
                    Asesor
                </option>
            </select>

            {{-- FILTER STATUS --}}
            <select name="status" id="status" 
                    class="h-[36px] rounded-[7px] border border-[#BCC9CB] bg-[#F7F9FC] px-3 text-[13px] text-[#434654] outline-none focus:border-[#006671]">
                <option value="">Semua Status</option>
                <option value="AKTIF" {{ request('status') == 'AKTIF' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="NONAKTIF" {{ request('status') == 'NONAKTIF' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>

            {{-- RESET --}}
            <a id="refreshFilter" href="{{ route('admin.user.index') }}" class="flex h-[36px] w-[36px] shrink-0 items-center justify-center rounded-[7px] text-[#008F8A] transition hover:bg-[#E6F7F6]" title="Reset filter">
                ↻
            </a>

        </form>
    </div>

            {{-- TABLE --}}
            <div id="userTable">
                @include('admin.user._table', ['users' => $users])
            </div>

            {{-- PAGINATION --}}
            <div class="flex flex-col gap-3 border-t border-[#D9D9D9] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                <p class="text-[12px] text-[#6D797B]">
                    @if ($users->total() > 0)
                        Menampilkan
                        {{ $users->firstItem() }}
                        -
                        {{ $users->lastItem() }}
                        dari
                        {{ $users->total() }}
                        data user
                    @else
                        Menampilkan 0 data user
                    @endif
                </p>

                <div>
                    {{ $users->links() }}
                </div>

            </div>

        </div>
    </div>

    <script>
    // ELEMENT HALAMAN
    const filterForm = document.getElementById('filterForm');
    const roleSelect = document.getElementById('role');
    const statusSelect = document.getElementById('status');
    const searchInput = document.getElementById('search');
    const userTable = document.getElementById('userTable');
    const refreshFilter = document.getElementById('refreshFilter');

    let searchTimer;

    // FUNGSI FILTER USER
    function filterUser(url = null) {
        // Kalau URL tidak diberikan, buat URL berdasarkan isi filter.
        const requestUrl = url ?? `${filterForm.action}?${new URLSearchParams(new FormData(filterForm))}`;

        fetch(requestUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
            .then(response => response.text())
            .then(html => {
                // Ubah response HTML menjadi dokumen sementara.
                const parser = new DOMParser();
                const documentHtml = parser.parseFromString(html, 'text/html');

                // Ambil bagian tabel dari response baru.
                const newTable = documentHtml.getElementById('userTable');

                // Ganti tabel lama dengan tabel hasil filter.
                if (newTable) {
                    userTable.innerHTML = newTable.innerHTML;
                }

                // Sesuaikan URL browser tanpa reload halaman.
                window.history.replaceState({}, '', requestUrl);
            })
            .catch(error => {
                console.error('Gagal memuat data user:', error);
            });
    }

    // FILTER ROLE
    roleSelect.addEventListener('change', function () {
        filterUser();
    });

    // FILTER STATUS
    statusSelect.addEventListener('change', function () {
        filterUser();
    });

    // SEARCH OTOMATIS
    searchInput.addEventListener('input', function () {
        // Batalkan timer sebelumnya supaya request tidak terlalu banyak.
        clearTimeout(searchTimer);

        // Tunggu 300ms setelah user berhenti mengetik.
        searchTimer = setTimeout(function () {
            filterUser();
        }, 300);
    });

    // PAGINATION AJAX
    userTable.addEventListener('click', function (event) {
        // Cari link yang diklik di dalam tabel.
        const link = event.target.closest('a[href]');

        if (!link) {
            return;
        }

        // Baca URL dari link pagination.
        const url = new URL(link.href, window.location.origin);

        // Hanya proses link yang memiliki parameter "page".
        if (!url.searchParams.has('page')) {
            return;
        }

        // Cegah browser melakukan reload halaman.
        event.preventDefault();

        // Ambil halaman berikutnya menggunakan AJAX.
        filterUser(link.href);
    });

    // RESET FILTER AJAX
    refreshFilter.addEventListener('click', function (event) {
        event.preventDefault();

        // Kembalikan semua filter ke kondisi awal.
        roleSelect.value = '';
        statusSelect.value = '';
        searchInput.value = '';

        // Ambil kembali seluruh data user dari halaman pertama.
        filterUser(filterForm.action);
    });
</script>

@endsection