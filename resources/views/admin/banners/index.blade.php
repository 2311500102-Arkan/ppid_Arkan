@extends('admin.layouts.app')

@section('title', 'Manajemen Banner Slider Beranda')
@section('page_title', 'Banner Slider')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-800">Banner Slider Beranda</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Atur slider banner utama yang tampil pada halaman depan website.</p>
        </div>
        <a href="{{ Route::has('admin.banners.create') ? route('admin.banners.create') : url('/admin/banners/create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs shadow-md shadow-blue-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all self-start sm:self-auto">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Banner Baru</span>
        </a>
    </div>

    <!-- Banner Grid Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($banners ?? [] as $banner)
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col group hover:shadow-md transition">
                
                <!-- Banner Image Preview -->
                <div class="relative h-44 bg-slate-900 overflow-hidden">
                    <img src="{{ Str::startsWith($banner->image, ['http://', 'https://']) ? $banner->image : asset('storage/' . $banner->image) }}" 
                         alt="{{ $banner->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>

                    <!-- Badges -->
                    <div class="absolute top-3 left-3 flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-navy-950/80 text-white backdrop-blur-sm border border-white/20">
                            Urutan: {{ $banner->order ?? 0 }}
                        </span>
                        @if($banner->is_active)
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/90 text-white backdrop-blur-sm">
                                Aktif
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-600/90 text-slate-200 backdrop-blur-sm">
                                Nonaktif
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Banner Content -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div class="space-y-1.5">
                        <h3 class="font-bold text-slate-800 text-sm line-clamp-1" title="{{ $banner->title }}">
                            {{ $banner->title }}
                        </h3>
                        @if($banner->subtitle)
                            <p class="text-xs text-slate-500 line-clamp-2">{{ $banner->subtitle }}</p>
                        @endif
                        @if($banner->link)
                            <a href="{{ $banner->link }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] text-blue-600 hover:underline mt-1 truncate max-w-full">
                                <i class="fa-solid fa-link text-[10px]"></i>
                                <span>{{ $banner->link }}</span>
                            </a>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[10px] text-slate-400">
                            {{ $banner->created_at ? $banner->created_at->format('d M Y') : '' }}
                        </span>
                        <div class="flex items-center gap-1.5">
                            <a href="{{ Route::has('admin.banners.edit') ? route('admin.banners.edit', $banner->id) : url('/admin/banners/' . $banner->id . '/edit') }}" 
                               class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition" 
                               title="Edit Banner">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </a>
                            <form action="{{ Route::has('admin.banners.destroy') ? route('admin.banners.destroy', $banner->id) : url('/admin/banners/' . $banner->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition" 
                                        title="Hapus Banner">
                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl border border-slate-200/80 p-12 text-center text-slate-400 shadow-sm">
                <i class="fa-solid fa-images text-4xl mb-3 text-slate-300 block"></i>
                <p class="font-medium text-slate-600">Belum ada banner slider.</p>
                <p class="text-xs text-slate-400 mt-1">Tambahkan banner untuk mempercantik beranda portal PPID.</p>
                <div class="mt-4">
                    <a href="{{ Route::has('admin.banners.create') ? route('admin.banners.create') : url('/admin/banners/create') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 text-white text-xs font-semibold hover:bg-blue-500 transition">
                        <i class="fa-solid fa-plus text-xs"></i> Tambah Banner
                    </a>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection
