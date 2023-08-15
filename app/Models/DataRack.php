<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRack extends Model
{
    use HasFactory;

    protected $table = "data_rack";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function datapop(){
        return $this->belongsTo(DataPop::class,'pop_id','id');
    }
    public function perangkat(){
        return $this->hasMany(DataPerangkat::class,'rack_id','id');
    }
}
