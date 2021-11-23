<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'category_name'
    ];

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

    public function getCategoryNameAttribute()
    {
        return $this->article_category()->first()->name;
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
