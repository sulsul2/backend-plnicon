<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPm extends Model
{
    use HasFactory;

    protected $guard = [
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
}
