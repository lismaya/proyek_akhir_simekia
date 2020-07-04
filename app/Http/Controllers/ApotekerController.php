<?php

namespace App\Http\Controllers;

use App\pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class ApotekerController extends Controller
{

    public function __construct()
    {

        $this->middleware('apoteker');
    }

    public function index()
    {
        return view('apoteker.index');
    }

    public function profile(Request $request)
    {
        switch ($request->method()) {
            case 'POST':

                $this->validate($request, [
                    'nama'  => 'required',
                    'telp'  => 'required',
                    'email' => 'email:rfc',

                ]);

                $pengguna        = Pengguna::find(Session::get('user_id'));
                $pengguna->nama  = $request->nama;
                $pengguna->telp  = $request->telp;
                $pengguna->email = $request->email;

                $pengguna->save();
                return redirect('/apoteker/profile')->with('alert-success', 'Profile berhasil disimpan');
                // return $redirect->to('/admin/profile')->with('alert-danger', 'Password atau Email salah !')->send();

                break;
            case 'GET':

                $pengguna = Pengguna::find(Session::get('user_id'));
                return view('apoteker.profile', ['pengguna' => $pengguna]);

                break;

            default:
                # code...
                break;
        }
    }

    public function antrianSetSelesai($antrian_id)
    {
        DB::table('antrian_obat')
            ->where('id', $antrian_id)
            ->update(['status' => 'selesai']);

        return redirect('/apoteker/antrian');
    }

    public function antrianAjax()
    {

        $antrian = DB::select(
            "SELECT a.id,
                    a.jenis,
                    a.pasien_id,
                    b.nama AS nama,
                    CONCAT(b.tgl_lahir,' ( ', TIMESTAMPDIFF(MONTH,b.tgl_lahir, NOW()),' Bulan )') AS tgl_lahir,
                    CONCAT(c.nama_ayah,'/',c.nama_ibu) AS ortu,
                    c.alamat
            FROM antrian_obat AS a
            LEFT JOIN pasien AS b ON a.pasien_id = b.id
            LEFT JOIN ortu AS c ON b.ortu_id = c.id
            WHERE DATE(a.tgl) = DATE(now()) AND a.status IN ('antri')
            HAVING a.id IS NOT NULL
            ORDER BY a.tgl ASC");

        $returnAjax = view('apoteker.antrian.listAjax', ['antrian' => $antrian])->render();
        return response()->json(array('success' => true, 'html' => $returnAjax));
    }

    public function antrian()
    {
        $antrian = DB::select(
            "SELECT a.id,
                    a.jenis,
                    a.pasien_id,
                    b.nama AS nama,
                    CONCAT(b.tgl_lahir,' ( ', TIMESTAMPDIFF(MONTH,b.tgl_lahir, NOW()),' Bulan )') AS tgl_lahir,
                    CONCAT(c.nama_ayah,'/',c.nama_ibu) AS ortu,
                    c.alamat
            FROM antrian_obat AS a
            LEFT JOIN pasien AS b ON a.pasien_id = b.id
            LEFT JOIN ortu AS c ON b.ortu_id = c.id
            WHERE DATE(a.tgl) = DATE(now()) AND a.status IN ('antri')
            HAVING a.id IS NOT NULL
            ORDER BY a.tgl ASC");

        return view('apoteker.antrian.list', ['antrian' => $antrian]);
    }

    public function resepDetail($pasien_id, $jenis)
    {

        if ($jenis === 'pemeriksaan') {
            $resep = DB::select("SELECT resep
                                 FROM pemeriksaan
                                 WHERE pasien_id = $pasien_id AND DATE(tgl) = DATE(NOW())
                                 ORDER BY tgl DESC
                                 LIMIT 1");
            return response()->json(array('success' => true, 'html' => '<pre>' . $resep[0]->resep . '</pre><a href="/apoteker/cetak-resep/' . $pasien_id . '/pemeriksaan"  class="btn btn-primary">Cetak</a>'));

        } else {
            $resep = DB::select("SELECT resep
                                 FROM imunisasi
                                 WHERE pasien_id = $pasien_id AND DATE(tgl) = DATE(NOW())
                                 ORDER BY tgl DESC
                                 LIMIT 1");
            return response()->json(array('success' => true, 'html' => '<pre>' . $resep[0]->resep . '</pre><a href="#" class="btn btn-primary">Cetak</a>'));

        }

    }

    public function cetakResep($pasien_id, $jenis)
    {

        if ($jenis === 'pemeriksaan') {
            $resep = DB::select("SELECT a.resep,
                                        DATE_FORMAT(now(),'%d/%m/%Y') AS tanggal,
                                        b.nama AS nama,
                                        TIMESTAMPDIFF(MONTH,b.tgl_lahir, NOW()) AS usia
                                 FROM pemeriksaan a
                                 LEFT JOIN pasien b ON a.pasien_id = b.id
                                 WHERE a.pasien_id = $pasien_id AND DATE(tgl) = DATE(NOW())
                                 ORDER BY tgl DESC
                                 LIMIT 1");
            // return response()->json(array('success' => true, 'html' => '<pre>' . $resep[0]->resep . '</pre>'));

            $pdf = PDF::loadView('apoteker.cetakResep', ['resep' => $resep[0]])->setPaper('A5', 'potrait');
            return $pdf->stream('resep.pdf');

        } else {
            $resep = DB::select("SELECT resep
                                 FROM imunisasi
                                 WHERE pasien_id = $pasien_id AND DATE(tgl) = DATE(NOW())
                                 ORDER BY tgl DESC
                                 LIMIT 1");
            // return response()->json(array('success' => true, 'html' => '<pre>' . $resep[0]->resep . '</pre>'));
            $pdf = PDF::loadView('apoteker.cetakResep', ['resep' => $resep[0]->resep])->setPaper('A5', 'potrait');
            return $pdf->stream('resep.pdf');
        }
    }
}
