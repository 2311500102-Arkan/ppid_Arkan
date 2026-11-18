@extends('admin.layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="p-6 max-w-2xl">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Profil Saya</h1>
        <p class="text-sm text-slate-500 mt-1">Perbarui data akun dan kata sandi</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        {{-- Avatar --}}
        <div class="flex items-center gap-5 pb-6 mb-6 border-b border-slate-100">
            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center text-white text-2xl font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-slate-500">{{ auth()->user()->email }}</p>
                <span class="text-xs bg-blue-100 text-blue-700 font-semibold px-2 py-0.5 rounded-full mt-1 inline-block">Administrator</span>
            </div>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf @method('PUT')

            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror" required>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 @enderror" required>
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Ubah Kata Sandi <span class="normal-case font-normal">(kosongkan jika tidak ingin mengubah)</span></p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Kata Sandi Baru</label>
                            <input type="password" name="password" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-400 @enderror" placeholder="Min. 8 karakter">
                            @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ulangi kata sandi baru">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
