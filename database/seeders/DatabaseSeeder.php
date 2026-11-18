<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Banner;
use App\Models\Document;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\InformationRequest;
use App\Models\Objection;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@ppidarkan.go.id'],
            [
                'name' => 'Administrator PPID',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Seed Settings
        $settings = [
            'site_name' => 'PPID Arkan',
            'site_tagline' => 'Keterbukaan Informasi Menuju Tata Kelola Pemerintahan yang Bersih dan Transparan',
            'site_description' => 'Portal Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pemerintah Kabupaten / Kota Arkan, menyediakan akses mudah dan cepat terhadap informasi publik.',
            'address' => 'Jl. Merdeka No. 45, Kompleks Perkantoran Terpadu, Arkan',
            'phone' => '(0711) 7891234',
            'whatsapp' => '081234567890',
            'email' => 'ppid@arkankab.go.id',
            'working_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'facebook_url' => 'https://facebook.com/ppidarkan',
            'twitter_url' => 'https://twitter.com/ppidarkan',
            'instagram_url' => 'https://instagram.com/ppidarkan',
            'youtube_url' => 'https://youtube.com/@ppidarkan',
            'footer_text' => 'Hak Cipta © ' . date('Y') . ' PPID Arkan. Seluruh hak cipta dilindungi undang-undang.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // 3. Seed Sample Pages
        $pages = [
            // Profil Pemerintah
            [
                'title' => 'Visi dan Misi Pemerintah Daerah',
                'slug' => 'visi-misi-pemerintah-daerah',
                'category' => 'profil-pemerintah',
                'order' => 1,
                'is_active' => true,
                'content' => '<h2>Visi</h2><p>Mewujudkan Daerah yang Maju, Sejahtera, Transparan, Berkelanjutan dan Berdaya Saing Global.</p><h2>Misi</h2><ol><li>Meningkatkan kualitas tata kelola pemerintahan yang bersih, akuntabel, dan transparan melalui digitalisasi birokrasi.</li><li>Mewujudkan pemerataan infrastruktur yang ramah lingkungan dan terintegrasi antarwilayah.</li><li>Meningkatkan mutu sumber daya manusia melalui pelayanan pendidikan dan kesehatan yang prima dan terjangkau.</li><li>Mengembangkan potensi ekonomi lokal, pariwisata, dan kemandirian usaha mikro kecil menengah.</li></ol>',
            ],
            [
                'title' => 'Profil Singkat & Pimpinan Daerah',
                'slug' => 'profil-singkat-pimpinan-daerah',
                'category' => 'profil-pemerintah',
                'order' => 2,
                'is_active' => true,
                'content' => '<p>Pemerintah Daerah senantiasa berkomitmen untuk memberikan pelayanan publik terbaik kepada seluruh lapisan masyarakat melalui prinsip akuntabilitas dan transparansi keterbukaan informasi.</p><h3>Susunan Pimpinan Daerah:</h3><ul><li><strong>Bupati / Walikota:</strong> Dr. H. Arkan Pratama, S.IP., M.Si.</li><li><strong>Wakil Bupati / Walikota:</strong> Hj. Siti Nurhaliza, S.H., M.H.</li><li><strong>Sekretaris Daerah:</strong> Drs. Ahmad Fauzi, M.M.</li></ul>',
            ],
            [
                'title' => 'Struktur Organisasi Pemerintah Daerah',
                'slug' => 'struktur-organisasi-pemerintah',
                'category' => 'profil-pemerintah',
                'order' => 3,
                'is_active' => true,
                'content' => '<p>Bagan Struktur Organisasi Pemerintah Daerah disusun berdasarkan Peraturan Daerah tentang Pembentukan dan Susunan Perangkat Daerah guna mendukung penyelenggaraan tata kelola pemerintahan yang efektif dan efisien.</p>',
            ],

            // Profil PPID
            [
                'title' => 'Profil Singkat PPID',
                'slug' => 'profil-singkat-ppid',
                'category' => 'profil-ppid',
                'order' => 1,
                'is_active' => true,
                'content' => '<p>Pejabat Pengelola Informasi dan Dokumentasi (PPID) berfungsi sebagai pengelola dan penyampai dokumen serta informasi yang dimiliki oleh Badan Publik sesuai dengan amanat Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</p><p>Dengan keberadaan PPID, masyarakat dapat dengan mudah mengajukan permohonan informasi publik secara cepat, tepat waktu, dan berbiaya ringan.</p>',
            ],
            [
                'title' => 'Visi dan Misi PPID',
                'slug' => 'visi-misi-ppid',
                'category' => 'profil-ppid',
                'order' => 2,
                'is_active' => true,
                'content' => '<h2>Visi PPID</h2><p>Terwujudnya pelayanan informasi publik yang profesional, transparan, akuntabel, dan terpercaya menuju masyarakat informatif.</p><h2>Misi PPID</h2><ul><li>Menyediakan informasi publik yang akurat, benar, dan tidak menyesatkan.</li><li>Mengembangkan sistem pendokumentasian dan pelayanan informasi secara modern dan terintegrasi secara elektronik.</li><li>Meningkatkan kompetensi pengelola pelayanan informasi publik.</li><li>Membangun komunikasi dan koordinasi yang harmonis antara perangkat daerah pengelola informasi publik.</li></ul>',
            ],
            [
                'title' => 'Tugas, Wewenang, dan Tanggung Jawab PPID',
                'slug' => 'tugas-wewenang-ppid',
                'category' => 'profil-ppid',
                'order' => 3,
                'is_active' => true,
                'content' => '<h3>Tugas PPID:</h3><ul><li>Mengkoordinasikan pengumpulan seluruh Informasi Publik dari setiap unit kerja.</li><li>Mengkoordinasikan pendokumentasian dan pengarsipan Informasi Publik.</li><li>Mengkoordinasikan penyediaan dan pelayanan Informasi Publik melalui sistem informasi berbasis web maupun tatap muka.</li></ul><h3>Wewenang PPID:</h3><ul><li>Menolak permohonan Informasi Publik secara tertulis apabila informasi yang dimohon termasuk informasi yang dikecualikan dengan disertai alasan serta pemberitahuan tentang hak pemohon.</li><li>Menetapkan pengujian konsekuensi atas informasi yang dikecualikan.</li></ul>',
            ],
            [
                'title' => 'Struktur PPID Utama dan PPID Pelaksana',
                'slug' => 'struktur-ppid',
                'category' => 'profil-ppid',
                'order' => 4,
                'is_active' => true,
                'content' => '<p>PPID diketuai oleh Sekretaris Daerah selaku Pengarah, Kepala Dinas Komunikasi dan Informatika selaku PPID Utama, serta seluruh Kepala Organisasi Perangkat Daerah (OPD) bertindak sebagai PPID Pelaksana pada masing-masing unit kerja.</p>',
            ],

            // Layanan
            [
                'title' => 'Maklumat Pelayanan Informasi Publik',
                'slug' => 'maklumat-pelayanan',
                'category' => 'layanan',
                'order' => 1,
                'is_active' => true,
                'content' => '<blockquote>"Kami berkomitmen untuk memberikan pelayanan informasi publik yang transparan, profesional, akuntabel, tepat waktu, dan bertanggung jawab sesuai dengan peraturan perundang-undangan yang berlaku demi kepuasan pemohon informasi."</blockquote>',
            ],
            [
                'title' => 'Prosedur Permohonan Informasi Publik',
                'slug' => 'prosedur-permohonan-informasi',
                'category' => 'layanan',
                'order' => 2,
                'is_active' => true,
                'content' => '<ol><li>Pemohon informasi mengajukan permohonan secara online melalui formulir daring PPID atau langsung ke Desk Layanan Informasi PPID.</li><li>Menyertakan identitas diri yang sah (KTP untuk perorangan, Akta Notaris/SK Kemenkumham untuk Badan Hukum).</li><li>Petugas mencatat dan memverifikasi kelengkapan permohonan serta menerbitkan bukti tanda terima register.</li><li>PPID memproses permohonan dalam waktu maksimal 10 hari kerja (dapat diperpanjang 7 hari kerja dengan pemberitahuan tertulis).</li><li>Pemohon menerima keputusan dan salinan informasi yang dimohonkan sesuai dengan metode penyerahan yang dipilih.</li></ol>',
            ],
            [
                'title' => 'Prosedur Pengajuan Keberatan Informasi',
                'slug' => 'prosedur-pengajuan-keberatan',
                'category' => 'layanan',
                'order' => 3,
                'is_active' => true,
                'content' => '<p>Setiap pemohon informasi publik berhak mengajukan keberatan kepada Atasan PPID apabila:</p><ul><li>Permohonan informasi ditolak tanpa alasan yang sah.</li><li>Informasi tidak disediakan dalam batas waktu 10 + 7 hari kerja.</li><li>Permintaan informasi tidak ditanggapi sebagaimana mestinya.</li><li>Biaya yang dikenakan tidak wajar.</li></ul><p>Atasan PPID wajib memberikan tanggapan tertulis atas keberatan paling lambat 30 hari kerja sejak permohonan keberatan diterima secara resmi.</p>',
            ],
            [
                'title' => 'Standar Biaya dan Waktu Pelayanan',
                'slug' => 'standar-biaya-waktu-pelayanan',
                'category' => 'layanan',
                'order' => 4,
                'is_active' => true,
                'content' => '<p><strong>Standar Biaya:</strong> Pelayanan permohonan informasi publik pada PPID tidak dipungut biaya (GRATIS). Biaya fotokopi atau media penyimpanan fisik (CD/Flashdisk) ditanggung sendiri oleh pemohon informasi bila diperlukan.</p><p><strong>Standar Waktu:</strong> Jangka waktu pemenuhan informasi publik adalah 10 (sepuluh) hari kerja dan dapat diperpanjang paling lambat 7 (tujuh) hari kerja.</p>',
            ],

            // Laporan Pemda
            [
                'title' => 'Laporan Kinerja Instansi Pemerintah (LKjIP)',
                'slug' => 'laporan-kinerja-instansi-pemerintah',
                'category' => 'laporan-pemda',
                'order' => 1,
                'is_active' => true,
                'content' => '<p>Laporan Kinerja Instansi Pemerintah (LKjIP) merupakan bentuk pertanggungjawaban pelaksanaan tugas, fungsi, dan wewenang perangkat daerah dalam mencapai target kinerja yang telah ditetapkan pada RPJMD dan Renstra tahun berkenaan.</p>',
            ],
            [
                'title' => 'Laporan Keuangan Pemerintah Daerah (LKPD)',
                'slug' => 'laporan-keuangan-pemerintah-daerah',
                'category' => 'laporan-pemda',
                'order' => 2,
                'is_active' => true,
                'content' => '<p>Laporan Keuangan Pemerintah Daerah (LKPD) yang telah diaudit oleh Badan Pemeriksa Keuangan (BPK) RI dengan opini Wajar Tanpa Pengecualian (WTP), sebagai bukti akuntabilitas pengelolaan anggaran daerah yang transparan dan dapat dipertanggungjawabkan.</p>',
            ],

            // Laporan PPID
            [
                'title' => 'Laporan Layanan Informasi Publik Tahunan',
                'slug' => 'laporan-layanan-informasi-tahunan',
                'category' => 'laporan-ppid',
                'order' => 1,
                'is_active' => true,
                'content' => '<p>Laporan tahunan pelaksanaan layanan informasi publik PPID memuat ringkasan jumlah permohonan informasi yang diterima, dikabulkan, ditolak beserta alasan penolakan, serta pengajuan keberatan yang diselesaikan selama tahun anggaran berjalan.</p>',
            ],
            [
                'title' => 'Statistik dan Evaluasi Layanan Informasi Publik',
                'slug' => 'statistik-evaluasi-layanan',
                'category' => 'laporan-ppid',
                'order' => 2,
                'is_active' => true,
                'content' => '<p>Grafik dan ringkasan statistik keterbukaan informasi publik, waktu rata-rata respon, indeks kepuasan masyarakat terhadap layanan PPID, serta rekomendasi peningkatan mutu berkelanjutan.</p>',
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 4. Seed Banners
        $banners = [
            [
                'title' => 'Selamat Datang di Portal PPID Arkan',
                'subtitle' => 'Layanan Keterbukaan Informasi Publik yang Transparan, Akuntabel, dan Terintegrasi',
                'image' => 'https://images.unsplash.com/photo-1541872703-74c5e44368f9?auto=format&fit=crop&w=1200&q=80',
                'link' => '/page/profil-singkat-ppid',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Permohonan Informasi Publik Mudah & Cepat',
                'subtitle' => 'Ajukan permintaan informasi publik secara online dari mana saja dan kapan saja',
                'image' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&w=1200&q=80',
                'link' => '/permohonan-informasi',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Transparansi Dokumen & Informasi Berkala',
                'subtitle' => 'Unduh laporan berkala, informasi serta merta, dan informasi setiap saat secara terbuka',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1200&q=80',
                'link' => '/informasi-publik/berkala',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $b) {
            Banner::updateOrCreate(['title' => $b['title']], $b);
        }

        // 5. Seed Documents
        $documents = [
            // Berkala
            [
                'title' => 'Rencana Kerja Pemerintah Daerah (RKPD) Tahun 2024',
                'description' => 'Dokumen perencanaan tahunan pembangunan daerah yang memuat kerangka ekonomi dan prioritas program kerja.',
                'file_path' => 'documents/sample_rkpd_2024.pdf',
                'category' => 'berkala',
                'year' => 2024,
                'is_active' => true,
                'download_count' => 142,
            ],
            [
                'title' => 'Ringkasan APBD Tahun Anggaran 2024',
                'description' => 'Ringkasan Anggaran Pendapatan dan Belanja Daerah mengenai postur pendapatan, belanja, dan pembiayaan.',
                'file_path' => 'documents/sample_apbd_2024.pdf',
                'category' => 'berkala',
                'year' => 2024,
                'is_active' => true,
                'download_count' => 235,
            ],
            [
                'title' => 'Laporan Kinerja Instansi Pemerintah (LKjIP) Tahun 2023',
                'description' => 'Laporan capaian sasaran strategis instansi pemerintah daerah untuk tahun anggaran 2023.',
                'file_path' => 'documents/sample_lkjip_2023.pdf',
                'category' => 'berkala',
                'year' => 2023,
                'is_active' => true,
                'download_count' => 98,
            ],
            [
                'title' => 'Daftar Informasi Publik (DIP) PPID Tahun 2024',
                'description' => 'Katalog lengkap daftar informasi publik yang dikuasai oleh badan publik PPID.',
                'file_path' => 'documents/sample_dip_2024.pdf',
                'category' => 'berkala',
                'year' => 2024,
                'is_active' => true,
                'download_count' => 310,
            ],

            // Serta Merta
            [
                'title' => 'Peringatan Dini Cuaca Ekstrem dan Potensi Bencana Hidrometeorologi',
                'description' => 'Informasi darurat kewaspadaan bencana banjir dan tanah longsor di beberapa wilayah rawan.',
                'file_path' => 'documents/sample_peringatan_bencana.pdf',
                'category' => 'serta-merta',
                'year' => 2024,
                'is_active' => true,
                'download_count' => 520,
            ],
            [
                'title' => 'Pemberitahuan Gangguan Distribusi Air Bersih dan Jadwal Perbaikan',
                'description' => 'Informasi pemeliharaan pipa induk utama air minum PDAM dan skema bantuan mobil tangki air.',
                'file_path' => 'documents/sample_gangguan_air.pdf',
                'category' => 'serta-merta',
                'year' => 2024,
                'is_active' => true,
                'download_count' => 175,
            ],

            // Setiap Saat
            [
                'title' => 'SOP Standar Operasional Prosedur Pelayanan Informasi PPID',
                'description' => 'Pedoman operasional tata kelola pengajuan permohonan informasi hingga penyampaian tanggapan resmi.',
                'file_path' => 'documents/sample_sop_ppid.pdf',
                'category' => 'setiap-saat',
                'year' => 2023,
                'is_active' => true,
                'download_count' => 88,
            ],
            [
                'title' => 'Peraturan Daerah tentang Keterbukaan Informasi Publik',
                'description' => 'Regulasi payung hukum daerah yang mengatur hak publik atas dokumen dan informasi pemerintah.',
                'file_path' => 'documents/sample_perda_kip.pdf',
                'category' => 'setiap-saat',
                'year' => 2022,
                'is_active' => true,
                'download_count' => 156,
            ],
            [
                'title' => 'Daftar Rencana Pengadaan Barang dan Jasa Pemerintah (SiRUP) 2024',
                'description' => 'Paket pengadaan barang/jasa pemerintah daerah yang diumumkan melalui portal pengadaan resmi.',
                'file_path' => 'documents/sample_sirup_2024.pdf',
                'category' => 'setiap-saat',
                'year' => 2024,
                'is_active' => true,
                'download_count' => 204,
            ],
        ];

        foreach ($documents as $d) {
            Document::updateOrCreate(['title' => $d['title']], $d);
        }

        // 6. Seed Sample Posts (News)
        $posts = [
            [
                'title' => 'PPID Arkan Raih Predikat Badan Publik Informatif Kategori Utama',
                'slug' => 'ppid-arkan-raih-predikat-badan-publik-informatif',
                'excerpt' => 'Komitmen keterbukaan informasi membuahkan penghargaan bergengsi tingkat nasional dari Komisi Informasi.',
                'content' => '<p>PPID Arkan kembali mencatatkan prestasi membanggakan dengan meraih predikat Badan Publik "Informatif" pada evaluasi kepatuhan Undang-Undang KIP yang diselenggarakan oleh Komisi Informasi Pusat. Penghargaan ini menjadi wujud nyata komitmen seluruh jajaran pemerintah dalam memberikan pelayanan informasi yang jujur, cepat, dan transparan.</p><p>Bupati Arkan menyampaikan apresiasi setinggi-tingginya kepada seluruh tim PPID dan Organisasi Perangkat Daerah yang terus berinovasi dalam mempermudah akses informasi bagi masyarakat.</p>',
                'image' => 'https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?auto=format&fit=crop&w=800&q=80',
                'category' => 'berita',
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'author' => 'Tim Humas PPID',
                'view_count' => 450,
            ],
            [
                'title' => 'Sosialisasi Hak Akses Informasi Publik bagi Mahasiswa dan Masyarakat Umum',
                'slug' => 'sosialisasi-hak-akses-informasi-publik',
                'excerpt' => 'Kegiatan bimbingan teknis keterbukaan informasi publik guna mendorong partisipasi aktif masyarakat.',
                'content' => '<p>Guna meningkatkan literasi publik tentang hak memperoleh informasi, PPID menggelar sosialisasi daring dan luring yang dihadiri ratusan mahasiswa dan perwakilan lembaga swadaya masyarakat. Materi mencakup mekanisme permohonan informasi publik serta prosedur pengajuan keberatan secara bertanggung jawab.</p>',
                'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80',
                'category' => 'berita',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'author' => 'Redaksi PPID',
                'view_count' => 280,
            ],
            [
                'title' => 'Peningkatan Keamanan Data dan Integritas Sistem Layanan PPID Digital',
                'slug' => 'peningkatan-keamanan-data-sistem-ppid',
                'excerpt' => 'Langkah preventif pengamanan data pemohon informasi sesuai dengan standar ISO 27001.',
                'content' => '<p>Dinas Komunikasi dan Informatika bersama PPID meluncurkan peningkatan infrastruktur keamanan server dan enkripsi data pribadi pemohon informasi demi menjaga kerahasiaan NIK dan identitas pemohon sesuai regulasi perlindungan data pribadi.</p>',
                'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=800&q=80',
                'category' => 'berita',
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'author' => 'Admin PPID',
                'view_count' => 195,
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }

        // 7. Seed Sample Galleries
        $galleries = [
            [
                'title' => 'Penyerahan Piagam Apresiasi Keterbukaan Informasi',
                'description' => 'Momen penyerahan penghargaan kepada instansi perangkat daerah terbaik dalam pelayanan informasi.',
                'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=800&q=80',
                'category' => 'kegiatan',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Rapat Koordinasi PPID Utama dan PPID Pelaksana',
                'description' => 'Koordinasi penyusunan Daftar Informasi Publik (DIP) dan Daftar Informasi Dikecualikan (DIK).',
                'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80',
                'category' => 'rapat',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Pelayanan Tatap Muka Desk Informasi Publik',
                'description' => 'Petugas melayani warga yang mengajukan konsultasi dokumen secara langsung di loket pelayanan.',
                'image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=800&q=80',
                'category' => 'pelayanan',
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($galleries as $g) {
            Gallery::updateOrCreate(['title' => $g['title']], $g);
        }

        // 8. Seed Sample Information Request & Objection
        $req = InformationRequest::updateOrCreate(
            ['request_number' => 'REQ-2024-0001'],
            [
                'name' => 'Budi Santoso',
                'nik' => '1901020304050001',
                'address' => 'Jl. Sudirman No. 12, Kelurahan Melayu, Arkan',
                'phone' => '081298765432',
                'email' => 'budi.santoso@example.com',
                'occupation' => 'Peneliti Akademisi',
                'information_requested' => 'Data realisasi anggaran belanja modal infrastruktur jalan tahun 2023',
                'purpose' => 'Riset penelitian tesis magister pembangunan wilayah',
                'how_to_get' => 'email',
                'status' => 'completed',
                'response' => 'Data telah dikirimkan ke email terdaftar dalam format dokumen PDF dan Excel.',
                'responded_at' => now()->subDay(),
            ]
        );

        Objection::updateOrCreate(
            ['objection_number' => 'OBJ-2024-0001'],
            [
                'name' => 'Budi Santoso',
                'address' => 'Jl. Sudirman No. 12, Kelurahan Melayu, Arkan',
                'phone' => '081298765432',
                'information_request_id' => $req->id,
                'reason' => 'Konfirmasi permintaan lampiran rincian pagu proyek spesifik',
                'status' => 'pending',
                'response' => null,
            ]
        );
    }
}
