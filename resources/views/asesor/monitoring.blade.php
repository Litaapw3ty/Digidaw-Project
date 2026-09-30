@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-bold theme-title tracking-tight">
            Monitoring Penilaian
        </h1>

        <p class="text-base theme-muted mt-1">
            Monitoring hasil penilaian instansi yang Anda kelola.
        </p>
    </div>


    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- Total Instansi --}}
        <div class="theme-card border theme-border rounded-xl p-5">
            <p class="text-sm theme-muted">
                Total Instansi
            </p>

            <h2 class="text-3xl font-bold theme-title mt-2">
                {{ $totalInstansi }}
            </h2>
        </div>


        {{-- Sudah Dinilai --}}
        <div class="theme-card border theme-border rounded-xl p-5">
            <p class="text-sm theme-muted">
                Sudah Dinilai
            </p>

            <h2 class="text-3xl font-bold mt-2" style="color: #12a89d;">
                {{ $sudahDinilai }}
            </h2>
        </div>


        {{-- Belum Dinilai --}}
        <div class="theme-card border theme-border rounded-xl p-5">
            <p class="text-sm theme-muted">
                Belum Dinilai
            </p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $belumDinilai }}
            </h2>
        </div>

    </div>


    {{-- Tabel Monitoring --}}
    <div class="theme-card border theme-border rounded-xl overflow-hidden">

        <div class="px-6 py-5 border-b theme-border">
            <h2 class="text-lg font-semibold theme-title">
                Daftar Penilaian Instansi
            </h2>

            <p class="text-sm theme-muted mt-1">
                Nilai akhir penilaian masing-masing instansi.
            </p>
        </div>


        <div class="overflow-x-auto">

            <table class="w-full theme-table">

                <thead>
                    <tr>
                        <th class="text-left px-6 py-4">
                            INSTANSI
                        </th>

                        <th class="text-left px-6 py-4">
                            NILAI AKHIR
                        </th>

                        <th class="text-left px-6 py-4">
                            STATUS
                        </th>

                        <th class="text-center px-6 py-4">
                            AKSI
                        </th>
                    </tr>
                </thead>


                <tbody>

                    @forelse ($monitoringList as $item)

                        <tr class="border-t theme-border">

                            {{-- Instansi --}}
                            <td class="px-6 py-4">
                                <div class="font-medium theme-title">
                                    {{ $item->nama_instansi }}
                                </div>

                                <div class="text-sm theme-muted mt-1">
                                    ID: {{ $item->id_instansi }}
                                </div>
                            </td>


                            {{-- Nilai --}}
                            <td class="px-6 py-4">

                                @if ($item->indeks_akhir !== null)

                                    <span class="font-semibold theme-title">
                                        {{ number_format($item->indeks_akhir, 2) }}
                                    </span>

                                @else

                                    <span class="theme-muted">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if ($item->indeks_akhir !== null)

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
                                        style="background-color: rgba(18, 168, 157, 0.12); color: #12a89d;"
                                    >
                                        Sudah Dinilai
                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
                                        style="background-color: rgba(107, 114, 128, 0.12); color: #6b7280;"
                                    >
                                        Belum Dinilai
                                    </span>

                                @endif

                            </td>


                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-center">

                                <a
                                    href="{{ route('monitoring.detail', $item->id_instansi) }}"
                                    class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-[#12a89d] text-white hover:bg-[#0e877e] transition"
                                >
                                    Detail
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="px-6 py-10 text-center theme-muted"
                            >
                                Belum ada data instansi.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection