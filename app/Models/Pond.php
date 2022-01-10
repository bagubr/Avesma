<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pond extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ponds';

    const STATUS1 = "HATCHERY";
    const STATUS2 = "HARVEST";
    const STATUS3 = "IS_CLOSE";

    protected $fillable = [
        'user_id',
        'name',
        'area',
        'status',
        'latitude',
        'longitude',
        'address',
    ];
    protected $appends = [
        'region_name', 
    ];

    public function pond_detail()
    {
        return $this->hasOne(PondDetail::class, 'pond_id', 'id');
    }

    public function pond_harvest()
    {
        return $this->hasManyThrough(PondHarvest::class, PondDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRegionNameAttribute()
    {
        return $this->user->region->name ?? "";
    }
    public function getCreatedAtAttribute($value)
    {
        return date("d-m-Y H:i:s", strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date("d-m-Y H:i:s", strtotime($value));
    }

    function convertStringOutcome(array $data)
    {
        $texts = '';
        foreach($data as $each){
            $textr = '';
            foreach($each as $key => $value){
                $textr .= "$value : ";
            }
            $textr = rtrim($textr, " : ");
            $texts .= "$textr<br/>";
        }
        return $texts;
    }

    function convertStringIncome(array $data)
    {
        $textr = '';
        foreach($data as $each){
            $textr = '';
            foreach($each as $key => $value){
                $title = ucwords(str_replace('_', ' ', $key));
                $textr .= "$title : $value ";
                $textr .= "<br/>";
            }
        }
        return $textr;
    }
}
