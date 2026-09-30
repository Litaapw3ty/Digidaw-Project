@extends('layouts.sidebar.sidebar-user')

@section('content')

<div class="w-full max-w-[1250px] mx-auto px-4 sm:px-6 lg:px-8 py-8 text-gray-800 dark:text-gray-100">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-5 mb-8">

        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100">
                Penilaian Mandiri Pemerintah Digital
            </h1>

            <p class="mt-1 text-sm sm:text-base text-gray-600 dark:text-gray-300">
                Dashboard evaluasi dan pengukuran tingkat kematangan digital instansi.
            </p>
        </div>

        <a
            href="{{ route('user.dashboard') }}"
            class="inline-flex items-center justify-center
                   px-6 py-2.5
                   rounded-lg
                   border border-red-400
                   bg-white dark:bg-gray-800
                   text-red-600 dark:text-red-400
                   font-semibold
                   hover:bg-red-50 dark:hover:bg-gray-700
                   transition"
        >
            Kembali
        </a>

    </div>


    {{-- INFORMASI INSTANSI + INDEKS PM --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-7">

        {{-- INFORMASI INSTANSI --}}
        <div
            class="lg:col-span-2
                   bg-white dark:bg-gray-800
                   border border-gray-200 dark:border-gray-700
                   rounded-xl
                   shadow-sm
                   px-6 py-5"
        >

            <div class="grid grid-cols-12 gap-y-2.5 text-sm sm:text-base">

                {{-- KODE --}}
                <div class="col-span-4 sm:col-span-3 font-semibold text-gray-700 dark:text-gray-200">
                    Kode
                </div>

                <div class="col-span-1 text-center text-gray-400 dark:text-gray-500">
                    :
                </div>

                <div class="col-span-7 sm:col-span-8 text-gray-700 dark:text-gray-200">
                    {{ $instansi->kode_instansi }}
                </div>


                {{-- NAMA INSTANSI --}}
                <div class="col-span-4 sm:col-span-3 font-semibold text-gray-700 dark:text-gray-200">
                    Nama Instansi
                </div>

                <div class="col-span-1 text-center text-gray-400 dark:text-gray-500">
                    :
                </div>

                <div class="col-span-7 sm:col-span-8 text-gray-700 dark:text-gray-200">
                    {{ $instansi->nama_instansi }}
                </div>


                {{-- KATEGORI --}}
                <div class="col-span-4 sm:col-span-3 font-semibold text-gray-700 dark:text-gray-200">
                    Kategori
                </div>

                <div class="col-span-1 text-center text-gray-400 dark:text-gray-500">
                    :
                </div>

                <div class="col-span-7 sm:col-span-8 text-gray-700 dark:text-gray-200">

                    @switch($instansi->kategori)

                        @case('PUSAT')
                            Pemerintah Pusat
                            @break

                        @case('PROVINSI')
                            Pemerintah Provinsi
                            @break

                        @case('KABUPATEN')
                            Pemerintah Kabupaten
                            @break

                        @case('KOTA')
                            Pemerintah Kota
                            @break

                        @default
                            Lainnya

                    @endswitch

                </div>

            </div>

        </div>


        {{-- INDEKS PM --}}
        <div
            class="relative overflow-hidden
                   bg-[#18b9b6]
                   rounded-xl
                   text-white
                   px-6 py-5
                   shadow-sm"
        >

            <div
                class="absolute -right-8 -top-8
                       w-28 h-28
                       bg-[#149f9d]
                       rotate-45
                       opacity-70"
            ></div>

            <div
                class="absolute -right-10 bottom-[-35px]
                       w-28 h-28
                       bg-[#149f9d]
                       rotate-45
                       opacity-70"
            ></div>


            <div
                class="relative z-10
                       flex items-center gap-5
                       h-full"
            >

                <div
                    class="w-14 h-14
                           rounded-full
                           border-2 border-white
                           flex items-center justify-center
                           shrink-0"
                >

                    <svg
                        class="w-7 h-7"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="8"
                            stroke-width="1.8"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="3"
                            stroke-width="1.8"
                        />
                    </svg>

                </div>


                <div>

                    <p class="text-base font-semibold">
                        Indeks PM
                    </p>

                    {{-- INDEKS PM ATAS TETAP MENAMPILKAN NILAI ASLI --}}
                    <p class="text-4xl font-bold leading-none mt-1">
                        {{ number_format($indeksPM ?? 1, 2, ',', '.') }}
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- JUDUL --}}
    <div class="mb-5">

        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">
            Aspek Penilaian
        </h2>

    </div>


    {{-- ASPEK --}}
    <div class="space-y-5">

        @forelse ($aspek as $item)

            <div
                class="border border-gray-200 dark:border-gray-700
                       rounded-lg
                       overflow-hidden
                       bg-white dark:bg-gray-800"
            >

                {{-- HEADER ASPEK --}}
                <div
                    class="flex flex-col sm:flex-row
                           sm:items-center
                           sm:justify-between
                           gap-3
                           px-4 py-3
                           bg-[#59d1ce]
                           text-white"
                >

                    <div class="flex items-center gap-2">

                        <span class="font-bold text-sm">
                            Aspek {{ $item['no'] }}
                        </span>

                        <span class="text-sm">
                            {{ $item['nama'] }}
                        </span>

                    </div>


                    <div class="flex items-center gap-2 shrink-0">

                        {{-- BOBOT --}}
                        <span
                            class="px-3 py-1
                                   rounded-full
                                   bg-white/50
                                   text-[#247c7b]
                                   text-xs
                                   font-semibold"
                        >
                            Bobot :
                            {{ number_format($item['bobot'] * 100, 0) }} %
                        </span>


                        {{-- PM ASPEK --}}
                        {{-- 
                            Nilai awal evaluasi_indikator boleh saja 1,
                            tetapi untuk tampilan PM aspek ditutup menjadi 0,00 / 5.
                            Nilai DB tidak diubah.
                        --}}
                        <span
                            class="px-3 py-1
                                   rounded-full
                                   bg-white/50
                                   text-[#247c7b]
                                   text-xs
                                   font-semibold"
                        >
                            PM : 0,00 / 5
                        </span>

                    </div>

                </div>


                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[900px] border-collapse">

                        <tbody>

                            @forelse ($item['items'] as $data)

                                <tr
                                    class="border-b border-gray-200 dark:border-gray-700
                                           last:border-b-0
                                           hover:bg-gray-50 dark:hover:bg-gray-700
                                           transition"
                                >

                                    {{-- NOMOR --}}
                                    <td
                                        class="w-[50px]
                                               border-r border-gray-200 dark:border-gray-700
                                               px-3 py-3.5
                                               text-center
                                               text-sm
                                               text-gray-700 dark:text-gray-200"
                                    >
                                        {{ $data['no'] }}
                                    </td>


                                    {{-- INDIKATOR --}}
                                    <td
                                        class="w-[42%]
                                               border-r border-gray-200 dark:border-gray-700
                                               px-4 py-3.5
                                               text-sm
                                               leading-5
                                               text-gray-800 dark:text-gray-100"
                                    >
                                        {{ $data['nama'] }}
                                    </td>


                                    {{-- TIPE --}}
                                    <td
                                        class="w-[95px]
                                               border-r border-gray-200 dark:border-gray-700
                                               px-3
                                               text-center"
                                    >

                                        @if ($data['tipe'] === 'INTERNAL')

                                            <span
                                                class="inline-flex
                                                       px-3 py-1
                                                       rounded-full
                                                       bg-[#fff0c7]
                                                       text-[#d99b00]
                                                       text-xs
                                                       font-bold"
                                            >
                                                Internal
                                            </span>

                                        @else

                                            <span
                                                class="inline-flex
                                                       px-3 py-1
                                                       rounded-full
                                                       bg-[#d8f5f4]
                                                       text-[#149c99]
                                                       text-xs
                                                       font-bold"
                                            >
                                                Eksternal
                                            </span>

                                        @endif

                                    </td>


                                    {{-- BOBOT --}}
                                    <td
                                        class="w-[100px]
                                               border-r border-gray-200 dark:border-gray-700
                                               px-3
                                               text-center
                                               text-sm
                                               text-gray-600 dark:text-gray-300"
                                    >
                                        Bobot
                                        {{ number_format($data['bobot'] * 100, 0) }}%
                                    </td>


                                    {{-- PM / PROGRESS DATA DUKUNG --}}
                                    <td
                                        class="w-[175px]
                                               border-r border-gray-200 dark:border-gray-700
                                               px-3 py-3"
                                    >

                                        @if ($data['tipe'] === 'EKSTERNAL')

                                            {{-- NILAI PI EXTERNAL --}}
                                            <div
                                                class="text-center
                                                       text-sm
                                                       font-semibold
                                                       text-gray-600 dark:text-gray-300"
                                            >
                                                PI :
                                                {{ number_format($data['pi'] ?? 0, 2, ',', '.') }} / 5
                                            </div>

                                        @else

                                            @php
                                                $progress = $data['progress'] ?? 0;
                                                $dataTerisi = $data['data_terisi'] ?? 0;
                                                $dataTotal = $data['data_total'] ?? 0;
                                            @endphp

                                            <div class="w-full">

                                                <div
                                                    class="h-[18px]
                                                           w-full
                                                           rounded-full
                                                           border border-gray-300 dark:border-gray-600
                                                           bg-white dark:bg-gray-700
                                                           overflow-hidden"
                                                >

                                                    <div
                                                        class="h-full rounded-full
                                                        {{ $progress == 100
                                                            ? 'bg-green-600'
                                                            : 'bg-[#185798]' }}"
                                                        style="width: {{ $progress }}%"
                                                    ></div>

                                                </div>


                                                <div
                                                    class="mt-1
                                                           text-right
                                                           text-[10px]
                                                           text-gray-500 dark:text-gray-400"
                                                >
                                                    {{ $dataTerisi }}/{{ $dataTotal }}
                                                    Data Dukung
                                                </div>

                                            </div>

                                        @endif

                                    </td>


                                    {{-- LIHAT --}}
                                    <td
                                        class="w-[90px]
                                               px-3
                                               text-center"
                                    >

                                        @if ($data['tipe'] === 'INTERNAL')

                                            <a
                                                href="{{ route('user.penilaian.internal', $data['id_indikator']) }}"
                                                class="inline-flex
                                                       items-center
                                                       justify-center
                                                       min-w-[65px]
                                                       h-8
                                                       px-3.5
                                                       rounded-md
                                                       border border-[#59c9c8]
                                                       bg-white dark:bg-gray-800
                                                       text-[#159b99] dark:text-[#67e8e6]
                                                       text-xs
                                                       font-semibold
                                                       hover:bg-[#eafafa] dark:hover:bg-gray-700
                                                       transition"
                                            >
                                                Lihat
                                            </a>

                                        @else

                                            <a
                                                href="{{ route('user.penilaian.eksternal', $data['id_indikator']) }}"
                                                class="inline-flex
                                                       items-center
                                                       justify-center
                                                       min-w-[65px]
                                                       h-8
                                                       px-3.5
                                                       rounded-md
                                                       border border-[#59c9c8]
                                                       bg-white dark:bg-gray-800
                                                       text-[#159b99] dark:text-[#67e8e6]
                                                       text-xs
                                                       font-semibold
                                                       hover:bg-[#eafafa] dark:hover:bg-gray-700
                                                       transition"
                                            >
                                                Lihat
                                            </a>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="px-6 py-8
                                               text-center
                                               text-sm
                                               text-gray-500 dark:text-gray-400"
                                    >
                                        Belum ada indikator pada aspek ini.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        @empty

            <div
                class="bg-white dark:bg-gray-800
                       border border-gray-200 dark:border-gray-700
                       rounded-xl
                       p-8
                       text-center"
            >

                <div class="text-sm font-semibold text-gray-600 dark:text-gray-300">
                    Belum ada aspek penilaian.
                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection