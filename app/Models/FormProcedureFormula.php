<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormProcedureFormula extends Model
{
    use HasFactory;
    protected $table = 'procedure_formulas';
    protected $fillable = [
        'form_procedure_id',
        'note',
        'min_range',
        'max_range',
    ];

    protected $appends = [
        'procedure_title',
        'fish_and_procedure'
    ];

    public function form_procedure()
    {
        return $this->belongsTo(FormProcedure::class, 'form_procedure_id');
    }

    public function getProcedureTitleAttribute()
    {
        return $this->form_procedure()?->first()?->procedure()?->first()?->title??'';
    }

    public function getFishAndProcedureAttribute()
    {
        return $this->form_procedure()?->first()?->fish_and_procedure??'';
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
