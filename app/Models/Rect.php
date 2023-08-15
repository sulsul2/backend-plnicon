<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rect extends Model
{
    use HasFactory;
    
    protected $table = "rect";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function datapop(){
        return $this->belongsTo(DataPop::class,'pop_id','id');
    }
    public function baterai(){
        return $this->hasMany(Baterai::class,'rect_id','id');
    }
    public function modul(){
        return $this->hasMany(Modul::class,'rect_id','id');
    }
}
