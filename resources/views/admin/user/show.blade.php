@extends('layouts.sidebar.sidebar-admin')

@section('content')

{{-- NOTIFIKASI BERHASIL --}}
    @if (session('success'))
        <div
            id="success-notification"
            class="fixed right-6 top-6 z-50 flex items-center gap-3 rounded-[10px] border border-[#B7E4DF] bg-white px-5 py-4 shadow-[0_8px_30px_rgba(0,0,0,0.10)]">

            {{-- Icon sukses --}}
            <div class="flex h-[32px] w-[32px] shrink-0 items-center justify-center rounded-full bg-[#E6F7F5] text-[#008F8A]">
                <svg
                    class="h-[17px] w-[17px]"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2">
                    <path
                        d="M5 12L10 17L19 7"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>

            {{-- Pesan --}}
            <div>
                <p class="text-[13px] font-semibold text-[#172B4D]">
                    Berhasil
                </p>

                <p class="mt-0.5 text-[12px] text-[#6D797B]">
                    {{ session('success') }}
                </p>
            </div>

            {{-- Tombol tutup --}}
            <button
                type="button"
                onclick="document.getElementById('success-notification').remove()"
                class="ml-3 text-[18px] leading-none text-[#94A3B8] transition hover:text-[#52605E]">
                &times;
            </button>

        </div>

        {{-- Popup otomatis hilang setelah 4 detik --}}
        <script>
            setTimeout(() => {
                const notification = document.getElementById('success-notification');

                if (notification) {
                    notification.remove();
                }
            }, 4000);
        </script>
    @endif

    {{-- =========================================================
        HEADER ACTION
        ========================================================= --}}
    <div class="flex items-center justify-between">

        {{-- Kembali ke halaman Data User --}}
        <a href="{{ route('admin.user.index') }}"
            class="inline-flex items-center gap-2 text-[13px] font-medium text-[#006671] transition hover:text-[#004F58]">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M19 12H5" stroke-linecap="round" />
                <path d="M10 17L5 12L10 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Kembali
        </a>

        {{-- Action --}}
        <div class="flex items-center gap-3">

            {{-- Edit --}}
            <a href="{{ route('admin.user.edit', $user->id_user) }}"
                class="inline-flex h-[38px] items-center gap-2 rounded-[8px] border border-[#BCC9CB] bg-white px-4 text-[12px] font-medium text-[#006671] transition hover:bg-[#F5FAF9]">

                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 20H8L19 9C19.8 8.2 19.8 6.8 19 6L18 5C17.2 4.2 15.8 4.2 15 5L4 16V20Z"
                        stroke-linejoin="round" />
                    <path d="M13.5 6.5L17.5 10.5" stroke-linecap="round" />
                </svg>

                Edit Pengguna
            </a>

            {{-- Nonaktifkan akses hanya ditampilkan jika user masih aktif --}}
            @if ($user->status === 'AKTIF')
                <a href="#"
                    class="inline-flex h-[38px] items-center gap-2 rounded-[8px] bg-[#FFDAD6] px-4 text-[12px] font-medium text-[#BA1A1A] transition hover:bg-[#FFE8E5]">

                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M8.5 8.5L15.5 15.5" stroke-linecap="round" />
                    </svg>

                    Nonaktifkan Akses
                </a>
            @endif

        </div>
    </div>


    {{-- =========================================================
        PROFILE CARD
        ========================================================= --}}
    <div class="mt-6 rounded-[12px] border border-[#BCC9CB] bg-white px-7 py-6">

        <div class="flex items-center gap-6">

            {{-- Avatar.
                 Karena tabel users belum memiliki kolom foto,
                 sementara menggunakan inisial nama user. --}}
            <div class="flex h-[102px] w-[102px] shrink-0 items-center justify-center rounded-full bg-[#E7F0FF] text-[30px] font-semibold text-[#008F8A]">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            {{-- Informasi utama user --}}
            <div class="min-w-0">

                <div class="flex flex-wrap items-center gap-3">

                    <h1 class="text-[25px] font-semibold leading-none text-[#172B4D]">
                        {{ $user->name }}
                    </h1>

                    {{-- Status --}}
                    @if ($user->status === 'AKTIF')
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#E6F4EA] px-3 py-1 text-[11px] font-semibold text-[#137333]">
                            <span class="h-[6px] w-[6px] rounded-full bg-[#137333]"></span>
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#FFDAD6] px-3 py-1 text-[11px] font-semibold text-[#BA1A1A]">
                            <span class="h-[6px] w-[6px] rounded-full bg-[#BA1A1A]"></span>
                            Nonaktif
                        </span>
                    @endif

                </div>

                {{-- Role + tanggal bergabung --}}
                <p class="mt-2 text-[14px] text-[#52605E]">

                    @if ($user->role?->nama_role === 'USER')
                        PIC Instansi
                    @elseif ($user->role?->nama_role === 'ASESOR')
                        Asesor
                    @elseif ($user->role?->nama_role === 'ADMIN')
                        Administrator
                    @else
                        {{ $user->role?->nama_role ?: '-' }}
                    @endif

                    <span class="mx-1">•</span>

                    Bergabung sejak {{ $user->created_at?->format('d M Y') ?: '-' }}

                </p>

                {{-- Email + nomor telepon --}}
                <div class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-[13px] text-[#52605E]">

                    <span class="inline-flex items-center gap-1.5">
                        <svg class="h-[14px] w-[14px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <path d="M4 7L12 13L20 7" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        {{ $user->email }}
                    </span>

                    @if ($user->no_hp)
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-[14px] w-[14px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M6.5 3.5H9L10.5 8L8.5 9.5C9.5 11.7 12.3 14.5 14.5 15.5L16 13.5L20.5 15V17.5C20.5 19.2 19.2 20.5 17.5 20.5C9.8 20 4 14.2 3.5 6.5C3.5 4.8 4.8 3.5 6.5 3.5Z"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            {{ $user->no_hp }}
                        </span>
                    @endif

                </div>

            </div>
        </div>
    </div>


    {{-- =========================================================
        MAIN CONTENT
        Kolom kiri lebih besar, kolom kanan untuk aktivitas.
        ========================================================= --}}
    <div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-[minmax(0,2fr)_335px]">

        {{-- =====================================================
            KOLOM KIRI
            ===================================================== --}}
        <div class="space-y-6">

            {{-- -------------------------------------------------
                INFORMASI PRIBADI & KEDINASAN
                ------------------------------------------------- --}}
            <div class="rounded-[12px] border border-[#BCC9CB] bg-white p-6">

                {{-- Heading --}}
                <div class="flex items-center gap-3">

                    <svg class="h-[19px] w-[19px] text-[#006F75]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="5" y="3" width="14" height="18" rx="2" />
                        <circle cx="12" cy="9" r="2.5" />
                        <path d="M8.5 16C9.5 13.5 14.5 13.5 15.5 16" stroke-linecap="round" />
                    </svg>

                    <h2 class="text-[17px] font-semibold text-[#172B4D]">
                        Informasi Pribadi & Kedinasan
                    </h2>

                </div>

                <div class="mt-4 border-t border-[#C9D5D2]"></div>

                {{-- Data --}}
                <div class="mt-5 grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-2">

                    <div>
                        <p class="text-[11px] font-semibold uppercase text-[#52605E]">
                            NIP / ID PEGAWAI
                        </p>
                        <p class="mt-2 text-[13px] font-medium text-[#172B4D]">
                            {{ $user->nip ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-semibold uppercase text-[#52605E]">
                            INSTANSI
                        </p>
                        <p class="mt-2 text-[13px] font-medium text-[#006671]">
                            {{ $user->instansi?->nama_instansi ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-semibold uppercase text-[#52605E]">
                            JABATAN
                        </p>
                        <p class="mt-2 text-[13px] font-medium text-[#172B4D]">
                           {{ $user->jabatan ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-[11px] font-semibold uppercase text-[#52605E]">
                            UNIT KERJA
                        </p>
                        <p class="mt-2 text-[13px] font-medium text-[#172B4D]">
                            {{ $user->unit_kerja ?: '-' }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- -------------------------------------------------
                AKSES & PERAN
                ------------------------------------------------- --}}
            <div class="rounded-[12px] border border-[#BCC9CB] bg-white p-6">

                {{-- Heading --}}
                <div class="flex items-center gap-3">

                    <svg class="h-[19px] w-[19px] text-[#006F75]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M12 3L19 6V11C19 15.5 16.2 19 12 21C7.8 19 5 15.5 5 11V6L12 3Z"
                            stroke-linejoin="round" />
                        <path d="M9 12L11 14L15 10" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <h2 class="text-[17px] font-semibold text-[#172B4D]">
                        Akses & Peran
                    </h2>

                </div>

                <div class="mt-4 border-t border-[#C9D5D2]"></div>

                <div class="mt-5 space-y-3">

                    {{-- Role utama --}}
                    <div class="rounded-[8px] border border-[#D2E0FF] bg-[#F7F9FF] px-4 py-3">

                        <div class="flex gap-3">

                            <div class="mt-0.5 flex h-[18px] w-[18px] shrink-0 items-center justify-center text-[#006F75]">
                                <svg class="h-[16px] w-[16px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M8 12L10.5 14.5L16 9" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-[13px] font-semibold text-[#172B4D]">
                                    @if ($user->role?->nama_role === 'USER')
                                        PIC Instansi Utama
                                    @elseif ($user->role?->nama_role === 'ASESOR')
                                        Asesor
                                    @else
                                        Administrator
                                    @endif
                                </p>

                                <p class="mt-1 text-[12px] leading-5 text-[#52605E]">
                                    @if ($user->role?->nama_role === 'USER')
                                        Memiliki akses untuk mengelola data dan evaluasi pada instansi terkait.
                                    @elseif ($user->role?->nama_role === 'ASESOR')
                                        Memiliki akses untuk melakukan verifikasi dan penilaian evaluasi.
                                    @else
                                        Peran pengguna yang terdaftar pada sistem.
                                    @endif
                                </p>
                            </div>

                        </div>

                    </div>

                    {{-- Hak akses tambahan --}}
                    @if ($user->role?->nama_role === 'ADMIN')

                        <div class="rounded-[8px] border border-[#D2E0FF] bg-[#F7F9FF] px-4 py-3">

                            <div class="flex gap-3">

                                <div class="mt-0.5 flex h-[18px] w-[18px] shrink-0 items-center justify-center text-[#006F75]">
                                    <svg class="h-[16px] w-[16px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="9" />
                                        <path d="M8 12L10.5 14.5L16 9" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-[13px] font-semibold text-[#172B4D]">
                                        Akses Penuh
                                    </p>

                                    <p class="mt-1 text-[12px] leading-5 text-[#52605E]">
                                        Memiliki akses penuh untuk mengelola seluruh data dan evaluasi pada sistem.
                                    </p>
                                </div>

                            </div>

                        </div>

                    @elseif ($user->role?->nama_role === 'USER')

                        <div class="rounded-[8px] border border-[#D2E0FF] bg-[#F7F9FF] px-4 py-3">

                            <div class="flex gap-3">

                                <div class="mt-0.5 flex h-[18px] w-[18px] shrink-0 items-center justify-center text-[#006F75]">
                                    <svg class="h-[16px] w-[16px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="9" />
                                        <path d="M8 12L10.5 14.5L16 9" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-[13px] font-semibold text-[#172B4D]">
                                        Pengunggah Bukti
                                    </p>

                                    <p class="mt-1 text-[12px] leading-5 text-[#52605E]">
                                        Dapat mengunggah dan memodifikasi dokumen bukti indikator penilaian.
                                    </p>
                                </div>

                            </div>

                        </div>

                    @endif

                </div>
            </div>

        </div>


        {{-- =====================================================
            KOLOM KANAN - AKTIVITAS
            ===================================================== --}}
        <div>

            <div class="rounded-[12px] border border-[#BCC9CB] bg-white p-6">

                {{-- Heading --}}
                <div class="flex items-center gap-3">

                    <svg class="h-[19px] w-[19px] text-[#006F75]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <circle cx="12" cy="12" r="8.5" />
                        <path d="M12 7V12L15 14" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <h2 class="text-[17px] font-semibold text-[#172B4D]">
                        Aktivitas Terakhir
                    </h2>

                </div>

                <div class="mt-4 border-t border-[#C9D5D2]"></div>

                {{-- Timeline --}}
                <div class="relative mt-6 min-h-[300px]">

                    @if ($user->last_login)

                        {{-- Garis timeline --}}
                        <div class="absolute left-[7px] top-[8px] bottom-[20px] w-px bg-[#CBD5D7]"></div>

                        {{-- Aktivitas login --}}
                        <div class="relative pl-8">

                            {{-- Titik aktif --}}
                            <span class="absolute left-0 top-[4px] h-[15px] w-[15px] rounded-full border-[3px] border-white bg-[#006F75] shadow-[0_0_0_1px_#006F75]"></span>

                            <p class="text-[13px] font-semibold text-[#172B4D]">
                                Login ke sistem
                            </p>

                            <p class="mt-1 text-[12px] leading-5 text-[#52605E]">
                                {{ $user->last_login->format('d M Y, H:i') }} WIB
                            </p>

                        </div>

                    @else

                        <div class="flex min-h-[250px] items-center justify-center text-center">
                            <p class="text-[12px] text-[#6D797B]">
                                Belum ada aktivitas tercatat.
                            </p>
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

@endsection