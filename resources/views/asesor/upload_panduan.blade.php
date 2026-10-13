@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<style>
    .panduan-page {
        --card: #ffffff;
        --soft: #f8fafc;
        --soft-2: #f1f5f9;
        --text: #172033;
        --text-2: #334155;
        --muted: #64748b;
        --line: rgba(15, 23, 42, .07);

        --accent: #12a89d;
        --accent-hover: #0e8d84;
        --accent-soft: rgba(18, 168, 157, .08);
    }

    body.dark-mode .panduan-page {
        --card: #171e27;
        --soft: #1b2430;
        --soft-2: #202b38;
        --text: #f1f5f9;
        --text-2: #cbd5e1;
        --muted: #94a3b8;
        --line: rgba(255,255,255,.08);

        --accent: #20b8aa;
        --accent-hover: #2bc7b8;
        --accent-soft: rgba(32,184,170,.10);
    }

    .panduan-page {
        color: var(--text);
    }

    .p-card {
        background: var(--card);
        color: var(--text);
    }

    .p-soft {
        background: var(--soft);
        color: var(--text);
    }

    .p-text {
        color: var(--text) !important;
    }

    .p-text-2 {
        color: var(--text-2) !important;
    }

    .p-muted {
        color: var(--muted) !important;
    }

    .p-accent {
        color: var(--accent) !important;
    }

    .p-accent-bg {
        background: var(--accent-soft);
    }

    .p-main-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 1rem;
        box-shadow:
            0 1px 2px rgba(15,23,42,.025),
            0 8px 24px rgba(15,23,42,.025);
    }

    body.dark-mode .p-main-card {
        box-shadow:
            0 1px 2px rgba(0,0,0,.15),
            0 8px 24px rgba(0,0,0,.12);
    }

    .p-divider {
        height: 1px;
        background: var(--line);
    }

    /*
    |--------------------------------------------------------------------------
    | INPUT
    |--------------------------------------------------------------------------
    */

    .p-input {
        width: 100%;
        background: var(--card);
        color: var(--text) !important;
        border: 1px solid var(--line);
        border-radius: .7rem;
        transition: .2s ease;
    }

    .p-input::placeholder {
        color: var(--muted) !important;
        opacity: 1;
    }

    .p-input:focus {
        outline: none;
        border-color: rgba(18,168,157,.45);
        box-shadow: 0 0 0 3px var(--accent-soft);
    }

    /*
    |--------------------------------------------------------------------------
    | RADIO
    |--------------------------------------------------------------------------
    */

    .panduan-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .panduan-radio-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: .8rem;
        transition: .2s ease;
    }

    .panduan-radio-card:hover {
        background: var(--soft);
    }

    .panduan-radio:checked + .panduan-radio-card {
        background: var(--accent-soft);
        border-color: rgba(18,168,157,.4);
        box-shadow: 0 0 0 2px var(--accent-soft);
    }

    /*
    |--------------------------------------------------------------------------
    | DATA DUKUNG
    |--------------------------------------------------------------------------
    */

    .data-dukung-box {
        position: relative;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid rgba(15,23,42,.06);
        border-radius: .8rem;
        box-shadow: 0 2px 8px rgba(15,23,42,.025);
    }

    .data-dukung-box::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: var(--accent);
    }

    body.dark-mode .data-dukung-box {
        background: #1b2430;
        border-color: rgba(255,255,255,.06);
        box-shadow: none;
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD
    |--------------------------------------------------------------------------
    */

    .panduan-upload {
        background: var(--soft);
        border: 1px dashed rgba(100,116,139,.22);
        border-radius: .85rem;
        transition: .2s ease;
    }

    .panduan-upload:hover {
        background: var(--accent-soft);
        border-color: rgba(18,168,157,.45);
    }

    /*
    |--------------------------------------------------------------------------
    | FILE
    |--------------------------------------------------------------------------
    */

    .file-item {
        background: var(--soft);
        border-radius: .75rem;
        transition: .2s ease;
    }

    .file-item:hover {
        background: var(--soft-2);
    }

    /*
    |--------------------------------------------------------------------------
    | BUTTON
    |--------------------------------------------------------------------------
    */

    .p-btn-primary {
        background: var(--accent);
        color: #ffffff !important;
        transition: .2s ease;
    }

    .p-btn-primary:hover {
        background: var(--accent-hover);
    }

    .p-btn-secondary {
        background: transparent;
        color: var(--text-2) !important;
        border: 1px solid var(--line);
        transition: .2s ease;
    }

    .p-btn-secondary:hover {
        background: var(--soft);
        color: var(--text) !important;
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    .panduan-search {
        background: var(--soft);
        color: var(--text) !important;
        border: 1px solid transparent;
    }

    .panduan-search::placeholder {
        color: var(--muted);
    }

    .panduan-search:focus {
        background: var(--card);
        border-color: rgba(18,168,157,.35);
        outline: none;
        box-shadow: 0 0 0 3px var(--accent-soft);
    }

    /*
    |--------------------------------------------------------------------------
    | SCROLL
    |--------------------------------------------------------------------------
    */

    .panduan-scroll {
        scrollbar-width: thin;
        scrollbar-color: rgba(100,116,139,.25) transparent;
    }

    .panduan-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .panduan-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .panduan-scroll::-webkit-scrollbar-thumb {
        background: rgba(100,116,139,.25);
        border-radius: 999px;
    }
</style>


<div class="panduan-page w-full space-y-5">


    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div class="flex items-center gap-3">

            <div class="p-accent-bg flex h-11 w-11 shrink-0 items-center justify-center rounded-xl">
                <i class="fa-solid fa-book-open p-accent"></i>
            </div>

            <div>

                <h1 class="p-text text-[25px] font-bold tracking-tight">
                    {{ $editPanduan ? 'Edit Panduan & Template' : 'Upload Panduan & Template' }}
                </h1>

                <p class="p-muted mt-1 text-[13px]">
                    Kelola dokumen referensi untuk mendukung proses penilaian.
                </p>

            </div>

        </div>


        <a
            href="{{ url('/asesor/kelola_panduan') }}"
            class="p-btn-secondary inline-flex items-center justify-center gap-2 rounded-lg px-4 py-2.5 text-[12px] font-semibold"
        >

            <i class="fa-solid fa-arrow-left text-[10px]"></i>

            Kembali

        </a>

    </div>



    {{-- =========================================================
        SUCCESS
    ========================================================== --}}

    @if(session('success'))

        <div class="p-card rounded-xl px-4 py-3 shadow-sm">

            <div class="flex items-center gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">

                    <i class="fa-solid fa-check text-xs"></i>

                </div>

                <p class="text-[13px] font-medium text-emerald-700">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif



    {{-- =========================================================
        ERROR
    ========================================================== --}}

    @if($errors->any())

        <div class="p-card rounded-xl px-4 py-3 shadow-sm">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-600">

                    <i class="fa-solid fa-exclamation text-xs"></i>

                </div>

                <div>

                    <p class="text-[13px] font-semibold text-red-700">
                        Terjadi kesalahan
                    </p>

                    <ul class="mt-1.5 space-y-1 text-[12px] text-red-600">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif



    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}

    <div class="grid grid-cols-1 items-start gap-5 xl:grid-cols-3">


        {{-- =====================================================
            FORM
        ====================================================== --}}

        <div class="p-main-card overflow-hidden xl:col-span-2">


            {{-- HEADER --}}

            <div class="px-6 py-5">

                <div class="flex items-center gap-3">

                    <div class="p-accent-bg flex h-9 w-9 items-center justify-center rounded-lg">

                        <i class="fa-regular fa-file-lines p-accent text-sm"></i>

                    </div>

                    <div>

                        <h2 class="p-text text-[15px] font-bold">
                            Informasi Dokumen
                        </h2>

                        <p class="p-muted mt-0.5 text-[12px]">
                            {{ $editPanduan
                                ? 'Perbarui informasi dan file dokumen.'
                                : 'Lengkapi informasi dokumen yang akan ditambahkan.'
                            }}
                        </p>

                    </div>


                    @if($editPanduan)

                        <span class="ml-auto rounded-md bg-amber-50 px-2.5 py-1 text-[10px] font-bold text-amber-700">

                            <i class="fa-solid fa-pen mr-1 text-[8px]"></i>

                            MODE EDIT

                        </span>

                    @endif

                </div>

            </div>


            <div class="p-divider"></div>



            {{-- FORM --}}

            <form
                action="{{ route('asesor.panduan.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6 p-6"
            >

                @csrf


                @if($editPanduan)

                    <input
                        type="hidden"
                        name="edit_id"
                        value="{{ $editPanduan->id_panduan }}"
                    >

                @endif



                {{-- =================================================
                    01
                ================================================== --}}

                <section>

                    <div class="mb-4 flex items-center gap-2.5">

                        <div class="p-accent-bg flex h-7 w-7 shrink-0 items-center justify-center rounded-lg text-[10px] font-extrabold p-accent">
                            01
                        </div>

                        <div>

                            <h3 class="p-text text-[14px] font-bold">
                                Informasi Penilaian
                            </h3>

                            <p class="p-muted mt-0.5 text-[11px]">
                                Konteks penilaian yang terkait dengan dokumen.
                            </p>

                        </div>

                    </div>



                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">


                        {{-- ASPEK --}}

                        <div>

                            <label class="p-text mb-1.5 block text-[12px] font-semibold">

                                Aspek Penilaian

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="p-soft rounded-lg px-3.5 py-3 text-[12px]">

                                <span class="p-text font-semibold">
                                    Aspek {{ $aspek->nomor_aspek }}
                                </span>

                                <span class="p-muted">
                                    — {{ $aspek->nama_aspek }}
                                </span>

                            </div>


                            <input
                                type="hidden"
                                name="id_aspek"
                                value="{{ $aspek->id_aspek }}"
                            >

                        </div>



                        {{-- INDIKATOR --}}

                        <div>

                            <label class="p-text mb-1.5 block text-[12px] font-semibold">

                                Indikator Terkait

                                <span class="text-red-500">*</span>

                            </label>


                            <div class="p-soft rounded-lg px-3.5 py-3 text-[12px]">

                                <span class="p-text font-semibold">
                                    Indikator {{ $indikator->nomor_indikator }}
                                </span>

                                <span class="p-muted">
                                    — {{ $indikator->nama_indikator }}
                                </span>

                            </div>


                            <input
                                type="hidden"
                                name="id_indikator"
                                value="{{ $indikator->id_indikator }}"
                            >

                            @if($dataDukung)

                                <input
                                    type="hidden"
                                    name="id_data_dukung"
                                    value="{{ $dataDukung->id_data_dukung }}"
                                >

                            @endif

                        </div>

                    </div>



                    {{-- DATA DUKUNG --}}

                    @if($dataDukung)

                        <div class="data-dukung-box mt-4 p-4">

                            <div class="flex items-start gap-3">

                                <div class="p-accent-bg flex h-9 w-9 shrink-0 items-center justify-center rounded-lg">

                                    <i class="fa-solid fa-layer-group p-accent text-sm"></i>

                                </div>


                                <div class="min-w-0">

                                    <p class="p-accent text-[10px] font-bold uppercase tracking-[.08em]">
                                        Data Dukung
                                    </p>

                                    <p class="p-text mt-1 text-[14px] font-semibold leading-snug">
                                        {{ $dataDukung->nama_data_dukung }}
                                    </p>


                                    @if($dataDukung->deskripsi)

                                        <p class="p-text-2 mt-1.5 text-[12px] leading-relaxed">
                                            {{ $dataDukung->deskripsi }}
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endif

                </section>



                <div class="p-divider"></div>



                {{-- =================================================
                    02
                ================================================== --}}

                <section>

                    <div class="mb-4 flex items-center gap-2.5">

                        <div class="p-accent-bg flex h-7 w-7 shrink-0 items-center justify-center rounded-lg text-[10px] font-extrabold p-accent">
                            02
                        </div>

                        <div>

                            <h3 class="p-text text-[14px] font-bold">
                                Detail Dokumen
                            </h3>

                            <p class="p-muted mt-0.5 text-[11px]">
                                Tentukan nama dan jenis dokumen.
                            </p>

                        </div>

                    </div>



                    {{-- JUDUL --}}

                    <div class="mb-5">

                        <label class="p-text mb-1.5 block text-[12px] font-semibold">

                            Judul Panduan / Template

                            <span class="text-red-500">*</span>

                        </label>


                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul', $editPanduan->judul ?? ($dataDukung->nama_data_dukung ?? '')) }}"
                            required
                            maxlength="255"
                            class="p-input px-3.5 py-3 text-[12px]"
                            placeholder="{{ $dataDukung->nama_data_dukung }}"
                        >

                    </div>



                    {{-- TIPE --}}

                    <div>

                        <label class="p-text mb-2 block text-[12px] font-semibold">

                            Jenis Dokumen

                            <span class="text-red-500">*</span>

                        </label>


                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">


                            {{-- PANDUAN --}}

                            <label class="relative block cursor-pointer">

                                <input
                                    type="radio"
                                    name="tipe"
                                    value="PANDUAN"
                                    class="panduan-radio"
                                    {{ old('tipe', $editPanduan?->tipe ?? ($defaultTipe ?? '')) === 'PANDUAN' ? 'checked' : '' }}
                                    {{ $hasPanduan && !$editPanduan ? 'disabled' : '' }}
                                >


                                <div class="panduan-radio-card p-4">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-500">

                                            <i class="fa-regular fa-file-pdf"></i>

                                        </div>


                                        <div class="min-w-0">

                                            <p class="p-text text-[13px] font-bold">
                                                Panduan
                                            </p>

                                            <p class="p-muted mt-0.5 text-[11px]">
                                                Dokumen panduan penggunaan
                                            </p>


                                            @if($hasPanduan && !$editPanduan)

                                                <span class="mt-1.5 inline-flex items-center gap-1 text-[10px] font-semibold text-red-500">

                                                    <i class="fa-solid fa-circle-check text-[8px]"></i>

                                                    Sudah diupload

                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </label>



                            {{-- TEMPLATE --}}

                            <label class="relative block cursor-pointer">

                                <input
                                    type="radio"
                                    name="tipe"
                                    value="TEMPLATE"
                                    class="panduan-radio"
                                    {{ old('tipe', $editPanduan?->tipe ?? ($defaultTipe ?? '')) === 'TEMPLATE' ? 'checked' : '' }}
                                    {{ $hasTemplate && !$editPanduan ? 'disabled' : '' }}
                                >


                                <div class="panduan-radio-card p-4">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-500">

                                            <i class="fa-regular fa-file-word"></i>

                                        </div>


                                        <div class="min-w-0">

                                            <p class="p-text text-[13px] font-bold">
                                                Template
                                            </p>

                                            <p class="p-muted mt-0.5 text-[11px]">
                                                Word atau Excel yang dapat digunakan
                                            </p>


                                            @if($hasTemplate && !$editPanduan)

                                                <span class="mt-1.5 inline-flex items-center gap-1 text-[10px] font-semibold text-red-500">

                                                    <i class="fa-solid fa-circle-check text-[8px]"></i>

                                                    Sudah diupload

                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </label>

                        </div>

                    </div>

                </section>



                {{-- =================================================
                    EXISTING FILE
                ================================================== --}}

                @php

                    $existingFiles = $panduanList->where(
                        'id_data_dukung',
                        $dataDukung->id_data_dukung
                    );

                    $bothUploaded = $hasPanduan && $hasTemplate && !$editPanduan;

                @endphp


                @if($existingFiles->count() > 0)

                    <div class="p-soft rounded-xl p-4">

                        <div class="mb-3 flex items-center justify-between gap-3">

                            <div class="flex items-center gap-2.5">

                                <div class="p-accent-bg flex h-8 w-8 items-center justify-center rounded-lg">

                                    <i class="fa-solid fa-paperclip p-accent text-xs"></i>

                                </div>


                                <div>

                                    <p class="p-text text-[13px] font-bold">
                                        File Terpasang
                                    </p>

                                    <p class="p-muted mt-0.5 text-[11px]">
                                        Dokumen yang sudah tersedia
                                    </p>

                                </div>

                            </div>


                            <span class="rounded-md bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-600">

                                {{ $existingFiles->count() }} File

                            </span>

                        </div>



                        <div class="space-y-2">

                            @foreach($existingFiles as $itemFile)

                                @php

                                    $ext = strtolower(
                                        pathinfo(
                                            $itemFile->file_name ?? '',
                                            PATHINFO_EXTENSION
                                        )
                                    );

                                @endphp


                                <div class="file-item flex items-center justify-between gap-3 p-3">

                                    <div class="flex min-w-0 items-center gap-3">

                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white dark:bg-white/5">

                                            @if($ext === 'pdf')

                                                <i class="fa-regular fa-file-pdf text-red-500"></i>

                                            @elseif(in_array($ext, ['doc', 'docx']))

                                                <i class="fa-regular fa-file-word text-blue-500"></i>

                                            @elseif(in_array($ext, ['xls', 'xlsx']))

                                                <i class="fa-regular fa-file-excel text-green-500"></i>

                                            @else

                                                <i class="fa-regular fa-file p-muted"></i>

                                            @endif

                                        </div>


                                        <div class="min-w-0">

                                            <div class="flex items-center gap-2">

                                                <p class="p-text truncate text-[12px] font-semibold">
                                                    {{ $itemFile->file_name ?? $itemFile->judul }}
                                                </p>

                                                <span class="shrink-0 rounded bg-amber-50 px-1.5 py-0.5 text-[9px] font-bold uppercase text-amber-700">
                                                    {{ $itemFile->tipe }}
                                                </span>

                                            </div>

                                            <p class="p-muted mt-0.5 text-[10px] uppercase">
                                                {{ $ext ?: 'FILE' }}
                                            </p>

                                        </div>

                                    </div>



                                    <div class="flex shrink-0 items-center gap-1.5">

                                        @if($itemFile->file_exists && $itemFile->file_url)

                                            <a
                                                href="{{ route('asesor.panduan.file', ['id' => $itemFile->id_panduan]) }}"
                                                target="_blank"
                                                title="Lihat file"
                                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-teal-50 text-teal-600 transition hover:bg-teal-100"
                                            >
                                                <i class="fa-regular fa-eye text-xs"></i>
                                            </a>

                                        @endif


                                        <a
                                            href="{{ route('asesor.panduan.upload', [
                                                'idAspek' => $aspek->id_aspek,
                                                'idIndikator' => $indikator->id_indikator,
                                                'idDataDukung' => $dataDukung->id_data_dukung,
                                                'edit' => $itemFile->id_panduan
                                            ]) }}"
                                            title="Edit file"
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-600 transition hover:bg-slate-200"
                                        >
                                            <i class="fa-regular fa-pen-to-square text-xs"></i>
                                        </a>


                                        <button
                                            type="button"
                                            title="Hapus file"
                                            onclick="if(confirm('Hapus file {{ addslashes($itemFile->judul) }}?')) document.getElementById('delete-file-form-{{ $itemFile->id_panduan }}').submit();"
                                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-50 text-red-600 transition hover:bg-red-100"
                                        >
                                            <i class="fa-regular fa-trash-can text-xs"></i>
                                        </button>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif



                {{-- =================================================
                    03 FILE
                ================================================== --}}

                <section>

                    <div class="mb-3 flex items-center gap-2.5">

                        <div class="p-accent-bg flex h-7 w-7 shrink-0 items-center justify-center rounded-lg text-[10px] font-extrabold p-accent">
                            03
                        </div>

                        <div>

                            <h3 class="p-text text-[14px] font-bold">
                                File Dokumen
                            </h3>

                            <p class="p-muted mt-0.5 text-[11px]">
                                Pilih file yang akan disimpan.
                            </p>

                        </div>

                    </div>



                    <label
                        for="file"
                        id="upload-box"
                        class="panduan-upload block p-7 text-center {{ $bothUploaded ? 'cursor-not-allowed opacity-50' : 'cursor-pointer' }}"
                    >

                        <div
                            id="upload-icon"
                            class="p-accent-bg mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-xl"
                        >

                            <i class="fa-solid fa-cloud-arrow-up p-accent text-lg"></i>

                        </div>


                        <p
                            id="file-name"
                            class="p-text text-[13px] font-semibold"
                        >

                            @if($bothUploaded)

                                Panduan & Template sudah lengkap

                            @elseif($editPanduan)

                                {{ $editPanduan->file_name ?? 'Klik untuk mengganti file' }}

                            @else

                                Pilih jenis dokumen terlebih dahulu

                            @endif

                        </p>


                        <p class="p-muted mt-1.5 text-[11px]">
                            Maksimal ukuran 10MB
                        </p>

                        <p class="p-muted text-[11px]">
                            PDF, DOC, DOCX, XLS, XLSX
                        </p>


                        <input
                            type="file"
                            name="file"
                            id="file"
                            class="hidden"
                            accept=".pdf,.doc,.docx,.xls,.xlsx"
                            {{ $bothUploaded ? 'disabled' : '' }}
                            {{ $editPanduan ? '' : 'required' }}
                        >

                    </label>

                </section>



                {{-- =================================================
                    DESKRIPSI
                ================================================== --}}

                <section>

                    <label class="p-text mb-1.5 block text-[12px] font-semibold">
                        Instruksi Tambahan / Deskripsi
                    </label>


                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="p-input resize-none p-3 text-[12px]"
                        placeholder="Masukkan deskripsi singkat atau instruksi penggunaan dokumen..."
                    >{{ old('deskripsi', $editPanduan->deskripsi ?? '') }}</textarea>

                </section>



                {{-- =================================================
                    ACTION
                ================================================== --}}

                <div class="p-divider"></div>


                <div class="flex flex-col-reverse gap-3 pt-1 sm:flex-row sm:items-center sm:justify-between">

                    <p class="p-muted text-[11px]">

                        <i class="fa-solid fa-circle-info mr-1"></i>

                        Pastikan file sesuai dengan jenis dokumen.

                    </p>


                    <div class="flex justify-end gap-2.5">

                        <a
                            href="{{ url('/asesor/kelola_panduan') }}"
                            class="p-btn-secondary rounded-lg px-4 py-2.5 text-[12px] font-semibold"
                        >
                            Batal
                        </a>


                        <button
                            type="submit"
                            id="submit-btn"
                            class="p-btn-primary rounded-lg px-5 py-2.5 text-[12px] font-semibold shadow-sm disabled:cursor-not-allowed disabled:opacity-50"
                            {{ $bothUploaded ? 'disabled' : '' }}
                        >

                            <i class="fa-solid fa-{{ $editPanduan ? 'pen-to-square' : 'upload' }} mr-1.5"></i>

                            {{ $editPanduan ? 'Update Dokumen' : 'Simpan Dokumen' }}

                        </button>

                    </div>

                </div>

            </form>



            {{-- DELETE FORMS --}}

            @if(isset($existingFiles))

                @foreach($existingFiles as $itemFile)

                    <form
                        id="delete-file-form-{{ $itemFile->id_panduan }}"
                        action="{{ route('asesor.panduan.destroy', ['id' => $itemFile->id_panduan]) }}"
                        method="POST"
                        class="hidden"
                    >

                        @csrf

                        @method('DELETE')

                    </form>

                @endforeach

            @endif

        </div>



        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <div class="p-main-card p-5 xl:sticky xl:top-5">

            <div class="mb-4 flex items-start justify-between gap-3">

                <div class="flex items-center gap-2.5">

                    <div class="p-accent-bg flex h-8 w-8 items-center justify-center rounded-lg">

                        <i class="fa-solid fa-folder-open p-accent text-xs"></i>

                    </div>


                    <div>

                        <h3 class="p-text text-[14px] font-bold">
                            Dokumen Tersedia
                        </h3>

                        <p class="p-muted mt-0.5 text-[11px]">
                            Untuk indikator ini
                        </p>

                    </div>

                </div>


                <span class="rounded-md bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-600">

                    {{ $panduanList->count() }} Aktif

                </span>

            </div>



            {{-- SEARCH --}}

            <div class="relative mb-4">

                <i class="fa-solid fa-magnifying-glass p-muted absolute left-3 top-3 text-[10px]"></i>

                <input
                    type="text"
                    id="searchPanduan"
                    placeholder="Cari dokumen..."
                    class="panduan-search w-full rounded-lg py-2.5 pl-8 pr-3 text-[11px]"
                >

            </div>



            {{-- LIST --}}

            <div
                id="panduanContainer"
                class="panduan-scroll max-h-[640px] space-y-1 overflow-y-auto pr-1"
            >

                @forelse($panduanList as $panduan)

                    <a
                        href="{{ route('asesor.panduan.upload', [
                            'idAspek' => $aspek->id_aspek,
                            'idIndikator' => $indikator->id_indikator,
                            'idDataDukung' => $panduan->id_data_dukung,
                            'edit' => $panduan->id_panduan
                        ]) }}"
                        class="panduan-item block rounded-xl p-3.5 transition hover:bg-teal-50/60 dark:hover:bg-teal-950/10"
                        data-search="{{ strtolower($panduan->judul . ' ' . ($panduan->nama_indikator ?? '') . ' ' . $panduan->tipe) }}"
                    >

                        <div class="mb-2 flex items-center justify-between gap-2">

                            <span class="inline-flex items-center gap-1 rounded-md bg-teal-50 px-2 py-1 text-[9px] font-bold uppercase text-teal-700">

                                <i class="fa-regular fa-file text-[8px]"></i>

                                {{ $panduan->tipe }}

                            </span>


                            @if($panduan->file_exists)

                                <i class="fa-solid fa-circle-check text-[10px] text-emerald-500"></i>

                            @endif

                        </div>



                        <h4 class="p-text mb-1 text-[12px] font-bold leading-relaxed">

                            {{ $panduan->judul }}

                        </h4>



                        @if($panduan->nama_indikator)

                            <p class="p-muted mb-2 text-[10px] leading-relaxed">

                                Indikator {{ $panduan->nomor_indikator }}

                                — {{ $panduan->nama_indikator }}

                            </p>

                        @endif



                        @php

                            $extension = strtolower(
                                pathinfo(
                                    $panduan->file_name ?? '',
                                    PATHINFO_EXTENSION
                                )
                            );

                        @endphp


                        <span class="inline-flex items-center gap-1 rounded-md bg-white px-2 py-1 text-[9px] shadow-sm dark:bg-white/5">

                            @if($extension === 'pdf')

                                <i class="fa-regular fa-file-pdf text-red-500"></i>

                            @elseif(in_array($extension, ['doc', 'docx']))

                                <i class="fa-regular fa-file-word text-blue-500"></i>

                            @elseif(in_array($extension, ['xls', 'xlsx']))

                                <i class="fa-regular fa-file-excel text-green-500"></i>

                            @else

                                <i class="fa-regular fa-file p-muted"></i>

                            @endif

                            {{ strtoupper($extension ?: 'FILE') }}

                        </span>

                    </a>

                @empty

                    <div class="py-12 text-center">

                        <div class="mx-auto mb-3 flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100 p-muted dark:bg-white/5">

                            <i class="fa-regular fa-folder-open"></i>

                        </div>


                        <p class="p-text text-[13px] font-semibold">
                            Belum ada dokumen
                        </p>


                        <p class="p-muted mt-1 text-[11px] leading-relaxed">
                            Panduan atau template untuk indikator ini akan muncul di sini.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>



<script>
document.addEventListener('DOMContentLoaded', function () {

    const fileInput = document.getElementById('file');
    const fileName = document.getElementById('file-name');
    const uploadIcon = document.getElementById('upload-icon');
    const uploadBox = document.getElementById('upload-box');

    const radioTipas = document.querySelectorAll('.panduan-radio');

    const isEditMode = @json((bool) $editPanduan);
    const bothUploaded = @json((bool) $bothUploaded);


    function checkFileAvailability() {

        if (!fileInput) {
            return;
        }


        if (bothUploaded) {

            fileInput.disabled = true;

            return;
        }


        const selectedRadio =
            document.querySelector('.panduan-radio:checked');


        if (!selectedRadio && !isEditMode) {

            fileInput.disabled = true;

            uploadBox.classList.add(
                'cursor-not-allowed',
                'opacity-50'
            );


            if (!fileInput.files.length) {

                fileName.textContent =
                    'Pilih jenis dokumen terlebih dahulu';

            }

        } else {

            fileInput.disabled = false;

            uploadBox.classList.remove(
                'cursor-not-allowed',
                'opacity-50'
            );


            if (!fileInput.files.length) {

                fileName.textContent =
                    isEditMode
                        ? 'Klik untuk mengganti file'
                        : 'Klik untuk upload file';

            }

        }

    }


    checkFileAvailability();



    radioTipas.forEach(function (radio) {

        radio.addEventListener('change', function () {

            checkFileAvailability();


            if (this.value === 'PANDUAN') {

                uploadIcon.innerHTML =
                    '<i class="fa-regular fa-file-pdf text-lg text-red-500"></i>';

            }


            if (this.value === 'TEMPLATE') {

                uploadIcon.innerHTML =
                    '<i class="fa-regular fa-file-word text-lg text-blue-500"></i>';

            }

        });

    });



    if (fileInput) {

        fileInput.addEventListener('change', function () {

            if (!this.files.length) {

                checkFileAvailability();

                return;

            }


            const file = this.files[0];

            fileName.textContent = file.name;


            const extension =
                file.name
                    .split('.')
                    .pop()
                    .toLowerCase();


            if (extension === 'pdf') {

                uploadIcon.innerHTML =
                    '<i class="fa-regular fa-file-pdf text-lg text-red-500"></i>';

            } else if (
                ['doc', 'docx'].includes(extension)
            ) {

                uploadIcon.innerHTML =
                    '<i class="fa-regular fa-file-word text-lg text-blue-500"></i>';

            } else if (
                ['xls', 'xlsx'].includes(extension)
            ) {

                uploadIcon.innerHTML =
                    '<i class="fa-regular fa-file-excel text-lg text-green-500"></i>';

            } else {

                uploadIcon.innerHTML =
                    '<i class="fa-regular fa-file text-lg p-muted"></i>';

            }

        });

    }



    const searchInput =
        document.getElementById('searchPanduan');

    const panduanItems =
        document.querySelectorAll('.panduan-item');


    if (searchInput) {

        searchInput.addEventListener('input', function () {

            const keyword =
                this.value.toLowerCase().trim();


            panduanItems.forEach(function (item) {

                const text =
                    item.dataset.search || '';


                item.style.display =
                    text.includes(keyword)
                        ? ''
                        : 'none';

            });

        });

    }

});
</script>

@endsection