<?php

namespace App\Http\Controllers;

use App\antrianobat;
use App\imunisasi;
use App\pemeriksaan;
use App\pengguna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DokterController extends Controller
{

    public function __construct()
    {

        $this->middleware('dokter');
    }

    public function index()
    {
        return view('dokter.index');
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
                return redirect('/dokter/profile')->with('alert-success', 'Profile berhasil disimpan');
                // return $redirect->to('/admin/profile')->with('alert-danger', 'Password atau Email salah !')->send();

                break;
            case 'GET':

                $pengguna = Pengguna::find(Session::get('user_id'));
                return view('dokter.profile', ['pengguna' => $pengguna]);

                break;

            default:
                # code...
                break;
        }
    }

    public function daftarDataPasien()
    {
        $data = DB::select(
            "SELECT a.id,
                    a.nama AS nama,
                    CONCAT(a.tgl_lahir,' ( ', TIMESTAMPDIFF(MONTH,a.tgl_lahir, NOW()),' Bulan )') AS tgl_lahir,
                    CONCAT(b.nama_ayah,'',b.nama_ibu) AS ortu,
                    b.alamat
            FROM pasien AS a
            LEFT JOIN ortu AS b ON a.ortu_id = b.id
            ORDER BY a.nama ASC
        ");

        return view('dokter.pasien.list', ['data' => $data]);
    }

    public function riwayatPemeriksaanAjax($pasien_id)
    {
        $riwayat = DB::select(
            "SELECT DATE(a.tgl) AS tgl,
                    TIMESTAMPDIFF(MONTH,b.tgl_lahir,a.tgl) AS usia,
                    a.anamnesa,
                    a.diagnosa,
                    a.tindakan,
                    a.resep
             FROM pemeriksaan a
             LEFT JOIN pasien b ON a.pasien_id = b.id
             WHERE a.pasien_id = $pasien_id
             ORDER BY a.tgl DESC");

        $returnAjax = view('dokter.pemeriksaan.riwayatAjax', ['riwayat' => $riwayat])->render();
        return response()->json(array('success' => true, 'html' => $returnAjax));
    }

    public function riwayatImunisasiAjax($pasien_id)
    {
        $riwayat = DB::select(
            "SELECT DATE(a.tgl) AS tgl,
                     TIMESTAMPDIFF(MONTH,c.tgl_lahir,a.tgl) AS usia,
                     b.nama AS jenis_imunisasi,
                     a.keterangan,
                     a.resep
              FROM imunisasi a
              LEFT JOIN jenis_imunisasi b ON a.jenis_imunisasi_id = b.id
              LEFT JOIN pasien c ON a.pasien_id = c.id
              WHERE a.pasien_id = $pasien_id
              ORDER BY a.tgl DESC");

        $returnAjax = view('dokter.imunisasi.riwayatAjax', ['riwayat' => $riwayat])->render();
        return response()->json(array('success' => true, 'html' => $returnAjax));
    }

    public function riwayatAntropometriAjax($pasien_id)
    {
        $riwayat = DB::select(
            "SELECT DATE(a.tgl) AS tgl,
                     TIMESTAMPDIFF(MONTH,b.tgl_lahir,a.tgl) AS usia,
                     a.berat_badan AS bb,
                     a.tinggi_badan AS tb,
                     a.lingkar_kepala AS lk
              FROM antropometri a
              LEFT JOIN pasien b ON a.pasien_id = b.id
              WHERE a.pasien_id = $pasien_id
              ORDER BY a.tgl DESC");

        $returnAjax = view('dokter.antropometri.riwayatAjax', ['riwayat' => $riwayat])->render();
        return response()->json(array('success' => true, 'html' => $returnAjax));
    }

    public function pemeriksaanSimpan($pasien_id, Request $request)
    {
        Pemeriksaan::create([
            'tgl'       => Carbon::now(),
            'pasien_id' => $pasien_id,
            'anamnesa'  => $request->anamnesa,
            'diagnosa'  => $request->diagnosa,
            'tindakan'  => $request->tindakan,
            'resep'     => $request->resep,

        ]);

        if (trim($request->resep) !== '') {
            //tambahan ke antrian obat
            AntrianObat::create([
                'tgl'       => Carbon::now(),
                'jenis'     => 'pemeriksaan',
                'pasien_id' => $pasien_id,
                'status'    => 'antri',
            ]);
        }

        DB::statement("UPDATE antrian_dokter SET status='selesai' WHERE pasien_id = $pasien_id AND DATE(tgl) = DATE(now())");

        return redirect('/dokter/antrian');
    }

    public function imunisasiSimpan($pasien_id, Request $request)
    {
        Imunisasi::create([
            'tgl'                => Carbon::now(),
            'pasien_id'          => $pasien_id,
            'jenis_imunisasi_id' => $request->jenis_imunisasi_id,
            'keterangan'         => $request->keterangan,
            'resep'              => $request->resep,

        ]);

        if (trim($request->resep) !== '') {
            //tambahan ke antrian obat
            AntrianObat::create([
                'tgl'       => Carbon::now(),
                'jenis'     => 'imunisasi',
                'pasien_id' => $pasien_id,
                'status'    => 'antri',
            ]);
        }

        DB::statement("UPDATE antrian_dokter SET status='selesai' WHERE pasien_id = $pasien_id AND DATE(tgl) = DATE(now())");

        return redirect('/dokter/antrian');
    }

    public function formImunisasiAjax($pasien_id)
    {
        $riwayat = DB::select(
            "SELECT a.id,CONCAT(a.nama,' - (', a.usia , ' Bulan)') AS nama
             FROM jenis_imunisasi a
             WHERE a.id NOT IN (SELECT a.jenis_imunisasi_id
                                FROM imunisasi a
                                WHERE a.pasien_id = " . $pasien_id . ")
             ORDER BY a.id ASC");

        $returnAjax = view('dokter.imunisasi.formRiwayatAjax', ['jenis_imunisasi' => $riwayat])->render();
        return response()->json(array('success' => true, 'html' => $returnAjax));

    }

    public function antrianAjax()
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
            WHERE DATE(a.tgl) = DATE(now()) AND a.status IN ('diperiksa')
            GROUP BY a.id
            HAVING a.id IS NOT NULL
            ORDER BY a.tgl ASC");

        $returnAjax = view('dokter.antrian.listAjax', ['antrian' => $antrian])->render();
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
            WHERE DATE(a.tgl) = DATE(now()) AND a.status IN ('diperiksa')
            GROUP BY a.id
            HAVING a.id IS NOT NULL
            ORDER BY a.tgl ASC
        ");

        return view('dokter.antrian.list', ['antrian' => $antrian]);
    }

}
