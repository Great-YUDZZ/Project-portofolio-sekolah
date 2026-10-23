<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'location', 'start_time', 'end_time'];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    public function getStartDateAttribute()
    {
        return $this->start_time;
    }

    public function getEndDateAttribute()
    {
        return $this->end_time;
    }
}
