<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'is_active'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
