<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
