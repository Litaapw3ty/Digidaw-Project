@extends('layouts.sidebar.sidebar-admin')

@section('content')

    {{-- Menampilkan pesan error validasi jika ada input yang tidak sesuai --}}
    @if ($errors->any())
    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
        <p class="font-semibold text-red-700">
            Data tidak tersimpan, masukkan data baru!
        </p>

        <ul class="mt-2 list-disc pl-5 text-sm text-red-600">
            {{-- Menampilkan semua pesan error dari validasi Laravel --}}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- JUDUL HALAMAN --}}
    <h1 class="text-[28px] font-semibold text-[#1F1F1F]">
        Tambah Instansi
    </h1>

    {{-- BREADCRUMB --}}
    <div class="mt-2 flex items-center gap-3 text-[14px]">

        <span class="text-[#64748B]">
            Data Master
        </span>

        <span class="text-[#94A3B8]">
            >
        </span>

        <span class="text-[#64748B]">
            Instansi
        </span>

        <span class="text-[#94A3B8]">
            >
        </span>

        <span class="font-medium text-[#12AFA9]">
            Tambah Instansi
        </span>
    </div>

    {{--CARD --}}
    <div class="mt-5 rounded-[12px] border border-[#BCC9CB] bg-white px-7 py-6"> <h2 class="text-[20px] font-semibold text-[#1F1F1F]">Informasi Instansi</h2>

        <div class="mt-4 border-t border-[#D9D9D9]"></div>

        <form action="{{ route('admin.instansi.store') }}" method="POST" class="mt-6">            
        @csrf

            {{-- GRID FORM --}}
            <div class="grid grid-cols-1 gap-x-6 gap-y-5 md:grid-cols-2">

                {{-- NAMA INSTANSI --}}
                <div>
                    <label
                        for="nama_instansi"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">Nama Instansi<span class="text-red-500">*</span>
                    </label>

                    <input type="text" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi') }}" placeholder="Masukkan nama instansi" required class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                    @error('nama_instansi')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- KODE INSTANSI --}}
                <div>

                    <label
                        for="kode_instansi"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">Kode Instansi<span class="text-red-500">*</span>
                    </label>

                    <input type="text" id="kode_instansi" name="kode_instansi" value="{{ old('kode_instansi') }}" placeholder="Masukkan kode instansi" required
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">
                    
                    @error('kode_instansi')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- KATEGORI --}}
                <div>
                    <label
                        for="kategori"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">Kategori<span class="text-red-500">*</span>
                    </label>

                    <select id="kategori" name="kategori" required
                        class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none focus:border-[#006671]">

                        <option value="">
                            Pilih kategori
                        </option>

                        <option value="PUSAT" {{ old('kategori') == 'PUSAT' ? 'selected' : '' }}>
                            Pusat
                        </option>

                        <option value="PROVINSI" {{ old('kategori') == 'PROVINSI' ? 'selected' : '' }}>
                            Provinsi
                        </option>

                        <option value="KABUPATEN" {{ old('kategori') == 'KABUPATEN' ? 'selected' : '' }}>
                            Kabupaten
                        </option>

                        <option value="KOTA" {{ old('kategori') == 'KOTA' ? 'selected' : '' }}>
                            Kota
                        </option>

                        <option value="LAINNYA" {{ old('kategori') == 'LAINNYA' ? 'selected' : '' }}>
                            Lainnya
                        </option>
                    </select>

                    @error('kategori')
                        <p class="mt-1 text-sm text-red-700">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{--WEBSITE--}}
                <div>
                    <label
                        for="website"
                        class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">Website
                    </label>

                    <input type="text"id="website"name="website" value="{{ old('website') }}" placeholder="https://www.instansi.go.id" class="w-full rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">

                    @error('website')
                    <p class="mt-1 text-sm text-red-700">{{ $message }}</p>
                    @enderror

                </div>


                {{-- ALAMAT --}}
                <div class="md:col-span-2">
                    <label for="alamat" class="mb-2 block text-[14px] font-medium text-[#1F1F1F]">
                        Alamat
                    </label>

                    <textarea id="alamat"name="alamat"rows="4" placeholder="Masukkan Alamat Lengkap Instansi"class="w-full resize-none rounded-[7px] border border-[#BCC9CB] bg-white px-3 py-2.5 text-[13px] text-[#434654] outline-none placeholder:text-[#9CA3AF] focus:border-[#006671]">{{ old('alamat') }}</textarea>
                </div>

                {{-- STATUS INSTANSI --}}
                <div class="md:col-span-2">

                    <label class="mb-3 block text-[16px] font-semibold text-[#1F1F1F]">Status Instansi<span class="text-red-500">*</span>
                    </label>


                    {{-- STATUS AKTIF --}}
                    <label class="flex cursor-pointer items-start gap-3">

                        <input
                            type="radio"
                            name="status"
                            value="AKTIF"
                            {{ old('status') == 'AKTIF' ? 'checked' : '' }}
                            class="mt-1 h-4 w-4 accent-[#006671]">
                        <div>
                            <p class="text-[14px] font-medium text-[#1F1F1F]">
                                Aktif
                            </p>
                        @error('status')
                            <p class="mt-1 text-sm text-red-700">
                                {{ $message }}
                            </p>
                        @enderror
                            <p class="text-[12px] text-[#6D797B]">
                                Instansi dapat mengakses dan menggunakan sistem
                            </p>
                        </div>
                    </label>

                    {{-- STATUS NONAKTIF --}}
                    <label class="mt-3 flex cursor-pointer items-start gap-3">

                        <input
                            type="radio"
                            name="status"
                            value="NONAKTIF"
                            {{ old('status') == 'NONAKTIF' ? 'checked' : '' }}
                            class="mt-1 h-4 w-4 accent-[#006671]">
                        <div>
                            <p class="text-[14px] font-medium text-[#1F1F1F]">
                                Nonaktif
                            </p>

                        @error('status')
                            <p class="mt-1 text-sm text-red-700">
                                {{ $message }}
                            </p>
                        @enderror
                            <p class="text-[12px] text-[#6D797B]">
                                Instansi tidak dapat mengakses sistem
                            </p>
                        </div>
                    </label>
                </div>
            </div>

            {{--BUTTON--}}
            <div
                class="mt-8 flex justify-end gap-3 border-t border-[#D9D9D9] pt-5">
                <a href="{{ route('admin.instansi.index') }}" class="rounded-[7px] border border-[#BCC9CB] bg-white px-5 py-2.5 text-[13px] font-medium text-[#008F8A] transition hover:bg-[#F5F5F5]">Batal</a>

                <button
                    type="submit" class="rounded-[7px] bg-gradient-to-r from-[#12C6BD] to-[#09605C] px-6 py-2.5 text-[13px] font-medium text-white transition hover:opacity-90">
                    Simpan
                </button>
            </div>
        </form>
    </div>

@endsection