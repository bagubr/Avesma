<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;
    protected $table = 'procedures';
    protected $fillable = [
        'title',
        'image' 
    ];

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return url('uploads/' . $this->image);
    }
    public function form_procedures()
    {
        return $this->hasMany(FormProcedure::class, 'procedure_id', 'id');
    }
}
