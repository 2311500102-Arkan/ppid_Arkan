@extends('admin.layouts.app')

@section('title', 'Manajemen Berita & Artikel')
@section('page_title', 'Berita / Post')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-800">Manajemen Berita & Artikel</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Publikasikan dan perbarui informasi, pengumuman, dan siaran pers PPID.</p>
        </div>
        <a href="{{ Route::has('admin.posts.create') ? route('admin.posts.create') : url('/admin/posts/create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 hover:-translate-y-0.5 transition-all self-start sm:self-auto">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Berita Baru</span>
        </a>
    </div>

    <!-- Filter & Search Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-sm">
        <form action="{{ Route::has('admin.posts.index') ? route('admin.posts.index') : url('/admin/posts') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3">
            <!-- Search Keyword -->
            <div class="relative flex-1 w-full">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" 
                       name="q" 
                       value="{{ request('q') }}" 
                       placeholder="Cari berdasarkan judul atau penulis..." 
                       class="w-full pl-9 pr-4 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <!-- Category Filter -->
            <div class="w-full md:w-48">
                <select name="category" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">Semua Kategori</option>
                    <option value="berita" {{ request('category') == 'berita' ? 'selected' : '' }}>Berita</option>
                    <option value="pengumuman" {{ request('category') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="siaran-pers" {{ request('category') == 'siaran-pers' ? 'selected' : '' }}>Siaran Pers</option>
                    <option value="artikel" {{ request('category') == 'artikel' ? 'selected' : '' }}>Artikel</option>
                </select>
            </div>

            <!-- Status Filter -->
            <div class="w-full md:w-40">
                <select name="status" class="w-full px-3 py-2 rounded-xl text-xs bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="w-full md:w-auto px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold rounded-xl transition">
                    Filter
                </button>
                @if(request()->hasAny(['q', 'category', 'status']))
                    <a href="{{ Route::has('admin.posts.index') ? route('admin.posts.index') : url('/admin/posts') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-medium rounded-xl transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Posts Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50/80 text-slate-500 font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="px-4 py-3.5 w-16">Foto</th>
                        <th class="px-4 py-3.5">Judul Berita</th>
                        <th class="px-4 py-3.5">Kategori</th>
                        <th class="px-4 py-3.5">Penulis</th>
                        <th class="px-4 py-3.5">Status</th>
                        <th class="px-4 py-3.5 text-center">Dilihat</th>
                        <th class="px-4 py-3.5">Tanggal</th>
                        <th class="px-4 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($posts ?? [] as $post)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($post->image)
                                    <img src="{{ Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('storage/' . $post->image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-12 h-12 object-cover rounded-xl border border-slate-200 shadow-sm">
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400">
                                        <i class="fa-solid fa-image text-base"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 max-w-xs">
                                <a href="{{ Route::has('admin.posts.edit') ? route('admin.posts.edit', $post->id) : url('/admin/posts/' . $post->id . '/edit') }}" 
                                   class="font-bold text-slate-800 hover:text-blue-600 transition line-clamp-2">
                                    {{ $post->title }}
                                </a>
                                <span class="text-[11px] text-slate-400 mt-0.5 block font-mono">/berita/{{ $post->slug }}</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-700">
                                    {{ $post->category ?? 'Berita' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-slate-600 whitespace-nowrap">
                                {{ $post->author ?? 'Admin' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($post->is_published)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center text-slate-500 font-mono whitespace-nowrap">
                                <i class="fa-solid fa-eye text-[10px] text-slate-400 mr-1"></i>
                                {{ number_format($post->view_count ?? 0) }}
                            </td>
                            <td class="px-4 py-3 text-slate-400 whitespace-nowrap">
                                {{ $post->created_at ? $post->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="px-4 py-3 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <!-- Edit Button -->
                                    <a href="{{ Route::has('admin.posts.edit') ? route('admin.posts.edit', $post->id) : url('/admin/posts/' . $post->id . '/edit') }}" 
                                       class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition" 
                                       title="Edit Berita">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ Route::has('admin.posts.destroy') ? route('admin.posts.destroy', $post->id) : url('/admin/posts/' . $post->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition" 
                                                title="Hapus Berita">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center text-slate-400">
                                <i class="fa-solid fa-newspaper text-3xl mb-2 text-slate-300 block"></i>
                                Belum ada berita yang tersedia. Silakan klik "Tambah Berita Baru".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($posts) && method_exists($posts, 'links'))
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
