<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishPrice extends Model
{
    use HasFactory;

    protected $fillable = ['fish_species_id', 'price', 'reported_at', 'region_id', 'is_verified'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function fish_species()
    {
        return $this->belongsTo(FishSpecies::class, 'fish_species_id');
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
