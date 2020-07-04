<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antropometri extends Model
{
    protected $table    = 'antropometri';
    protected $fillable = [
        'tgl',
        'pasien_id',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'catatan'
    ];
}
