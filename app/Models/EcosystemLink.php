<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcosystemLink extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'url', 'icon', 'badge', 'order_index'];

    public function getNameAttribute(): string
    {
        return (string) $this->title;
    }

    public function getDescriptionAttribute(): string
    {
        return (string) $this->subtitle;
    }

    public function getCategoryAttribute(): string
    {
        return (string) ($this->badge ?: 'Layanan Digital');
    }
}
