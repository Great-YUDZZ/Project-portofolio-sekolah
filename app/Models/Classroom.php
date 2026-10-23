<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = ['major_id', 'name', 'grade_level', 'academic_year'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function students()
    {
        return $this->hasMany(StudentProfile::class);
    }
}
