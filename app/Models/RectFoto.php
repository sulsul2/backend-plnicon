<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RectFoto extends Model
{
    use HasFactory;

    protected $table = "rect_foto";
    /**
     * The attributes that are not assignable.
     *
     * @var string[]
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function rect()
    {
        return $this->belongsTo(RectNilai::class, 'rect_nilai_id', 'id');
    }

    public function getUrlAttribute($url)
    {
        return config('app.url') . Storage::url($url);
    }
}
