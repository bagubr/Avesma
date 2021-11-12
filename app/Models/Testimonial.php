<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'position', 'message', 'image'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return url('uploads/' . $this->image);
    }
}
