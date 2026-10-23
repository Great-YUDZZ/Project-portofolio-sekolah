<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use App\Models\Major;
use App\Models\Classroom;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Administrator
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator Skensa',
                'email' => 'admin@skensa.sch.id',
                'role' => Role::Admin,
                'password' => Hash::make('admin123'),
                'phone' => '081236396662',
            ]
        );

        // Ambil ID jurusan untuk relasi guru & kelas
        $rpl = Major::where('code', 'RPL')->first();
        $tkj = Major::where('code', 'TKJ')->first();
        $dkv = Major::where('code', 'DKV')->first();

        // 2. Akun Guru
        $teachers = [
            [
                'username' => 'guru_rpl',
                'name' => 'I Wayan Artha, S.Kom., M.Cs.',
                'email' => 'artha@skensa.sch.id',
                'nip' => '198205142008011005',
                'specialization' => 'Rekayasa Perangkat Lunak & Cloud Architecture',
                'major_id' => $rpl?->id,
            ],
            [
                'username' => 'guru_tkj',
                'name' => 'Ni Made Sukerti, S.Kom.',
                'email' => 'sukerti@skensa.sch.id',
                'nip' => '198509202010012014',
                'specialization' => 'Keamanan Jaringan & Administrasi Server',
                'major_id' => $tkj?->id,
            ],
            [
                'username' => 'guru_dkv',
                'name' => 'I Made Suardana, S.Sn.',
                'email' => 'suardana@skensa.sch.id',
                'nip' => '198003112006041008',
                'specialization' => 'Desain Identitas Visual & Motion Graphics',
                'major_id' => $dkv?->id,
            ],
        ];

        foreach ($teachers as $t) {
            $user = User::updateOrCreate(
                ['username' => $t['username']],
                [
                    'name' => $t['name'],
                    'email' => $t['email'],
                    'role' => Role::Guru,
                    'password' => Hash::make('guru123'),
                ]
            );

            TeacherProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nip' => $t['nip'],
                    'specialization' => $t['specialization'],
                    'major_id' => $t['major_id'],
                ]
            );
        }

        // 3. Akun Siswa (login menggunakan NIS)
        $kelasRpl = Classroom::where('name', 'XII RPL 1')->first();
        $kelasTkj = Classroom::where('name', 'XII TKJ 1')->first();
        $kelasDkv = Classroom::where('name', 'XI DKV 1')->first();

        $students = [
            [
                'nis' => '22001',
                'name' => 'Gede Rama Wijaya',
                'email' => 'rama.22001@siswa.skensa.sch.id',
                'classroom_id' => $kelasRpl?->id,
                'gender' => 'L',
            ],
            [
                'nis' => '22002',
                'name' => 'Kadek Ayu Maharani',
                'email' => 'ayu.22002@siswa.skensa.sch.id',
                'classroom_id' => $kelasTkj?->id,
                'gender' => 'P',
            ],
            [
                'nis' => '22003',
                'name' => 'Komang Bayu Nugraha',
                'email' => 'bayu.22003@siswa.skensa.sch.id',
                'classroom_id' => $kelasDkv?->id,
                'gender' => 'L',
            ],
        ];

        foreach ($students as $s) {
            $user = User::updateOrCreate(
                ['username' => $s['nis']],
                [
                    'name' => $s['name'],
                    'email' => $s['email'],
                    'role' => Role::Siswa,
                    'password' => Hash::make('siswa123'),
                ]
            );

            StudentProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nis' => $s['nis'],
                    'classroom_id' => $s['classroom_id'],
                    'gender' => $s['gender'],
                ]
            );
        }
    }
}
