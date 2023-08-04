<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvironmentFoto extends Model
{
    use HasFactory;

    protected $table = "environment_foto";

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function environment() {
        return $this->belongsTo(Environment::class,'env_id','id');
    }
}
