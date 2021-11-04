<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormProcedureFormula extends Model
{
    use HasFactory;
    protected $table = 'procedure_formulas';
    protected $fillable = [
        'procedure_id',
        'note',
        'min_range',
        'max_range',
        'score',
    ];

    protected $appends = [
        'procedure_name'
    ];

    public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
    }

    public function getProcedureNameAttribute()
    {
        return $this->procedure()->first()->title;
    }

}
