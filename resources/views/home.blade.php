<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Digitama - Sistem Evaluasi Pemerintah Digital</title>

    <meta
        name="description"
        content="Platform integrasi untuk mendukung proses penilaian transformasi digital instansi pemerintah."
    >

    {{-- =========================================================
        THEME INITIALIZER
    ========================================================== --}}
    <script>
        (() => {
            try {
                const savedTheme = localStorage.getItem('digitama-theme');

                if (savedTheme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else if (savedTheme === 'light') {
                    document.documentElement.classList.remove('dark');
                } else {
                    document.documentElement.classList.toggle(
                        'dark',
                        window.matchMedia('(prefers-color-scheme: dark)').matches
                    );
                }
            } catch (error) {}
        })();
    </script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif']
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#12c2bd',
                            dark: '#08aaa5',
                            light: '#68ddd8'
                        },
                        accent: {
                            DEFAULT: '#f2b51d',
                            dark: '#d99b0b'
                        },
                        ink: '#20252b'
                    }
                }
            }
        };
    </script>

    <style>
        :root { --header-height: 72px; }
        html { scroll-padding-top: var(--header-height); }
        body { min-width: 320px; }
        img { max-width: 100%; }

        /* Cloud puffs */
        .hero-cloud {
            width: clamp(76px, 8vw, 138px);
            height: clamp(22px, 2.3vw, 38px);
            border-radius: 999px;
            background: rgba(255,255,255,.34);
            filter: blur(9px);
            box-shadow: 22px -10px 0 2px rgba(255,255,255,.22),
                        43px 1px 0 -2px rgba(255,255,255,.18),
                        -18px 4px 0 -3px rgba(255,255,255,.2);
            opacity: .75;
        }
        .cloud-two { transform: scale(.72); opacity: .55; }
        .cloud-three { transform: scale(.58); opacity: .42; }

        /* Diagonal cut for hero building */
        .hero-diagonal {
            clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
        }
        /* CTA wave is an inline SVG so its curve stays smooth at every width. */
        .cta-dots {
            background-image: radial-gradient(rgba(255,255,255,.85) 1px, transparent 1px);
            background-size: 19px 19px;
            mask-image: linear-gradient(to top, #000, transparent 85%);
        }

        @media (min-width: 1024px) {
            #beranda > div.relative.z-10 { padding-top: clamp(3rem, 5vh, 5rem); }
            #beranda > div.absolute.inset-y-0.right-0 { width: 53%; }
        }
        @media (max-width: 1023px) {
            #beranda { min-height: 0; }
            #beranda > div.absolute.inset-y-0.right-0 { display: none; }
            #beranda > div.relative.z-10 { min-height: 0; padding-top: 5.5rem; padding-bottom: 5rem; }
            #beranda h1 { font-size: clamp(2rem, 5.4vw, 3rem); }
            #beranda p { font-size: clamp(.9rem, 1.8vw, 1rem); }
        }
        @media (max-width: 640px) {
            #beranda > div.relative.z-10 { padding: 5.25rem 1.25rem 4rem; }
            #beranda h1 br { display: none; }
            #beranda .mt-7 { align-items: stretch; }
            #beranda .mt-7 a { width: 100%; min-height: 46px; padding: .75rem 1rem; text-align: center; }
}
    </style>
</head>

<body class="overflow-x-hidden bg-white font-poppins text-slate-600 antialiased dark:bg-slate-950 dark:text-slate-300">

    {{-- =========================================================
        NAVBAR
    ========================================================== --}}
    <header class="fixed inset-x-0 top-0 z-50 h-[72px] border-b border-slate-200/70 bg-white/95 backdrop-blur-xl dark:border-slate-800 dark:bg-slate-950/95 transition-all">
        <div class="mx-auto flex h-full w-full max-w-[1600px] items-center gap-5 px-4 sm:px-6 lg:px-8 2xl:px-12">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="inline-flex shrink-0 items-center">
                <img src="{{ asset('user-img/logo.png') }}" alt="Digitama" class="h-10 w-auto">
            </a>

            {{-- Center Navigation --}}
            <nav class="ml-auto hidden items-center gap-5 xl:gap-7 lg:flex">
                <!-- Class default adalah text-slate-700, class text-primary & border-primary akan diatur oleh JS ScrollSpy -->
                <a href="#beranda" data-nav class="nav-link text-[14px] font-medium text-slate-700 border-b-2 border-transparent transition hover:text-primary dark:text-slate-300 dark:hover:text-primary h-[72px] inline-flex items-center">
                    Beranda
                </a>
                <a href="#fitur" data-nav class="nav-link text-[14px] font-medium text-slate-700 border-b-2 border-transparent transition hover:text-primary dark:text-slate-300 dark:hover:text-primary h-[72px] inline-flex items-center">
                    Fitur
                </a>
                <a href="#tentang" data-nav class="nav-link text-[14px] font-medium text-slate-700 border-b-2 border-transparent transition hover:text-primary dark:text-slate-300 dark:hover:text-primary h-[72px] inline-flex items-center">
                    Tentang
                </a>
                <a href="#faq" data-nav class="nav-link text-[14px] font-medium text-slate-700 border-b-2 border-transparent transition hover:text-primary dark:text-slate-300 dark:hover:text-primary h-[72px] inline-flex items-center">
                    FAQ
                </a>
            </nav>

            {{-- Actions --}}
            <div class="ml-0 flex shrink-0 items-center gap-2">
                <a href="{{ route('login') }}" class="hidden lg:inline-flex h-10 px-6 items-center justify-center gap-2 rounded-full bg-primary text-sm font-semibold text-white shadow-lg shadow-primary/30 transition hover:-translate-y-0.5 hover:bg-primary-dark">
                    <i class="fa-solid fa-arrow-right-to-bracket text-[11px]"></i>
                    Login
                </a>
                <button id="mobileMenuBtn" type="button" class="grid h-10 w-10 place-items-center rounded-lg border-0 bg-slate-100 text-slate-600 lg:hidden dark:bg-slate-800 dark:text-slate-200">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Navigation --}}
        <div id="mobileNav" class="hidden border-t border-slate-200 bg-white px-5 py-4 shadow-xl dark:border-slate-800 dark:bg-slate-950 lg:hidden">
            <div class="flex flex-col gap-2">
                <a href="#beranda" data-nav-mobile class="block rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary dark:text-slate-300">Beranda</a>
                <a href="#fitur" data-nav-mobile class="block rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary dark:text-slate-300">Fitur</a>
                <a href="#tentang" data-nav-mobile class="block rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary dark:text-slate-300">Tentang</a>
                <a href="#faq" data-nav-mobile class="block rounded-md px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-primary dark:text-slate-300">FAQ</a>
                <a href="{{ route('login') }}" class="mt-4 flex w-full items-center justify-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                </a>
            </div>
        </div>
    </header>

    <main>

        {{-- =========================================================
            HERO SECTION
        ========================================================== --}}
        <section id="beranda" class="relative min-h-[560px] overflow-hidden bg-white pt-[72px] dark:bg-slate-950 sm:min-h-[590px] lg:min-h-[min(76vh,760px)]">
            {{-- Gedung dengan efek potong diagonal layaknya Gambar 2 --}}
            <div class="absolute inset-y-0 right-0 z-0 hidden w-[52%] lg:block xl:w-[50%] hero-diagonal">
                <img src="{{ asset('user-img/gedung.png') }}" alt="Gedung Digitama" class="h-full w-full object-cover object-center">
                <div class="pointer-events-none absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-slate-200/75 via-slate-100/25 to-transparent blur-[2px] dark:from-slate-950/45 dark:via-slate-950/15"></div>
            </div>

            {{-- Dekorasi kotak kuning sesuai referensi --}}
            <div class="pointer-events-none absolute right-[45%] top-24 z-[1] hidden h-24 w-24 rotate-[15deg] bg-accent/20 lg:block"></div>

            <div class="relative z-10 mx-auto flex min-h-[488px] w-full max-w-[1400px] items-center px-6 py-16 sm:min-h-[518px] sm:px-10 lg:min-h-[min(76vh,688px)] lg:px-14 xl:px-16">
                <div class="w-full max-w-[min(52vw,700px)] lg:w-[48%] xl:w-[50%]">
                    <h1 class="max-w-[560px] text-[clamp(2rem,3vw,3.25rem)] font-extrabold leading-[1.14] tracking-tight text-slate-900 dark:text-white">
                        Sistem Evaluasi <br> Pemerintah <span class="text-accent">Digital</span>
                    </h1>

                    <p class="mt-5 max-w-[580px] text-[clamp(.9rem,1vw,1rem)] leading-[1.7] text-slate-600 dark:text-slate-300">
                        Platform terintegrasi untuk mendukung proses penilaian transformasi digital instansi pemerintah secara transparan, terukur, efektif, dan berkelanjutan.
                    </p>

                    <div class="mt-7 flex flex-wrap items-center gap-3">
                        <a href="{{ route('login') }}" class="inline-flex h-12 items-center justify-center rounded-full bg-primary px-7 text-sm font-semibold text-white shadow-lg shadow-primary/25 transition hover:-translate-y-0.5 hover:bg-primary-dark">
                            Mulai Sekarang
                        </a>
                        <a href="https://linktr.ee/EvaluasiKinerjaPemdi" class="inline-flex h-12 items-center justify-center rounded-full border border-slate-300 bg-white px-7 text-sm font-semibold text-slate-700 transition hover:border-primary hover:text-primary dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200">
                            Serba Serbi Evaluasi Kinerja Pemdi
                        </a>
                    </div>
                </div>
            </div>
        </section>


        {{-- =========================================================
            STATS OVERLAPPING
        ========================================================== --}}
        <div class="relative z-30 -mt-[42px] bg-transparent px-5 sm:px-8">
            <div class="mx-auto w-full max-w-[1240px]">
                <div class="grid grid-cols-2 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_10px_30px_rgb(0,0,0,0.08)] md:grid-cols-4 dark:border-slate-700 dark:bg-slate-900">
                    
                    {{-- Stat 1 --}}
                    <div class="flex min-h-[84px] items-center justify-center gap-3 px-4 py-5 sm:gap-4 sm:px-6">
                        <div class="text-[22px] text-primary">
                            <i class="fa-regular fa-circle-check"></i>
                        </div>
                        <div>
                            <strong class="block text-lg font-extrabold text-slate-900 sm:text-xl dark:text-white">100%</strong>
                            <span class="mt-0.5 block text-xs font-medium text-slate-500 dark:text-slate-400">Proses Digital</span>
                        </div>
                    </div>

                    {{-- Stat 2 --}}
                    <div class="flex min-h-[84px] items-center justify-center gap-3 border-t border-slate-100 px-4 py-5 sm:gap-4 sm:px-6 md:border-l md:border-t-0 dark:border-slate-800">
                        <div class="text-[22px] text-red-500">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <strong class="block text-lg font-extrabold text-slate-900 sm:text-xl dark:text-white">24/7</strong>
                            <span class="mt-0.5 block text-xs font-medium text-slate-500 dark:text-slate-400">Aksesibilitas</span>
                        </div>
                    </div>

                    {{-- Stat 3 --}}
                    <div class="flex min-h-[84px] items-center justify-center gap-3 border-t border-slate-100 px-4 py-5 sm:gap-4 sm:px-6 md:border-l md:border-t-0 dark:border-slate-800">
                        <div class="text-[22px] text-blue-500">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div>
                            <strong class="block text-lg font-extrabold text-slate-900 sm:text-xl dark:text-white">Fast</strong>
                            <span class="mt-0.5 block text-xs font-medium text-slate-500 dark:text-slate-400">Reporting</span>
                        </div>
                    </div>

                    {{-- Stat 4 --}}
                    <div class="flex min-h-[84px] items-center justify-center gap-3 border-t border-slate-100 px-4 py-5 sm:gap-4 sm:px-6 md:border-l md:border-t-0 dark:border-slate-800">
                        <div class="text-[22px] text-red-500">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div>
                            <strong class="block text-lg font-extrabold text-slate-900 sm:text-xl dark:text-white">Secure</strong>
                            <span class="mt-0.5 block text-xs font-medium text-slate-500 dark:text-slate-400">Data System</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- =========================================================
            FITUR
        ========================================================== --}}
        <section id="fitur" class="scroll-mt-20 bg-slate-50 px-6 pb-16 pt-[104px] dark:bg-slate-950/50">
            <div class="mx-auto w-full max-w-[1240px]">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl dark:text-white">
                        Fitur <span class="text-accent">Unggulan</span>
                    </h2>
                    <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-slate-600 sm:text-base dark:text-slate-400">
                        Dirancang untuk membantu instansi pemerintah dalam mengelola proses evaluasi digital secara profesional, modern, efisien, dan terintegrasi.
                    </p>
                </div>

                <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    {{-- Diupdate dengan soft background & solid teal text icon sesuai Gambar 2 --}}
                    <div class="flex min-h-[220px] flex-col rounded-2xl bg-white p-7 shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100 transition hover:-translate-y-1 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] dark:bg-slate-900 dark:border-slate-800">
                        <div class="mb-5 grid h-12 w-12 place-items-center rounded-xl bg-primary/10 text-xl text-primary">
                            <i class="fa-solid fa-display"></i>
                        </div>
                        <h3 class="mb-3 text-base font-bold text-slate-900 dark:text-white">Dashboard Real-time</h3>
                        <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                            Pantau progres penilaian, statistik evaluasi, dan capaian instansi secara langsung melalui dashboard interaktif dan informatif.
                        </p>
                    </div>
                    
                    <div class="flex min-h-[220px] flex-col rounded-2xl bg-white p-7 shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100 transition hover:-translate-y-1 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] dark:bg-slate-900 dark:border-slate-800">
                        <div class="mb-5 grid h-12 w-12 place-items-center rounded-xl bg-primary/10 text-xl text-primary">
                            <i class="fa-regular fa-clipboard"></i>
                        </div>
                        <h3 class="mb-3 text-base font-bold text-slate-900 dark:text-white">Penilaian Indikator</h3>
                        <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                            Kelola proses penilaian indikator secara terstruktur sesuai tahapan evaluasi dan standar yang telah ditetapkan.
                        </p>
                    </div>

                    <div class="flex min-h-[220px] flex-col rounded-2xl bg-white p-7 shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100 transition hover:-translate-y-1 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] dark:bg-slate-900 dark:border-slate-800">
                        <div class="mb-5 grid h-12 w-12 place-items-center rounded-xl bg-primary/10 text-xl text-primary">
                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        </div>
                        <h3 class="mb-3 text-base font-bold text-slate-900 dark:text-white">Upload Bukti Dukung</h3>
                        <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                            Unggah dan kelola dokumen pendukung evaluasi secara aman, cepat, dan terdokumentasi dengan baik.
                        </p>
                    </div>

                    <div class="flex min-h-[220px] flex-col rounded-2xl bg-white p-7 shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100 transition hover:-translate-y-1 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] dark:bg-slate-900 dark:border-slate-800">
                        <div class="mb-5 grid h-12 w-12 place-items-center rounded-xl bg-primary/10 text-xl text-primary">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <h3 class="mb-3 text-base font-bold text-slate-900 dark:text-white">Manajemen User</h3>
                        <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                            Hak akses, role, dan permission pengguna secara fleksibel sesuai kebutuhan sistem dan organisasi.
                        </p>
                    </div>

                    <div class="flex min-h-[220px] flex-col rounded-2xl bg-white p-7 shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100 transition hover:-translate-y-1 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] dark:bg-slate-900 dark:border-slate-800">
                        <div class="mb-5 grid h-12 w-12 place-items-center rounded-xl bg-primary/10 text-xl text-primary">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <h3 class="mb-3 text-base font-bold text-slate-900 dark:text-white">Keamanan Tinggi</h3>
                        <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                            Dilengkapi dengan mekanisme authentication dan authorization untuk menjaga keamanan data dan aktivitas pengguna.
                        </p>
                    </div>

                    <div class="flex min-h-[220px] flex-col rounded-2xl bg-white p-7 shadow-[0_4px_20px_rgb(0,0,0,0.03)] border border-slate-100 transition hover:-translate-y-1 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] dark:bg-slate-900 dark:border-slate-800">
                        <div class="mb-5 grid h-12 w-12 place-items-center rounded-xl bg-primary/10 text-xl text-primary">
                            <i class="fa-regular fa-file-lines"></i>
                        </div>
                        <h3 class="mb-3 text-base font-bold text-slate-900 dark:text-white">Laporan Otomatis</h3>
                        <p class="text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                            Hasil evaluasi dapat diunduh secara otomatis dalam format laporan digital yang siap digunakan untuk kebutuhan dokumentasi.
                        </p>
                    </div>
                </div>
            </div>
        </section>


        {{-- =========================================================
            TENTANG
        ========================================================== --}}
        <section id="tentang" class="scroll-mt-20 overflow-hidden bg-gradient-to-b from-slate-50 via-[#f7f9fc] to-white py-16 dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 sm:py-20 lg:py-24">
            <div class="mx-auto flex w-full max-w-[1240px] flex-col items-center gap-12 px-6 sm:px-8 lg:flex-row lg:gap-16">
                
                {{-- Image block adjusted as per image 2 --}}
                <div class="relative w-full lg:w-1/2">
                    <div class="absolute -bottom-4 -left-4 right-5 top-5 rounded-[2rem] bg-primary shadow-lg shadow-primary/20 dark:bg-primary-dark"></div>
                    <div class="relative z-10 -rotate-1 overflow-hidden rounded-[2rem] border border-white/70 shadow-[0_18px_45px_rgba(15,23,42,0.16)] transition-transform duration-500 hover:rotate-0 dark:border-slate-700">
                        <img src="{{ asset('user-img/image.png') }}" alt="Mendorong Transformasi Digital" class="block aspect-[4/3] w-full object-cover">
                    </div>
                </div>

                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl font-extrabold leading-tight text-slate-900 sm:text-4xl lg:text-[40px] dark:text-white">
                        Mendorong Transformasi <br>
                        <span class="text-accent">Digital Pemerintah</span>
                    </h2>
                    <p class="mt-5 text-[15px] leading-7 text-slate-600 dark:text-slate-400">
                        Sistem ini dikembangkan untuk mendukung Transformasi Digital Pemerintahan melalui proses evaluasi yang terintegrasi, transparan, dan berbasis teknologi.
                    </p>
                    <p class="mt-4 text-[15px] leading-7 text-slate-600 dark:text-slate-400">
                        Platform membantu instansi pemerintah meningkatkan tata kelola digital, kualitas layanan publik, keamanan informasi, serta implementasi inovasi digital secara berkelanjutan.
                    </p>
                </div>

            </div>
        </section>


        {{-- =========================================================
            FAQ
        ========================================================== --}}
        <section id="faq" class="scroll-mt-20 bg-gradient-to-b from-white via-[#eef2fb] to-[#f5f7fc] px-6 py-24 dark:from-slate-900 dark:via-slate-900 dark:to-slate-950">
            <div class="mx-auto w-full max-w-[900px]">
                
                <div class="mb-14 text-center">
                    <h2 class="text-3xl font-extrabold text-slate-900 sm:text-4xl dark:text-white">
                        FAQ<span class="text-primary">'s</span>
                    </h2>
                    <p class="mt-4 text-base text-slate-600 dark:text-slate-400">
                        Temukan jawaban dari berbagai pertanyaan yang sering diajukan terkait penggunaan sistem evaluasi pemerintah digital.
                    </p>
                </div>

                <div class="flex flex-col gap-4">
                    {{-- FAQ Items dengan icon kuning --}}
                    <div class="faq-item rounded-2xl bg-white shadow-sm border border-slate-100 transition-all dark:bg-slate-950 dark:border-slate-800">
                        <button type="button" class="faq-trigger flex w-full items-center justify-between gap-4 px-6 py-5 text-left" aria-expanded="false">
                            <span class="flex items-center gap-4 text-base font-bold text-slate-800 dark:text-white">
                                <i class="fa-regular fa-circle-question text-xl text-accent"></i>
                                Apa yang harus dilakukan jika lupa password?
                            </span>
                            <i class="fa-solid fa-chevron-down faq-arrow text-sm text-slate-400 transition-transform duration-300"></i>
                        </button>
                        <div class="faq-answer grid grid-rows-[0fr] transition-all duration-300">
                            <div class="overflow-hidden px-6">
                                <p class="pb-6 pt-2 pl-[42px] text-base text-slate-600 dark:text-slate-400">
                                    Hubungi administrator instansi untuk melakukan reset password melalui menu pengaturan akun.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item rounded-2xl bg-white shadow-sm border border-slate-100 transition-all dark:bg-slate-950 dark:border-slate-800">
                        <button type="button" class="faq-trigger flex w-full items-center justify-between gap-4 px-6 py-5 text-left" aria-expanded="false">
                            <span class="flex items-center gap-4 text-base font-bold text-slate-800 dark:text-white">
                                <i class="fa-regular fa-circle-question text-xl text-accent"></i>
                                Bagaimana cara mengubah password?
                            </span>
                            <i class="fa-solid fa-chevron-down faq-arrow text-sm text-slate-400 transition-transform duration-300"></i>
                        </button>
                        <div class="faq-answer grid grid-rows-[0fr] transition-all duration-300">
                            <div class="overflow-hidden px-6">
                                <p class="pb-6 pt-2 pl-[42px] text-base text-slate-600 dark:text-slate-400">
                                    Masuk ke menu pengaturan akun, kemudian pilih pengaturan password dan masukkan password baru.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item rounded-2xl bg-white shadow-sm border border-slate-100 transition-all dark:bg-slate-950 dark:border-slate-800">
                        <button type="button" class="faq-trigger flex w-full items-center justify-between gap-4 px-6 py-5 text-left" aria-expanded="false">
                            <span class="flex items-center gap-4 text-base font-bold text-slate-800 dark:text-white">
                                <i class="fa-regular fa-circle-question text-xl text-accent"></i>
                                Bagaimana cara login ke sistem?
                            </span>
                            <i class="fa-solid fa-chevron-down faq-arrow text-sm text-slate-400 transition-transform duration-300"></i>
                        </button>
                        <div class="faq-answer grid grid-rows-[0fr] transition-all duration-300">
                            <div class="overflow-hidden px-6">
                                <p class="pb-6 pt-2 pl-[42px] text-base text-slate-600 dark:text-slate-400">
                                    Klik tombol Login pada bagian navigasi kemudian masukkan username dan password yang telah diberikan oleh administrator.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        {{-- =========================================================
            CTA (Call to Action)
        ========================================================== --}}
        <section id="mulai" class="cta-section relative isolate overflow-hidden bg-gradient-to-b from-[#f5f7fc] via-white to-[#edf2fb] px-4 pb-0 pt-24 text-center dark:from-slate-950 dark:via-slate-950 dark:to-slate-900 sm:pt-28">
            <svg aria-hidden="true" class="pointer-events-none absolute inset-x-0 bottom-0 -z-0 h-[46%] w-full text-primary dark:text-primary-dark" viewBox="0 0 1440 420" preserveAspectRatio="none" focusable="false">
                <path fill="currentColor" d="M0,70 C180,205 330,315 520,355 C650,382 790,382 920,355 C1110,315 1260,205 1440,70 L1440,420 L0,420 Z"></path>
            </svg>
            <div aria-hidden="true" class="cta-dots pointer-events-none absolute inset-x-0 bottom-0 z-[1] h-28 opacity-20"></div>

            <div class="relative z-10 mx-auto w-full max-w-[1240px] px-2 pb-24 sm:pb-28">
                <h2 class="text-[clamp(2rem,3vw,3rem)] font-extrabold leading-tight text-slate-900 dark:text-white">
                    Siap <span class="text-primary dark:text-accent">Memulai</span> Evaluasi?
                </h2>
                <p class="mx-auto mt-5 max-w-2xl text-sm leading-relaxed text-slate-600 dark:text-slate-300 sm:text-base">
                    Mulai proses evaluasi digital dengan platform yang modern, terintegrasi, dan dirancang untuk mendukung peningkatan kualitas tata kelola pemerintahan berbasis teknologi.
                </p>
                <a href="{{ route('login') }}" class="mt-8 inline-flex h-12 items-center justify-center rounded-full bg-accent px-10 text-base font-bold text-white shadow-lg transition hover:-translate-y-1 hover:bg-accent-dark">
                    Masuk Sistem
                </a>
            </div>
        </section>

    </main>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}
    <footer class="bg-[#1e1e1e] text-slate-300">
        <div class="mx-auto grid w-full max-w-[1400px] gap-12 px-6 py-16 sm:px-8 md:grid-cols-2 lg:grid-cols-[1.5fr_0.8fr_1.5fr_1fr]">
            
            <div>
                <img src="{{ asset('user-img/logo.png') }}" alt="Digitama" class="mb-6 h-10 w-auto opacity-90">
                <p class="text-sm leading-relaxed text-slate-400">
                    Platform Evaluasi Pemerintah Digital yang mendukung implementasi Transformasi Digital Pemerintahan melalui sistem penilaian evaluasi yang terstruktur, transparan dan berbasis teknologi informasi.
                </p>
            </div>

            <div>
                <h4 class="mb-6 font-semibold text-white">Navigasi</h4>
                <div class="flex flex-col gap-3">
                    <a href="#beranda" class="text-sm text-slate-400 transition hover:text-white">Beranda</a>
                    <a href="#fitur" class="text-sm text-slate-400 transition hover:text-white">Fitur</a>
                    <a href="#tentang" class="text-sm text-slate-400 transition hover:text-white">Tentang</a>
                    <a href="#faq" class="text-sm text-slate-400 transition hover:text-white">FAQ</a>
                </div>
            </div>

            <div>
                <h4 class="mb-6 font-semibold text-white">Kontak</h4>
                <div class="flex flex-col gap-4">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-location-dot mt-1 w-4 text-slate-400"></i>
                        <span class="text-sm leading-relaxed text-slate-400">
                            DTA Square ( Downtown Area, Jl. Seturan Raya No.9A, Kledokan, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281
                        </span>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-phone mt-1 w-4 text-slate-400"></i>
                        <span class="text-sm text-slate-400">
                            +62 821-6000-8085 (office hour)
                        </span>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-envelope mt-1 w-4 text-slate-400"></i>
                        <span class="text-sm text-slate-400">
                            info@digitama.consulting
                        </span>
                    </div>
                </div>
            </div>

            <div>
                <h4 class="mb-6 font-semibold text-white">Media Sosial</h4>
                <div class="flex gap-3">
                    <a href="https://www.instagram.com/digitama.consulting/" class="grid h-10 w-10 place-items-center rounded-full bg-slate-800 text-sm text-slate-300 transition hover:bg-primary hover:text-white"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.youtube.com/@digitamaconsulting2631" class="grid h-10 w-10 place-items-center rounded-full bg-slate-800 text-sm text-slate-300 transition hover:bg-primary hover:text-white"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.linkedin.com/company/digitama-indonesia/home/" class="grid h-10 w-10 place-items-center rounded-full bg-slate-800 text-sm text-slate-300 transition hover:bg-primary hover:text-white"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
            </div>

        </div>

        <div class="border-t border-slate-800 py-6 text-center text-sm text-slate-500">
            © 2026 Magang PNC. All Rights Reserved.
        </div>
    </footer>


    {{-- Floating Theme Toggle --}}
    <div id="themeControl" class="fixed bottom-6 right-6 z-[70] flex items-center gap-1 rounded-full border border-slate-200 bg-white p-1.5 shadow-lg dark:border-slate-700 dark:bg-slate-900">
        <button type="button" data-theme-mode="system" aria-label="System" class="theme-mode grid h-9 w-9 place-items-center rounded-full text-xs text-slate-500 transition hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800"><i class="fa-solid fa-desktop"></i></button>
        <button type="button" data-theme-mode="light" aria-label="Light" class="theme-mode grid h-9 w-9 place-items-center rounded-full text-xs text-slate-500 transition hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800"><i class="fa-solid fa-sun"></i></button>
        <button type="button" data-theme-mode="dark" aria-label="Dark" class="theme-mode grid h-9 w-9 place-items-center rounded-full text-xs text-slate-500 transition hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800"><i class="fa-solid fa-moon"></i></button>
    </div>

    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* THEME */
            const root = document.documentElement;
            const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            const themeButtons = document.querySelectorAll('[data-theme-mode]');

            const applyTheme = (theme) => {
                const isDark = theme === 'dark' || (theme === 'system' && mediaQuery.matches);
                root.classList.toggle('dark', isDark);

                themeButtons.forEach(button => {
                    const active = button.dataset.themeMode === theme;
                    button.classList.toggle('bg-primary', active);
                    button.classList.toggle('text-white', active);
                    button.classList.toggle('text-slate-500', !active);
                    button.classList.toggle('dark:text-slate-400', !active);
                });
            };

            const saveTheme = (theme) => {
                try { localStorage.setItem('digitama-theme', theme); } catch (e) {}
                applyTheme(theme);
            };

            const initialTheme = localStorage.getItem('digitama-theme') || 'system';
            applyTheme(initialTheme);

            themeButtons.forEach(button => {
                button.addEventListener('click', () => saveTheme(button.dataset.themeMode));
            });
            mediaQuery.addEventListener('change', (e) => {
                if ((localStorage.getItem('digitama-theme') || 'system') === 'system') root.classList.toggle('dark', e.matches);
            });

            /* MOBILE MENU */
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileNav = document.getElementById('mobileNav');

            mobileMenuBtn?.addEventListener('click', () => {
                const isOpen = !mobileNav.classList.contains('hidden');
                mobileNav.classList.toggle('hidden');
                const icon = mobileMenuBtn.querySelector('i');
                if (icon) {
                    icon.classList.toggle('fa-bars', isOpen);
                    icon.classList.toggle('fa-xmark', !isOpen);
                }
            });

            document.querySelectorAll('[data-nav-mobile]').forEach(link => {
                link.addEventListener('click', () => {
                    mobileNav.classList.add('hidden');
                    mobileMenuBtn.querySelector('i')?.classList.replace('fa-xmark', 'fa-bars');
                });
            });

            /* FAQ ACCORDION */
            document.querySelectorAll('.faq-item').forEach(item => {
                const button = item.querySelector('.faq-trigger');
                const answer = item.querySelector('.faq-answer');
                const arrow = item.querySelector('.faq-arrow');

                button?.addEventListener('click', () => {
                    const isOpen = button.getAttribute('aria-expanded') === 'true';

                    // Close all
                    document.querySelectorAll('.faq-item').forEach(otherItem => {
                        otherItem.querySelector('.faq-trigger')?.setAttribute('aria-expanded', 'false');
                        otherItem.querySelector('.faq-answer')?.classList.replace('grid-rows-[1fr]', 'grid-rows-[0fr]');
                        otherItem.querySelector('.faq-arrow')?.classList.remove('rotate-180');
                    });

                    // Open clicked if it was closed
                    if (!isOpen) {
                        button.setAttribute('aria-expanded', 'true');
                        answer.classList.replace('grid-rows-[0fr]', 'grid-rows-[1fr]');
                        arrow?.classList.add('rotate-180');
                    }
                });
            });

            /* SCROLL SPY UNTUK ACTIVE NAVBAR */
            const sections = document.querySelectorAll("section[id]");
            const navLinks = document.querySelectorAll("nav a[data-nav]");

            window.addEventListener("scroll", () => {
                let current = "";
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    // Offset 100 untuk antisipasi tinggi navbar saat user scrolling
                    if (pageYOffset >= sectionTop - 100) {
                        current = section.getAttribute("id");
                    }
                });

                navLinks.forEach((link) => {
                    // Reset styling semua link
                    link.classList.remove("text-primary", "border-primary", "dark:text-primary");
                    link.classList.add("text-slate-700", "border-transparent");
                    
                    // Tambahkan warna & border pada link yang sesuai dengan section yang sedang aktif
                    if (link.getAttribute("href").includes(current)) {
                        link.classList.remove("text-slate-700", "border-transparent");
                        link.classList.add("text-primary", "border-primary", "dark:text-primary");
                    }
                });
            });

            /* SMOOTH SCROLL */
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', event => {
                    const id = anchor.getAttribute('href');
                    if (!id || id === '#') return;
                    const target = document.querySelector(id);
                    if (!target) return;
                    
                    event.preventDefault();
                    window.scrollTo({
                        top: target.getBoundingClientRect().top + window.scrollY - 72, // Offset for navbar
                        behavior: 'smooth'
                    });
                });
            });

        });
    </script>
</body>
</html>