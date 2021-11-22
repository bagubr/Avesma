<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormProcedureDetail extends Model
{
    use HasFactory;

    protected $table = 'form_procedure_details';
    protected $fillable = [
        'name',
        'form_procedure_id'
    ];

    protected $appends = [
        'fish_and_procedure'
    ];

    public function form_procedure()
    {
        return $this->belongsTo(FormProcedure::class, 'form_procedure_id');
    }

    public function getFishAndProcedureAttribute()
    {
        return $this->form_procedure()->first()?->fish_and_procedure;
    }

    public function form_procedure_detail_formulas()
    {
        return $this->hasMany(FormProcedureDetailFormula::class, 'form_procedure_detail_id', 'id');
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
