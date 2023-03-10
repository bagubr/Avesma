<?php

namespace App\Models;

use App\Services\NotificationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Article extends Model
{
    use HasFactory;
    const TYPE_FILE             = 'FILE';
    const TYPE_VIDEO_EMBED      = 'VIDEO_EMBED';
    protected $table = 'articles';
    protected $fillable = [
        'title',
        'description',
        'article_category_id',
        'type',
        'image',
        'file',
        'embed_link',
    ];

    protected $appends = [
        'image_url',
        'embed_link_website',
        'category_name'
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($model)
        {
            try {
                NotificationService::sendToTopic('New article', 'New Article has been release', 'new-article', $model->only('id', 'title'));
            } catch (\Throwable $th) {
                //throw $th;
            }
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

    public function article_category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function getEmbedLinkWebsiteAttribute()
    {
        $embed_link = $this->embed_link;
        return $embed_link;
    }

    public function getCategoryNameAttribute()
    {
        return $this->article_category()->first()?->name ?? "";
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
