<?php

namespace App\Enums;

enum PostStatus: string
{
    case Draft = 'draft';
    case Pending = 'pending';
    case Published = 'published';
    case Rejected = 'rejected';
    case Archived = 'archived';

    public function label(): string
    {
        return match($this) {
            self::Draft => 'Draf',
            self::Pending => 'Menunggu Persetujuan',
            self::Published => 'Terbit',
            self::Rejected => 'Ditolak',
            self::Archived => 'Diarsipkan',
        };
    }

    public function badgeClasses(): string
    {
        return match($this) {
            self::Draft => 'bg-slate-100 text-slate-700 border-slate-300',
            self::Pending => 'bg-amber-50 text-[#D97706] border-amber-300',
            self::Published => 'bg-emerald-50 text-emerald-700 border-emerald-300',
            self::Rejected => 'bg-rose-50 text-rose-700 border-rose-300',
            self::Archived => 'bg-slate-100 text-slate-500 border-slate-300',
        };
    }

    public function badgeColor(): string
    {
        return $this->badgeClasses();
    }
}
