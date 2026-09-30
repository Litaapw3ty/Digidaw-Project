<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Digitama Dashboard' }}</title>

    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme');
            const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = savedTheme === 'dark' || (!savedTheme && systemDark);

            if (isDark) {
                document.documentElement.classList.add('dark-mode');
            }
        })();
    </script>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: ['class', '.dark-mode'],
        };
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* =========================================
            DARK MODE
        ========================================= */
        html.dark-mode body {
            background-color: #111827;
            color: #f3f4f6;
        }

        /* SIDEBAR */
        html.dark-mode body #sidebar {
            background-color: #1f2937;
            border-color: #374151;
        }

        /* LOGO */
        html.dark-mode body #sidebar .logo-area {
            border-color: #374151;
        }

        /* NAVBAR */
        html.dark-mode body header {
            background-color: #1f2937;
            border-color: #374151;
        }

        /* MAIN */
        html.dark-mode body main {
            background-color: #111827;
        }

        /* NAVBAR TITLE */
        html.dark-mode body .navbar-title {
            color: #e5e7eb !important;
        }

        /* SECTION TITLE */
        html.dark-mode body #sidebar .section-title {
            color: #9ca3af !important;
        }

        /* MENU */
        html.dark-mode body #sidebar a {
            color: #e5e7eb;
        }

        html.dark-mode body #sidebar a:hover {
            background-color: #374151;
        }

        /* ACTIVE MENU */
        html.dark-mode body #sidebar a.active-menu {
            background-color: #374151 !important;
            color: #ffffff !important;
        }

        /* ACTIVE INDICATOR */
        html.dark-mode body #sidebar .active-indicator {
            background-color: #f6c400 !important;
        }

        /* LOGOUT */
        html.dark-mode body #sidebar .logout-button {
            background-color: #3b2020;
            color: #ff6b6b;
        }

        html.dark-mode body #sidebar .logout-button:hover {
            background-color: #512626;
        }

        /* THEME BUTTON */
        #themeToggle {
            color: #9ca3af;
        }

        #themeToggle:hover {
            color: #4b5563;
        }

        html.dark-mode body #themeToggle {
            color: #ffffff !important;
        }

        html.dark-mode body #themeToggle:hover {
            color: #ffffff !important;
        }

        /* HAMBURGER */
        #sidebarToggle {
            color: #12a89d;
        }

        #sidebarToggle:hover {
            color: #0d8e85;
        }

        #sidebar, #mainArea, header, main {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, margin-left 0.3s ease, transform 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-50 overflow-x-hidden">

    {{-- =========================================
        SIDEBAR OVERLAY
    ========================================= --}}
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/30 z-40 hidden lg:hidden"></div>

    {{-- =========================================
        SIDEBAR
    ========================================= --}}
    <aside id="sidebar" class="fixed left-0 top-0 bottom-0 w-[321px] bg-white border-r border-gray-200 flex flex-col z-50 transition-transform duration-300 ease-in-out -translate-x-full">
        
        {{-- LOGO --}}
        <div class="logo-area h-[81px] flex items-center justify-center border-b border-gray-200 shrink-0">
            <img src="{{ asset('user-img/logo.png') }}" alt="Logo Digitama" class="w-[200px] h-auto">
        </div>

        {{-- =========================================
            MENU
        ========================================= --}}
        <div class="flex-1 px-0 overflow-y-auto">

            {{-- DASHBOARD --}}
            <div class="mt-[19px]">
                <div class="section-title px-[16px] mb-[6px] text-[14px] text-gray-500 font-normal">
                    User
                </div>

                <a href="{{ route('user.dashboard') }}" class="relative flex items-center gap-[10px] h-[40px] mx-[4px] pl-[18px] pr-[12px] rounded-[4px] text-[16px] {{ request()->routeIs('user.dashboard') ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium' : 'text-[#333333] hover:bg-gray-50' }}">
                    @if(request()->routeIs('user.dashboard'))
                        <span class="active-indicator absolute left-[-4px] top-0 bottom-0 w-[4px] bg-[#f6c400] rounded-r-[3px]"></span>
                    @endif

                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="9" stroke-width="1.6"></circle>
                        <path stroke-linecap="round" stroke-width="1.6" d="M12 8v4l2.5 2"></path>
                    </svg>

                    <span>Dashboard</span>
                </a>
            </div>

            {{-- =========================================
                PENILAIAN
            ========================================= --}}
            <div class="mt-[18px]">
                <div class="section-title px-[16px] mb-[5px] text-[14px] text-gray-500 font-normal">
                    Penilaian
                </div>

                {{-- PENILAIAN MANDIRI --}}
                <a href="{{ route('user.penilaian') }}" class="relative flex items-center gap-[10px] h-[40px] mx-[4px] pl-[22px] pr-[12px] rounded-[4px] text-[16px] {{ request()->routeIs('user.penilaian*') ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium' : 'text-[#333333] hover:bg-gray-50' }}">
                    @if(request()->routeIs('user.penilaian*'))
                        <span class="active-indicator absolute left-[-4px] top-0 bottom-0 w-[4px] bg-[#f6c400] rounded-r-[3px]"></span>
                    @endif

                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 3h7l4 4v14H7V3z"></path>
                        <path stroke-linecap="round" stroke-width="1.5" d="M14 3v5h5M10 12h5M10 16h5"></path>
                    </svg>

                    <span>Penilaian Mandiri</span>
                </a>
            </div>

            {{-- =========================================
                PROFILE
            ========================================= --}}
            <div class="mt-[18px]">
                <div class="section-title px-[16px] mb-[5px] text-[14px] text-gray-500 font-normal">
                    Profile
                </div>

                <a href="{{ route('user.profile') }}" class="relative flex items-center gap-[10px] h-[40px] mx-[4px] pl-[22px] pr-[12px] rounded-[4px] text-[16px] {{ request()->routeIs('user.profile*') ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium' : 'text-[#333333] hover:bg-gray-50' }}">
                    @if(request()->routeIs('user.profile*'))
                        <span class="active-indicator absolute left-[-4px] top-0 bottom-0 w-[4px] bg-[#f6c400] rounded-r-[3px]"></span>
                    @endif

                    <svg class="w-[18px] h-[18px] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="8" r="3" stroke-width="1.5"></circle>
                        <path stroke-linecap="round" stroke-width="1.5" d="M5 21c0-3.5 3-6 7-6s7 2.5 7 6"></path>
                    </svg>

                    <span>Profile</span>
                </a>
            </div>

        </div>

        {{-- =========================================
            LOGOUT
        ========================================= --}}
        <div class="px-[20px] pb-[40px] pt-[10px] shrink-0">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button w-full h-[39px] flex items-center justify-center gap-[8px] bg-[#ffe8e8] text-[#ef2222] rounded-[6px] text-[16px] font-medium hover:bg-[#ffdcdc] transition">
                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-width="1.8" d="M10 17l5-5-5-5"></path>
                        <path stroke-linecap="round" stroke-width="1.8" d="M15 12H3"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14 5V4a2 2 0 012-2h3a2 2 0 012 2v16a2 2 0 01-2 2h-3a2 2 0 01-2-2v-1"></path>
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- =========================================
        MAIN AREA
    ========================================= --}}
    <div id="mainArea" class="ml-0 lg:ml-[321px] min-h-screen flex flex-col transition-all duration-300 ease-in-out">

        {{-- =========================================
            NAVBAR
        ========================================= --}}
        <header class="h-[64px] shrink-0 bg-white border-b border-gray-200 flex items-center justify-between px-[16px] sm:px-[20px] lg:px-[28px] sticky top-0 z-30">

            {{-- KIRI --}}
            <div class="flex items-center gap-[18px]">
                {{-- HAMBURGER --}}
                <button id="sidebarToggle" type="button" onclick="toggleSidebar()" class="cursor-pointer focus:outline-none transition-colors duration-200" aria-label="Toggle sidebar">
                    <svg class="w-[24px] h-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                {{-- JUDUL --}}
                <span class="navbar-title text-[16px] font-medium text-gray-700 truncate">
                    {{ $pageTitle ?? 'Home' }}
                </span>
            </div>

            {{-- =========================================
                KANAN
            ========================================= --}}
            <div class="flex items-center gap-[18px]">
                {{-- THEME TOGGLE --}}
                <button id="themeToggle" type="button" onclick="toggleDarkMode()" class="focus:outline-none transition-colors duration-200" aria-label="Toggle dark mode">
                    {{-- SUN --}}
                    <svg id="sunIcon" class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4" stroke-width="1.5"></circle>
                        <path stroke-linecap="round" stroke-width="1.5" d="M12 2v2 M12 20v2 M4.93 4.93l1.41 1.41 M17.66 17.66l1.41 1.41 M2 12h2 M20 12h2 M4.93 19.07l1.41-1.41 M17.66 6.34l1.41-1.41"></path>
                    </svg>

                    {{-- MOON --}}
                    <svg id="moonIcon" class="hidden w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12.8 A8.5 8.5 0 1111.2 3 6.5 6.5 0 0021 12.8z"></path>
                    </svg>
                </button>

                {{-- PROFILE IMAGE --}}
                <div class="flex items-center gap-[7px]">
                    @if(auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Profile" class="w-[30px] h-[30px] rounded-full object-cover border border-gray-200 dark:border-gray-600">
                    @else
                        <div class="w-[30px] h-[30px] rounded-full overflow-hidden border border-gray-200 dark:border-gray-600">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=e9f9f7&color=12a89d" alt="Profile" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>
            </div>

        </header>

        {{-- =========================================
            CONTENT
        ========================================= --}}
        <main class="flex-1 bg-[#f8f8f8] p-[20px] sm:p-[24px] lg:p-[28px]">
            @yield('content')
        </main>

    </div>

    {{-- =========================================
        JAVASCRIPT
    ========================================= --}}
    <script>
        /* =========================================
            SIDEBAR
        ========================================= */
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
                /* CLOSE SIDEBAR */
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
            } else {
                sidebarOpen = false;
            }
            updateSidebar();
        });

        /* =========================================
            DARK MODE
        ========================================= */
        const themeToggle = document.getElementById('themeToggle');
        const sunIcon = document.getElementById('sunIcon');
        const moonIcon = document.getElementById('moonIcon');

        function applyTheme(isDark) {
            if (isDark) {
                document.documentElement.classList.add('dark-mode');
                document.body.classList.add('dark-mode');

                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            } else {
                document.documentElement.classList.remove('dark-mode');
                document.body.classList.remove('dark-mode');

                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        }

        function toggleDarkMode() {
            const isDark = document.body.classList.contains('dark-mode');
            const newTheme = isDark ? 'light' : 'dark';

            localStorage.setItem('theme', newTheme);
            applyTheme(!isDark);
        }

        const savedTheme = localStorage.getItem('theme');

        if (savedTheme === 'dark') {
            applyTheme(true);
        } else if (savedTheme === 'light') {
            applyTheme(false);
        } else {
            const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            applyTheme(systemDark);
        }

        const systemTheme = window.matchMedia('(prefers-color-scheme: dark)');

        systemTheme.addEventListener('change', function (event) {
            const savedTheme = localStorage.getItem('theme');

            if (savedTheme) {
                return;
            }

            applyTheme(event.matches);
        });
    </script>
</body>
</html>