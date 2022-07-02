<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiUser extends Model
{
    protected $guarded = [];
    protected $table = 'lokasi_user';
    public $timestamps = false;

    public function futsal()
    {
        return $this->belongsTo(LapanganFutsal::class, 'lapangan_futsal_id', 'id');
    }
}
