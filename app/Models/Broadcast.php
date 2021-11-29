<?php

namespace App\Models;

use App\Services\NotificationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model)
        {
            NotificationService::sendToTopic($model->title, $model->body, 'broadcast');
        });
    }
}
