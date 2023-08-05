<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirConditioner extends Model
{
    use HasFactory;

    protected $table = "air_conditioner";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function dataPop() {
        return $this->belongsTo(DataPop::class,'pop_id','id');
    }
}
