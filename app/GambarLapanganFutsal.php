<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GambarLapanganFutsal extends Model
{
    protected $guarded = [];
    protected $table = 'gambar_lapangan_futsal';
    public $timestamps = false;

    public function lapangan()
    {
        return $this->belongsTo(LapanganFutsal::class, 'lapangan_futsal_id', 'id');
    }
}
