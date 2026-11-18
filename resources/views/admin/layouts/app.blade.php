<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - PPID ARKAN</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons 6 CDN -->
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
                            800: '#0f172a',
                            900: '#0b1120',
                            950: '#060a14',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.6);
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(59, 130, 246, 0.3);
            border-radius: 9999px;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(59, 130, 246, 0.6);
        }
    </style>
    @stack('styles')
</head>
<body class="h-full font-sans antialiased text-slate-800 bg-slate-50 selection:bg-blue-600 selection:text-white"
      x-data="{ sidebarOpen: true, mobileSidebarOpen: false, profileDropdown: false }">

    <div class="min-h-full flex flex-row">

        <!-- Mobile Sidebar Backdrop -->
        <div x-show="mobileSidebarOpen" 
             x-cloak
             @click="mobileSidebarOpen = false" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-slate-950/70 backdrop-blur-sm lg:hidden">
        </div>

        <!-- Sidebar (Desktop & Mobile) -->
        <aside :class="{
                   'translate-x-0': mobileSidebarOpen, 
                   '-translate-x-full': !mobileSidebarOpen,
                   'lg:w-64': sidebarOpen,
                   'lg:w-20': !sidebarOpen
               }"
               class="fixed inset-y-0 left-0 z-50 flex flex-col transition-all duration-300 ease-in-out bg-navy-900 border-r border-slate-800/80 shadow-2xl lg:static lg:translate-x-0 shrink-0">
            
            <!-- Brand Logo & Header -->
            <div class="h-16 flex items-center justify-between px-4 border-b border-slate-800/80 bg-navy-950/50">
                <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin/dashboard') }}" class="flex items-center gap-3 overflow-hidden group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 p-0.5 shadow-lg shadow-blue-500/25 flex items-center justify-center text-white shrink-0 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-landmark text-lg"></i>
                    </div>
                    <div class="flex flex-col whitespace-nowrap transition-opacity duration-200" 
                         :class="sidebarOpen ? 'opacity-100' : 'lg:opacity-0 lg:w-0 lg:overflow-hidden'">
                        <span class="text-base font-extrabold tracking-tight text-white">PPID ARKAN</span>
                        <span class="text-[10px] font-semibold text-blue-400 tracking-wider uppercase -mt-0.5">Admin Panel</span>
                    </div>
                </a>

                <!-- Mobile close button -->
                <button @click="mobileSidebarOpen = false" class="text-slate-400 hover:text-white p-1 rounded-lg lg:hidden">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto px-3 py-4 space-y-6 sidebar-scroll">

                <!-- Main Menu -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold tracking-wider uppercase text-slate-400"
                         :class="sidebarOpen ? 'block' : 'lg:hidden'">
                        DASHBOARD
                    </div>
                    <nav class="space-y-1">
                        <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin/dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Dashboard">
                            <i class="fa-solid fa-gauge-high text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Dashboard</span>
                        </a>
                    </nav>
                </div>

                <!-- Manajemen Konten -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold tracking-wider uppercase text-slate-400"
                         :class="sidebarOpen ? 'block' : 'lg:hidden'">
                        MANAJEMEN KONTEN
                    </div>
                    <nav class="space-y-1">
                        <!-- Berita / Post -->
                        <a href="{{ Route::has('admin.posts.index') ? route('admin.posts.index') : url('/admin/posts') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.posts.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Berita / Post">
                            <i class="fa-solid fa-newspaper text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.posts.*') ? 'text-white' : 'text-sky-400 group-hover:text-sky-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Berita / Post</span>
                        </a>

                        <!-- Dokumen Publik (DIP) -->
                        <a href="{{ Route::has('admin.documents.index') ? route('admin.documents.index') : url('/admin/documents') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.documents.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Dokumen Publik (DIP)">
                            <i class="fa-solid fa-folder-tree text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.documents.*') ? 'text-white' : 'text-emerald-400 group-hover:text-emerald-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Dokumen Publik (DIP)</span>
                        </a>

                        <!-- Halaman Statis -->
                        <a href="{{ Route::has('admin.pages.index') ? route('admin.pages.index') : url('/admin/pages') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.pages.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Halaman Statis">
                            <i class="fa-solid fa-file-lines text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.pages.*') ? 'text-white' : 'text-indigo-400 group-hover:text-indigo-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Halaman Statis</span>
                        </a>

                        <!-- Banner Slider -->
                        <a href="{{ Route::has('admin.banners.index') ? route('admin.banners.index') : url('/admin/banners') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.banners.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Banner Slider">
                            <i class="fa-solid fa-images text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.banners.*') ? 'text-white' : 'text-amber-400 group-hover:text-amber-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Banner Slider</span>
                        </a>

                        <!-- Galeri Foto -->
                        <a href="{{ Route::has('admin.galleries.index') ? route('admin.galleries.index') : url('/admin/galleries') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.galleries.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Galeri Foto">
                            <i class="fa-solid fa-camera-retro text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.galleries.*') ? 'text-white' : 'text-pink-400 group-hover:text-pink-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Galeri Foto</span>
                        </a>
                    </nav>
                </div>

                <!-- Layanan PPID -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold tracking-wider uppercase text-slate-400"
                         :class="sidebarOpen ? 'block' : 'lg:hidden'">
                        LAYANAN PPID
                    </div>
                    <nav class="space-y-1">
                        <!-- Permohonan Informasi -->
                        <a href="{{ Route::has('admin.information-requests.index') ? route('admin.information-requests.index') : url('/admin/information-requests') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.information-requests.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Permohonan Informasi">
                            <i class="fa-solid fa-file-signature text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.information-requests.*') ? 'text-white' : 'text-blue-400 group-hover:text-blue-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Permohonan Informasi</span>
                        </a>

                        <!-- Pengajuan Keberatan -->
                        <a href="{{ Route::has('admin.objections.index') ? route('admin.objections.index') : url('/admin/objections') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.objections.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Pengajuan Keberatan">
                            <i class="fa-solid fa-scale-balanced text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.objections.*') ? 'text-white' : 'text-rose-400 group-hover:text-rose-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Pengajuan Keberatan</span>
                        </a>
                    </nav>
                </div>

                <!-- Interaksi -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold tracking-wider uppercase text-slate-400"
                         :class="sidebarOpen ? 'block' : 'lg:hidden'">
                        INTERAKSI
                    </div>
                    <nav class="space-y-1">
                        <!-- Pesan Kontak -->
                        <a href="{{ Route::has('admin.contacts.index') ? route('admin.contacts.index') : url('/admin/contacts') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.contacts.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Pesan Kontak">
                            <i class="fa-solid fa-envelope-open-text text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.contacts.*') ? 'text-white' : 'text-teal-400 group-hover:text-teal-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Pesan Kontak</span>
                        </a>
                    </nav>
                </div>

                <!-- Pengaturan -->
                <div>
                    <div class="px-3 mb-2 text-[10px] font-bold tracking-wider uppercase text-slate-400"
                         :class="sidebarOpen ? 'block' : 'lg:hidden'">
                        PENGATURAN
                    </div>
                    <nav class="space-y-1">
                        <!-- Pengaturan Web -->
                        <a href="{{ Route::has('admin.settings.index') ? route('admin.settings.index') : url('/admin/settings') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Pengaturan Web">
                            <i class="fa-solid fa-sliders text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-purple-400 group-hover:text-purple-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Pengaturan Web</span>
                        </a>

                        <!-- Profil Saya -->
                        <a href="{{ Route::has('admin.profile.edit') ? route('admin.profile.edit') : url('/admin/profile') }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group {{ request()->routeIs('admin.profile.*') ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md shadow-blue-500/25 font-semibold' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' }}"
                           title="Profil Saya">
                            <i class="fa-solid fa-user-gear text-base w-5 text-center shrink-0 {{ request()->routeIs('admin.profile.*') ? 'text-white' : 'text-yellow-400 group-hover:text-yellow-300' }}"></i>
                            <span class="whitespace-nowrap transition-opacity duration-200" :class="sidebarOpen ? 'opacity-100' : 'lg:hidden'">Profil Saya</span>
                        </a>
                    </nav>
                </div>

            </div>

            <!-- Sidebar User Mini Card -->
            <div class="p-3 border-t border-slate-800/80 bg-navy-950/40">
                <div class="flex items-center gap-3 p-2 rounded-xl bg-slate-800/50">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow">
                        {{ strtoupper(substr(Auth::user()->name ?? 'Admin', 0, 1)) }}
                    </div>
                    <div class="flex flex-col min-w-0" :class="sidebarOpen ? 'block' : 'lg:hidden'">
                        <span class="text-xs font-semibold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        <span class="text-[10px] text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@ppidarkan.go.id' }}</span>
                    </div>
                </div>
            </div>

        </aside>

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- Top Header Bar -->
            <header class="h-16 bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm flex items-center justify-between px-4 sm:px-6 lg:px-8">
                <!-- Left: Toggle Buttons & Page Title -->
                <div class="flex items-center gap-3">
                    <!-- Mobile Hamburger -->
                    <button @click="mobileSidebarOpen = !mobileSidebarOpen" 
                            type="button" 
                            class="p-2 rounded-xl text-slate-600 hover:text-blue-600 hover:bg-slate-100 lg:hidden">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>

                    <!-- Desktop Collapse Toggle -->
                    <button @click="sidebarOpen = !sidebarOpen" 
                            type="button" 
                            class="hidden lg:flex p-2 rounded-xl text-slate-500 hover:text-blue-600 hover:bg-slate-100 transition">
                        <i class="fa-solid fa-bars-staggered text-base"></i>
                    </button>

                    <div class="hidden sm:flex items-center gap-2 text-xs text-slate-400">
                        <span>Panel Admin</span>
                        <span>/</span>
                        <span class="font-medium text-slate-700">@yield('page_title', 'PPID Arkan')</span>
                    </div>
                </div>

                <!-- Right: Action Buttons & User Menu -->
                <div class="flex items-center gap-3 sm:gap-4">
                    
                    <!-- Link Lihat Website -->
                    <a href="{{ url('/') }}" target="_blank"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 border border-slate-200/80 transition shadow-sm">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                        <span class="hidden sm:inline">Lihat Website</span>
                    </a>

                    <div class="h-6 w-px bg-slate-200"></div>

                    <!-- User Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" 
                                type="button" 
                                class="flex items-center gap-2.5 p-1 rounded-full hover:bg-slate-100 transition focus:outline-none">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold text-xs flex items-center justify-center shadow-md shadow-blue-500/20">
                                {{ strtoupper(substr(Auth::user()->name ?? 'Admin', 0, 1)) }}
                            </div>
                            <div class="hidden md:flex flex-col text-left">
                                <span class="text-xs font-semibold text-slate-800 leading-tight">{{ Auth::user()->name ?? 'Administrator' }}</span>
                                <span class="text-[10px] text-slate-400">Admin Utama</span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                             class="absolute right-0 mt-2 w-56 rounded-2xl bg-white shadow-xl border border-slate-100 py-1.5 z-50">
                            
                            <div class="px-4 py-2 border-b border-slate-100">
                                <p class="text-xs font-semibold text-slate-800">{{ Auth::user()->name ?? 'Administrator' }}</p>
                                <p class="text-[11px] text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@ppidarkan.go.id' }}</p>
                            </div>

                            <a href="{{ Route::has('admin.profile.edit') ? route('admin.profile.edit') : url('/admin/profile') }}" 
                               class="flex items-center gap-2.5 px-4 py-2 text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fa-solid fa-user-gear text-slate-400 w-4 text-center"></i>
                                <span>Profil Saya</span>
                            </a>

                            <a href="{{ Route::has('admin.settings.index') ? route('admin.settings.index') : url('/admin/settings') }}" 
                               class="flex items-center gap-2.5 px-4 py-2 text-xs text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <i class="fa-solid fa-sliders text-slate-400 w-4 text-center"></i>
                                <span>Pengaturan Web</span>
                            </a>

                            <div class="my-1 border-t border-slate-100"></div>

                            <!-- Logout Form -->
                            <form action="{{ Route::has('admin.logout') ? route('admin.logout') : url('/admin/logout') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="w-full text-left flex items-center gap-2.5 px-4 py-2 text-xs text-rose-600 hover:bg-rose-50 transition">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-rose-500 w-4 text-center"></i>
                                    <span>Keluar (Logout)</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">

                <!-- Flash Alerts Container -->
                @if(session('success') || session('status'))
                    <div x-data="{ show: true }" x-show="show" 
                         class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="text-sm font-medium">
                                {{ session('success') ?? session('status') }}
                            </div>
                        </div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 p-1">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" 
                         class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <div class="text-sm font-medium">
                                {{ session('error') }}
                            </div>
                        </div>
                        <button @click="show = false" class="text-rose-500 hover:text-rose-700 p-1">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endif

                @if(session('warning'))
                    <div x-data="{ show: true }" x-show="show" 
                         class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-circle-exclamation"></i>
                            </div>
                            <div class="text-sm font-medium">
                                {{ session('warning') }}
                            </div>
                        </div>
                        <button @click="show = false" class="text-amber-500 hover:text-amber-700 p-1">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                @endif

                <!-- Validation Errors Alert -->
                @if(isset($errors) && $errors->any())
                    <div x-data="{ show: true }" x-show="show" 
                         class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2.5 font-semibold text-sm text-rose-800">
                                <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                                <span>Terdapat beberapa kesalahan input data:</span>
                            </div>
                            <button @click="show = false" class="text-rose-400 hover:text-rose-700 p-1">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                        <ul class="list-disc list-inside text-xs space-y-1 text-rose-700 pl-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Content Yield -->
                @yield('content')

                <!-- Admin Footer -->
                <footer class="mt-12 pt-6 border-t border-slate-200/80 text-center sm:flex sm:items-center sm:justify-between text-xs text-slate-400">
                    <p>&copy; {{ date('Y') }} PPID Arkan - Hak Cipta Dilindungi.</p>
                    <p class="mt-2 sm:mt-0 font-medium text-slate-500">Portal Layanan Keterbukaan Informasi Publik</p>
                </footer>

            </main>
        </div>

    </div>

    @stack('scripts')
</body>
</html>
