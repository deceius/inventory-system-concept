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
        'url',
        'is_active',
        'last'
    ];

    public function getLastAttribute() {
        $isUpdated = $this->updated_by != null;
        $dateFormat = "Y-m-d h:i:s";
        $user = User::find($isUpdated ? $this->updated_by : $this->created_by);
        $result = $isUpdated ? "last updated: ".$this->updated_at->format($dateFormat) : "created: ".$this->created_at->format($dateFormat);

        return $user->name." ".$result;

    }


    public function getUrlAttribute() {
        return url('items/'.$this->getKey());
    }

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
