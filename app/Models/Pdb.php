<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdb extends Model
{
    use HasFactory;

    protected $table = "pdb";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function dataPop()
    {
        return $this->belongsTo(DataPop::class, 'pop_id', 'id');
    }
    public function mcb()
    {
        return $this->hasMany(Mcb::class, 'pdb_id', 'id');
    }
}
