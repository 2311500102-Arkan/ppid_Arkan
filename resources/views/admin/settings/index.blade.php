@extends('admin.layouts.app')

@section('title', 'Pengaturan Website')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">Pengaturan Website</h1>
        <p class="text-sm text-slate-500 mt-1">Konfigurasi identitas dan informasi kontak portal PPID Arkan</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Identity --}}
            <div class="xl:col-span-2 space-y-5">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h2 class="text-base font-bold text-slate-800 mb-5 flex items-center gap-2">
                        <i class="fa-solid fa-globe text-blue-600"></i> Identitas Portal
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nama Website</label>
                            <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Tagline / Slogan</label>
                            <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi Singkat</label>
                            <textarea name="site_description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Teks Footer (Copyright)</label>
                            <input type="text" name="footer_text" value="{{ old('footer_text', $settings['footer_text'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h2 class="text-base font-bold text-slate-800 mb-5 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-blue-600"></i> Informasi Kontak
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Kantor</label>
                            <textarea name="address" rows="2" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address', $settings['address'] ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">No. Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">No. WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Email Resmi</label>
                            <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Jam Layanan</label>
                            <input type="text" name="working_hours" value="{{ old('working_hours', $settings['working_hours'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Senin - Jumat, 08.00 - 16.00 WIB">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Media --}}
            <div class="space-y-5">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h2 class="text-base font-bold text-slate-800 mb-5 flex items-center gap-2">
                        <i class="fa-solid fa-share-nodes text-blue-600"></i> Media Sosial
                    </h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                <i class="fa-brands fa-facebook text-blue-600 mr-1"></i> Facebook
                            </label>
                            <input type="url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="https://facebook.com/...">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                <i class="fa-brands fa-x-twitter text-slate-700 mr-1"></i> Twitter / X
                            </label>
                            <input type="url" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="https://twitter.com/...">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                <i class="fa-brands fa-instagram text-pink-600 mr-1"></i> Instagram
                            </label>
                            <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="https://instagram.com/...">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                <i class="fa-brands fa-youtube text-red-600 mr-1"></i> YouTube
                            </label>
                            <input type="url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="https://youtube.com/...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
