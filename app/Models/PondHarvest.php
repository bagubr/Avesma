<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PondHarvest extends Model
{
    use HasFactory;
    const STATUS1 = "READY_TO_SALE";
    const STATUS2 = "SOLD";
    protected $fillable = ['pond_detail_id', 'harvest_at', 'weight', 'image', 'status', 'description'];

    public function pond_detail()
    {
        return $this->hasOne(PondDetail::class, 'pond_detail_id');
    }
}
