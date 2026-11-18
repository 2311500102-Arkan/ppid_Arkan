@extends('admin.layouts.app')

@section('title', 'Galeri Foto & Dokumentasi')
@section('page_title', 'Galeri Foto')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-800">Galeri Foto & Dokumentasi</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Kelola dokumentasi visual kegiatan sosialisasi, rapat, dan layanan PPID.</p>
        </div>
        <a href="{{ Route::has('admin.galleries.create') ? route('admin.galleries.create') : url('/admin/galleries/create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs shadow-md shadow-blue-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all self-start sm:self-auto">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Foto Baru</span>
        </a>
    </div>

    <!-- Gallery Grid Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($galleries ?? [] as $gallery)
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition">
                
                <!-- Image Container -->
                <div class="relative aspect-video bg-slate-900 overflow-hidden">
                    <img src="{{ Str::startsWith($gallery->image, ['http://', 'https://']) ? $gallery->image : asset('storage/' . $gallery->image) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent"></div>

                    <!-- Category Badge -->
                    <div class="absolute top-2.5 left-2.5">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-navy-950/80 text-white backdrop-blur-sm">
                            {{ $gallery->category ?? 'Kegiatan' }}
                        </span>
                    </div>

                    <!-- Status Indicator -->
                    <div class="absolute top-2.5 right-2.5">
                        @if($gallery->is_active)
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 block shadow" title="Aktif"></span>
                        @else
                            <span class="w-2.5 h-2.5 rounded-full bg-slate-400 block shadow" title="Nonaktif"></span>
                        @endif
                    </div>
                </div>

                <!-- Content & Actions -->
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-slate-800 text-xs line-clamp-2" title="{{ $gallery->title }}">
                            {{ $gallery->title }}
                        </h3>
                        @if($gallery->description)
                            <p class="text-[11px] text-slate-400 line-clamp-2 mt-1">{{ $gallery->description }}</p>
                        @endif
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-[10px] text-slate-400 font-mono">Urutan: {{ $gallery->order ?? 0 }}</span>
                        <div class="flex items-center gap-1.5">
                            <a href="{{ Route::has('admin.galleries.edit') ? route('admin.galleries.edit', $gallery->id) : url('/admin/galleries/' . $gallery->id . '/edit') }}" 
                               class="p-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition" 
                               title="Edit Foto">
                                <i class="fa-solid fa-pen-to-square text-[11px]"></i>
                            </a>
                            <form action="{{ Route::has('admin.galleries.destroy') ? route('admin.galleries.destroy', $gallery->id) : url('/admin/galleries/' . $gallery->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-1.5 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition" 
                                        title="Hapus Foto">
                                    <i class="fa-solid fa-trash-can text-[11px]"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl border border-slate-200/80 p-12 text-center text-slate-400 shadow-sm">
                <i class="fa-solid fa-camera-retro text-4xl mb-3 text-slate-300 block"></i>
                <p class="font-medium text-slate-600">Belum ada foto galeri.</p>
                <p class="text-xs text-slate-400 mt-1">Unggah dokumentasi foto kegiatan PPID.</p>
                <div class="mt-4">
                    <a href="{{ Route::has('admin.galleries.create') ? route('admin.galleries.create') : url('/admin/galleries/create') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold hover:bg-blue-500 transition">
                        <i class="fa-solid fa-plus text-xs"></i> Tambah Foto Baru
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    @if(isset($galleries) && method_exists($galleries, 'links'))
        <div class="p-4 bg-white rounded-2xl border border-slate-200/80 shadow-sm">
            {{ $galleries->links() }}
        </div>
    @endif

</div>
@endsection
