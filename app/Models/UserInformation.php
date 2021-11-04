<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInformation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'user_informations';
    protected $fillable = [
        'user_id', 
        'nik', 
        'ktp_photo', 
        'ktp_selfie_photo'
    ];
}
