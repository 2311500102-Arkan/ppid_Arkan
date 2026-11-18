@extends('admin.layouts.app')

@section('title', 'Pesan Kontak')

@section('content')
<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Pesan Kontak</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola pesan masuk dari pengunjung website</p>
        </div>
        @php $unread = $contacts->where('is_read', false)->count(); @endphp
        @if($unread > 0)
        <span class="px-3 py-1.5 bg-red-100 text-red-700 text-sm font-bold rounded-full">{{ $unread }} Belum Dibaca</span>
        @endif
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider w-4"></th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pengirim</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Subjek</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pesan</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="text-right px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($contacts as $contact)
                    <tr class="{{ !$contact->is_read ? 'bg-blue-50/40' : '' }} hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            @if(!$contact->is_read)
                                <span class="w-2 h-2 bg-blue-500 rounded-full block"></span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-semibold {{ !$contact->is_read ? 'text-slate-900' : 'text-slate-700' }}">{{ $contact->name }}</div>
                            <div class="text-xs text-slate-400">{{ $contact->email }}</div>
                        </td>
                        <td class="px-4 py-3 font-medium {{ !$contact->is_read ? 'text-slate-800' : 'text-slate-600' }}">{{ $contact->subject }}</td>
                        <td class="px-4 py-3 max-w-xs">
                            <p class="truncate text-slate-500 text-xs">{{ Str::limit($contact->message, 80) }}</p>
                        </td>
                        <td class="px-4 py-3 text-xs text-slate-500">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg hover:bg-blue-100 transition">
                                    <i class="fa-solid fa-eye mr-1"></i> Baca
                                </a>
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-100 transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-slate-400">
                            <i class="fa-solid fa-envelope-open text-3xl mb-3 block"></i>
                            Tidak ada pesan masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($contacts->hasPages())
        <div class="px-4 py-4 border-t border-slate-100">
            {{ $contacts->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
