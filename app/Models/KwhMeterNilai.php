<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KwhMeterNilai extends Model
{
    use HasFactory;

    protected $table = "kwh_meter_nilai";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function kwhmeter(){
        return $this->belongsTo(KwhMeter::class,'kwh_id','id');
    }

    public function jadwalpm(){
        return $this->belongsTo(JadwalPm::class,'pm_id','id');
    }
}
