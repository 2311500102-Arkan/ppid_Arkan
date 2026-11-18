<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Map URL aliases to database page slugs.
     */
    protected array $slugAliases = [
        // Profil Organisasi
        'visi-misi' => 'visi-misi-pemerintah-daerah',
        'visi-dan-misi' => 'visi-misi-pemerintah-daerah',
        'struktur-organisasi' => 'struktur-organisasi-pemerintah',
        'tugas-fungsi' => 'tugas-wewenang-ppid',
        'tugas-dan-fungsi' => 'tugas-wewenang-ppid',
        'profil-pimpinan' => 'profil-singkat-pimpinan-daerah',
        'profil-pimpinan-daerah' => 'profil-singkat-pimpinan-daerah',
        'daftar-pejabat-struktural' => 'profil-singkat-pimpinan-daerah',
        'organisasi-perangkat-daerah' => 'struktur-organisasi-pemerintah',
        'satuan-dan-unit-kerja' => 'struktur-organisasi-pemerintah',
        'agenda-kerja-pimpinan' => 'profil-singkat-pimpinan-daerah',

        // Profil PPID
        'gambaran-singkat-ppid' => 'profil-singkat-ppid',
        'gambaran_singkat_pembentukan_ppid' => 'profil-singkat-ppid',
        'dasar-hukum-ppid' => 'tugas-wewenang-ppid',
        'profil-ppid' => 'profil-singkat-ppid',
        'struktur-organisasi-ppid' => 'struktur-ppid',
        'struktur-organisasi-ppid-2025' => 'struktur-ppid',
        'visi-misi-ppid' => 'visi-misi-ppid',
        'visi-dan-misi-ppid' => 'visi-misi-ppid',
        'tugas_dan_fungsi_ppid_serta_ppid_pelaksana' => 'tugas-wewenang-ppid',

        // Standar Layanan
        'prosedur-pelayanan' => 'prosedur-permohonan-informasi',
        'prosedur-pelayanan-informasi-publik' => 'prosedur-permohonan-informasi',
        'alur_pengelolaan_keberatan_informasi_publik' => 'prosedur-pengajuan-keberatan',
        'prosedur-pengajuan-keberatan' => 'prosedur-pengajuan-keberatan',
        'sop-ppid' => 'prosedur-permohonan-informasi',
        'maklumat-informasi' => 'maklumat-pelayanan',
        'maklumat-pelayanan' => 'maklumat-pelayanan',
        'waktu-dan-biaya-layanan-informasi' => 'standar-biaya-waktu-pelayanan',
        'standar-biaya-waktu-pelayanan' => 'standar-biaya-waktu-pelayanan',
        'mekanisme-permohonan-informasi' => 'prosedur-permohonan-informasi',

        // Laporan
        'statistik-layanan' => 'statistik-evaluasi-layanan',
        'statistik-layanan-informasi-publik' => 'statistik-evaluasi-layanan',
        'laporan-keuangan-pemerintah-daerah-lkpd' => 'laporan-keuangan-pemerintah-daerah',
        'laporan-penyelenggaraan-pemerintah-daerah-lppd' => 'laporan-kinerja-instansi-pemerintah',
        'laporan-ppid' => 'laporan-layanan-informasi-tahunan',
        'daftar-informasi-publik' => 'laporan-layanan-informasi-tahunan',
    ];

    /**
     * Display the specified static page by slug.
     */
    public function show(string $slug): View
    {
        $normalizedSlug = str_replace('_', '-', strtolower($slug));
        $targetSlug = $this->slugAliases[$slug] ?? $this->slugAliases[$normalizedSlug] ?? $slug;

        $page = Page::where('slug', $targetSlug)
            ->where('is_active', true)
            ->first();

        // Fallback: search by partial match or take the first page if still not found
        if (!$page) {
            $page = Page::where('slug', 'like', "%{$normalizedSlug}%")
                ->where('is_active', true)
                ->first();
        }

        if (!$page) {
            // Generate a dynamic placeholder page so it never 404s for users
            $titleFormatted = ucwords(str_replace(['-', '_'], ' ', $slug));
            $page = new Page([
                'title' => $titleFormatted,
                'slug' => $slug,
                'category' => 'informasi-publik',
                'content' => "<p>Informasi resmi mengenai <strong>{$titleFormatted}</strong> pada portal PPID Arkan sedang dalam proses pembaharuan dokumen berkala.</p><p>Untuk permohonan informasi khusus terkait topik ini, silakan menggunakan layanan <a href='" . url('/permohonan-informasi') . "' class='text-blue-600 underline font-semibold'>Permohonan Informasi Publik Daring</a> atau hubungi desk layanan informasi kami.</p>",
                'is_active' => true,
            ]);
        }

        return view('pages.show', compact('page'));
    }
}
