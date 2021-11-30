<?php

namespace App\Models;

use App\Services\NotificationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;
    protected $table = 'procedures';
    protected $fillable = [
        'title',
        'image',
        'is_procedure'
    ];

    protected $appends = [
        'image_url'
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($model)
        {
            NotificationService::sendToTopic('New procedure', 'New Procedure has been release', 'new-procedure', $model);
        });
    }

    public function getImageUrlAttribute()
    {
        return url('uploads/' . $this->image);
    }
    public function form_procedures()
    {
        return $this->hasMany(FormProcedure::class,'procedure_id');
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
