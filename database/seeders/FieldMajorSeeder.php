<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Major;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FieldMajorSeeder extends Seeder
{
    public function run(): void
    {
        $fieldsData = [
            [
                'name' => 'Teknik Konstruksi',
                'code' => 'TK',
                'majors' => [
                    [
                        'name' => 'Teknik Konstruksi dan Perumahan',
                        'code' => 'TKP',
                        'tagline' => 'Membangun hunian berkelanjutan dan infrastruktur masa depan',
                        'description' => 'Konsentrasi keahlian yang membekali peserta didik dengan keterampilan perencanaan, pelaksanaan konstruksi bangunan gedung dan perumahan, estimasi biaya, serta pengawasan mutu konstruksi.',
                        'competencies' => [
                            'Gambar Teknik dan Konstruksi Bangunan',
                            'Pengukuran dan Pemetaan Tanah',
                            'Konstruksi Beton Bertulang dan Baja',
                            'Rencana Anggaran Biaya (RAB)',
                            'Keselamatan dan Kesehatan Kerja Lingkungan Hidup (K3LH)'
                        ],
                        'career_prospects' => [
                            'Pelaksana Konstruksi Bangunan',
                            'Drafter Struktur Bangunan',
                            'Estimator Biaya Proyek (Quantity Surveyor)',
                            'Surveyor Pemetaan Tanah',
                            'Wirausaha Jasa Konstruksi dan Renovasi'
                        ],
                        'head_of_major' => 'Ir. I Nyoman Sumantra, S.T.',
                    ]
                ]
            ],
            [
                'name' => 'Desain Bangunan',
                'code' => 'DB',
                'majors' => [
                    [
                        'name' => 'Desain Pemodelan dan Informasi Bangunan',
                        'code' => 'DPIB',
                        'tagline' => 'Transformasi arsitektur digital melalui Building Information Modeling (BIM)',
                        'description' => 'Fokus pada pemodelan digital 2D dan 3D struktur bangunan menggunakan perangkat lunak industri seperti AutoCAD, Revit, dan SketchUp, serta integrasi data BIM.',
                        'competencies' => [
                            'Aplikasi Perangkat Lunak Desain 2D & 3D (CAD/BIM)',
                            'Desain Arsitektur dan Interior',
                            'Visualisasi dan Rendering Realistis',
                            'Penyusunan Gambar Kerja Arsitektur'
                        ],
                        'career_prospects' => [
                            'BIM Modeler / Drafter Arsitektur',
                            '3D Visualizer Arsitektur',
                            'Asisten Arsitek',
                            'Konsultan Desain Interior'
                        ],
                        'head_of_major' => 'Ni Wayan Eka Putri, S.Pd., M.T.',
                    ]
                ]
            ],
            [
                'name' => 'Elektronika',
                'code' => 'EL',
                'majors' => [
                    [
                        'name' => 'Teknik Audio Video',
                        'code' => 'TAV',
                        'tagline' => 'Ahli rekayasa sistem akustik dan multimedia modern',
                        'description' => 'Mempelajari instalasi dan perawatan sistem audio profesional, sistem siaran televisi/radio, serta teknologi akustik ruangan dan digital audio processor.',
                        'competencies' => [
                            'Penerapan Rangkaian Elektronika Audio Video',
                            'Sistem Akustik Ruang dan Sound Engineering',
                            'Perawatan dan Perbaikan Perangkat Audio Video Digital'
                        ],
                        'career_prospects' => [
                            'Sound Engineer / Audio Technician',
                            'Teknisi Studio Broadcasting',
                            'Teknisi Perbaikan Elektronika Konsumen'
                        ],
                        'head_of_major' => 'Drs. I Ketut Darmawan',
                    ],
                    [
                        'name' => 'Teknik Elektronika Industri',
                        'code' => 'ELIN',
                        'tagline' => 'Otomasi industri pintar dan sistem kendali mikroprosesor',
                        'description' => 'Mempelajari sistem otomasi industri, PLC (Programmable Logic Controller), pneumatik, mikrokontroler IoT, dan robotika industri.',
                        'competencies' => [
                            'Pemrograman PLC dan Sistem Otomasi',
                            'Sistem Sensor dan Aktuator Industri',
                            'Robotika dan Internet of Things (IoT)'
                        ],
                        'career_prospects' => [
                            'Teknisi Otomasi dan Kontrol PLC',
                            'Maintenance Engineer Pabrik Industri',
                            'Teknisi Instrumentasi dan IoT'
                        ],
                        'head_of_major' => 'I Gede Agus Sudiarta, S.T.',
                    ]
                ]
            ],
            [
                'name' => 'Ketenagalistrikan',
                'code' => 'KL',
                'majors' => [
                    [
                        'name' => 'Teknik Instalasi Tenaga Listrik',
                        'code' => 'TITL',
                        'tagline' => 'Energi andal untuk industri dan gedung modern',
                        'description' => 'Membekali kompetensi instalasi penerangan gedung, instalasi tenaga industri, panel kontrol motor listrik 3 fasa, dan energi baru terbarukan.',
                        'competencies' => [
                            'Instalasi Penerangan dan Tenaga Listrik',
                            'Perakitan Panel Distribusi & Kontrol Motor',
                            'Instalasi Pembangkit Listrik Tenaga Surya (PLTS)'
                        ],
                        'career_prospects' => [
                            'Instalatir Listrik Gedung dan Pabrik',
                            'Teknisi Panel Kontrol Listrik Industri',
                            'Petugas Pemeliharaan Gardu dan Jaringan PLN'
                        ],
                        'head_of_major' => 'I Made Wijaya, S.Pd.',
                    ],
                    [
                        'name' => 'Teknik Pendingin, Tata Udara, dan Pemanasan',
                        'code' => 'TPTUP',
                        'tagline' => 'Spesialis sistem pendingin komersial dan HVAC gedung bertingkat',
                        'description' => 'Fokus pada instalasi, perbaikan, dan perawatan sistem AC split, chiller central gedung komersial, cold storage, dan sistem ventilasi.',
                        'competencies' => [
                            'Sistem Refrigerasi Komersial dan Industri',
                            'Perawatan Sistem Chiller dan HVAC',
                            'Retrofit Refrigeran Ramah Lingkungan'
                        ],
                        'career_prospects' => [
                            'HVAC Technician Hotel dan Gedung Komersial',
                            'Teknisi Cold Storage Industri Perikanan/Pangan',
                            'Wirausaha Jasa Solusi Tata Udara'
                        ],
                        'head_of_major' => 'I Wayan Suparta, S.T.',
                    ]
                ]
            ],
            [
                'name' => 'Pemesinan',
                'code' => 'MS',
                'majors' => [
                    [
                        'name' => 'Teknik Pemesinan',
                        'code' => 'TPM',
                        'tagline' => 'Presisi tinggi dalam fabrikasi mekanik dan manufaktur CNC',
                        'description' => 'Mempelajari pengoperasian mesin bubut, frais konvensional, mesin CNC tingkat lanjut (milling dan turning), perancangan CAD/CAM mekanikal presisi.',
                        'competencies' => [
                            'Pemrograman dan Pengoperasian Mesin CNC',
                            'Pemesinan Bubut dan Frais Presisi',
                            'Desain CAD/CAM Mekanikal'
                        ],
                        'career_prospects' => [
                            'Operator dan Programmer Mesin CNC',
                            'Tool Maker dan Mold Maker',
                            'Quality Control Industri Manufaktur'
                        ],
                        'head_of_major' => 'I Ketut Suartana, S.T.',
                    ]
                ]
            ],
            [
                'name' => 'Otomotif',
                'code' => 'OT',
                'majors' => [
                    [
                        'name' => 'Teknik Sepeda Motor',
                        'code' => 'TSM',
                        'tagline' => 'Teknologi injeksi pintar dan konversi motor listrik',
                        'description' => 'Mempelajari servis sistem injeksi PGM-FI, kelistrikan bodi sepeda motor modern, engine overhauling, hingga teknologi sepeda motor listrik.',
                        'competencies' => [
                            'Diagnosis Kerusakan Sistem Injeksi Elektronik',
                            'Perawatan Mesin dan Transmisi Otomatis (CVT)',
                            'Teknologi Kendaraan Listrik Roda Dua'
                        ],
                        'career_prospects' => [
                            'Mekanik Service Advisor Bengkel Resmi',
                            'Teknisi Konversi Motor Listrik',
                            'Wirausaha Bengkel Mandiri'
                        ],
                        'head_of_major' => 'I Made Sujana, S.Pd.',
                    ],
                    [
                        'name' => 'Teknik Kendaraan Ringan',
                        'code' => 'TKR',
                        'tagline' => 'Diagnostik canggih kendaraan roda empat dan sistem hybrid',
                        'description' => 'Membekali keahlian sistem Electronic Fuel Injection (EFI), ABS, transmisi otomatis, AC mobil, diagnostik engine scanner, dan teknologi mobil listrik.',
                        'competencies' => [
                            'Tune Up dan Overhaul Mesin Bensin & Diesel',
                            'Diagnostik ECU Menggunakan Engine Scanner',
                            'Sistem Chasis, Transmisi Otomatis, dan Rem ABS'
                        ],
                        'career_prospects' => [
                            'Mekanik dan Diagnostician Bengkel Resmi',
                            'Service Advisor Dealer Otomotif',
                            'Teknisi Sistem Pendingin dan Kelistrikan Mobil'
                        ],
                        'head_of_major' => 'I Nyoman Pande Ardana, S.T.',
                    ]
                ]
            ],
            [
                'name' => 'Komputer dan Informatika',
                'code' => 'KI',
                'majors' => [
                    [
                        'name' => 'Teknik Komputer dan Jaringan',
                        'code' => 'TKJ',
                        'tagline' => 'Arsitektur jaringan enterprise, server administration, dan keamanan siber',
                        'description' => 'Mempelajari perancangan topologi jaringan, konfigurasi router Mikrotik/Cisco, administrasi server Linux/Windows, cloud computing, fiber optic, dan cybersecurity fundamentals.',
                        'competencies' => [
                            'Routing Switching MikroTik & Cisco (MTCNA/CCNA)',
                            'Administrasi Server Linux, Docker, dan Cloud',
                            'Instalasi dan Splicing Jaringan Fiber Optic',
                            'Keamanan Jaringan dan Firewall'
                        ],
                        'career_prospects' => [
                            'Network Engineer / Administrator',
                            'System / Cloud Administrator',
                            'Network Security Specialist',
                            'Field Engineer ISP (Internet Service Provider)'
                        ],
                        'head_of_major' => 'Ni Made Sukerti, S.Kom.',
                    ],
                    [
                        'name' => 'Rekayasa Perangkat Lunak',
                        'code' => 'RPL',
                        'tagline' => 'Membangun aplikasi web, mobile, dan sistem cerdas berdampak tinggi',
                        'description' => 'Fokus pada pengembangan aplikasi full-stack, rekayasa basis data relasional dan NoSQL, mobile app development (Flutter/React Native), RESTful API, dan metodologi agile software engineering.',
                        'competencies' => [
                            'Full-Stack Web Development (Laravel, React/Vue, Tailwind)',
                            'Mobile Application Development',
                            'Database Design dan API Architecture',
                            'Version Control Git dan CI/CD Deployment'
                        ],
                        'career_prospects' => [
                            'Full-Stack Web Developer',
                            'Frontend / Mobile App Developer',
                            'Backend & API Engineer',
                            'Software Quality Assurance (QA)'
                        ],
                        'head_of_major' => 'I Wayan Artha, S.Kom., M.Cs.',
                    ]
                ]
            ],
            [
                'name' => 'Desain Komunikasi Visual',
                'code' => 'DKV',
                'majors' => [
                    [
                        'name' => 'Desain Komunikasi Visual',
                        'code' => 'DKV',
                        'tagline' => 'Kreativitas visual, branding strategis, dan motion graphics',
                        'description' => 'Mengasah daya cipta dalam tipografi, ilustrasi digital, UI/UX design, corporate branding, fotografi komersial, motion graphic, dan packaging design.',
                        'competencies' => [
                            'Graphic Design & Brand Identity (Illustrator, Photoshop)',
                            'UI/UX Design dan Prototyping (Figma)',
                            'Motion Graphic dan Animasi 2D',
                            'Fotografi Komersial dan Digital Imaging'
                        ],
                        'career_prospects' => [
                            'Graphic Designer / Brand Designer',
                            'UI/UX Designer',
                            'Motion Graphic Artist',
                            'Digital Illustrator'
                        ],
                        'head_of_major' => 'I Made Suardana, S.Sn.',
                    ]
                ]
            ],
            [
                'name' => 'Broadcasting & Perfilman',
                'code' => 'BP',
                'majors' => [
                    [
                        'name' => 'Produksi Film',
                        'code' => 'PRF',
                        'tagline' => 'Bercerita lewat sinematografi berkelas dan produksi audiovisual',
                        'description' => 'Mempelajari manajemen pra-produksi, penulisan naskah, sinematografi dan tata kamera, tata suara studio, penyuntingan video (editing), dan color grading sinematik.',
                        'competencies' => [
                            'Sinematografi dan Tata Cahaya Film',
                            'Video Editing & Color Grading (Premiere / DaVinci Resolve)',
                            'Tata Suara Lapangan dan Post-Production Audio',
                            'Manajemen Produksi Film Fiksi & Dokumenter'
                        ],
                        'career_prospects' => [
                            'Director of Photography (DoP) / Kameramen',
                            'Video Editor & Colorist',
                            'Produser Audiovisual / Konten Kreator',
                            'Audio Engineer Pasca-Produksi'
                        ],
                        'head_of_major' => 'Ni Luh Putu Sintya, S.Sn.',
                    ]
                ]
            ]
        ];

        $orderIndex = 1;
        foreach ($fieldsData as $fData) {
            $field = Field::updateOrCreate(
                ['code' => $fData['code']],
                [
                    'name' => $fData['name'],
                    'slug' => Str::slug($fData['name']),
                    'description' => 'Bidang keahlian ' . $fData['name'] . ' SMK Negeri 1 Denpasar',
                ]
            );

            foreach ($fData['majors'] as $mData) {
                $major = Major::updateOrCreate(
                    ['code' => $mData['code']],
                    [
                        'field_id' => $field->id,
                        'name' => $mData['name'],
                        'slug' => Str::slug($mData['code']),
                        'tagline' => $mData['tagline'],
                        'description' => $mData['description'],
                        'competencies' => $mData['competencies'],
                        'career_prospects' => $mData['career_prospects'],
                        'head_of_major' => $mData['head_of_major'],
                        'order_index' => $orderIndex++,
                    ]
                );

                // Buat 3 rombel default untuk tiap jurusan (X, XI, XII)
                for ($grade = 10; $grade <= 12; $grade++) {
                    $gradeRoman = match($grade) { 10 => 'X', 11 => 'XI', 12 => 'XII' };
                    Classroom::updateOrCreate(
                        [
                            'major_id' => $major->id,
                            'name' => "{$gradeRoman} {$major->code} 1",
                        ],
                        [
                            'grade_level' => $grade,
                            'academic_year' => '2025/2026',
                        ]
                    );
                }
            }
        }
    }
}
