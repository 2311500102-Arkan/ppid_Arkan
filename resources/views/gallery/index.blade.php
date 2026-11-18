@extends('layouts.app')

@section('title', 'Galeri Dokumentasi & Foto - PPID Arkan')

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
            <span class="text-accent-300 font-medium">Galeri Publikasi</span>
        </nav>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
            Galeri Dokumentasi Kegiatan
        </h1>
        <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-2xl">
            Dokumentasi visual rangkaian kegiatan, sosialisasi, dan pelayanan keterbukaan informasi publik PPID Arkan.
        </p>
    </div>
</section>

<!-- Gallery Section with Alpine.js Lightbox Modal -->
<section class="py-12 bg-slate-50 min-h-[600px]" x-data="{ 
    modalOpen: false, 
    activeImage: '', 
    activeTitle: '', 
    activeDate: '', 
    activeCategory: '',
    activeFilter: 'all',
    openLightbox(img, title, date, cat) {
        this.activeImage = img;
        this.activeTitle = title;
        this.activeDate = date;
        this.activeCategory = cat;
        this.modalOpen = true;
    }
}">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center justify-center gap-2 mb-10">
            <button @click="activeFilter = 'all'" 
                    :class="activeFilter === 'all' ? 'bg-primary-600 text-white shadow-md shadow-blue-500/25' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                    class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                Semua Dokumentasi
            </button>
            <button @click="activeFilter = 'kegiatan'" 
                    :class="activeFilter === 'kegiatan' ? 'bg-primary-600 text-white shadow-md shadow-blue-500/25' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                    class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                Kegiatan & Rapat
            </button>
            <button @click="activeFilter = 'sosialisasi'" 
                    :class="activeFilter === 'sosialisasi' ? 'bg-primary-600 text-white shadow-md shadow-blue-500/25' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                    class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                Sosialisasi KIP
            </button>
            <button @click="activeFilter = 'pelayanan'" 
                    :class="activeFilter === 'pelayanan' ? 'bg-primary-600 text-white shadow-md shadow-blue-500/25' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                    class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                Pelayanan Informasi
            </button>
            <button @click="activeFilter = 'infografis'" 
                    :class="activeFilter === 'infografis' ? 'bg-primary-600 text-white shadow-md shadow-blue-500/25' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                    class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                Infografis
            </button>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            
            @if(isset($galleries) && count($galleries) > 0)
                @foreach($galleries as $item)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                         x-show="activeFilter === 'all' || activeFilter === '{{ $item->category ?? 'kegiatan' }}'"
                         x-transition
                         @click="openLightbox('{{ $item->image }}', '{{ addslashes($item->title) }}', '{{ $item->created_at ? $item->created_at->format('d M Y') : date('d M Y') }}', '{{ $item->category ?? 'Kegiatan' }}')">
                        <div class="relative h-56 overflow-hidden bg-slate-100">
                            <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="w-10 h-10 rounded-full bg-white/90 text-primary-600 flex items-center justify-center shadow-lg">
                                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                                </span>
                            </div>
                            <span class="absolute top-2.5 left-2.5 bg-blue-600/90 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                                {{ $item->category ?? 'Dokumentasi' }}
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-primary-600 transition">
                                {{ $item->title }}
                            </h4>
                            <span class="text-[11px] text-slate-400 mt-2 block flex items-center gap-1">
                                <i class="fa-regular fa-calendar"></i>
                                {{ $item->created_at ? $item->created_at->format('d M Y') : date('d M Y') }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Mock Sample Gallery Items -->
                
                <!-- Item 1 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                     x-show="activeFilter === 'all' || activeFilter === 'kegiatan'"
                     x-transition
                     @click="openLightbox('https://images.unsplash.com/photo-1541872703-74c5e44368f9?q=80&w=1200&auto=format&fit=crop', 'Rapat Koordinasi Evaluasi PPID se-Provinsi', '{{ date('d M Y') }}', 'Kegiatan & Rapat')">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1541872703-74c5e44368f9?q=80&w=600&auto=format&fit=crop" alt="Rapat Koordinasi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/90 text-primary-600 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </span>
                        </div>
                        <span class="absolute top-2.5 left-2.5 bg-blue-600/90 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                            Kegiatan
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-primary-600 transition">
                            Rapat Koordinasi Evaluasi PPID se-Provinsi
                        </h4>
                        <span class="text-[11px] text-slate-400 mt-2 block flex items-center gap-1">
                            <i class="fa-regular fa-calendar"></i> {{ date('d M Y') }}
                        </span>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                     x-show="activeFilter === 'all' || activeFilter === 'sosialisasi'"
                     x-transition
                     @click="openLightbox('https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1200&auto=format&fit=crop', 'Sosialisasi Keterbukaan Informasi Publik bagi Pelajar dan Mahasiswa', '{{ date('d M Y', strtotime('-2 days')) }}', 'Sosialisasi KIP')">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=600&auto=format&fit=crop" alt="Sosialisasi KIP" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/90 text-primary-600 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </span>
                        </div>
                        <span class="absolute top-2.5 left-2.5 bg-amber-500/90 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                            Sosialisasi
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-primary-600 transition">
                            Sosialisasi Keterbukaan Informasi Publik bagi Pelajar dan Mahasiswa
                        </h4>
                        <span class="text-[11px] text-slate-400 mt-2 block flex items-center gap-1">
                            <i class="fa-regular fa-calendar"></i> {{ date('d M Y', strtotime('-2 days')) }}
                        </span>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                     x-show="activeFilter === 'all' || activeFilter === 'pelayanan'"
                     x-transition
                     @click="openLightbox('https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=1200&auto=format&fit=crop', 'Pelayanan Pemohon Informasi Langsung di Meja Layanan PPID', '{{ date('d M Y', strtotime('-4 days')) }}', 'Pelayanan Informasi')">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=600&auto=format&fit=crop" alt="Meja Layanan PPID" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/90 text-primary-600 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </span>
                        </div>
                        <span class="absolute top-2.5 left-2.5 bg-emerald-600/90 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                            Pelayanan
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-primary-600 transition">
                            Pelayanan Pemohon Informasi Langsung di Meja Layanan PPID
                        </h4>
                        <span class="text-[11px] text-slate-400 mt-2 block flex items-center gap-1">
                            <i class="fa-regular fa-calendar"></i> {{ date('d M Y', strtotime('-4 days')) }}
                        </span>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                     x-show="activeFilter === 'all' || activeFilter === 'infografis'"
                     x-transition
                     @click="openLightbox('https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop', 'Infografis Alur Permohonan Informasi Publik PPID Arkan', '{{ date('d M Y', strtotime('-6 days')) }}', 'Infografis')">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=600&auto=format&fit=crop" alt="Infografis Alur" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/90 text-primary-600 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </span>
                        </div>
                        <span class="absolute top-2.5 left-2.5 bg-purple-600/90 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                            Infografis
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-primary-600 transition">
                            Infografis Alur Permohonan Informasi Publik PPID Arkan
                        </h4>
                        <span class="text-[11px] text-slate-400 mt-2 block flex items-center gap-1">
                            <i class="fa-regular fa-calendar"></i> {{ date('d M Y', strtotime('-6 days')) }}
                        </span>
                    </div>
                </div>

                <!-- Item 5 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                     x-show="activeFilter === 'all' || activeFilter === 'kegiatan'"
                     x-transition
                     @click="openLightbox('https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1200&auto=format&fit=crop', 'Bimbingan Teknis Pengelolaan Sistem Informasi PPID', '{{ date('d M Y', strtotime('-8 days')) }}', 'Kegiatan & Rapat')">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=600&auto=format&fit=crop" alt="Bimtek Pengelolaan" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/90 text-primary-600 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </span>
                        </div>
                        <span class="absolute top-2.5 left-2.5 bg-blue-600/90 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                            Kegiatan
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-primary-600 transition">
                            Bimbingan Teknis Pengelolaan Sistem Informasi PPID
                        </h4>
                        <span class="text-[11px] text-slate-400 mt-2 block flex items-center gap-1">
                            <i class="fa-regular fa-calendar"></i> {{ date('d M Y', strtotime('-8 days')) }}
                        </span>
                    </div>
                </div>

                <!-- Item 6 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                     x-show="activeFilter === 'all' || activeFilter === 'sosialisasi'"
                     x-transition
                     @click="openLightbox('https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=1200&auto=format&fit=crop', 'Workshop Penyusunan Daftar Informasi Dikecualikan (DIK)', '{{ date('d M Y', strtotime('-11 days')) }}', 'Sosialisasi KIP')">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=600&auto=format&fit=crop" alt="Workshop DIK" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/90 text-primary-600 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </span>
                        </div>
                        <span class="absolute top-2.5 left-2.5 bg-amber-500/90 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                            Sosialisasi
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-primary-600 transition">
                            Workshop Penyusunan Daftar Informasi Dikecualikan (DIK)
                        </h4>
                        <span class="text-[11px] text-slate-400 mt-2 block flex items-center gap-1">
                            <i class="fa-regular fa-calendar"></i> {{ date('d M Y', strtotime('-11 days')) }}
                        </span>
                    </div>
                </div>

                <!-- Item 7 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                     x-show="activeFilter === 'all' || activeFilter === 'pelayanan'"
                     x-transition
                     @click="openLightbox('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1200&auto=format&fit=crop', 'Sosialisasi Meja Layanan Ramah Disabilitas PPID', '{{ date('d M Y', strtotime('-14 days')) }}', 'Pelayanan Informasi')">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=600&auto=format&fit=crop" alt="Layanan Ramah Disabilitas" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/90 text-primary-600 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </span>
                        </div>
                        <span class="absolute top-2.5 left-2.5 bg-emerald-600/90 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                            Pelayanan
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-primary-600 transition">
                            Sosialisasi Meja Layanan Ramah Disabilitas PPID
                        </h4>
                        <span class="text-[11px] text-slate-400 mt-2 block flex items-center gap-1">
                            <i class="fa-regular fa-calendar"></i> {{ date('d M Y', strtotime('-14 days')) }}
                        </span>
                    </div>
                </div>

                <!-- Item 8 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 group cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                     x-show="activeFilter === 'all' || activeFilter === 'infografis'"
                     x-transition
                     @click="openLightbox('https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1200&auto=format&fit=crop', 'Statistik Rekapitulasi Tahunan Permohonan Informasi Publik', '{{ date('d M Y', strtotime('-18 days')) }}', 'Infografis')">
                    <div class="relative h-56 overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=600&auto=format&fit=crop" alt="Infografis Statistik" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="w-10 h-10 rounded-full bg-white/90 text-primary-600 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                            </span>
                        </div>
                        <span class="absolute top-2.5 left-2.5 bg-purple-600/90 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                            Infografis
                        </span>
                    </div>
                    <div class="p-4">
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-2 group-hover:text-primary-600 transition">
                            Statistik Rekapitulasi Tahunan Permohonan Informasi Publik
                        </h4>
                        <span class="text-[11px] text-slate-400 mt-2 block flex items-center gap-1">
                            <i class="fa-regular fa-calendar"></i> {{ date('d M Y', strtotime('-18 days')) }}
                        </span>
                    </div>
                </div>
            @endif

        </div>

        <!-- Lightbox Modal Overlay (Alpine.js) -->
        <div x-show="modalOpen" 
             x-cloak
             @keydown.escape.window="modalOpen = false"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-950/85 backdrop-blur-md"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            
            <div @click.away="modalOpen = false" 
                 class="relative max-w-4xl w-full bg-white rounded-3xl overflow-hidden shadow-2xl border border-slate-700/30"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                
                <!-- Close Button -->
                <button @click="modalOpen = false" 
                        class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <!-- Modal Image Container -->
                <div class="bg-black flex items-center justify-center max-h-[70vh] overflow-hidden">
                    <img :src="activeImage" :alt="activeTitle" class="max-h-[70vh] w-auto object-contain">
                </div>

                <!-- Modal Caption -->
                <div class="p-6 bg-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="inline-block bg-blue-100 text-primary-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase mb-1" x-text="activeCategory"></span>
                        <h3 class="text-sm sm:text-base font-bold text-slate-900" x-text="activeTitle"></h3>
                        <p class="text-xs text-slate-400 mt-1 flex items-center gap-1.5">
                            <i class="fa-regular fa-calendar"></i>
                            <span x-text="activeDate"></span>
                        </p>
                    </div>
                    <a :href="activeImage" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold rounded-xl shadow transition flex-shrink-0">
                        <i class="fa-solid fa-download"></i> Unduh Resolusi Penuh
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
