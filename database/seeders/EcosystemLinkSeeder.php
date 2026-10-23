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
                'title' => 'Portal LMS Skensa',
                'subtitle' => 'Platform pembelajaran digital terintegrasi (kursus, tugas, dan evaluasi daring)',
                'url' => '/lms',
                'icon' => 'graduation-cap',
                'badge' => 'Sistem Internal',
                'order_index' => 1,
            ],
            [
                'title' => 'e-Library Skensa',
                'subtitle' => 'Koleksi ribuan buku referensi vokasi, modul praktikum, dan literatur digital',
                'url' => 'https://lib.smkn1denpasar.sch.id',
                'icon' => 'book-open',
                'badge' => 'Perpustakaan',
                'order_index' => 2,
            ],
            [
                'title' => 'LSP SMKN 1 Denpasar',
                'subtitle' => 'Lembaga Sertifikasi Profesi Pihak Pertama (LSP-P1) berlisensi resmi BNSP',
                'url' => 'https://lsp-smkn1denpasar.id',
                'icon' => 'check-badge',
                'badge' => 'Sertifikasi BNSP',
                'order_index' => 3,
            ],
            [
                'title' => 'Tracer Vokasi Kemendikbud',
                'subtitle' => 'Pelacakan jejak alumni, keterserapan kerja di industri, dan survei kepuasan mitra',
                'url' => 'https://tracervokasi.kemendikdasmen.go.id',
                'icon' => 'arrow-trending-up',
                'badge' => 'Nasional',
                'order_index' => 4,
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
