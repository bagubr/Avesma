<?php

namespace App\Models;

use App\Services\NotificationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleRecipe extends Model
{
    use HasFactory;
    const TYPE_VIDEO_EMBED = 'VIDEO_EMBED';
    const TYPE_FILE = 'FILE';
    protected $table = 'article_recipes';
    protected $fillable = [
        'title',
        'description',
        'image',
        'type',
        'file',
        'embed_link'
    ];

    protected $appends = [
        'image_url'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model)
        {
            NotificationService::sendToTopic('New article', 'New Article has been release', 'new-article', $model);
        });
    }

    public function getFileAttribute($value)
    {
        if ($value) {
            return url('uploads/' . $value);
        }
    }
    public function getImageUrlAttribute()
    {
        return url('uploads/' . $this->image);
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
