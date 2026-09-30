{{-- TABLE --}}
<div class="overflow-x-auto">

    <table class="theme-table w-full min-w-[800px] text-left text-sm">

        {{-- TABLE HEADER --}}
        <thead class="theme-table-head">

            @php
                $nextDir = request('direction') == 'asc' ? 'desc' : 'asc';
            @endphp

            <tr>

                {{-- INSTANSI --}}
                <th class="px-6 py-3 font-semibold">

                    <a href="{{ route('asesor.dashboard', array_merge(request()->query(), [
                        'sort' => 'instansi',
                        'direction' => $nextDir
                    ])) }}"
                       class="ajax-sort inline-flex items-center gap-1 transition hover:text-teal-600">

                        Instansi

                        @if(request('sort') == 'instansi')
                            <span>
                                {{ request('direction') == 'asc' ? '↑' : '↓' }}
                            </span>
                        @endif

                    </a>

                </th>


                {{-- INDIKATOR --}}
                <th class="px-4 py-3 font-semibold">

                    <a href="{{ route('asesor.dashboard', array_merge(request()->query(), [
                        'sort' => 'indikator',
                        'direction' => $nextDir
                    ])) }}"
                       class="ajax-sort inline-flex items-center gap-1 transition hover:text-teal-600">

                        Indikator

                        @if(request('sort') == 'indikator')
                            <span>
                                {{ request('direction') == 'asc' ? '↑' : '↓' }}
                            </span>
                        @endif

                    </a>

                </th>


                {{-- TANGGAL --}}
                <th class="px-4 py-3 font-semibold">

                    <div class="flex items-center gap-2">

                        <a href="{{ route('asesor.dashboard', array_merge(request()->query(), [
                            'sort' => 'created_at',
                            'direction' => $nextDir
                        ])) }}"
                           class="ajax-sort inline-flex items-center gap-1 transition hover:text-teal-600">

                            Tanggal Upload

                            @if(request('sort', 'created_at') == 'created_at')
                                <span>
                                    {{ request('direction') == 'asc' ? '↑' : '↓' }}
                                </span>
                            @endif

                        </a>


                        {{-- CALENDAR FILTER --}}
                        <div class="inline-flex items-center">

                            <input type="date"
                                   id="tanggal-filter"
                                   name="tanggal"
                                   value="{{ request('tanggal') }}"
                                   title="Filter berdasarkan tanggal"
                                   class="h-6 w-6 cursor-pointer border-0 bg-transparent p-0 text-transparent focus:ring-0 [color-scheme:light]">

                            @if(request('tanggal'))

                                <button type="button"
                                        id="reset-tanggal"
                                        title="Hapus Filter Tanggal"
                                        class="ml-1 text-xs font-medium text-rose-500 transition hover:text-rose-600">

                                    ✕

                                </button>

                            @endif

                        </div>

                    </div>

                </th>


                {{-- STATUS --}}
                <th class="px-4 py-3 font-semibold">

                    <div class="flex items-center gap-2">

                        <a href="{{ route('asesor.dashboard', array_merge(request()->query(), [
                            'sort' => 'status',
                            'direction' => $nextDir
                        ])) }}"
                           class="ajax-sort inline-flex items-center gap-1 transition hover:text-teal-600">

                            Status

                            @if(request('sort') == 'status')
                                <span>
                                    {{ request('direction') == 'asc' ? '↑' : '↓' }}
                                </span>
                            @endif

                        </a>


                        {{-- STATUS FILTER --}}
                        <select id="status-filter"
                                name="status"
                                class="cursor-pointer rounded-lg border-0 bg-transparent p-1 text-xs font-semibold text-gray-500 focus:ring-0 hover:text-teal-600 dark:text-gray-400">

                            <option value="">
                                Semua
                            </option>

                            <option value="MENUNGGU"
                                {{ request('status') == 'MENUNGGU' ? 'selected' : '' }}>
                                Menunggu
                            </option>

                            <option value="SELESAI"
                                {{ request('status') == 'SELESAI' ? 'selected' : '' }}>
                                Selesai
                            </option>

                        </select>

                    </div>

                </th>


                {{-- AKSI --}}
                <th class="px-4 py-3 text-center font-semibold">
                    Aksi
                </th>

            </tr>

        </thead>


        {{-- TABLE BODY --}}
        <tbody>

            @forelse ($tugasVerifikasi as $tugas)

                <tr class="theme-table-row border-b transition hover:bg-teal-50/40 dark:hover:bg-teal-900/10">

                    {{-- INSTANSI --}}
                    <td class="px-6 py-3">

                        <p class="theme-title font-medium">
                            {{ $tugas->nama_instansi }}
                        </p>

                    </td>


                    {{-- INDIKATOR --}}
                    <td class="theme-text px-4 py-3">

                        <span class="font-medium">
                            {{ $tugas->kode_indikator }}
                        </span>

                        <br>

                        <span class="text-sm opacity-80">
                            {{ Str::limit($tugas->nama_indikator, 30) }}
                        </span>

                    </td>


                    {{-- TANGGAL --}}
                    <td class="theme-text whitespace-nowrap px-4 py-3">

                        {{ \Carbon\Carbon::parse($tugas->created_at)->translatedFormat('d M Y') }}

                    </td>


                    {{-- STATUS --}}
                    <td class="px-4 py-3">

                        @if($tugas->status_pengisian == 'DIVERIFIKASI')

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700">

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                Selesai

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1.5 text-xs font-semibold text-amber-700">

                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                Menunggu

                            </span>

                        @endif

                    </td>


                    {{-- AKSI --}}
                    <td class="px-4 py-3 text-center">

                        <a href="{{ route('asesor.verifikasi.detail', $tugas->id_dokumen) }}"
                           class="inline-flex items-center gap-1.5 rounded-xl border border-teal-200 px-3.5 py-2 text-xs font-semibold text-teal-600 transition hover:border-teal-300 hover:bg-teal-50 dark:border-teal-800 dark:hover:bg-teal-900/20">

                            Review

                            <svg class="h-3.5 w-3.5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 5l7 7-7 7"/>

                            </svg>

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="px-6 py-8 text-center">

                        <div class="flex flex-col items-center">

                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-teal-100 text-teal-600 dark:bg-teal-900/20 dark:text-teal-400">

                                <svg class="h-8 w-8"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"/>

                                </svg>

                            </div>

                            <p class="theme-title mt-4 font-semibold">
                                Tidak Ada Tugas
                            </p>

                            <p class="theme-muted mt-1 text-sm">
                                Tidak ada tugas verifikasi yang sesuai.
                            </p>

                        </div>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


{{-- FOOTER & PAGINATION --}}
<div class="theme-footer flex flex-col gap-3 border-t px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

    <span class="theme-muted text-sm">

        Menampilkan

        <span class="font-semibold">
            {{ $tugasVerifikasi->count() }}
        </span>

        data verifikasi

    </span>


    {{-- PAGINATION --}}
    <div class="flex items-center gap-1 pagination-container">

        {{ $tugasVerifikasi->links('pagination::tailwind') }}

    </div>

</div>