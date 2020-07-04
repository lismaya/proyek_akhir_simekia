<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pasien extends Model
{
    //
    protected $table    = 'pasien';
    protected $fillable = [
    	'ortu_id',
        'nama',
        'jk',
        'tempat_lahir',
        'tgl_lahir'
    ];

    public function ortu(){
    	return $this->belongsTo('App\Ortu','ortu_id','id');
    }

    public function getUsiaAttribute(){
        //return $this->nama;
        $start = new Carbon($this->tgl_lahir);
        $end = Carbon::now();
        return $end->diffInMonths($start) . ' Bulan';
    }
}
