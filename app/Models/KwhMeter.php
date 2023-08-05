<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KwhMeter extends Model
{
    use HasFactory;

    protected $table = "kwh_meter";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function datapop(){
        return $this->belongsTo(DataPop::class,'pop_id','id');
    }
}
