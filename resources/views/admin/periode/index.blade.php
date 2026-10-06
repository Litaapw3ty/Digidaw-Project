@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- =========================================================
         HEADER HALAMAN
    ========================================================== --}}
    <div class="mb-6">

        <h1 class="text-[28px] font-semibold leading-tight text-[#202B3C]">
            Pengaturan Sistem
        </h1>

        <p class="mt-1 text-[16px] text-[#667793]">
            Konfigurasi periode pengisian mandiri dan masa evaluasi asesor.
        </p>

    </div>


    {{-- =========================================================
         PESAN SUKSES
    ========================================================== --}}
    @if (session('success'))
        <div class="mb-5 rounded-[10px] border border-[#BFE7E3] bg-[#F0FBFA] px-4 py-3 text-[13px] text-[#087F78]">
            {{ session('success') }}
        </div>
    @endif


    {{-- =========================================================
         PESAN VALIDASI
    ========================================================== --}}
    @if ($errors->any())
        <div class="mb-5 rounded-[10px] border border-red-200 bg-red-50 px-4 py-3 text-[13px] text-red-600">

            <ul class="list-disc space-y-1 pl-5">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>
    @endif


    {{-- =========================================================
         FORM PENGATURAN
    ========================================================== --}}
    <form action="{{ route('admin.pengaturan.update') }}" method="POST">

        @csrf
        @method('PUT')

        {{-- Tahun tetap dikirim supaya periode tetap terhubung
             dengan tahun anggaran yang sedang dikonfigurasi. --}}
        <input
            type="hidden"
            name="tahun_anggaran"
            value="{{ old('tahun_anggaran', $periode?->tahun_anggaran ?? now()->year) }}"
        >


        <div class="grid grid-cols-1 gap-7 xl:grid-cols-[minmax(0,1fr)_370px]">


            {{-- =================================================
                 KOLOM KIRI
            ================================================== --}}
            <div class="space-y-7">


                {{-- =============================================
                     PERIODE PENGISIAN MANDIRI
                ============================================== --}}
                <div class="rounded-[15px] border border-[#BCC9CB] bg-white">

                    {{-- HEADER --}}
                    <div class="flex items-start justify-between gap-5 px-7 py-6">

                        <div>

                            <div class="flex items-center gap-4">

                                {{-- Icon kalender --}}
                                <div class="text-[#006671]">

                                    <svg
                                        class="h-[24px] w-[24px]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <rect
                                            x="3"
                                            y="4"
                                            width="18"
                                            height="17"
                                            rx="2"
                                            stroke-width="1.6"
                                        ></rect>

                                        <path
                                            stroke-linecap="round"
                                            stroke-width="1.6"
                                            d="M8 2v4M16 2v4M3 9h18"
                                        ></path>

                                        <path
                                            stroke-linecap="round"
                                            stroke-width="1.6"
                                            d="M8 13h3M8 17h3"
                                        ></path>
                                    </svg>

                                </div>

                                <h2 class="text-[20px] font-semibold text-[#202B3C]">
                                    Periode Pengisian Mandiri
                                </h2>

                            </div>

                            <p class="mt-2 text-[16px] text-[#667793]">
                                Jadwal instansi untuk mengunggah bukti dukung.
                            </p>

                        </div>

                        {{-- TOGGLE STATUS --}}
                    <label class="flex shrink-0 cursor-pointer items-center gap-3">

                        {{-- Nilai 0 dikirim kalau toggle dalam kondisi nonaktif. --}}
                        <input
                            type="hidden"
                            name="status_pengisian_aktif"
                            value="0"
                        >

                        {{-- Checkbox ini menjadi sumber nilai status aktif/nonaktif. --}}
                        <input
                            type="checkbox"
                            id="status_pengisian_aktif"
                            name="status_pengisian_aktif"
                            value="1"
                            class="peer sr-only"
                            @checked(old('status_pengisian_aktif', $periode?->status_pengisian_aktif))
                        >

                        {{-- Tampilan toggle. --}}
                        <span
                            class="relative h-[30px] w-[54px] rounded-full bg-[#AEB9BD] transition peer-checked:bg-[#006671]"
                        >
                            <span
                            id="toggle-bullet"
                            class="absolute left-[4px] top-[4px] h-[22px] w-[22px] rounded-full bg-white transition-all duration-200"></span>
                        </span>

                        {{-- Label status. --}}
                        <span
                            class="text-[14px] font-semibold text-[#006671]"
                            id="status-pengisian-label"
                        >
                            {{ old('status_pengisian_aktif', $periode?->status_pengisian_aktif) ? 'Aktif' : 'Nonaktif' }}
                        </span>

                    </label>
                    </div>
                    {{-- TANGGAL --}}
                    <div class="grid grid-cols-1 gap-5 px-7 pb-7 md:grid-cols-2">

                        <div>

                            <label
                                for="tanggal_mulai_pengisian"
                                class="mb-2 block text-[14px] font-medium text-[#3D484B]"
                            >
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                id="tanggal_mulai_pengisian"
                                name="tanggal_mulai_pengisian"
                                value="{{ old('tanggal_mulai_pengisian', $periode?->tanggal_mulai_pengisian?->format('Y-m-d')) }}"
                                class="h-[54px] w-full rounded-[10px] border border-[#C9D3DD] bg-[#F8F9FC] px-4 text-[15px] text-[#26354A] outline-none focus:border-[#0E9F95]"
                            >

                        </div>


                        <div>

                            <label
                                for="tanggal_selesai_pengisian"
                                class="mb-2 block text-[14px] font-medium text-[#3D484B]"
                            >
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                id="tanggal_selesai_pengisian"
                                name="tanggal_selesai_pengisian"
                                value="{{ old('tanggal_selesai_pengisian', $periode?->tanggal_selesai_pengisian?->format('Y-m-d')) }}"
                                class="h-[54px] w-full rounded-[10px] border border-[#C9D3DD] bg-[#F8F9FC] px-4 text-[15px] text-[#26354A] outline-none focus:border-[#0E9F95]"
                            >

                        </div>

                    </div>

                </div>


                {{-- =============================================
                     PERIODE EVALUASI ASESOR
                ============================================== --}}
                <div class="rounded-[15px] border border-[#BCC9CB] bg-white">

                    {{-- HEADER --}}
                    <div class="px-7 py-6">

                        <div class="flex items-center gap-4">

                            {{-- Icon evaluasi --}}
                            <div class="text-[#26354A]">

                                <svg
                                    class="h-[24px] w-[24px]"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.6"
                                        d="M5 4h14M5 8h14M5 12h9M5 16h9M5 20h14"
                                    ></path>

                                    <path
                                        stroke-linecap="round"
                                        stroke-width="1.6"
                                        d="M18 11v6M15 14h6"
                                    ></path>
                                </svg>

                            </div>

                            <h2 class="text-[20px] font-semibold text-[#202B3C]">
                                Periode Evaluasi Asesor
                            </h2>

                        </div>

                        <p class="mt-2 text-[16px] text-[#667793]">
                            Jadwal asesor melakukan penilaian dan verifikasi.
                        </p>

                    </div>


                    {{-- TANGGAL --}}
                    <div class="grid grid-cols-1 gap-5 px-7 pb-7 md:grid-cols-2">

                        <div>

                            <label
                                for="tanggal_mulai_asesor"
                                class="mb-2 block text-[14px] font-medium text-[#3D484B]"
                            >
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                id="tanggal_mulai_asesor"
                                name="tanggal_mulai_asesor"
                                value="{{ old('tanggal_mulai_asesor', $periode?->tanggal_mulai_asesor?->format('Y-m-d')) }}"
                                class="h-[54px] w-full rounded-[10px] border border-[#C9D3DD] bg-[#F8F9FC] px-4 text-[15px] text-[#26354A] outline-none focus:border-[#0E9F95]"
                            >

                        </div>


                        <div>

                            <label
                                for="tanggal_selesai_asesor"
                                class="mb-2 block text-[14px] font-medium text-[#3D484B]"
                            >
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                id="tanggal_selesai_asesor"
                                name="tanggal_selesai_asesor"
                                value="{{ old('tanggal_selesai_asesor', $periode?->tanggal_selesai_asesor?->format('Y-m-d')) }}"
                                class="h-[54px] w-full rounded-[10px] border border-[#C9D3DD] bg-[#F8F9FC] px-4 text-[15px] text-[#26354A] outline-none focus:border-[#0E9F95]"
                            >

                        </div>

                    </div>

                </div>


                {{-- =============================================
                     TOMBOL SIMPAN
                ============================================== --}}
                <div class="flex justify-end">

                    <button
                        type="submit"
                        class="rounded-[9px] bg-[#0E9F95] px-6 py-3 text-[14px] font-semibold text-white transition hover:bg-[#0B8981]"
                    >
                        Simpan Perubahan
                    </button>

                </div>

            </div>


            {{-- =================================================
                 KOLOM KANAN
            ================================================== --}}
            <div>

                {{-- =============================================
                     INFORMASI SISTEM
                ============================================== --}}
                <div class="rounded-[15px] border border-[#AFCBE8] bg-[#EAF3FF] px-7 py-6">

                    <div class="flex items-start gap-4">

                        <div class="shrink-0 text-[#006671]">

                            <svg
                                class="h-[22px] w-[22px]"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="9"
                                    stroke-width="1.6"
                                ></circle>

                                <path
                                    stroke-linecap="round"
                                    stroke-width="1.6"
                                    d="M12 10v6"
                                ></path>

                                <circle
                                    cx="12"
                                    cy="7"
                                    r="0.8"
                                    fill="currentColor"
                                    stroke="none"
                                ></circle>
                            </svg>

                        </div>


                        <div>

                            <h3 class="text-[16px] font-semibold text-[#202B3C]">
                                Informasi Sistem
                            </h3>

                            <p class="mt-2 text-[16px] leading-[1.65] text-[#52616B]">
                                Perubahan periode akan otomatis menonaktifkan
                                fitur unggah/evaluasi bagi pengguna jika berada
                                di luar rentang tanggal yang ditentukan.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

<script>
    const toggleStatus = document.getElementById('status_pengisian_aktif');
    const statusLabel = document.getElementById('status-pengisian-label');
    const toggleBullet = document.getElementById('toggle-bullet');

    // Mengatur posisi bullet berdasarkan kondisi toggle.
    function updateToggle() {
        if (toggleStatus.checked) {
            toggleBullet.style.transform = 'translateX(24px)';
            statusLabel.textContent = 'Aktif';
        } else {
            toggleBullet.style.transform = 'translateX(0)';
            statusLabel.textContent = 'Nonaktif';
        }
    }

    // Jalankan saat halaman pertama kali dibuka.
    updateToggle();

    // Jalankan setiap kali toggle diklik.
    toggleStatus.addEventListener('change', updateToggle);
</script>
@endsection