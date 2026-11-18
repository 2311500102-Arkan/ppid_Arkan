@extends('admin.layouts.app')

@section('title', 'Edit Galeri')

@section('content')
<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Galeri</h1>
            <p class="text-sm text-slate-500 mt-1">Ubah data foto galeri</p>
        </div>
        <a href="{{ route('admin.galleries.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Judul Foto <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $gallery->title) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-400 @enderror" required>
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Kategori</label>
                    <select name="category" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(['Kegiatan', 'Sosialisasi', 'Pelayanan', 'Infografis'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $gallery->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Urutan</label>
                    <input type="number" name="order" value="{{ old('order', $gallery->order) }}" min="0" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $gallery->description) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Saat Ini</label>
                    @if($gallery->image)
                        <div class="mb-3">
                            <img src="{{ Str::startsWith($gallery->image, 'http') ? $gallery->image : asset('storage/' . $gallery->image) }}" class="h-40 w-60 object-cover rounded-xl border border-slate-200">
                        </div>
                    @endif
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Ganti Foto (opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold hover:file:bg-blue-100">
                    @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }} class="w-4 h-4 rounded text-blue-600">
                        <span class="text-sm font-semibold text-slate-700">Aktif / Tampilkan di Website</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.galleries.index') }}" class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
