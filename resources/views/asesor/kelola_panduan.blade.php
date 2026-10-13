@extends('layouts.sidebar.sidebar-asesor')

@section('content')

<div class="w-full space-y-6">

    <!-- =====================================================
         HEADER
    ====================================================== -->
    <div>
        <h1 class="text-3xl font-bold theme-title tracking-tight">
            Tambah Panduan & Template
        </h1>

        <p class="text-lg font-normal theme-muted mt-1.5">
            Kelola dan pantau bukti pendukung yang telah dimasukkan oleh pengguna.
        </p>
    </div>


    <!-- =====================================================
         ALERT SUCCESS
    ====================================================== -->
    @if(session('success'))
        <div class="flex items-center justify-between gap-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100">
                    <svg
                        class="h-4 w-4 text-emerald-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-semibold text-emerald-800">
                        Berhasil diperbarui
                    </p>

                    <p class="mt-0.5 text-xs text-emerald-700">
                        {{ session('success') }}
                    </p>
                </div>

            </div>

            <button
                type="button"
                onclick="this.parentElement.remove()"
                class="text-emerald-400 transition hover:text-emerald-600"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>
    @endif


    <!-- =====================================================
         ALERT ERROR
    ====================================================== -->
    @if($errors->has('target_instansi'))
        <div class="flex items-center justify-between gap-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100">
                    <svg
                        class="h-4 w-4 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v3.5m0 3h.01M10.29 3.86l-7.36 12.75A1.5 1.5 0 004.23 19h15.54a1.5 1.5 0 001.3-2.39L13.71 3.86a1.98 1.98 0 00-3.42 0z"
                        />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-semibold text-red-800">
                        Gagal diperbarui
                    </p>

                    <p class="mt-0.5 text-xs text-red-700">
                        {{ $errors->first('target_instansi') }}
                    </p>
                </div>

            </div>

            <button
                type="button"
                onclick="this.parentElement.remove()"
                class="text-red-400 transition hover:text-red-600"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>
    @endif


    <!-- =====================================================
         SUMMARY CARDS
    ====================================================== -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">

        <!-- TOTAL ASPEK -->
        <div class="theme-card rounded-2xl border theme-border p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium theme-muted">
                        Total Aspek
                    </p>

                    <p class="mt-2 text-3xl font-bold theme-title">
                        {{ $aspekList->count() }}
                    </p>

                    <p class="mt-1 text-xs theme-muted">
                        Aspek penilaian yang tersedia
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#12a89d]/10">
                    <svg
                        class="h-5 w-5 text-[#12a89d]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 006 0M9 5h6"
                        />
                    </svg>
                </div>

            </div>

        </div>


        <!-- TOTAL PANDUAN -->
        <div class="theme-card rounded-2xl border theme-border p-6 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium theme-muted">
                        Total Panduan
                    </p>

                    <p class="mt-2 text-3xl font-bold theme-title">
                        {{ $aspekList->sum('jumlah_panduan') }}
                    </p>

                    <p class="mt-1 text-xs theme-muted">
                        Panduan dan template yang tersedia
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#12a89d]/10">
                    <svg
                        class="h-5 w-5 text-[#12a89d]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 3h7l5 5v13a1 1 0 01-1 1H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14 3v6h6"
                        />
                    </svg>
                </div>

            </div>

        </div>


        <!-- TARGET INSTANSI -->
        <div class="theme-card rounded-2xl border theme-border p-6 shadow-sm">

            <!-- MODE TAMPIL -->
            <div
                id="target-display"
                class="{{ $errors->has('target_instansi') ? 'hidden' : '' }}"
            >

                <div class="flex items-start justify-between gap-4">

                    <div>
                        <p class="text-sm font-medium theme-muted">
                            Target Instansi
                        </p>

                        <p class="mt-2 text-3xl font-bold theme-title">
                            @if($targetInstansi !== null)
                                {{ number_format($targetInstansi, 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </p>

                        <p class="mt-1 text-xs theme-muted">
                            Target indeks yang ditetapkan
                        </p>
                    </div>


                    @if($targetInstansi !== null)

                        <button
                            type="button"
                            onclick="toggleTargetEdit()"
                            id="btn-edit-target"
                            class="inline-flex items-center gap-2 rounded-lg border theme-border px-3 py-2 text-sm font-medium theme-title transition hover:bg-gray-50 dark:hover:bg-white/5"
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                />
                            </svg>

                            Edit

                        </button>

                    @endif

                </div>

            </div>


            <!-- FORM TARGET -->
            <div
                id="target-edit-form"
                class="
                    {{ $targetInstansi !== null && !$errors->has('target_instansi') ? 'hidden' : '' }}
                    mt-5
                "
            >

                <form
                    action="{{ route('asesor.target-instansi.update') }}"
                    method="POST"
                >

                    @csrf

                    <label
                        for="target_instansi"
                        class="mb-2 block text-sm font-medium theme-title"
                    >
                        Nilai Target
                    </label>

                    <input
                        id="target_instansi"
                        type="number"
                        name="target_instansi"
                        value="{{ old('target_instansi', $targetInstansi) }}"
                        step="0.01"
                        placeholder="Contoh: 2.50"
                        class="w-full rounded-xl border theme-border bg-transparent px-4 py-3 text-sm outline-none transition focus:border-[#12a89d] focus:ring-2 focus:ring-[#12a89d]/20"
                    >

                    <p class="mt-2 text-xs theme-muted">
                        Masukkan nilai target dengan rentang 0 sampai 5.
                    </p>


                    <!-- BUTTON -->
                    <div class="mt-4 flex items-center gap-2">

                        <button
                            type="submit"
                            class="rounded-lg bg-[#12a89d] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0e8a81]"
                        >
                            Simpan
                        </button>


                        @if($targetInstansi !== null)

                            <button
                                type="button"
                                onclick="toggleTargetEdit()"
                                class="rounded-lg border theme-border px-4 py-2 text-sm font-medium theme-title transition hover:bg-gray-50 dark:hover:bg-white/5"
                            >
                                Batal
                            </button>

                        @endif

                    </div>

                </form>

            </div>

        </div>

    </div>


    <!-- =====================================================
         TABLE
    ====================================================== -->
    <div class="theme-card overflow-hidden rounded-2xl border theme-border shadow-sm">

        <!-- TABLE HEADER -->
        <div class="border-b theme-border px-6 py-5">

            <div>
                <h2 class="text-lg font-semibold theme-title">
                    Daftar Aspek Penilaian
                </h2>

                <p class="mt-1 text-sm theme-muted">
                    Pilih aspek untuk mengelola panduan dan template.
                </p>
            </div>

        </div>


        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="border-b theme-border bg-gray-50/70 dark:bg-white/[0.02]">

                    <tr>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider theme-muted">
                            No.
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider theme-muted">
                            Aspek
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider theme-muted">
                            Bobot Default
                        </th>

                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider theme-muted">
                            Jumlah Panduan
                        </th>

                        <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider theme-muted">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y theme-border">

                    @forelse($aspekList as $item)

                        <tr class="transition hover:bg-gray-50/60 dark:hover:bg-white/[0.02]">

                            <td class="whitespace-nowrap px-6 py-4 text-sm theme-title">
                                {{ $loop->iteration }}
                            </td>


                            <td class="px-6 py-4">

                                <p class="text-sm font-semibold theme-title">
                                    {{ $item->nama_aspek }}
                                </p>

                            </td>


                            <td class="whitespace-nowrap px-6 py-4">

                                <span class="text-sm font-medium theme-title">
                                    {{ $item->bobot ?? '-' }}
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-4">

                                <span class="inline-flex items-center rounded-full bg-[#12a89d]/10 px-3 py-1 text-xs font-semibold text-[#12a89d]">
                                    {{ $item->jumlah_panduan }}
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <a
                                    href="{{ route('asesor.panduan.detail', ['idAspek' => $item->id_aspek]) }}"
                                    class="inline-flex items-center gap-2 rounded-lg bg-[#12a89d] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0e8a81]"
                                >

                                    Detail

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-12 text-center"
                            >

                                <p class="text-sm font-medium theme-title">
                                    Belum ada data aspek.
                                </p>

                                <p class="mt-1 text-xs theme-muted">
                                    Data aspek penilaian belum tersedia.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- =====================================================
     JAVASCRIPT
====================================================== -->
<script>
    function toggleTargetEdit() {
        const display = document.getElementById('target-display');
        const form = document.getElementById('target-edit-form');

        if (!display || !form) {
            return;
        }

        display.classList.toggle('hidden');
        form.classList.toggle('hidden');

        const input = document.getElementById('target_instansi');

        if (!form.classList.contains('hidden') && input) {
            input.focus();
            input.select();
        }
    }
</script>

@endsection