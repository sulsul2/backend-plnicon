<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PerangkatFoto extends Model
{
    use HasFactory;

    protected $table = "perangkat_foto";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function rack(){
        return $this->belongsTo(DataRack::class,'rack_id','id');
    }

    public function perangkatnilai(){
        return $this->belongsTo(PerangkatNilai::class,'perangkat_nilai_id','id');
    }

    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
