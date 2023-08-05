<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mcb extends Model
{
    use HasFactory;

    protected $table = "mcb";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function pdb(){
        return $this->belongsTo(Pdb::class,'pdb_id','id');
    }
}
