<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    use HasFactory;
    protected $table = 'ponds';

    const STATUS1 = "HATCHERY";
    const STATUS2 = "HARVEST";
    const STATUS3 = "IS_CLOSE";

    protected $fillable = [
        'user_id',
        'name',
        'area',
        'status',
        'latitude',
        'longitude',
        'address',
    ];

    public function pond_detail()
    {
        return $this->hasOne(PondDetail::class, 'pond_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class);
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
