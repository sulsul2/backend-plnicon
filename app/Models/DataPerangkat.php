<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerangkat extends Model
{
    use HasFactory;

    protected $table = "data_perangkat";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function datarack(){
        return $this->belongsTo(DataRack::class,'rack_id','id');
    }
}
