@extends('layouts.app')

@section('title', 'PPID Arkan - Portal Resmi Keterbukaan Informasi Publik')

@push('styles')
<style>
    /* Animated floating particles in Hero */
    .particle {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,0.25) 0%, rgba(255,255,255,0) 70%);
        pointer-events: none;
        animation: floatParticle linear infinite;
    }
    @keyframes floatParticle {
        0% {
            transform: translateY(100%) scale(0.8);
            opacity: 0;
        }
        50% {
            opacity: 0.6;
        }
        100% {
            transform: translateY(-200px) scale(1.2);
            opacity: 0;
        }
    }
    .p-1 { left: 10%; width: 40px; height: 40px; animation-duration: 9s; animation-delay: 0s; }
    .p-2 { left: 25%; width: 60px; height: 60px; animation-duration: 12s; animation-delay: 2s; }
    .p-3 { left: 45%; width: 30px; height: 30px; animation-duration: 8s; animation-delay: 4s; }
    .p-4 { left: 70%; width: 70px; height: 70px; animation-duration: 14s; animation-delay: 1s; }
    .p-5 { left: 85%; width: 50px; height: 50px; animation-duration: 11s; animation-delay: 3s; }

    /* Swiper customized pagination */
    .swiper-pagination-bullet-active {
        background-color: #facc15 !important;
        width: 24px !important;
        border-radius: 9999px !important;
    }
</style>
@endpush

@section('content')

<!-- 1. HERO SECTION -->
<section class="relative bg-gradient-to-br from-blue-950 via-blue-900 to-blue-700 text-white overflow-hidden pt-12 pb-24 lg:pt-20 lg:pb-36">
    <!-- Floating CSS Particles -->
    <div class="particle p-1"></div>
    <div class="particle p-2"></div>
    <div class="particle p-3"></div>
    <div class="particle p-4"></div>
    <div class="particle p-5"></div>

    <!-- Geometric Light Effects -->
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -left-32 w-80 h-80 bg-accent-400/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Column: Welcome & Search -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-xs font-semibold text-accent-300">
                    <span class="w-2 h-2 rounded-full bg-accent-400 animate-ping"></span>
                    Portal Resmi Keterbukaan Informasi Publik
                </div>

                <!-- Main Title with Accent -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight leading-tight">
                    Selamat Datang di Portal Resmi <br class="hidden sm:inline" />
                    <span class="bg-gradient-to-r from-accent-300 via-amber-300 to-yellow-400 bg-clip-text text-transparent">PPID Arkan</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-blue-100 max-w-2xl leading-relaxed font-light">
                    Mewujudkan keterbukaan informasi publik yang transparan, akuntabel, dan terpercaya bagi seluruh masyarakat. Akses informasi publik secara mudah dan cepat.
                </p>

                <!-- Search Bar -->
                <div class="pt-2 max-w-xl mx-auto lg:mx-0">
                    <form action="{{ url('/cari') }}" method="GET" class="relative bg-white/95 backdrop-blur-md rounded-2xl p-2 shadow-2xl flex items-center border border-white/30 focus-within:ring-4 focus-within:ring-accent-400/50 transition">
                        <div class="pl-3 text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-lg"></i>
                        </div>
                        <input type="text" 
                               name="q" 
                               value="{{ request('q') }}"
                               placeholder="Cari dokumen, regulasi, berita, atau informasi publik..." 
                               class="w-full px-3 py-2 text-sm text-slate-800 placeholder-slate-400 bg-transparent border-0 focus:outline-none focus:ring-0">
                        <button type="submit" class="px-5 py-3 bg-gradient-to-r from-blue-700 to-primary-600 hover:from-blue-800 hover:to-primary-700 text-white text-sm font-semibold rounded-xl shadow-md transition flex items-center gap-2 flex-shrink-0">
                            <span>Cari</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </form>
                    <div class="flex items-center gap-2 text-xs text-blue-200 mt-2.5 pl-2 flex-wrap justify-center lg:justify-start">
                        <span class="font-medium text-white/70">Pencarian Populer:</span>
                        <a href="{{ url('/dokumen?kategori=berkala') }}" class="hover:text-accent-300 underline decoration-accent-400/50 underline-offset-2">Laporan Keuangan</a>,
                        <a href="{{ url('/dokumen?kategori=serta-merta') }}" class="hover:text-accent-300 underline decoration-accent-400/50 underline-offset-2">Bencana Alam</a>,
                        <a href="{{ url('/profil/struktur-organisasi') }}" class="hover:text-accent-300 underline decoration-accent-400/50 underline-offset-2">Struktur PPID</a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Two CTA Cards -->
            <div class="lg:col-span-5 space-y-4">
                
                <!-- CTA 1: Form Permohonan Informasi Publik (Glass Card) -->
                <a href="{{ url('/permohonan-informasi') }}" class="group block p-6 rounded-2xl bg-white/10 hover:bg-white/15 backdrop-blur-xl border border-white/20 hover:border-white/40 shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-blue-500/30 border border-blue-400/40 text-blue-200 group-hover:text-white group-hover:bg-blue-600 flex items-center justify-center text-2xl transition duration-300 flex-shrink-0 shadow-inner">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-accent-300 bg-accent-400/10 px-2.5 py-0.5 rounded-full border border-accent-400/20">Layanan Utama</span>
                                <i class="fa-solid fa-arrow-right text-white/50 group-hover:text-white group-hover:translate-x-1 transition duration-200"></i>
                            </div>
                            <h3 class="text-lg font-bold text-white mt-1 group-hover:text-accent-300 transition">Form Permohonan Informasi Publik</h3>
                            <p class="text-xs text-blue-100/80 mt-1 leading-relaxed">
                                Ajukan permohonan informasi publik secara online sesuai dengan hak Anda sebagai warga negara.
                            </p>
                        </div>
                    </div>
                </a>

                <!-- CTA 2: Form Pengajuan Keberatan (Yellow Gradient Card) -->
                <a href="{{ url('/pengajuan-keberatan') }}" class="group block p-6 rounded-2xl bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-slate-900 shadow-2xl shadow-amber-500/30 transition-all duration-300 hover:-translate-y-1 border border-yellow-300/40">
                    <div class="flex items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-900/15 border border-slate-900/10 text-slate-900 group-hover:scale-105 flex items-center justify-center text-2xl transition duration-300 flex-shrink-0">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-slate-900 bg-black/10 px-2.5 py-0.5 rounded-full font-semibold">Tindak Lanjut</span>
                                <i class="fa-solid fa-arrow-right text-slate-800 group-hover:text-slate-950 group-hover:translate-x-1 transition duration-200"></i>
                            </div>
                            <h3 class="text-lg font-extrabold text-slate-900 mt-1">Form Pengajuan Keberatan Informasi</h3>
                            <p class="text-xs text-slate-800/90 mt-1 leading-relaxed">
                                Sampaikan keberatan Anda jika permohonan informasi tidak ditanggapi atau tidak sesuai ketentuan.
                            </p>
                        </div>
                    </div>
                </a>

                <!-- Status Check Small Bar -->
                <div class="pt-1 flex items-center justify-between text-xs text-blue-200/90 bg-blue-950/40 backdrop-blur-md rounded-xl p-3 border border-white/10">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-accent-300"></i>
                        <span>Sudah mengajukan permohonan?</span>
                    </div>
                    <a href="{{ url('/dokumen') }}" class="text-accent-300 hover:text-white font-medium flex items-center gap-1 transition">
                        <span>Cek Status / Arsip</span>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>

    <!-- Wave SVG Divider at bottom of hero -->
    <div class="absolute bottom-0 left-0 right-0 w-full overflow-hidden leading-none z-10 pointer-events-none">
        <svg class="relative block w-full h-10 sm:h-16 text-slate-50" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C150,90 350,-40 500,45 C650,130 900,10 1200,40 L1200,120 L0,120 Z" fill="currentColor"></path>
        </svg>
    </div>
</section>

<!-- 2. STATS CARDS SECTION -->
<section class="relative -mt-10 sm:-mt-14 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Card 1: Informasi Berkala -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl flex flex-col justify-between group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-primary-600 flex items-center justify-center text-xl group-hover:bg-primary-600 group-hover:text-white transition duration-300">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <span class="text-2xl font-black text-slate-800 tracking-tight">
                    {{ $berkalaCount ?? 48 }}
                </span>
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-800 group-hover:text-primary-600 transition">Informasi Berkala</h4>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Informasi yang wajib diperbaharui dan diumumkan secara berkala sekurang-kurangnya 6 bulan sekali.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-primary-600 font-medium">
                <a href="{{ url('/dokumen?kategori=berkala') }}" class="flex items-center gap-1 group-hover:gap-2 transition-all">
                    Lihat Dokumen <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Card 2: Informasi Serta Merta -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl flex flex-col justify-between group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl group-hover:bg-amber-500 group-hover:text-white transition duration-300">
                    <i class="fa-solid fa-bolt-lightning"></i>
                </div>
                <span class="text-2xl font-black text-slate-800 tracking-tight">
                    {{ $sertaMertaCount ?? 19 }}
                </span>
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-800 group-hover:text-amber-600 transition">Informasi Serta Merta</h4>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Informasi penting yang dapat mengancam hajat hidup orang banyak dan ketertiban umum.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-amber-600 font-medium">
                <a href="{{ url('/dokumen?kategori=serta-merta') }}" class="flex items-center gap-1 group-hover:gap-2 transition-all">
                    Lihat Dokumen <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Card 3: Informasi Setiap Saat -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl flex flex-col justify-between group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl group-hover:bg-emerald-600 group-hover:text-white transition duration-300">
                    <i class="fa-solid fa-folder-tree"></i>
                </div>
                <span class="text-2xl font-black text-slate-800 tracking-tight">
                    {{ $setiapSaatCount ?? 115 }}
                </span>
            </div>
            <div>
                <h4 class="text-sm font-bold text-slate-800 group-hover:text-emerald-600 transition">Informasi Setiap Saat</h4>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Informasi yang harus disediakan oleh badan publik dan siap diberikan setiap saat dibutuhkan pemohon.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-emerald-600 font-medium">
                <a href="{{ url('/dokumen?kategori=setiap-saat') }}" class="flex items-center gap-1 group-hover:gap-2 transition-all">
                    Lihat Dokumen <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- Card 4: Total Informasi Publik (Blue Gradient) -->
        <div class="bg-gradient-to-br from-blue-700 via-primary-700 to-navy-900 text-white rounded-2xl p-6 shadow-xl transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl flex flex-col justify-between group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-xl text-accent-300">
                    <i class="fa-solid fa-database"></i>
                </div>
                <span class="text-3xl font-black tracking-tight text-accent-300">
                    {{ $totalCount ?? (($berkalaCount ?? 48) + ($sertaMertaCount ?? 19) + ($setiapSaatCount ?? 115)) }}
                </span>
            </div>
            <div>
                <h4 class="text-sm font-bold text-white">Total Informasi Publik</h4>
                <p class="text-xs text-blue-100 mt-1 leading-relaxed">
                    Total seluruh berkas dan dokumen informasi publik yang tersedia dan terverifikasi secara resmi.
                </p>
            </div>
            <div class="mt-4 pt-3 border-t border-white/20 flex items-center justify-between text-xs text-accent-300 font-medium">
                <a href="{{ url('/dokumen') }}" class="flex items-center gap-1 group-hover:gap-2 transition-all text-white">
                    Jelajahi Semua <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- 3. BANNER / SLIDER SECTION -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-2xl mx-auto mb-8">
        <span class="text-xs font-bold uppercase tracking-wider text-primary-600 bg-blue-50 px-3 py-1 rounded-full">Sorotan Utama</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Informasi & Sosialisasi Terkini</h2>
    </div>

    <!-- Swiper Container -->
    <div class="swiper bannerSwiper rounded-3xl overflow-hidden shadow-2xl relative">
        <div class="swiper-wrapper">
            
            @if(isset($banners) && count($banners) > 0)
                @foreach($banners as $banner)
                    <div class="swiper-slide relative h-72 sm:h-96 md:h-[420px] bg-slate-800">
                        <img src="{{ $banner->image ?? 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?q=80&w=1200&auto=format&fit=crop' }}" 
                             alt="{{ $banner->title ?? 'Banner Slide' }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/60 to-transparent flex items-end p-6 sm:p-10 lg:p-12">
                            <div class="max-w-3xl space-y-2">
                                <span class="bg-blue-600 text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                    {{ $banner->category ?? 'PPID Terkini' }}
                                </span>
                                <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white">
                                    {{ $banner->title ?? 'Peningkatan Kualitas Keterbukaan Informasi Publik' }}
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-200 line-clamp-2 max-w-2xl">
                                    {{ $banner->description ?? 'Mewujudkan tata kelola pemerintahan yang bersih, transparan dan berorientasi pada pelayanan masyarakat.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Default Slider 1 -->
                <div class="swiper-slide relative h-72 sm:h-96 md:h-[420px] bg-slate-800">
                    <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1200&auto=format&fit=crop" 
                         alt="Komitmen Bersama Keterbukaan Informasi" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-950/60 to-transparent flex items-end p-6 sm:p-10 lg:p-12">
                        <div class="max-w-3xl space-y-2">
                            <span class="bg-primary-600 text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                Layanan Terpadu
                            </span>
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white">
                                Komitmen Mewujudkan Tata Kelola Pemerintahan yang Transparan
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-200 line-clamp-2 max-w-2xl">
                                Seluruh badan publik berkewajiban membuka akses atas informasi publik yang berkaitan dengan kebijakan, program, dan anggaran.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Default Slider 2 -->
                <div class="swiper-slide relative h-72 sm:h-96 md:h-[420px] bg-slate-800">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1200&auto=format&fit=crop" 
                         alt="Pelayanan Prima Informasi Publik" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-950/60 to-transparent flex items-end p-6 sm:p-10 lg:p-12">
                        <div class="max-w-3xl space-y-2">
                            <span class="bg-amber-500 text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                Hak Anda Untuk Tahu
                            </span>
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white">
                                Akses Cepat dan Akurat untuk Informasi Publik Anda
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-200 line-clamp-2 max-w-2xl">
                                Manfaatkan layanan pengajuan informasi secara digital dari mana saja tanpa harus datang langsung ke meja layanan.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Default Slider 3 -->
                <div class="swiper-slide relative h-72 sm:h-96 md:h-[420px] bg-slate-800">
                    <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=1200&auto=format&fit=crop" 
                         alt="Akuntabilitas dan Integritas" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950 via-navy-950/60 to-transparent flex items-end p-6 sm:p-10 lg:p-12">
                        <div class="max-w-3xl space-y-2">
                            <span class="bg-emerald-600 text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                Standar Pelayanan
                            </span>
                            <h3 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white">
                                Standar Operasional Prosedur Pelayanan yang Terstandarisasi
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-200 line-clamp-2 max-w-2xl">
                                Pelayanan informasi publik dilayani maksimal dalam waktu 10 hari kerja sesuai regulasi Komisi Informasi.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        <!-- Slider Controls -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev !text-white/80 hover:!text-white !hidden sm:!flex"></div>
        <div class="swiper-button-next !text-white/80 hover:!text-white !hidden sm:!flex"></div>
    </div>
</section>

<!-- 4. QUICK ACCESS / LAYANAN SECTION -->
<section class="py-16 bg-white border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold uppercase tracking-wider text-primary-600 bg-blue-50 px-3 py-1 rounded-full">Menu Layanan</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Akses Cepat Layanan PPID</h2>
            <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-accent-400 mx-auto mt-3 rounded-full"></div>
            <p class="text-slate-500 text-sm mt-3">
                Pilih menu layanan PPID di bawah ini untuk mengakses informasi, formulir permohonan, atau melihat daftar regulasi publik.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Quick 1: Permohonan Informasi -->
            <a href="{{ url('/permohonan-informasi') }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-white border border-slate-200/80 hover:border-blue-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-primary-600 group-hover:bg-primary-600 group-hover:text-white flex items-center justify-center text-xl transition flex-shrink-0 shadow-sm">
                    <i class="fa-solid fa-file-pen"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition">Permohonan Informasi</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Formulir online permohonan informasi publik dengan proses verifikasi resmi dan cepat.
                    </p>
                    <span class="inline-flex items-center gap-1 text-xs text-primary-600 font-semibold mt-3 group-hover:gap-2 transition-all">
                        Isi Formulir <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </span>
                </div>
            </a>

            <!-- Quick 2: Pengajuan Keberatan -->
            <a href="{{ url('/pengajuan-keberatan') }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-white border border-slate-200/80 hover:border-amber-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 group-hover:bg-amber-500 group-hover:text-white flex items-center justify-center text-xl transition flex-shrink-0 shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800 group-hover:text-amber-600 transition">Pengajuan Keberatan</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Sampaikan keberatan atas penolakan atau tanggapan permohonan informasi yang tidak memuaskan.
                    </p>
                    <span class="inline-flex items-center gap-1 text-xs text-amber-600 font-semibold mt-3 group-hover:gap-2 transition-all">
                        Ajukan Keberatan <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </span>
                </div>
            </a>

            <!-- Quick 3: Informasi Berkala -->
            <a href="{{ url('/dokumen?kategori=berkala') }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-white border border-slate-200/80 hover:border-blue-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white flex items-center justify-center text-xl transition flex-shrink-0 shadow-sm">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800 group-hover:text-indigo-600 transition">Informasi Berkala</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Akses laporan berkala, profil pimpinan, rencana kerja, dan laporan akuntabilitas kinerja.
                    </p>
                    <span class="inline-flex items-center gap-1 text-xs text-indigo-600 font-semibold mt-3 group-hover:gap-2 transition-all">
                        Akses Dokumen <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </span>
                </div>
            </a>

            <!-- Quick 4: Informasi Serta Merta -->
            <a href="{{ url('/dokumen?kategori=serta-merta') }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-white border border-slate-200/80 hover:border-rose-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-600 group-hover:bg-rose-600 group-hover:text-white flex items-center justify-center text-xl transition flex-shrink-0 shadow-sm">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800 group-hover:text-rose-600 transition">Informasi Serta Merta</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Pemberitahuan darurat dan informasi krusial demi keselamatan serta kepentingan umum.
                    </p>
                    <span class="inline-flex items-center gap-1 text-xs text-rose-600 font-semibold mt-3 group-hover:gap-2 transition-all">
                        Akses Dokumen <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </span>
                </div>
            </a>

            <!-- Quick 5: Informasi Setiap Saat -->
            <a href="{{ url('/dokumen?kategori=setiap-saat') }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-white border border-slate-200/80 hover:border-emerald-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white flex items-center justify-center text-xl transition flex-shrink-0 shadow-sm">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800 group-hover:text-emerald-600 transition">Informasi Setiap Saat</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Kumpulan regulasi, surat keputusan, perjanjian kerja sama, dan naskah dinas terbuka.
                    </p>
                    <span class="inline-flex items-center gap-1 text-xs text-emerald-600 font-semibold mt-3 group-hover:gap-2 transition-all">
                        Akses Dokumen <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </span>
                </div>
            </a>

            <!-- Quick 6: Cek Status Permohonan -->
            <a href="{{ url('/dokumen') }}" class="group p-6 rounded-2xl bg-slate-50 hover:bg-white border border-slate-200/80 hover:border-cyan-400 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 group-hover:bg-cyan-600 group-hover:text-white flex items-center justify-center text-xl transition flex-shrink-0 shadow-sm">
                    <i class="fa-solid fa-magnifying-glass-chart"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-slate-800 group-hover:text-cyan-600 transition">Cek Status Permohonan</h4>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Lacak progres permohonan informasi Anda secara real-time dengan nomor registrasi.
                    </p>
                    <span class="inline-flex items-center gap-1 text-xs text-cyan-600 font-semibold mt-3 group-hover:gap-2 transition-all">
                        Cek Sekarang <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </span>
                </div>
            </a>

        </div>

    </div>
</section>

<!-- 5. LATEST NEWS SECTION -->
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
        <div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-accent-400"></div>
                <span class="text-xs font-bold uppercase tracking-wider text-primary-600">Berita & Informasi</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">Kabar PPID Terkini</h2>
            <div class="w-20 h-1 bg-primary-600 mt-2 rounded-full"></div>
        </div>
        <a href="{{ url('/berita') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 hover:border-primary-600 text-xs font-semibold text-slate-700 hover:text-primary-600 transition bg-white shadow-sm">
            <span>Lihat Semua Berita</span>
            <i class="fa-solid fa-arrow-right text-[10px]"></i>
        </a>
    </div>

    <!-- Grid of 3 News Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @if(isset($latestPosts) && count($latestPosts) > 0)
            @foreach($latestPosts->take(3) as $post)
                <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                    <div class="relative h-48 overflow-hidden bg-slate-100">
                        <img src="{{ $post->image ?? 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=600&auto=format&fit=crop' }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-3 left-3 bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                            {{ $post->category ?? 'Berita' }}
                        </span>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                <i class="fa-regular fa-calendar"></i>
                                <span>{{ $post->created_at ? $post->created_at->format('d M Y') : date('d M Y') }}</span>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                <a href="{{ url('/berita/' . ($post->slug ?? $post->id)) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->content ?? 'Informasi selengkapnya mengenai berita kegiatan pelayanan keterbukaan informasi publik.'), 110) }}
                            </p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100">
                            <a href="{{ url('/berita/' . ($post->slug ?? $post->id)) }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1.5 group/link">
                                <span>Baca Selengkapnya</span>
                                <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition duration-200"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        @else
            <!-- Default Mock Article 1 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1541872703-74c5e44368f9?q=80&w=600&auto=format&fit=crop" 
                         alt="Rapat Koordinasi PPID" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 left-3 bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                        Sosialisasi
                    </span>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                            <i class="fa-regular fa-calendar"></i>
                            <span>{{ date('d M Y') }}</span>
                        </div>
                        <h3 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                            <a href="{{ url('/berita') }}">Rapat Koordinasi Penguatan Layanan PPID di Lingkungan Pemerintah Daerah</a>
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                            Pemerintah terus memperkuat komitmen keterbukaan informasi melalui peningkatan integrasi sistem aplikasi permohonan digital.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100">
                        <a href="{{ url('/berita') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1.5 group/link">
                            <span>Baca Selengkapnya</span>
                            <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition duration-200"></i>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Default Mock Article 2 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=600&auto=format&fit=crop" 
                         alt="Uji Publik Keterbukaan Informasi" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 left-3 bg-amber-500/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                        Penghargaan
                    </span>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                            <i class="fa-regular fa-calendar"></i>
                            <span>{{ date('d M Y', strtotime('-2 days')) }}</span>
                        </div>
                        <h3 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                            <a href="{{ url('/berita') }}">PPID Arkan Raih Predikat Kategori Informatif dalam Monitoring dan Evaluasi KIP</a>
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                            Capaian predikat informatif merupakan bukti nyata kepatuhan dan kesungguhan dalam melayani hak publik atas akses data.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100">
                        <a href="{{ url('/berita') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1.5 group/link">
                            <span>Baca Selengkapnya</span>
                            <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition duration-200"></i>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Default Mock Article 3 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 flex flex-col transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl group">
                <div class="relative h-48 overflow-hidden bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=600&auto=format&fit=crop" 
                         alt="Sosialisasi Hak Atas Informasi" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <span class="absolute top-3 left-3 bg-emerald-600/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                        Edukasi
                    </span>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                            <i class="fa-regular fa-calendar"></i>
                            <span>{{ date('d M Y', strtotime('-5 days')) }}</span>
                        </div>
                        <h3 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                            <a href="{{ url('/berita') }}">Panduan Praktis Cara Mengajukan Permohonan Informasi Publik bagi Masyarakat</a>
                        </h3>
                        <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                            Ketahui hak-hak Anda serta tata cara prosedur pengajuan permohonan informasi secara cepat dan sesuai regulasi perundang-undangan.
                        </p>
                    </div>
                    <div class="pt-4 mt-4 border-t border-slate-100">
                        <a href="{{ url('/berita') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1.5 group/link">
                            <span>Baca Selengkapnya</span>
                            <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition duration-200"></i>
                        </a>
                    </div>
                </div>
            </article>
        @endif
    </div>
</section>

<!-- Callout Banner Section -->
<section class="mb-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="rounded-3xl bg-gradient-to-r from-blue-900 via-primary-800 to-navy-950 p-8 sm:p-12 text-white relative overflow-hidden shadow-2xl flex flex-col lg:flex-row items-center justify-between gap-8">
        <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-accent-400/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="space-y-3 max-w-2xl text-center lg:text-left relative z-10">
            <span class="text-xs font-bold uppercase tracking-wider text-accent-300 bg-white/10 px-3 py-1 rounded-full">Maklumat Pelayanan</span>
            <h3 class="text-2xl sm:text-3xl font-extrabold text-white">Memerlukan Bantuan Informasi Publik?</h3>
            <p class="text-sm text-blue-100 leading-relaxed font-light">
                Petugas layanan PPID kami siap membantu Anda dalam mendapatkan informasi publik yang Anda butuhkan dengan cepat, akurat, dan transparan.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3 relative z-10 w-full sm:w-auto">
            <a href="{{ url('/permohonan-informasi') }}" class="px-6 py-3.5 bg-accent-400 hover:bg-accent-300 text-slate-900 font-bold text-xs rounded-xl shadow-lg shadow-accent-400/30 transition text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-file-pen"></i> Buat Permohonan
            </a>
            <a href="{{ url('/kontak') }}" class="px-6 py-3.5 bg-white/10 hover:bg-white/20 text-white font-semibold text-xs rounded-xl backdrop-blur-md border border-white/20 transition text-center flex items-center justify-center gap-2">
                <i class="fa-solid fa-headset"></i> Hubungi Helpdesk
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Swiper for Banners
        const swiper = new Swiper('.bannerSwiper', {
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 800,
        });
    });
</script>
@endpush
