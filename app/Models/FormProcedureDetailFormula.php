<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormProcedureDetailFormula extends Model
{
    use HasFactory;
    protected $table = 'form_procedure_detail_formulas';
    protected $fillable = [
    'form_procedure_detail_id',
    'parameter',
    'score',
    ];

    public function form_procedure_detail()
    {
        return $this->belongsTo(FormProcedureDetail::class, 'form_procedure_detail_id');
    }
}