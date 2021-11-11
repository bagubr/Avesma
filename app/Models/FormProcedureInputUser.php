<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormProcedureInputUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'pond_detail_id', 'reported_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pond_detail()
    {
        return $this->hasOne(PondDetail::class, 'pond_detail_id');
    }

    public function form_procedure_input_user()
    {
        return $this->hasMany(FormProcedureInputUser::class, 'form_procedure_input_user_id', 'id');
    }
}
