<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = "pengguna";

    protected $fillable = [
        'username',
        'password',
        'nama',
        'telp',
        'email',
        'level',
    ];
}
