<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class KwhFoto extends Model
{
    use HasFactory;

    protected $table = "kwh_foto";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function kwhnilai(){
        return $this->belongsTo(KwhMeterNilai::class,'kwh_nilai_id','id');
    }

    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
