<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormProcedureInputUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pond_detail_id', 'reported_at', 'form_procedure_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pond_detail()
    {
        return $this->belongsTo(PondDetail::class, 'pond_detail_id');
    }
    public function form_procedure()
    {
        return $this->belongsTo(FormProcedure::class, 'form_procedure_id');
    }

    public function form_procedure_detail_input()
    {
        return $this->hasMany(FormProcedureDetailInput::class, 'form_procedure_input_user_id', 'id');
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
