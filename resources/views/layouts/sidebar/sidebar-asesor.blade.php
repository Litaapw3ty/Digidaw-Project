<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Digitama Dashboard' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Poppins -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        * {
            box-sizing: border-box;
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

        /* =====================================================
           DARK MODE
        ===================================================== */

        body.dark-mode {
            background-color: #111827;
            color: #f3f4f6;
        }

        /* SIDEBAR */
        body.dark-mode #sidebar {
            background-color: #1f2937;
            border-color: #374151;
        }

        /* LOGO AREA */
        body.dark-mode #sidebar .logo-area {
            border-color: #374151;
        }

        /* NAVBAR */
        body.dark-mode header {
            background-color: #1f2937;
            border-color: #374151;
        }

        /* MAIN */
        body.dark-mode main {
            background-color: #111827;
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
            color: #e5e7eb;
        }

        body.dark-mode #sidebar a:hover {
            background-color: #374151;
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
    </style>
</head>


<body class="bg-gray-50 overflow-x-hidden">


    <!-- =====================================================
         OVERLAY MOBILE / TABLET
    ====================================================== -->

    <div
        id="sidebarOverlay"
        onclick="toggleSidebar()"
        class="fixed inset-0 bg-black/30 z-40 hidden lg:hidden">
    </div>


    <!-- =====================================================
         SIDEBAR
    ====================================================== -->

    <aside
        id="sidebar"
        class="
            fixed
            left-0
            top-0
            bottom-0
            w-[321px]
            bg-white
            border-r
            border-gray-200
            flex
            flex-col
            z-50
            transition-transform
            duration-300
            ease-in-out
            -translate-x-full
        "
    >

        <!-- =================================================
             LOGO
        ================================================== -->

        <div
            class="
                logo-area
                h-[81px]
                flex
                items-center
                justify-center
                border-b
                border-gray-200
                shrink-0
            "
        >
            <img
                src="{{ asset('asesor_img/logo.png') }}"
                alt="Logo Digitama"
                class="w-[200px] h-auto"
            >
        </div>


<!-- =================================================
     MENU
================================================== -->

<div class="flex-1 px-0 overflow-y-auto">

    <!-- =================================================
         ADMIN
    ================================================== -->

    <div class="mt-[19px]">

        <div
            class="
                section-title
                px-[16px]
                mb-[6px]
                text-[14px]
                text-gray-500
                font-normal
            "
        >
            Admin
        </div>


        <!-- DASHBOARD -->

        <a
            href="{{ url('/admin/dashboard') }}"
            class="
                relative
                flex
                items-center
                gap-[10px]
                h-[40px]
                mx-[4px]
                pl-[18px]
                pr-[12px]
                rounded-[4px]
                text-[16px]

                {{ request()->is('admin/dashboard')
                    ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium'
                    : 'text-[#333333] hover:bg-gray-50'
                }}
            "
        >

            @if(request()->is('admin/dashboard'))

                <span
                    class="
                        active-indicator
                        absolute
                        left-[-4px]
                        top-0
                        bottom-0
                        w-[4px]
                        bg-[#f6c400]
                        rounded-r-[3px]
                    "
                ></span>

            @endif


            <!-- Icon Dashboard -->

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <rect
                    x="3"
                    y="3"
                    width="7"
                    height="7"
                    rx="1"
                    stroke-width="1.6"
                ></rect>

                <rect
                    x="14"
                    y="3"
                    width="7"
                    height="7"
                    rx="1"
                    stroke-width="1.6"
                ></rect>

                <rect
                    x="3"
                    y="14"
                    width="7"
                    height="7"
                    rx="1"
                    stroke-width="1.6"
                ></rect>

                <rect
                    x="14"
                    y="14"
                    width="7"
                    height="7"
                    rx="1"
                    stroke-width="1.6"
                ></rect>
            </svg>

            <span>Dashboard</span>

        </a>

    </div>



    <!-- =================================================
         DATA MASTER
    ================================================== -->

    <div class="mt-[18px]">

        <div
            class="
                section-title
                px-[16px]
                mb-[5px]
                text-[14px]
                text-gray-500
                font-normal
            "
        >
            Data Master
        </div>


        <!-- INSTANSI -->

        <a
            href="{{ url('/admin/instansi') }}"
            class="
                relative
                flex
                items-center
                gap-[10px]
                h-[40px]
                mx-[4px]
                pl-[22px]
                pr-[12px]
                rounded-[4px]
                text-[16px]

                {{ request()->is('admin/instansi*')
                    ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium'
                    : 'text-[#333333] hover:bg-gray-50'
                }}
            "
        >

            @if(request()->is('admin/instansi*'))

                <span
                    class="
                        active-indicator
                        absolute
                        left-[-4px]
                        top-0
                        bottom-0
                        w-[4px]
                        bg-[#f6c400]
                        rounded-r-[3px]
                    "
                ></span>

            @endif


            <!-- Icon Building -->

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M4 21V5a2 2 0 012-2h8a2 2 0 012 2v16"
                ></path>

                <path
                    stroke-linecap="round"
                    stroke-width="1.5"
                    d="M14 9h4a2 2 0 012 2v10"
                ></path>

                <path
                    stroke-width="1.5"
                    d="M8 7h2M8 11h2M8 15h2M16 15h2"
                ></path>
            </svg>

            <span>Instansi</span>

        </a>



        <!-- USER -->

        <a
            href="{{ url('/admin/user') }}"
            class="
                relative
                flex
                items-center
                gap-[10px]
                h-[40px]
                mx-[4px]
                pl-[22px]
                pr-[12px]
                rounded-[4px]
                text-[16px]

                {{ request()->is('admin/user*')
                    ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium'
                    : 'text-[#333333] hover:bg-gray-50'
                }}
            "
        >

            @if(request()->is('admin/user*'))

                <span
                    class="
                        active-indicator
                        absolute
                        left-[-4px]
                        top-0
                        bottom-0
                        w-[4px]
                        bg-[#f6c400]
                        rounded-r-[3px]
                    "
                ></span>

            @endif


            <!-- Icon User -->

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <circle
                    cx="12"
                    cy="8"
                    r="3"
                    stroke-width="1.5"
                ></circle>

                <path
                    stroke-linecap="round"
                    stroke-width="1.5"
                    d="M5 21c0-3.5 3-6 7-6s7 2.5 7 6"
                ></path>
            </svg>

            <span>User</span>

        </a>



        <!-- ASESOR -->

        <a
            href="{{ url('/admin/asesor') }}"
            class="
                relative
                flex
                items-center
                gap-[10px]
                h-[40px]
                mx-[4px]
                pl-[22px]
                pr-[12px]
                rounded-[4px]
                text-[16px]

                {{ request()->is('admin/asesor*')
                    ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium'
                    : 'text-[#333333] hover:bg-gray-50'
                }}
            "
        >

            @if(request()->is('admin/asesor*'))

                <span
                    class="
                        active-indicator
                        absolute
                        left-[-4px]
                        top-0
                        bottom-0
                        w-[4px]
                        bg-[#f6c400]
                        rounded-r-[3px]
                    "
                ></span>

            @endif


            <!-- Icon Asesor -->

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <circle
                    cx="10"
                    cy="8"
                    r="3"
                    stroke-width="1.5"
                ></circle>

                <path
                    stroke-linecap="round"
                    stroke-width="1.5"
                    d="M4 21c0-3.5 2.7-6 6-6"
                ></path>

                <path
                    stroke-linecap="round"
                    stroke-width="1.5"
                    d="M16 11v6M13 14h6"
                ></path>
            </svg>

            <span>Asesor</span>

        </a>

    </div>



    <!-- =================================================
         EVALUASI
    ================================================== -->

    <div class="mt-[18px]">

        <div
            class="
                section-title
                px-[16px]
                mb-[5px]
                text-[14px]
                text-gray-500
                font-normal
            "
        >
            Evaluasi
        </div>


        <!-- MONITORING PENILAIAN -->

        <a
            href="{{ url('/admin/monitoring-penilaian') }}"
            class="
                relative
                flex
                items-center
                gap-[10px]
                h-[40px]
                mx-[4px]
                pl-[22px]
                pr-[12px]
                rounded-[4px]
                text-[16px]

                {{ request()->is('admin/monitoring-penilaian*')
                    ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium'
                    : 'text-[#333333] hover:bg-gray-50'
                }}
            "
        >

            @if(request()->is('admin/monitoring-penilaian*'))

                <span
                    class="
                        active-indicator
                        absolute
                        left-[-4px]
                        top-0
                        bottom-0
                        w-[4px]
                        bg-[#f6c400]
                        rounded-r-[3px]
                    "
                ></span>

            @endif


            <!-- Icon Monitoring -->

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M5 3h14v18H5z"
                ></path>

                <path
                    stroke-linecap="round"
                    stroke-width="1.5"
                    d="M8 8h8M8 12h8M8 16h5"
                ></path>
            </svg>

            <span>Monitoring Penilaian</span>

        </a>



        <!-- HASIL VERIFIKASI -->

        <a
            href="{{ url('/admin/hasil-verifikasi') }}"
            class="
                relative
                flex
                items-center
                gap-[10px]
                h-[40px]
                mx-[4px]
                pl-[22px]
                pr-[12px]
                rounded-[4px]
                text-[16px]

                {{ request()->is('admin/hasil-verifikasi*')
                    ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium'
                    : 'text-[#333333] hover:bg-gray-50'
                }}
            "
        >

            @if(request()->is('admin/hasil-verifikasi*'))

                <span
                    class="
                        active-indicator
                        absolute
                        left-[-4px]
                        top-0
                        bottom-0
                        w-[4px]
                        bg-[#f6c400]
                        rounded-r-[3px]
                    "
                ></span>

            @endif


            <!-- Icon Verification -->

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <circle
                    cx="12"
                    cy="12"
                    r="9"
                    stroke-width="1.5"
                ></circle>

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M8 12l2.5 2.5L16 9"
                ></path>
            </svg>

            <span>Hasil Verifikasi</span>

        </a>

    </div>



    <!-- =================================================
         HASIL
    ================================================== -->

    <div class="mt-[18px]">

        <div
            class="
                section-title
                px-[16px]
                mb-[5px]
                text-[14px]
                text-gray-500
                font-normal
            "
        >
            Hasil
        </div>


        <!-- HASIL EVALUASI -->

        <a
            href="{{ url('/admin/hasil-evaluasi') }}"
            class="
                relative
                flex
                items-center
                gap-[10px]
                h-[40px]
                mx-[4px]
                pl-[22px]
                pr-[12px]
                rounded-[4px]
                text-[16px]

                {{ request()->is('admin/hasil-evaluasi*')
                    ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium'
                    : 'text-[#333333] hover:bg-gray-50'
                }}
            "
        >

            @if(request()->is('admin/hasil-evaluasi*'))

                <span
                    class="
                        active-indicator
                        absolute
                        left-[-4px]
                        top-0
                        bottom-0
                        w-[4px]
                        bg-[#f6c400]
                        rounded-r-[3px]
                    "
                ></span>

            @endif


            <!-- Icon File -->

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.5"
                    d="M7 3h7l4 4v14H7V3z"
                ></path>

                <path
                    stroke-linecap="round"
                    stroke-width="1.5"
                    d="M14 3v5h5M10 13h5M10 17h5"
                ></path>
            </svg>

            <span>Hasil Evaluasi</span>

        </a>

    </div>



    <!-- =================================================
         SISTEM
    ================================================== -->

    <div class="mt-[18px]">

        <div
            class="
                section-title
                px-[16px]
                mb-[5px]
                text-[14px]
                text-gray-500
                font-normal
            "
        >
            Sistem
        </div>


        <!-- PENGATURAN -->

        <a
            href="{{ url('/admin/pengaturan') }}"
            class="
                relative
                flex
                items-center
                gap-[10px]
                h-[40px]
                mx-[4px]
                pl-[22px]
                pr-[12px]
                rounded-[4px]
                text-[16px]

                {{ request()->is('admin/pengaturan*')
                    ? 'active-menu bg-[#eeeeee] text-[#333333] font-medium'
                    : 'text-[#333333] hover:bg-gray-50'
                }}
            "
        >

            @if(request()->is('admin/pengaturan*'))

                <span
                    class="
                        active-indicator
                        absolute
                        left-[-4px]
                        top-0
                        bottom-0
                        w-[4px]
                        bg-[#f6c400]
                        rounded-r-[3px]
                    "
                ></span>

            @endif


            <!-- Icon Setting -->

            <svg
                class="w-[18px] h-[18px] shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <circle
                    cx="12"
                    cy="12"
                    r="3"
                    stroke-width="1.5"
                ></circle>

                <path
                    stroke-linecap="round"
                    stroke-width="1.5"
                    d="M19.4 15a1.7 1.7 0 00.3 1.9l.1.1-2.1 2.1-.1-.1a1.7 1.7 0 00-1.9-.3 1.7 1.7 0 00-1 1.5v.2h-3v-.2a1.7 1.7 0 00-1-1.5 1.7 1.7 0 00-1.9.3l-.1.1-2.1-2.1.1-.1a1.7 1.7 0 00.3-1.9 1.7 1.7 0 00-1.5-1H5v-3h.2a1.7 1.7 0 001.5-1 1.7 1.7 0 00-.3-1.9l-.1-.1 2.1-2.1.1.1a1.7 1.7 0 001.9.3 1.7 1.7 0 001-1.5V5.6h3v.2a1.7 1.7 0 001 1.5 1.7 1.7 0 001.9-.3l.1-.1 2.1 2.1-.1.1a1.7 1.7 0 00-.3 1.9 1.7 1.7 0 001.5 1h.2v3h-.2a1.7 1.7 0 00-1.5 1z"
                ></path>
            </svg>

            <span>Pengaturan</span>

        </a>

    </div>

</div>


        <!-- =================================================
             LOGOUT
        ================================================== -->

        <div class="px-[20px] pb-[40px] pt-[10px] shrink-0">

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="
                        logout-button
                        w-full
                        h-[39px]
                        flex
                        items-center
                        justify-center
                        gap-[8px]
                        bg-[#ffe8e8]
                        text-[#ef2222]
                        rounded-[6px]
                        text-[16px]
                        font-medium
                        hover:bg-[#ffdcdc]
                        transition
                    "
                >

                    <svg
                        class="w-[18px] h-[18px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M10 17l5-5-5-5"
                        ></path>

                        <path
                            stroke-linecap="round"
                            stroke-width="1.8"
                            d="M15 12H3"
                        ></path>

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M14 5V4a2 2 0 012-2h3a2 2 0 012 2v16a2 2 0 01-2 2h-3a2 2 0 01-2-2v-1"
                        ></path>

                    </svg>

                    <span>Keluar</span>

                </button>

            </form>

        </div>

    </aside>



    <!-- =====================================================
         MAIN AREA
    ====================================================== -->

    <div
        id="mainArea"
        class="
            ml-0
            lg:ml-[321px]
            min-h-screen
            flex
            flex-col
            transition-all
            duration-300
            ease-in-out
        "
    >


        <!-- =================================================
             NAVBAR
        ================================================== -->

        <header
            class="
                h-[64px]
                shrink-0
                bg-white
                border-b
                border-gray-200
                flex
                items-center
                justify-between
                px-[16px]
                sm:px-[20px]
                lg:px-[28px]
                sticky
                top-0
                z-30
            "
        >

            <!-- KIRI -->

            <div class="flex items-center gap-[18px]">

                <!-- HAMBURGER -->

                <button
                    id="sidebarToggle"
                    type="button"
                    onclick="toggleSidebar()"
                    class="
                        cursor-pointer
                        focus:outline-none
                        transition-colors
                        duration-200
                    "
                    aria-label="Toggle sidebar"
                >

                    <svg
                        class="w-[24px] h-[24px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        ></path>

                    </svg>

                </button>


                <!-- JUDUL -->

                <span
                    class="
                        navbar-title
                        text-[16px]
                        font-medium
                        text-gray-700
                        truncate
                    "
                >
                    {{ $pageTitle ?? 'Home' }}
                </span>

            </div>



            <!-- KANAN -->

            <div class="flex items-center gap-[18px]">


                <!-- =================================================
                     DARK MODE BUTTON
                ================================================== -->

                <button
                    id="themeToggle"
                    type="button"
                    onclick="toggleDarkMode()"
                    class="
                        focus:outline-none
                        transition-colors
                        duration-200
                    "
                    aria-label="Toggle dark mode"
                >

                    <!-- SUN -->

                    <svg
                        id="sunIcon"
                        class="w-[18px] h-[18px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <circle
                            cx="12"
                            cy="12"
                            r="4"
                            stroke-width="1.5"
                        ></circle>

                        <path
                            stroke-linecap="round"
                            stroke-width="1.5"
                            d="
                                M12 2v2
                                M12 20v2
                                M4.93 4.93l1.41 1.41
                                M17.66 17.66l1.41 1.41
                                M2 12h2
                                M20 12h2
                                M4.93 19.07l1.41-1.41
                                M17.66 6.34l1.41-1.41
                            "
                        ></path>

                    </svg>



                    <!-- MOON -->

                    <svg
                        id="moonIcon"
                        class="hidden w-[18px] h-[18px]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="
                                M21 12.8
                                A8.5 8.5 0 1111.2 3
                                6.5 6.5 0 0021 12.8z
                            "
                        ></path>

                    </svg>

                </button>



                <!-- =================================================
                     PROFILE
                ================================================== -->

                <div class="flex items-center gap-[7px]">

                    <img
                        src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=faces"
                        alt="Profile"
                        class="w-[30px] h-[30px] rounded-full object-cover"
                    >

                </div>

            </div>

        </header>



        <!-- =================================================
             CONTENT
        ================================================== -->

        <main
            class="
                flex-1
                bg-[#f8f8f8]
                p-[20px]
                sm:p-[24px]
                lg:p-[28px]
            "
        >

            @yield('content')

        </main>

    </div>



    <!-- =====================================================
         JAVASCRIPT
    ====================================================== -->

    <script>

        /* =====================================================
           SIDEBAR
        ====================================================== */

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


        /* INITIAL */

        updateSidebar();


        /* RESIZE */

        window.addEventListener('resize', function () {

            /*
             * Kalau layar berubah menjadi desktop,
             * sidebar otomatis terbuka.
             */

            if (window.innerWidth >= 1024) {

                sidebarOpen = true;

            }

            /*
             * Kalau berubah ke mobile,
             * sidebar otomatis tertutup.
             */

            else {

                sidebarOpen = false;

            }

            updateSidebar();

        });



        /* =====================================================
           DARK MODE
        ====================================================== */

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
                moonIcon.classList.add('hidden');

                localStorage.setItem('theme', 'light');

            }

        }


        function toggleDarkMode() {

            const isDark =
                document.body.classList.contains('dark-mode');

            applyTheme(!isDark);

        }


        /* =====================================================
           LOAD SAVED THEME
        ====================================================== */

        const savedTheme = localStorage.getItem('theme');


        if (savedTheme === 'dark') {

            applyTheme(true);

        } else {

            applyTheme(false);

        }

    </script>

</body>

</html>