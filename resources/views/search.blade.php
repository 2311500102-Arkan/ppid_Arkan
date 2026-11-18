@extends('layouts.app')

@section('title', 'Hasil Pencarian: "' . (request('q') ?? 'Informasi') . '" - PPID Arkan')

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
            <span class="text-accent-300 font-medium">Pencarian Global</span>
        </nav>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
            Hasil Pencarian
        </h1>
        
        <!-- Search bar inside header -->
        <div class="pt-6 max-w-2xl">
            <form action="{{ url('/cari') }}" method="GET" class="relative bg-white/95 backdrop-blur-md rounded-2xl p-2 shadow-2xl flex items-center border border-white/30 focus-within:ring-4 focus-within:ring-accent-400/50 transition">
                <div class="pl-3 text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-lg"></i>
                </div>
                <input type="text" 
                       name="q" 
                       value="{{ request('q') }}"
                       placeholder="Cari kembali dokumen, regulasi, berita, atau informasi..." 
                       class="w-full px-3 py-2 text-sm text-slate-800 placeholder-slate-400 bg-transparent border-0 focus:outline-none focus:ring-0">
                <button type="submit" class="px-5 py-3 bg-gradient-to-r from-blue-700 to-primary-600 hover:from-blue-800 hover:to-primary-700 text-white text-sm font-semibold rounded-xl shadow-md transition flex items-center gap-2 flex-shrink-0">
                    <span>Cari</span>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Search Results Section -->
<section class="py-12 bg-slate-50 min-h-[600px]" x-data="{ activeTab: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Results Counter & Tab Filters -->
        <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-base sm:text-lg font-bold text-slate-900">
                    @if(request('q'))
                        Menampilkan hasil untuk kata kunci <span class="text-primary-600">"{{ request('q') }}"</span>
                    @else
                        Semua Hasil Penelusuran
                    @endif
                </h2>
                <p class="text-xs text-slate-400 mt-0.5">Ditemukan informasi yang relevan pada sistem arsip PPID.</p>
            </div>

            <!-- Tab Pills -->
            <div class="flex flex-wrap items-center gap-2">
                <button @click="activeTab = 'all'" 
                        :class="activeTab === 'all' ? 'bg-primary-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                        class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                    Semua
                </button>
                <button @click="activeTab = 'dokumen'" 
                        :class="activeTab === 'dokumen' ? 'bg-primary-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                        class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                    Dokumen & DIP
                </button>
                <button @click="activeTab = 'berita'" 
                        :class="activeTab === 'berita' ? 'bg-primary-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                        class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                    Berita & Artikel
                </button>
                <button @click="activeTab = 'profil'" 
                        :class="activeTab === 'profil' ? 'bg-primary-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                        class="px-4 py-2 rounded-xl text-xs font-semibold transition">
                    Halaman Profil
                </button>
            </div>
        </div>

        <!-- Result List Container -->
        <div class="space-y-4">
            
            @php
                $hasResults = (isset($documents) && count($documents) > 0) || 
                              (isset($posts) && count($posts) > 0) || 
                              (isset($pages) && count($pages) > 0) ||
                              (!isset($documents) && !isset($posts) && !isset($pages)); // if not passed, mock results shown
            @endphp

            @if($hasResults)
                
                <!-- Dokumen Results -->
                <div x-show="activeTab === 'all' || activeTab === 'dokumen'" class="space-y-4">
                    <div class="px-2 text-xs font-bold uppercase tracking-wider text-slate-400">Dokumen & Regulasi</div>
                    
                    @if(isset($documents) && count($documents) > 0)
                        @foreach($documents as $doc)
                            <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100 hover:border-primary-400 transition hover:shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-primary-600 flex items-center justify-center flex-shrink-0 text-lg">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="bg-blue-100 text-primary-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Dokumen</span>
                                            <span class="text-xs text-slate-400">{{ $doc->year ?? date('Y') }}</span>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-900 mt-1 hover:text-primary-600 transition">
                                            <a href="{{ $doc->file_url ?? url('/dokumen') }}">{{ $doc->title }}</a>
                                        </h3>
                                        <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $doc->description ?? 'Berkas informasi publik resmi PPID Arkan.' }}</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 flex items-center gap-2">
                                    <a href="{{ $doc->file_url ?? url('/dokumen') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold rounded-xl flex items-center gap-1.5 transition">
                                        <i class="fa-solid fa-download"></i> Unduh
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Mock Document Item -->
                        <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100 hover:border-primary-400 transition hover:shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-blue-100 text-primary-600 flex items-center justify-center flex-shrink-0 text-lg">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="bg-blue-100 text-primary-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Dokumen Berkala</span>
                                        <span class="text-xs text-slate-400">2024</span>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-900 mt-1 hover:text-primary-600 transition">
                                        <a href="{{ url('/dokumen') }}">Laporan Keuangan Pemerintah Daerah (LKPD) Tahun Anggaran 2023 Audited</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-1">Laporan realisasi anggaran, neraca keuangan daerah, dan catatan atas laporan keuangan resmi.</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex items-center gap-2">
                                <a href="{{ url('/dokumen') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold rounded-xl flex items-center gap-1.5 transition">
                                    <i class="fa-solid fa-download"></i> Unduh Dokumen
                                </a>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100 hover:border-amber-400 transition hover:shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0 text-lg">
                                    <i class="fa-solid fa-bolt-lightning"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Serta Merta</span>
                                        <span class="text-xs text-slate-400">2024</span>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-900 mt-1 hover:text-amber-600 transition">
                                        <a href="{{ url('/dokumen') }}">Peringatan Dini Cuaca Ekstrem dan Protokol Kesiapsiagaan Bencana Daerah</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-1">Surat Edaran resmi tentang tanggap darurat dan keselamatan masyarakat.</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex items-center gap-2">
                                <a href="{{ url('/dokumen') }}" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold rounded-xl flex items-center gap-1.5 transition">
                                    <i class="fa-solid fa-download"></i> Unduh Dokumen
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Berita Results -->
                <div x-show="activeTab === 'all' || activeTab === 'berita'" class="space-y-4 pt-4">
                    <div class="px-2 text-xs font-bold uppercase tracking-wider text-slate-400">Berita & Informasi</div>

                    @if(isset($posts) && count($posts) > 0)
                        @foreach($posts as $p)
                            <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100 hover:border-primary-400 transition hover:shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 text-lg">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Berita</span>
                                            <span class="text-xs text-slate-400">{{ $p->created_at ? $p->created_at->format('d M Y') : date('d M Y') }}</span>
                                        </div>
                                        <h3 class="text-sm font-bold text-slate-900 mt-1 hover:text-primary-600 transition">
                                            <a href="{{ url('/berita/' . ($p->slug ?? $p->id)) }}">{{ $p->title }}</a>
                                        </h3>
                                        <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $p->excerpt ?? Str::limit(strip_tags($p->content ?? ''), 120) }}</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 flex items-center gap-2">
                                    <a href="{{ url('/berita/' . ($p->slug ?? $p->id)) }}" class="px-4 py-2 bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-primary-600 text-xs font-semibold rounded-xl flex items-center gap-1.5 transition">
                                        Baca Artikel <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Mock Post Item -->
                        <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100 hover:border-primary-400 transition hover:shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0 text-lg">
                                    <i class="fa-solid fa-newspaper"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Berita</span>
                                        <span class="text-xs text-slate-400">{{ date('d M Y') }}</span>
                                    </div>
                                    <h3 class="text-sm font-bold text-slate-900 mt-1 hover:text-primary-600 transition">
                                        <a href="{{ url('/berita') }}">Rapat Koordinasi Penguatan Layanan Keterbukaan Informasi Publik PPID Arkan</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-1">Pemerintah terus memperkuat komitmen keterbukaan informasi guna mendukung akuntabilitas kinerja.</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex items-center gap-2">
                                <a href="{{ url('/berita') }}" class="px-4 py-2 bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-primary-600 text-xs font-semibold rounded-xl flex items-center gap-1.5 transition">
                                    Baca Artikel <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Profil Results -->
                <div x-show="activeTab === 'all' || activeTab === 'profil'" class="space-y-4 pt-4">
                    <div class="px-2 text-xs font-bold uppercase tracking-wider text-slate-400">Halaman Profil</div>

                    @if(isset($pages) && count($pages) > 0)
                        @foreach($pages as $pg)
                            <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100 hover:border-primary-400 transition hover:shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center flex-shrink-0 text-lg">
                                        <i class="fa-solid fa-sitemap"></i>
                                    </div>
                                    <div>
                                        <span class="bg-purple-100 text-purple-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Halaman Statis</span>
                                        <h3 class="text-sm font-bold text-slate-900 mt-1 hover:text-primary-600 transition">
                                            <a href="{{ url('/profil/' . ($pg->slug ?? $pg->id)) }}">{{ $pg->title }}</a>
                                        </h3>
                                        <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ Str::limit(strip_tags($pg->content ?? ''), 120) }}</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 flex items-center gap-2">
                                    <a href="{{ url('/profil/' . ($pg->slug ?? $pg->id)) }}" class="px-4 py-2 bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-primary-600 text-xs font-semibold rounded-xl flex items-center gap-1.5 transition">
                                        Lihat Halaman <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Mock Page Item -->
                        <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100 hover:border-primary-400 transition hover:shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center flex-shrink-0 text-lg">
                                    <i class="fa-solid fa-sitemap"></i>
                                </div>
                                <div>
                                    <span class="bg-purple-100 text-purple-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Profil PPID</span>
                                    <h3 class="text-sm font-bold text-slate-900 mt-1 hover:text-primary-600 transition">
                                        <a href="{{ url('/profil/dasar-hukum-ppid') }}">Dasar Hukum & Landasan Operasional PPID</a>
                                    </h3>
                                    <p class="text-xs text-slate-500 mt-1">Kumpulan dasar hukum pembentukan PPID, Peraturan Komisi Informasi No. 1 Tahun 2021 tentang SLIP.</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 flex items-center gap-2">
                                <a href="{{ url('/profil/dasar-hukum-ppid') }}" class="px-4 py-2 bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-primary-600 text-xs font-semibold rounded-xl flex items-center gap-1.5 transition">
                                    Lihat Halaman <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

            @else
                <!-- Empty State -->
                <div class="bg-white rounded-3xl p-12 text-center shadow-xl border border-slate-100 max-w-lg mx-auto">
                    <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mx-auto mb-4">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Tidak Ada Hasil Ditemukan</h3>
                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                        Maaf, kami tidak menemukan berkas atau informasi publik yang cocok dengan kata kunci "{{ request('q') }}". Silakan gunakan kata kunci lain.
                    </p>
                    <a href="{{ url('/dokumen') }}" class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white rounded-xl text-xs font-semibold hover:bg-primary-700 transition">
                        <span>Lihat Semua Dokumen</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>
            @endif

        </div>

    </div>
</section>

@endsection
