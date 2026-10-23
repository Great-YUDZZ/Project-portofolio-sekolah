<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioContentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('username', 'admin')->first();

        // Berita & Pengumuman Resmi dari https://smkn1denpasar.sch.id/
        $posts = [
            [
                'title' => 'Kelulusan Kelas XII Tahun Ajaran 2024/2025',
                'category' => 'pengumuman',
                'excerpt' => 'Pengumuman kelulusan bagi siswa kelas XII SMK Negeri 1 Denpasar tahun ajaran 2024/2025 ditetapkan pada tanggal 5 Mei 2025 mengacu pada kebijakan Kemendikdasmen secara daring melalui laman resmi https://lulus.smkn1denpasar.sch.id mulai pukul 08.00 WIB.',
                'content' => '<p>Pengumuman kelulusan bagi siswa kelas XII SMK Negeri 1 Denpasar tahun ajaran 2024/2025 ditetapkan pada tanggal <strong>5 Mei 2025</strong> mengacu pada kebijakan Kementerian Pendidikan Dasar dan Menengah (Kemendikdasmen).</p>
                <p>Pengumuman dilakukan secara daring melalui laman resmi <a href="https://lulus.smkn1denpasar.sch.id" target="_blank" rel="noopener">https://lulus.smkn1denpasar.sch.id</a> yang dapat diakses mulai pukul <strong>08.00 WIB</strong>, guna menghindari kerumunan dan potensi konvoi atau aksi corat-coret yang tidak dianjurkan.</p>
                <p>Peserta didik diimbau untuk mengakses informasi kelulusan dari rumah masing-masing dengan menyiapkan Nomor Induk Siswa Nasional (NISN) serta tetap menjaga ketertiban dan nama baik sekolah.</p>',
                'featured_image' => '/images/gedung_skensa.jpg',
                'published_at' => '2025-05-01 08:00:00',
            ],
            [
                'title' => '“When I Grow Up” Spirit Day!',
                'category' => 'berita',
                'excerpt' => 'Sorotan kegiatan ekspresi aspirasi profesi dan semangat belajar siswa SMK Negeri 1 Denpasar dalam merayakan cita-cita masa depan bersama warga sekolah.',
                'content' => '<p>SMK Negeri 1 Denpasar menyelenggarakan kegiatan <strong>“When I Grow Up” Spirit Day!</strong> sebagai wadah ekspresi aspirasi karier dan semangat vokasi bagi peserta didik di seluruh program keahlian.</p>
                <p>Selaras dengan semboyan sekolah <em>Abhyāsad Dhäryate Vidyä.</em> (Peliharalah ilmu sampai menjadi tradisi), kegiatan ini mendorong siswa untuk memvisualisasikan profesi masa depan mereka serta membangun kesiapan kompetensi sejak di bangku sekolah.</p>',
                'featured_image' => '/images/hero_siswa.jpg',
                'published_at' => '2025-04-25 08:00:00',
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
    }
}
