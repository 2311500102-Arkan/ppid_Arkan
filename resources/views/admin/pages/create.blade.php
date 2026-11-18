@extends('admin.layouts.app')

@section('title', 'Tambah Halaman Statis Baru')
@section('page_title', 'Tambah Halaman')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ Route::has('admin.pages.index') ? route('admin.pages.index') : url('/admin/pages') }}" 
               class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-800">Tambah Halaman Statis</h1>
                <p class="text-xs text-slate-500">Buat halaman profil, SOP, maklumat informasi, atau informasi kelembagaan</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
        <form action="{{ Route::has('admin.pages.store') ? route('admin.pages.store') : url('/admin/pages') }}" 
              method="POST" 
              class="space-y-6">
            @csrf

            <!-- Two Columns: Title & Slug -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Judul Halaman <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}" 
                           required 
                           placeholder="Contoh: Visi dan Misi PPID"
                           class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition @error('title') border-rose-400 @enderror">
                    @error('title')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Slug URL <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs text-slate-400 font-mono">/page/</span>
                        <input type="text" 
                               name="slug" 
                               id="slug" 
                               value="{{ old('slug') }}" 
                               required 
                               placeholder="visi-misi-ppid"
                               class="w-full pl-16 pr-4 py-2.5 text-xs font-mono rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition @error('slug') border-rose-400 @enderror">
                    </div>
                    @error('slug')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Two Columns: Category & Order -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Kategori Halaman
                    </label>
                    <select name="category" 
                            id="category" 
                            class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition">
                        <option value="profil" {{ old('category') == 'profil' ? 'selected' : '' }}>Profil Organisasi / PPID</option>
                        <option value="layanan" {{ old('category') == 'layanan' ? 'selected' : '' }}>Layanan & Standar Prosedur</option>
                        <option value="regulasi" {{ old('category') == 'regulasi' ? 'selected' : '' }}>Regulasi / Dasar Hukum</option>
                        <option value="laporan" {{ old('category') == 'laporan' ? 'selected' : '' }}>Laporan & Evaluasi</option>
                        <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya / Umum</option>
                    </select>
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

            <!-- Konten Lengkap -->
            <div>
                <label for="content" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Isi Konten Halaman (HTML / Teks) <span class="text-rose-500">*</span>
                </label>
                <textarea name="content" 
                          id="content" 
                          rows="14" 
                          required 
                          placeholder="Masukkan isi konten artikel atau halaman statis secara detail..."
                          class="w-full px-4 py-3 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition font-sans leading-relaxed @error('content') border-rose-400 bg-rose-50/50 @enderror">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
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
                    Aktifkan Halaman (Tampilkan ke Publik)
                    <span class="block text-[11px] font-normal text-slate-400">Halaman dapat diakses melalui URL slug yang telah ditentukan.</span>
                </label>
            </div>

            <!-- Submit & Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ Route::has('admin.pages.index') ? route('admin.pages.index') : url('/admin/pages') }}" 
                   class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-md shadow-blue-500/20 hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Simpan Halaman</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
