@extends('admin.layouts.app')

@section('title', 'Edit Banner: ' . $banner->title)
@section('page_title', 'Edit Banner')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ Route::has('admin.banners.index') ? route('admin.banners.index') : url('/admin/banners') }}" 
               class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-800">Edit Banner Slider</h1>
                <p class="text-xs text-slate-500">Perbarui judul, gambar slider, atau link tautan</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
        <form action="{{ Route::has('admin.banners.update') ? route('admin.banners.update', $banner->id) : url('/admin/banners/' . $banner->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul Banner -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Judul Banner <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title', $banner->title) }}" 
                       required 
                       class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition @error('title') border-rose-400 @enderror">
                @error('title')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subtitle Banner -->
            <div>
                <label for="subtitle" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Subtitle / Keterangan Singkat
                </label>
                <input type="text" 
                       name="subtitle" 
                       id="subtitle" 
                       value="{{ old('subtitle', $banner->subtitle) }}" 
                       class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>

            <!-- Upload File Gambar & Preview Saat Ini -->
            <div x-data="{ photoName: null, photoPreview: null }">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Gambar Banner
                </label>

                <!-- Current Image Preview -->
                @if($banner->image)
                    <div class="mb-4 p-3 bg-slate-50 border border-slate-200 rounded-2xl flex items-center gap-4">
                        <img src="{{ Str::startsWith($banner->image, ['http://', 'https://']) ? $banner->image : asset('storage/' . $banner->image) }}" 
                             alt="{{ $banner->title }}" 
                             class="w-32 h-16 object-cover rounded-xl border border-slate-200 shadow-sm">
                        <div>
                            <p class="text-xs font-bold text-slate-800">Banner Saat Ini</p>
                            <p class="text-[11px] text-slate-400">Pilih file baru di bawah ini jika ingin mengganti gambar banner.</p>
                        </div>
                    </div>
                @endif

                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-2xl hover:border-blue-400 transition cursor-pointer relative bg-slate-50/50">
                    <input type="file" 
                           name="image" 
                           id="image" 
                           accept="image/*"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                           @change="
                               const file = $event.target.files[0];
                               if (file) {
                                   photoName = file.name;
                                   const reader = new FileReader();
                                   reader.onload = (e) => { photoPreview = e.target.result; };
                                   reader.readAsDataURL(file);
                               }
                           ">
                    <div class="text-center space-y-2">
                        <template x-if="photoPreview">
                            <div class="mb-3">
                                <img :src="photoPreview" class="max-h-48 mx-auto rounded-xl shadow-md border border-slate-200">
                                <p class="text-xs text-blue-600 font-medium mt-2" x-text="photoName"></p>
                            </div>
                        </template>

                        <div x-show="!photoPreview">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-2">
                                <i class="fa-solid fa-image text-xl"></i>
                            </div>
                            <div class="text-xs text-slate-600">
                                <span class="font-semibold text-blue-600 hover:text-blue-500">Pilih gambar baru</span> untuk mengganti banner
                            </div>
                            <p class="text-[11px] text-slate-400">Biarkan kosong jika tetap menggunakan gambar saat ini.</p>
                        </div>
                    </div>
                </div>
                @error('image')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Two Columns: Link & Order -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="link" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        URL Tautan / Tombol Aksi (Opsional)
                    </label>
                    <input type="text" 
                           name="link" 
                           id="link" 
                           value="{{ old('link', $banner->link) }}" 
                           class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <div>
                    <label for="order" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Urutan Tampilan
                    </label>
                    <input type="number" 
                           name="order" 
                           id="order" 
                           value="{{ old('order', $banner->order) }}" 
                           min="0"
                           class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>

            <!-- Status Aktif Checkbox -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" 
                       name="is_active" 
                       id="is_active" 
                       value="1" 
                       {{ old('is_active', $banner->is_active) ? 'checked' : '' }}
                       class="w-5 h-5 rounded-lg text-blue-600 focus:ring-blue-500 border-slate-300">
                <label for="is_active" class="text-xs font-semibold text-slate-800 cursor-pointer">
                    Aktifkan Banner Slider
                    <span class="block text-[11px] font-normal text-slate-400">Banner akan tampil pada slider halaman depan.</span>
                </label>
            </div>

            <!-- Submit & Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ Route::has('admin.banners.index') ? route('admin.banners.index') : url('/admin/banners') }}" 
                   class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-md shadow-blue-500/20 hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
