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

    public function outcome_setting()
    {
        return $this->belongsTo(OutcomeSetting::class, 'outcome_setting_id');
    }

    public function outcome()
    {
        return $this->belongsTo(Outcome::class, 'outcome_id');
    }
}
