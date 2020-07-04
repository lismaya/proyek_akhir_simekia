<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    protected $table    = 'pemeriksaan';
    protected $fillable = [
        'tgl',
        'pasien_id',
        'anamnesa',
        'diagnosa',
        'tindakan',
        'resep',
    ];
}
