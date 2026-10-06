    {{-- TABLE --}}
    <div id="userTable">
        <div class="mt-5 overflow-hidden rounded-[12px] border border-[#BCC9CB] bg-white">

            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    <thead class="bg-[#F5F7F8]">
                        <tr class="text-left text-[12px] font-semibold uppercase text-[#434654]">
                            <th class="px-5 py-4 text-center">No</th>
                            <th class="px-5 py-4">Informasi User</th>
                            <th class="px-5 py-4">Peran</th>
                            <th class="px-5 py-4">Instansi Terkait</th>
                            <th class="px-5 py-4">Status</th>
                            <th class="px-5 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-[13px] text-[#434654]">

                        @forelse ($users as $user)

                            <tr class="border-t border-[#D9D9D9]">

                                {{-- NOMOR --}}
                                <td class="px-5 py-5 text-center">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                {{-- INFORMASI USER --}}
                                <td class="px-5 py-5">
                                    <p class="font-semibold text-[#006671]">
                                        {{ $user->name }}
                                    </p>

                                    <p class="mt-1 text-[12px] text-[#7A8587]">
                                        {{ $user->email }}
                                    </p>
                                </td>

                                {{-- PERAN --}}
                                <td class="px-5 py-5">
                                    @if ($user->role)
                                        @if ($user->role->nama_role === 'ADMIN')
                                            <span class="inline-flex rounded-[6px] bg-[#EEF2F7] px-3 py-1.5 text-[12px] font-medium text-[#526174]">
                                                Administrator
                                            </span>
                                        @elseif ($user->role->nama_role === 'USER')
                                            <span class="inline-flex rounded-[6px] bg-[#EEF4FF] px-3 py-1.5 text-[12px] font-medium text-[#2563EB]">
                                                PIC Instansi
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-[6px] bg-[#FFF3D6] px-3 py-1.5 text-[12px] font-medium text-[#D97706]">
                                                Asesor
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-[#9CA3AF]">-</span>
                                    @endif
                                </td>

                                {{-- INSTANSI --}}
                                <td class="px-5 py-5">
                                    @if ($user->instansi)
                                        <span class="text-[#434654]">
                                            {{ $user->instansi->nama_instansi }}
                                        </span>
                                    @else
                                        <span class="text-[#9CA3AF]">-</span>
                                    @endif
                                </td>

                                {{-- STATUS --}}
                                <td class="px-5 py-5">
                                    @if ($user->status === 'AKTIF')
                                        <span class="inline-flex items-center gap-2 rounded-full bg-[#E6F8F0] px-3 py-1.5 text-[12px] font-medium text-[#00966D]">
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#00966D]"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 rounded-full bg-[#FFF0F0] px-3 py-1.5 text-[12px] font-medium text-[#D92929]">
                                            <span class="h-1.5 w-1.5 rounded-full bg-[#D92929]"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="px-5 py-5 text-center">
                                    <a href="{{ route('admin.user.show', $user->id_user) }}" class="inline-flex rounded-[7px] border border-[#BCC9CB] px-4 py-2 text-[12px] font-medium text-[#006671] transition hover:bg-[#F1FAF9]">
                                        Detail
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center text-[13px] text-[#6D797B]">
                                    Belum ada data user.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
