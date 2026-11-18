@extends('admin.layouts.app')

@section('title', 'Pengajuan Keberatan')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Pengajuan Keberatan</h1>
        <p class="text-sm text-slate-500 mt-1">Kelola seluruh pengajuan keberatan informasi publik</p>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 mb-5">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">Status</label>
                <select name="status" class="rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending"    {{ request('status')=='pending'    ? 'selected':'' }}>Pending</option>
                    <option value="processing" {{ request('status')=='processing' ? 'selected':'' }}>Diproses</option>
                    <option value="completed"  {{ request('status')=='completed'  ? 'selected':'' }}>Selesai</option>
                    <option value="rejected"   {{ request('status')=='rejected'   ? 'selected':'' }}>Ditolak</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 mb-1">Cari</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama / No. Keberatan..." class="rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-56">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
                <i class="fa-solid fa-filter mr-1"></i> Filter
            </button>
            <a href="{{ route('admin.objections.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 text-sm font-semibold rounded-xl hover:bg-slate-200 transition">Reset</a>
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">No. Keberatan</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pemohon</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">No. Permohonan Asal</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Alasan</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="text-right px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($objections as $obj)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3 font-mono text-xs text-orange-700 font-semibold">{{ $obj->objection_number }}</td>
                        <td class="px-4 py-3">
                            <div class="font-semibold text-slate-800">{{ $obj->name }}</div>
                            <div class="text-xs text-slate-400">{{ $obj->phone ?? '-' }}</div>
                        </td>
                        <td class="px-4 py-3">
                            @if($obj->informationRequest)
                                <a href="{{ route('admin.information-requests.show', $obj->informationRequest->id) }}" class="font-mono text-xs text-blue-600 hover:underline">{{ $obj->informationRequest->request_number }}</a>
                            @else
                                <span class="text-xs text-slate-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 max-w-xs">
                            <p class="truncate text-slate-700 text-xs">{{ Str::limit($obj->reason, 60) }}</p>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $badge = match($obj->status) {
                                    'pending'    => 'bg-yellow-100 text-yellow-700',
                                    'processing' => 'bg-blue-100 text-blue-700',
                                    'completed'  => 'bg-green-100 text-green-700',
                                    'rejected'   => 'bg-red-100 text-red-700',
                                    default      => 'bg-slate-100 text-slate-600',
                                };
                                $label = match($obj->status) {
                                    'pending'    => 'Pending',
                                    'processing' => 'Diproses',
                                    'completed'  => 'Selesai',
                                    'rejected'   => 'Ditolak',
                                    default      => $obj->status,
                                };
                            @endphp
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $badge }}">{{ $label }}</span>
                        </td>
                        <td class="px-4 py-3 text-xs text-slate-500">{{ $obj->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.objections.show', $obj->id) }}" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg hover:bg-blue-100 transition">
                                    <i class="fa-solid fa-eye mr-1"></i> Detail
                                </a>
                                <form action="{{ route('admin.objections.destroy', $obj->id) }}" method="POST" onsubmit="return confirm('Hapus keberatan ini?')">
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
                        <td colspan="7" class="px-4 py-12 text-center text-slate-400">
                            <i class="fa-solid fa-inbox text-3xl mb-3 block"></i>
                            Belum ada pengajuan keberatan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($objections->hasPages())
        <div class="px-4 py-4 border-t border-slate-100">
            {{ $objections->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
