<?php

namespace App\Http\Controllers;

use App\ortu;
use App\pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function login(Request $request)
    {

        header('content-type: application/json');

        $username = $request->username;
        $password = $request->password;

        $user = Ortu::where('username', $username)
            ->where('password', md5($password))
            ->first();

        $response["error"]                = false;
        $response["user"]["id"]           = $user->id;
        $response["user"]["username"]     = $user->username;
        $response["user"]["nama_lengkap"] = $user->nama_ibu . '-' . $user->nama_ayah;
        $response["user"]["email"]        = $user->email;
        
        echo json_encode($response);

    }

    public function getAnak(Request $request){
         
         $ortu_id = $request->ortu_id;
         $pasien = DB::select(
            "SELECT a.id,                    
                    a.nama AS nama,
                    CONCAT(a.tgl_lahir,' ( ', TIMESTAMPDIFF(MONTH,a.tgl_lahir, NOW()),' Bulan )') AS tgl_lahir,
                    CONCAT(b.nama_ayah,' - ',b.nama_ibu) AS ortu,
                    a.jk,
                    b.alamat
            FROM pasien AS a 
            LEFT JOIN ortu AS b ON a.ortu_id = b.id            
            WHERE a.ortu_id = $ortu_id
            ORDER BY a.nama ASC");

         echo json_encode(
            array(
                'error'    => false,
                'message'  => 'Data berhasil diambil',
                'anakList' => $pasien,
            )
        );
    }


    public function getRiwayatImunisasi(Request $request){
         
         $pasien_id = $request->pasien_id;
         $riwayatImunisasiList = DB::select(
            "SELECT a.id,                    
                    a.tgl,
                    b.nama AS jenis
             FROM imunisasi a
             LEFT JOIN jenis_imunisasi b ON a.jenis_imunisasi_id = b.id
             WHERE a.pasien_id = $pasien_id");

         echo json_encode(
            array(
                'error'    => false,
                'message'  => 'Data berhasil diambil',
                'riwayatImunisasiList' => $riwayatImunisasiList,
            )
        );
    }


     public function getRiwayatPemeriksaan(Request $request){
         
         $pasien_id = $request->pasien_id;
         $riwayatList = DB::select(
            "SELECT a.id,                    
                    a.tgl,
                    'Pemeriksaan' AS jenis
             FROM pemeriksaan a             
             WHERE a.pasien_id = $pasien_id");

         echo json_encode(
            array(
                'error'    => false,
                'message'  => 'Data berhasil diambil',
                'riwayatPemeriksaanList' => $riwayatList,
            )
        );
    }

}
