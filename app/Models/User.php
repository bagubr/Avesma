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
        'address',
        'fcm_token'
    ];

    protected $appends = [
        'avatar_url', 'status_verification', 'region_name'
    ];

    public function user_information()
    {
        return $this->belongsTo(UserInformation::class, 'id',  'user_id');
    }

    public function user_pond()
    {
        return $this->hasMany(Pond::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id',  'id');
    }

    public function ponds()
    {
        return $this->hasMany(Pond::class);
    }
    public function getStatusVerificationAttribute()
    {
        return $this->user_information?->status ?? "";
    }

    public function getRegionNameAttribute()
    {
        return $this->region()?->first()?->name ?? "";
    }

    public function getAvatarUrlAttribute()
    {
        return url('uploads/' . $this->avatar);
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
