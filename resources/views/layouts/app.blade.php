<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Scripts & CSS (Vite / AdminLTE) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
        <div class="app-wrapper">
            
            <!-- Navbar Atas (Opsional, atau bisa pakai bawaan AdminLTE) -->
            <nav class="app-header navbar navbar-expand bg-body">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <span class="nav-link">Halo, {{ auth()->user()->name ?? 'User' }}</span>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- SIDEBAR UTAMA (Dinamis Berdasarkan Role) -->
            <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
                <!-- Brand Logo -->
                <div class="sidebar-brand">
                    <a href="{{ url('/dashboard') }}" class="brand-link">
                        <span class="brand-text fw-light">Digidaw Project</span>
                    </a>
                </div>

                <!-- Sidebar Wrapper -->
                <div class="sidebar-wrapper">
                    <nav class="mt-2">
                        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                            

                            <!-- PEMANGGILAN SIDEBAR BERDASARKAN ROLE -->
                           @if(auth()->check())

                                @if(auth()->user()->role->nama_role == 'ADMIN')
                                    @include('layouts.sidebar.sidebar-admin')

                                @elseif(auth()->user()->role->nama_role == 'ASESOR')
                                    @include('layouts.sidebar.sidebar-asesor')

                                @elseif(auth()->user()->role->nama_role == 'USER')
                                    @include('layouts.sidebar.sidebar-user')
                                @endif

                            @endif

                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- KONTEN UTAMA HALAMAN -->
            <main class="app-main">
                <!-- Page Heading (Opsional) -->
                @isset($header)
                    <div class="app-content-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="mb-0">{{ $header }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

                <!-- Isi Konten Utama dari View Lain -->
                <div class="app-content">
                    <div class="container-fluid">
                        {{ $slot }}
                    </div>
                </div>
            </main>

        </div>

        <!-- AdminLTE v4 JS (Pastikan sudah di-import lewat Vite atau CDN tambahan jika diperlukan) -->
    </body>
</html>