@extends('layouts.sidebar.sidebar-asesor')

@section('content')
<div class="w-full space-y-6">

    <!-- Header Halaman -->
    <div>
        <h1 class="text-3xl font-bold theme-title tracking-tight">
            Tambah Panduan & Template
        </h1>

        <p class="text-lg font-normal theme-muted mt-1.5">
            Kelola dan pantau bukti pendukung yang telah dimasukkan oleh pengguna.
        </p>
    </div>

     <!-- Summary Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Total Aspek -->
        <div class="theme-card border theme-border rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium theme-muted">
                        Total Aspek
                    </p>

                    <p class="mt-2 text-3xl font-bold theme-title">
                        {{ $aspekList->count() }}
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-[#12a89d]/10 dark:bg-[#14b8a6]/20 flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-[#12a89d] dark:text-[#14b8a6]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M4 6h16M4 12h16M4 18h10" />

                    </svg>

                </div>

            </div>

        </div>


        <!-- Total Panduan -->
        <div class="theme-card border theme-border rounded-2xl shadow-sm p-6">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium theme-muted">
                        Total Panduan
                    </p>

                    <p class="mt-2 text-3xl font-bold theme-title">
                        {{ $aspekList->sum('jumlah_panduan') }}
                    </p>
                </div>

                <div class="w-12 h-12 rounded-xl bg-[#12a89d]/10 dark:bg-[#14b8a6]/20 flex items-center justify-center">

                    <svg
                        class="w-6 h-6 text-[#12a89d] dark:text-[#14b8a6]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 3.75A2.25 2.25 0 0 1 8.25 6v12A2.25 2.25 0 0 0 10.5 20.25H18" />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 3.75h11.25A.75.75 0 0 1 18 4.5v15.75H10.5A4.5 4.5 0 0 1 6 15.75V3.75Z" />

                    </svg>

                </div>

            </div>

        </div>

    </div>


    <!-- Container Tabel -->
    <div class="theme-card border theme-border rounded-2xl overflow-hidden shadow-sm">

        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse theme-table">

                <!-- Header Tabel -->
                <thead class="theme-table-head border-b theme-border">
                    <tr>

                        <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center w-20">
                            NO.
                        </th>

                        <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider">
                            ASPEK
                        </th>

                        <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center">
                            BOBOT DEFAULT
                        </th>

                        <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center">
                            JUMLAH PANDUAN
                        </th>

                        <th class="py-4 px-6 text-xs font-bold uppercase tracking-wider text-center">
                            AKSI
                        </th>

                    </tr>
                </thead>

                <!-- Isi Tabel -->
                <tbody class="divide-y theme-border">

                    @forelse($aspekList as $item)

                        <tr class="theme-table-row transition-colors duration-150">

                            <!-- Nomor -->
                            <td class="py-4 px-6 text-center">
                                <span
                                    class="inline-flex items-center justify-center w-8 h-8 rounded-full border-2 border-[#12a89d] text-[#12a89d] dark:border-[#14b8a6] dark:text-[#14b8a6] font-semibold text-sm">
                                    {{ $item->nomor_aspek }}
                                </span>
                            </td>

                            <!-- Nama Aspek -->
                            <td class="py-4 px-6 text-base font-medium theme-title">
                                {{ $item->nama_aspek }}
                            </td>

                            <!-- Bobot -->
                            <td class="py-4 px-6 text-center">
                                <span
                                    class="inline-block bg-[#12a89d]/10 dark:bg-[#14b8a6]/20 text-[#12a89d] dark:text-[#14b8a6] text-sm font-semibold px-3.5 py-1 rounded-md">
                                        {{ rtrim(rtrim(number_format($item->bobot, 2, ',', '.'), '0'), ',') }}%
                                </span>
                            </td>

                            <!-- Jumlah Panduan -->
                            <td class="py-4 px-6 text-base font-normal theme-muted text-center">
                                {{ $item->jumlah_panduan }} Dokumen
                            </td>

                            <!-- Tombol Detail -->
                            <td class="py-4 px-6 text-center">

                                <a href="{{ route('asesor.panduan.detail', ['idAspek' => $item->id_aspek]) }}"
                                    class="inline-block text-sm font-medium text-[#12a89d] dark:text-[#14b8a6] border border-[#12a89d] dark:border-[#14b8a6] hover:bg-[#12a89d]/10 px-5 py-1.5 rounded-lg transition-colors">
                                    Detail
                                </a>

                            </td>

                        </tr>

                    @empty

                        <!-- Jika Data Kosong -->
                        <tr>
                            <td colspan="5" class="py-10 text-center theme-muted">
                                Belum ada data aspek.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
@endsection