@extends('admin.layouts.app')

@section('title', 'Tambah Foto Galeri Baru')
@section('page_title', 'Tambah Foto Galeri')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ Route::has('admin.galleries.index') ? route('admin.galleries.index') : url('/admin/galleries') }}" 
               class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-800">Tambah Foto Galeri</h1>
                <p class="text-xs text-slate-500">Unggah foto dokumentasi kegiatan layanan informasi publik</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
        <form action="{{ Route::has('admin.galleries.store') ? route('admin.galleries.store') : url('/admin/galleries') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-6">
            @csrf

            <!-- Judul Kegiatan / Foto -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Judul Kegiatan / Keterangan Foto <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title') }}" 
                       required 
                       placeholder="Contoh: Sosialisasi Standar Layanan Informasi Publik Tahun 2024"
                       class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition @error('title') border-rose-400 @enderror">
                @error('title')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Two Columns: Category & Order -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Kategori Kegiatan
                    </label>
                    <input type="text" 
                           name="category" 
                           id="category" 
                           value="{{ old('category', 'Kegiatan PPID') }}" 
                           placeholder="Contoh: Sosialisasi, Rapat Koordinasi, Pelayanan"
                           class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <div>
                    <label for="order" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Urutan Tampilan
                    </label>
                    <input type="number" 
                           name="order" 
                           id="order" 
                           value="{{ old('order', 0) }}" 
                           min="0"
                           class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>

            <!-- Upload File Foto -->
            <div x-data="{ photoName: null, photoPreview: null }">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    File Foto <span class="text-rose-500">*</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-2xl hover:border-blue-400 transition cursor-pointer relative bg-slate-50/50">
                    <input type="file" 
                           name="image" 
                           id="image" 
                           required
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
                            <div class="w-12 h-12 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center mx-auto mb-2">
                                <i class="fa-solid fa-camera-retro text-xl"></i>
                            </div>
                            <div class="text-xs text-slate-600">
                                <span class="font-semibold text-blue-600 hover:text-blue-500">Pilih berkas foto</span> atau seret ke sini
                            </div>
                            <p class="text-[11px] text-slate-400">JPG, JPEG, PNG, WEBP hingga 3MB</p>
                        </div>
                    </div>
                </div>
                @error('image')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi Foto -->
            <div>
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Deskripsi / Catatan Kegiatan
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="3" 
                          placeholder="Keterangan tambahan seputar kegiatan, tanggal pelaksanaan, atau lokasi..."
                          class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('description') }}</textarea>
            </div>

            <!-- Status Aktif Checkbox -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center gap-3">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" 
                       name="is_active" 
                       id="is_active" 
                       value="1" 
                       {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                       class="w-5 h-5 rounded-lg text-blue-600 focus:ring-blue-500 border-slate-300">
                <label for="is_active" class="text-xs font-semibold text-slate-800 cursor-pointer">
                    Aktifkan Foto (Tampilkan di Galeri Publik)
                    <span class="block text-[11px] font-normal text-slate-400">Foto akan dapat dilihat pengunjung di halaman galeri dokumentasi.</span>
                </label>
            </div>

            <!-- Submit & Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ Route::has('admin.galleries.index') ? route('admin.galleries.index') : url('/admin/galleries') }}" 
                   class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-md shadow-blue-500/20 hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Simpan Foto</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
