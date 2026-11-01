<?php

namespace App\Enums;

enum UserStatus: string
{
    case Active = 'active';
    case Pending = 'pending';
    case Suspended = 'suspended';

    public function label(): string
    {
        return match($this) {
            self::Active => 'Aktif',
            self::Pending => 'Menunggu Aktivasi',
            self::Suspended => 'Dinonaktifkan',
        };
    }

    public function badgeClasses(): string
    {
        return match($this) {
            self::Active => 'bg-emerald-50 text-emerald-700 border-emerald-300',
            self::Pending => 'bg-amber-50 text-[#D97706] border-amber-300',
            self::Suspended => 'bg-rose-50 text-rose-700 border-rose-300',
        };
    }
}
