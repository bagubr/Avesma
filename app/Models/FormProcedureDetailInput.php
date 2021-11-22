<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormProcedureDetailInput extends Model
{
    use HasFactory;
    protected $table = 'form_procedure_detail_inputs';
    protected $fillable = [
        'form_procedure_detail_id',
        'form_procedure_detail_formula_id',
        'form_procedure_input_user_id',
        'score'
    ];

    public function form_procedure_detail()
    {
        return $this->belongsTo(FormProcedureDetail::class, 'form_procedure_detail_id');
    }
    public function form_procedure_detail_formula()
    {
        return $this->belongsTo(FormProcedureDetailFormula::class, 'form_procedure_detail_formula_id');
    }
}
