<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    protected $table    = 'ortu';
    protected $fillable = [
        'username',
        'password',
        'nama_ayah',
        'nama_ibu',
        'alamat',
        'telp',
        'email',
    ];

    public function pasien(){
    	return $this->hasMany('App\Pasien','ortu_id','id');
    }
}
