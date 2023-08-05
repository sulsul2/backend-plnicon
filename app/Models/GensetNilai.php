<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GensetNilai extends Model
{
    use HasFactory;

    protected $table = "genset_nilai";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function jadwalPm() {
        return $this->belongsTo(JadwalPm::class,'pm_id','id');
    }

    public function genset() {
        return $this->belongsTo(Genset::class,'genset_id','id');
    }
}
