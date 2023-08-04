<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temuan extends Model
{
    use HasFactory;

    protected $table = "temuan";
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

    public function jadwalPm()
    {
        return $this->belongsTo(JadwalPM::class, 'pm_id', 'id');
    }

    public function dataPop()
    {
        return $this->belongsTo(DataPop::class, 'pop_id', 'id');
    }
}
