<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PondDetailProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'cycle_id',
        'name'
    ];

    protected $appends = [
        'text'
    ];

    public function getTextAttribute()
    {
        return $this->name;
    }

    public function cycle() {
        return $this->belongsTo(Cycle::class);
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
