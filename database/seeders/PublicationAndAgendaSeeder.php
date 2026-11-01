<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PublicationAndAgendaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->orWhere('username', 'admin')->first();

        // =========================================================================
        // 1. POSTS (BERITA & PENGUMUMAN RESMI)
        // =========================================================================
        $posts = [
            [
                'title' => 'Kelulusan Kelas XII Tahun Ajaran 2024/2025',
                'category' => 'pengumuman',
                'excerpt' => 'Pengumuman kelulusan bagi siswa kelas XII SMK Negeri 1 Denpasar tahun ajaran 2024/2025 ditetapkan mengacu pada kebijakan Kemendikdasmen secara daring melalui laman resmi kelulusan.',
                'content' => '<p>Pengumuman kelulusan bagi siswa kelas XII SMK Negeri 1 Denpasar tahun ajaran 2024/2025 ditetapkan mengacu pada kebijakan Kementerian Pendidikan Dasar dan Menengah (Kemendikdasmen).</p>
                <p>Pengumuman dilakukan secara daring melalui laman resmi yang telah disediakan guna menghindari kerumunan dan potensi konvoi atau aksi corat-coret yang tidak dianjurkan oleh pihak sekolah dan aparat penertiban.</p>
                <p>Peserta didik diimbau untuk mengakses informasi kelulusan dari rumah masing-masing dengan menyiapkan Nomor Induk Siswa Nasional (NISN) serta tetap menjaga ketertiban, etika, dan nama baik almamater tercinta.</p>',
                'featured_image' => '/images/gedung_skensa.jpg',
                'published_at' => Carbon::now()->subDays(2),
                'is_published' => true,
            ],
            [
                'title' => '“When I Grow Up” Spirit Day: Memupuk Karakter Vokasi Unggul',
                'category' => 'berita',
                'excerpt' => 'Sorotan kegiatan ekspresi aspirasi profesi dan semangat belajar siswa SMK Negeri 1 Denpasar dalam merayakan cita-cita masa depan bersama seluruh sivitas akademika.',
                'content' => '<p>SMK Negeri 1 Denpasar menyelenggarakan kegiatan <strong>“When I Grow Up” Spirit Day!</strong> sebagai wadah ekspresi aspirasi karier dan penguatan budaya kerja bagi peserta didik di seluruh program keahlian.</p>
                <p>Selaras dengan semboyan sekolah <em>Abhyāsad Dhäryate Vidyä</em> (Peliharalah ilmu sampai menjadi tradisi), kegiatan ini mendorong siswa untuk memvisualisasikan etos kerja masa depan mereka serta membangun kesiapan kompetensi sejak dini.</p>
                <p>Berbagai pertunjukan bakat kejuruan, parade busana profesi industri, dan sharing session bersama para alumni sukses turut memeriahkan suasana sepanjang hari.</p>',
                'featured_image' => '/images/hero_siswa.jpg',
                'published_at' => Carbon::now()->subDays(5),
                'is_published' => true,
            ],
            [
                'title' => 'SMK Negeri 1 Denpasar Borong 5 Medali Emas LKS Tingkat Nasional',
                'category' => 'berita',
                'excerpt' => 'Kontingen kejuruan SKENSA berhasil menorehkan prestasi gemilang dengan membawa pulang 5 medali emas pada Lomba Kompetensi Siswa (LKS) SMK Tingkat Nasional.',
                'content' => '<p>Prestasi membanggakan kembali diraih oleh para duta kejuruan SMK Negeri 1 Denpasar pada ajang bergengsi <strong>Lomba Kompetensi Siswa (LKS) SMK Tingkat Nasional</strong>.</p>
                <p>Lima medali emas berhasil dipersembahkan pada bidang lomba Web Technologies (RPL), IT Network Systems Administration (TKJ), Refrigeration and Air Conditioning (TPTUP), Automobile Technology (TKR), dan Film Pendek Vokasi (PRF).</p>
                <p>Kepala SMK Negeri 1 Denpasar menyampaikan apresiasi setinggi-tingginya kepada para siswa juara, guru pembimbing, serta mitra industri DUDIKA yang telah memberikan bimbingan intensif selama masa karantina kompetensi.</p>',
                'featured_image' => '/images/hero_siswa.jpg',
                'published_at' => Carbon::now()->subDays(8),
                'is_published' => true,
            ],
            [
                'title' => 'Jadwal Pelaksanaan Uji Sertifikasi Kompetensi Profesi BNSP LSP-P1',
                'category' => 'pengumuman',
                'excerpt' => 'Pemberitahuan resmi jadwal uji kompetensi keahlian dan sertifikasi BNSP berlisensi Garuda Emas untuk seluruh siswa kelas XII di 13 konsentrasi keahlian.',
                'content' => '<p>Lembaga Sertifikasi Profesi Pihak Pertama (LSP-P1) SMK Negeri 1 Denpasar mengumumkan jadwal resmi pelaksanaan <strong>Uji Sertifikasi Kompetensi Profesi</strong> tahun 2026.</p>
                <p>Uji kompetensi akan dilaksanakan di Tempat Uji Kompetensi (TUK) masing-masing jurusan dengan melibatkan asesor bersertifikat BNSP dan perwakilan penguji eksternal dari dunia usaha dan dunia kerja (DUDIKA).</p>
                <p>Seluruh calon asesi diharapkan telah menyelesaikan portofolio bukti kompetensi (bukti langsung dan tidak langsung) sesuai dengan skema okupasi nasional yang didaftarkan.</p>',
                'featured_image' => '/images/gedung_skensa.jpg',
                'published_at' => Carbon::now()->subDays(12),
                'is_published' => true,
            ],
            [
                'title' => 'Peresmian Kerjasama Daikin Center of Excellence (CoE) Bidang Tata Udara',
                'category' => 'berita',
                'excerpt' => 'Penguatan kurikulum vokasi dan fasilitas bengkel pendingin ramah lingkungan melalui kemitraan strategis berstandar global bersama PT Daikin Airconditioning Indonesia.',
                'content' => '<p>Sebagai langkah strategis dalam mewujudkan SMK Pusat Keunggulan (Center of Excellence), SMK Negeri 1 Denpasar secara resmi meresmikan laboratorium pelatihan terpadu bersama <strong>PT Daikin Airconditioning Indonesia</strong>.</p>
                <p>Fasilitas ini dilengkapi dengan trainer VRV (Variable Refrigerant Volume) generasi terbaru, unit simulator multi-split inverter, dan peralatan penanganan refrigeran ramah lingkungan R32 dan R290.</p>
                <p>Kerjasama ini mencakup penyelarasan kurikulum kejuruan TPTUP, magang guru bersertifikasi industri, serta penyaluran langsung lulusan ke jaringan servis resmi Daikin di seluruh Indonesia.</p>',
                'featured_image' => '/images/gedung_skensa.jpg',
                'published_at' => Carbon::now()->subDays(15),
                'is_published' => true,
            ],
            [
                'title' => 'Panduan Penempatan Praktik Kerja Lapangan (PKL) Industri Terpadu',
                'category' => 'pengumuman',
                'excerpt' => 'Informasi penting mengenai prosedur keberangkatan, tata tertib keselamatan kerja (K3LH), dan pelaporan harian digital bagi siswa peserta PKL.',
                'content' => '<p>Diberitahukan kepada seluruh siswa kelas XI yang akan melaksanakan <strong>Praktik Kerja Lapangan (PKL)</strong> selama 6 bulan di mitra DUDIKA bahwa sesi pembekalan akhir akan dilaksanakan pekan depan.</p>
                <p>Setiap siswa diwajibkan mengunduh format jurnal harian digital, memahami standar operasional prosedur K3 industri, serta mematuhi norma disiplin dan etika kerja yang berlaku di lingkungan perusahaan mitra.</p>
                <p>Penyerahan siswa ke pihak industri akan didampingi secara langsung oleh guru pembimbing kejuruan masing-masing konsentrasi keahlian.</p>',
                'featured_image' => '/images/hero_siswa.jpg',
                'published_at' => Carbon::now()->subDays(20),
                'is_published' => true,
            ],
        ];

        foreach ($posts as $p) {
            Post::updateOrCreate(
                ['slug' => Str::slug($p['title'])],
                array_merge($p, [
                    'author_id' => $admin?->id,
                ])
            );
        }

        // =========================================================================
        // 2. EVENTS (AGENDA AKADEMIK & KEGIATAN SEKOLAH)
        // =========================================================================
        $events = [
            [
                'title' => 'Uji Sertifikasi Kompetensi Keahlian (UKK) LSP-P1 BNSP',
                'slug' => 'ukk-lsp-p1-bnsp-2026',
                'description' => 'Pelaksanaan asesmen kompetensi kejuruan serentak untuk kelas XII di 13 Tempat Uji Kompetensi (TUK) dengan asesor bersertifikat BNSP.',
                'location' => 'TUK Laboratorium & Bengkel Kejuruan SKENSA',
                'start_time' => Carbon::now()->addDays(5)->setHour(8)->setMinute(0),
                'end_time' => Carbon::now()->addDays(10)->setHour(16)->setMinute(0),
            ],
            [
                'title' => 'Job Fair Vokasi & Temu Mitra Industri DUDIKA 2026',
                'slug' => 'job-fair-vokasi-skensa-2026',
                'description' => 'Bursa kerja khusus (BKK) dan rekrutmen langsung bagi lulusan dan calon lulusan bersama lebih dari 35 perusahaan mitra industri ternama.',
                'location' => 'Aula Sasana Budaya & Lapangan Olahraga SKENSA',
                'start_time' => Carbon::now()->addDays(14)->setHour(9)->setMinute(0),
                'end_time' => Carbon::now()->addDays(15)->setHour(15)->setMinute(0),
            ],
            [
                'title' => 'Peringatan Hari Ulang Tahun (HUT) SMK Negeri 1 Denpasar ke-63',
                'slug' => 'hut-skensa-ke-63',
                'description' => 'Rangkaian perayaan hari jadi sekolah dengan gelaran pameran Teaching Factory, pentas seni budaya siswa, dan jalan santai keluarga besar SKENSA.',
                'location' => 'Kampus Utama SMK Negeri 1 Denpasar',
                'start_time' => Carbon::now()->addDays(22)->setHour(7)->setMinute(30),
                'end_time' => Carbon::now()->addDays(24)->setHour(14)->setMinute(0),
            ],
            [
                'title' => 'Workshop Penyelarasan Kurikulum Merdeka & Standar Industri',
                'slug' => 'workshop-kurikulum-merdeka-dudika',
                'description' => 'Diskusi kelompok terarah (FGD) antara tim pengembang kurikulum sekolah dengan praktisi industri untuk pembaruan modul ajar vokasi.',
                'location' => 'Ruang Rapat Yudistira Gedung Utama',
                'start_time' => Carbon::now()->addDays(30)->setHour(8)->setMinute(30),
                'end_time' => Carbon::now()->addDays(30)->setHour(16)->setMinute(30),
            ],
        ];

        foreach ($events as $e) {
            Event::updateOrCreate(
                ['slug' => $e['slug']],
                $e
            );
        }
    }
}
