<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class);
    }


}
