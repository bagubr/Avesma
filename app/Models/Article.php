<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    const TYPE_FILE     = 'FILE';
    const TYPE_VIDEO_EMBED    = 'VIDEO_EMBED';
    protected $table = 'articles';
    protected $fillable = [
        'title',
        'description',
        'article_category_id',
        'image',
    ];
    
    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return env('APP_URL').$this->image;
    }

    public function article_category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function getCategoryNameAttribute()
    {
        return $this->article_category()->first()->name;
    }

}
