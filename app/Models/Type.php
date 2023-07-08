<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'url',
        'is_active'
    ];


    public function getIsActiveAttribute() {
        return $this->deleted_at == null;
    }

    public function getUrlAttribute() {
        return url('items/settings/types/'.$this->getKey());
    }
}
