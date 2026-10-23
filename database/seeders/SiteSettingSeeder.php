<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Identitas & Semboyan Resmi (smkn1denpasar.sch.id)
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
                'key' => 'school_tagline',
                'value' => 'Abhyāsad Dhäryate Vidyä.',
                'group' => 'identity',
            ],
            [
                'key' => 'school_slogan',
                'value' => 'Abhyāsad Dhäryate Vidyä.',
                'group' => 'identity',
            ],
            [
                'key' => 'school_slogan_meaning',
                'value' => 'Peliharalah ilmu sampai menjadi tradisi.',
                'group' => 'identity',
            ],
            [
                'key' => 'school_founded',
                'value' => '1962',
                'group' => 'identity',
            ],
            [
                'key' => 'hero_highlight',
                'value' => '“When I Grow Up” Spirit Day!',
                'group' => 'identity',
            ],
            // 4 Karakter Utama SKENSA (lms.skensa.id)
            [
                'key' => 'character_values',
                'value' => json_encode([
                    [
                        'title' => 'Siap',
                        'desc' => 'Siaga menghadapi tantangan, berkomitmen mencapai tujuan.',
                        'code' => '01',
                    ],
                    [
                        'title' => 'Kompeten',
                        'desc' => 'Keselarasan pengetahuan dan keterampilan dalam melaksanakan tugas.',
                        'code' => '02',
                    ],
                    [
                        'title' => 'Disiplin',
                        'desc' => 'Pembiasaan terstruktur dengan penuh tanggung jawab.',
                        'code' => '03',
                    ],
                    [
                        'title' => 'Beretika',
                        'desc' => 'Menjunjung tinggi nilai etika dan norma dalam berkehidupan sosial.',
                        'code' => '04',
                    ],
                ]),
                'group' => 'identity',
            ],
            // Statistik Riil Ekosistem SKENSA
            [
                'key' => 'stats_fields_count',
                'value' => '9',
                'group' => 'stats',
            ],
            [
                'key' => 'stats_majors_count',
                'value' => '12',
                'group' => 'stats',
            ],
            [
                'key' => 'stats_active_lms_users',
                'value' => '4.205',
                'group' => 'stats',
            ],
            [
                'key' => 'stats_courses_modules',
                'value' => '135',
                'group' => 'stats',
            ],
            // Kontak Resmi (smkn1denpasar.sch.id)
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
                    'facebook' => 'https://www.facebook.com/smknegeri1denpasar',
                    'instagram' => 'https://instagram.com/smkn1denpasar',
                    'youtube' => 'https://youtube.com/@smkn1denpasar',
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
