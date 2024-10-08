<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'branch_id',
        'access_tier'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'url',
        'access_tier_string',
        'is_active'
    ];


    public function getIsActiveAttribute() {
        return $this->deleted_at == null;
    }

    public function getUrlAttribute() {
        return url('admin/users/'.$this->getKey());
    }

    public function branch(): BelongsTo {
        return $this->belongsTo(Branch::class);
    }

    protected function getAccessTierStringAttribute()
    {
        switch ($this->access_tier) {
            case 1:
                return 'Admin';
            case 2:
                return 'Manager';
            case 3:
                return 'Team Lead';
            default:
                return 'Team Member';
        }
    }
}
