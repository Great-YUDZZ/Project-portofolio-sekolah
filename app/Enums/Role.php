<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Guru = 'guru';
    case Siswa = 'siswa';

    public function label(): string
    {
        return match($this) {
            self::Admin => 'Administrator',
            self::Guru => 'Guru / Pengajar',
            self::Siswa => 'Siswa',
        };
    }
}
