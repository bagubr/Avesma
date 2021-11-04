<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishSpecies extends Model
{
    use HasFactory;

    protected $table = 'fish_specieses';

    protected $fillable = [
        'name',
        'image'
    ];

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return env('APP_URL').$this->image;
    }
}
