<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleProcedure extends Model
{
    use HasFactory;

    const TYPE_FILE     = 'FILE';
    const TYPE_VIDEO_EMBED    = 'VIDEO_EMBED';
    protected $table = 'article_procedures';
    protected $fillable = [
        'procedure_id',
        'title',
        'description',
        'image',
        'file',
        'type',
        'embed_link',
    ];

    protected $appends = [
        'type_name',
        'file_url',
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return url('uploads/' . $this->image);
    }
    public function getFileUrlAttribute()
    {
        return url('uploads/' . $this->file);
    }
    
    public function getListType()
    {
        return [
            self::TYPE_FILE => 'File',
            self::TYPE_VIDEO_EMBED => 'Video'
        ];
    }
    
    public function getTypeNameAttribute()
    {
        return $this->getListType()[$this->type];
    }

    public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
    }

    public function getProcedureNameAttribute()
    {
        return $this->procedure()->first()->title;
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
