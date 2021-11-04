<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    use HasFactory;
    protected $table = 'ponds';
    protected $fillable = [
        'name',
        'area',
        'latitude',
        'longitude',
        'address',
    ];

    public function pond_detail()
    {
        return $this->hasOne(PondDetail::class, 'pond_id', 'id');
    }
}
