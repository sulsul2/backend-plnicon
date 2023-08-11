<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RectNilai extends Model
{
    use HasFactory;

    protected $table = "rect_nilai";
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
        return $this->belongsTo(Rect::class, 'rect_id', 'id');
    }

    public function jadwalPm()
    {
        return $this->belongsTo(JadwalPm::class, 'pm_id', 'id');
    }

    public function foto(){
        return $this->hasMany(RectFoto::class,'rect_nilai_id','id');
    }
}
