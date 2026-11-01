<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\StaffMember;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $pages = Page::orderBy('id')->get()->keyBy('slug');
        $settings = SiteSetting::pluck('value', 'key');
        $facilities = Facility::orderBy('id')->get();
        $principal = StaffMember::orderBy('order_index')->first();
        $vicePrincipals = StaffMember::where('department', 'like', '%Wakil Kepala%')
            ->orderBy('order_index')
            ->get();

        return view('public.profile', compact(
            'pages',
            'settings',
            'facilities',
            'principal',
            'vicePrincipals'
        ));
    }

    public function history(): View
    {
        $settings = SiteSetting::pluck('value', 'key');

        $heroStats = [
            [
                'target' => '1962',
                'suffix' => '',
                'label' => 'Tahun Berdiri',
                'sub' => 'SK No. 17/Djapt/B1/62 (24 Sep 1962)',
            ],
            [
                'target' => '10,600',
                'suffix' => ' m²',
                'label' => 'Luas Lahan Sekolah',
                'sub' => 'Jl. HOS Cokroaminoto No. 84 Ubung',
            ],
            [
                'target' => '6,000',
                'suffix' => ' m²',
                'label' => 'Luas Total Bangunan',
                'sub' => 'Bengkel Kerja, Lab & Kelas Permanen',
            ],
        ];

        $milestones = [
            [
                'number' => '01',
                'year' => '1962',
                'date_badge' => '24 September 1962',
                'phase' => 'Fase Awal: STM Negeri Denpasar',
                'decree' => 'SK No. 17/Djapt/B1/62 (17/DJAPT/131/62)',
                'title' => 'Prakarsa Pemda Tk. I Bali & Era Kelas Sore Menumpang di Tulangampiang',
                'summary' => 'Didirikan untuk mengatasi defisit akut tenaga kerja teknis tingkat menengah di Bali pascakemerdekaan. Penyelenggaraan awal dijalankan oleh Pemda Tk. II Badung bekerja sama dengan Departemen Pekerjaan Umum (PU). Karena belum memiliki gedung dan bengkel mandiri, perkuliahan teori dan administrasi dilaksanakan pada sore hari menumpang di SD Percobaan Tulangampiang (kompleks Gedung ST Negeri Tulangampiang).',
                'highlights' => [
                    [
                        'label' => 'Kepala Sekolah Pertama',
                        'value' => 'Ida Bagus Suparsa (merangkap Pimpinan ST Negeri Denpasar untuk integrasi sumber daya ruang belajar di Tulangampiang).',
                    ],
                    [
                        'label' => '2 Jurusan Pionir (1962)',
                        'value' => 'Jurusan Bangunan Gedung & Jurusan Mesin (dikoordinasikan langsung oleh Ir. Cokorda Raka Sukawati, penemu konstruksi jalan layang Sosrobahu, bersama tim ahli CIP Denpasar).',
                    ],
                    [
                        'label' => 'Lokasi Praktik Awal & Tim Pengajar',
                        'value' => 'Praktik langsung di PALDAM, bengkel Departemen PU, Patal Tohpati, Proyek Bandara Internasional Ngurah Rai Tuban, dan Hotel Grand Bali Beach Sanur. Pengajar teknis dari PU (Rohim, BE., Ir. Zainudin, I Ketut Arka, Ir. Adenan) dan guru umum dari SMA/SGA (I Ketut Sujana, BA., Drs. I Putu Sudana, I Ketut Karang, BA.).',
                    ],
                ],
                'photo' => null,
            ],
            [
                'number' => '02',
                'year' => '1970',
                'date_badge' => 'Dekade 1970-an',
                'phase' => 'Fase Ekspansi: Bantuan Bilateral & PELITA',
                'decree' => 'Proyek PELITA • Proyek N.11 • Proyek N.95 (Indonesia - Belanda)',
                'title' => 'Modernisasi Fasilitas lewat Proyek PELITA, Proyek N.11, dan N.95',
                'summary' => 'Lonjakan minat masyarakat Bali terhadap pendidikan teknik membuat kapasitas gedung tumpangan di Tulangampiang tidak lagi memadai. Pemerintah pusat mengintervensi melalui program Pembangunan Lima Tahun (Proyek PELITA), pengadaan sarana teknis Proyek N.11, serta bantuan kerja sama teknis bilateral antara Pemerintah Republik Indonesia dan Pemerintah Kerajaan Belanda (Proyek N.95).',
                'highlights' => [
                    [
                        'label' => 'Pengadaan Lahan & Bengkel',
                        'value' => 'Pembebasan lahan luas di kawasan Ubung, Denpasar Utara, lengkap dengan pembangunan bengkel kerja permanen dan mesin-mesin industri.',
                    ],
                    [
                        'label' => 'Standarisasi Instruktur',
                        'value' => 'Peningkatan kompetensi instruktur teknik dan pembaruan manajemen bengkel melalui asistensi teknis Indonesia-Belanda.',
                    ],
                ],
                'photo' => null,
            ],
            [
                'number' => '03',
                'year' => '1977',
                'date_badge' => '15 April 1977',
                'phase' => 'Fase Relokasi: Gedung Definitif Ubung',
                'decree' => 'Peresmian oleh Mendikbud RI Sjarif Thajeb',
                'title' => 'Peresmian Gedung Mandiri Jl. HOS Cokroaminoto No. 84 & Identitas "STM Negeri Ubung"',
                'summary' => 'Mengakhiri masa 15 tahun menumpang dan belajar sore di Tulangampiang, sekolah menempati kompleks gedung definitif seluas 10.600 m² dengan luas bangunan 6.000 m² di Jl. HOS Cokroaminoto No. 84, Ubung, Denpasar Utara. Gedung baru diresmikan langsung oleh Menteri Pendidikan dan Kebudayaan Republik Indonesia, Sjarif Thajeb.',
                'highlights' => [
                    [
                        'label' => 'Identitas Kultural Populer',
                        'value' => 'Sepanjang dekade 1980-an hingga 1990-an, masyarakat dan kalangan pelajar di Bali akrab menyebut sekolah ini sebagai "STM Negeri Ubung".',
                    ],
                    [
                        'label' => 'Ekspansi Jurusan Listrik (80% Praktik : 20% Teori)',
                        'value' => 'Pembukaan Jurusan Listrik dengan porsi 80% praktik lapangan: siswa memasang instalasi listrik rumah warga dan penerangan jalan raya untuk menjawab elektrifikasi Bali.',
                    ],
                ],
                'photo' => '/images/showcase/lapangan_upacara.jpg',
                'photo_caption' => 'Gedung Definitif Jl. HOS Cokroaminoto No. 84, Ubung (Lahan 10.600 m²)',
            ],
            [
                'number' => '04',
                'year' => '1997',
                'date_badge' => '1994 - 1997',
                'phase' => 'Fase Reorganisasi: Transisi Menjadi SMK',
                'decree' => 'SK Nomor 0537/C4.1/LL/97 (24 Maret 1997)',
                'title' => 'Perubahan Nomenklatur Nasional: Resmi Menjadi SMK Negeri 1 Denpasar',
                'summary' => 'Seiring kebijakan penyelarasan pendidikan kejuruan nasional pasca-pengembangan Proyek N.95, restrukturisasi kurikulum dan kelembagaan dimulai pada tahun 1994 dan dikukuhkan secara yuridis formal menjadi SMK Negeri 1 Denpasar melalui Surat Keputusan Nomor 0537/C4.1/LL/97.',
                'highlights' => [
                    [
                        'label' => 'Status Kelembagaan',
                        'value' => 'Ditetapkan sebagai sekolah menengah kejuruan negeri rujukan utama kelompok Teknologi dan Industri di Kota Denpasar (NSS 32.1.22.09.00.001, NPSN 50103118).',
                    ],
                    [
                        'label' => 'Konsolidasi Kurikulum',
                        'value' => 'Penataan struktur organisasi bengkel kerja dan persiapan menuju kurikulum berbasis kompetensi.',
                    ],
                ],
                'photo' => null,
            ],
            [
                'number' => '05',
                'year' => '2006',
                'date_badge' => '22 Mei 2006',
                'phase' => 'Fase Kualitas Internasional & Revolusi TIK',
                'decree' => 'ISO 9001:2000 (Lic No: QEC 23382) • BAN-SM Akreditasi A',
                'title' => 'Sertifikasi Manajemen Mutu Dunia & Ekspansi 9 Unit Core Business',
                'summary' => 'SMK Negeri 1 Denpasar resmi menyandang predikat Sekolah Berstandar Mutu Internasional setelah meraih sertifikasi ISO 9001:2000 (Lic No: QEC 23382) pada 22 Mei 2006 di masa kepemimpinan Drs. I Gusti Ngurah Wijaya. Sekolah menerapkan pendekatan Broad Based Curriculum (BBC), Competency Based Training (CBT), dan Mastery Learning.',
                'highlights' => [
                    [
                        'label' => '5 Bidang & 12 Program Keahlian',
                        'value' => 'Melayani lebih dari 2.195 peserta didik dengan integrasi bidang Teknologi Informasi dan Komunikasi (TIK) serta spesialisasi Teknik Pendingin dan Tata Udara (HVAC).',
                    ],
                    [
                        'label' => '9 Unit Usaha Komersial (Core Business)',
                        'value' => 'Aktivasi Community College TI, Pelatihan AutoCAD, Produksi Mebelair, Servis AC, Mesin Tepat Guna, Las Fabrikasi, Tune Up, Servis Bosch Pump, dan Diklat KKPI.',
                    ],
                ],
                'photo' => '/images/gedung_skensa.jpg',
                'photo_caption' => 'Gedung Utama SMK Negeri 1 Denpasar Berstandar ISO 9001:2000 & Akreditasi A',
            ],
            [
                'number' => '06',
                'year' => 'Kini & Esok',
                'date_badge' => 'Era Transformasi Vokasi',
                'phase' => 'Pusat Keunggulan & Jejaring Industri Global',
                'decree' => 'Kurikulum Merdeka • SMK Pusat Keunggulan • Akreditasi A',
                'title' => 'Transformasi Vokasi Berkelanjutan, Center of Excellence & Kolaborasi Global',
                'summary' => 'Di bawah kepemimpinan I Wayan Mustika, S.Pd., M.Pd., MAP, MM. (mengabdi di Skensa sejak 1990), sekolah mengakselerasi transformasi SMK Pusat Keunggulan melalui Kurikulum Merdeka, kemitraan industri modern bersama Daikin Center of Excellence, pengoperasian TUK LSP Bina Konstruksi Nusantara, serta penataan kawasan suci Parahyangan sekolah.',
                'highlights' => [
                    [
                        'label' => 'Prestasi LKS Nasional & SMK Go Global',
                        'value' => 'Menyumbangkan 3 dari 5 medali kontingen Provinsi Bali pada LKS Nasional serta bersinergi dengan BP3MI Bali untuk pemetaan karier kerja lulusan ke panggung internasional.',
                    ],
                    [
                        'label' => 'Center of Excellence & Budaya Industri',
                        'value' => 'Penyelarasan kurikulum modern bersama Daikin CoE dan lebih dari 120 mitra DUDIKA nasional maupun multinasional guna mencetak teknisi vokasi berdaya saing global.',
                    ],
                ],
                'photo' => '/images/showcase/daikin_coe.jpg',
                'photo_caption' => 'Peresmian Daikin Center of Excellence Pertama di Bali di SMK Negeri 1 Denpasar',
            ],
        ];

        $eraMatrix = [
            [
                'parameter' => 'Nama Resmi Institusi',
                'era_1' => 'STM Negeri Denpasar',
                'era_2' => 'STM Negeri Denpasar (STM Negeri Ubung) / SMK Negeri 1 Denpasar',
                'era_3' => 'SMK Negeri 1 Denpasar (Skensa)',
            ],
            [
                'parameter' => 'Identitas Administratif',
                'era_1' => 'SK Nomor 17/Djapt/B1/62 (17/DJAPT/131/62) tertanggal 24 September 1962',
                'era_2' => 'SK Nomor 0537/C4.1/LL/97; NSS 32.1.22.09.00.001',
                'era_3' => 'NPSN 50103118; SK Akreditasi 1347/BAN-SM/SK/2021 (Peringkat A)',
            ],
            [
                'parameter' => 'Lokasi & Fasilitas Utama',
                'era_1' => 'Menumpang di SD Percobaan / Gedung ST Negeri Tulangampiang (kegiatan belajar sore hari)',
                'era_2' => 'Gedung Jl. HOS Cokroaminoto No. 84, Ubung (Diresmikan 15 April 1977 oleh Mendikbud Sjarif Thajeb)',
                'era_3' => 'Gedung Jl. HOS Cokroaminoto No. 84 Ubung (Luas Lahan 10.600 m², Luas Bangunan 6.000 m²) & Kawasan Suci Parahyangan',
            ],
            [
                'parameter' => 'Lokasi Praktik Siswa',
                'era_1' => 'Eksternal: Instalasi militer PALDAM, Bengkel Departemen PU, Patal Tohpati, Proyek Bandara Ngurah Rai Tuban, Hotel Grand Bali Beach Sanur',
                'era_2' => 'Internal & Lapangan: Bengkel kerja sekolah Ubung (bantuan Proyek PELITA, N.11, N.95 Belanda) & instalasi listrik rumah warga / jalan raya',
                'era_3' => 'Internal & Industri Global: Bengkel terpadu, Pusat Keunggulan Daikin (HVAC), TUK Beton Aspal LSP Bina Konstruksi Nusantara, mitra DUDIKA & SMK Go Global',
            ],
            [
                'parameter' => 'Populasi Siswa & Standar Mutu',
                'era_1' => 'Rintisan terbatas (2 jurusan pionir: Bangunan Gedung & Mesin pada kelas sore)',
                'era_2' => '2.195 peserta didik; Sertifikasi Internasional ISO 9001:2000 (Lic No: QEC 23382, 22 Mei 2006)',
                'era_3' => '2.046 hingga 2.394 siswa aktif (melepas hingga 854 lulusan per angkatan pada 2023, 79 diterima di PTN)',
            ],
        ];

        $principals = [
            [
                'order' => '01',
                'name' => 'Ida Bagus Suparsa',
                'period' => '1962 - Era Awal Perintisan',
                'role_badge' => 'Kepala Sekolah Pertama (Konkuren Pimpinan ST Negeri Denpasar)',
                'nip' => null,
                'has_photo' => false,
                'photo' => null,
                'focus' => 'Integrasi Sumber Daya Tulangampiang & Koordinasi Insinyur Proyek Mercusuar Bali',
                'description' => 'Memegang tampuk kepemimpinan pertama STM Negeri Denpasar pada tahun 1962 sembari menjabat sebagai Pimpinan ST Negeri Denpasar di Tulangampiang. Otoritas ganda beliau memungkinkan pemanfaatan fasilitas bersama secara mulus di tengah keterbatasan anggaran negara, sekaligus mengoordinasikan jadwal pengajar praktisi dari Departemen PU, CIP Denpasar (Ir. Cokorda Raka Sukawati), dan proyek infrastruktur strategis nasional di Bali.',
                'achievements' => [
                    'Penyelenggaraan kelas sore rintisan Jurusan Bangunan Gedung dan Jurusan Mesin (SK No. 17/Djapt/B1/62).',
                    'Integrasi praktik kerja siswa secara langsung di PALDAM, Departemen PU, Patal Tohpati, Bandara Tuban, dan Hotel Grand Bali Beach Sanur.',
                ],
            ],
            [
                'order' => '02',
                'name' => 'Drs. Nengah Kawi Sindu',
                'period' => 'Era Transisi (Pra-2006)',
                'role_badge' => 'Kepala Sekolah Era Konsolidasi SMK',
                'nip' => null,
                'has_photo' => false,
                'photo' => null,
                'focus' => 'Konsolidasi Bengkel Sekolah Ubung & Penyesuaian Nomenklatur SMK Negeri 1 Denpasar',
                'description' => 'Memimpin pada fase transisi pasca-perubahan bentuk dari STM Negeri Denpasar menjadi SMK Negeri 1 Denpasar sebelum pertengahan dekade 2000-an. Fokus kepemimpinan diarahkan pada penataan manajemen bengkel kerja di sekolah Ubung dan adaptasi struktur kurikulum nasional. Dalam dokumen mutasi pimpinan sekolah menengah Disdikpora Kota Denpasar (Juni 2009), beliau juga tercatat pernah mengemban amanat sebagai Plt. Kepala SMAN 7 Denpasar.',
                'achievements' => [
                    'Konsolidasi tata kelola kelembagaan pasca-penetapan SK Nomor 0537/C4.1/LL/97.',
                    'Penguatan fungsi bengkel kerja permanen hasil pengembangan Proyek PELITA dan kerja sama Indonesia-Belanda (Proyek N.95).',
                ],
            ],
            [
                'order' => '03',
                'name' => 'Drs. I Gusti Ngurah Wijaya',
                'period' => 'Pertengahan 2000-an - Awal 2010-an',
                'role_badge' => 'Kepala Sekolah Era Standarisasi Internasional ISO 9001:2000',
                'nip' => '19591127 198603 1 009',
                'has_photo' => false,
                'photo' => null,
                'focus' => 'Sertifikasi Manajemen Mutu Dunia ISO 9001:2000, Ekspansi TIK & 9 Unit Core Business',
                'description' => 'Mengantarkan SMK Negeri 1 Denpasar melakukan lompatan besar menuju standarisasi manajemen mutu internasional yang terdokumentasi aktif sejak 2006, 2008, hingga awal 2010-an. Di bawah kepemimpinan beliau, sekolah meraih sertifikasi ISO 9001:2000 pada 22 Mei 2006, menerapkan Kurikulum 1999 dan 2004 berbasis kompetensi (BBC, CBT, Mastery Learning), serta memekarkan bidang Teknologi Informasi dan Komunikasi (TIK).',
                'achievements' => [
                    'Perolehan sertifikasi manajemen mutu internasional ISO 9001:2000 (Nomor Lisensi: QEC 23382) pada 22 Mei 2006.',
                    'Pengoperasian 9 unit produksi komersial (Core Business) termasuk Community College TI dan dominasi medali LKS tingkat kota hingga nasional.',
                ],
            ],
            [
                'order' => '04',
                'name' => 'Drs. I Ketut Suparsa, S.T., M.T.',
                'period' => 'Pertengahan 2010-an - Januari 2023',
                'role_badge' => 'Kepala Sekolah Era Inovasi Teknologi Hijau & Ketahanan Pandemi',
                'nip' => null,
                'has_photo' => false,
                'photo' => null,
                'focus' => 'Rekayasa Kendaraan/Kompor Listrik Mandiri & Adaptasi Pembelajaran Era Pandemi',
                'description' => 'Berlatar belakang pendidikan teknik (Sarjana Teknik dan Magister Teknik), beliau memimpin SMK Negeri 1 Denpasar dalam rentang panjang (tercatat pada dokumen kedinasan 2016, 2017, 2019, 2021 hingga awal 2023). Beliau mengarahkan fokus sekolah pada riset terapan dan teknologi hijau, serta menjaga ketahanan mutu pendidikan vokasi selama masa krisis pandemi COVID-19.',
                'achievements' => [
                    'Rancang bangun sepeda motor listrik dan kompor listrik mandiri oleh siswa dan guru yang mendapat apresiasi langsung Gubernur Bali Wayan Koster.',
                    'Sinergi penanganan pandemi bersama Polda Bali hingga meraih Piagam Penghargaan Kapolda Bali pada November 2021 serta Akreditasi A (SK 1347/BAN-SM/SK/2021).',
                ],
            ],
            [
                'order' => '05',
                'name' => 'I Wayan Mustika, S.Pd., M.Pd., MAP, MM.',
                'period' => '18 Januari 2023 - Sekarang',
                'role_badge' => 'Kepala Sekolah Era Kurikulum Merdeka & Sinergi Industri Global',
                'nip' => 'Pengabdian Guru Skensa Sejak 1990 (Lebih dari 3 Dekade Dedikasi)',
                'has_photo' => true,
                'photo' => '/images/kepala-sekolah-i-wayan-mustika.jpg',
                'cutout_photo' => '/images/hero_siswa_transparan.png',
                'event_photo' => '/images/showcase/hut_63_pimpinan.jpg',
                'focus' => 'Implementasi Kurikulum Merdeka, Pusat Keunggulan Daikin, SMK Go Global & Tata Kelola Transparan',
                'description' => 'Kader internal yang mengawali pengabdian sebagai guru di STM Negeri Ubung sejak tahun 1990, sempat menjabat Kepala SMKN 1 Petang Badung (2021-2023), lalu dilantik memimpin almamater pengabdiannya pada 18 Januari 2023. Dengan filosofi "bergerak seirama dan sefrekuensi", beliau memperluas kemitraan industri multinasional, menata kawasan suci Parahyangan sekolah, dan mengantarkan tata kelola sekolah yang dinilai sangat transparan serta akuntabel oleh Pengawas Disdikpora Bali (I Wayan Suwira, M.Si., M.Pd.) dan Ketua Komite (I Nyoman Keramas).',
                'achievements' => [
                    'Peresmian Pusat Keunggulan (Center of Excellence) PT Daikin Airconditioning Indonesia pertama di Bali & program SMK Go Global bersama BP3MI Bali.',
                    'Dinobatkan sebagai Kepala Sekolah Dedikatif Peringkat Pertama Provinsi Bali (mewakili Bali di tingkat nasional) & menyumbang 3 medali bagi Bali pada LKS Nasional.',
                ],
            ],
        ];

        $curriculumGenealogy = [
            'pioneer_1962' => [
                [
                    'name' => 'Jurusan Bangunan Gedung',
                    'desc' => 'Fokus konstruksi sipil & infrastruktur dasar pascakemerdekaan Bali (1962).',
                    'targets' => ['cluster-bangunan'],
                ],
                [
                    'name' => 'Jurusan Mesin',
                    'desc' => 'Dikoordinasikan oleh Ir. Cokorda Raka Sukawati & tim ahli CIP Denpasar (1962), disusul ekspansi Jurusan Listrik pada 1977.',
                    'targets' => ['cluster-mesin', 'cluster-listrik', 'cluster-elektronika', 'cluster-tik'],
                ],
            ],
            'modern_clusters' => [
                [
                    'id' => 'cluster-bangunan',
                    'field' => 'Teknik Bangunan / Konstruksi',
                    'era_1999' => 'Teknik Gambar Bangunan; Teknik Batu dan Beton; Teknik Konstruksi Kayu',
                    'era_modern' => [
                        'DPIB (Desain Pemodelan dan Informasi Bangunan)',
                        'BKP (Bisnis Konstruksi dan Properti)',
                        'Konstruksi Kayu / Mebelair',
                    ],
                    'accreditation' => 'Akreditasi A',
                    'focus' => 'Pemodelan arsitektur digital CADD, estimasi biaya properti, dan TUK Teknisi Laboratorium Beton Aspal (LSP Bina Konstruksi Nusantara).',
                ],
                [
                    'id' => 'cluster-listrik',
                    'field' => 'Teknik Ketenagalistrikan & Tata Udara',
                    'era_1999' => 'Teknik Pemanfaatan Tenaga Listrik; Teknik Pendingin & Tata Udara',
                    'era_modern' => [
                        'TITL (Teknik Instalasi Tenaga Listrik)',
                        'TPTU (Teknik Pendingin dan Tata Udara / HVAC)',
                    ],
                    'accreditation' => 'Akreditasi A',
                    'focus' => 'Instalasi kelistrikan komersial (berakar dari tradisi 80% praktik lapangan 1977) dan Daikin Center of Excellence (HVAC perhotelan & industri).',
                ],
                [
                    'id' => 'cluster-elektronika',
                    'field' => 'Teknik Elektronika',
                    'era_1999' => 'Teknik Audio Video; Teknik Elektronika Komunikasi',
                    'era_modern' => [
                        'TAV (Teknik Audio Video)',
                    ],
                    'accreditation' => 'Akreditasi A',
                    'focus' => 'Rekayasa rangkaian elektronika terapan, sistem akustik, dan perangkat transmisi audio-video.',
                ],
                [
                    'id' => 'cluster-mesin',
                    'field' => 'Teknik Mesin & Otomotif',
                    'era_1999' => 'Teknik Mesin Perkakas; Teknik Mekanik Otomotif; Teknik Sepeda Motor',
                    'era_modern' => [
                        'PM (Teknik Pemesinan)',
                        'TKRO (Teknik Kendaraan Ringan Otomotif)',
                        'TBSM (Teknik dan Bisnis Sepeda Motor)',
                    ],
                    'accreditation' => 'Akreditasi A',
                    'focus' => 'Manufaktur mesin perkakas, las fabrikasi, injeksi diesel Bosch Pump, hingga inovasi konversi sepeda motor listrik & kompor listrik.',
                ],
                [
                    'id' => 'cluster-tik',
                    'field' => 'Teknologi Informasi & Kreatif',
                    'era_1999' => 'Teknik Komputer dan Jaringan; Rekayasa Perangkat Lunak; Teknik Multimedia',
                    'era_modern' => [
                        'TKJ (Teknik Komputer dan Jaringan)',
                        'RPL (Rekayasa Perangkat Lunak)',
                        'Multimedia (MM) / DKV & Animasi',
                    ],
                    'accreditation' => 'Akreditasi A',
                    'focus' => 'Pengembangan perangkat lunak, arsitektur jaringan & fiber optik, desain komunikasi visual, dan animasi kreatif.',
                ],
            ],
        ];

        $coreBusinesses = [
            ['code' => '01', 'name' => 'CC Teknik Informatika', 'category' => 'Teknologi Informasi', 'desc' => 'Penyelenggaraan Community College (CC) bidang teknologi informasi dan jaringan.'],
            ['code' => '02', 'name' => 'Pelatihan AutoCAD', 'category' => 'Teknik Bangunan & Mesin', 'desc' => 'Pendidikan dan pelatihan menggambar teknik berbasis komputer (CADD).'],
            ['code' => '03', 'name' => 'Produksi Mebelair', 'category' => 'Konstruksi Kayu', 'desc' => 'Unit produksi furnitur dan pengerjaan kayu komersial berstandar industri.'],
            ['code' => '04', 'name' => 'Servis AC & Refrigerasi', 'category' => 'Tata Udara (HVAC)', 'desc' => 'Layanan perawatan dan perbaikan sistem pendingin ruang serta refrigerasi komersial.'],
            ['code' => '05', 'name' => 'Mesin Tepat Guna', 'category' => 'Teknik Pemesinan', 'desc' => 'Manufaktur dan rekayasa peralatan mesin tepat guna untuk kebutuhan produksi.'],
            ['code' => '06', 'name' => 'Produk Las Fabrikasi', 'category' => 'Pengelasan & Logam', 'desc' => 'Bengkel fabrikasi konstruksi logam dan pengelasan presisi.'],
            ['code' => '07', 'name' => 'Tune Up Mobil & Motor', 'category' => 'Teknik Otomotif', 'desc' => 'Pelatihan dan layanan perawatan berkala kendaraan roda empat dan roda dua.'],
            ['code' => '08', 'name' => 'Servis Bosch Pump', 'category' => 'Sistem Injeksi Diesel', 'desc' => 'Layanan kalibrasi dan perawatan khusus sistem injeksi bahan bakar mesin diesel.'],
            ['code' => '09', 'name' => 'Diklat KKPI & Komputer', 'category' => 'Komputasi Dasar', 'desc' => 'Program Keterampilan Komputer dan Pengelolaan Informasi bagi siswa dan masyarakat.'],
        ];

        $lksClusters = [
            [
                'id' => 'konstruksi',
                'name' => 'Konstruksi & Bangunan',
                'count' => 7,
                'max' => 8,
                'color' => '#2563EB',
                'fields' => [
                    'Bricklaying (Juara II, III)',
                    'Wall & Floor Tiling (Juara I, II)',
                    'Carpentry / Cabinet Making (Juara I)',
                    'CADD Building (Juara I)',
                    'Plumbing (Juara II)',
                ],
            ],
            [
                'id' => 'ti-digital',
                'name' => 'Teknologi Informasi & Digital',
                'count' => 6,
                'max' => 8,
                'color' => '#0891B2',
                'fields' => [
                    'IT / Software Application (Juara I, III)',
                    'Web Design (Juara I)',
                    'Graphic Design Technology (Juara II)',
                    'IT / Networking Support (Juara II)',
                ],
            ],
            [
                'id' => 'mesin-otomotif',
                'name' => 'Teknik Mesin & Otomotif',
                'count' => 5,
                'max' => 8,
                'color' => '#EA580C',
                'fields' => [
                    'Automobile Technology (Juara I)',
                    'Production Machine (Juara II, III)',
                    'Welding (Juara II)',
                    'CADD Mechanical Engineering (Juara III)',
                ],
            ],
            [
                'id' => 'listrik-elektronika',
                'name' => 'Listrik & Elektronika',
                'count' => 3,
                'max' => 8,
                'color' => '#0D9488',
                'fields' => [
                    'Electrical Installation / Commercial Wiring (Juara I, II)',
                    'Electronic Application (Juara I)',
                ],
            ],
        ];

        $citations = [
            ['no' => 1, 'title' => '63 Tahun SMKN 1 Denpasar, Sekolah Bidang Keahlian Teknologi dan Rekayasa Tertua di Bali', 'source' => 'Bali Prawara', 'url' => 'https://baliprawara.com/63-tahun-smkn-1-denpasar-sekolah-bidang-keahlian-teknologi-dan-rekayasa-tertua-di-bali/'],
            ['no' => 2, 'title' => 'SMK Negeri 1 Denpasar dan Kisah Sukses Lulusan Berprestasi', 'source' => 'Kompasiana', 'url' => 'https://www.kompasiana.com/masyuana/6895133aed641518fb716a63/dari-denpasar-dunia-smk-negeri-1-denpasar-dan-kisah-sukses-lulusan-berprestasi'],
            ['no' => 3, 'title' => 'Profile Sekolah - Virlib\'s SMK N 1 Denpasar (Perpustakaan Digital SMKN 1 Denpasar)', 'source' => 'WordPress / Virlib SMKN 1 Denpasar', 'url' => 'https://virlibsmkn1dps.wordpress.com/profile/profile-sekolah/'],
            ['no' => 4, 'title' => 'SMKN 1 DENPASAR - Detail Profil Sekolah', 'source' => 'Direktorat SMK Kemendikdasmen RI', 'url' => 'https://smk.kemendikdasmen.go.id/detail-sekolah/9981D373-6847-424F-8C5E-0938327E5AA7'],
            ['no' => 5, 'title' => 'SMK Negeri 1 Denpasar - Ensiklopedia', 'source' => 'P2K STEKOM', 'url' => 'https://p2k.stekom.ac.id/ensiklopedia/SMK_Negeri_1_Denpasar'],
            ['no' => 6, 'title' => 'Purnabakti I Wayan Mustika: Jejak Dedikasi dan Prestasi di SMKN 1 Denpasar', 'source' => 'Bali Prawara', 'url' => 'https://baliprawara.com/purnabakti-i-wayan-mustika-jejak-dedikasi-dan-prestasi-di-smkn-1-denpasar/'],
            ['no' => 7, 'title' => 'SMK Negeri 1 Denpasar', 'source' => 'Wikipedia Bahasa Indonesia', 'url' => 'https://id.wikipedia.org/wiki/SMK_Negeri_1_Denpasar'],
            ['no' => 8, 'title' => 'Bina Konstruksi Nusantara - Lembaga Sertifikasi Profesi (LSP)', 'source' => 'BNSP', 'url' => 'https://bnsp.go.id/lsp/bina-konstruksi-nusantara'],
            ['no' => 9, 'title' => 'Sejarah SMK Negeri 1 Denpasar (Dokumen Arsip)', 'source' => 'Scribd', 'url' => 'https://id.scribd.com/document/460838602/Sejarah-SMK-Negeri-1-Denpasar-docx'],
            ['no' => 10, 'title' => 'SMKN 1 Denpasar Menggelar Karya Mamungkah, Ngenteg Linggih, Pujawali Pedudusan Alit lan Tawur Balik Sumpah Manca Rupa', 'source' => 'Bali Prawara', 'url' => 'https://baliprawara.com/smkn-1-denpasar-menggelar-karya-mamungkah-ngenteg-linggih-pujawali-pedudusan-alit-lan-tawur-balik-sumpah-manca-rupa/'],
            ['no' => 11, 'title' => 'Daikin Meresmikan Pusat Keunggulan SMK Pertama di Bali', 'source' => 'Kontan Regional', 'url' => 'https://regional.kontan.co.id/news/daikin-meresmikan-pusat-keunggulan-smk-pertama-di-bali'],
            ['no' => 12, 'title' => 'BP3MI Bali Sosialisasikan Peluang Kerja Luar Negeri dan SMK Go Global di SMKN 1 Denpasar', 'source' => 'KP2MI / BP3MI', 'url' => 'https://www.kp2mi.go.id/berita-detail/bp3mi-bali-sosialisasikan-peluang-kerja-luar-negeri-dan-smk-go-global-dalam-kegiatan-pemetaan-dan-penguatan-kerja-sama-dudika-di-smkn-1-denpasar'],
            ['no' => 13, 'title' => 'Profil SMKN 1 DENPASAR - Data Sekolah', 'source' => 'Zekolah', 'url' => 'https://data-sekolah.zekolah.id/sekolah/smkn-1-denpasar-3408'],
            ['no' => 14, 'title' => 'Kepala SMAN Bali Mandara I Nyoman Darta Purnabakti: Sosok dan Liku Pendidikannya (Alumni STM Negeri Denpasar 1977-1981)', 'source' => 'Tatkala.co', 'url' => 'https://tatkala.co/2022/05/31/kepala-sman-bali-mandara-i-nyoman-darta-purnabakti-inilah-sosok-dan-liku-pendidikannya/'],
            ['no' => 15, 'title' => 'SMKN 1 Denpasar Lepas 854 Lulusan, 79 Diterima di PTN', 'source' => 'Bali Post (17 Mei 2023)', 'url' => 'https://www.balipost.com/news/2023/05/17/339510/SMKN-1-Denpasar-Lepas-854...html'],
            ['no' => 16, 'title' => 'Dilepas, 658 Siswa Kelas XII SMKN 1 Denpasar', 'source' => 'Disdikpora Kota Denpasar', 'url' => 'https://www.pendidikan.denpasarkota.go.id/berita/dilepas-658-siswa-kelas-xii-smkn-1-denpasar'],
            ['no' => 17, 'title' => 'Suyasaputra Gantikan Ngurah Tantra (Catatan Mutasi Kepala Sekolah Denpasar)', 'source' => 'Disdikpora Kota Denpasar', 'url' => 'https://www.pendidikan.denpasarkota.go.id/berita/suyasaputra-gantikan-ngurah-tantra'],
            ['no' => 18, 'title' => 'Data SMK Denpasar Tahun 2012', 'source' => 'Scribd', 'url' => 'https://id.scribd.com/doc/100869281/Data-Smk-Denpasar'],
            ['no' => 19, 'title' => 'LKS SMK Tingkat Nasional, Siswa Denpasar Raih 11 Medali', 'source' => 'Disdikpora Kota Denpasar', 'url' => 'https://www.pendidikan.denpasarkota.go.id/artikel/lks-smk-tingkat-nasional-siswa-denpasar-raih-11-medali'],
            ['no' => 20, 'title' => 'LKS SMK se-Kota Denpasar, SMKN 1 Denpasar Borong Juara', 'source' => 'Disdikpora Kota Denpasar', 'url' => 'https://www.pendidikan.denpasarkota.go.id/artikel/lks-smk-se-kota-denpasar-smkn-1-denpasar-borong-juara'],
            ['no' => 21, 'title' => 'Arsip Harian Bali Post - Kamis, 16 Oktober 2008', 'source' => 'e-Paper KMB / Issuu', 'url' => 'https://issuu.com/epaper-kmb/docs/bp16102008/14'],
            ['no' => 22, 'title' => 'Gubernur Wayan Koster Motivasi Siswa SMKN 1 Denpasar Ciptakan Motor hingga Kompor Listrik', 'source' => 'Pemprov Bali', 'url' => 'https://www.baliprov.go.id/web/gubernur-wayan-koster-motivasi-siswa-smkn-1-denpasar-ciptakan-motor-hingga-kompor-listrik'],
            ['no' => 23, 'title' => 'Arsip Harian Bali Post - Edisi 27 September 2017', 'source' => 'e-Paper KMB / Issuu', 'url' => 'https://issuu.com/epaper-kmb/docs/bpo_27092017'],
            ['no' => 24, 'title' => 'Arsip Harian Bali Post - Edisi Selasa, 16 April 2019', 'source' => 'e-Paper KMB / Issuu', 'url' => 'https://issuu.com/epaper-kmb/docs/bpo_16042019'],
            ['no' => 25, 'title' => 'Dua Anggota Polda Bali Berprestasi Dapatkan Pin Emas Kapolri & Penghargaan Kapolda Bali', 'source' => 'Kilas Bali (8 Nov 2021)', 'url' => 'https://kilasbali.com/2021/11/08/dua-anggota-polda-bali-berprestasi-dapatkan-pin-emas-kapolri/'],
            ['no' => 26, 'title' => 'Mulai 19 Juli, Layanan Vaksinasi di DPRD Provinsi Bali dan Gedung Nari Graha Dibuka Kembali', 'source' => 'Pemprov Bali', 'url' => 'https://www.baliprov.go.id/mulai-19-juli-layanan-vaksinasi-di-dprd-provinsi-bali-dan-gedung-nari-graha-dibuka-kembali'],
            ['no' => 27, 'title' => 'Kepsek di Bali Berharap Pengkajian Kurikulum Merdeka Berpihak pada Siswa', 'source' => 'Detik Bali', 'url' => 'https://www.detik.com/bali/berita/d-7602936/kepsek-di-bali-berharap-pengkajian-kurikulum-merdeka-berpihak-pada-siswa'],
            ['no' => 28, 'title' => 'Bali Raih 4 Perak dan 1 Perunggu di LKS Nasional 2025, SMKN 1 Denpasar Sumbang Tiga Medali', 'source' => 'KataBali (Agustus 2025)', 'url' => 'https://katabali.com/2025/08/bali-raih-4-perak-dan-1-perunggu-di-lks-nasional-2025-smkn-1-denpasar-sumbang-tiga-medali/'],
            ['no' => 29, 'title' => 'Jurusan SMK Negeri 1 Denpasar - Spektrum Keahlian Teknologi & Rekayasa', 'source' => 'Scribd', 'url' => 'https://id.scribd.com/document/674783181/SMK-DENPASAR'],
        ];

        return view('public.history', compact(
            'settings',
            'heroStats',
            'milestones',
            'eraMatrix',
            'principals',
            'curriculumGenealogy',
            'coreBusinesses',
            'lksClusters',
            'citations'
        ));
    }
}
