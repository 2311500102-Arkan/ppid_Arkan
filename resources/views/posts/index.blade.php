@extends('layouts.app')

@section('title', 'Berita & Informasi Publik - PPID Arkan')

@section('content')

<!-- Header Banner -->
<section class="bg-gradient-to-r from-navy-950 via-blue-900 to-blue-800 text-white py-12 relative overflow-hidden">
    <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-blue-200 mb-3" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white transition flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            <span>/</span>
            <span class="text-accent-300 font-medium">Berita & Publikasi</span>
        </nav>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
            Kabar & Informasi Publik Terkini
        </h1>
        <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-2xl">
            Informasi resmi seputar kegiatan, siaran pers, dan sosialisasi keterbukaan informasi publik PPID Arkan.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Main News Grid (Col 8) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Search Result or Active Filter Notice -->
                @if(request('q') || request('kategori'))
                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-2xl border border-blue-200 text-xs text-slate-700">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-filter text-primary-600"></i>
                            <span>
                                Menampilkan hasil untuk: 
                                <strong class="text-primary-700">"{{ request('q') ?? request('kategori') }}"</strong>
                            </span>
                        </div>
                        <a href="{{ url('/berita') }}" class="text-primary-600 hover:text-primary-800 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-xmark text-xs"></i> Reset Filter
                        </a>
                    </div>
                @endif

                <!-- Posts List -->
                @if(isset($posts) && count($posts) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($posts as $post)
                            <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl group">
                                <div class="relative h-48 overflow-hidden bg-slate-100">
                                    <img src="{{ $post->image ?? 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=600&auto=format&fit=crop' }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <span class="absolute top-3 left-3 bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                        {{ $post->category ?? 'Berita' }}
                                    </span>
                                </div>
                                <div class="p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                            <i class="fa-regular fa-calendar"></i>
                                            <span>{{ $post->created_at ? (is_string($post->created_at) ? $post->created_at : $post->created_at->format('d M Y')) : date('d M Y') }}</span>
                                        </div>
                                        <h3 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                            <a href="{{ url('/berita/' . ($post->slug ?? $post->id)) }}">{{ $post->title }}</a>
                                        </h3>
                                        <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                                            {{ $post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 120) }}
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
                    </div>

                    <!-- Pagination -->
                    <div class="pt-6">
                        @if(method_exists($posts, 'links'))
                            {{ $posts->links() }}
                        @else
                            <!-- Fallback standard pagination -->
                            <div class="flex items-center justify-center space-x-2 text-xs">
                                <span class="px-3.5 py-2 rounded-xl bg-primary-600 text-white font-bold">1</span>
                                <a href="#" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 transition">2</a>
                                <a href="#" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 transition">3</a>
                                <span class="text-slate-400">...</span>
                                <a href="#" class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 transition">Berikutnya</a>
                            </div>
                        @endif
                    </div>

                @else
                    <!-- Fallback Sample Posts Grid if database is empty -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        
                        <!-- Post 1 -->
                        <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl group">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1541872703-74c5e44368f9?q=80&w=600&auto=format&fit=crop" 
                                     alt="Rapat Kerja PPID" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 left-3 bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                    Kegiatan
                                </span>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>{{ date('d M Y') }}</span>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                        <a href="{{ url('/berita/rapat-koordinasi-penguatan-layanan') }}">Rapat Koordinasi Penguatan Layanan Keterbukaan Informasi Publik PPID Arkan</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                                        Pemerintah terus memperkuat komitmen keterbukaan informasi publik guna meningkatkan partisipasi masyarakat dalam pengawasan pembangunan.
                                    </p>
                                </div>
                                <div class="pt-4 mt-4 border-t border-slate-100">
                                    <a href="{{ url('/berita/rapat-koordinasi-penguatan-layanan') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1.5 group/link">
                                        <span>Baca Selengkapnya</span>
                                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition duration-200"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Post 2 -->
                        <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl group">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=600&auto=format&fit=crop" 
                                     alt="Anugerah KIP" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 left-3 bg-amber-500/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                    Penghargaan
                                </span>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>{{ date('d M Y', strtotime('-3 days')) }}</span>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                        <a href="{{ url('/berita/anugerah-kip-kategori-informatif') }}">PPID Arkan Raih Predikat Informatif dalam Evaluasi Tahunan Komisi Informasi</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                                        Predikat informatif merupakan kategori tertinggi dalam penilaian keterbukaan informasi publik tingkat badan pemerintah.
                                    </p>
                                </div>
                                <div class="pt-4 mt-4 border-t border-slate-100">
                                    <a href="{{ url('/berita/anugerah-kip-kategori-informatif') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1.5 group/link">
                                        <span>Baca Selengkapnya</span>
                                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition duration-200"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Post 3 -->
                        <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl group">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=600&auto=format&fit=crop" 
                                     alt="Sosialisasi Hak Warga" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 left-3 bg-emerald-600/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                    Edukasi
                                </span>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>{{ date('d M Y', strtotime('-5 days')) }}</span>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                        <a href="{{ url('/berita/panduan-permohonan-informasi') }}">Sosialisasi Prosedur Permohonan Informasi Publik bagi Lembaga Swadaya Masyarakat</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                                        Mengenal klasifikasi dokumen terbuka, cara mengajukan sengketa informasi, dan batasan informasi yang dikecualikan.
                                    </p>
                                </div>
                                <div class="pt-4 mt-4 border-t border-slate-100">
                                    <a href="{{ url('/berita/panduan-permohonan-informasi') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1.5 group/link">
                                        <span>Baca Selengkapnya</span>
                                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition duration-200"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                        <!-- Post 4 -->
                        <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 flex flex-col transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl group">
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?q=80&w=600&auto=format&fit=crop" 
                                     alt="Pemanfaatan Portal Digital" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute top-3 left-3 bg-indigo-600/90 backdrop-blur-md text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                    Teknologi
                                </span>
                            </div>
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>{{ date('d M Y', strtotime('-8 days')) }}</span>
                                    </div>
                                    <h3 class="text-base font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                        <a href="{{ url('/berita/peluncuran-portal-baru') }}">Peluncuran Portal Digital Baru PPID Arkan dengan Desain Modern dan Responsif</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-2 line-clamp-3 leading-relaxed">
                                        Masyarakat kini semakin mudah mengakses dokumen dan permohonan melalui tampilan antarmuka yang ramah pengguna.
                                    </p>
                                </div>
                                <div class="pt-4 mt-4 border-t border-slate-100">
                                    <a href="{{ url('/berita/peluncuran-portal-baru') }}" class="text-xs font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1.5 group/link">
                                        <span>Baca Selengkapnya</span>
                                        <i class="fa-solid fa-arrow-right text-[10px] group-hover/link:translate-x-1 transition duration-200"></i>
                                    </a>
                                </div>
                            </div>
                        </article>

                    </div>

                    <!-- Static demo pagination -->
                    <div class="pt-8 flex items-center justify-center space-x-2 text-xs">
                        <span class="w-9 h-9 rounded-xl bg-primary-600 text-white font-bold flex items-center justify-center shadow-md shadow-blue-500/20">1</span>
                        <a href="#" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 flex items-center justify-center transition">2</a>
                        <a href="#" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-100 flex items-center justify-center transition">3</a>
                    </div>
                @endif

            </div>

            <!-- News Sidebar (Col 4) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Search Box -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-primary-600"></i> Cari Berita
                    </h3>
                    <form action="{{ url('/berita') }}" method="GET" class="relative">
                        <input type="text" 
                               name="q" 
                               value="{{ request('q') }}" 
                               placeholder="Kata kunci berita..." 
                               class="w-full pl-4 pr-10 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-primary-500 focus:bg-white transition">
                        <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary-600">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </button>
                    </form>
                </div>

                <!-- Categories List -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-tags text-primary-600"></i> Kategori Berita
                    </h3>
                    <ul class="space-y-2 text-xs">
                        <li>
                            <a href="{{ url('/berita') }}" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-blue-50 text-slate-600 hover:text-primary-600 transition {{ !request('kategori') ? 'bg-blue-50 text-primary-600 font-bold' : '' }}">
                                <span>Semua Kategori</span>
                                <span class="bg-slate-100 px-2 py-0.5 rounded-full text-[10px]">Semua</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/berita?kategori=kegiatan') }}" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-blue-50 text-slate-600 hover:text-primary-600 transition {{ request('kategori') == 'kegiatan' ? 'bg-blue-50 text-primary-600 font-bold' : '' }}">
                                <span>Kegiatan PPID</span>
                                <span class="bg-slate-100 px-2 py-0.5 rounded-full text-[10px]">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/berita?kategori=sosialisasi') }}" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-blue-50 text-slate-600 hover:text-primary-600 transition {{ request('kategori') == 'sosialisasi' ? 'bg-blue-50 text-primary-600 font-bold' : '' }}">
                                <span>Sosialisasi & Edukasi</span>
                                <span class="bg-slate-100 px-2 py-0.5 rounded-full text-[10px]">8</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/berita?kategori=penghargaan') }}" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-blue-50 text-slate-600 hover:text-primary-600 transition {{ request('kategori') == 'penghargaan' ? 'bg-blue-50 text-primary-600 font-bold' : '' }}">
                                <span>Prestasi & Penghargaan</span>
                                <span class="bg-slate-100 px-2 py-0.5 rounded-full text-[10px]">5</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/berita?kategori=siaran-pers') }}" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-blue-50 text-slate-600 hover:text-primary-600 transition {{ request('kategori') == 'siaran-pers' ? 'bg-blue-50 text-primary-600 font-bold' : '' }}">
                                <span>Siaran Pers Resmi</span>
                                <span class="bg-slate-100 px-2 py-0.5 rounded-full text-[10px]">14</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Recent / Populer Widget -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-fire text-amber-500"></i> Berita Populer
                    </h3>
                    <div class="space-y-4">
                        <a href="{{ url('/berita') }}" class="flex gap-3 group">
                            <span class="text-2xl font-black text-slate-300 group-hover:text-primary-600 transition leading-none">01</span>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                    PPID Arkan Raih Predikat Kategori Informatif Tahun 2024
                                </h4>
                                <span class="text-[10px] text-slate-400 mt-1 block">3 hari lalu</span>
                            </div>
                        </a>
                        <a href="{{ url('/berita') }}" class="flex gap-3 group">
                            <span class="text-2xl font-black text-slate-300 group-hover:text-primary-600 transition leading-none">02</span>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                    Panduan Praktis Pengajuan Permohonan Informasi Secara Daring
                                </h4>
                                <span class="text-[10px] text-slate-400 mt-1 block">5 hari lalu</span>
                            </div>
                        </a>
                        <a href="{{ url('/berita') }}" class="flex gap-3 group">
                            <span class="text-2xl font-black text-slate-300 group-hover:text-primary-600 transition leading-none">03</span>
                            <div>
                                <h4 class="text-xs font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                    Rapat Kerja Peningkatan Kualitas Meja Layanan Informasi Publik
                                </h4>
                                <span class="text-[10px] text-slate-400 mt-1 block">1 minggu lalu</span>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
