<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Event;
use App\Models\Facility;
use App\Models\GalleryAlbum;
use App\Models\GalleryPhoto;
use App\Models\Major;
use App\Models\Page;
use App\Models\Post;
use App\Models\StaffMember;
use App\Models\StudentWork;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioContentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('username', 'admin')->first();
        $rpl = Major::where('code', 'RPL')->first();
        $tkj = Major::where('code', 'TKJ')->first();
        $dkv = Major::where('code', 'DKV')->first();
        $prf = Major::where('code', 'PRF')->first();
        $dpib = Major::where('code', 'DPIB')->first();
        $elin = Major::where('code', 'ELIN')->first();
        $tpm = Major::where('code', 'TPM')->first();
        $tkr = Major::where('code', 'TKR')->first();

        // 1. Halaman Statis Profil (Sejarah & Visi Misi)
        Page::updateOrCreate(
            ['slug' => 'sejarah'],
            [
                'title' => 'Sejarah SMK Negeri 1 Denpasar',
                'subtitle' => 'Perjalanan panjang mencetak tenaga ahli teknologi dan rekayasa di Pulau Dewata sejak 1962',
                'content' => '<p>SMK Negeri 1 Denpasar (yang akrab dikenal dengan nama <strong>SKENSA</strong>) merupakan salah satu sekolah menengah kejuruan teknologi dan rekayasa tertua serta terbesar di Provinsi Bali. Didirikan pada tanggal 24 September 1962 dengan nama awal STM Negeri Denpasar di Jalan HOS. Cokroaminoto No. 84, Ubung, Denpasar Utara.</p>
                <p>Sejak awal berdirinya, sekolah ini dirancang sebagai pusat pendidikan vokasi keteknikan yang menopang pembangunan infrastruktur, manufaktur, kelistrikan, otomotif, hingga transformasi teknologi informasi di Bali dan Indonesia bagian timur.</p>
                <p>Dengan berpegang teguh pada semboyan <em>Abhyāsad Dhäryate Vidyä</em> (Peliharalah ilmu pengetahuan dengan cara mengamalkannya dalam praktik kehidupan sampai menjadi tradisi), SKENSA terus bertransformasi menjadi SMK Pusat Keunggulan (Center of Excellence) yang menyelaraskan kurikulum bersama lebih dari 180 mitra dunia usaha dan dunia industri (DUDI).</p>',
                'meta' => [
                    'milestones' => [
                        ['year' => '1962', 'title' => 'Pendirian STM Negeri Denpasar', 'desc' => 'Resmi berdiri pada 24 September 1962 sebagai pelopor pendidikan teknik menengah di Bali.'],
                        ['year' => '1997', 'title' => 'Perubahan Nama Menjadi SMKN 1 Denpasar', 'desc' => 'Transformasi kelembagaan sesuai nomenklatur nasional Sekolah Menengah Kejuruan.'],
                        ['year' => '2015', 'title' => 'Pendirian LSP-P1 SMKN 1 Denpasar', 'desc' => 'Mendapatkan lisensi resmi BNSP untuk menguji sertifikasi kompetensi siswa secara mandiri.'],
                        ['year' => '2021', 'title' => 'Penetapan SMK Pusat Keunggulan', 'desc' => 'Mengimplementasikan kurikulum berbasis industri, Teaching Factory, dan digitalisasi penuh melalui LMS SKENSA.'],
                    ],
                ],
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'visi-misi'],
            [
                'title' => 'Visi & Misi Institusi',
                'subtitle' => 'Arah strategis pendidikan kejuruan berbasis karakter budaya bangsa dan standar global',
                'content' => '<p>Menjadi lembaga pendidikan vokasi rujukan nasional yang menghasilkan lulusan berkarakter <strong>Siap, Kompeten, Disiplin, dan Beretika</strong> serta mampu bersaing di kancah global.</p>',
                'meta' => [
                    'visi' => 'Terwujudnya SMK Negeri 1 Denpasar sebagai pusat pendidikan dan pelatihan kejuruan yang unggul, berbudaya lingkungan, berlandaskan nilai kearifan lokal Sad Kerthi, serta menghasilkan lulusan yang Siap, Kompeten, Disiplin, dan Beretika.',
                    'misi' => [
                        'Menyelenggarakan pembelajaran berbasis kompetensi dan Teaching Factory yang selaras dengan kebutuhan dunia industri mutakhir.',
                        'Membangun karakter peserta didik yang disiplin, jujur, beretika, dan menjunjung tinggi kearifan budaya Bali.',
                        'Meningkatkan kualifikasi pendidik dan tenaga kependidikan sesuai standar sertifikasi profesi nasional maupun internasional.',
                        'Mengembangkan ekosistem tata kelola sekolah digital yang transparan, akuntabel, dan ramah lingkungan.',
                        'Memperluas jejaring kemitraan strategis dengan industri dalam dan luar negeri untuk penyerapan lulusan dan sertifikasi kompetensi.',
                    ],
                ],
            ]
        );

        // 2. Fasilitas Sekolah
        $facilities = [
            [
                'name' => 'Laboratorium Cloud, Server & Fiber Optic (TKJ & RPL)',
                'description' => 'Dilengkapi rack server enterprise, router MikroTik & Cisco, perangkat splicing fiber optic, serta workstation spesifikasi tinggi untuk praktikum full-stack engineering dan simulasi keamanan siber.',
                'image' => '/images/gedung_skensa.jpg',
            ],
            [
                'name' => 'Workshop Otomotif Standar Industri (TKR & TSM)',
                'description' => 'Area praktik berstandar bengkel resmi mitra industri dengan car lift hidrolik, engine scanner diagnostik ECU, spooring balancing, dan unit pelatihan kendaraan listrik.',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'name' => 'Studio Produksi Film, Podcast & Desain Kreatif (PRF & DKV)',
                'description' => 'Studio kedap suara berlapis akustik dengan sistem tata cahaya sinematik, green screen cyclorama, kamera sinema digital, serta ruang color grading dan editing.',
                'image' => '/images/gedung_skensa.jpg',
            ],
            [
                'name' => 'Workshop Manufaktur Presisi & Mesin CNC (TPM)',
                'description' => 'Memiliki deretan mesin bubut konvensional, mesin frais, serta mesin CNC Milling dan CNC Turning 3-axis industri untuk fabrikasi komponen mekanik presisi.',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'name' => 'Laboratorium BIM Arsitektur & Geomatika (DPIB & TKP)',
                'description' => 'Ruang komputasi pemodelan Building Information Modeling (BIM) 3D, plotter cetak gambar teknik ukuran A0, serta peralatan ukur tanah Total Station dan Theodolite digital.',
                'image' => '/images/gedung_skensa.jpg',
            ],
            [
                'name' => 'Perpustakaan Digital (e-Library) & Ruang Kolaborasi Siswa',
                'description' => 'Ruang baca ber-AC yang terintegrasi dengan katalog e-Library SKENSA, akses ribuan e-book keteknikan, jurnal vokasi, dan area diskusi kelompok.',
                'image' => '/images/hero_waka.jpg',
            ],
        ];

        foreach ($facilities as $fac) {
            Facility::updateOrCreate(
                ['slug' => Str::slug($fac['name'])],
                [
                    'name' => $fac['name'],
                    'description' => $fac['description'],
                    'image' => $fac['image'],
                ]
            );
        }

        // 3. Direktori Pimpinan, Guru & Staf
        $staffs = [
            ['name' => 'I Wayan Mustika, S.Pd., M.Pd.', 'role_title' => 'Kepala SMK Negeri 1 Denpasar', 'department' => 'Pimpinan Sekolah', 'email' => 'kepsek@smkn1denpasar.sch.id', 'order_index' => 1],
            ['name' => 'Drs. I Nyoman Sudiarta, M.Pd.', 'role_title' => 'Wakil Kepala Bidang Kurikulum', 'department' => 'Wakil Kepala Sekolah', 'email' => 'kurikulum@smkn1denpasar.sch.id', 'order_index' => 2],
            ['name' => 'I Made Budiarta, S.Pd.', 'role_title' => 'Wakil Kepala Bidang Kesiswaan', 'department' => 'Wakil Kepala Sekolah', 'email' => 'kesiswaan@smkn1denpasar.sch.id', 'order_index' => 3],
            ['name' => 'Ir. I Ketutaryana, M.T.', 'role_title' => 'Wakil Kepala Bidang Humas & Hubungan Industri', 'department' => 'Wakil Kepala Sekolah', 'email' => 'humas@smkn1denpasar.sch.id', 'order_index' => 4],
            ['name' => 'I Gede Suardika, S.T., M.Pd.', 'role_title' => 'Wakil Kepala Bidang Sarana & Prasarana', 'department' => 'Wakil Kepala Sekolah', 'email' => 'sarpras@smkn1denpasar.sch.id', 'order_index' => 5],
            ['name' => 'I Wayan Artha, S.Kom., M.Cs.', 'role_title' => 'Ketua Konsentrasi Keahlian RPL', 'department' => 'Komputer dan Informatika', 'email' => 'artha@skensa.sch.id', 'order_index' => 6],
            ['name' => 'Ni Made Sukerti, S.Kom.', 'role_title' => 'Ketua Konsentrasi Keahlian TKJ', 'department' => 'Komputer dan Informatika', 'email' => 'sukerti@skensa.sch.id', 'order_index' => 7],
            ['name' => 'I Made Suardana, S.Sn.', 'role_title' => 'Ketua Konsentrasi Keahlian DKV', 'department' => 'Desain Komunikasi Visual', 'email' => 'suardana@skensa.sch.id', 'order_index' => 8],
            ['name' => 'Ni Luh Putu Sintya, S.Sn.', 'role_title' => 'Ketua Konsentrasi Keahlian Produksi Film', 'department' => 'Broadcasting & Perfilman', 'email' => 'sintya@skensa.sch.id', 'order_index' => 9],
            ['name' => 'Ni Wayan Eka Putri, S.Pd., M.T.', 'role_title' => 'Ketua Konsentrasi Keahlian DPIB', 'department' => 'Desain Bangunan', 'email' => 'ekaputri@skensa.sch.id', 'order_index' => 10],
            ['name' => 'I Gede Agus Sudiarta, S.T.', 'role_title' => 'Ketua Konsentrasi Keahlian Teknik Elektronika Industri', 'department' => 'Elektronika', 'email' => 'agussudiarta@skensa.sch.id', 'order_index' => 11],
            ['name' => 'I Nyoman Pande Ardana, S.T.', 'role_title' => 'Ketua Konsentrasi Keahlian Teknik Kendaraan Ringan', 'department' => 'Otomotif', 'email' => 'pandeardana@skensa.sch.id', 'order_index' => 12],
        ];

        foreach ($staffs as $st) {
            StaffMember::updateOrCreate(
                ['email' => $st['email']],
                array_merge($st, ['photo' => '/images/hero_waka.jpg'])
            );
        }

        // 4. Karya Portofolio Siswa
        $works = [
            [
                'major_id' => $rpl?->id,
                'title' => 'SkensaCore: Sistem Otomasi Ujian & Telemetri Lab Berbasis Web',
                'student_name' => 'Gede Rama Wijaya & Tim RPL',
                'year' => 2026,
                'description' => 'Platform web full-stack untuk manajemen ujian praktikum kejuruan real-time dengan pemantauan beban server Linux dan proteksi anti-kecurangan.',
                'thumbnail' => '/images/gedung_skensa.jpg',
                'demo_url' => 'https://lms.skensa.id',
                'tech_stack' => ['Laravel 12', 'Livewire', 'Tailwind CSS', 'MariaDB', 'Linux'],
            ],
            [
                'major_id' => $tkj?->id,
                'title' => 'High-Availability Cluster Server & IDS Firewall Sekolah',
                'student_name' => 'Kadek Ayu Maharani & Tim TKJ',
                'year' => 2026,
                'description' => 'Implementasi jaringan gagal-aman (failover) menggunakan MikroTik BGP/OSPF, Proxmox Virtual Environment, dan pemantauan trafik jaringan Suricata + Grafana.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => 'https://smkn1denpasar.sch.id',
                'tech_stack' => ['MikroTik RouterOS', 'Proxmox VE', 'Docker', 'Grafana', 'WireGuard'],
            ],
            [
                'major_id' => $dkv?->id,
                'title' => 'Identitas Visual & Kemasan UMKM Kopi Kintamani Berkelanjutan',
                'student_name' => 'Komang Bayu Nugraha',
                'year' => 2026,
                'description' => 'Perancangan ulang brand identity, ilustrasi botanikal aksara Bali, dan struktur kemasan ramah lingkungan untuk koperasi petani kopi di Bangli.',
                'thumbnail' => '/images/gedung_skensa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Adobe Illustrator', 'Figma', 'Blender 3D', 'Packaging Design'],
            ],
            [
                'major_id' => $prf?->id,
                'title' => 'Film Dokumenter Pendek: Penjaga Subak di Tengah Kota',
                'student_name' => 'Keluarga Sinema PRF Skensa',
                'year' => 2025,
                'description' => 'Dokumenter sinematik berdurasi 18 menit yang merekam ketahanan petani subak perkotaan Denpasar menghadapi alih fungsi lahan.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => 'https://youtube.com/@smkn1denpasar',
                'tech_stack' => ['DaVinci Resolve', 'Sony FX3', 'Spatial Audio', 'Color Grading'],
            ],
            [
                'major_id' => $dpib?->id,
                'title' => 'Digital Twin & Pemodelan BIM Gedung Bale Budaya Bali Modern',
                'student_name' => 'I Putu Mahendra (XII DPIB 1)',
                'year' => 2025,
                'description' => 'Pemodelan arsitektur 3D terintegrasi perhitungan struktur, MEP, dan analisis pencahayaan alami hemat energi menggunakan Autodesk Revit.',
                'thumbnail' => '/images/gedung_skensa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Autodesk Revit', 'AutoCAD', 'Enscape 3D', 'BIM 360'],
            ],
            [
                'major_id' => $elin?->id,
                'title' => 'Smart Hydroponic Penyiram Nutrisi Otomatis Berbasis PLC & IoT',
                'student_name' => 'Made Adi Pratama & Tim ELIN',
                'year' => 2026,
                'description' => 'Sistem kendali pH, kepekatan nutrisi TDS, dan suhu air otomatis pada greenhouse hidroponik yang dapat dipantau jarak jauh melalui dashboard smartphone.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Omron PLC', 'ESP32', 'MQTT', 'Node-RED', 'Sensor Industri'],
            ],
        ];

        foreach ($works as $work) {
            if ($work['major_id']) {
                StudentWork::updateOrCreate(
                    ['slug' => Str::slug($work['title'])],
                    $work
                );
            }
        }

        // 5. Prestasi Siswa & Sekolah
        $achievements = [
            [
                'title' => 'Medali Emas LKS Nasional Bidang IT Software Solutions for Business',
                'student_or_team' => 'Gede Rama Wijaya',
                'major_id' => $rpl?->id,
                'rank' => 'Juara 1 (Medali Emas)',
                'level' => 'Nasional',
                'year' => 2026,
                'description' => 'Meraih nilai tertinggi nasional dalam perancangan arsitektur sistem enterprise, API mikroservis, dan aplikasi mobile lintas platform.',
            ],
            [
                'title' => 'Juara 1 LKS Tingkat Provinsi Bali Bidang IT Network Systems Administration',
                'student_or_team' => 'Kadek Ayu Maharani',
                'major_id' => $tkj?->id,
                'rank' => 'Juara 1',
                'level' => 'Provinsi',
                'year' => 2026,
                'description' => 'Menyelesaikan tantangan konfigurasi server Debian, routing Cisco, dan hardening keamanan siber dalam waktu tercepat.',
            ],
            [
                'title' => 'Film Dokumenter Pelajar Terbaik Festival Film Bali',
                'student_or_team' => 'Tim Produksi Film SKENSA',
                'major_id' => $prf?->id,
                'rank' => 'Penghargaan Utama',
                'level' => 'Nasional',
                'year' => 2025,
                'description' => 'Karya dokumenter Penjaga Subak di Tengah Kota terpilih sebagai film pelajar terbaik dari 140 peserta seluruh Indonesia.',
            ],
            [
                'title' => 'Juara 1 LKS Provinsi Bali Bidang CAD Building (DPIB)',
                'student_or_team' => 'I Putu Mahendra',
                'major_id' => $dpib?->id,
                'rank' => 'Juara 1',
                'level' => 'Provinsi',
                'year' => 2025,
                'description' => 'Unggul dalam ketepatan pemodelan BIM 3D, potongan konstruksi detail, dan estimasi volume material bangunan.',
            ],
            [
                'title' => 'Juara 2 Nasional Kompetisi Inovasi Otomotif & Konversi Kendaraan Listrik',
                'student_or_team' => 'Tim Riset Otomotif SKENSA',
                'major_id' => $tkr?->id,
                'rank' => 'Juara 2',
                'level' => 'Nasional',
                'year' => 2025,
                'description' => 'Berhasil merancang sistem manajemen baterai (BMS) dan konversi motor bakar menjadi penggerak BLDC berefisiensi tinggi.',
            ],
            [
                'title' => 'Juara 1 LKS Provinsi Bali Bidang CNC Milling Presisi',
                'student_or_team' => 'I Komang Dipa',
                'major_id' => $tpm?->id,
                'rank' => 'Juara 1',
                'level' => 'Provinsi',
                'year' => 2025,
                'description' => 'Mencapai akurasi dimensi mikrometer tertinggi dalam pemrograman CAM dan eksekusi pemesinan blok baja.',
            ],
        ];

        foreach ($achievements as $ach) {
            Achievement::updateOrCreate(
                ['title' => $ach['title']],
                $ach
            );
        }

        // 6. Berita & Pengumuman
        $posts = [
            [
                'title' => 'SKENSA Gelar Pameran Karya Vokasi & Job Fair Industri 2026',
                'category' => 'berita',
                'excerpt' => 'Lebih dari 45 perusahaan mitra industri hadir melakukan rekrutmen langsung serta menyaksikan pameran inovasi teknologi siswa dari 13 konsentrasi keahlian.',
                'content' => '<p>SMK Negeri 1 Denpasar kembali menyelenggarakan perhelatan tahunan <strong>SKENSA Vocational Expo &amp; Job Fair 2026</strong> yang bertempat di aula utama dan lapangan tengah sekolah. Kegiatan ini menampilkan lebih dari 60 produk inovasi karya siswa dari 13 konsentrasi keahlian.</p><p>Kepala SMK Negeri 1 Denpasar menyampaikan bahwa kegiatan ini merupakan wujud nyata penerapan semboyan <em>Abhyāsad Dhäryate Vidyä</em>, di mana setiap ilmu yang dipelajari di ruang praktik diwujudkan menjadi solusi nyata yang siap diuji oleh industri.</p>',
                'featured_image' => '/images/hero_siswa.jpg',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Kontingen SMKN 1 Denpasar Borong 8 Medali Emas di LKS Tingkat Provinsi Bali',
                'category' => 'berita',
                'excerpt' => 'Dominasi bidang teknologi informasi, desain bangunan, pemesinan CNC, dan elektronika mengantarkan SKENSA sebagai juara umum.',
                'content' => '<p>Prestasi membanggakan kembali ditorehkan oleh siswa-siswi terbaik SMK Negeri 1 Denpasar pada ajang Lomba Kompetensi Siswa (LKS) SMK Tingkat Provinsi Bali. Sebanyak 8 medali emas, 3 perak, dan 2 perunggu berhasil dibawa pulang.</p><p>Para peraih medali emas selanjutnya akan menjalani pemusatan latihan intensif bersama mentor praktisi industri guna mewakili Provinsi Bali di tingkat nasional.</p>',
                'featured_image' => '/images/gedung_skensa.jpg',
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Penandatanganan MoU Kelas Industri Bersama Mitra Teknologi & Manufaktur Jepang',
                'category' => 'berita',
                'excerpt' => 'Membuka peluang magang bersertifikat internasional dan penyelarasan kurikulum standar industri Jepang bagi lulusan SKENSA.',
                'content' => '<p>Dalam rangka memperluas penyerapan lulusan di pasar global, SMK Negeri 1 Denpasar resmi menandatangani nota kesepahaman (MoU) bersama konsorsium industri manufaktur dan teknologi informasi Jepang.</p><p>Melalui kerja sama ini, siswa kelas XI dan XII mendapatkan pembekalan budaya kerja industri, pelatihan bahasa, serta fasilitasi ujian sertifikasi keahlian berstandar internasional.</p>',
                'featured_image' => '/images/hero_waka.jpg',
                'published_at' => now()->subDays(12),
            ],
            [
                'title' => 'Pengumuman Jadwal Uji Kompetensi Keahlian (UKK) LSP-P1 Tahun Ajaran 2025/2026',
                'category' => 'pengumuman',
                'excerpt' => 'Seluruh siswa kelas XII wajib melakukan verifikasi berkas portofolio dan kartu peserta melalui portal LSP SMKN 1 Denpasar sebelum pelaksanaan asesmen.',
                'content' => '<p>Diberitahukan kepada seluruh peserta didik kelas XII dari 13 Konsentrasi Keahlian bahwa pelaksanaan <strong>Uji Kompetensi Keahlian (UKK)</strong> melalui Lembaga Sertifikasi Profesi Pihak Pertama (LSP-P1) SMK Negeri 1 Denpasar akan dilaksanakan mulai bulan depan.</p><p>Peserta wajib mengunggah jurnal praktik kerja lapangan dan portofolio proyek akhir melalui Portal LMS SKENSA serta melakukan konfirmasi skema sertifikasi di sekretariat LSP.</p>',
                'featured_image' => '/images/gedung_skensa.jpg',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Informasi Kelulusan & Pengambilan Sertifikat Kompetensi Kelas XII',
                'category' => 'pengumuman',
                'excerpt' => 'Prosedur pemeriksaan status kelulusan daring, cap tiga jari ijazah, serta pengisian survei Tracer Vokasi Kemendikdasmen.',
                'content' => '<p>Sehubungan dengan berakhirnya rangkaian evaluasi akhir tahun ajaran, siswa kelas XII dapat mengakses pengumuman kelulusan secara daring. Sebelum mengambil dokumen ijazah dan sertifikat kompetensi BNSP, seluruh lulusan diwajibkan mengisi pendataan alumni pada laman resmi Tracer Vokasi.</p>',
                'featured_image' => '/images/hero_siswa.jpg',
                'published_at' => now()->subDays(9),
            ],
        ];

        foreach ($posts as $p) {
            Post::updateOrCreate(
                ['slug' => Str::slug($p['title'])],
                array_merge($p, [
                    'author_id' => $admin?->id,
                    'is_published' => true,
                ])
            );
        }

        // 7. Agenda Kegiatan Sekolah
        $events = [
            [
                'title' => 'Pameran Karya Inovasi Vokasi & Job Fair SKENSA 2026',
                'description' => 'Gelar karya proyek akhir siswa 13 jurusan, talkshow industri, dan rekrutmen terbuka bagi alumni maupun siswa kelas XII.',
                'location' => 'Aula Utama & Lapangan Tengah SMKN 1 Denpasar',
                'start_time' => now()->addDays(7)->setHour(8)->setMinute(0),
                'end_time' => now()->addDays(8)->setHour(16)->setMinute(0),
            ],
            [
                'title' => 'Asesmen Nasional Uji Kompetensi LSP-P1 Gelombang I',
                'description' => 'Pelaksanaan ujian praktik sertifikasi profesi berlisensi BNSP di masing-masing bengkel dan laboratorium keahlian.',
                'location' => 'Seluruh TUK (Tempat Uji Kompetensi) SKENSA',
                'start_time' => now()->addDays(14)->setHour(7)->setMinute(30),
                'end_time' => now()->addDays(18)->setHour(15)->setMinute(30),
            ],
            [
                'title' => 'Workshop Guru Tamu Industri: AI & Cloud Architecture Modern',
                'description' => 'Kuliah umum praktis bersama Senior Cloud Architect mitra industri untuk siswa bidang Komputer dan Informatika.',
                'location' => 'Ruang Sidang & Lab Server TKJ-RPL',
                'start_time' => now()->addDays(21)->setHour(9)->setMinute(0),
                'end_time' => now()->addDays(21)->setHour(13)->setMinute(0),
            ],
            [
                'title' => 'Perayaan HUT SMK Negeri 1 Denpasar ke-64',
                'description' => 'Puncak perayaan hari jadi SKENSA dengan lomba kreativitas antar jurusan, pentas seni budaya Bali, dan temu alumni lintas angkatan.',
                'location' => 'Kampus SMK Negeri 1 Denpasar, Jl. HOS Cokroaminoto No. 84',
                'start_time' => now()->addDays(35)->setHour(7)->setMinute(30),
                'end_time' => now()->addDays(35)->setHour(17)->setMinute(0),
            ],
        ];

        foreach ($events as $ev) {
            Event::updateOrCreate(
                ['slug' => Str::slug($ev['title'])],
                $ev
            );
        }

        // 8. Album Galeri Foto
        $albums = [
            [
                'title' => 'Praktikum Teaching Factory & Bengkel Kejuruan',
                'category' => 'Akademik & Praktik',
                'description' => 'Suasana kegiatan belajar praktik langsung menggunakan peralatan berstandar industri di berbagai bengkel dan laboratorium SKENSA.',
                'cover_image' => '/images/hero_siswa.jpg',
                'event_date' => now()->subDays(15)->toDateString(),
                'photos' => [
                    ['title' => 'Praktik Kolaborasi Lab Komputer & Jaringan', 'caption' => 'Siswa melakukan pengujian topologi jaringan dan konfigurasi server.', 'image_path' => '/images/hero_siswa.jpg'],
                    ['title' => 'Gedung Utama Kampus SMKN 1 Denpasar', 'caption' => 'Lingkungan kampus hijau dan tertata di Jl. HOS Cokroaminoto No. 84 Denpasar.', 'image_path' => '/images/gedung_skensa.jpg'],
                    ['title' => 'Koordinasi Tim Manajemen & Pendidik Vokasi', 'caption' => 'Sinergi pimpinan dan ketua konsentrasi keahlian dalam menjaga mutu pembelajaran.', 'image_path' => '/images/hero_waka.jpg'],
                ],
            ],
            [
                'title' => 'Gelar Karya, Prestasi LKS & Kunjungan Mitra Industri',
                'category' => 'Prestasi & Industri',
                'description' => 'Dokumentasi pameran proyek siswa, penyerahan medali kejuaraan, dan kolaborasi bersama dunia usaha dan dunia industri.',
                'cover_image' => '/images/gedung_skensa.jpg',
                'event_date' => now()->subDays(30)->toDateString(),
                'photos' => [
                    ['title' => 'Fasad Kampus Pusat Keunggulan SKENSA', 'caption' => 'Pusat keunggulan vokasi teknologi dan rekayasa di Bali.', 'image_path' => '/images/gedung_skensa.jpg'],
                    ['title' => 'Sesi Presentasi Proyek Inovasi Siswa', 'caption' => 'Siswa mempresentasikan hasil riset terapan di hadapan penguji industri.', 'image_path' => '/images/hero_siswa.jpg'],
                ],
            ],
        ];

        foreach ($albums as $alData) {
            $photos = $alData['photos'];
            unset($alData['photos']);

            $album = GalleryAlbum::updateOrCreate(
                ['slug' => Str::slug($alData['title'])],
                $alData
            );

            foreach ($photos as $idx => $ph) {
                GalleryPhoto::updateOrCreate(
                    [
                        'gallery_album_id' => $album->id,
                        'title' => $ph['title'],
                    ],
                    [
                        'caption' => $ph['caption'],
                        'image_path' => $ph['image_path'],
                        'order_index' => $idx + 1,
                    ]
                );
            }
        }
    }
}
