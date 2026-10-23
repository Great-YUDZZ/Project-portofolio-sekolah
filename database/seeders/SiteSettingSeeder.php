<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Identitas & Filosofi
            [
                'key' => 'school_name',
                'value' => 'SMK Negeri 1 Denpasar',
                'group' => 'identity',
            ],
            [
                'key' => 'school_short_name',
                'value' => 'SKENSA',
                'group' => 'identity',
            ],
            [
                'key' => 'school_slogan',
                'value' => 'Abhyāsad Dhäryate Vidyä',
                'group' => 'identity',
            ],
            [
                'key' => 'school_slogan_meaning',
                'value' => 'Peliharalah ilmu pengetahuan dengan cara mengamalkan dalam praktik kehidupan sampai menjadi tradisi.',
                'group' => 'identity',
            ],
            // 4 Karakter Utama SKENSA
            [
                'key' => 'character_values',
                'value' => json_encode([
                    [
                        'title' => 'Siap',
                        'desc' => 'Siaga menghadapi tantangan zaman dan industri, serta berkomitmen teguh mencapai tujuan prestasi.',
                        'icon' => 'zap',
                    ],
                    [
                        'title' => 'Kompeten',
                        'desc' => 'Keselarasan antara kedalaman pengetahuan teoritis dan kemahiran keterampilan teknis standar industri.',
                        'icon' => 'award',
                    ],
                    [
                        'title' => 'Disiplin',
                        'desc' => 'Pembiasaan etos kerja terstruktur dengan penuh integritas dan tanggung jawab moral yang tinggi.',
                        'icon' => 'clock',
                    ],
                    [
                        'title' => 'Beretika',
                        'desc' => 'Menjunjung tinggi nilai kearifan lokal Bali, etika profesi, dan norma kemanusiaan dalam bermasyarakat.',
                        'icon' => 'heart',
                    ],
                ]),
                'group' => 'identity',
            ],
            // Statistik Riil
            [
                'key' => 'stats_students',
                'value' => '25.000+',
                'group' => 'stats',
            ],
            [
                'key' => 'stats_active_lms_users',
                'value' => '4.205',
                'group' => 'stats',
            ],
            [
                'key' => 'stats_courses_modules',
                'value' => '135+',
                'group' => 'stats',
            ],
            [
                'key' => 'stats_majors_count',
                'value' => '13',
                'group' => 'stats',
            ],
            [
                'key' => 'stats_industry_partners',
                'value' => '180+',
                'group' => 'stats',
            ],
            // Kontak Resmi
            [
                'key' => 'contact_address',
                'value' => 'Jalan HOS. Cokroaminoto No. 84 Denpasar, Bali 80118',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_phone',
                'value' => '081236396662',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_email',
                'value' => 'fo@smkn1denpasar.sch.id',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_maps_url',
                'value' => 'https://maps.app.goo.gl/5kRHGNBWvKrcPzVY6',
                'group' => 'contact',
            ],
            [
                'key' => 'social_links',
                'value' => json_encode([
                    'instagram' => 'https://instagram.com/smkn1denpasar',
                    'youtube' => 'https://youtube.com/@smkn1denpasar',
                    'facebook' => 'https://www.facebook.com/smknegeri1denpasar',
                ]),
                'group' => 'contact',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'group' => $setting['group']]
            );
        }
    }
}
