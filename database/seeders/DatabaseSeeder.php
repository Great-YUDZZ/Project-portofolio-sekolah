<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FieldMajorSeeder::class,
            SiteSettingSeeder::class,
            EcosystemLinkSeeder::class,
            DemoUserSeeder::class,
        ]);
    }
}
