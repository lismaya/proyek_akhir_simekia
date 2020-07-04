<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntrianDokter extends Model
{
    protected $table    = 'antrian_dokter';
    protected $fillable = [
        'jenis',
        'tgl',
        'pasien_id',
        'status',
    ];
}
