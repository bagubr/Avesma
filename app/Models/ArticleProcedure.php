<?php

namespace App\Models;

use App\Services\NotificationService;
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
        'fish_species_id',
        'title',
        'description',
        'image',
        'file',
        'type',
        'embed_link',
    ];

    protected $appends = [
        'type_name',
        'fish_species_name',
        'file_url',
        'image_url'
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($model)
        {
            try {
                NotificationService::sendToTopic('New article', 'New Article has been release', 'new-article', $model);
            } catch (\Throwable $th) {
                //throw $th;
            }
        });
    }

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

    public function fish_species()
    {
        return $this->belongsTo(FishSpecies::class, 'fish_species_id');
    }

    public function getProcedureNameAttribute()
    {
        return $this->procedure()->first()->title;
    }

    public function getFishSpeciesNameAttribute()
    {
        return $this->fish_species()?->name??'';
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
