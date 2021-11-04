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

    public function outcome_category()
    {
        return $this->belongsTo(OutcomeCategory::class, 'outcome_category_id');
    }
}
