<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Imunisasi extends Model
{
	//$end = Carbon::now();
	//
    protected $table    = 'imunisasi';
    protected $fillable = [
        'tgl',
        'pasien_id',
        'jenis_imunisasi_id',
        'keterangan',
        'resep',
        'catatan'
    ];
}
