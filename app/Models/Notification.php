<?php

namespace App\Models;

use Encore\Admin\Form\Field\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    const BROADCAST = 'broadcast';
    const NEW_ARTICLE = 'new-article';
    const NEW_PROCEDURE = 'new-procedure';
    protected $fillable = [
        'user_id', 'title', 'body', 'payload', 'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getPayloadAttribute($value)
    {
        return json_decode($value);
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
