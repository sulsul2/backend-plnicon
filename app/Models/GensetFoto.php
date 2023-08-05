<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GensetFoto extends Model
{
    use HasFactory;

    protected $table = "genset_foto";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function gensetNilai() {
        return $this->belongsTo(GensetNilai::class,'genset_nilai_id','id');
    }
}
