<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PdbFoto extends Model
{
    use HasFactory;

    protected $table = "pdb_foto";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function pdbNilai() {
        return $this->belongsTo(PdbNilai::class,'pdb_nilai_id','id');
    }

    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
