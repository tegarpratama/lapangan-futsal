<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LapanganFutsal extends Model
{
    protected $guarded = [];
    protected $table = 'lapangan_futsal';
    public $timestamps = false;

    public function user()
    {
        return $this->hasMany(LokasiUser::class, 'lapangan_futsal_id', 'id');
    }
}
