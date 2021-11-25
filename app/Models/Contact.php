<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    const TYPE = [
        "WHATSAPP" => "WHATSAPP",
        "PHONE" => "PHONE",
        "EMAIL" => "EMAIL"
    ];

    protected $fillable = ['name', 'content', 'icon', 'type'];

    protected $appends = [
        'icon_url'
    ];

    public function getIconUrlAttribute()
    {
        return url('uploads/' . $this->icon);
    }
}
