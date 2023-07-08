<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'tin',
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



    protected function getUrlAttribute() {
        return url('admin/branch/'.$this->getKey());
    }




}
