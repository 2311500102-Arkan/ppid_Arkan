@extends('admin.layouts.app')

@section('title', 'Baca Pesan')

@section('content')
<div class="p-6 max-w-3xl">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Baca Pesan</h1>
        </div>
        <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <div class="flex items-start justify-between mb-6 pb-4 border-b border-slate-100">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white text-lg font-bold">
                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="font-bold text-slate-800">{{ $contact->name }}</h2>
                    <a href="mailto:{{ $contact->email }}" class="text-sm text-blue-600 hover:underline">{{ $contact->email }}</a>
                </div>
            </div>
            <p class="text-xs text-slate-400">{{ $contact->created_at->format('d M Y, H:i') }}</p>
        </div>

        <div class="mb-4">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Subjek</p>
            <p class="text-lg font-bold text-slate-800">{{ $contact->subject }}</p>
        </div>

        <div class="mb-6">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Pesan</p>
            <div class="text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50 rounded-xl p-4 text-sm">{{ $contact->message }}</div>
        </div>

        <div class="flex gap-3 pt-4 border-t border-slate-100">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                <i class="fa-solid fa-reply"></i> Balas via Email
            </a>
            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini secara permanen?')">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 text-sm font-semibold rounded-xl transition">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
