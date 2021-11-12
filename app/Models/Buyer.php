<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'pond_detail_id',
        'name',
        'phone',
        'status',
        'question'
    ];

    public function pond_detail() {
        return $this->belongsTo(PondDetail::class);
    }
}
