@extends('admin.layouts.app')

@section('title', 'Edit Berita: ' . $post->title)
@section('page_title', 'Edit Berita')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ Route::has('admin.posts.index') ? route('admin.posts.index') : url('/admin/posts') }}" 
               class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-800">Edit Berita</h1>
                <p class="text-xs text-slate-500">Perbarui konten informasi atau status publikasi</p>
            </div>
        </div>
        <a href="{{ url('/berita/' . $post->slug) }}" target="_blank" 
           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition shadow-sm">
            <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
            <span class="hidden sm:inline">Pratinjau di Web</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
        <form action="{{ Route::has('admin.posts.update') ? route('admin.posts.update', $post->id) : url('/admin/posts/' . $post->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul Berita -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Judul Berita / Artikel <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title', $post->title) }}" 
                       required 
                       class="w-full px-4 py-3 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('title') border-rose-400 bg-rose-50/50 @enderror">
                @error('title')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Two Columns: Kategori & Penulis -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Kategori <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" 
                            id="category" 
                            required
                            class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition @error('category') border-rose-400 @enderror">
                        <option value="berita" {{ old('category', $post->category) == 'berita' ? 'selected' : '' }}>Berita</option>
                        <option value="pengumuman" {{ old('category', $post->category) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="siaran-pers" {{ old('category', $post->category) == 'siaran-pers' ? 'selected' : '' }}>Siaran Pers</option>
                        <option value="artikel" {{ old('category', $post->category) == 'artikel' ? 'selected' : '' }}>Artikel</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="author" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Penulis / Sumber
                    </label>
                    <input type="text" 
                           name="author" 
                           id="author" 
                           value="{{ old('author', $post->author) }}" 
                           class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('author')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Excerpt / Ringkasan -->
            <div>
                <label for="excerpt" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Ringkasan Berita (Excerpt)
                </label>
                <textarea name="excerpt" 
                          id="excerpt" 
                          rows="3" 
                          class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>

            <!-- Konten Lengkap -->
            <div>
                <label for="content" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Isi Konten Berita <span class="text-rose-500">*</span>
                </label>
                <textarea name="content" 
                          id="content" 
                          rows="12" 
                          required 
                          class="w-full px-4 py-3 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition font-sans leading-relaxed @error('content') border-rose-400 bg-rose-50/50 @enderror">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar Utama & Current Preview -->
            <div x-data="{ photoName: null, photoPreview: null }">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Gambar Utama (Thumbnail / Featured Image)
                </label>

                <!-- Current Image Preview -->
                @if($post->image)
                    <div class="mb-4 p-3 bg-slate-50 border border-slate-200 rounded-2xl flex items-center gap-4">
                        <img src="{{ Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('storage/' . $post->image) }}" 
                             alt="{{ $post->title }}" 
                             class="w-20 h-20 object-cover rounded-xl border border-slate-200 shadow-sm">
                        <div>
                            <p class="text-xs font-bold text-slate-800">Foto Saat Ini</p>
                            <p class="text-[11px] text-slate-400">Pilih file baru di bawah ini jika ingin mengganti foto saat ini.</p>
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
                        <!-- Image Preview if newly selected -->
                        <template x-if="photoPreview">
                            <div class="mb-3">
                                <img :src="photoPreview" class="max-h-48 mx-auto rounded-xl shadow-md border border-slate-200">
                                <p class="text-xs text-blue-600 font-medium mt-2" x-text="photoName"></p>
                            </div>
                        </template>

                        <div x-show="!photoPreview">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-2">
                                <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                            </div>
                            <div class="text-xs text-slate-600">
                                <span class="font-semibold text-blue-600 hover:text-blue-500">Klik untuk ganti foto</span> atau seret file ke sini
                            </div>
                            <p class="text-[11px] text-slate-400">PNG, JPG, JPEG, WEBP hingga 2MB (Biarkan kosong jika tidak diganti)</p>
                        </div>
                    </div>
                </div>
                @error('image')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Publikasi Checkbox -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center gap-3">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" 
                       name="is_published" 
                       id="is_published" 
                       value="1" 
                       {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                       class="w-5 h-5 rounded-lg text-blue-600 focus:ring-blue-500 border-slate-300">
                <label for="is_published" class="text-xs font-semibold text-slate-800 cursor-pointer">
                    Publikasikan Berita (Status: Published)
                    <span class="block text-[11px] font-normal text-slate-400">Hapus centang untuk mengalihkan ke status Draft.</span>
                </label>
            </div>

            <!-- Submit & Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ Route::has('admin.posts.index') ? route('admin.posts.index') : url('/admin/posts') }}" 
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
