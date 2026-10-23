<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id',
        'name',
        'code',
        'slug',
        'tagline',
        'description',
        'vision_mission',
        'career_prospects',
        'competencies',
        'head_of_major',
        'icon',
        'image',
        'order_index',
    ];

    protected function casts(): array
    {
        return [
            'career_prospects' => 'array',
            'competencies' => 'array',
        ];
    }

    public function getSummaryAttribute(): string
    {
        return (string) ($this->tagline ?: $this->description);
    }

    public function getFacilitiesListAttribute(): array
    {
        return (array) ($this->competencies ?? []);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function studentWorks()
    {
        return $this->hasMany(StudentWork::class);
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }
}
