@extends('layouts.app')

@section('title', ($page->title ?? 'Halaman Informasi') . ' - PPID Arkan')

@section('content')

<!-- Header & Breadcrumb -->
<section class="bg-gradient-to-r from-navy-950 via-blue-900 to-blue-800 text-white py-12 relative overflow-hidden">
    <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-xs text-blue-200 mb-3" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white transition flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            <span>/</span>
            <span class="text-blue-300">Profil / Informasi</span>
            <span>/</span>
            <span class="text-accent-300 font-medium truncate max-w-xs sm:max-w-md">{{ $page->title ?? 'Detail Halaman' }}</span>
        </nav>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
            {{ $page->title ?? 'Judul Halaman Informasi' }}
        </h1>
        
        <div class="flex items-center gap-4 text-xs text-blue-200 mt-4">
            <div class="flex items-center gap-1.5">
                <i class="fa-regular fa-calendar-check text-accent-400"></i>
                <span>Terakhir diperbarui: {{ isset($page->updated_at) ? (is_string($page->updated_at) ? $page->updated_at : $page->updated_at->format('d F Y')) : date('d F Y') }}</span>
            </div>
            <span>•</span>
            <div class="flex items-center gap-1.5">
                <i class="fa-solid fa-shield-halved text-accent-400"></i>
                <span>PPID Resmi</span>
            </div>
        </div>
    </div>
</section>

<!-- Content Area -->
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Main Content (Col 8) -->
            <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-slate-100">
                
                @if(isset($page->image) && $page->image)
                    <div class="mb-8 rounded-2xl overflow-hidden shadow-md">
                        <img src="{{ $page->image }}" alt="{{ $page->title }}" class="w-full h-auto object-cover max-h-96">
                    </div>
                @endif

                <!-- Article Content Body -->
                <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed space-y-4">
                    @if(isset($page->content))
                        {!! $page->content !!}
                    @else
                        <p class="text-slate-600">
                            Berikut adalah dokumen dan informasi resmi terkait yang disajikan secara transparan dan akuntabel oleh Pejabat Pengelola Informasi dan Dokumentasi (PPID) Arkan.
                        </p>
                        
                        <div class="my-6 p-6 bg-blue-50/60 rounded-2xl border-l-4 border-primary-600">
                            <h4 class="font-bold text-slate-800 text-base mb-2">Maklumat Keterbukaan Informasi</h4>
                            <p class="text-sm text-slate-600">
                                Setiap informasi yang disajikan melalui portal ini senantiasa dimutakhirkan secara berkala sesuai ketentuan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
                            </p>
                        </div>

                        <p class="text-slate-600">
                            Masyarakat berhak memperoleh salinan atau mengakses dokumen publik sesuai tata cara permohonan yang berlaku. Apabila Anda membutuhkan informasi lebih lanjut yang belum tercantum pada halaman ini, silakan memanfaatkan layanan permohonan informasi publik.
                        </p>
                    @endif
                </div>

                <!-- Attachment if available -->
                @if(isset($page->attachment) && $page->attachment)
                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <h4 class="text-sm font-bold text-slate-800 mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-paperclip text-primary-600"></i> Lampiran Berkas / Dokumen
                        </h4>
                        <a href="{{ asset($page->attachment) }}" target="_blank" class="inline-flex items-center gap-3 p-3.5 rounded-2xl bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-primary-300 text-xs text-slate-700 font-semibold transition group">
                            <i class="fa-solid fa-file-pdf text-red-500 text-xl group-hover:scale-110 transition"></i>
                            <div>
                                <div class="text-slate-800 group-hover:text-primary-600 transition">Unduh Lampiran Resmi</div>
                                <div class="text-[11px] text-slate-400 font-normal">Format PDF / Berkas Terkait</div>
                            </div>
                            <i class="fa-solid fa-download text-slate-400 group-hover:text-primary-600 ml-4"></i>
                        </a>
                    </div>
                @endif

                <!-- Share Section -->
                <div class="mt-10 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4">
                    <span class="text-xs font-semibold text-slate-500">Bagikan halaman ini:</span>
                    <div class="flex items-center space-x-2">
                        <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank" class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white flex items-center justify-center text-xs transition" title="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center text-xs transition" title="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-900 hover:text-white flex items-center justify-center text-xs transition" title="X / Twitter">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <button onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan berhasil disalin!');" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 hover:bg-primary-600 hover:text-white flex items-center justify-center text-xs transition" title="Salin Tautan">
                            <i class="fa-solid fa-link"></i>
                        </button>
                    </div>
                </div>

            </div>

            <!-- Sidebar Navigation (Col 4) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Profil Nav Card -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-primary-600"></i>
                        Halaman Terkait Profil
                    </h3>
                    <ul class="space-y-1.5 text-xs">
                        <li>
                            <a href="{{ url('/profil/visi-misi') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-blue-50 hover:text-primary-600 text-slate-600 transition {{ request()->is('profil/visi-misi') ? 'bg-blue-50 text-primary-700 font-bold' : '' }}">
                                <span>Visi dan Misi Organisasi</span>
                                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil/struktur-organisasi') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-blue-50 hover:text-primary-600 text-slate-600 transition {{ request()->is('profil/struktur-organisasi') ? 'bg-blue-50 text-primary-700 font-bold' : '' }}">
                                <span>Struktur Organisasi</span>
                                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil/tugas-fungsi') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-blue-50 hover:text-primary-600 text-slate-600 transition {{ request()->is('profil/tugas-fungsi') ? 'bg-blue-50 text-primary-700 font-bold' : '' }}">
                                <span>Tugas dan Fungsi</span>
                                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil/profil-pimpinan') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-blue-50 hover:text-primary-600 text-slate-600 transition {{ request()->is('profil/profil-pimpinan') ? 'bg-blue-50 text-primary-700 font-bold' : '' }}">
                                <span>Profil Pimpinan</span>
                                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil/gambaran-singkat-ppid') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-blue-50 hover:text-primary-600 text-slate-600 transition {{ request()->is('profil/gambaran-singkat-ppid') ? 'bg-blue-50 text-primary-700 font-bold' : '' }}">
                                <span>Gambaran Singkat PPID</span>
                                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil/dasar-hukum-ppid') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-blue-50 hover:text-primary-600 text-slate-600 transition {{ request()->is('profil/dasar-hukum-ppid') ? 'bg-blue-50 text-primary-700 font-bold' : '' }}">
                                <span>Dasar Hukum PPID</span>
                                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil/struktur-organisasi-ppid') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-blue-50 hover:text-primary-600 text-slate-600 transition {{ request()->is('profil/struktur-organisasi-ppid') ? 'bg-blue-50 text-primary-700 font-bold' : '' }}">
                                <span>Struktur Organisasi PPID</span>
                                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/profil/visi-misi-ppid') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-blue-50 hover:text-primary-600 text-slate-600 transition {{ request()->is('profil/visi-misi-ppid') ? 'bg-blue-50 text-primary-700 font-bold' : '' }}">
                                <span>Visi dan Misi PPID</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- CTA Help Box -->
                <div class="rounded-3xl bg-gradient-to-br from-blue-700 to-primary-900 p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-accent-400/20 rounded-full blur-2xl"></div>
                    <div class="relative z-10 space-y-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-accent-300 text-lg">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <h4 class="font-bold text-base">Butuh Bantuan Langsung?</h4>
                        <p class="text-xs text-blue-100 leading-relaxed font-light">
                            Hubungi desk informasi publik kami pada hari dan jam kerja untuk konsultasi permohonan.
                        </p>
                        <a href="{{ url('/kontak') }}" class="inline-block mt-2 px-4 py-2 bg-accent-400 hover:bg-accent-300 text-slate-900 font-bold text-xs rounded-xl transition shadow">
                            Hubungi Kami
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
