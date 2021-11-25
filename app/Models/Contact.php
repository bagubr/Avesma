<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'link', 'value', 'icon'];

    protected $appends = [
        'icon_url', 'link_value'
    ];

    // public function getLinkValueAttribute()
    // {
    //     return $this->link + $this->value;
    // }

    public function getIconUrlAttribute()
    {
        return url('uploads/' . $this->icon);
    }
}
