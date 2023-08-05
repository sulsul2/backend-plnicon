<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use HasFactory;

    protected $table = "port";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function perangkat(){
        return $this->belongsTo(DataPerangkat::class,'perangkat_id','id');
    }

}
