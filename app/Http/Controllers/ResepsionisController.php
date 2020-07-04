<?php

namespace App\Http\Controllers;

use App\AntrianDokter;
use App\antropometri;
use App\ortu;
use App\pasien;
use App\pengguna;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ResepsionisController extends Controller
{

    public function __construct()
    {

        $this->middleware('resepsionis');
    }

    public function index()
    {
        return view('resepsionis.index');
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
                return redirect('/resepsionis/profile')->with('alert-success', 'Profile berhasil disimpan');
                // return $redirect->to('/admin/profile')->with('alert-danger', 'Password atau Email salah !')->send();

                break;
            case 'GET':

                $pengguna = Pengguna::find(Session::get('user_id'));
                return view('resepsionis.profile', ['pengguna' => $pengguna]);

                break;

            default:
                # code...
                break;
        }
    }

    public function antrianSetDiperiksa($antrian_id)
    {
        DB::table('antrian_dokter')
            ->where('id', $antrian_id)
            ->update(['status' => 'diperiksa']);

        return redirect('/resepsionis/antrian');
    }

    public function dataPasienJson()
    {
        return DataTables::of(Pasien::all())->make(true);
    }

    public function antrianTambahData($pasien_id, $jenis)
    {
        AntrianDokter::create([
            'jenis'     => ($jenis === '000' ? 'pemeriksaan' : 'imunisasi'),
            'tgl'       => Carbon::now(),
            'pasien_id' => $pasien_id,
            'status'    => 'antri',

        ]);
        return redirect('/resepsionis/antrian');
    }

    public function antrianAjax()
    {

        // $antrian = DB::table('antrian_dokter AS a')
        //     ->select(DB::raw("a.id,
        //                       a.pasien_id,
        //                       b.nama AS nama,
        //                       CONCAT(b.tgl_lahir,' ( ',timestampdiff(MONTH,b.tgl_lahir,now()),' Bulan )') AS tgl_lahir,
        //                       CONCAT(c.nama_ayah,'/',c.nama_ibu) AS ortu,
        //                       c.alamat,
        //                       COUNT(d.id) AS pemeriksaan_antropometri,
        //                       a.jenis,a.status"))
        //     ->leftjoin('pasien AS b', 'a.pasien_id', '=', 'b.id')
        //     ->leftjoin('ortu AS c', 'b.ortu_id', '=', 'c.id')
        //     ->leftjoin('antropometri AS d','b.id','=',DB::raw('d.pasien_id AND DATE(d.tgl) = DATE(a.tgl)'))
        //     ->whereRaw("DATE(a.tgl) = '" . date('Y-m-d') . "' AND a.status NOT IN ('lewati','selesai')")
        //     ->orderBy('a.tgl', 'ASC')
        //     ->get();
        //
        $antrian = DB::select(
            "SELECT a.id,
                  a.pasien_id,
                  b.nama AS nama,
                  CONCAT(b.tgl_lahir,' ( ', TIMESTAMPDIFF(MONTH,b.tgl_lahir, NOW()),' Bulan )') AS tgl_lahir,
                  CONCAT(c.nama_ayah,'/',c.nama_ibu) AS ortu,
                  c.alamat,
                  COUNT(d.id) AS pemeriksaan_antropometri,
                  a.jenis,
                  a.status
            FROM antrian_dokter AS a
            LEFT JOIN pasien AS b ON a.pasien_id = b.id
            LEFT JOIN ortu AS c ON b.ortu_id = c.id
            LEFT JOIN antropometri AS d ON b.id = d.pasien_id AND DATE(d.tgl) = DATE(a.tgl)
            WHERE DATE(a.tgl) = DATE(now()) AND a.status NOT IN ('lewati','selesai')
            GROUP BY a.id
            HAVING a.id IS NOT NULL
            ORDER BY a.tgl ASC");

        $returnAjax = view('resepsionis.antrian.listAjax', ['antrian' => $antrian])->render();
        return response()->json(array('success' => true, 'html' => $returnAjax));
    }

    public function antrian()
    {
        $antrian = DB::select(
            "SELECT a.id,
                  a.pasien_id,
                  b.nama AS nama,
                  CONCAT(b.tgl_lahir,' ( ', TIMESTAMPDIFF(MONTH,b.tgl_lahir, NOW()),' Bulan )') AS tgl_lahir,
                  CONCAT(c.nama_ayah,'/',c.nama_ibu) AS ortu,
                  c.alamat,
                  COUNT(d.id) AS pemeriksaan_antropometri,
                  a.jenis,
                  a.status
            FROM antrian_dokter AS a
            LEFT JOIN pasien AS b ON a.pasien_id = b.id
            LEFT JOIN ortu AS c ON b.ortu_id = c.id
            LEFT JOIN antropometri AS d ON b.id = d.pasien_id AND DATE(d.tgl) = DATE(a.tgl)
            WHERE DATE(a.tgl) = DATE(now()) AND a.status NOT IN ('lewati','selesai')
            GROUP BY a.id
            HAVING a.id IS NOT NULL
            ORDER BY a.tgl ASC");

        return view('resepsionis.antrian.list', ['antrian' => $antrian]);
    }

    public function pasien($ortu_id)
    {
        $pasien = Pasien::all();
        return view('resepsionis.pasien.list',
            [
                'ortu_id' => $ortu_id,
                'pasien'  => $pasien,
            ]
        );
    }

    public function simpanAntropometri(Request $request)
    {
        Antropometri::create([
            'tgl'            => Carbon::now(),
            'pasien_id'      => $request->pasien_id,
            'berat_badan'    => $request->berat_badan,
            'tinggi_badan'   => $request->tinggi_badan,
            'lingkar_kepala' => $request->lingkar_kepala,
        ]);

        return redirect('/resepsionis/antrian');

    }

    public function pasienTambah($ortu_id, Request $request)
    {

        switch ($request->method()) {
            case 'POST':

                $this->validate($request, [
                    'nama'         => 'required',
                    'jk'           => 'required',
                    'tempat_lahir' => 'required',
                    'tgl_lahir'    => 'required',
                ]);

                Pasien::create([
                    'ortu_id'      => $ortu_id,
                    'nama'         => $request->nama,
                    'jk'           => $request->jk,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tgl_lahir'    => $request->tgl_lahir,
                ]);

                return redirect('/resepsionis/pasien/' . $ortu_id);

                break;
            case 'GET':

                return view('resepsionis.pasien.tambah', ['ortu_id' => $ortu_id]);

                break;

            default:
                # code...
                break;
        }

    }

    public function pasienHapus($ortu_id, $id)
    {
        $pasien = Pasien::find($id);
        $pasien->delete();
        return redirect('/resepsionis/pasien/' . $ortu_id);
    }

    public function pasienEdit($ortu_id, $id, Request $request)
    {
        switch ($request->method()) {
            case 'POST':

                $this->validate($request, [
                    'nama'         => 'required',
                    'jk'           => 'required',
                    'tempat_lahir' => 'required',
                    'tgl_lahir'    => 'required',
                ]);

                $pasien               = Pasien::find($id);
                $pasien->nama         = $request->nama;
                $pasien->jk           = $request->jk;
                $pasien->tempat_lahir = $request->tempat_lahir;
                $pasien->tgl_lahir    = $request->tgl_lahir;

                $pasien->save();
                return redirect('/resepsionis/pasien/' . $ortu_id);

                break;
            case 'GET':

                $pasien = Pasien::find($id);
                return view('resepsionis.pasien.edit', ['pasien' => $pasien, 'pasien_id' => $id, 'ortu_id' => $ortu_id]);

                break;

            default:
                # code...
                break;
        }
    }

    ######

    public function ortu()
    {
        $ortu = Ortu::all();
        return view('resepsionis.ortu.list', ['ortu' => $ortu]);
    }

    public function ortuHapus($id)
    {
        $ortu = Ortu::find($id);
        $ortu->delete();
        return redirect('/resepsionis/ortu');
    }

    public function ortuEdit($id, Request $request)
    {
        switch ($request->method()) {
            case 'POST':

                $this->validate($request, [
                    'nama_ayah' => 'required',
                    'nama_ibu'  => 'required',
                    'alamat'    => 'required',
                    'email'     => 'email:rfc,dns',
                ]);

                $ortu            = Ortu::find($id);
                $ortu->nama_ayah = $request->nama_ayah;
                $ortu->nama_ibu  = $request->nama_ibu;
                $ortu->alamat    = $request->alamat;
                $ortu->telp      = $request->telp;
                $ortu->email     = $request->email;

                $ortu->save();
                return redirect('/resepsionis/ortu');

                break;
            case 'GET':

                $ortu = Ortu::find($id);
                return view('resepsionis.ortu.edit', ['ortu' => $ortu]);

                break;

            default:
                # code...
                break;
        }
    }

    public function ortuTambah(Request $request)
    {

        switch ($request->method()) {
            case 'POST':

                $this->validate($request, [
                    'username'  => 'required',
                    'password'  => 'required',
                    'nama_ayah' => 'required',
                    'nama_ibu'  => 'required',
                    'alamat'    => 'required',
                    'email'     => 'email:rfc,dns',
                ]);

                Ortu::create([
                    'username'  => $request->username,
                    'password'  => md5($request->password),
                    'nama_ayah' => $request->nama_ayah,
                    'nama_ibu'  => $request->nama_ibu,
                    'alamat'    => $request->alamat,
                    'telp'      => $request->telp,
                    'email'     => $request->email,
                ]);

                return redirect('/resepsionis/ortu');

                break;
            case 'GET':

                return view('resepsionis.ortu.tambah');

                break;

            default:
                # code...
                break;
        }

    }
}
