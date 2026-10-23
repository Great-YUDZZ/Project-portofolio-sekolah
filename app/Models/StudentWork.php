<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_id',
        'title',
        'slug',
        'student_name',
        'year',
        'description',
        'thumbnail',
        'demo_url',
        'tech_stack',
    ];

    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
        ];
    }

    public function getClassNameAttribute(): string
    {
        return 'TP ' . ($this->year ?: date('Y'));
    }

    public function getProjectUrlAttribute(): ?string
    {
        return $this->demo_url;
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
