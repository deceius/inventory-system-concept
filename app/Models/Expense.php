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
        'date',
        'branch_id',
        'created_by',
        'updated_by',
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


    public function getIsActiveAttribute() {
        return $this->deleted_at == null;
    }

    public function getLastAttribute() {

        $isUpdated = $this->updated_by != null;
        $dateFormat = "Y-m-d h:i:s";
        $user = User::find($isUpdated ? $this->updated_by : $this->created_by);
        if ($this->deleted_at != null) {
            return $user->name." deleted: ". $this->deleted_at;
        }
        $result = $isUpdated ? "last updated: ".$this->updated_at->format($dateFormat) : "created: ".$this->created_at->format($dateFormat);

        return $user->name." ".$result;

    }


    public function getUrlAttribute() {
        return url('expenses/'.$this->getKey());
    }

}
