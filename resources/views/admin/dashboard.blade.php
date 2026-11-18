@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="space-y-8">

    <!-- Top Greeting Banner & Quick Actions -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-navy-900 via-blue-900 to-indigo-900 p-6 sm:p-8 text-white shadow-xl shadow-blue-900/10 border border-blue-800/40">
        <!-- Background subtle glow accents -->
        <div class="absolute -top-12 -right-12 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="space-y-1.5">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-semibold backdrop-blur-sm border border-blue-400/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Portal Aktif &bull; Sistem Beroperasi Normal
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }} 👋
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 max-w-2xl leading-relaxed">
                    Kelola keterbukaan informasi publik, tanggapi permohonan masyarakat, serta pantau seluruh publikasi dokumen dan berita PPID Arkan.
                </p>
            </div>

            <!-- Quick Action Buttons -->
            <div class="flex flex-wrap items-center gap-2.5 shrink-0">
                <a href="{{ Route::has('admin.posts.create') ? route('admin.posts.create') : url('/admin/posts/create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-lg shadow-blue-600/30 hover:-translate-y-0.5 transition-all">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Tambah Berita</span>
                </a>
                <a href="{{ Route::has('admin.documents.create') ? route('admin.documents.create') : url('/admin/documents/create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold shadow-lg shadow-indigo-600/30 hover:-translate-y-0.5 transition-all">
                    <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
                    <span>Upload Dokumen</span>
                </a>
                <a href="{{ Route::has('admin.information-requests.index') ? route('admin.information-requests.index') : url('/admin/information-requests') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-800/80 hover:bg-slate-800 text-slate-200 text-xs font-semibold border border-slate-700/80 hover:-translate-y-0.5 transition-all">
                    <i class="fa-solid fa-bell text-xs text-amber-400"></i>
                    <span>Cek Permohonan Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Top Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Card 1: Permohonan Informasi -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-all duration-200 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Permohonan Informasi</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-1">
                        {{ $totalRequests ?? 0 }}
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-sky-400 text-white flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-file-signature text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold {{ ($pendingRequests ?? 0) > 0 ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                    <i class="fa-solid {{ ($pendingRequests ?? 0) > 0 ? 'fa-clock' : 'fa-check' }} text-[10px]"></i>
                    {{ $pendingRequests ?? 0 }} permohonan baru
                </span>
                <a href="{{ Route::has('admin.information-requests.index') ? route('admin.information-requests.index') : url('/admin/information-requests') }}" class="text-blue-600 hover:text-blue-800 font-medium">Lihat &rarr;</a>
            </div>
        </div>

        <!-- Card 2: Pengajuan Keberatan -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-all duration-200 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Pengajuan Keberatan</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-1">
                        {{ $totalObjections ?? 0 }}
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-rose-600 to-amber-500 text-white flex items-center justify-center shadow-lg shadow-rose-500/25 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-scale-balanced text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold {{ ($pendingObjections ?? 0) > 0 ? 'bg-rose-100 text-rose-800' : 'bg-slate-100 text-slate-600' }}">
                    <i class="fa-solid fa-triangle-exclamation text-[10px]"></i>
                    {{ $pendingObjections ?? 0 }} perlu tindak lanjut
                </span>
                <a href="{{ Route::has('admin.objections.index') ? route('admin.objections.index') : url('/admin/objections') }}" class="text-rose-600 hover:text-rose-800 font-medium">Lihat &rarr;</a>
            </div>
        </div>

        <!-- Card 3: Dokumen Publik (DIP) -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-all duration-200 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Dokumen Publik (DIP)</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-1">
                        {{ $totalDocuments ?? 0 }}
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-400 text-white flex items-center justify-center shadow-lg shadow-emerald-500/25 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-folder-tree text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Berkala, Serta Merta & Setiap Saat</span>
                <a href="{{ Route::has('admin.documents.index') ? route('admin.documents.index') : url('/admin/documents') }}" class="text-emerald-600 hover:text-emerald-800 font-medium">Kelola &rarr;</a>
            </div>
        </div>

        <!-- Card 4: Berita & Pengumuman -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm hover:shadow-md transition-all duration-200 relative overflow-hidden group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-slate-500">Berita & Publikasi</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-1">
                        {{ $totalPosts ?? 0 }}
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-500 text-white flex items-center justify-center shadow-lg shadow-purple-500/25 group-hover:scale-105 transition-transform">
                    <i class="fa-solid fa-newspaper text-xl"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>{{ $publishedPosts ?? $totalPosts ?? 0 }} telah dipublikasikan</span>
                <a href="{{ Route::has('admin.posts.index') ? route('admin.posts.index') : url('/admin/posts') }}" class="text-purple-600 hover:text-purple-800 font-medium">Kelola &rarr;</a>
            </div>
        </div>

    </div>

    <!-- Two Columns Layout: Left (Recent Requests) & Right (Recent Objections & Contacts) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Table of 5 Recent Information Requests (lg:col-span-7) -->
        <div class="lg:col-span-7 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-file-signature text-blue-600"></i>
                            Permohonan Informasi Terbaru
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">5 Permohonan informasi publik terakhir dari masyarakat</p>
                    </div>
                    <a href="{{ Route::has('admin.information-requests.index') ? route('admin.information-requests.index') : url('/admin/information-requests') }}" 
                       class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1 transition">
                        <span>Semua Permohonan</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50/80 text-slate-500 font-semibold border-b border-slate-100">
                            <tr>
                                <th class="px-4 py-3">No. Tiket</th>
                                <th class="px-4 py-3">Pemohon</th>
                                <th class="px-4 py-3">Informasi</th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentRequests ?? [] as $req)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="px-4 py-3.5 font-mono font-semibold text-blue-600 whitespace-nowrap">
                                        {{ $req->request_number ?? ('REQ-' . $req->id) }}
                                    </td>
                                    <td class="px-4 py-3.5 font-medium text-slate-800 whitespace-nowrap">
                                        {{ $req->name }}
                                    </td>
                                    <td class="px-4 py-3.5 text-slate-600 max-w-xs truncate" title="{{ $req->information_requested }}">
                                        {{ Str::limit($req->information_requested, 35) }}
                                    </td>
                                    <td class="px-4 py-3.5 text-slate-400 whitespace-nowrap">
                                        {{ $req->created_at ? $req->created_at->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-3.5 whitespace-nowrap">
                                        @php
                                            $st = strtolower($req->status ?? 'pending');
                                        @endphp
                                        @if(in_array($st, ['pending', 'menunggu']))
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                                <i class="fa-solid fa-clock text-[9px]"></i> Menunggu
                                            </span>
                                        @elseif(in_array($st, ['process', 'diproses']))
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                                <i class="fa-solid fa-spinner text-[9px]"></i> Diproses
                                            </span>
                                        @elseif(in_array($st, ['approved', 'selesai', 'diterima', 'granted']))
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-check text-[9px]"></i> Selesai
                                            </span>
                                        @elseif(in_array($st, ['rejected', 'ditolak']))
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-xmark text-[9px]"></i> Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">
                                                {{ ucfirst($req->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                        <a href="{{ Route::has('admin.information-requests.show') ? route('admin.information-requests.show', $req->id) : url('/admin/information-requests/' . $req->id) }}"
                                           class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white font-semibold transition text-[11px]">
                                            <span>Detail</span>
                                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-slate-400">
                                        <i class="fa-solid fa-inbox text-3xl mb-2 text-slate-300 block"></i>
                                        Belum ada permohonan informasi terbaru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Column: Recent Objections & Recent Contacts (lg:col-span-5) -->
        <div class="lg:col-span-5 space-y-6">

            <!-- Card: Recent Objections -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-scale-balanced text-rose-600"></i>
                            Pengajuan Keberatan Terbaru
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Keberatan atas layanan informasi publik</p>
                    </div>
                    <a href="{{ Route::has('admin.objections.index') ? route('admin.objections.index') : url('/admin/objections') }}" 
                       class="text-xs font-semibold text-rose-600 hover:text-rose-800 flex items-center gap-1 transition">
                        <span>Semua</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($recentObjections ?? [] as $obj)
                        <div class="p-4 hover:bg-slate-50/60 transition flex items-start justify-between gap-3">
                            <div class="space-y-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="font-mono text-xs font-bold text-slate-800">{{ $obj->objection_number ?? ('OBJ-' . $obj->id) }}</span>
                                    <span class="text-[10px] px-2 py-0.5 rounded-full font-semibold {{ ($obj->status ?? 'pending') == 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                                        {{ ucfirst($obj->status ?? 'Pending') }}
                                    </span>
                                </div>
                                <p class="text-xs font-medium text-slate-700 truncate">{{ $obj->name }}</p>
                                <p class="text-[11px] text-slate-400 truncate">{{ Str::limit($obj->reason, 45) }}</p>
                            </div>
                            <a href="{{ Route::has('admin.objections.show') ? route('admin.objections.show', $obj->id) : url('/admin/objections/' . $obj->id) }}" 
                               class="shrink-0 p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="Lihat Detail">
                                <i class="fa-solid fa-angle-right text-sm"></i>
                            </a>
                        </div>
                    @empty
                        <div class="p-6 text-center text-slate-400 text-xs">
                            <i class="fa-solid fa-clipboard-check text-2xl mb-1 text-slate-300 block"></i>
                            Tidak ada pengajuan keberatan yang masuk.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Card: Recent Contacts -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-envelope-open-text text-teal-600"></i>
                            Pesan Kontak Masuk
                        </h2>
                        <p class="text-xs text-slate-400 mt-0.5">Pesan pertanyaan & aduan pengunjung</p>
                    </div>
                    <a href="{{ Route::has('admin.contacts.index') ? route('admin.contacts.index') : url('/admin/contacts') }}" 
                       class="text-xs font-semibold text-teal-600 hover:text-teal-800 flex items-center gap-1 transition">
                        <span>Semua</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse(($recentContacts ?? collect()) as $contact)
                        @php
                            // Ambil atribut secara aman agar editor tidak menganggap item sebagai void/non-object.
                            $contactId = data_get($contact, 'id');
                            $contactName = data_get($contact, 'name', 'Pengguna');
                            $contactSubject = data_get($contact, 'subject', '-');
                            $contactIsRead = (bool) data_get($contact, 'is_read', false);
                            $contactCreatedAt = data_get($contact, 'created_at');
                        @endphp

                        <div class="p-4 hover:bg-slate-50/60 transition flex items-start justify-between gap-3">
                            <div class="flex items-start gap-3 min-w-0">
                                <div class="w-8 h-8 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-xs shrink-0 mt-0.5">
                                    {{ strtoupper(substr((string) $contactName, 0, 1)) }}
                                </div>

                                <div class="space-y-0.5 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <p class="text-xs font-bold text-slate-800 truncate">{{ $contactName }}</p>

                                        @if(!$contactIsRead)
                                            <span class="w-2 h-2 rounded-full bg-teal-500 shrink-0" title="Belum dibaca"></span>
                                        @endif
                                    </div>

                                    <p class="text-xs text-slate-600 truncate font-medium">{{ $contactSubject }}</p>

                                    <p class="text-[10px] text-slate-400">
                                        {{ $contactCreatedAt ? $contactCreatedAt->diffForHumans() : '-' }}
                                    </p>
                                </div>
                            </div>

                            @if($contactId)
                                <a href="{{ Route::has('admin.contacts.show') ? route('admin.contacts.show', $contactId) : url('/admin/contacts/' . $contactId) }}"
                                   class="shrink-0 p-2 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-lg transition"
                                   title="Baca Pesan">
                                    <i class="fa-solid fa-envelope-open text-xs"></i>
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="p-6 text-center text-slate-400 text-xs">
                            <i class="fa-solid fa-envelope text-2xl mb-1 text-slate-300 block"></i>
                            Belum ada pesan kontak masuk.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
