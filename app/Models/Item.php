<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'brand_id',
        'type_id',
        'is_active'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
