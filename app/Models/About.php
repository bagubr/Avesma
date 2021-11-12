<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = ['description_indo', 'description_english', 'video_url', 'vision', 'mission', 'image'];
    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        return url('uploads/' . $this->image);
    }
}
