@extends('layouts.app')

@section('title', 'Cek Status Permohonan Informasi - PPID Arkan')

@section('content')
<!-- Header Banner -->
<section class="bg-gradient-to-r from-navy-950 via-blue-900 to-blue-800 text-white py-12 relative overflow-hidden">
    <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-blue-200 mb-3" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white transition flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            <span>/</span>
            <span class="text-accent-300 font-medium">Layanan</span>
            <span>/</span>
            <span class="text-white font-medium">Cek Status Permohonan</span>
        </nav>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
            Pelacakan Status Permohonan Informasi
        </h1>
        <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-2xl">
            Masukkan Nomor Tiket Registrasi permohonan informasi Anda untuk memantau proses tindak lanjut secara transparan dan akuntabel.
        </p>
    </div>
</section>

<!-- Content Section -->
<section class="py-12 bg-slate-50 min-h-[60vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Form Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-slate-100 -mt-10 relative z-20">
            <h2 class="text-base sm:text-lg font-bold text-slate-900 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass text-primary-600"></i> Cari Status Permohonan
            </h2>
            <p class="text-xs text-slate-500 mb-6">
                Nomor pendaftaran diberikan setelah Anda mengirim formulir permohonan (contoh: <span class="font-mono text-primary-700 font-semibold">REQ-{{ date('Ymd') }}-0001</span>).
            </p>

            <form action="{{ route('information-request.status') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <input type="text" 
                           name="request_number" 
                           value="{{ $requestNumber ?? '' }}"
                           required 
                           placeholder="Masukkan Nomor Registrasi (Contoh: REQ-{{ date('Ymd') }}-0001)"
                           class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">
                </div>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-blue-700 to-primary-600 hover:from-blue-800 hover:to-primary-700 text-white font-semibold rounded-xl text-xs sm:text-sm flex items-center justify-center gap-2 shadow-md transition">
                    <i class="fa-solid fa-search"></i> Lacak Status
                </button>
            </form>
        </div>

        <!-- Result Section -->
        @if($searched)
            <div class="mt-8">
                @if($informationRequest)
                    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
                        <!-- Card Header -->
                        <div class="p-6 sm:p-8 bg-gradient-to-r from-slate-900 via-slate-800 to-blue-950 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <span class="text-[11px] font-semibold text-blue-300 uppercase tracking-wider">Nomor Registrasi</span>
                                <h3 class="text-xl sm:text-2xl font-black font-mono tracking-tight text-white mt-1">
                                    {{ $informationRequest->request_number }}
                                </h3>
                                <p class="text-xs text-slate-300 mt-1">
                                    Tanggal Pengajuan: {{ $informationRequest->created_at->translatedFormat('d F Y, H:i') }} WIB
                                </p>
                            </div>

                            <div>
                                @php
                                    $statusBadge = match($informationRequest->status) {
                                        'pending'    => ['bg' => 'bg-amber-500/20 text-amber-300 border-amber-400/30', 'icon' => 'fa-clock', 'label' => 'Menunggu Verifikasi'],
                                        'processing' => ['bg' => 'bg-blue-500/20 text-blue-300 border-blue-400/30', 'icon' => 'fa-spinner fa-spin', 'label' => 'Sedang Diproses'],
                                        'completed'  => ['bg' => 'bg-emerald-500/20 text-emerald-300 border-emerald-400/30', 'icon' => 'fa-circle-check', 'label' => 'Selesai / Dikabulkan'],
                                        'rejected'   => ['bg' => 'bg-rose-500/20 text-rose-300 border-rose-400/30', 'icon' => 'fa-circle-xmark', 'label' => 'Permohonan Ditolak'],
                                        default      => ['bg' => 'bg-slate-500/20 text-slate-300 border-slate-400/30', 'icon' => 'fa-circle-info', 'label' => ucfirst($informationRequest->status)]
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full border text-xs font-bold {{ $statusBadge['bg'] }}">
                                    <i class="fa-solid {{ $statusBadge['icon'] }}"></i> {{ $statusBadge['label'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Progress Step Tracker -->
                        <div class="p-6 sm:p-8 border-b border-slate-100 bg-slate-50/50">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-6">Alur Penyelesaian Informasi</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 relative">
                                <!-- Step 1 -->
                                <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs shrink-0">
                                        <i class="fa-solid fa-check"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800">1. Registrasi Masuk</p>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Permohonan berhasil dicatat ke sistem.</p>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                @php
                                    $isProcessing = in_array($informationRequest->status, ['processing', 'completed', 'rejected']);
                                @endphp
                                <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full {{ $isProcessing ? 'bg-blue-100 text-blue-600' : 'bg-slate-100 text-slate-400' }} flex items-center justify-center font-bold text-xs shrink-0">
                                        @if($isProcessing)
                                            <i class="fa-solid fa-spinner {{ $informationRequest->status === 'processing' ? 'fa-spin' : '' }}"></i>
                                        @else
                                            2
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800">2. Telaah Dokumen & Klarifikasi</p>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Uji konsekuensi / penyiapan berkas PPID.</p>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                @php
                                    $isDone = in_array($informationRequest->status, ['completed', 'rejected']);
                                    $doneColor = $informationRequest->status === 'completed' ? 'bg-emerald-100 text-emerald-600' : ($informationRequest->status === 'rejected' ? 'bg-rose-100 text-rose-600' : 'bg-slate-100 text-slate-400');
                                @endphp
                                <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full {{ $doneColor }} flex items-center justify-center font-bold text-xs shrink-0">
                                        @if($isDone)
                                            <i class="fa-solid {{ $informationRequest->status === 'completed' ? 'fa-check' : 'fa-xmark' }}"></i>
                                        @else
                                            3
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800">3. Tanggapan & Penyerahan</p>
                                        <p class="text-[11px] text-slate-500 mt-0.5">Keputusan resmi & penyerahan informasi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Information -->
                        <div class="p-6 sm:p-8 space-y-6">
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Informasi yang Diminta</h4>
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-800 leading-relaxed whitespace-pre-line">
                                    {{ $informationRequest->information_requested }}
                                </div>
                            </div>

                            @if($informationRequest->purpose)
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Tujuan Penggunaan</h4>
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed">
                                    {{ $informationRequest->purpose }}
                                </div>
                            </div>
                            @endif

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="p-4 rounded-2xl border border-slate-100">
                                    <span class="text-[11px] text-slate-400 block mb-1">Nama Pemohon</span>
                                    <span class="text-xs sm:text-sm font-semibold text-slate-800">{{ $informationRequest->name }}</span>
                                </div>
                                <div class="p-4 rounded-2xl border border-slate-100">
                                    <span class="text-[11px] text-slate-400 block mb-1">Metode Pengambilan</span>
                                    <span class="text-xs sm:text-sm font-semibold text-slate-800 uppercase">{{ $informationRequest->how_to_get }}</span>
                                </div>
                            </div>

                            <!-- Official Response from Admin -->
                            @if($informationRequest->response)
                            <div class="mt-6 p-6 rounded-2xl border {{ $informationRequest->status === 'completed' ? 'bg-emerald-50/60 border-emerald-200' : ($informationRequest->status === 'rejected' ? 'bg-rose-50/60 border-rose-200' : 'bg-blue-50/60 border-blue-200') }}">
                                <h4 class="text-xs font-bold uppercase tracking-wider mb-2 flex items-center gap-2 {{ $informationRequest->status === 'completed' ? 'text-emerald-900' : ($informationRequest->status === 'rejected' ? 'text-rose-900' : 'text-blue-900') }}">
                                    <i class="fa-solid fa-comment-dots"></i> Tanggapan Resmi Petugas PPID
                                </h4>
                                <p class="text-xs sm:text-sm text-slate-800 leading-relaxed whitespace-pre-line">
                                    {{ $informationRequest->response }}
                                </p>
                                @if($informationRequest->responded_at)
                                <p class="text-[10px] text-slate-500 mt-3 pt-2 border-t border-slate-200/50">
                                    Waktu Tanggapan: {{ \Carbon\Carbon::parse($informationRequest->responded_at)->translatedFormat('d F Y, H:i') }} WIB
                                </p>
                                @endif
                            </div>
                            @endif

                            <!-- If rejected, give link to Objection form -->
                            @if($informationRequest->status === 'rejected')
                            <div class="p-5 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div>
                                    <p class="font-bold">Apakah Anda merasa keberatan atas keputusan ini?</p>
                                    <p class="text-amber-800 text-[11px] mt-0.5">Anda berhak mengajukan permohonan keberatan sesuai dengan ketentuan UU KIP No. 14 Tahun 2008.</p>
                                </div>
                                <a href="{{ route('objection.create') }}" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-xl text-xs whitespace-nowrap text-center transition">
                                    Ajukan Keberatan &rarr;
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- Not Found Card -->
                    <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-slate-100 text-center">
                        <div class="w-16 h-16 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-2xl mx-auto mb-4">
                            <i class="fa-solid fa-file-circle-xmark"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Nomor Registrasi Tidak Ditemukan</h3>
                        <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto mb-6">
                            Permohonan dengan nomor <span class="font-mono font-semibold text-rose-600">"{{ $requestNumber }}"</span> tidak ditemukan dalam basis data kami. Pastikan nomor tiket yang Anda ketik sudah sesuai.
                        </p>
                        <div class="flex flex-wrap items-center justify-center gap-3">
                            <a href="{{ route('information-request.status') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                                Coba Lagi
                            </a>
                            <a href="{{ route('information-request.create') }}" class="px-5 py-2.5 rounded-xl bg-primary-600 text-white text-xs font-semibold hover:bg-primary-700 transition">
                                Buat Permohonan Baru
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        @endif

    </div>
</section>
@endsection
