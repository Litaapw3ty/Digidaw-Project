@extends('layouts.sidebar.sidebar-user')

@section('content')

@php
    $status = $evaluasiIndikator->status_pengisian ?? 'BELUM_DIISI';
    $hasEvidence = !empty($bukti);
    $showResult = $hasSavedResult && $hasEvidence;

    $inputValue = old('nilai_eksternal');
    $displayRaw = $savedRawValue;
    $displayLevel = $savedLevel;

    if ($displayRaw === null && $showResult) {
        $displayRaw = null;
    }

    $levelForDisplay = $displayLevel ?? ($evaluasiIndikator->level_kematangan ?? 1);
@endphp

<div class="min-h-screen bg-[#f7fafa] px-6 py-6 dark:bg-gray-900">

    {{-- BREADCRUMB --}}
    <div class="mb-5 flex items-center justify-between">
        <div class="flex items-center gap-3 text-sm">
            <a href="{{ route('user.penilaian') }}" class="font-semibold text-[#0f246b] hover:underline dark:text-blue-300">
                Penilaian
            </a>
            <span class="text-gray-400">›</span>
            <a href="{{ route('user.penilaian') }}" class="font-semibold text-[#0f246b] hover:underline dark:text-blue-300">
                Penilaian Mandiri
            </a>
            <span class="text-gray-400">›</span>
            <span class="text-gray-500 dark:text-gray-300">Indikator Penilaian Mandiri</span>
        </div>

        <a
            href="{{ route('user.penilaian') }}"
            class="inline-flex h-9 items-center justify-center rounded-lg border border-red-500 px-6 text-sm font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30"
        >
            Kembali
        </a>
    </div>

    {{-- JUDUL --}}
    <div class="mb-6">
        <div class="mb-2 inline-flex rounded-full bg-[#fff0c7] px-4 py-1 text-sm font-semibold text-[#d99b00] dark:bg-yellow-900/30 dark:text-yellow-300">
            {{ $aspek->nama_aspek ?? 'Eksternal' }}
        </div>

        <h1 class="text-[28px] font-bold leading-tight text-gray-900 dark:text-white">
            {{ $indikator->nomor_indikator }}. {{ $indikator->nama_indikator }}
        </h1>

        <p class="mt-1 text-base text-gray-700 dark:text-gray-300">
            Detail indikator yang digunakan dalam penilaian mandiri pemerintah digital
        </p>
    </div>

    {{-- INFORMASI INDIKATOR --}}
    <div class="mb-8 overflow-hidden rounded-xl border border-gray-300 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="border-b border-gray-200 px-8 py-4 dark:border-gray-700">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white">Informasi Indikator</h2>
        </div>

        <div class="px-8 py-5">
            <div class="grid grid-cols-1 gap-y-3 text-sm md:grid-cols-[160px_25px_1fr]">
                <div class="text-gray-700 dark:text-gray-300">Kode</div>
                <div class="text-gray-700 dark:text-gray-300">:</div>
                <div class="font-medium text-gray-800 dark:text-white">{{ $instansi->kode_instansi ?? '-' }}</div>

                <div class="text-gray-700 dark:text-gray-300">Nama Instansi</div>
                <div class="text-gray-700 dark:text-gray-300">:</div>
                <div class="font-medium text-gray-800 dark:text-white">{{ $instansi->nama_instansi ?? '-' }}</div>

                <div class="text-gray-700 dark:text-gray-300">Kategori</div>
                <div class="text-gray-700 dark:text-gray-300">:</div>
                <div class="font-medium text-gray-800 dark:text-white">
                    @switch($instansi->kategori)

                        @case('KABUPATEN')
                            Pemerintah Kabupaten
                            @break

                        @case('KOTA')
                            Pemerintah Kota
                            @break

                        @case('PROVINSI')
                            Pemerintah Provinsi
                            @break

                        @case('PUSAT')
                            Pemerintah Pusat
                            @break

                        @default
                            {{ $instansi->kategori ?? '-' }}

                    @endswitch
                </div>
            </div>

            <div class="my-5 border-t border-dotted border-gray-400 dark:border-gray-600"></div>

            <div class="grid grid-cols-1 gap-y-2 text-sm md:grid-cols-[160px_25px_1fr]">
                <div class="text-gray-700 dark:text-gray-300">Deskripsi</div>
                <div class="text-gray-700 dark:text-gray-300">:</div>
                <div class="leading-6 text-gray-700 dark:text-gray-300">
                    {{ $indikator->deskripsi ?? '-' }}
                </div>
            </div>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="mb-5 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:border-green-800 dark:bg-green-950/30 dark:text-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-800 dark:bg-red-950/30 dark:text-red-300">
            <ul class="list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM / HASIL --}}
    <div class="mb-2 text-lg font-bold text-gray-800 dark:text-white">Indikator Eksternal</div>

    @if(!$showResult)
        <form
            action="{{ route('user.penilaian.eksternal.store', $indikator->id_indikator) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1.25fr_.75fr]">
                {{-- INPUT --}}
                <div class="rounded-xl border border-gray-300 bg-white p-8 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                        Input Nilai ({{ $config['source_scale'] }})
                    </h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Masukkan nilai {{ $config['suffix'] ? '(' . $config['suffix'] . ')' : 'indikator' }}
                    </p>

                    <label class="mt-7 block text-sm font-semibold text-gray-900 dark:text-white">
                        Nilai Eksternal<span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        name="nilai_eksternal"
                        value="{{ $inputValue }}"
                        min="{{ $config['min'] }}"
                        max="{{ $config['max'] }}"
                        step="{{ $config['step'] }}"
                        required
                        placeholder="Masukkan Nilai Eksternal"
                        class="mt-2 h-12 w-full rounded-xl border border-gray-300 bg-white px-5 text-sm text-gray-800 outline-none transition focus:border-[#12a89d] focus:ring-2 focus:ring-[#12a89d]/20 dark:border-gray-600 dark:bg-gray-800 dark:text-white"
                    >

                    <label class="mt-7 block text-sm font-semibold text-gray-900 dark:text-white">
                        Bukti Pendukung<span class="text-red-500">*</span>
                    </label>

                    <label id="uploadBox" class="mt-2 flex min-h-[108px] cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-[#42d5cb] bg-[#fbffff] px-5 text-center hover:bg-[#f1fffe] dark:border-teal-600 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <svg class="h-10 w-10 text-[#2ccbbd]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6H16a5 5 0 011 9.9M16 13l-4-4m0 0l-4 4m4-4v9"/>
                        </svg>
                        <span class="mt-1 text-sm font-medium text-gray-700 dark:text-gray-200">Klik untuk memilih file</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">atau seret dan lepas file di sini (PDF)</span>
                        <input id="dokumen" type="file" name="dokumen" accept="application/pdf,.pdf" required class="hidden">
                    </label>

                    <div id="selectedFile" class="mt-2 hidden rounded-xl border border-red-400 bg-white p-4 dark:border-red-500 dark:bg-gray-800">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex min-w-0 items-center gap-4">
                                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-500 dark:bg-red-950/30">
                                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zm7 1.5L18.5 9H14a1 1 0 0 1-1-1V3.5zM8 13h2.2c1.5 0 2.4.8 2.4 2s-.9 2-2.4 2H9.5v2H8v-6zm1.5 1.2v1.6h.7c.6 0 .9-.3.9-.8s-.3-.8-.9-.8h-.7zm4.2-1.2h2c1.8 0 2.8 1 2.8 3s-1 3-2.8 3h-2v-6zm1.5 1.3v3.4h.5c.9 0 1.3-.5 1.3-1.7s-.4-1.7-1.3-1.7h-.5z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div id="selectedFileName" class="truncate text-sm font-semibold text-gray-800 dark:text-white"></div>
                                    <div id="selectedFileSize" class="mt-1 text-xs text-gray-500 dark:text-gray-400"></div>
                                </div>
                            </div>
                            <button id="removeSelectedFile" type="button" class="shrink-0 text-red-500 hover:text-red-700" title="Hapus file">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="mt-7 flex justify-end">
                        <button
                            type="submit"
                            class="inline-flex h-11 items-center rounded-lg bg-[#0da7a4] px-6 text-sm font-semibold text-white shadow-sm transition hover:bg-[#098f8d]"
                        >
                            Simpan
                        </button>
                    </div>
                </div>

                {{-- PETUNJUK --}}
                <div class="flex min-h-[210px] items-center justify-center rounded-xl border border-[#e9a900] bg-[#fff8e8] p-8 text-center dark:border-yellow-700 dark:bg-yellow-950/20">
                    <div>
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full border-4 border-orange-500 text-orange-500">
                            <span class="text-2xl font-bold">!</span>
                        </div>
                        <h3 class="mt-4 text-lg font-bold text-gray-900 dark:text-white">Petunjuk Pengisian</h3>
                        <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-gray-600 dark:text-gray-300">
                            Masukkan nilai sesuai skala indikator di atas. Bukti pendukung wajib dilampirkan sebelum penilaian dapat disimpan.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    @else
        {{-- HASIL PERHITUNGAN --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1.25fr_.75fr]">
            <div class="rounded-xl border border-gray-300 bg-white p-8 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h3 class="text-lg font-bold text-gray-800 dark:text-white">Hasil Perhitungan</h3>

                <div class="mt-6 space-y-4 text-sm">
                    <div class="grid grid-cols-[180px_20px_1fr]">
                        <span class="text-gray-700 dark:text-gray-300">Konversi</span>
                        <span>:</span>
                        <span class="font-semibold text-gray-800 dark:text-white">Skala 1–5</span>
                    </div>
                    <div class="grid grid-cols-[180px_20px_1fr]">
                        <span class="text-gray-700 dark:text-gray-300">Nilai Eksternal</span>
                        <span>:</span>
                        <span class="font-semibold text-gray-800 dark:text-white">
                            {{ $displayRaw !== null ? number_format((float)$displayRaw, 2, ',', '.') : '-' }}
                        </span>
                    </div>
                    <div class="grid grid-cols-[180px_20px_1fr]">
                        <span class="text-gray-700 dark:text-gray-300">Nilai Final</span>
                        <span>:</span>
                        <span class="font-semibold text-gray-800 dark:text-white">
                            {{ number_format((float)$levelForDisplay, 2, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="my-6 border-t border-gray-200 dark:border-gray-700"></div>

                <div class="text-sm font-semibold text-gray-900 dark:text-white">Bukti Pendukung<span class="text-red-500">*</span></div>

<div class="mt-3 rounded-xl border border-gray-300 bg-white p-4 dark:border-gray-600 dark:bg-gray-800">
    <div class="flex items-start justify-between gap-4">

        {{-- INFO FILE --}}
        <div class="flex min-w-0 items-start gap-4">

            {{-- ICON FILE --}}
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-500 dark:bg-red-950/30">
                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v6h6v10H6z"/>
                </svg>
            </div>

            {{-- DETAIL FILE --}}
            <div class="min-w-0 text-sm">

                {{-- Nama File --}}
                <div class="truncate font-bold text-gray-800 dark:text-gray-200">
                    {{ $bukti->file_name }}
                </div>

                {{-- Detail --}}
                <div class="mt-1 grid grid-cols-[120px_10px_1fr] gap-y-1 text-xs text-gray-500 dark:text-gray-400">

                    {{-- Ukuran --}}
                    <div>Ukuran File</div>
                    <div>:</div>
                    <span>
                        {{ number_format(($bukti->file_size ?? 0) / 1024, 2, ',', '.') }} KB
                    </span>

                    {{-- Tanggal Upload --}}
                    <div>Tanggal Upload</div>
                    <div>:</div>
                    <span>
                        {{ $bukti->created_at
                            ? \Carbon\Carbon::parse($bukti->created_at)->locale('id')->translatedFormat('j F Y \p\u\k\u\l H.i \W\I\B')
                            : '-' }}
                    </span>

                    {{-- Diunggah Oleh --}}
                    <div>Diunggah Oleh</div>
                    <div>:</div>
                    <span>
                        {{ Auth::user()->name ?? 'Pengguna' }}
                    </span>

                </div>
            </div>
        </div>

        {{-- ACTION --}}
        <div class="flex shrink-0 items-center gap-2">

    {{-- Lihat --}}
    <a
        href="{{ asset('storage/' . $bukti->file_path) }}"
        target="_blank"
        class="inline-flex h-9 items-center justify-center rounded-lg border border-[#59c9c8] px-4 text-xs font-semibold text-[#159b99] hover:bg-[#eafafa]"
    >
        Lihat
    </a>

    {{-- Hapus --}}
    <form
        action="{{ route('user.penilaian.eksternal.document.destroy', [$indikator->id_indikator, $bukti->id_dokumen]) }}"
        method="POST"
        onsubmit="return confirm('Hapus bukti pendukung ini? Bukti wajib diupload kembali.');"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="inline-flex h-9 items-center justify-center rounded-lg border border-red-500 px-4 text-xs font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30"
        >
            Hapus
        </button>
    </form>

</div>
    </div>
</div>
            </div>

            <div class="flex items-start justify-center rounded-xl bg-[#16bdb9] p-7 text-white shadow-sm">
                <div class="w-full">
                    <div class="text-sm font-semibold">Nilai Indikator</div>
                    <div class="mt-2 text-5xl font-bold">{{ number_format((float)$levelForDisplay, 2, ',', '.') }}</div>
                    <div class="mt-2 text-sm opacity-90">{{ $levelLabel ?? ('Level ' . $levelForDisplay) }}</div>
                    <div class="mt-6 rounded-lg bg-white/15 px-4 py-3 text-xs">
                        Perhitungan ini hanya untuk indikator <strong>{{ $indikator->kode_indikator }}</strong>. Nilai aspek dan indeks akhir tidak dihitung di halaman ini.
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('dokumen');
        const uploadBox = document.getElementById('uploadBox');
        const selected = document.getElementById('selectedFile');
        const selectedName = document.getElementById('selectedFileName');
        const selectedSize = document.getElementById('selectedFileSize');
        const removeButton = document.getElementById('removeSelectedFile');

        if (!input || !uploadBox || !selected) return;

        input.addEventListener('change', function () {
            const file = this.files && this.files[0];

            if (!file) {
                uploadBox.classList.remove('hidden');
                selected.classList.add('hidden');
                return;
            }

            selectedName.textContent = file.name;
            selectedSize.textContent = (file.size / 1048576).toFixed(2).replace('.', ',') + ' MB';
            uploadBox.classList.add('hidden');
            selected.classList.remove('hidden');
        });

        if (removeButton) {
            removeButton.addEventListener('click', function () {
                input.value = '';
                selected.classList.add('hidden');
                uploadBox.classList.remove('hidden');
            });
        }
    });
</script>

@endsection
