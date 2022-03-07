<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $table = 'incomes';
    protected $fillable = [
        'pond_detail_id',
        'reported_at',
    ];

    protected $appends = [
        'pond_spesies',
        'total_price',
        'category_name'
    ];
    
    public function pond_detail()
    {
        return $this->belongsTo(PondDetail::class, 'pond_detail_id');
    }

    public function getPondSpesiesAttribute()
    {
        return $this->pond_detail()->first()?->pond_spesies??'';
    }

    public function getTotalPriceAttribute()
    {
        return $this->income_detail()->get()->sum('total_price');
    }
    
    public function income_detail()
    {
        return $this->hasMany(IncomeDetail::class, 'income_id', 'id');
    }

    public function getCreatedAtAttribute($value)
    {
        return date("d-m-Y H:i:s", strtotime($value));
    }

    public function getReportedAtAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date("d-m-Y H:i:s", strtotime($value));
    }

    public function getCategoryNameAttribute()
    {
        return 'INCOME';
    }

}
