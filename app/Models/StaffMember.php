<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffMember extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'role_title',
        'department',
        'photo',
        'email',
        'order_index',
    ];

    public function getPositionAttribute(): string
    {
        return (string) $this->role_title;
    }

    public function getGroupAttribute(): string
    {
        return (string) ($this->department ?: 'Pendidik');
    }
}
