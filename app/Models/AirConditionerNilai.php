<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirConditionerNilai extends Model
{
    use HasFactory;

    protected $table = "air_conditioner_nilai";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function jadwalPm() {
        return $this->belongsTo(JadwalPm::class,'pm_id','id');
    }

    public function airConditioner() {
        return $this->belongsTo(AirConditioner::class,'ac_id','id');
    }
}
