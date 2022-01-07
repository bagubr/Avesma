<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPokdakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pokdakan_id'
    ];  

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pokdakan() {
        return $this->belongsTo(Pokdakan::class);
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
