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
        'total_nominal',
        'reported_at'
    ];

    public function pond_detail()
    {
        return $this->belongsTo(PondDetail::class, 'pond_detail_id');
    }

    public function outcome_detail()
    {
        return $this->hasMany(OutcomeDetail::class, 'outcome_id', 'id');
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
