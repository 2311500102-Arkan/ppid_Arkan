@extends('layouts.app')

@section('title', ($post->title ?? 'Detail Berita') . ' - PPID Arkan')

@section('content')

<!-- Header Banner & Breadcrumbs -->
<section class="bg-gradient-to-r from-navy-950 via-blue-900 to-blue-800 text-white py-12 relative overflow-hidden">
    <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-xs text-blue-200 mb-3" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white transition flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            <span>/</span>
            <a href="{{ url('/berita') }}" class="hover:text-white transition">Berita & Publikasi</a>
            <span>/</span>
            <span class="text-accent-300 font-medium truncate max-w-xs sm:max-w-md">{{ $post->title ?? 'Detail Berita' }}</span>
        </nav>
        
        <div class="max-w-4xl">
            <span class="inline-block bg-accent-400 text-slate-900 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3">
                {{ $post->category ?? 'Warta Informasi' }}
            </span>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white leading-tight">
                {{ $post->title ?? 'Judul Berita dan Publikasi Resmi PPID Arkan' }}
            </h1>
            
            <div class="flex flex-wrap items-center gap-4 text-xs text-blue-200 mt-4">
                <div class="flex items-center gap-1.5">
                    <i class="fa-regular fa-calendar-days text-accent-300"></i>
                    <span>{{ isset($post->created_at) ? (is_string($post->created_at) ? $post->created_at : $post->created_at->format('l, d F Y')) : date('l, d F Y') }}</span>
                </div>
                <span>•</span>
                <div class="flex items-center gap-1.5">
                    <i class="fa-solid fa-user-pen text-accent-300"></i>
                    <span>Oleh: {{ $post->author ?? 'Tim Redaksi PPID' }}</span>
                </div>
                <span>•</span>
                <div class="flex items-center gap-1.5">
                    <i class="fa-solid fa-eye text-accent-300"></i>
                    <span>{{ $post->views ?? 284 }}x dibaca</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Main Article (Col 8) -->
            <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-slate-100">
                
                <!-- Featured Image -->
                <div class="mb-8 rounded-2xl overflow-hidden shadow-lg bg-slate-100">
                    <img src="{{ $post->image ?? 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?q=80&w=1200&auto=format&fit=crop' }}" 
                         alt="{{ $post->title ?? 'Gambar Berita' }}" 
                         class="w-full h-auto max-h-[460px] object-cover">
                    @if(isset($post->image_caption))
                        <div class="p-3 text-[11px] text-slate-500 bg-slate-50 italic text-center border-t border-slate-100">
                            {{ $post->image_caption }}
                        </div>
                    @endif
                </div>

                <!-- Article Body -->
                <div class="prose prose-slate prose-blue max-w-none text-slate-700 leading-relaxed text-sm sm:text-base space-y-5">
                    @if(isset($post->content))
                        {!! $post->content !!}
                    @else
                        <p class="text-slate-700 leading-relaxed text-justify first-letter:text-5xl first-letter:font-bold first-letter:text-primary-700 first-letter:float-left first-letter:mr-3">
                            Pejabat Pengelola Informasi dan Dokumentasi (PPID) Arkan terus memperkuat komitmennya dalam menghadirkan keterbukaan informasi publik yang transparan, mudah diakses, dan akuntabel bagi seluruh lapisan masyarakat. Langkah ini sejalan dengan amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
                        </p>
                        
                        <p class="text-slate-700 leading-relaxed text-justify">
                            Dalam era digitalisasi saat ini, kebutuhan masyarakat akan akses informasi yang cepat dan sahih semakin mendesak. Melalui penyempurnaan portal web ini, pemohon informasi dapat mengakses data secara daring, memantau alur tahapan verifikasi, serta mengunduh dokumen secara mandiri kapan saja.
                        </p>

                        <div class="my-6 p-6 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-primary-600">
                            <blockquote class="text-sm font-medium italic text-slate-700 mb-2">
                                "Keterbukaan informasi bukan sekadar kewajiban hukum, melainkan esensi penting dalam mewujudkan tata kelola kepemerintahan yang berintegritas dan terpercaya."
                            </blockquote>
                            <cite class="text-xs font-bold text-primary-700 block not-italic">— PPID Arkan</cite>
                        </div>

                        <h3 class="text-lg font-bold text-slate-900 mt-6 mb-3">Peningkatan Kualitas Meja Layanan Informasi</h3>
                        <p class="text-slate-700 leading-relaxed text-justify">
                            Selain layanan online, meja pelayanan PPID di kantor dinas juga telah disiapkan dengan fasilitas yang ramah terhadap semua kalangan, termasuk kelompok rentan dan penyandang disabilitas. Petugas pelayanan informasi telah dibekali pelatihan standar operasional prosedur penanganan permohonan dan pengajuan keberatan.
                        </p>

                        <p class="text-slate-700 leading-relaxed text-justify">
                            Masyarakat diimbau untuk tidak ragu menggunakan hak konstitusionalnya dalam memperoleh informasi publik yang bersifat terbuka dan bermanfaat bagi kemajuan bangsa.
                        </p>
                    @endif
                </div>

                <!-- Tags / Keywords -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-2">
                    <span class="text-xs font-bold text-slate-500 mr-2"><i class="fa-solid fa-hashtag text-primary-600"></i> Topik:</span>
                    <a href="{{ url('/berita?kategori=kegiatan') }}" class="px-3 py-1 rounded-full bg-slate-100 hover:bg-blue-50 hover:text-primary-600 text-slate-600 text-xs transition">#PPIDArkan</a>
                    <a href="{{ url('/berita?kategori=sosialisasi') }}" class="px-3 py-1 rounded-full bg-slate-100 hover:bg-blue-50 hover:text-primary-600 text-slate-600 text-xs transition">#KeterbukaanInformasi</a>
                    <a href="{{ url('/berita?kategori=layanan') }}" class="px-3 py-1 rounded-full bg-slate-100 hover:bg-blue-50 hover:text-primary-600 text-slate-600 text-xs transition">#LayananPublik</a>
                </div>

                <!-- Share Buttons Bar -->
                <div class="mt-8 p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-share-nodes text-primary-600"></i>
                        <span class="text-xs font-bold text-slate-700">Bagikan Berita Ini:</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="https://wa.me/?text={{ urlencode(($post->title ?? 'Berita PPID Arkan') . ' ' . url()->current()) }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-semibold flex items-center gap-1.5 shadow-sm transition">
                            <i class="fa-brands fa-whatsapp"></i> <span>WhatsApp</span>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold flex items-center gap-1.5 shadow-sm transition">
                            <i class="fa-brands fa-facebook-f"></i> <span>Facebook</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title ?? 'Berita PPID Arkan') }}&url={{ urlencode(url()->current()) }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-black text-white text-xs font-semibold flex items-center gap-1.5 shadow-sm transition">
                            <i class="fa-brands fa-x-twitter"></i> <span>X</span>
                        </a>
                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title ?? 'Berita PPID Arkan') }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-sky-500 hover:bg-sky-600 text-white text-xs font-semibold flex items-center gap-1.5 shadow-sm transition">
                            <i class="fa-brands fa-telegram"></i> <span>Telegram</span>
                        </a>
                        <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berita berhasil disalin ke papan klip!');" class="p-2 rounded-xl bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs transition" title="Salin Tautan">
                            <i class="fa-solid fa-copy"></i>
                        </button>
                    </div>
                </div>

                <!-- Back button -->
                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ url('/berita') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Berita
                    </a>
                </div>

            </div>

            <!-- Sidebar (Col 4) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Quick Author / Publisher Info -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-blue-700 to-accent-400 p-0.5 flex items-center justify-center text-white flex-shrink-0">
                        <div class="w-full h-full bg-slate-900/10 rounded-[14px] flex items-center justify-center">
                            <i class="fa-solid fa-landmark text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-slate-400">Diterbitkan oleh:</div>
                        <div class="text-sm font-bold text-slate-800">PPID ARKAN</div>
                        <div class="text-[11px] text-primary-600">Humas & Layanan Informasi Publik</div>
                    </div>
                </div>

                <!-- Related News -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-newspaper text-primary-600"></i> Berita Terkait
                    </h3>

                    <div class="space-y-4">
                        @if(isset($relatedPosts) && count($relatedPosts) > 0)
                            @foreach($relatedPosts as $rel)
                                <a href="{{ url('/berita/' . ($rel->slug ?? $rel->id)) }}" class="flex gap-3 group">
                                    <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                        <img src="{{ $rel->image ?? 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=200&auto=format&fit=crop' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-slate-400 block">{{ $rel->created_at ? (is_string($rel->created_at) ? $rel->created_at : $rel->created_at->format('d M Y')) : date('d M Y') }}</span>
                                        <h4 class="text-xs font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                            {{ $rel->title }}
                                        </h4>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <!-- Fallback Mock Related Posts -->
                            <a href="{{ url('/berita') }}" class="flex gap-3 group">
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1541872703-74c5e44368f9?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                </div>
                                <div>
                                    <span class="text-[10px] text-slate-400 block">{{ date('d M Y') }}</span>
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                        Rapat Koordinasi Penguatan Layanan Keterbukaan Informasi Publik
                                    </h4>
                                </div>
                            </a>

                            <a href="{{ url('/berita') }}" class="flex gap-3 group">
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                </div>
                                <div>
                                    <span class="text-[10px] text-slate-400 block">{{ date('d M Y', strtotime('-3 days')) }}</span>
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                        PPID Arkan Raih Predikat Kategori Informatif dalam Evaluasi Tahunan
                                    </h4>
                                </div>
                            </a>

                            <a href="{{ url('/berita') }}" class="flex gap-3 group">
                                <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                </div>
                                <div>
                                    <span class="text-[10px] text-slate-400 block">{{ date('d M Y', strtotime('-5 days')) }}</span>
                                    <h4 class="text-xs font-bold text-slate-800 group-hover:text-primary-600 transition line-clamp-2">
                                        Sosialisasi Prosedur Permohonan Informasi Publik bagi Masyarakat
                                    </h4>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- CTA Banner -->
                <div class="rounded-3xl bg-gradient-to-br from-blue-700 to-primary-900 p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="relative z-10 space-y-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-accent-300 text-lg">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                        <h4 class="font-bold text-base">Perlu Dokumen Resmi?</h4>
                        <p class="text-xs text-blue-100 leading-relaxed font-light">
                            Ajukan permohonan informasi publik secara online melalui formulir permohonan resmi.
                        </p>
                        <a href="{{ url('/permohonan-informasi') }}" class="inline-block mt-2 px-4 py-2 bg-accent-400 hover:bg-accent-300 text-slate-900 font-bold text-xs rounded-xl transition shadow">
                            Isi Formulir Online
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
