<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\Major;
use App\Models\StudentWork;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AchievementAndWorkSeeder extends Seeder
{
    public function run(): void
    {
        $majors = Major::all()->keyBy('code');

        // =========================================================================
        // 1. DATA PRESTASI & KEJUARAAN (ACHIEVEMENTS)
        // =========================================================================
        $achievements = [
            [
                'title' => 'Medali Emas LKS Nasional Bidang Web Technologies',
                'student_or_team' => 'I Putu Arya Dananjaya',
                'major_code' => 'RPL',
                'rank' => 'Medali Emas',
                'level' => 'Nasional',
                'year' => 2025,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Nasional XXXIII',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Medali Emas LKS Nasional Bidang IT Network Systems Administration',
                'student_or_team' => 'Kadek Bagus Wiraguna',
                'major_code' => 'TKJ',
                'rank' => 'Medali Emas',
                'level' => 'Nasional',
                'year' => 2025,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Nasional XXXIII',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Medali Emas LKS Nasional Refrigeration & Air Conditioning',
                'student_or_team' => 'Wayan Gede Aditya Pratama',
                'major_code' => 'TPTUP',
                'rank' => 'Medali Emas',
                'level' => 'Nasional',
                'year' => 2024,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Nasional XXXII',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Medali Perak LKS Nasional Bidang CNC Milling',
                'student_or_team' => 'Nyoman Tri Bayu Santika',
                'major_code' => 'TPM',
                'rank' => 'Medali Perak',
                'level' => 'Nasional',
                'year' => 2025,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Nasional XXXIII',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Medali Emas LKS Nasional Automobile Technology',
                'student_or_team' => 'Ketut Dharma Wijaya',
                'major_code' => 'TKR',
                'rank' => 'Medali Emas',
                'level' => 'Nasional',
                'year' => 2024,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Nasional XXXII',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Juara 1 Festival Film Pendek Pelajar Vokasi Nasional (FLS2N)',
                'student_or_team' => 'Tim Sinematografi SKENSA PRF',
                'major_code' => 'PRF',
                'rank' => 'Juara 1',
                'level' => 'Nasional',
                'year' => 2025,
                'description' => 'Festival Lomba Seni Siswa Nasional (FLS2N) Bidang Film Pendek Vokasi',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Medali Emas LKS Provinsi Bali Graphic Design Technology',
                'student_or_team' => 'Made Satria Wibawa',
                'major_code' => 'DKV',
                'rank' => 'Medali Emas',
                'level' => 'Provinsi',
                'year' => 2025,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Provinsi Bali',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Medali Emas LKS Provinsi Bali Electrical Installation',
                'student_or_team' => 'Gede Yudha Permana',
                'major_code' => 'TITL',
                'rank' => 'Medali Emas',
                'level' => 'Provinsi',
                'year' => 2025,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Provinsi Bali',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Medali Emas LKS Provinsi Bali Mechanical Engineering CAD',
                'student_or_team' => 'Komang Dwi Mahardika',
                'major_code' => 'DPIB',
                'rank' => 'Medali Emas',
                'level' => 'Provinsi',
                'year' => 2025,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Provinsi Bali',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Juara 1 LKS Provinsi Bali Bricklaying & Konstruksi Bangunan',
                'student_or_team' => 'Ketut Agus Surya Dharma',
                'major_code' => 'TKP',
                'rank' => 'Juara 1',
                'level' => 'Provinsi',
                'year' => 2024,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Provinsi Bali',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Juara 1 Kontes Teknisi Sepeda Motor AHASS Astra Motor Bali',
                'student_or_team' => 'I Putu Krisna Murti',
                'major_code' => 'TSM',
                'rank' => 'Juara 1',
                'level' => 'Provinsi',
                'year' => 2025,
                'description' => 'Astra Honda Motor Student Skill Contest Regional Bali',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Medali Perak LKS Provinsi Bali Electronics Application',
                'student_or_team' => 'I Made Budi Artawan',
                'major_code' => 'TAV',
                'rank' => 'Medali Perak',
                'level' => 'Provinsi',
                'year' => 2025,
                'description' => 'Lomba Kompetensi Siswa (LKS) SMK Tingkat Provinsi Bali',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Juara 1 Kejuaraan Robotika & Otomasi Industri Vokasi Udayana',
                'student_or_team' => 'Tim Robotika Otomasi ELIN',
                'major_code' => 'ELIN',
                'rank' => 'Juara 1',
                'level' => 'Provinsi',
                'year' => 2025,
                'description' => 'Udayana Robotic & Automation Championship',
                'image' => '/images/hero_siswa.jpg',
            ],
            [
                'title' => 'Medali Emas Kejuaraan Pencak Silat Pelajar Tingkat Nasional',
                'student_or_team' => 'Ni Kadek Ayu Saraswati',
                'major_code' => null,
                'rank' => 'Medali Emas',
                'level' => 'Nasional',
                'year' => 2024,
                'description' => 'Kejuaraan Nasional Pencak Silat Pelajar Piala Menpora RI',
                'image' => '/images/hero_siswa.jpg',
            ],
        ];

        foreach ($achievements as $ach) {
            $majorId = isset($ach['major_code']) && isset($majors[$ach['major_code']])
                ? $majors[$ach['major_code']]->id
                : null;

            Achievement::updateOrCreate(
                [
                    'title' => $ach['title'],
                    'student_or_team' => $ach['student_or_team'],
                    'year' => $ach['year'],
                ],
                [
                    'major_id' => $majorId,
                    'rank' => $ach['rank'],
                    'level' => $ach['level'],
                    'description' => $ach['description'],
                    'image' => $ach['image'],
                ]
            );
        }

        // =========================================================================
        // 2. DATA KARYA & INOVASI SISWA (STUDENT WORKS)
        // =========================================================================
        $works = [
            [
                'title' => 'SKENSA TeFa Hub - Platform Terpadu Teaching Factory',
                'student_name' => 'Arya Dananjaya, Bagus Wiraguna & Tim RPL',
                'major_code' => 'RPL',
                'year' => 2025,
                'description' => 'Sistem pemesanan jasa perbaikan komputer, servis AC, dan order merchandise TeFa berbasis web modern dengan manajemen order real-time dan notifikasi WhatsApp API.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => 'https://tefa.smkn1denpasar.sch.id',
                'tech_stack' => ['Laravel 12', 'Tailwind CSS', 'PostgreSQL', 'Alpine.js', 'REST API'],
            ],
            [
                'title' => 'Aplikasi Presensi Siswa Digital Berbasis Geofencing & QR Code',
                'student_name' => 'Made Satria & Komang Wira',
                'major_code' => 'RPL',
                'year' => 2025,
                'description' => 'Aplikasi mobile penunjang disiplin kesiswaan sekolah yang memvalidasi radius kehadiran siswa di lingkungan kampus SKENSA melalui geolokasi GPS presisi tinggi.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Flutter', 'Dart', 'Firebase Auth', 'Laravel API'],
            ],
            [
                'title' => 'Infrastruktur Smart Campus FTTH & MikroTik Hotspot Voucher',
                'student_name' => 'Kadek Bagus Wiraguna & Tim Jaringan TKJ',
                'major_code' => 'TKJ',
                'year' => 2025,
                'description' => 'Perancangan topologi jaringan serat optik kampus dengan pemisahan VLAN laboratorium, manajemen bandwidth cerdas berbasis CAPsMAN, serta captive portal keamanan Radius.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => null,
                'tech_stack' => ['MikroTik RouterOS', 'Fiber Optic FTTH', 'CAPsMAN', 'FreeRADIUS'],
            ],
            [
                'title' => 'Stasiun Pemantau Kualitas Udara Kelas Berbasis LoRaWAN',
                'student_name' => 'Wayan Agus & Nyoman Satya',
                'major_code' => 'TKJ',
                'year' => 2024,
                'description' => 'Sensor IoT nirkabel hemat daya pengukur konsentrasi CO2, partikel PM2.5, kelembapan, dan suhu ruang belajar terhubung ke dashboard analitik Grafana.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => null,
                'tech_stack' => ['ESP32 LoRa', 'Sensor NDIR CO2', 'MQTT Protocol', 'Grafana Cloud'],
            ],
            [
                'title' => 'Rebranding Identitas Visual & Kemasan Produk Kopi Organik Pupuan',
                'student_name' => 'Ni Putu Desi Ratnawati & Tim DKV',
                'major_code' => 'DKV',
                'year' => 2025,
                'description' => 'Proyek kemitraan industri riil Teaching Factory berupa perancangan brand guidelines, packaging eco-friendly berbasis kertas daur ulang, dan poster promosi komersial.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Adobe Illustrator', 'Photoshop', 'Packaging Design', 'Figma'],
            ],
            [
                'title' => 'Film Animasi 2D Edukasi Budaya "Bhakti ring Pertiwi"',
                'student_name' => 'Tim Produksi Animasi Kelas XII DKV',
                'major_code' => 'DKV',
                'year' => 2024,
                'description' => 'Film animasi pendek berdurasi 7 menit yang mengangkat kearifan lokal sistem pengairan Subak Bali, dibuat dengan teknik frame-by-frame digital.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Toon Boom Harmony', 'Adobe After Effects', 'Clip Studio Paint'],
            ],
            [
                'title' => 'Mesin Press Plat Hidrolik Ringkas untuk Workshop Logam UMKM',
                'student_name' => 'Nyoman Tri Bayu Santika & Tim TPM',
                'major_code' => 'TPM',
                'year' => 2025,
                'description' => 'Rancang bangun mesin press plat berkapasitas tekan 10 ton dengan rangka baja kanal UNP hasil pengelasan SMAW dan pin poros yang dibubut presisi tinggi.',
                'thumbnail' => '/images/gedung_skensa.jpg',
                'demo_url' => null,
                'tech_stack' => ['SolidWorks CAD', 'CNC Milling 3-Axis', 'Bubut Presisi', 'Las SMAW'],
            ],
            [
                'title' => 'Konversi Sepeda Motor Konvensional ke Motor Listrik "E-Matic SKENSA"',
                'student_name' => 'I Putu Krisna Murti & Tim TSM EV',
                'major_code' => 'TSM',
                'year' => 2025,
                'description' => 'Rekayasa konversi skuter matik berbahan bakar minyak menjadi kendaraan listrik ramah lingkungan berbasis motor BLDC 2000W dan baterai Lithium Ferro Phosphate (LFP) 72V.',
                'thumbnail' => '/images/gedung_skensa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Motor Hub BLDC 2kW', 'Smart BMS', 'Baterai LFP 72V', 'Programmable Controller'],
            ],
            [
                'title' => 'Cold Storage Mini Hemat Energi Berbasis Refrigeran Ramah Lingkungan R290',
                'student_name' => 'Wayan Gede Aditya Pratama & Tim TPTUP',
                'major_code' => 'TPTUP',
                'year' => 2024,
                'description' => 'Fasilitas pendingin mini suhu rendah -18 derajat Celsius untuk penyimpanan hasil laut nelayan pesisir dengan konsumsi daya listrik hemat energi berstandar Daikin CoE.',
                'thumbnail' => '/images/gedung_skensa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Refrigeran Alami R290', 'Inverter Compressor', 'Thermostat Digital Dixell'],
            ],
            [
                'title' => 'Trainer Pembangkit Listrik Tenaga Surya (PLTS) On-Grid Smart Monitoring',
                'student_name' => 'Gede Yudha Permana & Tim TITL',
                'major_code' => 'TITL',
                'year' => 2025,
                'description' => 'Instalasi panel surya monocrystalline 1500Wp lengkap dengan inverter grid-tie dan modul monitoring energi real-time berbasis IoT Blynk untuk laboratorium sekolah.',
                'thumbnail' => '/images/gedung_skensa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Solar PV Monocrystalline', 'Grid-Tie Inverter', 'IoT Power Meter', 'Blynk App'],
            ],
            [
                'title' => 'Pemodelan Arsitektur 3D BIM Bangunan Gedung Vokasi Ramah Lingkungan',
                'student_name' => 'Komang Dwi Mahardika & Tim DPIB',
                'major_code' => 'DPIB',
                'year' => 2025,
                'description' => 'Perancangan gedung serbaguna berkonsep green building lengkap dengan analisa pencahayaan alami, struktur beton bertulang, dan visualisasi virtual reality walk-through.',
                'thumbnail' => '/images/gedung_skensa.jpg',
                'demo_url' => null,
                'tech_stack' => ['Autodesk Revit 2025', 'AutoCAD', 'Lumion Pro 3D', 'BIM Architecture'],
            ],
            [
                'title' => 'Film Dokumenter "Pahlawan Presisi: Jejak Teknisi Vokasi Bali"',
                'student_name' => 'Tim Sinematografi & Pascaproduksi PRF',
                'major_code' => 'PRF',
                'year' => 2025,
                'description' => 'Karya film dokumenter berdurasi 15 menit tentang dedikasi lulusan SMK dalam memajukan industri manufaktur dan teknologi pariwisata di Bali dengan kualitas sinematik 4K.',
                'thumbnail' => '/images/hero_siswa.jpg',
                'demo_url' => null,
                'tech_stack' => ['DaVinci Resolve Studio', 'Sony FX3 Cinema', 'Sound Design Foley'],
            ],
        ];

        foreach ($works as $w) {
            $majorId = isset($w['major_code']) && isset($majors[$w['major_code']])
                ? $majors[$w['major_code']]->id
                : $majors->first()->id;

            StudentWork::updateOrCreate(
                ['slug' => Str::slug($w['title'])],
                [
                    'major_id' => $majorId,
                    'title' => $w['title'],
                    'student_name' => $w['student_name'],
                    'year' => $w['year'],
                    'description' => $w['description'],
                    'thumbnail' => $w['thumbnail'],
                    'demo_url' => $w['demo_url'],
                    'tech_stack' => $w['tech_stack'],
                ]
            );
        }
    }
}
