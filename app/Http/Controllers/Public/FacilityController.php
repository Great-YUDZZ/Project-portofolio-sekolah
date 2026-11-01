<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(Request $request): View
    {
        $selectedCategory = $request->query('kategori', 'semua');

        $categories = [
            'semua' => 'Semua Fasilitas',
            'bengkel' => 'Bengkel Rekayasa & Manufaktur',
            'lab-tik' => 'Laboratorium Komputer & TIK',
            'studio' => 'Studio Kreatif & Media',
            'sarana-umum' => 'Sarana Pendukung & Ibadah',
        ];

        $facilities = [
            [
                'id' => 'daikin-coe',
                'name' => 'Center of Excellence (CoE) Daikin & Lab Tata Udara',
                'category' => 'bengkel',
                'major_code' => 'TPTUP',
                'image' => '/images/showcase/daikin_coe.jpg',
                'summary' => 'Pusat pelatihan tata udara dan refrigerasi berstandar internasional hasil kemitraan strategis dengan PT Daikin Airconditioning Indonesia.',
                'capacity' => '36 Siswa / Sesi',
                'equipment' => [
                    'Sistem VRV (Variable Refrigerant Volume) Daikin',
                    'Multi-split Inverter AC Simulator',
                    'Peralatan Recovery & Vacuum Standar Industri',
                    'Panel Uji Kelistrikan Refrigerasi Digital',
                ],
                'highlight' => 'Standar sertifikasi teknisi refrigerasi nasional BNSP & Daikin Certified Installer.',
            ],
            [
                'id' => 'lab-fiber-optic',
                'name' => 'Laboratorium Fiber Optic & Jaringan Komputer',
                'category' => 'lab-tik',
                'major_code' => 'TKJ',
                'image' => '/images/showcase/lab_fiber.jpg',
                'summary' => 'Ruang praktik penggelaran kabel serat optik, splicing presisi, konfigurasi routing Cisco & MikroTik, serta infrastruktur cloud data center.',
                'capacity' => '36 Siswa / Sesi',
                'equipment' => [
                    'Fusion Splicer Fiber Optic Presisi Tinggi',
                    'Optical Time-Domain Reflectometer (OTDR)',
                    'Rack Server Cisco Catalyst & MikroTik Cloud Router',
                    'Workstation Konfigurasi Dual-Monitor',
                ],
                'highlight' => 'Pusat pelaksanaan MikroTik Academy & sertifikasi MTCNA / CCNA.',
            ],
            [
                'id' => 'bengkel-cnc-mesin',
                'name' => 'Bengkel Pemesinan CNC & Manufaktur Presisi',
                'category' => 'bengkel',
                'major_code' => 'TP',
                'image' => '/images/showcase/ukk_2026.jpg',
                'summary' => 'Bengkel kerja mekanik logam terpadu yang dilengkapi mesin CNC Milling, CNC Bubut, dan mesin perkakas konvensional untuk produksi komponen mekanis.',
                'capacity' => '40 Siswa / Sesi',
                'equipment' => [
                    'Mesin CNC Milling 3-Axis',
                    'Mesin CNC Bubut Industri',
                    'Deretan Mesin Bubut & Milling Konvensional',
                    'Alat Ukur Presisi Micrometer & Vernier Caliper Digital',
                ],
                'highlight' => 'Unit produksi komersial manufaktur komponen mekanis dan suku cadang presisi.',
            ],
            [
                'id' => 'studio-multimedia-dkv',
                'name' => 'Studio Kreatif Multimedia, DKV & Animasi',
                'category' => 'studio',
                'major_code' => 'DKV',
                'image' => '/images/showcase/pengalaman_belajar.jpg',
                'summary' => 'Studio produksi grafis komputer, ilustrasi digital, animasi 2D/3D, audio visual, dan live broadcasting dengan standar industri periklanan.',
                'capacity' => '36 Siswa / Sesi',
                'equipment' => [
                    'PC Workstation Grafis dengan GPU Dedicated',
                    'Pen Display & Pen Tablet Grafis Wacom',
                    'Green Screen Studio & Lighting LED Kit Pro',
                    'Audio Interface & Microphone Recording Kondenser',
                ],
                'highlight' => 'Mendukung produksi media komersial, pembuatan video korporat, dan portofolio kreatif siswa.',
            ],
            [
                'id' => 'lab-lks-software',
                'name' => 'Laboratorium Rekayasa Perangkat Lunak & Kompetensi LKS',
                'category' => 'lab-tik',
                'major_code' => 'RPL',
                'image' => '/images/showcase/lks_2026.jpg',
                'summary' => 'Pusat inkubasi rekayasa software, pengembangan aplikasi web/mobile, sistem basis data, dan karantina intensif kontingen Lomba Kompetensi Siswa (LKS).',
                'capacity' => '36 Siswa / Sesi',
                'equipment' => [
                    'High-End Developer Workstations',
                    'Server Local Deployment & Docker Sandbox',
                    'Interactive Smart Display Screen 75 Inci',
                    'Koneksi Internet Dedicated Bandwidth Simetris',
                ],
                'highlight' => 'Basis pelatihan medali emas LKS Nasional bidang Web Technologies dan IT Software Solutions.',
            ],
            [
                'id' => 'lapangan-olahraga-upacara',
                'name' => 'Lapangan Olahraga & Area Terbuka Upacara',
                'category' => 'sarana-umum',
                'major_code' => null,
                'image' => '/images/showcase/lapangan_upacara.jpg',
                'summary' => 'Fasilitas luar ruang multifungsi seluas lebih dari 2.500 meter persegi untuk upacara bendera, apel disiplin industri, dan cabang olahraga atletik.',
                'capacity' => '1.500 Siswa',
                'equipment' => [
                    'Lapangan Futsal & Bola Basket Standar Kompetisi',
                    'Lapangan Bola Voli Terpadu',
                    'Tiang Bendera Utama & Panggung Inspeksi',
                    'Sound System Area Luar Daya Tinggi',
                ],
                'highlight' => 'Pusat pembinaan kesamaptaan fisik, apel kedisiplinan kerja, dan turnamen olahraga antar-jurusan.',
            ],
            [
                'id' => 'padmasana-subakti',
                'name' => 'Padmasana & Area Persembahyangan Suci (Subakti)',
                'category' => 'sarana-umum',
                'major_code' => null,
                'image' => '/images/showcase/subakti_2026.jpg',
                'summary' => 'Tempat suci persembahyangan umat Hindu di lingkungan sekolah yang asri dan khidmat, menegakkan nilai spiritual Tri Hita Karana.',
                'capacity' => '800 Siswa',
                'equipment' => [
                    'Padmasana Utama Ukiran Batu Tradisional Bali',
                    'Bale Piasan & Wantilan Kegiatan Keagamaan',
                    'Taman Meditasi dan Area Pasraman Siswa',
                    'Peralatan Upakara & Sarana Tirtha Terpelihara',
                ],
                'highlight' => 'Pilar pembentukan karakter budi pekerti luhur dan keharmonisan spiritual warga sekolah.',
            ],
            [
                'id' => 'kampus-pusat-ubung',
                'name' => 'Gedung Administrasi Terpadu & Kawasan Kampus Hijau',
                'category' => 'sarana-umum',
                'major_code' => null,
                'image' => '/images/showcase/drone_kampus.jpg',
                'summary' => 'Kawasan kampus terpadu seluas 3 hektar di Jalan HOS Cokroaminoto No. 84 Ubung dengan fasilitas ramah lingkungan, ruang hijau, dan akses terpusat.',
                'capacity' => '3.000 Siswa & Guru',
                'equipment' => [
                    'Ruang Layanan Front Office Humas & BKK',
                    'Ruang Sertifikasi LSP-P1 BNSP',
                    'Area Parkir Luas Bertingkat Teratur',
                    'CCTV Keamanan 24 Jam di Seluruh Sudut Kampus',
                ],
                'highlight' => 'Infrastruktur sekolah kejuruan rujukan nasional dengan sertifikasi ISO 9001:2000.',
            ],
        ];

        $filteredFacilities = $selectedCategory === 'semua'
            ? $facilities
            : array_values(array_filter($facilities, fn ($f) => $f['category'] === $selectedCategory));

        return view('public.facilities', [
            'facilities' => $filteredFacilities,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'totalCount' => count($facilities),
        ]);
    }
}
