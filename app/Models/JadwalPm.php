<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPm extends Model
{
    use HasFactory;

    protected $table = "jadwal_pm";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function datapop(){
        return $this->belongsTo(DataPop::class,'pop_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function genset(){
        return $this->hasMany(GensetNilai::class,'pm_id','id');
    }
    public function inverter(){
        return $this->hasMany(InverterNilai::class,'pm_id','id');
    }
    public function kwh(){
        return $this->hasMany(KwhMeterNilai::class,'pm_id','id');
    }
    public function environment(){
        return $this->hasMany(Environment::class,'pm_id','id');
    }
    public function ex_alarm(){
        return $this->hasMany(ExAlarm::class,'pm_id','id');
    }
    public function pdb(){
        return $this->hasMany(PdbNilai::class,'pm_id','id');
    }
    public function ac(){
        return $this->hasMany(AirConditionerNilai::class,'pm_id','id');
    }
    public function rect(){
        return $this->hasMany(RectNilai::class,'pm_id','id');
    }
    public function perangkat(){
        return $this->hasMany(PerangkatNilai::class,'pm_id','id');
    }
    public function baterai(){
        return $this->hasMany(BateraiNilai::class,'pm_id','id');
    }
    
}
