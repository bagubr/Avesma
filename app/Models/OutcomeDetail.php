<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutcomeDetail extends Model
{
    use HasFactory;

    protected $fillaable = [
        'outcome_id',
        'outcome_setting_id',
        'nominal'
    ];
}
