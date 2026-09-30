<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Digitama Dashboard' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Poppins -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        * {
            box-sizing: border-box;
        }

        [x-cloak] {
            display: none !important;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            transition:
                background-color 0.3s ease,
                color 0.3s ease;
        }

        .theme-card {
            background-color: #ffffff;
            border-color: rgba(15, 23, 42, 0.06) !important;
            color: #1f2937;
        }


        .theme-title {
            color: #1f2937;
        }


        .theme-text {
            color: #374151;
        }


        .theme-muted {
            color: #6b7280;
        }


        .theme-border {
            border-color: #e5e7eb;
        }


        .theme-input {
            background-color: #ffffff;
            border-color: #d1d5db;
            color: #1f2937;
        }

        .theme-input::placeholder {
            color: #9ca3af;
        }

        .theme-input:focus {
            border-color: #12a89d;
            outline: none;
        }


        .theme-table {
            background-color: #ffffff;
            color: #374151;
        }


        .theme-table-head {
            background-color: #f9fafb;
            color: #6b7280;
        }

        .theme-table-row {
            border-color: #f3f4f6;
        }

        .theme-table-row:hover {
            background-color: #f9fafb;
        }


        .theme-footer {
            background-color: #f9fafb;
            border-color: #e5e7eb;
        }

        .theme-hover:hover {
            background-color: #f9fafb;
        }


        /* CARD */

        body.dark-mode .theme-card {
            background-color: #1f2937 !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
            color: #f3f4f6 !important;
        }


        /* TITLE */

        body.dark-mode .theme-title {
            color: #f3f4f6 !important;
        }


        /* TEXT */

        body.dark-mode .theme-text {
            color: #d1d5db !important;
        }


        /* MUTED */

        body.dark-mode .theme-muted {
            color: #9ca3af !important;
        }


        /* BORDER */

        body.dark-mode .theme-border {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        body.dark-mode .theme-border > :not([hidden]) ~ :not([hidden]) {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }


        /* INPUT */

        body.dark-mode .theme-input {
            background-color: #111827 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #f3f4f6 !important;
        }

        body.dark-mode .theme-input::placeholder {
            color: #6b7280;
        }


        /* TABLE */

        body.dark-mode .theme-table {
            background-color: #1f2937 !important;
            color: #d1d5db !important;
        }


        /* TABLE HEADER */

        body.dark-mode .theme-table-head {
            background-color: #374151 !important;
            color: #d1d5db !important;
        }


        /* TABLE ROW */

        body.dark-mode .theme-table-row {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        body.dark-mode .theme-table-row:hover {
            background-color: #374151 !important;
        }


        /* FOOTER */

        body.dark-mode .theme-footer {
            background-color: #374151 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }


        /* HOVER */

        body.dark-mode .theme-hover:hover {
            background-color: #374151 !important;
        }

        /* 
           DARK MODE
         */

        body.dark-mode {
            background-color: #111827;
            color: #f3f4f6;
        }

        /* SIDEBAR */
        body.dark-mode #sidebar {
            background-color: #1f2937 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* LOGO AREA */
        body.dark-mode #sidebar .logo-area {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* NAVBAR */
        body.dark-mode header {
            background-color: #1f2937 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* MAIN */
        body.dark-mode main {
            background-color: #111827 !important;
        }

        /* NAVBAR TITLE */
        body.dark-mode .navbar-title {
            color: #e5e7eb !important;
        }

        /* SECTION TITLE */
        body.dark-mode #sidebar .section-title {
            color: #9ca3af !important;
        }

        /* SIDEBAR MENU */
        body.dark-mode #sidebar a {
            color: #e5e7eb !important;
        }

        body.dark-mode #sidebar a:hover {
            background-color: #374151 !important;
        }

        /* ACTIVE MENU */
        body.dark-mode #sidebar a.active-menu {
            background-color: #374151 !important;
            color: #ffffff !important;
        }

        /* ACTIVE YELLOW BAR */
        body.dark-mode #sidebar .active-indicator {
            background-color: #f6c400 !important;
        }

        /* LOGOUT */
        body.dark-mode #sidebar .logout-button {
            background-color: #3b2020;
            color: #ff6b6b;
        }

        body.dark-mode #sidebar .logout-button:hover {
            background-color: #512626;
        }

        /* DARK MODE BUTTON */
        #themeToggle {
            color: #9ca3af;
        }

        #themeToggle:hover {
            color: #4b5563;
        }

        body.dark-mode #themeToggle {
            color: #ffffff !important;
        }

        body.dark-mode #themeToggle:hover {
            color: #ffffff !important;
        }

        /* HAMBURGER */
        #sidebarToggle {
            color: #12a89d;
        }

        #sidebarToggle:hover {
            color: #0d8e85;
        }

        /* SMOOTH TRANSITION */
        #sidebar,
        #mainArea,
        header,
        main {
            transition:
                background-color 0.3s ease,
                border-color 0.3s ease,
                color 0.3s ease,
                margin-left 0.3s ease,
                transform 0.3s ease;
        }

        /* DATE INPUT */
        .theme-input[type="date"] {
            color-scheme: light;
        }

        body.dark-mode .theme-input[type="date"] {
            color-scheme: dark;
        }
    </style>
</head>


<body class="bg-gray-50 overflow-x-hidden">
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/30 z-40 hidden lg:hidden"></div>

    <!-- SIDEBAR-->
    <aside id="sidebar" class="fixed left-0 top-0 bottom-0 w-[321px] bg-white border-r border-gray-200 flex flex-col z-50 transition-transform duration-300 ease-in-out">
        <div class="logo-area h-[81px] flex items-center justify-center border-b border-gray-200 shrink-0">
            <img src="{{ asset('asesor_img/logo.png') }}" alt="Logo Digitama" class="w-[200px] h-auto">
        </div>

        <!-- MENU-->
        <div class="flex-1 px-0 overflow-y-auto">

            <!-- ASESOR-->
            <div class="mt-[19px]">
                <div class="section-title px-[16px] mb-[6px] text-[14px] text-gray-500 font-normal">
                    Asesor
                </div>

                <!-- DASHBOARD -->
                <a href="{{ route('asesor.dashboard') }}" 
                    class="relative flex items-center gap-[10px] h-[40px] mx-[4px] pl-[18px] pr-[12px] rounded-[4px] text-[16px]  
                    {{ request()->routeIs(['asesor.dashboard', 'asesor.aktivitas*']) ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium' : 'text-[#333333] hover:bg-gray-50' }}">

                    @if(request()->routeIs(['asesor.dashboard', 'asesor.aktivitas*']))
                        <span class="active-indicator absolute left-[-3px] top-0 bottom-0 w-[3px] bg-[#f6c400] rounded-r-[2px]"></span>
                    @endif

                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" stroke-width="1.6"></circle>
                        <path stroke-linecap="round" stroke-width="1.6" d="M12 8v4l2.5 2"></path>
                    </svg>

                    <span>Dashboard</span>
                </a>
            </div>

            <!-- DATA MASTER-->
            <div class="mt-[18px]">

                <div class="section-title px-[16px] mb-[5px] text-[14px] text-gray-500 font-normal">
                    Data Master
                </div>

                <!-- VERIFIKASI BUKTI -->
                <a href="{{ route('asesor.verifikasi') }}"
                    class="relative flex items-center gap-[10px] h-[40px] mx-[4px] pl-[22px] pr-[12px] rounded-[4px] text-[16px]
                        {{ request()->routeIs('asesor.verifikasi*') ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium' : 'text-[#333333] hover:bg-gray-50'}}">
                         
                    @if(request()->routeIs('asesor.verifikasi*'))
                        <span class=" active-indicator absolute left-[-3px] top-0 bottom-0 w-[3px] bg-[#f6c400] rounded-r-[2px]"></span>
                    @endif

                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 3h7l4 4v14H7V3z"></path>
                        <path stroke-linecap="round" stroke-width="1.5" d="M14 3v5h5M10 12h5M10 16h5"></path>
                    </svg>

                    <span>Verifikasi Bukti</span>
                </a>

                <!-- MONITORING PENILAIAN -->
                <a href="{{ route('asesor.monitoring') }}"
                    class=" relative flex items-center gap-[10px] h-[40px] mx-[4px] pl-[22px] pr-[12px] rounded-[4px] text-[16px]
                    {{ request()->routeIs('asesor.monitoring*') ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium' : 'text-[#333333] hover:bg-gray-50'}}">

                    @if(request()->routeIs('asesor.monitoring*'))
                        <span class="active-indicator absolute left-[-3px] top-0 bottom-0 w-[3px] bg-[#f6c400] rounded-r-[2px]"></span>
                    @endif


                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="3" stroke-width="1.5"></circle>
                        <path stroke-linecap="round" stroke-width="1.5" d="M5 21c0-3.5 3-6 7-6s7 2.5 7 6"></path>
                    </svg>

                    <span>Monitoring Penilaian</span>
                </a>

                <!-- KELOLA kelola_panduan -->
                <a href="{{ route('asesor.kelola_panduan') }}"
                    class="relative flex items-center gap-[10px] h-[40px] mx-[4px] pl-[22px] pr-[12px] rounded-[4px] text-[16px]
                        {{ request()->routeIs('asesor.kelola_panduan*') ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium' : 'text-[#333333] hover:bg-gray-50'}}">

                    @if(request()->routeIs('asesor.kelola_panduan*'))
                        <span class="active-indicator absolute left-[-3px] top-0 bottom-0 w-[3px] bg-[#f6c400] rounded-r-[2px]"></span>
                    @endif


                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="9" cy="8" r="3" stroke-width="1.5"></circle>

                        <path stroke-linecap="round" stroke-width="1.5" d="M3 21c0-3.5 2.5-6 6-6"></path>
                        <path stroke-linecap="round" stroke-width="1.5" d="M15 12v8M12 17h6"></path>
                    </svg>

                    <span>Kelola Panduan</span>
                </a>
            </div>

            <!-- PROFILE-->
            <div class="mt-[18px]">
                <div class="section-title px-[16px] mb-[5px] text-[14px] text-gray-500 font-normal">
                    Profile
                </div>

                <a href="{{ route('asesor.profil') }}"
                    class="relative flex items-center gap-[10px] h-[40px] mx-[4px] pl-[22px] pr-[12px] rounded-[4px] text-[16px]
                        {{ request()->routeIs('asesor.profil*') ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium' : 'text-[#333333] hover:bg-gray-50'}}">

                    @if(request()->routeIs('asesor.profil*'))
                        <span class="active-indicator absolute left-[-3px] top-0 bottom-0 w-[3px] bg-[#f6c400] rounded-r-[2px]"></span>
                    @endif


                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="3" stroke-width="1.5"></circle>
                        <path stroke-linecap="round" stroke-width="1.5" d="M5 21c0-3.5 3-6 7-6s7 2.5 7 6"></path>
                    </svg>

                    <span>Profile</span>
                </a>
            </div>

            <!-- SISTEM -->
            <div class="mt-[18px]">
                <div class="section-title px-[16px] mb-[5px] text-[14px] text-gray-500 font-normal">
                    Sistem
                </div>

                <a href="{{ route('asesor.periode') }}"
                    class="relative flex items-center gap-[10px] h-[40px] mx-[4px] pl-[22px] pr-[12px] rounded-[4px] text-[16px]
                    {{ request()->routeIs('asesor.periode*') ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium' : 'text-[#333333] hover:bg-gray-50'}}">

                    @if(request()->routeIs('asesor.periode*'))
                        <span class="active-indicator absolute left-[-3px] top-0 bottom-0 w-[3px] bg-[#f6c400] rounded-r-[2px]"></span>
                    @endif


                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 3h10v18H7z"></path>
                        <path stroke-linecap="round" stroke-width="1.5" d="M10 7h4M10 11h4M10 15h4"></path>
                    </svg>

                    <span>Periode</span>
                </a>
            </div>
        </div>



        <!-- LOGOUT-->
        <div class="px-[20px] pb-[40px] pt-[10px] shrink-0">

            <form action="{{ route('logout') }}"method="POST">

                @csrf
                <button type="submit" class="logout-button w-full h-[39px] flex items-center justify-center gap-[8px] bg-[#ffe8e8] text-[#ef2222] rounded-[6px] text-[16px] font-medium hover:bg-[#ffdcdc] transition">

                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-width="1.5" d="M10 17l5-5-5-5"></path>
                        <path stroke-linecap="round" stroke-width="1.5" d="M15 12H3"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 5V4a2 2 0 012-2h3a2 2 0 012 2v16a2 2 0 01-2 2h-3a2 2 0 01-2-2v-1"></path>
                    </svg>

                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>



    <!-- MAIN AREA -->
    <div id="mainArea" class="ml-0 lg:ml-[321px] min-h-screen flex flex-col transition-all duration-300 ease-in-out">

        <!-- NAVBARm-->
        <header class="h-[64px] shrink-0 bg-white border-b border-gray-200 flex items-center justify-between px-[16px] sm:px-[20px] lg:px-[28px] sticky top-0 z-30">

            <!-- KIRI -->
            <div class="flex items-center gap-[18px]">

                <!-- HAMBURGER -->
                <button id="sidebarToggle" type="button" onclick="toggleSidebar()"
                    class="cursor-pointer focus:outline-none transition-colors duration-200" aria-label="Toggle sidebar">

                    <svg class="w-[24px] h-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- JUDUL -->
                <span class="navbar-title text-[16px] font-medium text-gray-700 truncate">
                    {{ $pageTitle ?? 'Home' }}
                </span>
            </div>

            <!-- KANAN -->
            <div class="flex items-center gap-[18px]">

                <!-- DARK MODE BUTTON -->
                <button id="themeToggle" type="button" onclick="toggleDarkMode()"
                    class="focus:outline-none transition-colors duration-200" aria-label="Toggle dark mode">

                    <!-- SUN -->
                    <svg id="sunIcon" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <circle cx="12" cy="12" r="4" stroke-width="1.5"></circle>

                        <path stroke-linecap="round" stroke-width="1.5"
                            d="M12 2v2 M12 20v2 M4.93 4.93l1.41 1.41 M17.66 17.66l1.41 1.41 M2 12h2 M20 12h2 M4.93 19.07l1.41-1.41 M17.66 6.34l1.41-1.41"></path>
                    </svg>

                    <!-- MOON -->
                    <svg id="moonIcon" class="hidden w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 12.8 A8.5 8.5 0 1111.2 3 6.5 6.5 0 0021 12.8z"
                        ></path>
                    </svg>
                </button>

                <!-- PROFILE -->
                <div class="flex items-center gap-[7px]">
                    <img src="{{ Auth::user()->profile_photo_url ?? asset('asesor_img/default-profile.svg') }}" alt="Profile" class="w-[30px] h-[30px] rounded-full object-cover">
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="flex-1 bg-[#f8f8f8] p-[20px] sm:p-[24px] lg:p-[28px]">
            @yield('content')
        </main>
    </div>

    <script>
        /*SIDEBAR*/
        const sidebar = document.getElementById('sidebar');
        const mainArea = document.getElementById('mainArea');
        const overlay = document.getElementById('sidebarOverlay');

        let sidebarOpen = window.innerWidth >= 1024;


        function updateSidebar() {

            const isDesktop = window.innerWidth >= 1024;
            if (sidebarOpen) {
                /* OPEN SIDEBAR */
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');

                if (isDesktop) {
                    /* DESKTOP */
                    mainArea.classList.remove('ml-0');
                    mainArea.classList.add('lg:ml-[321px]');
                    overlay.classList.add('hidden');
                } else {
                    /* MOBILE / TABLET */
                    mainArea.classList.remove('lg:ml-[321px]');
                    mainArea.classList.add('ml-0');
                    overlay.classList.remove('hidden');
                }
            } else {

                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                mainArea.classList.remove('lg:ml-[321px]');
                mainArea.classList.add('ml-0');
                overlay.classList.add('hidden');
            }
        }

        function toggleSidebar() {
            sidebarOpen = !sidebarOpen;
            updateSidebar();
        }

        updateSidebar();

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024) {
                sidebarOpen = true;
            }
            else {
                sidebarOpen = false;
            }
            updateSidebar();
        });

        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');


        function applyTheme(isDark) {
            if (isDark) {
                document.body.classList.add('dark-mode');
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
                localStorage.setItem('theme', 'dark');
            } else {
                document.body.classList.remove('dark-mode');
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden')
                localStorage.setItem('theme', 'light');
            }
        }

        function toggleDarkMode() {
            const isDark =
                document.body.classList.contains('dark-mode');
            applyTheme(!isDark);
        }

        const savedTheme = localStorage.getItem('theme');

        if (savedTheme === 'dark') {
            applyTheme(true);
        } else {
            applyTheme(false);
        }
    </script>

</body>
</html>