<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'address',
        'tin',
        'created_by',
        'updated_by',
        'is_active'

    ];

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = [
        'url'
    ];

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value == 1
        );
    }


    protected function getUrlAttribute() {
        return url('admin/branch/'.$this->getKey());
    }




}
