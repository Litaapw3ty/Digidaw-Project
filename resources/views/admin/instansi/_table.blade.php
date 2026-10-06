{{-- =========================================================
    TABLE DATA INSTANSI
    ========================================================= --}}
<div class="mt-5 overflow-hidden rounded-[12px] border border-[#BCC9CB] bg-white">

    <div class="overflow-x-auto">

        <table class="w-full min-w-[850px]">

            {{-- HEADER TABLE --}}
            <thead class="bg-[#F5F7F8]">
                <tr class="text-left text-[12px] font-semibold uppercase text-[#434654]">
                    <th class="px-5 py-4 text-center">No</th>
                    <th class="px-5 py-4">Kode Instansi</th>
                    <th class="px-5 py-4">Nama Instansi</th>
                    <th class="px-5 py-4">User / PIC</th>
                    <th class="px-5 py-4">Status</th>
                    <th class="px-5 py-4 text-center">Aksi</th>
                </tr>
            </thead>


            {{-- ISI TABLE --}}
            <tbody class="text-[13px] text-[#434654]">

                @forelse ($instansi as $item)

                    <tr class="border-t border-[#D9D9D9]">

                        {{-- Nomor urut --}}
                        <td class="px-5 py-4 text-center">
                            {{ $instansi->firstItem() + $loop->index }}
                        </td>


                        {{-- Kode instansi --}}
                        <td class="px-5 py-4 font-medium text-[#1F1F1F]">
                            {{ $item->kode_instansi }}
                        </td>


                        {{-- Nama instansi --}}
                        <td class="px-5 py-4">
                            <span class="font-medium text-[#434654]">
                                {{ $item->nama_instansi }}
                            </span>
                        </td>


                        {{-- User / PIC --}}
                        <td class="px-5 py-4">

                            @php
                                // Mengambil User/PIC pertama yang terhubung
                                // dengan instansi tersebut.
                                $pic = $item->users->first();
                            @endphp

                            @if ($pic)
                                <p class="font-medium text-[#434654]">
                                    {{ $pic->name }}
                                </p>

                                <p class="mt-1 text-[11px] text-[#6D797B]">
                                    {{ $pic->email }}
                                </p>
                            @else
                                <span class="text-[#9CA3AF]">-</span>
                            @endif

                        </td>


                        {{-- Status --}}
                        <td class="px-5 py-4">

                            @if ($item->status === 'AKTIF')
                                <span class="inline-flex rounded-[5px] bg-[#E6F4EA] px-3 py-[5px] text-[11px] font-medium text-[#137333]">
                                    • Aktif
                                </span>
                            @else
                                <span class="inline-flex rounded-[5px] bg-[#FFDAD6] px-3 py-[5px] text-[11px] font-medium text-[#BA1A1A]">
                                    • Nonaktif
                                </span>
                            @endif

                        </td>


                        {{-- Aksi --}}
                        <td class="px-5 py-4 text-center">

                            <a href="{{ route('admin.instansi.show', $item->id_instansi) }}" class="inline-flex rounded-[6px] border border-[#BCC9CB] px-4 py-1.5 text-[12px] font-medium text-[#008F8A] transition hover:bg-[#F1FAF9]">
                                Detail
                            </a>

                        </td>

                    </tr>

                @empty

                    {{-- Jika data tidak ditemukan --}}
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-[13px] text-[#6D797B]">
                            Belum ada data instansi.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>
    </div>


    {{-- =====================================================
        FOOTER & PAGINATION
        ===================================================== --}}
    <div class="flex flex-col gap-3 border-t border-[#D9D9D9] px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

        {{-- Informasi jumlah data --}}
        <p class="text-[12px] text-[#6D797B]">

            @if ($instansi->total() > 0)
                Menampilkan
                {{ $instansi->firstItem() }}
                -
                {{ $instansi->lastItem() }}
                dari
                {{ $instansi->total() }}
                data
            @else
                Menampilkan 0 data
            @endif

        </p>


        {{-- Pagination --}}
        <div>
            {{ $instansi->links() }}
        </div>

    </div>

</div>