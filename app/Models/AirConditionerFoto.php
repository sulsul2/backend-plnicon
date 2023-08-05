<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
