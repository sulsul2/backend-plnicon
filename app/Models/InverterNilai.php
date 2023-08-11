<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InverterNilai extends Model
{
    use HasFactory;

    protected $table = "inverter_nilai";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function jadwalPm() {
        return $this->belongsTo(JadwalPm::class,'pm_id','id');
    }

    public function inverter() {
        return $this->belongsTo(Inverter::class,'inverter_id','id');
    }

    public function foto(){
        return $this->hasMany(InverterFoto::class,'inverter_nilai_id','id');
    }
}
