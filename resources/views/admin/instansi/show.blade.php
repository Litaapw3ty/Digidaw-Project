@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- HEADER HALAMAN --}}
    <div>
        <a href="{{ route('admin.instansi.index') }}"
           class="inline-flex items-center gap-2 text-[13px] font-medium text-[#0D9488] transition hover:text-[#00694D]">
            ← Kembali
        </a>

        <h1 class="mt-5 text-[28px] font-semibold leading-tight text-[#081C30]">
            Detail Instansi
        </h1>

        <div class="mt-2 flex items-center gap-3 text-[14px]">
            <span class="text-[#64748B]">Data Master</span>
            <span class="text-[#94A3B8]">›</span>
            <span class="text-[#64748B]">Instansi</span>
            <span class="text-[#94A3B8]">›</span>
            <span class="font-medium text-[#0D9488]">
                Detail Instansi
            </span>
        </div>
    </div>


    {{-- HEADER INFORMASI INSTANSI --}}
    <div class="mt-6 rounded-[12px] border border-[#BCC9CB] bg-[#F7F9FF] p-6">

        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            {{-- Identitas Instansi --}}
            <div class="flex items-center gap-5">

                {{-- Icon --}}
                <div class="flex h-[88px] w-[88px] shrink-0 items-center justify-center rounded-full bg-[#DCE4FF] text-[36px]">
                    🏢
                </div>

                {{-- Informasi --}}
                <div>

                    <div class="flex flex-wrap items-center gap-3">

                        <h2 class="text-[22px] font-semibold text-[#081C30]">
                            {{ $instansi->nama_instansi }}
                        </h2>

                        @if ($instansi->status === 'AKTIF')
                            <span class="rounded-full bg-[#DCFCE7] px-3 py-1 text-[11px] font-medium text-[#15803D]">
                                Aktif
                            </span>
                        @else
                            <span class="rounded-full bg-[#FFE3E0] px-3 py-1 text-[11px] font-medium text-[#BA1A1A]">
                                Nonaktif
                            </span>
                        @endif

                    </div>

                    <p class="mt-2 text-[14px] text-[#3E4943]">
                        {{ $instansi->kategori }}
                    </p>

                    <div class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-[13px] text-[#3E4943]">

                        <span>
                            <strong class="font-semibold text-[#081C30]">
                                Kode Instansi:
                            </strong>
                            {{ $instansi->kode_instansi }}
                        </span>

                        @if ($instansi->email)
                            <span class="text-[#BCC9CB]">|</span>
                            <span>{{ $instansi->email }}</span>
                        @endif

                        @if ($instansi->telepon)
                            <span class="text-[#BCC9CB]">|</span>
                            <span>{{ $instansi->telepon }}</span>
                        @endif

                    </div>

                </div>
            </div>


            {{-- Tombol Edit --}}
            <div class="shrink-0">

                <a href="{{ route('admin.instansi.edit', $instansi->id_instansi) }}"
                   class="inline-flex items-center gap-2 rounded-[8px] border border-[#0D9488] px-5 py-2.5 text-[13px] font-medium text-[#0D9488] transition hover:bg-[#EFFFFD]">

                    <span>✎</span>
                    Edit Instansi

                </a>

            </div>

        </div>
    </div>


    {{-- AREA DETAIL --}}
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,1.65fr)_minmax(320px,1fr)]">


        {{-- ======================================== --}}
        {{-- KOLOM KIRI --}}
        {{-- ======================================== --}}
        <div class="space-y-6">


            {{-- INFORMASI INSTANSI --}}
            <div class="rounded-[12px] border border-[#BCC9CB] bg-[#F7F9FF] p-6">

                <h2 class="text-[18px] font-semibold text-[#081C30]">
                    Informasi Instansi
                </h2>


                <div class="mt-7 space-y-5 text-[14px]">

                    {{-- Nama Instansi --}}
                    <div class="grid grid-cols-[180px_20px_minmax(0,1fr)] gap-2">

                        <span class="text-[#3E4943]">
                            Nama Instansi
                        </span>

                        <span class="text-[#3E4943]">
                            :
                        </span>

                        <span class="font-medium text-[#081C30]">
                            {{ $instansi->nama_instansi }}
                        </span>

                    </div>


                    {{-- Kode Instansi --}}
                    <div class="grid grid-cols-[180px_20px_minmax(0,1fr)] gap-2">

                        <span class="text-[#3E4943]">
                            Kode Instansi
                        </span>

                        <span class="text-[#3E4943]">
                            :
                        </span>

                        <span class="font-medium text-[#081C30]">
                            {{ $instansi->kode_instansi }}
                        </span>

                    </div>


                    {{-- Kategori --}}
                    <div class="grid grid-cols-[180px_20px_minmax(0,1fr)] gap-2">

                        <span class="text-[#3E4943]">
                            Kategori
                        </span>

                        <span class="text-[#3E4943]">
                            :
                        </span>

                        <span class="font-medium text-[#081C30]">
                            {{ $instansi->kategori }}
                        </span>

                    </div>


                    {{-- Website --}}
                    <div class="grid grid-cols-[180px_20px_minmax(0,1fr)] gap-2">

                        <span class="text-[#3E4943]">
                            Website
                        </span>

                        <span class="text-[#3E4943]">
                            :
                        </span>

                        <span class="font-medium text-[#081C30]">
                            {{ $instansi->website ?: '-' }}
                        </span>

                    </div>


                    {{-- Alamat --}}
                    <div class="grid grid-cols-[180px_20px_minmax(0,1fr)] gap-2">

                        <span class="text-[#3E4943]">
                            Alamat
                        </span>

                        <span class="text-[#3E4943]">
                            :
                        </span>

                        <span class="font-medium leading-6 text-[#081C30]">
                            {{ $instansi->alamat ?? '-' }}
                        </span>

                    </div>


                    {{-- Status --}}
                    <div class="grid grid-cols-[180px_20px_minmax(0,1fr)] items-center gap-2">

                        <span class="text-[#3E4943]">
                            Status
                        </span>

                        <span class="text-[#3E4943]">
                            :
                        </span>

                        <span>
                            @if ($instansi->status === 'AKTIF')

                                <span class="inline-flex items-center gap-2 rounded-[6px] border border-[#BBF7D0] bg-[#F0FDF4] px-3 py-1.5 text-[12px] font-medium text-[#15803D]">
                                    <span class="h-2 w-2 rounded-full bg-[#22C55E]"></span>
                                    Aktif
                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 rounded-[6px] border border-[#FECACA] bg-[#FEF2F2] px-3 py-1.5 text-[12px] font-medium text-[#BA1A1A]">
                                    <span class="h-2 w-2 rounded-full bg-[#EF4444]"></span>
                                    Nonaktif
                                </span>

                            @endif
                        </span>

                    </div>


                    {{-- Tanggal Dibuat --}}
                    <div class="grid grid-cols-[180px_20px_minmax(0,1fr)] gap-2">

                        <span class="text-[#3E4943]">
                            Tanggal Dibuat
                        </span>

                        <span class="text-[#3E4943]">
                            :
                        </span>

                        <span class="font-medium text-[#081C30]">
                            {{ $instansi->created_at?->format('d F Y H:i') ?? '-' }}
                        </span>

                    </div>


                    {{-- Terakhir Diperbarui --}}
                    <div class="grid grid-cols-[180px_20px_minmax(0,1fr)] gap-2">

                        <span class="text-[#3E4943]">
                            Terakhir Diperbarui
                        </span>

                        <span class="text-[#3E4943]">
                            :
                        </span>

                        <span class="font-medium text-[#081C30]">
                            {{ $instansi->updated_at?->format('d F Y H:i') ?? '-' }}
                        </span>

                    </div>

                </div>
            </div>


            {{-- RINGKASAN --}}
            <div class="rounded-[12px] border border-[#BCC9CB] bg-[#F7F9FF] p-6">

                <h2 class="text-[18px] font-semibold text-[#081C30]">
                    Ringkasan
                </h2>


                <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">


                    {{-- Contact Person Aktif --}}
                    <div class="rounded-[10px] border border-[#D3E4FE] bg-[#EFF4FF] p-5">

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DCE4FF] text-[17px] text-[#0D9488]">
                            👤
                        </div>

                        <p class="mt-4 text-[28px] font-semibold leading-none text-[#081C30]">
                            -
                        </p>

                        <p class="mt-2 text-[13px] leading-5 text-[#3E4943]">
                            Contact Person<br>
                            Aktif
                        </p>

                    </div>


                    {{-- Pengajuan Total --}}
                    <div class="rounded-[10px] border border-[#D3E4FE] bg-[#EFF4FF] p-5">

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DCE4FF] text-[17px] text-[#0D9488]">
                            📄
                        </div>

                        <p class="mt-4 text-[28px] font-semibold leading-none text-[#081C30]">
                            -
                        </p>

                        <p class="mt-2 text-[13px] leading-5 text-[#3E4943]">
                            Pengajuan<br>
                            Total
                        </p>

                    </div>


                    {{-- Penilaian Selesai --}}
                    <div class="rounded-[10px] border border-[#D3E4FE] bg-[#EFF4FF] p-5">

                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DCE4FF] text-[17px] text-[#0D9488]">
                            ✓
                        </div>

                        <p class="mt-4 text-[28px] font-semibold leading-none text-[#081C30]">
                            -
                        </p>

                        <p class="mt-2 text-[13px] leading-5 text-[#3E4943]">
                            Penilaian Selesai<br>
                            Total
                        </p>

                    </div>

                </div>
            </div>

        </div>


        {{-- ======================================== --}}
        {{-- KOLOM KANAN --}}
        {{-- ======================================== --}}
        <div class="space-y-6">


            {{-- CONTACT PERSON --}}
            <div class="rounded-[12px] border border-[#BCC9CB] bg-[#F7F9FF] p-6">

                <div class="flex items-center justify-between gap-3">

                    <h2 class="text-[18px] font-semibold text-[#081C30]">
                        Contact Person
                        <br>
                        (CP)
                    </h2>

                    <button type="button"
                            class="rounded-[8px] border border-[#0D9488] px-4 py-2 text-[12px] font-medium text-[#0D9488] transition hover:bg-[#EFFFFD]">
                        + Tambah CP
                    </button>

                </div>


                {{-- Card CP --}}
                <div class="mt-6 rounded-[10px] border border-[#D9E2E8] bg-white p-4">

                    <div class="flex items-start gap-4">

                        {{-- Foto --}}
                        <div class="flex h-[70px] w-[70px] shrink-0 items-center justify-center overflow-hidden rounded-full bg-[#DCE4FF]">
                            <span class="text-[25px]">
                                👤
                            </span>
                        </div>


                        {{-- Informasi CP --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex flex-wrap items-center gap-2">

                                <h3 class="text-[16px] font-semibold text-[#081C30]">
                                    -
                                </h3>

                                <span class="rounded-[5px] bg-[#D9E5E2] px-2 py-1 text-[10px] font-medium text-[#3E4943]">
                                    CP Utama
                                </span>

                            </div>

                            <p class="mt-1 text-[13px] text-[#3E4943]">
                                -
                            </p>

                            <p class="mt-2 text-[12px] text-[#3E4943]">
                                ✉ &nbsp; -
                            </p>

                            <p class="mt-1 text-[12px] text-[#3E4943]">
                                ♧ &nbsp; -
                            </p>

                        </div>

                    </div>


                    {{-- Detail User --}}
                    <button type="button"
                            class="mt-4 h-[40px] w-full rounded-[7px] border border-[#7C8983] bg-white text-[13px] font-medium text-[#3E4943] transition hover:bg-[#F7F9FF]">
                        Lihat Detail User
                    </button>

                </div>

            </div>


            {{-- AKTIVITAS TERAKHIR --}}
            <div class="rounded-[12px] border border-[#BCC9CB] bg-[#F7F9FF] p-6">

                <h2 class="text-[18px] font-semibold text-[#081C30]">
                    Aktivitas Terakhir
                </h2>


                <div class="mt-6">

                    <div class="relative">

                        {{-- Garis timeline --}}
                        <div class="absolute bottom-3 left-[7px] top-3 w-px bg-[#D9E5E2]"></div>


                        {{-- Aktivitas 1 --}}
                        <div class="relative flex gap-4 pb-6">

                            <div class="relative z-10 mt-1 h-4 w-4 shrink-0 rounded-full border-4 border-[#F7F9FF] bg-[#0D9488]"></div>

                            <div class="flex-1 rounded-[9px] border border-[#D9E2E8] bg-white px-4 py-4">

                                <div class="flex items-center justify-between gap-3">

                                    <p class="text-[13px] font-medium text-[#081C30]">
                                        Aktivitas akan ditampilkan
                                    </p>

                                    <span class="text-[#64748B]">
                                        ›
                                    </span>

                                </div>

                                <p class="mt-1 text-[12px] text-[#3E4943]">
                                    Data aktivitas akan diambil dari audit log.
                                </p>

                                <p class="mt-2 text-[11px] text-[#64748B]">
                                    -
                                </p>

                            </div>

                        </div>


                        {{-- Aktivitas 2 --}}
                        <div class="relative flex gap-4 pb-6">

                            <div class="relative z-10 mt-1 h-4 w-4 shrink-0 rounded-full border-4 border-[#F7F9FF] bg-[#0D9488]"></div>

                            <div class="flex-1 rounded-[9px] border border-[#D9E2E8] bg-white px-4 py-4">

                                <div class="flex items-center justify-between gap-3">

                                    <p class="text-[13px] font-medium text-[#081C30]">
                                        Riwayat aktivitas
                                    </p>

                                    <span class="text-[#64748B]">
                                        ›
                                    </span>

                                </div>

                                <p class="mt-1 text-[12px] text-[#3E4943]">
                                    Timeline akan menampilkan aktivitas terbaru instansi.
                                </p>

                                <p class="mt-2 text-[11px] text-[#64748B]">
                                    -
                                </p>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection