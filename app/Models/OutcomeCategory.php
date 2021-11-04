<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutcomeCategory extends Model
{
    use HasFactory;

    protected $table = 'outcome_categories';

    protected $fillable = [
        'name'
    ];
}
