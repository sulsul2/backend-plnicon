<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ExAlarmFoto extends Model
{
    use HasFactory;

    protected $table = "ex_alarm_foto";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function exAlarm() {
        return $this->belongsTo(ExAlarm::class,'ex_alarm_id','id');
    }

    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
