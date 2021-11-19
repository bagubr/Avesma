<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image'];
    protected $appends = [
        'image_url'
    ];
    public function getImageUrlAttribute()
    {
        return url('uploads/' . $this->image);
    }
}
