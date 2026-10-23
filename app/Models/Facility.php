<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image'];

    public function getPhotoAttribute(): ?string
    {
        return $this->image;
    }

    public function getCategoryAttribute(): string
    {
        return 'Sarana & Laboratorium SKENSA';
    }
}
