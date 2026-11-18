@extends('layouts.app')

@section('title', 'Hubungi Kami - PPID Arkan')

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
            <span class="text-accent-300 font-medium">Kontak & Lokasi</span>
        </nav>
        
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-white">
            Hubungi PPID Arkan
        </h1>
        <p class="text-xs sm:text-sm text-blue-100 mt-2 max-w-2xl">
            Kami siap melayani kebutuhan informasi publik Anda. Kunjungi meja layanan kami atau kirimkan pertanyaan melalui formulir di bawah ini.
        </p>
    </div>
</section>

<!-- Contact Info Cards Grid -->
<section class="relative -mt-8 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Card 1: Alamat -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex flex-col justify-between">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-primary-600 flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Alamat Kantor</h4>
                <p class="text-xs font-semibold text-slate-800 mt-1 leading-relaxed">
                    Jl. Angsana No. 01, Kompleks Perkantoran Pemprov, Pangkalpinang, Bangka Belitung
                </p>
            </div>
        </div>

        <!-- Card 2: Telepon -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex flex-col justify-between">
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-phone-volume"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Telepon & Hotline</h4>
                <p class="text-xs font-semibold text-slate-800 mt-1">
                    (0717) 431234 / 431235 <br>
                    <span class="text-primary-600 font-normal">WA: 0812-3456-7890</span>
                </p>
            </div>
        </div>

        <!-- Card 3: Email -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex flex-col justify-between">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Surat Elektronik</h4>
                <p class="text-xs font-semibold text-slate-800 mt-1 break-words">
                    ppid@arkan.babelprov.go.id <br>
                    <span class="text-slate-500 font-normal">info@arkan.babelprov.go.id</span>
                </p>
            </div>
        </div>

        <!-- Card 4: Jam Layanan -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100 flex flex-col justify-between">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl mb-4">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div>
                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jam Layanan PPID</h4>
                <p class="text-xs font-semibold text-slate-800 mt-1">
                    Senin - Kamis: 08.00 - 16.00 WIB <br>
                    Jumat: 08.00 - 15.30 WIB
                </p>
            </div>
        </div>

    </div>
</section>

<!-- Contact Form & Map Section -->
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Contact Form (Col 7) -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-10 shadow-xl border border-slate-100"
                 x-data="{ submitting: false }">
                
                <div class="border-b border-slate-100 pb-5 mb-6">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-primary-600 bg-blue-50 px-3 py-1 rounded-full">Kirim Pesan</span>
                    <h2 class="text-xl font-bold text-slate-900 mt-2">Formulir Pesan & Aspirasi Publik</h2>
                    <p class="text-xs text-slate-500 mt-1">Gunakan formulir ini untuk mengajukan pertanyaan umum, saran, atau konfirmasi berkas permohonan Anda.</p>
                </div>

                <form action="{{ url('/kontak') }}" method="POST" @submit="submitting = true" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   placeholder="Nama Anda"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">
                            @error('name')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Alamat Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   placeholder="nama@email.com"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">
                            @error('email')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="phone" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Nomor Telepon / WA
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}" 
                                   placeholder="08xxxxxxxxxx"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">
                        </div>

                        <div>
                            <label for="subject" class="block text-xs font-bold text-slate-700 mb-1.5">
                                Subjek Pesan <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   id="subject" 
                                   name="subject" 
                                   value="{{ old('subject') }}" 
                                   required 
                                   placeholder="Perihal pesan Anda"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">
                            @error('subject')
                                <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-xs font-bold text-slate-700 mb-1.5">
                            Isi Pesan <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="4" 
                                  required 
                                  placeholder="Tuliskan pertanyaan, aspirasi, atau masukan Anda secara jelas..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-blue-100 transition">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-[11px] text-rose-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" 
                                :disabled="submitting" 
                                class="w-full sm:w-auto px-8 py-3.5 bg-gradient-to-r from-blue-700 to-primary-600 hover:from-blue-800 hover:to-primary-700 text-white font-bold text-xs sm:text-sm rounded-xl shadow-md transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane" x-show="!submitting"></i>
                            <i class="fa-solid fa-spinner fa-spin" x-show="submitting" x-cloak></i>
                            <span x-text="submitting ? 'Mengirimkan Pesan...' : 'Kirim Pesan Sekarang'"></span>
                        </button>
                    </div>

                </form>

            </div>

            <!-- Map & Directions (Col 5) -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Map Container -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100 overflow-hidden">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-map-location-dot text-primary-600"></i> Lokasi Kantor PPID
                    </h3>
                    
                    <div class="relative w-full h-64 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 shadow-inner">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127506.87780084534!2d106.03816508933096!3d-2.1287966964244243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e22c10b0a8eb1b1%3A0x634d0b13cf3e3b32!2sPangkal%20Pinang%2C%20Kota%20Pangkal%20Pinang%2C%20Kepulauan%20Bangka%20Belitung!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500">Koordinat: Pangkalpinang, Babel</span>
                        <a href="https://maps.google.com" target="_blank" class="text-primary-600 hover:text-primary-800 font-semibold flex items-center gap-1">
                            Buka di Google Maps <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- FAQ Quick Accordion -->
                <div class="bg-white rounded-3xl p-6 shadow-xl border border-slate-100" x-data="{ openFaq: 1 }">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                        <i class="fa-solid fa-circle-question text-accent-500"></i> Pertanyaan Sering Diajukan
                    </h3>

                    <div class="space-y-3 text-xs">
                        <!-- FAQ 1 -->
                        <div class="border border-slate-100 rounded-xl overflow-hidden">
                            <button @click="openFaq = (openFaq === 1 ? null : 1)" class="w-full text-left p-3 font-semibold text-slate-800 hover:bg-slate-50 flex items-center justify-between">
                                <span>Berapa lama waktu penyelesaian permohonan informasi?</span>
                                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition" :class="openFaq === 1 ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="openFaq === 1" class="p-3 bg-slate-50 text-slate-600 border-t border-slate-100">
                                Sesuai regulasi UU KIP, permohonan ditindaklanjuti paling lambat 10 (sepuluh) hari kerja dan dapat diperpanjang selama 7 (tujuh) hari kerja dengan pemberitahuan tertulis.
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="border border-slate-100 rounded-xl overflow-hidden">
                            <button @click="openFaq = (openFaq === 2 ? null : 2)" class="w-full text-left p-3 font-semibold text-slate-800 hover:bg-slate-50 flex items-center justify-between">
                                <span>Apakah ada biaya untuk permohonan informasi?</span>
                                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition" :class="openFaq === 2 ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="openFaq === 2" class="p-3 bg-slate-50 text-slate-600 border-t border-slate-100">
                                Pelayanan informasi publik tidak dipungut biaya (gratis). Apabila pemohon meminta salinan dokumen fisik (fotokopi), biaya fotokopi ditanggung oleh pemohon sesuai tarif yang wajar.
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="border border-slate-100 rounded-xl overflow-hidden">
                            <button @click="openFaq = (openFaq === 3 ? null : 3)" class="w-full text-left p-3 font-semibold text-slate-800 hover:bg-slate-50 flex items-center justify-between">
                                <span>Bagaimana jika permohonan saya ditolak?</span>
                                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 transition" :class="openFaq === 3 ? 'rotate-180' : ''"></i>
                            </button>
                            <div x-show="openFaq === 3" class="p-3 bg-slate-50 text-slate-600 border-t border-slate-100">
                                Pemohon berhak mengajukan keberatan tertulis kepada Atasan PPID dalam jangka waktu maksimal 30 hari kerja sejak penolakan diterima.
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
