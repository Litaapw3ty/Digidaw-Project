@extends('layouts.sidebar.sidebar-admin')

@section('content')

<div class="px-1 py-1">

    {{-- Header halaman --}}
    <div>
        <h1 class="text-[28px] font-semibold leading-tight text-[#202B3C]">
            Hasil Evaluasi
        </h1>

        <p class="mt-1 text-[16px] text-[#667793]">
            Tinjau dan kelola nilai akhir seluruh kabupaten/kota yang telah melewati tahap verifikasi dan penilaian asesor.
        </p>
    </div>

    {{-- Target Nasional --}}
    <form action="{{ route('admin.hasil-evaluasi.target.update') }}"
          method="POST"
          class="mt-6 rounded-[15px] border border-[#DCE4EC] bg-white p-5 shadow-sm">

        @csrf
        @method('PUT')

        {{-- Header Target Nasional --}}
        <div class="flex items-center gap-3">

            <div>
                <h2 class="text-[15px] font-semibold text-[#202B3C]">
                    Target Nasional
                </h2>

                <p class="mt-0.5 text-[11px] text-[#8A97AA]">
                    Indeks SPBE target nasional untuk tahun berjalan.
                </p>
            </div>
        </div>

        {{-- Input Target --}}
        <div class="mt-5 flex flex-col gap-4 lg:flex-row lg:items-end">

            {{-- Tahun Anggaran --}}
            <div class="w-full lg:w-[260px]">
                <label class="mb-1.5 block text-[11px] font-medium text-[#52627A]">
                    Tahun Anggaran
                </label>

                <select name="tahun_anggaran"
                        class="h-[38px] w-full rounded-md border border-[#CBD6E2] bg-white px-3 text-[12px] text-[#52627A] outline-none transition focus:border-[#0A9D9D] focus:ring-1 focus:ring-[#0A9D9D]">

                    @foreach(range(now()->year, now()->year + 3) as $tahun)
                        <option value="{{ $tahun }}"
                            @selected(old('tahun_anggaran', $periode?->tahun_anggaran) == $tahun)>
                            {{ $tahun }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Nilai Indeks Target --}}
            <div class="w-full lg:w-[220px]">
                <label class="mb-1.5 block text-[11px] font-medium text-[#52627A]">
                    Nilai Indeks Target
                </label>

                <input type="number"
                       name="target_indeks_nasional"
                       value="{{ old('target_indeks_nasional', $periode?->target_indeks_nasional) }}"
                       min="0"
                       max="5"
                       step="0.01"
                       class="h-[38px] w-full rounded-md border border-[#CBD6E2] bg-white px-3 text-[12px] font-semibold text-[#006671] outline-none transition focus:border-[#0A9D9D] focus:ring-1 focus:ring-[#0A9D9D]">
            </div>

            {{-- Keterangan Skala --}}
            <div class="flex flex-1 items-center pb-2">
                <span class="text-[10px] text-[#9AA7B8]">
                    Skala indeks 0.0 – 5.0
                </span>
            </div>

            {{-- Tombol Simpan --}}
            <button type="submit"
                    class="h-[38px] shrink-0 rounded-md bg-[#0A9D9D] px-5 text-[11px] font-semibold text-white transition hover:bg-[#078888]">
                Simpan Target
            </button>

        </div>
    </form>

    {{-- Pesan berhasil --}}
    @if(session('success'))
        <div class="mt-4 rounded-lg border border-[#BFE3E3] bg-[#F0FAFA] px-4 py-3 text-[12px] text-[#006671]">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan validasi --}}
    @if($errors->any())
        <div class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3">
            <ul class="space-y-1 text-[12px] text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Tabel Hasil Evaluasi --}}
    <div class="mt-5 overflow-hidden rounded-[15px] border border-[#DCE4EC] bg-white shadow-sm">

        {{-- Filter --}}
        <div class="flex flex-col gap-3 border-b border-[#DCE4EC] px-4 py-3 sm:flex-row sm:items-center sm:justify-between">

            {{-- Filter kiri --}}
            <div class="flex flex-wrap items-center gap-2">

                <select
                    class="h-[30px] rounded-md border border-[#CBD6E2] bg-white px-3 text-[11px] text-[#52627A] outline-none focus:border-[#0A9D9D]">
                    <option>Semua Tahun</option>
                    <option>2027</option>
                    <option>2026</option>
                    <option>2025</option>
                </select>

                <select
                    class="h-[30px] rounded-md border border-[#CBD6E2] bg-white px-3 text-[11px] text-[#52627A] outline-none focus:border-[#0A9D9D]">
                    <option>Semua Provinsi</option>
                    <option>Bali</option>
                    <option>DI Yogyakarta</option>
                    <option>Jawa Barat</option>
                    <option>Sulawesi Selatan</option>
                    <option>Papua</option>
                </select>

                {{-- Reset --}}
                <button type="button"
                        class="flex h-[30px] w-[30px] items-center justify-center rounded-md text-[#0A9D9D] transition hover:bg-[#E8F6F6]"
                        title="Reset Filter">
                    <i class="fa-solid fa-rotate text-[11px]"></i>
                </button>

            </div>

            {{-- Search kanan --}}
            <div class="relative w-full sm:w-[240px]">

                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-[10px] text-[#8A97AA]"></i>

                <input
                    type="text"
                    placeholder="Cari nama atau kode kabupaten/kota..."
                    class="h-[30px] w-full rounded-md border border-[#CBD6E2] bg-white pl-8 pr-3 text-[11px] text-[#52627A] outline-none placeholder:text-[#9AA7B8] focus:border-[#0A9D9D] focus:ring-1 focus:ring-[#0A9D9D]"
                >

            </div>

        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] table-fixed">

                <colgroup>
                    <col class="w-[6%]">
                    <col class="w-[14%]">
                    <col class="w-[25%]">
                    <col class="w-[19%]">
                    <col class="w-[10%]">
                    <col class="w-[14%]">
                    <col class="w-[12%]">
                </colgroup>

                <thead>
                    <tr class="border-b border-[#DCE4EC] bg-[#F4F7FA]">

                        <th class="px-3 py-3 text-left text-[9px] font-semibold uppercase tracking-wide text-[#52627A]">
                            No
                        </th>

                        <th class="px-3 py-3 text-left text-[9px] font-semibold uppercase tracking-wide text-[#52627A]">
                            ID Kab/Kota
                        </th>

                        <th class="px-3 py-3 text-left text-[9px] font-semibold uppercase tracking-wide text-[#52627A]">
                            Nama Kabupaten/Kota
                        </th>

                        <th class="px-3 py-3 text-left text-[9px] font-semibold uppercase tracking-wide text-[#52627A]">
                            Provinsi
                        </th>

                        <th class="px-3 py-3 text-left text-[9px] font-semibold uppercase tracking-wide text-[#52627A]">
                            Tahun
                        </th>

                        <th class="px-3 py-3 text-left text-[9px] font-semibold uppercase tracking-wide text-[#52627A]">
                            Nilai Akhir
                        </th>

                        <th class="px-3 py-3 text-left text-[9px] font-semibold uppercase tracking-wide text-[#52627A]">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody>

                    {{-- Data sementara --}}
                    @php
                        $hasilEvaluasi = [
                            [
                                'kode' => 'KAB-5103',
                                'nama' => 'Kabupaten Badung',
                                'provinsi' => 'Bali',
                                'tahun' => '2024',
                                'nilai' => '4.62',
                            ],
                            [
                                'kode' => 'KAB-3401',
                                'nama' => 'Kabupaten Sleman',
                                'provinsi' => 'DI Yogyakarta',
                                'tahun' => '2024',
                                'nilai' => '4.40',
                            ],
                            [
                                'kode' => 'KAB-3204',
                                'nama' => 'Kabupaten Bandung',
                                'provinsi' => 'Jawa Barat',
                                'tahun' => '2024',
                                'nilai' => '3.85',
                            ],
                            [
                                'kode' => 'KAB-7371',
                                'nama' => 'Kabupaten Gowa',
                                'provinsi' => 'Sulawesi Selatan',
                                'tahun' => '2024',
                                'nilai' => '4.76',
                            ],
                            [
                                'kode' => 'KAB-9406',
                                'nama' => 'Kabupaten Jayapura',
                                'provinsi' => 'Papua',
                                'tahun' => '2024',
                                'nilai' => '3.20',
                            ],
                        ];
                    @endphp

                    @foreach($hasilEvaluasi as $index => $item)

                        <tr class="border-b border-[#E5EAF0] last:border-b-0 hover:bg-[#FAFCFD]">

                            <td class="px-3 py-4 text-[11px] text-[#52627A]">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-3 py-4 text-[10px] text-[#667793]">
                                {{ $item['kode'] }}
                            </td>

                            <td class="px-3 py-4 text-[11px] font-medium text-[#202B3C]">
                                {{ $item['nama'] }}
                            </td>

                            <td class="px-3 py-4 text-[10px] text-[#667793]">
                                {{ $item['provinsi'] }}
                            </td>

                            <td class="px-3 py-4 text-[10px] text-[#667793]">
                                {{ $item['tahun'] }}
                            </td>

                            <td class="px-3 py-4 text-[11px] font-semibold text-[#202B3C]">
                                {{ $item['nilai'] }}
                            </td>

                            <td class="px-3 py-4">

                                <button type="button"
                                        class="rounded-md border border-[#CBD6E2] bg-white px-3 py-1.5 text-[10px] font-medium text-[#52627A] transition hover:border-[#0A9D9D] hover:text-[#0A9D9D]">
                                    Detail
                                </button>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- Footer tabel --}}
        <div class="flex flex-col gap-3 border-t border-[#DCE4EC] bg-[#F8FAFC] px-4 py-3 sm:flex-row sm:items-center sm:justify-between">

            <p class="text-[10px] text-[#7D8CA2]">
                Menampilkan 1–5 dari 5 hasil
            </p>

            <div class="flex items-center gap-1">

                <button type="button"
                        class="flex h-[22px] w-[22px] items-center justify-center rounded border border-[#DCE4EC] bg-white text-[9px] text-[#A1ADBC]">
                    ‹
                </button>

                <button type="button"
                        class="flex h-[22px] w-[22px] items-center justify-center rounded border border-[#0A9D9D] bg-[#0A9D9D] text-[9px] font-semibold text-white">
                    1
                </button>

                <button type="button"
                        class="flex h-[22px] w-[22px] items-center justify-center rounded border border-[#DCE4EC] bg-white text-[9px] text-[#52627A]">
                    2
                </button>

                <button type="button"
                        class="flex h-[22px] w-[22px] items-center justify-center rounded border border-[#DCE4EC] bg-white text-[9px] text-[#52627A]">
                    3
                </button>

                <button type="button"
                        class="flex h-[22px] w-[22px] items-center justify-center rounded border border-[#DCE4EC] bg-white text-[9px] text-[#52627A]">
                    ›
                </button>

            </div>

        </div>

    </div>

</div>

@endsection

<script>
    // Membatasi nilai Target Nasional agar tidak lebih dari 5.0.
    const targetInput = document.querySelector('input[name="target_indeks_nasional"]');

    if (targetInput) {
        targetInput.addEventListener('input', function () {
            const nilai = parseFloat(this.value);

            // Kalau nilai lebih dari 5, otomatis dikembalikan menjadi 5.
            if (nilai > 5) {
                this.value = 5;
            }

            // Kalau nilai kurang dari 0, otomatis dikembalikan menjadi 0.
            if (nilai < 0) {
                this.value = 0;
            }
        });
    }
</script>