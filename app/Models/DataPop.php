<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPop extends Model
{
    use HasFactory;

    protected $table = "data_pop";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function pm(){
        return $this->hasMany(JadwalPm::class,'pop_id','id');
    }
    public function genset(){
        return $this->hasMany(Genset::class,'pop_id','id');
    }
    public function inverter(){
        return $this->hasMany(Inverter::class,'pop_id','id');
    }
    public function kwh(){
        return $this->hasMany(KwhMeter::class,'pop_id','id');
    }
    public function environment(){
        return $this->hasMany(Environment::class,'pop_id','id');
    }
    public function ex_alarm(){
        return $this->hasMany(ExAlarm::class,'pop_id','id');
    }
    public function pdb(){
        return $this->hasMany(Pdb::class,'pop_id','id');
    }
    public function ac(){
        return $this->hasMany(AirConditioner::class,'pop_id','id');
    }
    public function rect(){
        return $this->hasMany(Rect::class,'pop_id','id');
    }
    public function rack(){
        return $this->hasMany(DataRack::class,'pop_id','id');
    }
}
