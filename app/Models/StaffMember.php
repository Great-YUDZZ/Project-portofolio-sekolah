<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffMember extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role_title', 'department', 'photo', 'email', 'order_index'];
}
