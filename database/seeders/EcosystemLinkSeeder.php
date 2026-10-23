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
                'title' => 'e-Library',
                'subtitle' => 'Perpustakaan digital resmi SMK Negeri 1 Denpasar (lib.smkn1denpasar.sch.id)',
                'url' => 'https://lib.smkn1denpasar.sch.id',
                'icon' => 'book-open',
                'badge' => 'lib.smkn1denpasar.sch.id',
                'order_index' => 1,
            ],
            [
                'title' => 'e-Learning',
                'subtitle' => 'Learning Management System (LMS) SKENSA dengan 4.205 pengguna aktif & 135 kursus (lms.skensa.id)',
                'url' => 'https://lms.skensa.id',
                'icon' => 'graduation-cap',
                'badge' => 'lms.skensa.id',
                'order_index' => 2,
            ],
            [
                'title' => 'Tracer Vokasi',
                'subtitle' => 'Portal pelacakan jejak alumni vokasi Kemendikdasmen (tracervokasi.kemendikdasmen.go.id)',
                'url' => 'https://tracervokasi.kemendikdasmen.go.id',
                'icon' => 'arrow-trending-up',
                'badge' => 'Kemendikdasmen',
                'order_index' => 3,
            ],
            [
                'title' => 'LSP SMKN 1 Denpasar',
                'subtitle' => 'Lembaga Sertifikasi Profesi Pihak Pertama (LSP-P1) SMK Negeri 1 Denpasar (lsp-smkn1denpasar.id)',
                'url' => 'https://lsp-smkn1denpasar.id',
                'icon' => 'check-badge',
                'badge' => 'lsp-smkn1denpasar.id',
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
