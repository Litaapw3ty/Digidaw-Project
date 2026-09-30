@extends('layouts.sidebar.sidebar-asesor')

@section('content')
<div class="w-full space-y-6">

    <!-- Card Header Banner Profile -->
    <div class="theme-card border theme-border rounded-2xl p-6 shadow-sm relative overflow-hidden">
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            
            <!-- Sisi Kiri: Foto Profil, Nama & Metadata -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 lg:gap-8 w-full lg:w-auto">
                
                <!-- Foto Profil & Nama -->
                <div class="flex items-center gap-5 shrink-0">
                    <div class="relative shrink-0">
                        <img src="{{ $user->profile_photo_url ?? asset('asesor_img/default-profile.svg') }}" 
                             alt="Profile" 
                             class="w-20 h-20 rounded-full object-cover border-2 border-[#12a89d]">
                        
                        <a href="{{ url('/asesor/edit_asesor') }}" class="absolute bottom-0 right-0 bg-[#12a89d] text-white p-1.5 rounded-full hover:bg-[#0e8a81] transition-colors shadow-sm" title="Ubah Foto">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="shrink-0">
                        <div class="flex items-center gap-3">
                            <h2 class="text-2xl font-bold theme-title">{{ $user->name ?? 'User' }}</h2>
                            <span class="bg-[#f6c400] text-amber-950 text-xs font-bold px-2.5 py-0.5 rounded-md uppercase tracking-wide">
                                {{ $user->status_asesor ?? 'ASESOR' }}
                            </span>
                        </div>
                        <p class="text-base font-normal theme-muted mt-1">{{ $user->email ?? '-' }}</p>
                    </div>
                </div>

                <!-- Divider Vertikal Tipis -->
                <div class="hidden sm:block w-px h-12 bg-gray-200 dark:bg-gray-700 shrink-0"></div>

                <!-- Metadata (Bergabung sejak, Role, Wilayah) -->
                <div class="flex flex-wrap items-center gap-6 lg:gap-8">
                    
                    <!-- Bergabung Sejak -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#12a89d]/10 text-[#12a89d] dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold theme-title">Bergabung Sejak</p>
                            <p class="text-sm font-normal theme-muted mt-0.5">
                                {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->translatedFormat('j F Y') : '-' }}
                            </p>
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#12a89d]/10 text-[#12a89d] dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold theme-title">Role</p>
                            <p class="text-sm font-normal theme-muted mt-0.5">Asesor</p>
                        </div>
                    </div>

                    <!-- Wilayah -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#12a89d]/10 text-[#12a89d] dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold theme-title">Wilayah Penugasan</p>
                            <p class="text-sm font-normal theme-muted mt-0.5">{{ $user->wilayah ?? '-' }}</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Sisi Kanan: Tombol Edit Akun -->
            <div class="w-full lg:w-auto flex justify-end shrink-0 pt-2 lg:pt-0 border-t lg:border-t-0 theme-border">
                <a href="{{ url('/asesor/edit_asesor') }}"
                    class="inline-flex items-center gap-2 bg-[#12a89d] hover:bg-[#0e8a81] text-white text-base font-medium px-5 py-2.5 rounded-xl transition-all duration-200 shadow-sm hover:shadow active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    <span>Edit Akun</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Outer Card Detail & Content -->
    <div class="theme-card border theme-border rounded-2xl overflow-hidden shadow-sm">
        
        <!-- Tab Header Navigation -->
        <div class="border-b theme-border px-6 pt-4">
            <div class="flex items-center gap-8">
                <button class="pb-3 text-base font-semibold text-[#12a89d] border-b-2 border-[#12a89d] transition-colors">
                    Detail Profil
                </button>
            </div>
        </div>

        <!-- Inner Content Grid (2 Kolom Card) -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Card 1: Informasi User -->
                <div class="border theme-border rounded-xl p-6 theme-card">
                    <div class="flex items-center gap-3.5 mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#12a89d]/10 text-[#12a89d] dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold theme-title">Informasi Akun</h3>
                            <p class="text-xs font-normal theme-muted">Detail Identitas Pengguna</p>
                        </div>
                    </div>

                    <!-- List Data -->
                    <div class="space-y-4 text-base">
                        <div class="grid grid-cols-12 items-center">
                            <span class="col-span-4 font-semibold theme-title">Nama Lengkap</span>
                            <span class="col-span-1 text-center theme-muted">:</span>
                            <span class="col-span-7 font-normal theme-muted">{{ $user->name ?? '-' }}</span>
                        </div>
                        <div class="grid grid-cols-12 items-center">
                            <span class="col-span-4 font-semibold theme-title">Email</span>
                            <span class="col-span-1 text-center theme-muted">:</span>
                            <span class="col-span-7 font-normal theme-muted break-all">{{ $user->email ?? '-' }}</span>
                        </div>
                        <div class="grid grid-cols-12 items-center">
                            <span class="col-span-4 font-semibold theme-title">Status Akun</span>
                            <span class="col-span-1 text-center theme-muted">:</span>
                            <span class="col-span-7 font-normal theme-muted">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                    {{ $user->status_asesor ?? 'AKTIF' }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Kepegawaian & Tugas -->
                <div class="border theme-border rounded-xl p-6 theme-card">
                    <div class="flex items-center gap-3.5 mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#12a89d]/10 text-[#12a89d] dark:bg-[#14b8a6]/20 dark:text-[#14b8a6] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m-5 0v-4m0 4h5m-5-4h5m-5 0V9m5 4V9m0 0H10"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold theme-title">Data Kepegawaian</h3>
                            <p class="text-xs font-normal theme-muted">Informasi Jabatan & Unit Kerja</p>
                        </div>
                    </div>

                    <!-- List Data -->
                    <div class="space-y-4 text-base">
                        <div class="grid grid-cols-12 items-center">
                            <span class="col-span-4 font-semibold theme-title">NIP</span>
                            <span class="col-span-1 text-center theme-muted">:</span>
                            <span class="col-span-7 font-normal theme-muted">{{ $user->nip ?? '-' }}</span>
                        </div>
                        <div class="grid grid-cols-12 items-center">
                            <span class="col-span-4 font-semibold theme-title">Jabatan</span>
                            <span class="col-span-1 text-center theme-muted">:</span>
                            <span class="col-span-7 font-normal theme-muted">{{ $user->jabatan ?? '-' }}</span>
                        </div>
                        <div class="grid grid-cols-12 items-center">
                            <span class="col-span-4 font-semibold theme-title">Unit Kerja</span>
                            <span class="col-span-1 text-center theme-muted">:</span>
                            <span class="col-span-7 font-semibold theme-title">{{ $user->unit_kerja ?? '-' }}</span>
                        </div>
                        <div class="grid grid-cols-12 items-center">
                            <span class="col-span-4 font-semibold theme-title">Wilayah</span>
                            <span class="col-span-1 text-center theme-muted">:</span>
                            <span class="col-span-7 font-normal theme-muted">{{ $user->wilayah ?? '-' }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection