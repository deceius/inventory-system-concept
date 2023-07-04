<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
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

    protected $appends = [
        'url'
    ];

    public function getUrlAttribute() {
        return url('items/settings/type/'.$this->getKey());
    }

}
