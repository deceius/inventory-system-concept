<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'cost',
        'branch_id',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'date',
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
        return url('expenses/'.$this->getKey());
    }

}
