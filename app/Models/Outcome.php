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
        'reported_at'
    ];

    protected $appends = [
        'total_nominal',
        "outcome_category_id",
        "outcome_category_name",
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

    public function getTotalNominalAttribute()
    {
        return $this->outcome_detail()->get()?->sum('price') ?? 0;
    }
    public function getOutcomeCategoryIdAttribute()
    {
        return $this->outcome_detail[0]?->outcome_setting->outcome_category_id;
    }
    public function getOutcomeCategoryNameAttribute()
    {
        return $this->outcome_detail[0]?->outcome_setting->outcome_category;
    }
}
