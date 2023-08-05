<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = "notifikasi";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
