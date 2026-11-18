@extends('admin.layouts.app')

@section('title', 'Detail Permohonan Informasi')

@section('content')
<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Detail Permohonan</h1>
            <p class="text-sm text-slate-500 mt-1">No. Tiket: <span class="font-mono font-semibold text-blue-700">{{ $informationRequest->request_number }}</span></p>
        </div>
        <a href="{{ route('admin.information-requests.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Detail --}}
        <div class="lg:col-span-2 space-y-5">
            {{-- Applicant Data --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-user text-blue-600"></i> Data Pemohon
                </h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</dt>
                        <dd class="font-semibold text-slate-800">{{ $informationRequest->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">NIK</dt>
                        <dd class="font-mono text-slate-700">{{ $informationRequest->nik }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">No. HP / WA</dt>
                        <dd class="text-slate-700">{{ $informationRequest->phone ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Email</dt>
                        <dd class="text-slate-700">{{ $informationRequest->email ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Pekerjaan</dt>
                        <dd class="text-slate-700">{{ $informationRequest->occupation ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Cara Memperoleh</dt>
                        <dd><span class="capitalize text-xs bg-slate-100 text-slate-700 px-2 py-1 rounded-lg">{{ $informationRequest->how_to_get }}</span></dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Alamat</dt>
                        <dd class="text-slate-700">{{ $informationRequest->address }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Information Requested --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-file-lines text-blue-600"></i> Informasi yang Diminta
                </h2>
                <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50 rounded-xl p-4">{{ $informationRequest->information_requested }}</div>
            </div>

            {{-- Purpose --}}
            @if($informationRequest->purpose)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-bullseye text-blue-600"></i> Tujuan Penggunaan
                </h2>
                <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line bg-slate-50 rounded-xl p-4">{{ $informationRequest->purpose }}</div>
            </div>
            @endif

            {{-- Related Objections --}}
            @if($informationRequest->objections && $informationRequest->objections->count() > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-yellow-500"></i> Keberatan Terkait
                </h2>
                @foreach($informationRequest->objections as $obj)
                <div class="border border-yellow-100 bg-yellow-50 rounded-xl p-4 mb-3 last:mb-0">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-mono text-xs font-semibold text-yellow-700">{{ $obj->objection_number }}</span>
                        <span class="text-xs text-slate-500">{{ $obj->created_at->format('d/m/Y') }}</span>
                    </div>
                    <p class="text-sm text-slate-700">{{ Str::limit($obj->reason, 150) }}</p>
                    <a href="{{ route('admin.objections.show', $obj->id) }}" class="text-xs text-blue-600 font-semibold mt-2 inline-block hover:underline">Lihat Detail →</a>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Sidebar: Status & Response --}}
        <div class="space-y-5">
            {{-- Current Status --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4">Status Permohonan</h2>
                @php
                    $badge = match($informationRequest->status) {
                        'pending'    => 'bg-yellow-100 text-yellow-700',
                        'processing' => 'bg-blue-100 text-blue-700',
                        'completed'  => 'bg-green-100 text-green-700',
                        'rejected'   => 'bg-red-100 text-red-700',
                        default      => 'bg-slate-100 text-slate-600',
                    };
                    $label = match($informationRequest->status) {
                        'pending'    => 'Pending',
                        'processing' => 'Sedang Diproses',
                        'completed'  => 'Selesai',
                        'rejected'   => 'Ditolak',
                        default      => $informationRequest->status,
                    };
                @endphp
                <span class="text-sm font-bold px-3 py-1.5 rounded-full {{ $badge }}">{{ $label }}</span>
                <div class="mt-3 text-xs text-slate-400">
                    <p>Diterima: {{ $informationRequest->created_at->format('d M Y H:i') }}</p>
                    @if($informationRequest->responded_at)
                    <p class="mt-1">Ditanggapi: {{ \Carbon\Carbon::parse($informationRequest->responded_at)->format('d M Y H:i') }}</p>
                    @endif
                </div>
            </div>

            {{-- Update Status Form --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4">Update Status & Tanggapan</h2>
                <form action="{{ route('admin.information-requests.status', $informationRequest->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Status Baru</label>
                        <select name="status" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="pending"    {{ $informationRequest->status == 'pending'    ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $informationRequest->status == 'processing' ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="completed"  {{ $informationRequest->status == 'completed'  ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected"   {{ $informationRequest->status == 'rejected'   ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Catatan / Tanggapan Resmi</label>
                        <textarea name="response" rows="5" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis tanggapan atau catatan internal...">{{ $informationRequest->response }}</textarea>
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Simpan Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
