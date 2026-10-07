<x-guest-layout>

    {{-- =========================================================
         LOGIN PAGE
    ========================================================== --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        digitama: {
                            teal: '#0D9488',
                            teal2: '#14B8A6',
                            yellow: '#F59E0B',
                        }
                    }
                }
            }
        };
    </script>

    {{-- =========================================================
        SYSTEM THEME
    ========================================================== --}}
    <script>
        (() => {
            const media = window.matchMedia('(prefers-color-scheme: dark)');
            const applySystemTheme = () => {
                const root = document.getElementById('loginRoot');
                if (root) {
                    root.dataset.theme = media.matches ? 'dark' : 'light';
                }
            };
            document.addEventListener('DOMContentLoaded', applySystemTheme, { once: true });
        })();
    </script>

    <style>
        #loginRoot {
            --login-page: #ffffff;
            --login-panel: #ffffff;
            --login-text: #202124;
            --login-muted: #64748b;
            --login-label: #242424;
            --login-input: #ffffff;
            --login-input-text: #1f2937;
            --login-border: #bdbdbd;
            --login-placeholder: #777777;
            --login-soft: #f8fafc;
            --login-shadow: rgba(0, 0, 0, .16);
            --login-shape-cyan: rgba(20, 195, 190, .25);
            --login-shape-gray: rgba(148, 163, 184, .25);
            --login-shape-yellow: rgba(251, 191, 36, .25);

            background: var(--login-page) !important;
            color: var(--login-text) !important;
            font-family: 'Poppins', sans-serif;
            min-height: 100dvh;
            height: 100dvh;
        }

        #loginRoot[data-theme="dark"] {
            --login-page: #020617; /* slate-950 */
            --login-panel: #0f172a; /* slate-900 */
            --login-text: #f8fafc;
            --login-muted: #94a3b8;
            --login-label: #f1f5f9;
            --login-input: #1e293b; /* slate-800 */
            --login-input-text: #f8fafc;
            --login-border: #334155; /* slate-700 */
            --login-placeholder: #64748b;
            --login-soft: #1e293b;
            --login-shadow: rgba(0, 0, 0, .55);
            --login-shape-cyan: rgba(20, 195, 190, .08);
            --login-shape-gray: rgba(100, 116, 139, .10);
            --login-shape-yellow: rgba(245, 158, 11, .08);
        }

        #loginRoot .login-theme-toggle {
            position: fixed;
            right: clamp(18px, 2vw, 30px);
            bottom: clamp(18px, 2.5vh, 30px);
            z-index: 9999;
            width: clamp(42px, 3.2vw, 50px);
            height: clamp(42px, 3.2vw, 50px);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--login-border) !important;
            border-radius: 9999px;
            background: var(--login-panel) !important;
            color: var(--login-text) !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .16);
            cursor: pointer;
            font-size: clamp(16px, 1.3vw, 19px);
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease, color .2s ease;
        }

        #loginRoot .login-theme-toggle:hover {
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 10px 28px rgba(0, 0, 0, .22);
        }

        #loginRoot .login-theme-toggle:focus-visible {
            outline: 3px solid rgba(20, 184, 166, .28);
            outline-offset: 3px;
        }

        #loginRoot[data-theme="dark"] .login-theme-toggle {
            color: #fbbf24 !important;
            background: #1e293b !important;
            border-color: #334155 !important;
        }

        #loginRoot .login-main {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            width: 100%;
            min-height: 100%;
        }

        #loginRoot .login-left {
            position: relative;
            min-width: 0;
            min-height: 100%;
            overflow: hidden;
            background: var(--login-page) !important;
            color: var(--login-text) !important;
        }

        #loginRoot .login-right {
            position: relative;
            z-index: 40;
            min-width: 0;
            min-height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(38px, 5vh, 72px) clamp(32px, 5vw, 82px);
            background: var(--login-panel) !important;
            color: var(--login-text) !important;
            border-radius: clamp(46px, 5vw, 82px) 0 0 clamp(46px, 5vw, 82px);
            box-shadow: -22px 0 50px var(--login-shadow);
        }

        #loginRoot .login-content {
            position: relative;
            z-index: 10;
            width: min(100%, 520px);
        }

        /* Logo / intro */
        #loginRoot .login-logo {
            position: absolute;
            left: clamp(34px, 4vw, 58px);
            top: clamp(28px, 4vh, 38px);
            z-index: 30;
        }

        #loginRoot .login-logo img {
            display: block;
            width: clamp(155px, 13vw, 205px);
            height: auto;
        }

        #loginRoot .login-intro {
            position: absolute;
            left: clamp(34px, 4vw, 58px);
            top: clamp(130px, 18vh, 158px);
            z-index: 20;
            width: min(610px, 76%);
        }

        #loginRoot .login-intro h1 {
            margin: 0;
            font-size: clamp(27px, 2.25vw, 34px);
            line-height: 1.15;
            letter-spacing: -.7px;
            font-weight: 700;
            color: var(--login-text) !important;
        }

        #loginRoot .login-intro p {
            margin-top: 14px;
            max-width: 540px;
            font-size: clamp(13px, 1.05vw, 15.5px);
            line-height: 1.5;
            font-weight: 500;
            color: var(--login-muted) !important;
        }

        /* Abstract shapes */
        #loginRoot .shape-cyan {
            position: absolute;
            right: -6px;
            top: -35px;
            z-index: 10;
            width: clamp(145px, 12vw, 185px);
            height: clamp(200px, 18vw, 250px);
            transform: rotate(-36deg);
            border-radius: 28px;
            background: var(--login-shape-cyan) !important;
        }

        #loginRoot .shape-gray {
            position: absolute;
            right: -25px;
            top: 28%;
            z-index: 10;
            width: clamp(160px, 14vw, 205px);
            height: clamp(160px, 14vw, 205px);
            transform: rotate(20deg);
            border-radius: 10px;
            background: var(--login-shape-gray) !important;
        }

        #loginRoot .shape-yellow {
            position: absolute;
            left: -5px;
            bottom: 29%;
            z-index: 10;
            width: clamp(145px, 12vw, 180px);
            height: clamp(145px, 12vw, 180px);
            transform: rotate(34deg);
            border-radius: 8px;
            background: var(--login-shape-yellow) !important;
        }

        /* Building */
        #loginRoot .building-wrap {
            position: absolute;
            left: 0;
            bottom: 0;
            z-index: 5;
            width: 100%;
            height: 67%;
            overflow: hidden;
        }

        #loginRoot .building-tree {
            position: absolute;
            left: 0;
            bottom: -3px;
            z-index: 3;
            width: clamp(170px, 15vw, 235px);
            max-width: none;
            height: auto;
            object-fit: contain;
        }

        #loginRoot .building-img {
            position: absolute;
            left: 0;
            bottom: -1px;
            z-index: 4;
            width: 100%;
            height: 100%;
            transform: scale(1.025);
            object-fit: cover;
            object-position: center 19%;
        }

        #loginRoot .building-gradient {
            position: absolute;
            inset-inline: 0;
            bottom: 0;
            z-index: 7;
            height: 29%;
            background: linear-gradient(to top, rgba(7,158,152,.90), rgba(7,158,152,.35), transparent);
        }

        /* Gradient gelap diubah menyesuaikan slate */
        #loginRoot[data-theme="dark"] .building-gradient {
            background: linear-gradient(to top, rgba(2,6,23,.95), rgba(2,6,23,.50), transparent);
        }

        #loginRoot .login-heading {
            margin: 0;
            font-size: clamp(27px, 2.3vw, 34px);
            line-height: 1.2;
            letter-spacing: -.6px;
            font-weight: 700;
            color: var(--login-text) !important;
        }

        #loginRoot .login-subheading {
            margin-top: 6px;
            font-size: clamp(16px, 1.35vw, 19px);
            line-height: 1.4;
            font-weight: 400;
            color: var(--login-muted) !important;
        }

        #loginRoot .login-label {
            display: block;
            margin-bottom: 8px;
            font-size: clamp(14px, 1.15vw, 17px);
            line-height: 1.2;
            font-weight: 600;
            color: var(--login-label) !important;
        }

        #loginRoot .login-input {
            display: block;
            width: 100%;
            height: clamp(50px, 5vw, 56px);
            padding: 0 clamp(20px, 2.2vw, 30px);
            border: 1.5px solid var(--login-border) !important;
            border-radius: clamp(15px, 1.5vw, 18px);
            background: var(--login-input) !important;
            color: var(--login-input-text) !important;
            font-family: 'Poppins', sans-serif;
            font-size: clamp(14px, 1.1vw, 16px);
            font-weight: 400;
            outline: none;
            box-shadow: none;
            transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        }

        #loginRoot .login-input::placeholder {
            color: var(--login-placeholder) !important;
            opacity: 1;
        }

        #loginRoot .login-input:focus {
            border-color: #0D9488 !important;
            box-shadow: 0 0 0 4px rgba(13,148,136,.10) !important;
        }

        #loginRoot .remember-label,
        #loginRoot .hotline-link,
        #loginRoot .datetime-text,
        #loginRoot .evaluation-link {
            color: var(--login-muted) !important;
        }

        #loginRoot .remember-label,
        #loginRoot .hotline-link {
            font-size: clamp(13px, 1.05vw, 15px);
            font-weight: 400;
        }

        #loginRoot .login-button {
            height: clamp(52px, 5vw, 58px);
            border-radius: clamp(15px, 1.5vw, 18px);
            font-size: clamp(16px, 1.35vw, 19px);
            font-weight: 600;
        }

        #loginRoot .datetime-text {
            margin-top: 15px;
            font-size: clamp(13px, 1vw, 15px);
            font-weight: 400;
        }

        #loginRoot .evaluation-link {
            font-size: clamp(13px, 1.05vw, 16px);
            font-weight: 500;
        }

        #loginRoot .password-button {
            color: var(--login-muted) !important;
        }

        #loginRoot .remember-box {
            border-color: var(--login-border) !important;
            background: var(--login-input) !important;
        }

        /* Responsive Media Queries */
        @media (max-width: 1100px) {
            #loginRoot .login-right {
                padding-inline: clamp(28px, 4vw, 48px);
            }
            #loginRoot .login-content {
                width: min(100%, 470px);
            }
        }

        @media (max-width: 900px) {
            #loginRoot .login-main { grid-template-columns: 1fr; }
            #loginRoot .login-left { display: none; }
            #loginRoot .login-right {
                min-height: 100%;
                border-radius: 0;
                box-shadow: none;
                padding: 34px 22px;
            }
            #loginRoot .login-content { width: min(100%, 520px); }
        }

        @media (max-height: 720px) and (min-width: 901px) {
            #loginRoot .login-right {
                align-items: flex-start;
                padding-top: 34px;
                padding-bottom: 34px;
            }
            #loginRoot .login-content { margin-block: auto; }
            #loginRoot .login-intro { top: 125px; }
            #loginRoot .building-wrap { height: 61%; }
        }

        @media (max-height: 600px) and (min-width: 901px) {
            #loginRoot .login-right {
                padding-top: 24px;
                padding-bottom: 24px;
            }
        }
    </style>

    {{-- =========================================================
         LOGIN ROOT
    ========================================================== --}}
    <div id="loginRoot" class="fixed inset-0 z-50 w-screen overflow-auto antialiased">

        <button
            type="button"
            id="loginThemeToggle"
            aria-label="Ganti tema"
            title="Ganti tema"
            class="login-theme-toggle"
        >
            <i id="loginThemeIcon" class="fa-solid fa-moon"></i>
        </button>

        <main class="login-main">

            {{-- LEFT SECTION --}}
            <section class="login-left">
                <div class="shape-cyan pointer-events-none"></div>
                <div class="shape-gray pointer-events-none"></div>
                <div class="shape-yellow pointer-events-none"></div>

                <div class="login-logo">
                    <img src="{{ asset('user-img/logo.png') }}" alt="DIGITAMA">
                </div>

                <div class="login-intro">
                    <h1>
                        Sistem Evaluasi Pemerintah<br>
                        <span class="text-[#F59E0B]">Digital</span>
                    </h1>
                    <p>
                        Kelola dan pantau evaluasi pemerintahan digital<br class="hidden sm:block">
                        secara terintegrasi, mudah, dan efisien.
                    </p>
                </div>

                <div class="building-wrap pointer-events-none">
                    <img src="{{ asset('user-img/pohon.png') }}" alt="Tanaman" class="building-tree">
                    <img src="{{ asset('user-img/gedung-login.png') }}" alt="Gedung Digitama" class="building-img">
                    <div class="building-gradient"></div>
                </div>
            </section>

            {{-- RIGHT SECTION --}}
            <section class="login-right">
                <div class="login-content">

                    <div class="mb-7">
                        <h2 class="login-heading">Selamat Datang</h2>
                        <p class="login-subheading">Silahkan masuk untuk melanjutkan</p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" id="loginForm" class="w-full">
                        @csrf

                        {{-- EMAIL --}}
                        <div class="mb-5">
                            <label for="email" class="login-label">Email</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan Email Anda"
                                required
                                autofocus
                                autocomplete="username"
                                class="login-input"
                            >
                            @error('email')
                                <span class="mt-1 block pl-1 text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-5">
                            <label for="password" class="login-label">Password</label>
                            <div class="relative">
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    placeholder="Masukkan Password Anda"
                                    required
                                    autocomplete="current-password"
                                    class="login-input pr-16"
                                >
                                <button
                                    type="button"
                                    id="passwordToggle"
                                    aria-label="Tampilkan password"
                                    class="password-button absolute right-3 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border-0 bg-transparent text-lg transition-colors hover:text-[#0D9488]"
                                >
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="mt-1 block pl-1 text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- REMEMBER / HOTLINE --}}
                        {{-- REMEMBER / HOTLINE --}}
<div class="mb-6 flex w-full items-center justify-between gap-4">

    <label
        for="remember"
        class="remember-label flex cursor-pointer items-center gap-2.5"
    >
        <input
            id="remember"
            type="checkbox"
            name="remember"
            value="on"
            class="h-5 w-5 cursor-pointer rounded border-gray-300 text-[#0D9488] focus:ring-[#0D9488]"
        >

        <span>Ingat Saya</span>
    </label>

    <a
        href="https://api.whatsapp.com/send/?phone=6289696961908&text&type=phone_number&app_absent=0"
        class="hotline-link no-underline transition-colors hover:text-[#0D9488]"
    >
        Hubungi hotline!
    </a>

</div>

                        {{-- SUBMIT --}}
                        <button
                            type="submit"
                            id="submitBtn"
                            class="login-button flex w-full items-center justify-center border-0 bg-gradient-to-r from-[#14C8C0] to-[#10978F] text-white shadow-[0_5px_15px_rgba(13,148,136,0.20)] transition-all duration-200 hover:-translate-y-[1px] hover:shadow-[0_7px_20px_rgba(13,148,136,0.30)] disabled:cursor-not-allowed disabled:opacity-70"
                        >
                            Masuk
                        </button>

                        {{-- DATETIME --}}
                        <div id="datetime-display" class="datetime-text text-center tracking-[0.1px]">
                            {{ now()->format('Y-m-d H:i:s') }}
                        </div>

                        {{-- EVALUATION --}}
                        <div class="mt-4 text-center">
                            <a href="https://linktr.ee/EvaluasiKinerjaPemdi" class="evaluation-link no-underline transition-colors hover:text-[#0D9488]">
                                Serba Serbi Evaluasi Kinerja Pemdi
                            </a>
                        </div>
                    </form>

                </div>
            </section>
        </main>
    </div>

    {{-- =========================================================
         LOGIN-ONLY JAVASCRIPT
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginRoot = document.getElementById('loginRoot');
            const themeToggle = document.getElementById('loginThemeToggle');
            const themeIcon = document.getElementById('loginThemeIcon');
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

            function renderTheme(theme) {
                if (!loginRoot) return;
                loginRoot.dataset.theme = theme;

                if (themeIcon) {
                    themeIcon.className = theme === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
                }
            }

            renderTheme(mediaQuery.matches ? 'dark' : 'light');

            mediaQuery.addEventListener('change', (e) => {
                renderTheme(e.matches ? 'dark' : 'light');
            });

            themeToggle?.addEventListener('click', function () {
                const current = loginRoot?.dataset.theme === 'dark' ? 'dark' : 'light';
                renderTheme(current === 'dark' ? 'light' : 'dark');
            });

            /* =====================================================
               PASSWORD SHOW / HIDE
            ====================================================== */
            const password = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');

            passwordToggle?.addEventListener('click', function () {
                const icon = this.querySelector('i');
                if (password.type === 'password') {
                    password.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                    this.setAttribute('aria-label', 'Sembunyikan password');
                } else {
                    password.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                    this.setAttribute('aria-label', 'Tampilkan password');
                }
            });

            /* =====================================================
               REALTIME DATETIME
            ====================================================== */
            const datetime = document.getElementById('datetime-display');
            function updateDateTime() {
                if (!datetime) return;
                const now = new Date();
                const pad = value => String(value).padStart(2, '0');
                datetime.textContent =
                    `${now.getFullYear()}-` +
                    `${pad(now.getMonth() + 1)}-` +
                    `${pad(now.getDate())} ` +
                    `${pad(now.getHours())}:` +
                    `${pad(now.getMinutes())}:` +
                    `${pad(now.getSeconds())}`;
            }
            updateDateTime();
            setInterval(updateDateTime, 1000);

            /* =====================================================
               PREVENT DOUBLE SUBMIT
            ====================================================== */
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');

            loginForm?.addEventListener('submit', function () {
                if (!submitBtn) return;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Memproses...';
            });
        });
    </script>
</x-guest-layout>