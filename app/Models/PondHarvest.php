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
    protected $appends = [
        'image_url', 'region_name'
    ];

    public function getImageUrlAttribute()
    {
        return url('uploads/' . $this->image);
    }

    public function pond_detail()
    {
        return $this->belongsTo(PondDetail::class, 'pond_detail_id');
    }
    public function getRegionNameAttribute()
    {
        return $this->pond_detail->pond->user->region->name ?? "-";
    }
}
