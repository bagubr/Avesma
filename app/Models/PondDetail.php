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
        'seed_count'
    ];

    protected $appends = [
        'pond_name',
        'fish_category',
        'spesies_name',
        'pond_spesies',
        'text',
    ];

    public function pond()
    {
        return $this->belongsTo(Pond::class, 'pond_id');
    }
    public function getFishCategoryAttribute()
    {
        return $this->fish_species->fish_category?->name ?? '';
    }

    public function getPondNameAttribute()
    {
        return $this->pond()->first()?->name ?? '';
    }

    public function fish_species()
    {
        return $this->belongsTo(FishSpecies::class, 'fish_species_id');
    }

    public function getSpesiesNameAttribute()
    {
        return $this->fish_species()->first()?->name ?? '';
    }

    public function getPondSpesiesAttribute()
    {
        return $this->pond_name . ' - ' . $this->spesies_name;
    }

    public function getTextAttribute()
    {
        return $this->pond_name . ' - ' . $this->spesies_name;
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
