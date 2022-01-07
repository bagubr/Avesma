<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutcomeDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'outcome_id',
        'outcome_setting_id',
        'price'
    ];

    protected $appends = [
        'outcome_name'
    ];

    public function outcome_setting()
    {
        return $this->belongsTo(OutcomeSetting::class, 'outcome_setting_id');
    }

    public function getOutcomeNameAttribute()
    {
        return $this->outcome_setting()->first()?->name ?? "";
    }

    public function outcome()
    {
        return $this->belongsTo(Outcome::class, 'outcome_id');
    }
}
