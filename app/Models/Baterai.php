<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baterai extends Model
{
    use HasFactory;

    protected $table = "baterai";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function rect(){
        return $this->belongsTo(Rect::class,'rect_id','id');
    }
}
