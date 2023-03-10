<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormProcedure extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'form_procedures';
    protected $fillable = [
        'procedure_id',
        'fish_species_id'
    ];

    protected $appends = [
        'procedure_name',
        'fish_species_name',
        'fish_and_procedure'
    ];

    public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
    }

    public function getProcedureNameAttribute()
    {
        return $this->procedure()->first()->title;
    }

    public function fish_species()
    {
        return $this->belongsTo(FishSpecies::class, 'fish_species_id');
    }
    public function form_procedure_input_users()
    {
        return $this->hasMany(FormProcedureInputUser::class, 'form_procedure_id');
    }

    public function getFishSpeciesNameAttribute()
    {
        return $this->fish_species()?->first()?->name??'';
    }

    public function getFishAndProcedureAttribute()
    {
        return $this->procedure()?->first()?->title??'' . ' - ' . $this->fish_species()?->first()?->name??'';
    }

    public function form_procedure_detail()
    {
        return $this->hasMany(FormProcedureDetail::class, 'form_procedure_id', 'id');
    }

    public function form_procedure_formula()
    {
        return $this->hasMany(FormProcedureFormula::class, 'form_procedure_id', 'id');
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
