@extends('layouts.app')

@section('title', 'Formulir Pengajuan Keberatan Informasi Publik - PPID Arkan')

@section('content')

<!-- Header Banner -->
<section class="bg-gradient-to-r from-navy-950 via-slate-900 to-amber-950 text-white py-12 relative overflow-hidden">
    <div class="absolute -right-20 -top-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <nav class="flex items-center space-x-2 text-xs text-amber-200/80 mb-3" aria-label="Breadcrumb">
            <a href="{{ url('/') }}" class="hover:text-white transition flex items-center gap-1">
                <i class="fa-solid fa-house text-[10px]"></i> Beranda
            </a>
            <span>/</span>
            <span class="text-amber-300/80">Layanan Informasi</span>
            <span>/</span>
            <span class="text-amber-400 font-medium">Pengajuan Keberatan</span>
        </nav>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
            Formulir Pengajuan Keberatan Informasi Publik
        </h1>
        <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-2xl">
            Sampaikan keberatan resmi apabila permohonan informasi Anda ditolak, tidak ditanggapi, atau tidak dipenuhi sebagaimana ketentuan UU KIP No. 14 Tahun 2008.
        </p>
    </div>
</section>

<!-- Content & Form Section -->
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Main Form (Col 8) -->
            <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-slate-100"
                 x-data="{ submitting: false }">
                
                <div class="border-b border-slate-100 pb-5 mb-6">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-800 bg-amber-100 px-3 py-1 rounded-full">Prosedur Keberatan</span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 mt-2">Data Permohonan & Alasan Keberatan</h2>
                    <p class="text-xs text-slate-500 mt-1">Keberatan diajukan kepada Atasan PPID dalam jangka waktu paling lambat 30 (tiga puluh) hari kerja sejak ditemukannya alasan.</p>
                </div>

                <form action="{{ url('/pengajuan-keberatan') }}" method="POST" enctype="multipart/form-data" @submit="submitting = true" class="space-y-6">
                    @csrf

                    <!-- 1. Nomor Registrasi Permohonan Sebelumnya -->
                    <div class="bg-amber-50/70 p-4 rounded-2xl border border-amber-200">
                        <label for="nomor_permohonan" class="block text-xs font-bold text-slate-800 mb-1.5">
                            Nomor Pendaftaran Permohonan Sebelumnya <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" 
                               id="nomor_permohonan" 
                               name="nomor_permohonan" 
                               value="{{ old('nomor_permohonan') }}" 
                               required 
                               placeholder="Contoh: REG-PPID-2024-00123"
                               class="w-full px-4 py-2.5 rounded-xl border border-amber-300 bg-white text-xs sm:text-sm text-slate-800 font-mono focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition">
                        <span class="text-[11px] text-amber-700/80 mt-1 block">Nomor tanda bukti pendaftaran yang Anda peroleh saat mengajukan permohonan awal.</span>
                        @error('nomor_permohonan')
                            <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- 2. Data Pemohon Keberatan -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <!-- Nama Pemohon -->
                        <div class="sm:col-span-2">
                            <label for="nama" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Nama Lengkap Pemohon Keberatan <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama') }}" 
                                   required 
                                   placeholder="Nama sesuai KTP"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-100 transition">
                            @error('nama')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div>
                            <label for="telepon" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Nomor Telepon / HP <span class="text-rose-500">*</span>
                            </label>
                            <input type="tel" 
                                   id="telepon" 
                                   name="telepon" 
                                   value="{{ old('telepon') }}" 
                                   required 
                                   placeholder="Contoh: 081234567890"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-100 transition">
                            @error('telepon')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Alamat Email Aktif <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Contoh: pemohon@gmail.com"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-100 transition">
                            @error('email')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="sm:col-span-2">
                            <label for="alamat" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Alamat Lengkap Pemohon <span class="text-rose-500">*</span>
                            </label>
                            <textarea id="alamat" 
                                      name="alamat" 
                                      rows="2" 
                                      required 
                                      placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kab/kota"
                                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-100 transition">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <!-- 3. Alasan Pengajuan Keberatan (Checklist UU KIP Pasal 35) -->
                    <div class="pt-4 border-t border-slate-100">
                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">
                            Pilih Alasan Pengajuan Keberatan <span class="text-rose-500">*</span>
                        </label>
                        <p class="text-xs text-slate-500 mb-3">Centang satu atau lebih alasan keberatan sesuai Pasal 35 UU No. 14 Tahun 2008:</p>

                        <div class="space-y-2.5 text-xs text-slate-700">
                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="alasan_keberatan[]" value="Permohonan informasi ditolak tanpa alasan sah" class="mt-0.5 rounded text-amber-600 focus:ring-amber-500">
                                <span>Permohonan informasi publik ditolak tanpa alasan yang sah</span>
                            </label>

                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="alasan_keberatan[]" value="Informasi berkala tidak disediakan" class="mt-0.5 rounded text-amber-600 focus:ring-amber-500">
                                <span>Informasi berkala tidak disediakan sebagaimana mestinya</span>
                            </label>

                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="alasan_keberatan[]" value="Permohonan informasi tidak ditanggapi" class="mt-0.5 rounded text-amber-600 focus:ring-amber-500">
                                <span>Permohonan informasi tidak ditanggapi melebihi waktu 10 hari kerja</span>
                            </label>

                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="alasan_keberatan[]" value="Permohonan ditanggapi tidak sebagaimana diminta" class="mt-0.5 rounded text-amber-600 focus:ring-amber-500">
                                <span>Permohonan informasi ditanggapi tidak sebagaimana yang diminta</span>
                            </label>

                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="alasan_keberatan[]" value="Permohonan informasi tidak dipenuhi" class="mt-0.5 rounded text-amber-600 focus:ring-amber-500">
                                <span>Permohonan informasi tidak dipenuhi oleh Badan Publik</span>
                            </label>

                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="alasan_keberatan[]" value="Pengenaan biaya yang tidak wajar" class="mt-0.5 rounded text-amber-600 focus:ring-amber-500">
                                <span>Pengenaan biaya penggandaan informasi yang tidak wajar</span>
                            </label>

                            <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                <input type="checkbox" name="alasan_keberatan[]" value="Penyampaian informasi melampaui batas waktu" class="mt-0.5 rounded text-amber-600 focus:ring-amber-500">
                                <span>Penyampaian informasi yang melampaui batas waktu yang ditentukan</span>
                            </label>
                        </div>
                    </div>

                    <!-- 4. Uraian Penjelasan Keberatan -->
                    <div class="pt-4 border-t border-slate-100">
                        <label for="uraian_keberatan" class="block text-xs font-bold text-slate-700 mb-1.5">
                            Uraian / Keterangan Penjelasan Keberatan <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="uraian_keberatan" 
                                  name="uraian_keberatan" 
                                  rows="4" 
                                  required 
                                  placeholder="Jelaskan secara kronologis kronologi dan rincian keberatan yang Anda ajukan kepada Atasan PPID..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-100 transition">{{ old('uraian_keberatan') }}</textarea>
                        @error('uraian_keberatan')
                            <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- 5. Lampiran Bukti Pendukung -->
                    <div>
                        <label for="lampiran_bukti" class="block text-xs font-bold text-slate-700 mb-1.5">
                            Dokumen Bukti Pendukung <span class="text-slate-400 font-normal">(Bukti permohonan awal / surat penolakan jika ada, Max 2MB PDF/JPG)</span>
                        </label>
                        <div class="p-4 border-2 border-dashed border-slate-200 hover:border-amber-400 rounded-2xl bg-slate-50/50 text-center transition">
                            <input type="file" id="lampiran_bukti" name="lampiran_bukti" accept=".jpg,.jpeg,.png,.pdf" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4 border-t border-slate-100">
                        <button type="submit" 
                                :disabled="submitting"
                                class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-slate-900 font-extrabold text-xs sm:text-sm rounded-xl shadow-lg shadow-amber-500/25 transition-all duration-200 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-triangle-exclamation" x-show="!submitting"></i>
                            <i class="fa-solid fa-spinner fa-spin" x-show="submitting" x-cloak></i>
                            <span x-text="submitting ? 'Mengirim Pengajuan Keberatan...' : 'Kirimkan Pengajuan Keberatan Resmi'"></span>
                        </button>
                    </div>

                </form>

            </div>

            <!-- Sidebar Info (Col 4) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Aturan Hukum Keberatan -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-gavel text-amber-600"></i> Ketentuan Keberatan
                    </h3>
                    <div class="space-y-3 text-xs text-slate-600 leading-relaxed">
                        <p>
                            Berdasarkan <strong>Pasal 36 UU No. 14 Tahun 2008</strong>:
                        </p>
                        <ol class="list-decimal list-inside space-y-2 pl-1">
                            <li>Keberatan diajukan oleh pemohon kepada <strong>Atasan PPID</strong>.</li>
                            <li>Atasan PPID memberikan tanggapan tertulis paling lambat <strong>30 (tiga puluh) hari kerja</strong> setelah diterimanya surat keberatan secara lengkap.</li>
                            <li>Jika tanggapan Atasan PPID tidak memuaskan, pemohon berhak mengajukan <strong>Penyelesaian Sengketa Informasi ke Komisi Informasi</strong> dalam tempo 14 hari kerja.</li>
                        </ol>
                    </div>
                </div>

                <!-- Call Center PPID -->
                <div class="rounded-3xl bg-slate-900 p-6 text-white shadow-xl relative overflow-hidden">
                    <div class="space-y-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-400/20 text-amber-400 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <h4 class="font-bold text-base">Konsultasi Keberatan</h4>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Butuh asistensi mengenai kelengkapan berkas keberatan Anda? Hubungi desk layanan konsultasi sengketa informasi kami.
                        </p>
                        <div class="pt-2 text-xs font-mono text-amber-400">
                            Telepon: (0717) 431234
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
