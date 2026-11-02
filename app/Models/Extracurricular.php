<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'sub_cluster',
        'mentor_name',
        'mentor_phone',
        'description',
        'order_index',
    ];

    public function getFormattedWhatsappAttribute(): ?string
    {
        if (empty($this->mentor_phone)) {
            return null;
        }

        $clean = preg_replace('/[^0-9]/', '', (string) $this->mentor_phone);

        if (str_starts_with($clean, '0')) {
            $clean = '62' . substr($clean, 1);
        } elseif (!str_starts_with($clean, '62')) {
            $clean = '62' . $clean;
        }

        return $clean;
    }

    public function getCategoryLabelAttribute(): string
    {
        return $this->category === 'non-akademik' ? 'Non-Akademik' : 'Akademik';
    }

    public function scopeAcademic(Builder $query): Builder
    {
        return $query->where('category', 'akademik');
    }

    public function scopeNonAcademic(Builder $query): Builder
    {
        return $query->where('category', 'non-akademik');
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        $escaped = addcslashes(mb_substr($search, 0, 100), '%_\\');
        $pattern = "%{$escaped}%";

        return $query->where(function ($q) use ($pattern) {
            $q->where('name', 'like', $pattern)
                ->orWhere('mentor_name', 'like', $pattern)
                ->orWhere('sub_cluster', 'like', $pattern);
        });
    }
}
