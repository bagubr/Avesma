<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeDetail extends Model
{
    use HasFactory;
    protected $table = 'income_details';
    protected $fillable = [
        'income_id',
        'pond_detail_product_id',
        'weight',
        'price',
        'total_price',
    ];

    protected $appends = [
        'product_name'
    ];

    public function income()
    {
        return $this->belongsTo(Income::class, 'income_id');
    }
    
    public function pond_detail_products()
    {
        return $this->hasOne(PondDetailProduct::class, 'id', 'pond_detail_product_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return date("d-m-Y H:i:s", strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date("d-m-Y H:i:s", strtotime($value));
    }

    public function getProductNameAttribute()
    {
        return $this->pond_detail_products()->first()?->name??'';
    }
}
