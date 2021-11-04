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
        'name',
        'weight',
        'price',
        'total_price',
    ];

    public function income()
    {
        return $this->belongsTo(Income::class, 'income_id');
    }
}
