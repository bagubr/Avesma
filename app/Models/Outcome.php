<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;
    // ojo lali tambah pengeluaranne piro
    protected $table = 'outcomes';
    protected $fillable = [
        'pond_detail_id',
        'outcome_setting_id',
        'name',
        'total_price',
        'reported_at'
    ];

    public function pond_detail()
    {
        return $this->belongsTo(PondDetail::class, 'pond_detail_id');
    }

    public function outcome_setting()
    {
        return $this->belongsTo(OutcomeSetting::class, 'outcome_setting_id');
    }
}
