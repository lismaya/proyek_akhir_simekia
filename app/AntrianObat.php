<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntrianObat extends Model
{
    protected $table    = 'antrian_obat';
    protected $fillable = [
        'jenis',
        'tgl',
        'pasien_id',
        'status',
    ];
}
