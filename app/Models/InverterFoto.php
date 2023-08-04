<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InverterFoto extends Model
{
    use HasFactory;

    protected $table = "inverter_foto";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function inverterNilai() {
        return $this->belongsTo(InverterNilai::class,'inventer_nilai_id','id');
    }
}
