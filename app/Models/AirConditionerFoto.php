<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AirConditionerFoto extends Model
{
    use HasFactory;

    protected $table = "air_conditioner_foto";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function airConditionerNilai() {
        return $this->belongsTo(AirConditionerNilai::class,'ac_nilai_id','id');
    }

    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
