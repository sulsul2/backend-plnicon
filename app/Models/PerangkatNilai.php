<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatNilai extends Model
{
    use HasFactory;

    protected $table = "perangkat_nilai";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function jadwalpm(){
        return $this->belongsTo(JadwalPm::class,'pm_id','id');
    }

    public function dataperangkat(){
        return $this->belongsTo(DataPerangkat::class,'perangkat_id','id');
    }

    public function foto(){
        return $this->hasMany(PerangkatFoto::class,'perangkat_nilai_id','id');
    }
}
