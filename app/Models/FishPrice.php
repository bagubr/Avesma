<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishPrice extends Model
{
    use HasFactory;

    protected $fillable = ['fish_species_id', 'price', 'reported_at', 'city_id', 'is_verified'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function fish_species()
    {
        return $this->belongsTo(FishSpecies::class, 'fish_species_id');
    }
}
