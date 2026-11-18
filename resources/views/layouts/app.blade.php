<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PPID Arkan - Portal Layanan Informasi Publik')</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#172554',
                        },
                        navy: {
                            800: '#0d3b66',
                            900: '#072a4d',
                            950: '#051937',
                        },
                        accent: {
                            300: '#fde047',
                            400: '#facc15',
                            500: '#eab308',
                            600: '#ca8a04',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Swiper CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Swiper JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .glass-navbar {
            background-color: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }
        .text-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen selection:bg-blue-600 selection:text-white" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-navy-950 via-blue-950 to-primary-900 text-slate-300 text-xs py-2 px-4 border-b border-blue-900/50">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center space-x-6 flex-wrap justify-center sm:justify-start">
                <span class="flex items-center gap-1.5">
                    <i class="fa-solid fa-clock text-accent-400"></i>
                    Jam Pelayanan: Senin - Jumat (08:00 - 16:00 WIB)
                </span>
                <span class="hidden md:flex items-center gap-1.5">
                    <i class="fa-solid fa-phone-volume text-accent-400"></i>
                    Hotline: (0717) 431234
                </span>
                <span class="hidden lg:flex items-center gap-1.5">
                    <i class="fa-solid fa-envelope text-accent-400"></i>
                    ppid@arkan.babelprov.go.id
                </span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ url('/permohonan-informasi') }}" class="text-accent-300 hover:text-white transition flex items-center gap-1 font-medium">
                    <i class="fa-solid fa-circle-info text-xs"></i> Permohonan Online
                </a>
                <span class="text-blue-700">|</span>
                <div class="flex items-center space-x-3 text-slate-400">
                    <a href="#" class="hover:text-accent-400 transition" title="Facebook"><i class="fa-brands fa-facebook-f text-xs"></i></a>
                    <a href="#" class="hover:text-accent-400 transition" title="Twitter/X"><i class="fa-brands fa-x-twitter text-xs"></i></a>
                    <a href="#" class="hover:text-accent-400 transition" title="Instagram"><i class="fa-brands fa-instagram text-xs"></i></a>
                    <a href="#" class="hover:text-accent-400 transition" title="YouTube"><i class="fa-brands fa-youtube text-xs"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar (Fixed Glassmorphism) -->
    <header :class="scrolled ? 'shadow-lg py-2.5 bg-white/95' : 'shadow-sm py-4 bg-white/90'" class="glass-navbar sticky top-0 z-50 transition-all duration-300 border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <!-- Brand / Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group focus:outline-none">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-blue-700 via-primary-600 to-accent-400 p-0.5 shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform duration-300 flex items-center justify-center text-white">
                        <div class="w-full h-full bg-slate-900/10 rounded-[10px] flex items-center justify-center backdrop-blur-sm">
                            <i class="fa-solid fa-landmark text-lg text-white"></i>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-extrabold tracking-tight text-gradient">PPID ARKAN</span>
                        <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider -mt-1">Keterbukaan Informasi Publik</span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <nav class="hidden lg:flex items-center space-x-1 font-medium text-sm text-slate-700">
                    <!-- Beranda -->
                    <a href="{{ url('/') }}" class="px-3.5 py-2 rounded-lg hover:text-primary-600 hover:bg-blue-50/80 transition {{ request()->is('/') ? 'text-primary-600 font-semibold bg-blue-50/70' : '' }}">
                        Beranda
                    </a>

                    <!-- Profil (Multi-group dropdown) -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg hover:text-primary-600 hover:bg-blue-50/80 transition {{ request()->is('profil*') ? 'text-primary-600 font-semibold bg-blue-50/70' : '' }}">
                            <span>Profil</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 group-hover:rotate-180 text-slate-400"></i>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-1 w-[460px] bg-white rounded-2xl shadow-2xl border border-slate-100 p-4 grid grid-cols-2 gap-4 z-50">
                            <!-- Group: Profil Organisasi -->
                            <div class="space-y-1">
                                <div class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-primary-700 border-b border-primary-100/80 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-sitemap text-primary-500"></i>
                                    Profil Organisasi
                                </div>
                                <a href="{{ url('/profil/visi-misi') }}" class="flex items-center gap-2 px-3 py-2 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i> Visi dan Misi
                                </a>
                                <a href="{{ url('/profil/struktur-organisasi') }}" class="flex items-center gap-2 px-3 py-2 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i> Struktur Organisasi
                                </a>
                                <a href="{{ url('/profil/tugas-fungsi') }}" class="flex items-center gap-2 px-3 py-2 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i> Tugas dan Fungsi
                                </a>
                                <a href="{{ url('/profil/profil-pimpinan') }}" class="flex items-center gap-2 px-3 py-2 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i> Profil Pimpinan
                                </a>
                            </div>

                            <!-- Group: Profil PPID -->
                            <div class="space-y-1 bg-slate-50/70 p-2.5 rounded-xl border border-slate-100">
                                <div class="px-2 py-1 text-xs font-bold uppercase tracking-wider text-accent-600 border-b border-accent-200/60 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-shield-halved text-accent-500"></i>
                                    Profil PPID
                                </div>
                                <a href="{{ url('/profil/gambaran-singkat-ppid') }}" class="flex items-center gap-2 px-2 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-white transition">
                                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i> Gambaran Singkat PPID
                                </a>
                                <a href="{{ url('/profil/dasar-hukum-ppid') }}" class="flex items-center gap-2 px-2 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-white transition">
                                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i> Dasar Hukum PPID
                                </a>
                                <a href="{{ url('/profil/struktur-organisasi-ppid') }}" class="flex items-center gap-2 px-2 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-white transition">
                                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i> Struktur Organisasi PPID
                                </a>
                                <a href="{{ url('/profil/visi-misi-ppid') }}" class="flex items-center gap-2 px-2 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-white transition">
                                    <i class="fa-solid fa-angle-right text-[10px] text-slate-400"></i> Visi dan Misi PPID
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Layanan (Dropdown) -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg hover:text-primary-600 hover:bg-blue-50/80 transition {{ request()->is('layanan*', 'permohonan-informasi*', 'informasi-publik*', 'dokumen*') ? 'text-primary-600 font-semibold bg-blue-50/70' : '' }}">
                            <span>Layanan</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 group-hover:rotate-180 text-slate-400"></i>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-1 w-72 bg-white rounded-2xl shadow-2xl border border-slate-100 p-2 z-50">
                            
                            <a href="{{ url('/permohonan-informasi') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-blue-50 text-slate-700 hover:text-primary-600 transition group/item">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-primary-600 flex items-center justify-center group-hover/item:bg-primary-600 group-hover/item:text-white transition">
                                    <i class="fa-solid fa-file-pen text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-semibold">Formulir Permohonan</div>
                                    <div class="text-[11px] text-slate-400">Permohonan Informasi Publik</div>
                                </div>
                            </a>

                            <a href="{{ url('/dokumen') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-blue-50 text-slate-700 hover:text-primary-600 transition group/item">
                                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center group-hover/item:bg-amber-500 group-hover/item:text-white transition">
                                    <i class="fa-solid fa-folder-open text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-semibold">Daftar Informasi Publik</div>
                                    <div class="text-[11px] text-slate-400">Daftar Informasi & Dokumen</div>
                                </div>
                            </a>

                            <div class="my-1.5 border-t border-slate-100"></div>

                            <!-- Standar Layanan Section -->
                            <div class="px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Standar Layanan</div>
                            <a href="{{ url('/layanan/prosedur-pelayanan') }}" class="flex items-center gap-2 px-3 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-arrow-right text-[10px] text-slate-400"></i> Prosedur Pelayanan
                            </a>
                            <a href="{{ url('/layanan/sop-ppid') }}" class="flex items-center gap-2 px-3 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-arrow-right text-[10px] text-slate-400"></i> SOP PPID
                            </a>
                            <a href="{{ url('/layanan/maklumat-informasi') }}" class="flex items-center gap-2 px-3 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-arrow-right text-[10px] text-slate-400"></i> Maklumat Informasi
                            </a>

                            <div class="my-1.5 border-t border-slate-100"></div>

                            <!-- Kategori Informasi -->
                            <div class="px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Kategori Informasi</div>
                            <a href="{{ url('/dokumen?kategori=berkala') }}" class="flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <span>Informasi Berkala</span>
                                <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-1.5 py-0.5 rounded">Berkala</span>
                            </a>
                            <a href="{{ url('/dokumen?kategori=serta-merta') }}" class="flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <span>Informasi Serta Merta</span>
                                <span class="bg-amber-100 text-amber-700 text-[10px] font-bold px-1.5 py-0.5 rounded">Serta Merta</span>
                            </a>
                            <a href="{{ url('/dokumen?kategori=setiap-saat') }}" class="flex items-center justify-between px-3 py-1.5 text-xs rounded-lg text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <span>Informasi Setiap Saat</span>
                                <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-1.5 py-0.5 rounded">Setiap Saat</span>
                            </a>
                        </div>
                    </div>

                    <!-- Laporan (Dropdown) -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg hover:text-primary-600 hover:bg-blue-50/80 transition {{ request()->is('laporan*') ? 'text-primary-600 font-semibold bg-blue-50/70' : '' }}">
                            <span>Laporan</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 group-hover:rotate-180 text-slate-400"></i>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-1 w-64 bg-white rounded-2xl shadow-2xl border border-slate-100 p-2 z-50">
                            
                            <a href="{{ url('/dokumen?kategori=lkpd') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs rounded-xl text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-file-invoice-dollar text-slate-400"></i>
                                <span>Laporan Keuangan (LKPD)</span>
                            </a>
                            <a href="{{ url('/dokumen?kategori=lppd') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs rounded-xl text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-file-shield text-slate-400"></i>
                                <span>Laporan Penyelenggaraan (LPPD)</span>
                            </a>
                            <a href="{{ url('/dokumen') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs rounded-xl text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-table-list text-slate-400"></i>
                                <span>Daftar Informasi Publik</span>
                            </a>
                            <a href="{{ url('/laporan/statistik-layanan') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs rounded-xl text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-chart-pie text-slate-400"></i>
                                <span>Statistik Layanan</span>
                            </a>
                            <a href="{{ url('/dokumen?kategori=laporan-ppid') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs rounded-xl text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-book text-slate-400"></i>
                                <span>Laporan PPID</span>
                            </a>
                        </div>
                    </div>

                    <!-- Publikasi (Dropdown) -->
                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg hover:text-primary-600 hover:bg-blue-50/80 transition {{ request()->is('berita*', 'galeri*') ? 'text-primary-600 font-semibold bg-blue-50/70' : '' }}">
                            <span>Publikasi</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200 group-hover:rotate-180 text-slate-400"></i>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2"
                             class="absolute left-0 mt-1 w-52 bg-white rounded-2xl shadow-2xl border border-slate-100 p-2 z-50">
                            
                            <a href="{{ url('/galeri') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs rounded-xl text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-images text-slate-400"></i>
                                <span>Galeri Foto & Dokumentasi</span>
                            </a>
                            <a href="{{ url('/berita') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs rounded-xl text-slate-600 hover:text-primary-600 hover:bg-blue-50 transition">
                                <i class="fa-solid fa-newspaper text-slate-400"></i>
                                <span>Berita & Informasi Terkini</span>
                            </a>
                        </div>
                    </div>

                    <!-- Kontak -->
                    <a href="{{ url('/kontak') }}" class="px-3.5 py-2 rounded-lg hover:text-primary-600 hover:bg-blue-50/80 transition {{ request()->is('kontak') ? 'text-primary-600 font-semibold bg-blue-50/70' : '' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Header Actions (Search & CTA) -->
                <div class="hidden lg:flex items-center space-x-3">
                    <a href="{{ url('/cari') }}" class="w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition" title="Pencarian">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </a>
                    <a href="{{ url('/permohonan-informasi') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-700 to-primary-600 hover:from-blue-800 hover:to-primary-700 text-white text-xs font-semibold rounded-xl shadow-md shadow-blue-500/25 transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/40 hover:-translate-y-0.5">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        <span>Permohonan Informasi</span>
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="lg:hidden flex items-center space-x-2">
                    <a href="{{ url('/cari') }}" class="w-9 h-9 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="p-2 rounded-xl text-slate-700 hover:bg-slate-100 focus:outline-none" aria-label="Toggle Menu">
                        <i :class="mobileMenuOpen ? 'fa-solid fa-xmark text-xl' : 'fa-solid fa-bars text-xl'"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Slide-out / Dropdown Menu -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden border-t border-slate-200 bg-white/95 backdrop-blur-xl px-4 pt-3 pb-6 space-y-2 max-h-[85vh] overflow-y-auto">
            
            <a href="{{ url('/') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-blue-50">Beranda</a>

            <!-- Mobile Profil Submenu -->
            <div x-data="{ expanded: false }" class="border-b border-slate-100 pb-2">
                <button @click="expanded = !expanded" class="w-full flex items-center justify-between px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-blue-50 rounded-lg">
                    <span>Profil</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="expanded ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="expanded" class="pl-4 pr-2 pt-1 space-y-1">
                    <div class="text-[11px] font-bold text-primary-700 pt-1 uppercase">Profil Organisasi</div>
                    <a href="{{ url('/profil/visi-misi') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Visi dan Misi</a>
                    <a href="{{ url('/profil/struktur-organisasi') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Struktur Organisasi</a>
                    <a href="{{ url('/profil/tugas-fungsi') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Tugas dan Fungsi</a>
                    <a href="{{ url('/profil/profil-pimpinan') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Profil Pimpinan</a>

                    <div class="text-[11px] font-bold text-accent-600 pt-2 uppercase">Profil PPID</div>
                    <a href="{{ url('/profil/gambaran-singkat-ppid') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Gambaran Singkat PPID</a>
                    <a href="{{ url('/profil/dasar-hukum-ppid') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Dasar Hukum PPID</a>
                    <a href="{{ url('/profil/struktur-organisasi-ppid') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Struktur Organisasi PPID</a>
                    <a href="{{ url('/profil/visi-misi-ppid') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Visi dan Misi PPID</a>
                </div>
            </div>

            <!-- Mobile Layanan Submenu -->
            <div x-data="{ expanded: false }" class="border-b border-slate-100 pb-2">
                <button @click="expanded = !expanded" class="w-full flex items-center justify-between px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-blue-50 rounded-lg">
                    <span>Layanan</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="expanded ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="expanded" class="pl-4 pr-2 pt-1 space-y-1">
                    <a href="{{ url('/permohonan-informasi') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600 font-medium text-blue-700">Formulir Permohonan Informasi</a>
                    <a href="{{ url('/pengajuan-keberatan') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600 font-medium text-amber-700">Form Pengajuan Keberatan</a>
                    <a href="{{ url('/dokumen') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Daftar Informasi Publik</a>
                    <a href="{{ url('/layanan/prosedur-pelayanan') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Prosedur Pelayanan</a>
                    <a href="{{ url('/layanan/sop-ppid') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">SOP PPID</a>
                    <a href="{{ url('/layanan/maklumat-informasi') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Maklumat Informasi</a>
                    <a href="{{ url('/dokumen?kategori=berkala') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Informasi Berkala</a>
                    <a href="{{ url('/dokumen?kategori=serta-merta') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Informasi Serta Merta</a>
                    <a href="{{ url('/dokumen?kategori=setiap-saat') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Informasi Setiap Saat</a>
                </div>
            </div>

            <!-- Mobile Laporan Submenu -->
            <div x-data="{ expanded: false }" class="border-b border-slate-100 pb-2">
                <button @click="expanded = !expanded" class="w-full flex items-center justify-between px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-blue-50 rounded-lg">
                    <span>Laporan</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="expanded ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="expanded" class="pl-4 pr-2 pt-1 space-y-1">
                    <a href="{{ url('/dokumen?kategori=lkpd') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Laporan Keuangan (LKPD)</a>
                    <a href="{{ url('/dokumen?kategori=lppd') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Laporan Penyelenggaraan (LPPD)</a>
                    <a href="{{ url('/dokumen') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Daftar Informasi Publik</a>
                    <a href="{{ url('/laporan/statistik-layanan') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Statistik Layanan</a>
                    <a href="{{ url('/dokumen?kategori=laporan-ppid') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Laporan PPID</a>
                </div>
            </div>

            <!-- Mobile Publikasi Submenu -->
            <div x-data="{ expanded: false }" class="border-b border-slate-100 pb-2">
                <button @click="expanded = !expanded" class="w-full flex items-center justify-between px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-blue-50 rounded-lg">
                    <span>Publikasi</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200" :class="expanded ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="expanded" class="pl-4 pr-2 pt-1 space-y-1">
                    <a href="{{ url('/galeri') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Galeri</a>
                    <a href="{{ url('/berita') }}" class="block px-3 py-1.5 text-xs text-slate-600 hover:text-primary-600">Berita</a>
                </div>
            </div>

            <a href="{{ url('/kontak') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-blue-50">Kontak</a>

            <div class="pt-2">
                <a href="{{ url('/permohonan-informasi') }}" class="w-full py-2.5 px-4 bg-gradient-to-r from-blue-700 to-primary-600 text-white text-center text-xs font-semibold rounded-xl flex items-center justify-center gap-2 shadow-md">
                    <i class="fa-solid fa-file-circle-plus"></i> Permohonan Informasi
                </a>
            </div>
        </div>
    </header>

    <!-- Flash Messages Container -->
    @if(session('success') || session('status') || session('error') || (isset($errors) && $errors->any()))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 w-full">
            @if(session('success') || session('status'))
                <div x-data="{ show: true }" x-show="show" class="flex items-center justify-between p-4 mb-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 shadow-sm">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-lg"></i>
                        <span class="text-sm font-medium">{{ session('success') ?? session('status') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-700"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-show="show" class="flex items-center justify-between p-4 mb-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 shadow-sm">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-rose-500 text-lg"></i>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="text-rose-500 hover:text-rose-700"><i class="fa-solid fa-xmark"></i></button>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div x-data="{ show: true }" x-show="show" class="p-4 mb-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 shadow-sm">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2 font-semibold text-sm">
                            <i class="fa-solid fa-circle-exclamation text-amber-500"></i>
                            <span>Mohon periksa kembali form pengisian:</span>
                        </div>
                        <button @click="show = false" class="text-amber-500 hover:text-amber-700"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 text-amber-800">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-navy-950 via-slate-900 to-blue-950 text-slate-300 pt-16 pb-8 border-t border-blue-900/40 relative overflow-hidden">
        <!-- Background subtle glow -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800">
                
                <!-- Col 1: Logo & Overview -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-accent-400 p-0.5 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                            <div class="w-full h-full bg-slate-950/20 rounded-[10px] flex items-center justify-center">
                                <i class="fa-solid fa-landmark text-base"></i>
                            </div>
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white">PPID ARKAN</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed text-justify">
                        Pejabat Pengelola Informasi dan Dokumentasi (PPID) Arkan berkomitmen memberikan layanan keterbukaan informasi publik yang cepat, tepat, transparan, dan akuntabel sesuai dengan amanat UU No. 14 Tahun 2008.
                    </p>
                    <div class="pt-2 flex items-center space-x-3">
                        <a href="#" class="w-8 h-8 rounded-lg bg-slate-800/80 hover:bg-blue-600 text-slate-300 hover:text-white flex items-center justify-center text-xs transition duration-200">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-slate-800/80 hover:bg-blue-500 text-slate-300 hover:text-white flex items-center justify-center text-xs transition duration-200">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-slate-800/80 hover:bg-pink-600 text-slate-300 hover:text-white flex items-center justify-center text-xs transition duration-200">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-slate-800/80 hover:bg-red-600 text-slate-300 hover:text-white flex items-center justify-center text-xs transition duration-200">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-accent-400 pl-2.5">
                        Tautan Cepat
                    </h3>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li>
                            <a href="{{ url('/') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[10px] text-blue-500"></i> Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil/visi-misi') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[10px] text-blue-500"></i> Visi & Misi Organisasi
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil/dasar-hukum-ppid') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[10px] text-blue-500"></i> Dasar Hukum PPID
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/berita') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[10px] text-blue-500"></i> Berita & Artikel
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/galeri') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[10px] text-blue-500"></i> Galeri Dokumentasi
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/kontak') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-chevron-right text-[10px] text-blue-500"></i> Hubungi Kami
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 3: Layanan Informasi -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-accent-400 pl-2.5">
                        Layanan Informasi
                    </h3>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li>
                            <a href="{{ url('/permohonan-informasi') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-file-signature text-[10px] text-blue-500"></i> Permohonan Informasi Online
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/pengajuan-keberatan') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-triangle-exclamation text-[10px] text-blue-500"></i> Pengajuan Keberatan Informasi
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/dokumen?kategori=berkala') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-calendar-days text-[10px] text-blue-500"></i> Informasi Berkala
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/dokumen?kategori=serta-merta') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-bolt-lightning text-[10px] text-blue-500"></i> Informasi Serta Merta
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/dokumen?kategori=setiap-saat') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-folder-tree text-[10px] text-blue-500"></i> Informasi Setiap Saat
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/layanan/maklumat-informasi') }}" class="hover:text-accent-400 transition flex items-center gap-1.5">
                                <i class="fa-solid fa-scroll text-[10px] text-blue-500"></i> Maklumat Pelayanan PPID
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Contact Info -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-accent-400 pl-2.5">
                        Kontak & Lokasi
                    </h3>
                    <div class="space-y-3 text-xs text-slate-400">
                        <div class="flex items-start gap-2.5">
                            <i class="fa-solid fa-location-dot text-accent-400 mt-1"></i>
                            <span>Kompleks Perkantoran Terpadu Pemerintah Provinsi, Jl. Angsana No. 01, Air Itam, Pangkalpinang, Bangka Belitung 33148</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-phone text-accent-400"></i>
                            <span>(0717) 431234 / 431235</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-envelope text-accent-400"></i>
                            <span>ppid@arkan.babelprov.go.id</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-earth-asia text-accent-400"></i>
                            <span>https://portalppid.babelprov.go.id</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>© 2024 PPID Arkan. Hak Cipta Dilindungi Undang-Undang.</p>
                <div class="flex items-center space-x-6">
                    <a href="{{ url('/layanan/maklumat-informasi') }}" class="hover:text-slate-300 transition">Kebijakan Privasi</a>
                    <span>•</span>
                    <a href="{{ url('/layanan/sop-ppid') }}" class="hover:text-slate-300 transition">SOP Layanan</a>
                    <span>•</span>
                    <a href="{{ url('/kontak') }}" class="hover:text-slate-300 transition">Bantuan & FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <button x-show="scrolled" 
            x-cloak
            @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="fixed bottom-6 right-6 z-40 w-11 h-11 rounded-full bg-blue-600 hover:bg-blue-700 text-white shadow-xl shadow-blue-600/30 flex items-center justify-center transition-all duration-300 hover:scale-110 focus:outline-none" 
            title="Kembali ke atas">
        <i class="fa-solid fa-arrow-up text-sm"></i>
    </button>

    @stack('scripts')
</body>
</html>
