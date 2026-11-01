<?php

namespace Database\Seeders;

use App\Models\StaffMember;
use Illuminate\Database\Seeder;

class StaffMemberSeeder extends Seeder
{
    public function run(): void
    {
        $staff = [
            // Pimpinan Sekolah & Manajemen
            [
                'name' => 'I Ketut Sumerta, S.Pd., M.Pd.',
                'role_title' => 'Kepala Sekolah',
                'department' => 'Manajemen Pimpinan',
                'email' => 'kepsek@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 1,
            ],
            [
                'name' => 'I Wayan Suwira, S.Pd., M.Pd.',
                'role_title' => 'Wakil Kepala Sekolah Bidang Kurikulum',
                'department' => 'Manajemen Pimpinan',
                'email' => 'kurikulum@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 2,
            ],
            [
                'name' => 'Drs. I Made Suarta, M.Pd.',
                'role_title' => 'Wakil Kepala Sekolah Bidang Kesiswaan',
                'department' => 'Manajemen Pimpinan',
                'email' => 'kesiswaan@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 3,
            ],
            [
                'name' => 'I Nyoman Sudiarta, S.T., M.Pd.',
                'role_title' => 'Wakil Kepala Sekolah Bidang Humas & Hubin',
                'department' => 'Manajemen Pimpinan',
                'email' => 'humas@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 4,
            ],
            [
                'name' => 'I Ketut Rai Sudarma, S.T.',
                'role_title' => 'Wakil Kepala Sekolah Bidang Sarana & Prasarana',
                'department' => 'Manajemen Pimpinan',
                'email' => 'sarpras@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 5,
            ],
            [
                'name' => 'Dra. Ni Made Sri Wahyuni, M.Pd.',
                'role_title' => 'Wakil Kepala Sekolah Bidang Manajemen Mutu',
                'department' => 'Manajemen Pimpinan',
                'email' => 'spmi@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 6,
            ],
            [
                'name' => 'I Gusti Ngurah Agung Suardana, S.Sos.',
                'role_title' => 'Kepala Subbagian Tata Usaha',
                'department' => 'Tata Usaha & Administrasi',
                'email' => 'tu@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 7,
            ],
            [
                'name' => 'Ni Luh Putu Eka Jayanti, S.Pd., M.Pd.',
                'role_title' => 'Kepala Perpustakaan Sekolah',
                'department' => 'Perpustakaan & Literasi',
                'email' => 'lib@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 8,
            ],

            // Ketua Program Keahlian (Kaprogli)
            [
                'name' => 'I Made Agus Wirawan, S.Kom., M.Cs.',
                'role_title' => 'Ketua Program Keahlian Teknik Komputer & Jaringan (TKJ)',
                'department' => 'Teknik Jaringan Komputer & Telekomunikasi',
                'email' => 'kaprog.tkj@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 9,
            ],
            [
                'name' => 'I Gede Putu Krisna Astawa, S.Kom., M.T.',
                'role_title' => 'Ketua Program Keahlian Rekayasa Perangkat Lunak (RPL)',
                'department' => 'Pengembangan Perangkat Lunak & Gim',
                'email' => 'kaprog.rpl@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 10,
            ],
            [
                'name' => 'Ni Kadek Dwi Arisanti, S.Sn., M.Pd.',
                'role_title' => 'Ketua Program Keahlian Desain Komunikasi Visual (DKV)',
                'department' => 'Seni & Ekonomi Kreatif',
                'email' => 'kaprog.dkv@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 11,
            ],
            [
                'name' => 'I Wayan Wahyu Sugiarta, S.Sn.',
                'role_title' => 'Ketua Program Keahlian Animasi',
                'department' => 'Seni & Ekonomi Kreatif',
                'email' => 'kaprog.animasi@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 12,
            ],
            [
                'name' => 'Ir. I Made Budiasa, M.T.',
                'role_title' => 'Ketua Program Keahlian Desain Pemodelan & Informasi Bangunan (DPIB)',
                'department' => 'Teknik Konstruksi & Properti',
                'email' => 'kaprog.dpib@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 13,
            ],
            [
                'name' => 'I Nyoman Arka, S.T.',
                'role_title' => 'Ketua Program Keahlian Teknik Konstruksi & Perumahan (TKP)',
                'department' => 'Teknik Konstruksi & Properti',
                'email' => 'kaprog.tkp@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 14,
            ],
            [
                'name' => 'I Ketut Sukada, S.T.',
                'role_title' => 'Ketua Program Keahlian Teknik Elektronika Industri (ELIN)',
                'department' => 'Teknik Elektronika',
                'email' => 'kaprog.elin@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 15,
            ],
            [
                'name' => 'I Made Sukadana, S.T.',
                'role_title' => 'Ketua Program Keahlian Teknik Kendaraan Ringan Otomotif (TKRO)',
                'department' => 'Teknik Otomotif',
                'email' => 'kaprog.tkro@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 16,
            ],
            [
                'name' => 'I Putu Gede Astawa, S.T.',
                'role_title' => 'Ketua Program Keahlian Teknik Sepeda Motor (TBSM)',
                'department' => 'Teknik Otomotif',
                'email' => 'kaprog.tbsm@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 17,
            ],
            [
                'name' => 'I Ketut Wardana, S.T.',
                'role_title' => 'Ketua Program Keahlian Teknik Pengelasan & Fabrikasi Logam (TPFL)',
                'department' => 'Teknik Mesin',
                'email' => 'kaprog.tpfl@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 18,
            ],
            [
                'name' => 'I Nyoman Mertayasa, S.T., M.Pd.',
                'role_title' => 'Ketua Program Keahlian Teknik Ketenagalistrikan (TITL)',
                'department' => 'Teknik Ketenagalistrikan',
                'email' => 'kaprog.titl@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 19,
            ],
            [
                'name' => 'I Made Sudiana, S.T.',
                'role_title' => 'Ketua Program Keahlian Teknik Pendingin & Tata Udara (TPTUP)',
                'department' => 'Teknik Energi & Lingkungan',
                'email' => 'kaprog.tptup@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 20,
            ],

            // Pendidik Kejuruan & Tenaga Kependidikan
            [
                'name' => 'I Kadek Yoga Prasetya, S.Kom.',
                'role_title' => 'Guru Produktif Rekayasa Perangkat Lunak',
                'department' => 'Pengembangan Perangkat Lunak & Gim',
                'email' => 'yoga.prasetya@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 21,
            ],
            [
                'name' => 'Ni Wayan Desi Antari, S.T.',
                'role_title' => 'Guru Produktif Jaringan Komputer & Cloud',
                'department' => 'Teknik Jaringan Komputer & Telekomunikasi',
                'email' => 'desi.antari@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 22,
            ],
            [
                'name' => 'I Komang Triyasa, S.Kom.',
                'role_title' => 'Guru Produktif Desain Antarmuka & Frontend',
                'department' => 'Pengembangan Perangkat Lunak & Gim',
                'email' => 'triyasa@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 23,
            ],
            [
                'name' => 'I Nyoman Alit Suryawan, A.Md.',
                'role_title' => 'Laboran Komputer & Administrator Jaringan Lab',
                'department' => 'Laboratorium Komputer',
                'email' => 'labkom@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 24,
            ],
            [
                'name' => 'Ni Putu Dewi Anggraeni, S.E.',
                'role_title' => 'Staf Tata Usaha Bidang Kepegawaian & Kesiswaan',
                'department' => 'Tata Usaha & Administrasi',
                'email' => 'kepegawaian@smkn1denpasar.sch.id',
                'photo' => null,
                'order_index' => 25,
            ],
        ];

        foreach ($staff as $item) {
            StaffMember::updateOrCreate(
                ['email' => $item['email']],
                $item
            );
        }
    }
}
