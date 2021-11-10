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

    public function pond_detail() {
        return $this->belongsTo(PondDetail::class);
    }
}
