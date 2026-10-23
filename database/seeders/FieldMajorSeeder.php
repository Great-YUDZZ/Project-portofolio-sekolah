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
                        'tagline' => 'Perencanaan, pelaksanaan, dan pengawasan konstruksi bangunan gedung dan perumahan',
                        'description' => 'Konsentrasi keahlian di bawah Program Teknik Konstruksi SMK Negeri 1 Denpasar yang berfokus pada pelaksanaan konstruksi bangunan, perhitungan anggaran biaya, dan pemetaan lahan.',
                        'competencies' => [
                            'Gambar Teknik dan Konstruksi Bangunan',
                            'Pengukuran dan Pemetaan Tanah',
                            'Konstruksi Beton Bertulang dan Baja',
                            'Rencana Anggaran Biaya (RAB)',
                        ],
                        'career_prospects' => [
                            'Pelaksana Konstruksi Bangunan',
                            'Drafter Struktur Bangunan',
                            'Estimator Biaya Proyek (Quantity Surveyor)',
                            'Surveyor Pemetaan Tanah',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/gedung_skensa.jpg',
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
                        'tagline' => 'Pemodelan arsitektur digital 2D/3D dan Building Information Modeling (BIM)',
                        'description' => 'Konsentrasi keahlian di bawah Program Desain Bangunan SMK Negeri 1 Denpasar yang mempelajari pemodelan digital arsitektur, gambar kerja konstruksi, serta visualisasi bangunan.',
                        'competencies' => [
                            'Aplikasi Perangkat Lunak Desain 2D & 3D (CAD/BIM)',
                            'Desain Arsitektur dan Interior',
                            'Visualisasi dan Rendering Bangunan',
                            'Penyusunan Gambar Kerja Arsitektur',
                        ],
                        'career_prospects' => [
                            'BIM Modeler / Drafter Arsitektur',
                            '3D Visualizer Arsitektur',
                            'Asisten Arsitek',
                            'Konsultan Desain Interior',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/gedung_skensa.jpg',
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
                        'tagline' => 'Rekayasa sistem audio profesional, akustik ruang, dan perangkat multimedia',
                        'description' => 'Konsentrasi keahlian di bawah Program Elektronika SMK Negeri 1 Denpasar yang mempelajari instalasi, pemeliharaan, serta rekayasa sistem audio video dan penyiaran.',
                        'competencies' => [
                            'Penerapan Rangkaian Elektronika Audio Video',
                            'Sistem Akustik Ruang dan Sound Engineering',
                            'Perawatan dan Perbaikan Perangkat Audio Video Digital',
                        ],
                        'career_prospects' => [
                            'Sound Engineer / Audio Technician',
                            'Teknisi Studio Penyiaran',
                            'Teknisi Elektronika Audio Video',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/hero_siswa.jpg',
                    ],
                    [
                        'name' => 'Teknik Elektronika Industri',
                        'code' => 'ELIN',
                        'tagline' => 'Sistem otomasi industri, kendali PLC, mikrokontroler, dan instrumentasi',
                        'description' => 'Konsentrasi keahlian di bawah Program Elektronika SMK Negeri 1 Denpasar yang berfokus pada sistem kendali elektronik industri, Programmable Logic Controller (PLC), dan sensor.',
                        'competencies' => [
                            'Pemrograman PLC dan Sistem Otomasi Industri',
                            'Sistem Sensor, Aktuator, dan Pneumatik',
                            'Mikrokontroler dan Internet of Things (IoT)',
                        ],
                        'career_prospects' => [
                            'Teknisi Otomasi dan Kontrol PLC',
                            'Maintenance Engineer Industri',
                            'Teknisi Instrumentasi dan Kendali',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/hero_siswa.jpg',
                    ]
                ]
            ],
            [
                'name' => 'Ketenagalistrikan',
                'code' => 'KL',
                'majors' => [
                    [
                        'name' => 'Teknik Instalasi dan Tenaga Listrik',
                        'code' => 'TITL',
                        'tagline' => 'Instalasi penerangan gedung, distribusi tenaga listrik, dan panel kontrol industri',
                        'description' => 'Konsentrasi keahlian di bawah Program Ketenagalistrikan SMK Negeri 1 Denpasar yang membekali keterampilan instalasi listrik domestik, komersial, serta sistem kendali motor listrik.',
                        'competencies' => [
                            'Instalasi Penerangan dan Tenaga Listrik 1 & 3 Fasa',
                            'Perakitan Panel Distribusi dan Kendali Motor Listrik',
                            'Pemeliharaan Jaringan dan Peralatan Listrik',
                        ],
                        'career_prospects' => [
                            'Instalatir Listrik Gedung dan Industri',
                            'Teknisi Panel Kontrol Listrik',
                            'Teknisi Pemeliharaan Kelistrikan',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/gedung_skensa.jpg',
                    ],
                    [
                        'name' => 'Teknik Pendingin, Tata Udara, dan Pemanasan',
                        'code' => 'TPTUP',
                        'tagline' => 'Sistem refrigerasi komersial, tata udara gedung bertingkat (HVAC), dan pemanasan',
                        'description' => 'Konsentrasi keahlian di bawah Program Ketenagalistrikan SMK Negeri 1 Denpasar yang berfokus pada instalasi dan perawatan sistem pendingin ruangan, chiller, dan tata udara komersial.',
                        'competencies' => [
                            'Sistem Refrigerasi Domestik dan Komersial',
                            'Instalasi dan Perawatan Sistem Tata Udara (HVAC)',
                            'Sistem Kontrol Kelistrikan Pendingin dan Pemanas',
                        ],
                        'career_prospects' => [
                            'HVAC Technician Hotel dan Gedung Komersial',
                            'Teknisi Refrigerasi dan Cold Storage',
                            'Wirausaha Layanan Tata Udara',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/gedung_skensa.jpg',
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
                        'tagline' => 'Fabrikasi komponen mekanik presisi dan pengoperasian mesin CNC',
                        'description' => 'Konsentrasi keahlian di bawah Program Pemesinan SMK Negeri 1 Denpasar yang mempelajari pemesinan bubut, frais, gerinda, pemrograman CNC, dan desain manufaktur CAD/CAM.',
                        'competencies' => [
                            'Pemrograman dan Pengoperasian Mesin CNC (Milling & Turning)',
                            'Pemesinan Bubut, Frais, dan Gerinda Presisi',
                            'Gambar Teknik Manufaktur CAD/CAM',
                        ],
                        'career_prospects' => [
                            'Operator dan Programmer Mesin CNC',
                            'Teknisi Manufaktur dan Fabrikasi Mekanik',
                            'Quality Control Industri Manufaktur',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/hero_siswa.jpg',
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
                        'tagline' => 'Perawatan mesin sepeda motor injeksi elektronik dan kelistrikan otomotif roda dua',
                        'description' => 'Konsentrasi keahlian di bawah Program Otomotif SMK Negeri 1 Denpasar yang mempelajari perawatan mesin, sasis, kelistrikan, serta diagnosis sistem injeksi sepeda motor.',
                        'competencies' => [
                            'Diagnosis dan Perawatan Sistem Injeksi Elektronik',
                            'Perawatan Mesin, Sasis, dan Transmisi Sepeda Motor',
                            'Sistem Kelistrikan dan Pengelolaan Bengkel Roda Dua',
                        ],
                        'career_prospects' => [
                            'Mekanik dan Teknisi Bengkel Resmi Sepeda Motor',
                            'Service Advisor Otomotif Roda Dua',
                            'Wirausaha Bengkel Sepeda Motor',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/hero_siswa.jpg',
                    ],
                    [
                        'name' => 'Teknik Kendaraan Ringan',
                        'code' => 'TKR',
                        'tagline' => 'Diagnostik kendaraan roda empat, sistem EFI, sasis, dan kelistrikan mobil',
                        'description' => 'Konsentrasi keahlian di bawah Program Otomotif SMK Negeri 1 Denpasar yang mempelajari pemeliharaan mesin kendaraan ringan, sistem pemindah tenaga, sasis, dan kelistrikan otomotif.',
                        'competencies' => [
                            'Pemeliharaan Mesin Kendaraan Ringan dan Sistem EFI',
                            'Pemeliharaan Sasis dan Pemindah Tenaga Kendaraan',
                            'Pemeliharaan Kelistrikan dan AC Kendaraan Ringan',
                        ],
                        'career_prospects' => [
                            'Teknisi dan Mekanik Kendaraan Ringan',
                            'Service Advisor Dealer Otomotif',
                            'Teknisi Diagnostik dan Kelistrikan Mobil',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/hero_siswa.jpg',
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
                        'tagline' => 'Infrastruktur jaringan komputer, administrasi sistem server, dan telekomunikasi',
                        'description' => 'Konsentrasi keahlian di bawah Program Komputer dan Informatika SMK Negeri 1 Denpasar yang berfokus pada perancangan jaringan, konfigurasi router dan server, serta fiber optik.',
                        'competencies' => [
                            'Perancangan dan Konfigurasi Jaringan (Routing & Switching)',
                            'Administrasi Sistem Server dan Layanan Jaringan',
                            'Instalasi Jaringan Fiber Optic dan Keamanan Jaringan',
                        ],
                        'career_prospects' => [
                            'Network Engineer / Network Administrator',
                            'System & Server Administrator',
                            'Teknisi Jaringan Telekomunikasi dan ISP',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/hero_siswa.jpg',
                    ],
                    [
                        'name' => 'Rekayasa Perangkat Lunak',
                        'code' => 'RPL',
                        'tagline' => 'Pengembangan aplikasi web, perangkat bergerak (mobile), dan rekayasa sistem basis data',
                        'description' => 'Konsentrasi keahlian di bawah Program Komputer dan Informatika SMK Negeri 1 Denpasar yang mempelajari pemrograman perangkat lunak, basis data, pengembangan web, dan aplikasi mobile.',
                        'competencies' => [
                            'Pemrograman Berorientasi Objek dan Pengembangan Web',
                            'Pengembangan Aplikasi Perangkat Bergerak (Mobile)',
                            'Perancangan Basis Data dan Integrasi API',
                        ],
                        'career_prospects' => [
                            'Web & Mobile Application Developer',
                            'Software Engineer / Programmer',
                            'Database Administrator & QA Tester',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/hero_siswa.jpg',
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
                        'tagline' => 'Komunikasi visual, identitas merek, fotografi komersial, dan media kreatif digital',
                        'description' => 'Konsentrasi keahlian di bawah Program Desain Komunikasi Visual SMK Negeri 1 Denpasar yang mempelajari desain grafis, ilustrasi, tipografi, fotografi, dan videografi komersial.',
                        'competencies' => [
                            'Desain Grafis, Tipografi, dan Identitas Visual',
                            'Ilustrasi Digital dan Desain Antarmuka (UI/UX)',
                            'Fotografi Komersial dan Pengolahan Citra Digital',
                        ],
                        'career_prospects' => [
                            'Graphic Designer & Brand Designer',
                            'UI/UX Designer & Ilustrator Digital',
                            'Fotografer dan Desainer Media Kreatif',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/gedung_skensa.jpg',
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
                        'tagline' => 'Manajemen produksi film, sinematografi, tata cahaya, tata suara, dan penyuntingan gambar',
                        'description' => 'Konsentrasi keahlian di bawah Program Broadcasting & Perfilman SMK Negeri 1 Denpasar yang mempelajari tahapan pra-produksi, produksi, hingga pasca-produksi karya sinema dan penyiaran.',
                        'competencies' => [
                            'Manajemen Produksi dan Penulisan Naskah Film',
                            'Sinematografi, Tata Kamera, dan Tata Cahaya',
                            'Penyuntingan Video (Editing), Grading, dan Tata Suara',
                        ],
                        'career_prospects' => [
                            'Kameramen / Director of Photography (DoP)',
                            'Video Editor & Colorist',
                            'Kru Produksi Film dan Penyiaran Televisi',
                        ],
                        'head_of_major' => null,
                        'image' => '/images/hero_siswa.jpg',
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
                    'description' => 'Program Keahlian ' . $fData['name'] . ' SMK Negeri 1 Denpasar',
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
                        'image' => $mData['image'],
                        'order_index' => $orderIndex++,
                    ]
                );

                for ($grade = 10; $grade <= 12; $grade++) {
                    $gradeRoman = match($grade) { 10 => 'X', 11 => 'XI', 12 => 'XII' };
                    Classroom::updateOrCreate(
                        [
                            'major_id' => $major->id,
                            'name' => "{$gradeRoman} {$major->code} 1",
                        ],
                        [
                            'grade_level' => $grade,
                            'academic_year' => '2024/2025',
                        ]
                    );
                }
            }
        }
    }
}
