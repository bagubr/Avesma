<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FishSpecies extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fish_specieses';

    protected $fillable = [
        'name',
        'image',
        'fish_category_id'
    ];

    protected $appends = [
        'image_url'
    ];
    public function getImageUrlAttribute()
    {
        return url('uploads/' . $this->image);
    }

    public function fish_category()
    {
        return $this->belongsTo(FishCategory::class);
    }

    public function pond_details()
    {
        return $this->hasMany(PondDetail::class);
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
