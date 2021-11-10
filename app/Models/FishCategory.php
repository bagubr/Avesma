<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishCategory extends Model
{
    use HasFactory;
    protected $table = 'fish_categories';
    protected $fillable = [
        'name',
        'image'
    ];
    
    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return env('STORAGE_URL').$this->image;
    }
}
