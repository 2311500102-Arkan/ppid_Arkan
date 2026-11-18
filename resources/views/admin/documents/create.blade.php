@extends('admin.layouts.app')

@section('title', 'Tambah Dokumen Publik (DIP)')
@section('page_title', 'Tambah Dokumen')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header Section -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ Route::has('admin.documents.index') ? route('admin.documents.index') : url('/admin/documents') }}" 
               class="p-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-blue-600 hover:bg-slate-50 transition shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-800">Tambah Dokumen Publik (DIP)</h1>
                <p class="text-xs text-slate-500">Unggah berkas dokumen atau regulasi ke portal PPID</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
        <form action="{{ Route::has('admin.documents.store') ? route('admin.documents.store') : url('/admin/documents') }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-6">
            @csrf

            <!-- Judul Dokumen -->
            <div>
                <label for="title" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Judul Dokumen <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title') }}" 
                       required 
                       placeholder="Contoh: Laporan Keuangan Pemerintah Daerah (LKPD) Tahun 2023"
                       class="w-full px-4 py-3 text-sm rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition @error('title') border-rose-400 bg-rose-50/50 @enderror">
                @error('title')
                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Two Columns: Kategori & Tahun -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="category" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Kategori Informasi <span class="text-rose-500">*</span>
                    </label>
                    <select name="category" 
                            id="category" 
                            required
                            class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition @error('category') border-rose-400 @enderror">
                        <option value="">-- Pilih Kategori Informasi --</option>
                        <option value="berkala" {{ old('category') == 'berkala' ? 'selected' : '' }}>Informasi Berkala</option>
                        <option value="serta-merta" {{ old('category') == 'serta-merta' ? 'selected' : '' }}>Informasi Serta Merta</option>
                        <option value="setiap-saat" {{ old('category') == 'setiap-saat' ? 'selected' : '' }}>Informasi Setiap Saat</option>
                        <option value="dikecualikan" {{ old('category') == 'dikecualikan' ? 'selected' : '' }}>Informasi Dikecualikan</option>
                    </select>
                    @error('category')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="year" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                        Tahun Terbit / Berkas
                    </label>
                    <input type="number" 
                           name="year" 
                           id="year" 
                           value="{{ old('year', date('Y')) }}" 
                           min="2000" 
                           max="{{ date('Y') + 1 }}"
                           class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    @error('year')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi Dokumen -->
            <div>
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Keterangan / Deskripsi Ringkas
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="3" 
                          placeholder="Penjelasan ringkas mengenai dokumen, nomor peraturan, atau ringkasan isi..."
                          class="w-full px-4 py-2.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('description') }}</textarea>
            </div>

            <!-- File Upload -->
            <div x-data="{ fileName: null }">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                    Berkas Dokumen (PDF, DOCX, XLSX) <span class="text-rose-500">*</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-2xl hover:border-blue-400 transition cursor-pointer relative bg-slate-50/50">
                    <input type="file" 
                           name="file" 
                           id="file" 
                           required
                           accept=".pdf,.doc,.docx,.xls,.xlsx"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                           @change="if ($event.target.files.length) { fileName = $event.target.files[0].name }">
                    <div class="text-center space-y-2">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto mb-2">
                            <i class="fa-solid fa-file-arrow-up text-xl"></i>
                        </div>
                        <template x-if="fileName">
                            <p class="text-xs font-bold text-blue-600" x-text="fileName"></p>
                        </template>
                        <template x-if="!fileName">
                            <div class="text-xs text-slate-600">
                                <span class="font-semibold text-blue-600 hover:text-blue-500">Pilih berkas dokumen</span> untuk diunggah
                            </div>
                        </template>
                        <p class="text-[11px] text-slate-400">Format yang didukung: PDF, DOC, DOCX, XLS, XLSX (Maks. 20MB)</p>
                    </div>
                </div>
                @error('file')
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
                    Status Aktif (Tampilkan di Daftar Informasi Publik)
                    <span class="block text-[11px] font-normal text-slate-400">Dokumen akan langsung dapat diunduh oleh publik.</span>
                </label>
            </div>

            <!-- Submit & Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ Route::has('admin.documents.index') ? route('admin.documents.index') : url('/admin/documents') }}" 
                   class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-md shadow-blue-500/20 hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Simpan Dokumen</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
