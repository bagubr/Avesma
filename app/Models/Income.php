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

    public function pond_detail()
    {
        return $this->belongsTo(PondDetail::class, 'pond_detail_id');
    }

    public function income_detail()
    {
        return $this->hasMany(IncomeDetail::class, 'income_id', 'id');
    }
}
