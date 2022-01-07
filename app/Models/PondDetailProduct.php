<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PondDetailProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'pond_detail_id',
        'name'
    ];

    protected $appends = [
        'text'
    ];

    public function getTextAttribute()
    {
        return $this->name;
    }

    public function pond_detail() {
        return $this->belongsTo(PondDetail::class);
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
