<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'brand_id',
        'type_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    protected $appends = [
        'is_active'
    ];


    public function getIsActiveAttribute() {
        return $this->deleted_at == null;
    }

    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class);
    }


}
