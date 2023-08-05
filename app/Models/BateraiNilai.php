<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BateraiNilai extends Model
{
    use HasFactory;

    protected $table = "baterai_nilai";
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

    public function baterai()
    {
        return $this->belongsTo(BateraiNilai::class, 'baterai_id', 'id');
    }

    public function jadwalPm()
    {
        return $this->belongsTo(JadwalPm::class, 'pm_id', 'id');
    }
}
