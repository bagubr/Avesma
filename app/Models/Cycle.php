<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle extends Model
{
    use HasFactory, SoftDeletes;

    const ONGOING = 'ONGOING';
    const FINISH = 'FINISH';

    protected $fillable = [
        'user_id',
        'name',
        'start_at',
        'status'
    ];

    protected $appends = [
        'start_at_for_humman'
    ];

    public function ponds()
    {
        return $this->hasMany(Pond::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id',  'id');
    }

    public function getStartAtForHummanAttribute()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        $hours = date("H", strtotime($this->created_at));
        $minute = date("i", strtotime($this->created_at));
        $second = date("s", strtotime($this->created_at));

        return Carbon::createFromFormat('Y-m-d', $this->start_at)->setTime($hours, $minute, $second)->diffForHumans();
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
