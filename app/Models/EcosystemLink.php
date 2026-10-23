<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcosystemLink extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subtitle', 'url', 'icon', 'badge', 'order_index'];
}
