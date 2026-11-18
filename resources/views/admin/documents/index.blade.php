@extends('admin.layouts.app')

@section('title', 'Daftar Informasi Publik (DIP) & Dokumen')
@section('page_title', 'Dokumen Publik (DIP)')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-800">Daftar Informasi Publik (DIP)</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Kelola arsip dokumen publik berkala, serta-merta, dan setiap-saat.</p>
        </div>
        <a href="{{ Route::has('admin.documents.create') ? route('admin.documents.create') : url('/admin/documents/create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs shadow-md shadow-blue-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all self-start sm:self-auto">
            <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
            <span>Tambah Dokumen Baru</span>
        </a>
    </div>

    <!-- Filter & Search Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-sm">
        <form action="{{ Route::has('admin.documents.index') ? route('admin.documents.index') : url('/admin/documents') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3">
            <!-- Search Keyword -->
            <div class="relative flex-1 w-full">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" 
                       name="q" 
                       value="{{ request('q') }}" 
                       placeholder="Cari judul dokumen atau deskripsi..." 
                       class="w-full pl-9 pr-4 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <!-- Category Filter -->
            <div class="w-full md:w-52">
                <select name="category" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">Semua Kategori</option>
                    <option value="berkala" {{ request('category') == 'berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                    <option value="serta-merta" {{ request('category') == 'serta-merta' ? 'selected' : '' }}>Informasi Serta Merta</option>
                    <option value="setiap-saat" {{ request('category') == 'setiap-saat' ? 'selected' : '' }}>Informasi Setiap Saat</option>
                </select>
            </div>

            <!-- Year Filter -->
            <div class="w-full md:w-36">
                <select name="year" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">Semua Tahun</option>
                    @for($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold rounded-xl transition">
                    Filter
                </button>
                @if(request()->hasAny(['q', 'category', 'year']))
                    <a href="{{ Route::has('admin.documents.index') ? route('admin.documents.index') : url('/admin/documents') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-medium rounded-xl transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Documents Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50/80 text-slate-500 font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="px-4 py-3.5 w-12 text-center">#</th>
                        <th class="px-4 py-3.5">Judul Dokumen</th>
                        <th class="px-4 py-3.5">Kategori</th>
                        <th class="px-4 py-3.5 text-center">Tahun</th>
                        <th class="px-4 py-3.5 text-center">Unduhan</th>
                        <th class="px-4 py-3.5">Status</th>
                        <th class="px-4 py-3.5">Tanggal</th>
                        <th class="px-4 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($documents ?? [] as $index => $doc)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-4 py-3.5 text-center text-slate-400 font-mono">
                                {{ (isset($documents) && method_exists($documents, 'firstItem') ? $documents->firstItem() + $index : $index + 1) }}
                            </td>
                            <td class="px-4 py-3.5 max-w-sm">
                                <a href="{{ Route::has('admin.documents.edit') ? route('admin.documents.edit', $doc->id) : url('/admin/documents/' . $doc->id . '/edit') }}" 
                                   class="font-bold text-slate-800 hover:text-blue-600 transition block">
                                    {{ $doc->title }}
                                </a>
                                @if($doc->description)
                                    <p class="text-[11px] text-slate-400 truncate mt-0.5">{{ $doc->description }}</p>
                                @endif
                                <div class="mt-1 flex items-center gap-2">
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" 
                                       class="inline-flex items-center gap-1 text-[10px] text-blue-600 hover:underline">
                                        <i class="fa-solid fa-file-pdf text-red-500"></i>
                                        <span>Lihat File</span>
                                    </a>
                                </div>
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                @php
                                    $cat = strtolower($doc->category ?? '');
                                @endphp
                                @if($cat == 'berkala')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">
                                        Berkala
                                    </span>
                                @elseif($cat == 'serta-merta')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                        Serta Merta
                                    </span>
                                @elseif($cat == 'setiap-saat')
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        Setiap Saat
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">
                                        {{ ucfirst($doc->category ?? '-') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-center font-mono text-slate-600 whitespace-nowrap">
                                {{ $doc->year ?? '-' }}
                            </td>
                            <td class="px-4 py-3.5 text-center font-mono text-slate-600 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg bg-slate-100 text-[11px]">
                                    <i class="fa-solid fa-download text-[9px] text-slate-400"></i>
                                    {{ number_format($doc->download_count ?? 0) }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                @if($doc->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-slate-400 whitespace-nowrap">
                                {{ $doc->created_at ? $doc->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <!-- Edit Button -->
                                    <a href="{{ Route::has('admin.documents.edit') ? route('admin.documents.edit', $doc->id) : url('/admin/documents/' . $doc->id . '/edit') }}" 
                                       class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition" 
                                       title="Edit Dokumen">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ Route::has('admin.documents.destroy') ? route('admin.documents.destroy', $doc->id) : url('/admin/documents/' . $doc->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition" 
                                                title="Hapus Dokumen">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center text-slate-400">
                                <i class="fa-solid fa-folder-open text-3xl mb-2 text-slate-300 block"></i>
                                Belum ada dokumen publik yang tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($documents) && method_exists($documents, 'links'))
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $documents->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
