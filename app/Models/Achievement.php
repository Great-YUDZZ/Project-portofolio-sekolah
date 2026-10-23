<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'student_or_team',
        'major_id',
        'rank',
        'level',
        'year',
        'description',
        'image',
    ];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
