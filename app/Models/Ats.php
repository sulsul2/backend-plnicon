<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ats extends Model
{
    use HasFactory;

    protected $table = "ats";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function dataPop() {
        return $this->belongsTo(DataPop::class,'pop_id','id');
    }
}
