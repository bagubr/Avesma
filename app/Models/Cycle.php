<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle extends Model
{
    use HasFactory, SoftDeletes;

    const ONGOING = 'Sedang Berlangsung';
    const FINISH = 'Selesai';

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
        return Carbon::createFromFormat('Y-m-d', $this->start_at)->diffForHumans();
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
