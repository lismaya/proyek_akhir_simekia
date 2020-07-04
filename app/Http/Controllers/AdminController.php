<?php

namespace App\Http\Controllers;

use App\pengguna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function __construct()
    {

        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function pengguna()
    {
        $pengguna = Pengguna::all();
        return view('admin.pengguna.list', ['pengguna' => $pengguna]);
    }

    public function penggunaHapus($id)
    {
        $pengguna = Pengguna::find($id);
        $pengguna->delete();
        return redirect('/admin/pengguna');
    }

    public function laporanBulanan(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                $tahun = $request->tahun;
                break;
            case 'GET':

                $now = Carbon::now();                
                $tahun = $now->year;

                $data = DB::select("
                    SELECT a.kode,
                           a.nama,
                             IFNULL(b.jml,0) AS jml_imunisasi,
                             IFNULL(c.jml,0) AS jml_pemeriksaan
                    FROM bulan a
                    LEFT JOIN (SELECT COUNT(id) AS jml,tgl 
                               FROM imunisasi 
                               WHERE YEAR(tgl) = '$tahun'
                                  GROUP BY MONTH(tgl)) b ON a.kode = MONTH(b.tgl)
                    LEFT JOIN (SELECT COUNT(id) AS jml,tgl 
                               FROM pemeriksaan 
                               WHERE YEAR(tgl) = '$tahun'
                                  GROUP BY MONTH(tgl)) c ON a.kode = MONTH(c.tgl)
                    GROUP BY a.kode");
                
                return view('admin.laporan_bulanan', ['pengguna' => $pengguna]);

                break;

            default:
                # code...
                break;
        }
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
                return redirect('/admin/profile')->with('alert-success', 'Profile berhasil disimpan');
                // return $redirect->to('/admin/profile')->with('alert-danger', 'Password atau Email salah !')->send();

                break;
            case 'GET':

                $pengguna = Pengguna::find(Session::get('user_id'));
                return view('admin.profile', ['pengguna' => $pengguna]);

                break;

            default:
                # code...
                break;
        }
    }

    public function penggunaEdit($id, Request $request)
    {
        switch ($request->method()) {
            case 'POST':

                $this->validate($request, [
                    'nama'  => 'required',
                    'telp'  => 'required',
                    'email' => 'email:rfc',
                    'level' => 'required',
                ]);

                $pengguna        = Pengguna::find($id);
                $pengguna->nama  = $request->nama;
                $pengguna->telp  = $request->telp;
                $pengguna->email = $request->email;
                $pengguna->level = $request->level;

                $pengguna->save();
                return redirect('/admin/pengguna');

                break;
            case 'GET':

                $pengguna = Pengguna::find($id);
                return view('admin.pengguna.edit', ['pengguna' => $pengguna]);

                break;

            default:
                # code...
                break;
        }
    }

    public function penggunaTambah(Request $request)
    {

        switch ($request->method()) {
            case 'POST':

                $this->validate($request, [
                    'username' => 'required',
                    'password' => 'required',
                    'nama'     => 'required',
                    'telp'     => 'required',
                    'email'    => 'email:rfc',
                    'level'    => 'required',
                ]);

                Pengguna::create([
                    'username' => $request->username,
                    'password' => md5($request->password),
                    'nama'     => $request->nama,
                    'telp'     => $request->telp,
                    'email'    => $request->email,
                    'level'    => $request->level,

                ]);

                return redirect('/admin/pengguna');

                break;
            case 'GET':

                return view('admin.pengguna.tambah');

                break;

            default:
                # code...
                break;
        }

    }

}
