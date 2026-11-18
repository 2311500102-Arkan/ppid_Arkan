@extends('layouts.app')

@section('title', 'Formulir Permohonan Informasi Publik - PPID Arkan')

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
            <span class="text-blue-300">Layanan Informasi</span>
            <span>/</span>
            <span class="text-accent-300 font-medium">Permohonan Informasi Publik</span>
        </nav>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
            Formulir Permohonan Informasi Publik
        </h1>
        <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-2xl">
            Sampaikan permohonan informasi publik secara online sesuai dengan amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
        </p>
    </div>
</section>

<!-- Content & Form Section -->
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Main Form Card (Col 8) -->
            <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-slate-100" 
                 x-data="{ 
                     pemohonType: 'perorangan', 
                     submitting: false,
                     agreeTerms: false 
                 }">
                
                <div class="border-b border-slate-100 pb-5 mb-6">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-primary-600 bg-blue-50 px-3 py-1 rounded-full">Layanan Online</span>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900 mt-2">Identitas & Rincian Informasi</h2>
                    <p class="text-xs text-slate-500 mt-1">Pastikan data yang Anda isi lengkap dan dapat dipertanggungjawabkan kebenarannya.</p>
                </div>

                <form action="{{ url('/permohonan-informasi') }}" method="POST" enctype="multipart/form-data" @submit="submitting = true" class="space-y-6">
                    @csrf

                    <!-- 1. Kategori Pemohon -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            Kategori Pemohon <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="flex items-center gap-2 p-3 rounded-2xl border cursor-pointer transition text-xs font-semibold"
                                   :class="pemohonType === 'perorangan' ? 'border-primary-600 bg-blue-50/70 text-primary-700 shadow-sm' : 'border-slate-200 hover:bg-slate-50 text-slate-700'">
                                <input type="radio" name="kategori_pemohon" value="perorangan" x-model="pemohonType" class="text-primary-600 focus:ring-0">
                                <span>Perorangan</span>
                            </label>

                            <label class="flex items-center gap-2 p-3 rounded-2xl border cursor-pointer transition text-xs font-semibold"
                                   :class="pemohonType === 'badan_hukum' ? 'border-primary-600 bg-blue-50/70 text-primary-700 shadow-sm' : 'border-slate-200 hover:bg-slate-50 text-slate-700'">
                                <input type="radio" name="kategori_pemohon" value="badan_hukum" x-model="pemohonType" class="text-primary-600 focus:ring-0">
                                <span>Badan Hukum</span>
                            </label>

                            <label class="flex items-center gap-2 p-3 rounded-2xl border cursor-pointer transition text-xs font-semibold"
                                   :class="pemohonType === 'kelompok' ? 'border-primary-600 bg-blue-50/70 text-primary-700 shadow-sm' : 'border-slate-200 hover:bg-slate-50 text-slate-700'">
                                <input type="radio" name="kategori_pemohon" value="kelompok" x-model="pemohonType" class="text-primary-600 focus:ring-0">
                                <span>Kelompok Orang</span>
                            </label>
                        </div>
                    </div>

                    <!-- 2. Data Pemohon Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Nama Lengkap Pemohon <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama') }}" 
                                   required 
                                   placeholder="Contoh: Budi Pratama"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">
                            @error('nama')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- NIK / No. KTP -->
                        <div>
                            <label for="nik" class="block text-xs font-bold text-slate-700 mb-1.5">
                                NIK (Nomor Induk Kependudukan) <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   id="nik" 
                                   name="nik" 
                                   value="{{ old('nik') }}" 
                                   required 
                                   maxlength="16"
                                   placeholder="16 Digit NIK KTP Anda"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition font-mono">
                            @error('nik')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- No HP / WhatsApp -->
                        <div>
                            <label for="telepon" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Nomor HP / WhatsApp Aktif <span class="text-rose-500">*</span>
                            </label>
                            <input type="tel" 
                                   id="telepon" 
                                   name="telepon" 
                                   value="{{ old('telepon') }}" 
                                   required 
                                   placeholder="Contoh: 081234567890"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">
                            @error('telepon')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Aktif -->
                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Alamat Email Aktif <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   placeholder="Contoh: budi@gmail.com"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">
                            @error('email')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Pekerjaan -->
                        <div class="sm:col-span-2">
                            <label for="pekerjaan" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Pekerjaan / Profesi <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   id="pekerjaan" 
                                   name="pekerjaan" 
                                   value="{{ old('pekerjaan') }}" 
                                   required 
                                   placeholder="Contoh: Mahasiswa / Wiraswasta / Wartawan / Peneliti"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">
                            @error('pekerjaan')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Alamat Lengkap -->
                        <div class="sm:col-span-2">
                            <label for="alamat" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Alamat Lengkap Sesuai KTP <span class="text-rose-500">*</span>
                            </label>
                            <textarea id="alamat" 
                                      name="alamat" 
                                      rows="2" 
                                      required 
                                      placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Provinsi"
                                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Upload KTP / Dokumen Identitas -->
                        <div class="sm:col-span-2">
                            <label for="identitas" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Upload Foto KTP / Surat Kuasa Identitas <span class="text-slate-400 font-normal">(Format JPG, PNG, atau PDF max 2MB)</span>
                            </label>
                            <div class="p-4 border-2 border-dashed border-slate-200 hover:border-primary-400 rounded-2xl bg-slate-50/50 text-center transition">
                                <input type="file" id="identitas" name="identitas" accept=".jpg,.jpeg,.png,.pdf" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 cursor-pointer">
                            </div>
                        </div>

                    </div>

                    <!-- 3. Rincian Informasi yang Diminta -->
                    <div class="pt-4 border-t border-slate-100 space-y-5">
                        <div>
                            <label for="rincian_informasi" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Rincian Informasi yang Diminta <span class="text-rose-500">*</span>
                            </label>
                            <textarea id="rincian_informasi" 
                                      name="rincian_informasi" 
                                      rows="3" 
                                      required 
                                      placeholder="Tuliskan secara jelas dan spesifik informasi atau berkas publik yang Anda perlukan..."
                                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">{{ old('rincian_informasi') }}</textarea>
                            @error('rincian_informasi')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="tujuan_penggunaan" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Tujuan Penggunaan Informasi <span class="text-rose-500">*</span>
                            </label>
                            <textarea id="tujuan_penggunaan" 
                                      name="tujuan_penggunaan" 
                                      rows="2" 
                                      required 
                                      placeholder="Jelaskan maksud dan peruntukan penggunaan informasi ini (misal: Penelitian Skripsi, Kajian Publik, dll)..."
                                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">{{ old('tujuan_penggunaan') }}</textarea>
                            @error('tujuan_penggunaan')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- 4. Cara Memperoleh & Cara Pengiriman -->
                    <div class="pt-4 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        
                        <!-- Cara Memperoleh -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">
                                Cara Memperoleh Informasi <span class="text-rose-500">*</span>
                            </label>
                            <div class="space-y-2 text-xs">
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                    <input type="radio" name="cara_memperoleh" value="Melihat/Membaca Langsung" checked class="text-primary-600 focus:ring-0">
                                    <span>Melihat / Mendengarkan Langsung</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                    <input type="radio" name="cara_memperoleh" value="Salinan Hardcopy" class="text-primary-600 focus:ring-0">
                                    <span>Mendapatkan Salinan Tercetak (Hardcopy)</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                    <input type="radio" name="cara_memperoleh" value="Salinan Softcopy/Elektronik" class="text-primary-600 focus:ring-0">
                                    <span>Mendapatkan Salinan Elektronik (Softcopy)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Cara Pengiriman -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">
                                Cara Pengiriman Bahan <span class="text-rose-500">*</span>
                            </label>
                            <div class="space-y-2 text-xs">
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                    <input type="radio" name="cara_pengiriman" value="Online/Email" checked class="text-primary-600 focus:ring-0">
                                    <span>Surat Elektronik (Email) / Unduh Daring</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                    <input type="radio" name="cara_pengiriman" value="Mengambil Langsung" class="text-primary-600 focus:ring-0">
                                    <span>Mengambil Langsung di Meja Layanan PPID</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                    <input type="radio" name="cara_pengiriman" value="Pos / Kurir" class="text-primary-600 focus:ring-0">
                                    <span>Dikirim Melalui Pos / Jasa Kurir</span>
                                </label>
                                <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer">
                                    <input type="radio" name="cara_pengiriman" value="Faksimili" class="text-primary-600 focus:ring-0">
                                    <span>Faksimili (Fax)</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    <!-- Terms checkbox -->
                    <div class="pt-4 border-t border-slate-100">
                        <label class="flex items-start gap-2.5 text-xs text-slate-600 cursor-pointer">
                            <input type="checkbox" x-model="agreeTerms" required class="mt-0.5 rounded text-primary-600 focus:ring-primary-500">
                            <span>
                                Saya menyatakan bahwa data yang saya berikan adalah benar dan bersedia menggunakan informasi publik tersebut sesuai ketentuan perundang-undangan serta tidak merugikan pihak manapun.
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" 
                                :disabled="!agreeTerms || submitting" 
                                :class="!agreeTerms || submitting ? 'opacity-50 cursor-not-allowed' : 'hover:shadow-lg hover:shadow-blue-500/30 hover:-translate-y-0.5'"
                                class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-blue-700 to-primary-600 text-white font-bold text-xs sm:text-sm rounded-xl transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane" x-show="!submitting"></i>
                            <i class="fa-solid fa-spinner fa-spin" x-show="submitting" x-cloak></i>
                            <span x-text="submitting ? 'Mengirimkan Permohonan...' : 'Kirimkan Permohonan Informasi'"></span>
                        </button>
                    </div>

                </form>

            </div>

            <!-- Side Helper Information (Col 4) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Alur Pelayanan Card -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-route text-primary-600"></i> Alur Permohonan
                    </h3>
                    <div class="space-y-4 text-xs">
                        <div class="flex gap-3">
                            <span class="w-6 h-6 rounded-full bg-blue-100 text-primary-700 font-bold flex items-center justify-center flex-shrink-0 text-[11px]">1</span>
                            <div>
                                <strong class="text-slate-800 block">Pengisian Formulir</strong>
                                <span class="text-slate-500">Pemohon mengisi formulir permohonan informasi secara lengkap dan valid.</span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <span class="w-6 h-6 rounded-full bg-blue-100 text-primary-700 font-bold flex items-center justify-center flex-shrink-0 text-[11px]">2</span>
                            <div>
                                <strong class="text-slate-800 block">Verifikasi & Nomor Bukti</strong>
                                <span class="text-slate-500">Sistem menerbitkan nomor registrasi permohonan sebagai bukti penerimaan.</span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <span class="w-6 h-6 rounded-full bg-blue-100 text-primary-700 font-bold flex items-center justify-center flex-shrink-0 text-[11px]">3</span>
                            <div>
                                <strong class="text-slate-800 block">Proses Tindak Lanjut</strong>
                                <span class="text-slate-500">PPID memproses permohonan paling lambat 10 (sepuluh) hari kerja.</span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <span class="w-6 h-6 rounded-full bg-blue-100 text-primary-700 font-bold flex items-center justify-center flex-shrink-0 text-[11px]">4</span>
                            <div>
                                <strong class="text-slate-800 block">Pemberian Informasi</strong>
                                <span class="text-slate-500">Pemohon menerima pemberitahuan tertulis dan salinan berkas informasi.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hak Pemohon Card -->
                <div class="bg-gradient-to-br from-blue-900 via-primary-800 to-navy-950 p-6 rounded-3xl text-white shadow-xl relative overflow-hidden">
                    <div class="relative z-10 space-y-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center text-accent-300">
                            <i class="fa-solid fa-scale-balanced text-lg"></i>
                        </div>
                        <h4 class="text-base font-bold">Dasar Hukum Hak Pemohon</h4>
                        <p class="text-xs text-blue-100 leading-relaxed font-light">
                            Berdasarkan UU No. 14 Tahun 2008, setiap orang berhak memperoleh informasi publik sesuai ketentuan, melihat dan menghadiri pertemuan publik, serta mendapatkan salinan informasi.
                        </p>
                        <div class="pt-2">
                            <a href="{{ url('/layanan/prosedur-pelayanan') }}" class="text-accent-300 hover:text-white font-semibold text-xs flex items-center gap-1 transition">
                                Baca Regulasi Lengkap <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ingin Mengajukan Keberatan? -->
                <div class="bg-amber-50 rounded-3xl p-6 border border-amber-200">
                    <h4 class="text-xs font-bold text-amber-900 uppercase tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation text-amber-600"></i> Permohonan Ditolak?
                    </h4>
                    <p class="text-xs text-amber-800 leading-relaxed">
                        Jika permohonan informasi Anda tidak ditanggapi dalam waktu 10 hari kerja atau ditolak tanpa alasan sah, Anda berhak mengajukan keberatan resmi.
                    </p>
                    <a href="{{ url('/pengajuan-keberatan') }}" class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-amber-900 hover:text-black">
                        Form Pengajuan Keberatan <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
