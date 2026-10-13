@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="min-h-screen bg-[#f7fafa] px-6 py-6 dark:bg-gray-900">

    {{-- HEADER --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="mb-2 flex items-center gap-2 text-sm">
                <a
                    href="{{ url('/asesor/monitoring') }}"
                    class="font-semibold text-[#12a89d] hover:underline"
                >
                    Monitoring Penilaian
                </a>

                <span class="text-gray-400">›</span>

                <span class="text-gray-500 dark:text-gray-400">
                    Indikator Eksternal
                </span>
            </div>

            <h1 class="text-[25px] font-bold tracking-tight text-gray-900 dark:text-white">
                Indikator Eksternal
            </h1>

            <p class="mt-1 text-[13px] text-gray-500 dark:text-gray-400">
                Informasi nilai eksternal yang telah diinput oleh instansi.
            </p>
        </div>

        <a
            href="{{ url('/asesor/monitoring') }}"
            class="inline-flex h-9 items-center justify-center rounded-lg border border-gray-200 bg-white px-4 text-[12px] font-semibold text-gray-600 transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
        >
            <i class="fa-solid fa-arrow-left mr-2 text-[10px]"></i>
            Kembali
        </a>

    </div>


    {{-- INFORMASI INDIKATOR --}}
    <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">

        <div class="border-b border-gray-100 px-6 py-4 dark:border-gray-700">

            <div class="flex flex-wrap items-center gap-2">

                <span class="rounded-md bg-[#fff4d6] px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-[#c58b00]">
                    Eksternal
                </span>

                @if(isset($indikator->kode_indikator))
                    <span class="rounded-md bg-gray-100 px-2.5 py-1 text-[10px] font-semibold text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                        {{ $indikator->kode_indikator }}
                    </span>
                @endif

            </div>

            <h2 class="mt-3 text-[17px] font-bold leading-relaxed text-gray-900 dark:text-white">
                {{ $indikator->nomor_indikator ?? '-' }}.
                {{ $indikator->nama_indikator ?? 'Indikator Eksternal' }}
            </h2>

        </div>

        <div class="px-6 py-5">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                <div>
                    <p class="mb-1 text-[11px] font-semibold uppercase tracking-wide text-gray-400">
                        Aspek
                    </p>

                    <p class="text-[13px] font-semibold text-gray-800 dark:text-white">
                        {{ $aspek->nama_aspek ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="mb-1 text-[11px] font-semibold uppercase tracking-wide text-gray-400">
                        Sumber Indikator
                    </p>

                    <span class="inline-flex rounded-md bg-[#fff4d6] px-2.5 py-1 text-[11px] font-bold text-[#c58b00]">
                        EKSTERNAL
                    </span>
                </div>

                <div>
                    <p class="mb-1 text-[11px] font-semibold uppercase tracking-wide text-gray-400">
                        Status
                    </p>

                    @if(!empty($evaluasiIndikator))
                        <span class="inline-flex rounded-md bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-600 dark:bg-emerald-950/30 dark:text-emerald-400">
                            <i class="fa-solid fa-circle-check mr-1.5 text-[9px]"></i>
                            Sudah Diisi
                        </span>
                    @else
                        <span class="inline-flex rounded-md bg-gray-100 px-2.5 py-1 text-[11px] font-bold text-gray-500 dark:bg-gray-700 dark:text-gray-300">
                            Belum Diisi
                        </span>
                    @endif
                </div>

            </div>

            @if(!empty($indikator->deskripsi))

                <div class="mt-5 border-t border-dashed border-gray-200 pt-5 dark:border-gray-700">

                    <p class="mb-2 text-[11px] font-semibold uppercase tracking-wide text-gray-400">
                        Deskripsi Indikator
                    </p>

                    <p class="text-[13px] leading-6 text-gray-600 dark:text-gray-300">
                        {{ $indikator->deskripsi }}
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- NILAI + BUKTI --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1.15fr_.85fr]">

        {{-- NILAI --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">

            <div class="mb-5 flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#e8fbf9] text-[#12a89d] dark:bg-teal-950/30">
                    <i class="fa-solid fa-chart-column text-sm"></i>
                </div>

                <div>
                    <h3 class="text-[15px] font-bold text-gray-900 dark:text-white">
                        Nilai Eksternal
                    </h3>

                    <p class="mt-0.5 text-[11px] text-gray-500 dark:text-gray-400">
                        Nilai yang telah diinput oleh instansi.
                    </p>
                </div>

            </div>


            <div class="rounded-xl bg-[#f7fafa] p-6 dark:bg-gray-900">

                <p class="text-[11px] font-semibold uppercase tracking-wide text-gray-400">
                    Nilai Indikator
                </p>

                <div class="mt-2 flex items-end gap-2">

                    <span class="text-[40px] font-bold leading-none text-gray-900 dark:text-white">
                        @if(isset($savedRawValue) && $savedRawValue !== null)
                            {{ number_format((float) $savedRawValue, 2, ',', '.') }}
                        @elseif(isset($evaluasiIndikator->nilai) && $evaluasiIndikator->nilai !== null)
                            {{ number_format((float) $evaluasiIndikator->nilai, 2, ',', '.') }}
                        @else
                            -
                        @endif
                    </span>

                </div>

                @if(isset($levelLabel) && $levelLabel)

                    <div class="mt-3">

                        <span class="inline-flex rounded-md bg-[#e8fbf9] px-2.5 py-1 text-[11px] font-bold text-[#0d9288]">
                            {{ $levelLabel }}
                        </span>

                    </div>

                @endif

            </div>


            {{-- INFORMASI UNTUK ASESOR --}}
            <div class="mt-5 rounded-lg border border-[#eadcae] bg-[#fffaf0] px-4 py-3 dark:border-yellow-800/40 dark:bg-yellow-950/20">

                <div class="flex items-start gap-3">

                    <div class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-[#fff0c7] text-[#c58b00] dark:bg-yellow-900/40">
                        <i class="fa-solid fa-info text-[10px]"></i>
                    </div>

                    <div>

                        <p class="text-[12px] font-bold text-gray-800 dark:text-white">
                            Informasi Penilaian Eksternal
                        </p>

                        <p class="mt-1 text-[11px] leading-5 text-gray-600 dark:text-gray-300">
                            Nilai eksternal diinput oleh instansi melalui proses
                            penilaian mandiri. Asesor hanya dapat melihat informasi
                            nilai dan bukti pendukung pada indikator ini.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- BUKTI --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">

            <div class="mb-5 flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-red-500 dark:bg-red-950/30">
                    <i class="fa-regular fa-file-pdf text-sm"></i>
                </div>

                <div>
                    <h3 class="text-[15px] font-bold text-gray-900 dark:text-white">
                        Bukti Pendukung
                    </h3>

                    <p class="mt-0.5 text-[11px] text-gray-500 dark:text-gray-400">
                        Dokumen yang diunggah oleh instansi.
                    </p>
                </div>

            </div>


            @if(!empty($bukti))

                <div class="rounded-xl bg-gray-50 p-4 dark:bg-gray-900">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-red-50 text-red-500 dark:bg-red-950/30">
                            <i class="fa-regular fa-file-pdf text-lg"></i>
                        </div>

                        <div class="min-w-0 flex-1">

                            <p class="truncate text-[12px] font-semibold text-gray-800 dark:text-white">
                                {{ $bukti->file_name ?? 'Dokumen Pendukung.pdf' }}
                            </p>

                            @if(isset($bukti->file_size))
                                <p class="mt-1 text-[10px] text-gray-500 dark:text-gray-400">
                                    {{ number_format($bukti->file_size / 1048576, 2, ',', '.') }} MB
                                </p>
                            @endif

                        </div>

                    </div>


                    @if(!empty($bukti->file_path))

                        <a
                            href="{{ asset('storage/' . $bukti->file_path) }}"
                            target="_blank"
                            class="mt-4 flex h-9 w-full items-center justify-center gap-2 rounded-lg border border-[#59c9c8] text-[11px] font-semibold text-[#129a96] transition hover:bg-[#eafafa] dark:border-teal-700 dark:hover:bg-teal-950/20"
                        >
                            <i class="fa-regular fa-eye text-[10px]"></i>
                            Lihat Bukti
                        </a>

                    @endif

                </div>

            @else

                <div class="rounded-xl border border-dashed border-gray-300 px-5 py-10 text-center dark:border-gray-600">

                    <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-400 dark:bg-gray-700">
                        <i class="fa-regular fa-file-circle-xmark"></i>
                    </div>

                    <p class="mt-3 text-[12px] font-semibold text-gray-600 dark:text-gray-300">
                        Belum ada bukti pendukung
                    </p>

                    <p class="mt-1 text-[10px] text-gray-400">
                        Instansi belum mengunggah dokumen.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection