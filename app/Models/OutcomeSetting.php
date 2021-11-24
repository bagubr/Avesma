<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutcomeSetting extends Model
{
    use HasFactory;
    protected $table = 'outcome_settings';
    protected $fillable = [
        'outcome_category_id',
        'name',
    ];

    protected $appends = [
        'outcome_category'
    ];

    public function getOutcomeCategoryAttribute()
    {
        return $this->outcome_category()->first()?->name;
    }

    public function outcome_category()
    {
        return $this->belongsTo(OutcomeCategory::class, 'outcome_category_id');
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
