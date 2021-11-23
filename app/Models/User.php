<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'avatar',
        'gender',
        'birth_date',
        'is_verified',
        'pokdakan',
        'region_id',
        'imei',
        'address'
    ];

    protected $appends = [
        'avatar_url'
    ];

    public function user_information()
    {
        return $this->belongsTo(UserInformation::class,'id',  'user_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id',  'id');
    }

    public function ponds() {
        return $this->hasMany(Pond::class);
    }

    public function getAvatarUrlAttribute() {
        return asset($this->attributes['avatar']);
    }

    public function getCreatedAtAttribute($value)
    {
        return date("d-m-Y H:i:s", strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date("d-m-Y H:i:s", strtotime($value));
    }
}
