{{-- =========================================================
    TABLE DATA ASESOR
    ========================================================= --}}

<div class="overflow-x-auto">

    <table class="w-full min-w-[1000px]">

        {{-- =====================================================
            HEADER TABLE
            ===================================================== --}}
        <thead class="bg-[#F8F9FC]">

            <tr class="border-b border-[#D9D9D9] text-left text-[12px] font-semibold uppercase tracking-wide text-[#434654]">

                <th class="px-6 py-4 text-center">
                    No
                </th>

                <th class="px-6 py-4">
                    ID Asesor
                </th>

                <th class="px-6 py-4">
                    Nama Asesor
                </th>

                <th class="px-6 py-4">
                    Instansi Asal
                </th>

                <th class="px-6 py-4">
                    Status
                </th>

                <th class="px-6 py-4 text-center">
                    Aksi
                </th>

            </tr>

        </thead>


        {{-- =====================================================
            BODY TABLE
            ===================================================== --}}
        <tbody class="text-[13px] text-[#434654]">

            @forelse ($asesors as $asesor)

                <tr class="border-b border-[#E5E7EB] transition hover:bg-[#FAFCFC]">

                    {{-- NOMOR --}}
                    <td class="px-6 py-5 text-center text-[#434654]">
                        {{ $asesors->firstItem() + $loop->index }}
                    </td>


                    {{-- ID ASESOR --}}
                    <td class="px-6 py-5">

                        <span class="font-semibold text-[#14213D]">
                            ASR-{{ str_pad($asesor->id_asesor, 3, '0', STR_PAD_LEFT) }}
                        </span>

                    </td>


                    {{-- NAMA ASESOR --}}
                    <td class="px-6 py-5">

                        @if ($asesor->user)

                            <p class="font-semibold text-[#006671]">
                                {{ $asesor->user->name }}
                            </p>

                            <p class="mt-1 text-[12px] text-[#64748B]">
                                {{ $asesor->user->email }}
                            </p>

                        @else

                            <span class="text-[#9CA3AF]">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- INSTANSI ASAL --}}
                    <td class="px-6 py-5">

                        @if ($asesor->instansi)

                            <p class="max-w-[220px] leading-5 text-[#434654]">
                                {{ $asesor->instansi->nama_instansi }}
                            </p>

                        @else

                            <span class="text-[#9CA3AF]">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- STATUS --}}
                    <td class="px-6 py-5">

                        @if ($asesor->status === 'AKTIF')

                            <span class="inline-flex items-center gap-2 rounded-full bg-[#E6F8F1] px-3 py-1.5 text-[11px] font-medium text-[#009B68]">

                                <span class="h-[6px] w-[6px] rounded-full bg-[#009B68]"></span>

                                Aktif

                            </span>

                        @else

                            <span class="inline-flex items-center gap-2 rounded-full bg-[#FFE9E7] px-3 py-1.5 text-[11px] font-medium text-[#D92D20]">

                                <span class="h-[6px] w-[6px] rounded-full bg-[#D92D20]"></span>

                                Nonaktif

                            </span>

                        @endif

                    </td>


                    {{-- AKSI --}}
                    <td class="px-6 py-5 text-center">

                        <a
                            href="{{ route('admin.asesor.show', $asesor->id_asesor) }}"
                            class="inline-flex items-center justify-center rounded-[7px] border border-[#BCC9CB] px-4 py-2 text-[12px] font-medium text-[#006671] transition hover:bg-[#F1FAF9]"
                        >
                            Detail
                        </a>

                    </td>

                </tr>

            @empty

                {{-- JIKA DATA KOSONG --}}
                <tr>

                    <td
                        colspan="6"
                        class="px-6 py-12 text-center text-[13px] text-[#6D797B]"
                    >
                        Belum ada data asesor.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


{{-- =========================================================
    FOOTER TABLE + PAGINATION
    ========================================================= --}}
<div class="flex flex-col gap-3 border-t border-[#D9D9D9] px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

    {{-- Informasi jumlah data --}}
    <p class="text-[13px] text-[#6D797B]">

        @if ($asesors->total() > 0)

            Menampilkan
            {{ $asesors->firstItem() }}
            -
            {{ $asesors->lastItem() }}
            dari
            {{ $asesors->total() }}
            data asesor

        @else

            Menampilkan 0 data asesor

        @endif

    </p>


    {{-- Pagination Laravel --}}
    <div>
        {{ $asesors->links() }}
    </div>

</div>