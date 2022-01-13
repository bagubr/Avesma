<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    // Hanya untuk disclimer dan quisioner
    protected $table = 'settings';
    protected $fillable = [
        'name',
        'image_screen'
    ];

    protected $appends = ['image_screen_url'];

    public function getImageScreenUrlAttribute()
    {
        return url('uploads/' . $this->image_screen);
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
