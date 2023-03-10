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
        'cycle_id',
        'reported_at',
        'outcome_category_id'
    ];

    protected $appends = [
        'total_nominal',
        "outcome_category_name",
        "category_name",
    ];

    public function cycle()
    {
        return $this->belongsTo(Cycle::class, 'cycle_id');
    }

    public function outcome_category()
    {
        return $this->belongsTo(OutcomeCategory::class, 'outcome_category_id');
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

    public function getOutcomeCategoryNameAttribute()
    {
        return $this->outcome_category?->name??'';
    }

    public function getCategoryNameAttribute()
    {
        return 'OUTCOME';
    }
}
