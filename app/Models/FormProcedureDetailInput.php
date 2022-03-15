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

    

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model)
        {
            $model->score = FormProcedureDetailFormula::find($model->form_procedure_detail_formula_id)?->score??'SCORE TIDAK DITEMUKAN';
        });
    }

    public function form_procedure_detail()
    {
        return $this->belongsTo(FormProcedureDetail::class, 'form_procedure_detail_id');
    }
    public function form_procedure_detail_formula()
    {
        return $this->belongsTo(FormProcedureDetailFormula::class, 'form_procedure_detail_formula_id');
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
