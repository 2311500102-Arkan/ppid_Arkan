@extends('layouts.app')

@section('title', 'Daftar Informasi Publik & Dokumen - PPID Arkan')

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
            <span class="text-accent-300 font-medium">Daftar Informasi Publik (DIP)</span>
        </nav>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
            Daftar Informasi Publik & Dokumen
        </h1>
        <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-2xl">
            Akses dan unduh seluruh berkas, regulasi, surat keputusan, dan laporan resmi yang terbuka bagi masyarakat.
        </p>
    </div>
</section>

<!-- Main Document Filter & Listing -->
<section class="py-12 bg-slate-50 min-h-[700px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Filter Bar & Search Box -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-100">
            <form action="{{ url('/dokumen') }}" method="GET" class="space-y-6">
                <!-- Search row -->
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="relative flex-1 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-magnifying-glass text-sm"></i>
                        </div>
                        <input type="text" 
                               name="q" 
                               value="{{ request('q') }}" 
                               placeholder="Cari berdasarkan judul dokumen, nomor regulasi, atau kata kunci..." 
                               class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:bg-white transition">
                    </div>

                    <!-- Year select filter -->
                    <div class="w-full md:w-48">
                        <select name="tahun" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-xs sm:text-sm text-slate-700 focus:outline-none focus:border-primary-500 transition">
                            <option value="">Semua Tahun</option>
                            <option value="2024" {{ request('tahun') == '2024' ? 'selected' : '' }}>Tahun 2024</option>
                            <option value="2023" {{ request('tahun') == '2023' ? 'selected' : '' }}>Tahun 2023</option>
                            <option value="2022" {{ request('tahun') == '2022' ? 'selected' : '' }}>Tahun 2022</option>
                            <option value="2021" {{ request('tahun') == '2021' ? 'selected' : '' }}>Tahun 2021</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full md:w-auto px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold text-xs sm:text-sm rounded-2xl shadow-md transition flex items-center justify-center gap-2 flex-shrink-0">
                        <i class="fa-solid fa-filter"></i> Saring Dokumen
                    </button>
                </div>

                <!-- Category Pills -->
                <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-slate-100">
                    <span class="text-xs font-bold text-slate-400 mr-2">Kategori:</span>
                    
                    <a href="{{ url('/dokumen') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-semibold transition {{ !request('kategori') ? 'bg-primary-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Semua Kategori
                    </a>

                    <a href="{{ url('/dokumen?kategori=berkala') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-semibold transition {{ request('kategori') == 'berkala' ? 'bg-blue-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Informasi Berkala
                    </a>

                    <a href="{{ url('/dokumen?kategori=serta-merta') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-semibold transition {{ request('kategori') == 'serta-merta' ? 'bg-amber-500 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Informasi Serta Merta
                    </a>

                    <a href="{{ url('/dokumen?kategori=setiap-saat') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-semibold transition {{ request('kategori') == 'setiap-saat' ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Informasi Setiap Saat
                    </a>

                    <a href="{{ url('/dokumen?kategori=lkpd') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-semibold transition {{ request('kategori') == 'lkpd' ? 'bg-indigo-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Keuangan (LKPD)
                    </a>

                    <a href="{{ url('/dokumen?kategori=lppd') }}" 
                       class="px-4 py-2 rounded-xl text-xs font-semibold transition {{ request('kategori') == 'lppd' ? 'bg-teal-600 text-white shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        Penyelenggaraan (LPPD)
                    </a>
                </div>
            </form>
        </div>

        <!-- Documents Table & Responsive Card Views -->
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            
            <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-900">Berkas dan Informasi Tersedia</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Daftar dokumen resmi yang dapat diakses publik secara bebas.</p>
                </div>
                <div class="text-xs text-slate-500">
                    Menampilkan <span class="font-bold text-primary-600">{{ isset($documents) ? count($documents) : '8' }}</span> dokumen
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50/80 text-slate-500 uppercase tracking-wider font-semibold border-b border-slate-100">
                        <tr>
                            <th class="py-4 px-6 w-12 text-center">No</th>
                            <th class="py-4 px-6">Judul Dokumen & Deskripsi</th>
                            <th class="py-4 px-6">Kategori</th>
                            <th class="py-4 px-6 text-center">Tahun / Tanggal</th>
                            <th class="py-4 px-6 text-center">Ukuran / Format</th>
                            <th class="py-4 px-6 text-center">Aksi Unduh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @if(isset($documents) && count($documents) > 0)
                            @foreach($documents as $index => $doc)
                                <tr class="hover:bg-blue-50/40 transition">
                                    <td class="py-4 px-6 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                                    <td class="py-4 px-6">
                                        <div class="font-bold text-slate-900 text-sm hover:text-primary-600 transition">{{ $doc->title }}</div>
                                        <div class="text-[11px] text-slate-400 mt-0.5">{{ $doc->description ?? 'Dokumen informasi resmi PPID Arkan.' }}</div>
                                        @if(isset($doc->number))
                                            <div class="text-[10px] text-primary-700 bg-blue-50 inline-block px-1.5 py-0.5 rounded mt-1 font-mono">No: {{ $doc->number }}</div>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider 
                                            {{ $doc->category == 'berkala' ? 'bg-blue-100 text-blue-800' : ($doc->category == 'serta-merta' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800') }}">
                                            {{ $doc->category_label ?? ucfirst(str_replace('-', ' ', $doc->category ?? 'Berkala')) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="font-semibold text-slate-700">{{ $doc->year ?? date('Y') }}</span>
                                        <div class="text-[10px] text-slate-400">{{ $doc->date ? $doc->date->format('d/m/Y') : date('d/m/Y') }}</div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[10px] font-bold uppercase font-mono">{{ $doc->format ?? 'PDF' }}</span>
                                        <div class="text-[10px] text-slate-400 mt-0.5">{{ $doc->file_size ?? '2.4 MB' }}</div>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <a href="{{ $doc->file_url ?? '#' }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary-50 text-primary-600 hover:bg-primary-600 hover:text-white rounded-xl transition text-xs font-semibold shadow-sm group">
                                            <i class="fa-solid fa-download text-xs group-hover:scale-110 transition"></i>
                                            <span>Unduh</span>
                                            <span class="text-[10px] opacity-75 font-normal">({{ $doc->downloads_count ?? 42 }})</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <!-- Default Mock Table Rows -->
                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="py-4 px-6 text-center font-medium text-slate-400">1</td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900 text-sm hover:text-primary-600 transition">Laporan Keuangan Pemerintah Daerah (LKPD) Tahun Anggaran 2023 Audited</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">Laporan realisasi anggaran, neraca, dan arus kas yang telah diaudit oleh BPK RI.</div>
                                    <div class="text-[10px] text-primary-700 bg-blue-50 inline-block px-1.5 py-0.5 rounded mt-1 font-mono">No: 02/LKPD/BPK/2024</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-800">
                                        Informasi Berkala
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="font-semibold text-slate-700">2024</span>
                                    <div class="text-[10px] text-slate-400">15 Mei 2024</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="px-2 py-0.5 rounded bg-red-100 text-red-700 text-[10px] font-bold uppercase font-mono">PDF</span>
                                    <div class="text-[10px] text-slate-400 mt-0.5">4.8 MB</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="#" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary-50 text-primary-600 hover:bg-primary-600 hover:text-white rounded-xl transition text-xs font-semibold shadow-sm group">
                                        <i class="fa-solid fa-download text-xs group-hover:scale-110 transition"></i>
                                        <span>Unduh</span>
                                        <span class="text-[10px] opacity-75 font-normal">(184)</span>
                                    </a>
                                </td>
                            </tr>

                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="py-4 px-6 text-center font-medium text-slate-400">2</td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900 text-sm hover:text-primary-600 transition">Rencana Kerja Pemerintah Daerah (RKPD) Tahun 2024</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">Dokumen perencanaan pembangunan daerah tahunan beserta target kinerja indikatif.</div>
                                    <div class="text-[10px] text-primary-700 bg-blue-50 inline-block px-1.5 py-0.5 rounded mt-1 font-mono">Pergub No. 18 Tahun 2023</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-800">
                                        Informasi Berkala
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="font-semibold text-slate-700">2024</span>
                                    <div class="text-[10px] text-slate-400">10 Jan 2024</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="px-2 py-0.5 rounded bg-red-100 text-red-700 text-[10px] font-bold uppercase font-mono">PDF</span>
                                    <div class="text-[10px] text-slate-400 mt-0.5">6.1 MB</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="#" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary-50 text-primary-600 hover:bg-primary-600 hover:text-white rounded-xl transition text-xs font-semibold shadow-sm group">
                                        <i class="fa-solid fa-download text-xs group-hover:scale-110 transition"></i>
                                        <span>Unduh</span>
                                        <span class="text-[10px] opacity-75 font-normal">(312)</span>
                                    </a>
                                </td>
                            </tr>

                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="py-4 px-6 text-center font-medium text-slate-400">3</td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900 text-sm hover:text-primary-600 transition">Peringatan Dini Cuaca Ekstrem dan Protokol Kesiapsiagaan Bencana Daerah</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">Instruksi resmi penanganan potensi banjir dan gelombang pasang wilayah pesisir.</div>
                                    <div class="text-[10px] text-amber-700 bg-amber-50 inline-block px-1.5 py-0.5 rounded mt-1 font-mono">Surat Edaran No. 360/012/BPBD</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-100 text-amber-800">
                                        Serta Merta
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="font-semibold text-slate-700">2024</span>
                                    <div class="text-[10px] text-slate-400">02 Feb 2024</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="px-2 py-0.5 rounded bg-red-100 text-red-700 text-[10px] font-bold uppercase font-mono">PDF</span>
                                    <div class="text-[10px] text-slate-400 mt-0.5">1.2 MB</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="#" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary-50 text-primary-600 hover:bg-primary-600 hover:text-white rounded-xl transition text-xs font-semibold shadow-sm group">
                                        <i class="fa-solid fa-download text-xs group-hover:scale-110 transition"></i>
                                        <span>Unduh</span>
                                        <span class="text-[10px] opacity-75 font-normal">(540)</span>
                                    </a>
                                </td>
                            </tr>

                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="py-4 px-6 text-center font-medium text-slate-400">4</td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900 text-sm hover:text-primary-600 transition">Daftar Regulasi dan Produk Hukum Daerah Terkait Pelayanan Informasi Publik</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">Kumpulan Peraturan Daerah, Peraturan Gubernur, dan Keputusan Sekda.</div>
                                    <div class="text-[10px] text-emerald-700 bg-emerald-50 inline-block px-1.5 py-0.5 rounded mt-1 font-mono">DIP-01/PPID/2024</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
                                        Setiap Saat
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="font-semibold text-slate-700">2024</span>
                                    <div class="text-[10px] text-slate-400">20 Jan 2024</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="px-2 py-0.5 rounded bg-red-100 text-red-700 text-[10px] font-bold uppercase font-mono">PDF</span>
                                    <div class="text-[10px] text-slate-400 mt-0.5">3.5 MB</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="#" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary-50 text-primary-600 hover:bg-primary-600 hover:text-white rounded-xl transition text-xs font-semibold shadow-sm group">
                                        <i class="fa-solid fa-download text-xs group-hover:scale-110 transition"></i>
                                        <span>Unduh</span>
                                        <span class="text-[10px] opacity-75 font-normal">(278)</span>
                                    </a>
                                </td>
                            </tr>

                            <tr class="hover:bg-blue-50/40 transition">
                                <td class="py-4 px-6 text-center font-medium text-slate-400">5</td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900 text-sm hover:text-primary-600 transition">Laporan Penyelenggaraan Pemerintahan Daerah (LPPD) Ringkasan Tahun 2023</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">Ringkasan capaian kinerja makro, program urusan wajib dan pilihan pemerintah.</div>
                                    <div class="text-[10px] text-teal-700 bg-teal-50 inline-block px-1.5 py-0.5 rounded mt-1 font-mono">RLPPD-2023-REV</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-800">
                                        Informasi Berkala
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="font-semibold text-slate-700">2024</span>
                                    <div class="text-[10px] text-slate-400">28 Mar 2024</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="px-2 py-0.5 rounded bg-red-100 text-red-700 text-[10px] font-bold uppercase font-mono">PDF</span>
                                    <div class="text-[10px] text-slate-400 mt-0.5">5.2 MB</div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="#" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary-50 text-primary-600 hover:bg-primary-600 hover:text-white rounded-xl transition text-xs font-semibold shadow-sm group">
                                        <i class="fa-solid fa-download text-xs group-hover:scale-110 transition"></i>
                                        <span>Unduh</span>
                                        <span class="text-[10px] opacity-75 font-normal">(165)</span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y divide-slate-100">
                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-blue-100 text-blue-800">Informasi Berkala</span>
                        <span class="text-[11px] text-slate-400 font-mono">2024</span>
                    </div>
                    <h3 class="text-xs font-bold text-slate-900 leading-snug">Laporan Keuangan Pemerintah Daerah (LKPD) Tahun Anggaran 2023 Audited</h3>
                    <p class="text-[11px] text-slate-500">Laporan realisasi anggaran, neraca, dan arus kas yang telah diaudit oleh BPK RI.</p>
                    <div class="flex items-center justify-between pt-2">
                        <span class="text-[10px] text-slate-400 font-mono">PDF • 4.8 MB</span>
                        <a href="#" class="px-3 py-1.5 bg-primary-600 text-white rounded-xl text-xs font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-download"></i> Unduh
                        </a>
                    </div>
                </div>

                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-amber-100 text-amber-800">Serta Merta</span>
                        <span class="text-[11px] text-slate-400 font-mono">2024</span>
                    </div>
                    <h3 class="text-xs font-bold text-slate-900 leading-snug">Peringatan Dini Cuaca Ekstrem dan Protokol Bencana Daerah</h3>
                    <p class="text-[11px] text-slate-500">Instruksi penanganan potensi banjir dan gelombang pasang pesisir.</p>
                    <div class="flex items-center justify-between pt-2">
                        <span class="text-[10px] text-slate-400 font-mono">PDF • 1.2 MB</span>
                        <a href="#" class="px-3 py-1.5 bg-primary-600 text-white rounded-xl text-xs font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-download"></i> Unduh
                        </a>
                    </div>
                </div>

                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-800">Setiap Saat</span>
                        <span class="text-[11px] text-slate-400 font-mono">2024</span>
                    </div>
                    <h3 class="text-xs font-bold text-slate-900 leading-snug">Daftar Regulasi dan Produk Hukum Terkait Pelayanan Informasi</h3>
                    <p class="text-[11px] text-slate-500">Kumpulan Peraturan Daerah dan Peraturan Gubernur.</p>
                    <div class="flex items-center justify-between pt-2">
                        <span class="text-[10px] text-slate-400 font-mono">PDF • 3.5 MB</span>
                        <a href="#" class="px-3 py-1.5 bg-primary-600 text-white rounded-xl text-xs font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-download"></i> Unduh
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Pagination -->
            <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
                <span class="text-xs text-slate-500">Halaman 1 dari 1</span>
                <div class="flex items-center space-x-1.5 text-xs">
                    <span class="px-3 py-1.5 rounded-lg bg-primary-600 text-white font-bold">1</span>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
