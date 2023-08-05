<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdbNilai extends Model
{
    use HasFactory;

    protected $table = "pdb_nilai";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function jadwalpm(){
        return $this->belongsTo(JadwalPm::class,'pm_id','id');
    }

    public function pdb(){
        return $this->belongsTo(Pdb::class,'pdb_id','id');
    }
}
