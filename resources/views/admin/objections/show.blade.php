@extends('admin.layouts.app')

@section('title', 'Detail Keberatan')

@section('content')
<div class="p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Detail Keberatan</h1>
            <p class="text-sm text-slate-500 mt-1">No: <span class="font-mono font-semibold text-orange-700">{{ $objection->objection_number }}</span></p>
        </div>
        <a href="{{ route('admin.objections.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-medium hover:bg-slate-50 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-5">
            {{-- Applicant --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-user text-orange-500"></i> Data Pemohon Keberatan
                </h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Nama Lengkap</dt>
                        <dd class="font-semibold text-slate-800">{{ $objection->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">No. HP</dt>
                        <dd class="text-slate-700">{{ $objection->phone ?? '-' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Alamat</dt>
                        <dd class="text-slate-700">{{ $objection->address }}</dd>
                    </div>
                    @if($objection->informationRequest)
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Nomor Permohonan Asal</dt>
                        <dd>
                            <a href="{{ route('admin.information-requests.show', $objection->informationRequest->id) }}" class="font-mono text-sm text-blue-600 hover:underline font-semibold">
                                {{ $objection->informationRequest->request_number }}
                            </a>
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>

            {{-- Reason --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-scale-balanced text-orange-500"></i> Alasan Keberatan
                </h2>
                <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line bg-orange-50 border border-orange-100 rounded-xl p-4">{{ $objection->reason }}</div>
            </div>

            {{-- Official Response if any --}}
            @if($objection->response)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-message-check text-green-600"></i> Tanggapan Resmi
                </h2>
                <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line bg-green-50 border border-green-100 rounded-xl p-4">{{ $objection->response }}</div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-5">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-3">Status Keberatan</h2>
                @php
                    $badge = match($objection->status) {
                        'pending'    => 'bg-yellow-100 text-yellow-700',
                        'processing' => 'bg-blue-100 text-blue-700',
                        'completed'  => 'bg-green-100 text-green-700',
                        'rejected'   => 'bg-red-100 text-red-700',
                        default      => 'bg-slate-100 text-slate-600',
                    };
                    $label = match($objection->status) {
                        'pending'    => 'Pending',
                        'processing' => 'Sedang Diproses',
                        'completed'  => 'Selesai',
                        'rejected'   => 'Ditolak',
                        default      => $objection->status,
                    };
                @endphp
                <span class="text-sm font-bold px-3 py-1.5 rounded-full {{ $badge }}">{{ $label }}</span>
                <p class="text-xs text-slate-400 mt-3">Diterima: {{ $objection->created_at->format('d M Y H:i') }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h2 class="text-base font-bold text-slate-800 mb-4">Update Status & Tanggapan</h2>
                <form action="{{ route('admin.objections.status', $objection->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Status Baru</label>
                        <select name="status" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="pending"    {{ $objection->status=='pending'    ? 'selected':'' }}>Pending</option>
                            <option value="processing" {{ $objection->status=='processing' ? 'selected':'' }}>Sedang Diproses</option>
                            <option value="completed"  {{ $objection->status=='completed'  ? 'selected':'' }}>Selesai</option>
                            <option value="rejected"   {{ $objection->status=='rejected'   ? 'selected':'' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Catatan / Tanggapan Resmi</label>
                        <textarea name="response" rows="5" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis tanggapan resmi...">{{ $objection->response }}</textarea>
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
