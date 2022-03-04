<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'start_at'
    ];

    public function pond()
    {
        return $this->hasMany(Pond::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id',  'id');
    }

}
