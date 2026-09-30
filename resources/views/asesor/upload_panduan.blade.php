@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full space-y-6">

    {{-- Header --}}

    <div>
        <h1 class="text-3xl font-bold theme-title tracking-tight">
            Upload Panduan & Template
        </h1>

        <p class="text-lg font-normal theme-muted mt-1.5">
            Tambahkan panduan atau template yang dapat digunakan sebagai referensi dalam proses penilaian.
        </p>
    </div>


    {{-- Success Message --}}

    @if(session('success'))

        <div class="theme-card border theme-border rounded-xl px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-950/50 text-green-600 dark:text-green-400 flex items-center justify-center">
                    <i class="fa-solid fa-check"></i>
                </div>

                <p class="text-sm font-medium text-green-700 dark:text-green-400">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- Validation Error --}}

    @if($errors->any())

        <div class="theme-card border border-red-200 dark:border-red-900/60 rounded-xl px-4 py-3">

            <div class="flex items-start gap-3">

                <div class="w-8 h-8 rounded-lg bg-red-100 dark:bg-red-950/50 text-red-600 dark:text-red-400 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-exclamation"></i>
                </div>

                <div>

                    <p class="text-sm font-semibold text-red-700 dark:text-red-400 mb-1">
                        Terjadi kesalahan
                    </p>

                    <ul class="text-xs text-red-600 dark:text-red-300 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- Content --}}

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


        {{-- ============================================= --}}
        {{-- FORM UTAMA --}}
        {{-- ============================================= --}}

        <div class="lg:col-span-2 theme-card border theme-border rounded-2xl p-6 shadow-sm">

            <div class="flex items-center gap-3 pb-4 border-b theme-border">

                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950/50 text-blue-600 dark:text-blue-400 flex items-center justify-center">

                    <i class="fa-regular fa-file-lines text-lg"></i>

                </div>

                <div>

                    <h2 class="font-bold theme-title text-base">
                        {{ $editPanduan ? 'Edit Panduan & Template' : 'Detail Panduan & Template' }}
                    </h2>

                    <p class="text-xs theme-muted mt-0.5">
                        {{ $editPanduan ? 'Perbarui informasi atau file dokumen.' : 'Lengkapi informasi dokumen yang akan ditambahkan.' }}
                    </p>

                </div>

            </div>


            <form
                action="{{ route('asesor.panduan.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5 mt-6"
            >

                @csrf

                @if($editPanduan)
                    <input type="hidden" name="edit_id" value="{{ $editPanduan->id_panduan }}">
                @endif


                {{-- Aspek & Indikator --}}

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                    {{-- Aspek --}}

                    <div>

                        <label class="block text-xs font-semibold theme-title mb-1.5">

                            Aspek Penilaian

                            <span class="text-red-500">*</span>

                        </label>

                        <div class="theme-input w-full rounded-lg px-3 py-2.5 text-sm">

                            Aspek {{ $aspek->nomor_aspek }}
                            :
                            {{ $aspek->nama_aspek }}

                        </div>

                        <input
                            type="hidden"
                            name="id_aspek"
                            value="{{ $aspek->id_aspek }}"
                        >

                    </div>


                    {{-- Indikator --}}

                    <div>

                        <label class="block text-xs font-semibold theme-title mb-1.5">

                            Indikator Terkait

                            <span class="text-red-500">*</span>

                        </label>

                        <div class="theme-input w-full rounded-lg px-3 py-2.5 text-sm">

                            Indikator {{ $indikator->nomor_indikator }}
                            :
                            {{ $indikator->nama_indikator }}

                        </div>

                        <input
                            type="hidden"
                            name="id_indikator"
                            value="{{ $indikator->id_indikator }}"
                        >

                        <input
                            type="hidden"
                            name="id_data_dukung"
                            value="{{ $dataDukung->id_data_dukung }}"
                        >

                    </div>

                </div>

                @if($dataDukung)
                    <div class="rounded-lg border border-teal-200 bg-teal-50/70 px-3 py-2.5 dark:border-teal-900/60 dark:bg-teal-950/20">
                        <p class="text-[10px] font-semibold uppercase tracking-wide text-teal-700 dark:text-teal-300">
                            Detail data dukung yang dipilih
                        </p>
                        <p class="mt-1 text-sm font-semibold theme-title">
                            {{ $dataDukung->nama_data_dukung }}
                        </p>
                        @if($dataDukung->deskripsi)
                            <p class="mt-0.5 text-xs theme-muted">
                                {{ $dataDukung->deskripsi }}
                            </p>
                        @endif
                    </div>
                @endif


                {{-- Judul --}}

                <div>

                    <label class="block text-xs font-semibold theme-title mb-1.5">

                        Judul Panduan / Template

                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul', $editPanduan->judul ?? ($dataDukung->nama_data_dukung ?? '')) }}"
                        required
                        maxlength="255"
                        class="theme-input w-full rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20"
                        placeholder="{{ $dataDukung->nama_data_dukung }}"
                    >

                </div>


                {{-- Tipe --}}

                <div>

                    <label class="block text-xs font-semibold theme-title mb-1.5">

                        Jenis Dokumen

                        <span class="text-red-500">*</span>

                    </label>


                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">


                        {{-- Panduan --}}

                        <label class="cursor-pointer">

                            <input
                                type="radio"
                                name="tipe"
                                value="PANDUAN"
                                class="peer hidden radio-tipe"
                                {{ old('tipe', $editPanduan?->tipe ?? ($defaultTipe ?? '')) === 'PANDUAN' ? 'checked' : '' }}
                                {{ $hasPanduan && !$editPanduan ? 'disabled' : '' }}
                            >

                            <div class="relative theme-card border theme-border rounded-xl p-3 transition-all duration-200
                                {{ $hasPanduan && !$editPanduan
                                    ? 'opacity-50 cursor-not-allowed border-red-200 dark:border-red-900/50'
                                    : 'peer-checked:border-[#12a89d] peer-checked:border-2 peer-checked:bg-[#12a89d]/10 dark:peer-checked:bg-[#14b8a6]/20 peer-checked:ring-2 peer-checked:ring-[#12a89d]/20 peer-checked:scale-[1.02]' }}">

                                <div class="absolute top-2 right-2 hidden peer-checked:flex items-center justify-center w-5 h-5 rounded-full bg-[#12a89d] text-white dark:bg-[#14b8a6]">
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                </div>

                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-[#12a89d]/10 text-[#12a89d] dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] flex items-center justify-center">
                                        <i class="fa-regular fa-file-pdf"></i>
                                    </div>

                                    <div>
                                        <p class="text-xs font-semibold theme-title">Panduan</p>
                                        <p class="text-[10px] theme-muted">PDF</p>

                                        @if($hasPanduan && !$editPanduan)
                                            <p class="text-[10px] text-red-500 dark:text-red-400 mt-1 font-medium">
                                                Sudah diupload
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </label>


                        {{-- Template --}}

                        <label class="cursor-pointer">

                            <input
                                type="radio"
                                name="tipe"
                                value="TEMPLATE"
                                class="peer hidden radio-tipe"
                                {{ old('tipe', $editPanduan?->tipe ?? ($defaultTipe ?? '')) === 'TEMPLATE' ? 'checked' : '' }}
                                {{ $hasTemplate && !$editPanduan ? 'disabled' : '' }}
                            >

                            <div class="relative theme-card border theme-border rounded-xl p-3 transition-all duration-200
                                {{ $hasTemplate && !$editPanduan
                                    ? 'opacity-50 cursor-not-allowed border-red-200 dark:border-red-900/50'
                                    : 'peer-checked:border-[#12a89d] peer-checked:border-2 peer-checked:bg-[#12a89d]/10 dark:peer-checked:bg-[#14b8a6]/20 peer-checked:ring-2 peer-checked:ring-[#12a89d]/20 peer-checked:scale-[1.02]' }}">

                                <div class="absolute top-2 right-2 hidden peer-checked:flex items-center justify-center w-5 h-5 rounded-full bg-[#12a89d] text-white dark:bg-[#14b8a6]">
                                    <i class="fa-solid fa-check text-[10px]"></i>
                                </div>

                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-[#12a89d]/10 text-[#12a89d] dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] flex items-center justify-center">
                                        <i class="fa-regular fa-file-word"></i>
                                    </div>

                                    <div>
                                        <p class="text-xs font-semibold theme-title">Template</p>
                                        <p class="text-[10px] theme-muted">Word / Excel</p>

                                        @if($hasTemplate && !$editPanduan)
                                            <p class="text-[10px] text-red-500 dark:text-red-400 mt-1 font-medium">
                                                Sudah diupload
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </label>

                    </div>

                </div>


                {{-- BLOK PREVIEW SEMUA DOKUMEN YANG SUDAH DIUPLOAD PER DATA DUKUNG --}}
                @php
                    $existingFiles = $panduanList->where('id_data_dukung', $dataDukung->id_data_dukung);
                    $bothUploaded = $hasPanduan && $hasTemplate && !$editPanduan;
                @endphp

                @if($existingFiles->count() > 0)
                    <div class="rounded-xl border theme-border bg-gray-50/50 p-4 dark:bg-white/5 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold theme-title flex items-center gap-1.5">
                                <i class="fa-solid fa-paperclip text-teal-600"></i> File Terpasang Saat Ini ({{ $existingFiles->count() }})
                            </span>
                        </div>

                        <div class="space-y-2">
                            @foreach($existingFiles as $itemFile)
                                <div class="flex items-center justify-between gap-3 bg-white p-3 rounded-lg border theme-border dark:bg-gray-800">
                                    <div class="flex items-center gap-3 min-w-0">
                                        @php
                                            $ext = strtolower(pathinfo($itemFile->file_name ?? '', PATHINFO_EXTENSION));
                                        @endphp
                                        <div class="w-9 h-9 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center shrink-0 border border-teal-200">
                                            @if($ext === 'pdf')
                                                <i class="fa-regular fa-file-pdf text-red-500 text-base"></i>
                                            @elseif(in_array($ext, ['doc', 'docx']))
                                                <i class="fa-regular fa-file-word text-blue-500 text-base"></i>
                                            @elseif(in_array($ext, ['xls', 'xlsx']))
                                                <i class="fa-regular fa-file-excel text-green-500 text-base"></i>
                                            @else
                                                <i class="fa-regular fa-file text-base"></i>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <p class="text-xs font-semibold theme-title truncate">
                                                    {{ $itemFile->file_name ?? $itemFile->judul }}
                                                </p>
                                                <span class="text-[9px] font-bold px-1.5 py-0.5 rounded uppercase shrink-0
                                                    bg-[#f6c400]/15 text-[#d4a200]
                                                    dark:bg-[#f6c400]/20 dark:text-[#f6c400]">
                                                    {{ $itemFile->tipe }}
                                                </span>
                                            </div>
                                            <p class="text-[10px] theme-muted mt-0.5">
                                                Format: {{ strtoupper($ext ?: 'FILE') }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- TOMBOL AKSI TERHADAP FILE --}}
                                    <div class="flex items-center gap-2 shrink-0">
                                        @if($itemFile->file_exists && $itemFile->file_url)
                                            <a
                                                href="{{ route('asesor.panduan.file', ['id' => $itemFile->id_panduan]) }}"
                                                target="_blank"
                                                class="px-2.5 py-1.5 rounded-md bg-[#12a89d]/10 text-[#12a89d] hover:bg-[#12a89d]/20 dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] dark:hover:bg-[#14b8a6]/30 text-xs font-semibold transition inline-flex items-center gap-1"
                                            >
                                                <i class="fa-regular fa-eye"></i> Lihat
                                            </a>
                                        @endif

                                        <a
                                            href="{{ route('asesor.panduan.upload', ['idAspek' => $aspek->id_aspek, 'idIndikator' => $indikator->id_indikator, 'idDataDukung' => $dataDukung->id_data_dukung, 'edit' => $itemFile->id_panduan]) }}"
                                            class="px-2.5 py-1.5 rounded-md bg-[#12a89d]/10 text-[#12a89d] hover:bg-[#12a89d]/20 dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] dark:hover:bg-[#14b8a6]/30 text-xs font-semibold transition inline-flex items-center gap-1"
                                        >
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </a>

                                        <button
                                            type="button"
                                            onclick="if(confirm('Hapus file {{ addslashes($itemFile->judul) }}?')) document.getElementById('delete-file-form-{{ $itemFile->id_panduan }}').submit();"
                                            class="px-2.5 py-1.5 rounded-md bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/20 text-xs font-semibold transition inline-flex items-center gap-1"
                                        >
                                            <i class="fa-regular fa-trash-can"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif


                {{-- Upload File --}}

                <div>

                    <label class="block text-xs font-semibold theme-title mb-1.5">

                        {{ $editPanduan ? 'Ganti File Dokumen (Opsional)' : 'File Dokumen' }}

                        @if(!$editPanduan)
                            <span class="text-red-500">*</span>
                        @endif

                    </label>


                    <label
                        for="file"
                        id="upload-box"
                        class="block border-2 border-dashed theme-border rounded-xl p-7 text-center transition
                            {{ $bothUploaded ? 'bg-gray-100 dark:bg-gray-800/50 opacity-60 cursor-not-allowed border-gray-300' : 'cursor-pointer hover:border-teal-500' }}"
                    >

                        <div
                            id="upload-icon"
                            class="w-11 h-11 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3"
                        >

                            <i class="fa-regular fa-file-arrow-up text-lg"></i>

                        </div>


                        <p
                            id="file-name"
                            class="text-xs font-medium theme-title"
                        >
                            @if($bothUploaded)
                                Panduan & Template sudah lengkap diunggah. Hapus atau edit salah satu untuk mengganti file.
                            @elseif($editPanduan)
                                {{ $editPanduan->file_name ?? 'Klik untuk mengganti file' }}
                            @else
                                Pilih jenis dokumen terlebih dahulu
                            @endif
                        </p>


                        <p class="text-[11px] theme-muted mt-1">
                            Maksimal ukuran 10MB
                        </p>

                        <p class="text-[11px] theme-muted">
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

                </div>


                {{-- Deskripsi --}}

                <div>

                    <label class="block text-xs font-semibold theme-title mb-1.5">

                        Instruksi Tambahan / Deskripsi

                    </label>


                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="theme-input w-full rounded-lg p-3 text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/20"
                        placeholder="Masukkan deskripsi singkat atau instruksi penggunaan panduan ini..."
                    >{{ old('deskripsi', $editPanduan->deskripsi ?? '') }}</textarea>

                </div>


                {{-- Action --}}

                <div class="pt-4 flex justify-end gap-3 border-t theme-border">

                    <a
                        href="{{ url('/asesor/kelola_panduan') }}"
                        class="px-5 py-2.5 border theme-border rounded-lg text-xs font-medium theme-title hover:bg-gray-50 dark:hover:bg-white/5 transition"
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        id="submit-btn"
                        class="px-5 py-2.5 bg-teal-600 rounded-lg text-xs font-medium text-white hover:bg-teal-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
                        {{ $bothUploaded ? 'disabled' : '' }}
                    >

                        <i class="fa-solid fa-{{ $editPanduan ? 'pen-to-square' : 'upload' }} mr-1.5"></i>

                        {{ $editPanduan ? 'Update Panduan' : 'Simpan Panduan' }}

                    </button>

                </div>

            </form>

            {{-- Hidden Delete Forms untuk Semua File yang Ada --}}
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


        {{-- ============================================= --}}
        {{-- SIDEBAR DAFTAR PANDUAN --}}
        {{-- ============================================= --}}

        <div class="theme-card border theme-border rounded-2xl p-5 shadow-sm h-fit">

            <div class="flex items-center justify-between mb-4">

                <div>

                    <h3 class="font-bold theme-title text-sm">
                        Panduan & Template Indikator Ini
                    </h3>

                    <p class="text-[11px] theme-muted mt-0.5">
                        File yang sudah tersedia untuk indikator ini
                    </p>

                </div>


                <span class="px-2 py-1 rounded-md bg-green-100 text-green-600 text-[10px] font-semibold">

                    {{ $panduanList->count() }} Aktif

                </span>

            </div>


            {{-- Search --}}

            <div class="relative mb-4">

                <i class="fa-solid fa-magnifying-glass absolute left-3 top-2.5 text-xs theme-muted"></i>

                <input
                    type="text"
                    id="searchPanduan"
                    placeholder="Cari panduan..."
                    class="theme-input w-full rounded-lg pl-8 pr-3 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-teal-500/20"
                >

            </div>


            {{-- List --}}

            <div
                id="panduanContainer"
                class="space-y-3 max-h-[650px] overflow-y-auto pr-1"
            >

                @forelse($panduanList as $panduan)

                    <a
                        href="{{ route('asesor.panduan.upload', [
                            'idAspek' => $aspek->id_aspek,
                            'idIndikator' => $indikator->id_indikator,
                            'idDataDukung' => $panduan->id_data_dukung,
                            'edit' => $panduan->id_panduan
                        ]) }}"
                        class="panduan-item block border theme-border rounded-xl p-3.5 transition hover:border-teal-300"
                        data-search="{{ strtolower($panduan->judul . ' ' . ($panduan->nama_indikator ?? '') . ' ' . $panduan->tipe) }}"
                    >

                        <div class="flex justify-between items-start gap-2 mb-2">

                            <span class="inline-block bg-[#12a89d]/10 text-[#12a89d] dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] text-[10px] font-bold px-2 py-0.5 rounded uppercase">
                                {{ $panduan->tipe }}
                            </span>


                            @if($panduan->file_exists)

                                <i class="fa-solid fa-circle-check text-green-500 text-xs"></i>

                            @endif

                        </div>


                        <h4 class="font-bold text-xs theme-title mb-1">

                            {{ $panduan->judul }}

                        </h4>


                        @if($panduan->nama_indikator)

                            <p class="text-[11px] theme-muted mb-2">

                                Indikator {{ $panduan->nomor_indikator }}
                                :
                                {{ $panduan->nama_indikator }}

                            </p>

                        @endif


                        <div class="flex items-center justify-between gap-2">

                            <div class="flex items-center gap-1.5">

                                @php
                                    $extension = strtolower(
                                        pathinfo(
                                            $panduan->file_name ?? '',
                                            PATHINFO_EXTENSION
                                        )
                                    );
                                @endphp


                                <span class="inline-flex items-center gap-1 text-[10px] border theme-border theme-card theme-title px-1.5 py-0.5 rounded">

                                    @if($extension === 'pdf')

                                        <i class="fa-regular fa-file-pdf text-red-500"></i>

                                    @elseif(in_array($extension, ['doc', 'docx']))

                                        <i class="fa-regular fa-file-word text-blue-500"></i>

                                    @elseif(in_array($extension, ['xls', 'xlsx']))

                                        <i class="fa-regular fa-file-excel text-green-500"></i>

                                    @else

                                        <i class="fa-regular fa-file"></i>

                                    @endif


                                    <span>
                                        {{ strtoupper($extension ?: 'FILE') }}
                                    </span>

                                </span>

                            </div>

                        </div>

                    </a>

                @empty

                    <div class="text-center py-10">

                        <div class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-white/5 theme-muted flex items-center justify-center mx-auto mb-3">

                            <i class="fa-regular fa-folder-open text-lg"></i>

                        </div>


                        <p class="text-xs font-medium theme-title">
                            Belum ada panduan atau template
                        </p>


                        <p class="text-[11px] theme-muted mt-1">
                            File untuk indikator ini akan muncul di sini.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>


{{-- ===================================================== --}}
{{-- JAVASCRIPT --}}
{{-- ===================================================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const fileInput = document.getElementById('file');
    const fileName = document.getElementById('file-name');
    const uploadIcon = document.getElementById('upload-icon');
    const uploadBox = document.getElementById('upload-box');
    const radioTipas = document.querySelectorAll('.radio-tipe');
    const isEditMode = @json((bool)$editPanduan);
    const bothUploaded = @json((bool)$bothUploaded);

    // Fungsi Pengunci Input File
    function checkFileAvailability() {
        if (bothUploaded) {
            fileInput.disabled = true;
            return;
        }

        const selectedRadio = document.querySelector('.radio-tipe:checked');
        
        if (!selectedRadio && !isEditMode) {
            fileInput.disabled = true;
            uploadBox.classList.add('opacity-60', 'cursor-not-allowed', 'bg-gray-50/50', 'dark:bg-gray-800/30');
            uploadBox.classList.remove('cursor-pointer', 'hover:border-teal-500');
            if(!fileInput.files.length) {
                fileName.textContent = 'Pilih jenis dokumen terlebih dahulu';
            }
        } else {
            fileInput.disabled = false;
            uploadBox.classList.remove('opacity-60', 'cursor-not-allowed', 'bg-gray-50/50', 'dark:bg-gray-800/30');
            uploadBox.classList.add('cursor-pointer', 'hover:border-teal-500');
            if(!fileInput.files.length) {
                fileName.textContent = 'Klik untuk unggah atau seret file ke sini';
            }
        }
    }

    // Panggil saat halaman pertama dimuat
    checkFileAvailability();

    // Event saat Radio Jenis Dokumen dipilih
    radioTipas.forEach(radio => {
        radio.addEventListener('change', checkFileAvailability);
    });

    // Event saat File dipilih
    fileInput.addEventListener('change', function () {

        if (!this.files.length) {
            checkFileAvailability();
            return;
        }

        const file = this.files[0];
        fileName.textContent = file.name;

        const extension = file.name.split('.').pop().toLowerCase();

        if (extension === 'pdf') {
            uploadIcon.innerHTML = '<i class="fa-regular fa-file-pdf text-lg"></i>';
        } else if (['doc', 'docx'].includes(extension)) {
            uploadIcon.innerHTML = '<i class="fa-regular fa-file-word text-lg"></i>';
        } else if (['xls', 'xlsx'].includes(extension)) {
            uploadIcon.innerHTML = '<i class="fa-regular fa-file-excel text-lg"></i>';
        } else {
            uploadIcon.innerHTML = '<i class="fa-regular fa-file text-lg"></i>';
        }
    });


    // =====================================================
    // SEARCH PANDUAN
    // =====================================================

    const searchInput = document.getElementById('searchPanduan');
    const panduanItems = document.querySelectorAll('.panduan-item');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();

            panduanItems.forEach(function (item) {
                const text = item.dataset.search || '';
                item.style.display = text.includes(keyword) ? '' : 'none';
            });
        });
    }

});

</script>

@endsection