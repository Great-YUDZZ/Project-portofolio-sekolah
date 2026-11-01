<?php

namespace Database\Seeders;

use App\Models\EcosystemLink;
use Illuminate\Database\Seeder;

class EcosystemLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'title' => 'e-Learning (LMS SKENSA)',
                'subtitle' => 'Learning Management System terpadu dengan 4.200+ pengguna aktif, bank soal Computer Based Test (CBT), dan materi ajar kejuruan digital.',
                'url' => 'https://lms.skensa.id',
                'icon' => 'academic-cap',
                'badge' => 'Pembelajaran & CBT',
                'order_index' => 1,
            ],
            [
                'title' => 'e-Library (Perpustakaan Digital)',
                'subtitle' => 'Perpustakaan digital resmi SMK Negeri 1 Denpasar dengan katalog OPAC daring, ribuan e-book kejuruan, dan repositori karya ilmiah.',
                'url' => 'https://lib.smkn1denpasar.sch.id',
                'icon' => 'book-open',
                'badge' => 'Perpustakaan Digital',
                'order_index' => 2,
            ],
            [
                'title' => 'LSP-P1 SMKN 1 Denpasar',
                'subtitle' => 'Lembaga Sertifikasi Profesi Pihak Pertama berlisensi Badan Nasional Sertifikasi Profesi (BNSP) untuk skema sertifikasi kompetensi siswa.',
                'url' => 'https://lsp-smkn1denpasar.id',
                'icon' => 'check-badge',
                'badge' => 'Sertifikasi BNSP',
                'order_index' => 3,
            ],
            [
                'title' => 'Tracer Vokasi & Bursa Kerja Khusus',
                'subtitle' => 'Portal penelusuran rekam jejak alumni vokasi Kemendikdasmen serta pusat penyaluran tenaga kerja ke mitra dunia usaha dan industri.',
                'url' => 'https://tracervokasi.kemendikdasmen.go.id',
                'icon' => 'briefcase',
                'badge' => 'Karier & Alumni',
                'order_index' => 4,
            ],
            [
                'title' => 'e-Rapor Vokasi Kurikulum Merdeka',
                'subtitle' => 'Sistem pelaporan capaian kompetensi dan evaluasi belajar peserta didik terintegrasi bagi guru, siswa, dan orang tua.',
                'url' => 'https://erapor.smkn1denpasar.sch.id',
                'icon' => 'document-chart-bar',
                'badge' => 'Penilaian Akademik',
                'order_index' => 5,
            ],
            [
                'title' => 'Portal Pengumuman Kelulusan',
                'subtitle' => 'Pintu pengumuman kelulusan resmi siswa kelas XII secara tertib dan transparan berbasis daring dengan verifikasi NISN.',
                'url' => 'https://lulus.smkn1denpasar.sch.id',
                'icon' => 'check-circle',
                'badge' => 'Kelulusan Siswa',
                'order_index' => 6,
            ],
            [
                'title' => 'SIP-PPDB Provinsi Bali',
                'subtitle' => 'Gerbang pendaftaran online Peserta Didik Baru SMK Negeri 1 Denpasar jalur afirmasi, prestasi sertifikasi, dan zonasi kejuruan.',
                'url' => 'https://smkn1denpasar.sch.id/ppdb',
                'icon' => 'user-plus',
                'badge' => 'Penerimaan Siswa Baru',
                'order_index' => 7,
            ],
            [
                'title' => 'Sistem Penjaminan Mutu Internal (SPMI)',
                'subtitle' => 'Instrumen evaluasi mutu tata kelola sekolah, audit ketercapaian standar ISO, dan akreditasi program studi vokasi.',
                'url' => 'https://spmi.smkn1denpasar.sch.id',
                'icon' => 'shield-check',
                'badge' => 'Manajemen Mutu',
                'order_index' => 8,
            ],
        ];

        foreach ($links as $link) {
            EcosystemLink::updateOrCreate(
                ['url' => $link['url']],
                $link
            );
        }
    }
}
