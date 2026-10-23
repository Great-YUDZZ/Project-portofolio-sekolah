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

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
