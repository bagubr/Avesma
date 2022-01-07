<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    const STATUS1 = 'PENDING';
    const STATUS2 = 'CONTACTED';
    protected $fillable = [
        'pond_harvest_id',
        'name',
        'phone',
        'status',
        'question'
    ];

    public function pond_harvest() {
        return $this->belongsTo(PondHarvest::class);
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
