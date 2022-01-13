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

    protected $appends = [
        'text'
    ];

    public function form_procedure_detail()
    {
        return $this->belongsTo(FormProcedureDetail::class, 'form_procedure_detail_id');
    }

    public function getTextAttribute()
    {
        return $this->parameter.' - '.$this->score;
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
