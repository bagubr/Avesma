<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PondDetail extends Model
{
    use HasFactory;
    protected $table = 'pond_details';
    protected $fillable = [
        'pond_id',
        'fish_species_id',
        'seed_count',
        'seed_size',
        'feed_type',
    ];

    protected $appends = [
        'pond_name',
        'spesies_name'
    ];

    public function pond()
    {
        return $this->belongsTo(Pond::class);
    }

    public function getPondNameAttribute()
    {
        return $this->pond()->first()->name;
    }
    
    public function fish_species()
    {
        return $this->belongsTo(FishSpecies::class, 'fish_species_id');
    }

    public function getSpesiesNameAttribute()
    {
        return $this->fish_species()->first()->name;
    }
}
