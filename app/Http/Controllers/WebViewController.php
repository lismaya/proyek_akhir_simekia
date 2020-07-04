<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebViewController extends Controller
{
    //
    //
    public function jadwalImunisasi(Request $request)
    {

        $pasien_id = $request->pasien_id;

        $jadwal = DB::select("
                SELECT a.nama,a.usia,COUNT(b.id) AS status
                FROM jenis_imunisasi a
                LEFT JOIN imunisasi b ON a.id = b.jenis_imunisasi_id AND b.pasien_id = $pasien_id
                GROUP BY a.id
                ORDER BY a.usia ASC,COUNT(b.id) ASC");

        return view('webview.jadwal_imunisasi', ['jadwal' => $jadwal]);

    }

    private function bb_u($pasien_id, $pasien_jk)
    {

        $anak = DB::select("
                    SELECT b.tgl_lahir,
                           TIMESTAMPDIFF(MONTH,b.tgl_lahir,a.tgl) AS usia_saat_pemeriksaan,
                           a.berat_badan,a.tinggi_badan,a.lingkar_kepala
                    FROM antropometri a
                    LEFT JOIN pasien b ON a.pasien_id = b.id 
                    WHERE a.pasien_id = $pasien_id");

        // var_dump($anak);

        $array_anak = array();
        foreach ($anak as $key) {
            $array_anak[$key->usia_saat_pemeriksaan] = $key->berat_badan;
        }

        $bb_u = DB::select("SELECT * FROM standart_bb_u WHERE jk = '$pasien_jk'");

        // var_dump($bb_u);

        $min_3_sd  = array();
        $min_2_sd  = array();
        $min_1_sd  = array();
        $median    = array();
        $plus_1_sd = array();
        $plus_2_sd = array();
        $plus_3_sd = array();

        foreach ($bb_u as $row) {
            $min_3_sd[$row->umur_bulan]  = $row->min_3_sd;
            $min_2_sd[$row->umur_bulan]  = $row->min_2_sd;
            $min_1_sd[$row->umur_bulan]  = $row->min_1_sd;
            $median[$row->umur_bulan]    = $row->median;
            $plus_1_sd[$row->umur_bulan] = $row->plus_1_sd;
            $plus_2_sd[$row->umur_bulan] = $row->plus_2_sd;
            $plus_3_sd[$row->umur_bulan] = $row->plus_3_sd;
        }

        for($i = 0;$i<= 60;$i++){
            $min_3_sd[$i]  = !isset($min_3_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $min_3_sd[$i] . ']';
            $min_2_sd[$i]  = !isset($min_2_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $min_2_sd[$i] . ']';
            $min_1_sd[$i]  = !isset($min_1_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $min_1_sd[$i] . ']';
            $median[$i]    = !isset($median[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $median[$i] . ']';
            $plus_1_sd[$i] = !isset($plus_1_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $plus_1_sd[$i] . ']';
            $plus_2_sd[$i] = !isset($plus_2_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $plus_2_sd[$i] . ']';
            $plus_3_sd[$i] = !isset($plus_3_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $plus_3_sd[$i] . ']';

            $array_anak[$i] = !isset($array_anak[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $array_anak[$i] . ']';

        }

        ksort($min_3_sd);
        ksort($min_2_sd);
        ksort($min_1_sd);
        ksort($median);
        ksort($plus_1_sd);
        ksort($plus_2_sd);
        ksort($plus_3_sd);
        ksort($array_anak);

        $array_bb_u = array();

        $array_bb_u['min_3_sd']   = implode(',', $min_3_sd);
        $array_bb_u['min_2_sd']   = implode(',', $min_2_sd);
        $array_bb_u['min_1_sd']   = implode(',', $min_1_sd);
        $array_bb_u['median']     = implode(',', $median);
        $array_bb_u['plus_1_sd']  = implode(',', $plus_1_sd);
        $array_bb_u['plus_2_sd']  = implode(',', $plus_2_sd);
        $array_bb_u['plus_3_sd']  = implode(',', $plus_3_sd);
        $array_bb_u['array_anak'] = implode(',', $array_anak);

        return $array_bb_u;

    }

    private function bb_tb($pasien_id, $pasien_jk)
    {

        $anak = DB::select("
                    SELECT b.tgl_lahir,
                           TIMESTAMPDIFF(MONTH,b.tgl_lahir,DATE(a.tgl)) AS usia_saat_pemeriksaan,
                           a.berat_badan,a.tinggi_badan,a.lingkar_kepala
                    FROM antropometri a
                    LEFT JOIN pasien b ON a.pasien_id = b.id 
                    WHERE a.pasien_id = $pasien_id");

        // var_dump($anak);

        $array_anak = array();
        foreach ($anak as $key) {
            $array_anak[$key->tinggi_badan] = $key->berat_badan;
        }

        $bb_tb = DB::select("SELECT * FROM standart_bb_tb WHERE jk = '$pasien_jk'");

        $min_3_sd  = array();
        $min_2_sd  = array();
        $min_1_sd  = array();
        $median    = array();
        $plus_1_sd = array();
        $plus_2_sd = array();
        $plus_3_sd = array();

        foreach ($bb_tb as $row) {
            $min_3_sd[$row->tinggi_badan]  = $row->min_3_sd;
            $min_2_sd[$row->tinggi_badan]  = $row->min_2_sd;
            $min_1_sd[$row->tinggi_badan]  = $row->min_1_sd;
            $median[$row->tinggi_badan]    = $row->median;
            $plus_1_sd[$row->tinggi_badan] = $row->plus_1_sd;
            $plus_2_sd[$row->tinggi_badan] = $row->plus_2_sd;
            $plus_3_sd[$row->tinggi_badan] = $row->plus_3_sd;
        }

        for ($i = 45; $i <= 120; $i++) {
            $min_3_sd[$i]  = !isset($min_3_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $min_3_sd[$i] . ']';
            $min_2_sd[$i]  = !isset($min_2_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $min_2_sd[$i] . ']';
            $min_1_sd[$i]  = !isset($min_1_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $min_1_sd[$i] . ']';
            $median[$i]    = !isset($median[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $median[$i] . ']';
            $plus_1_sd[$i] = !isset($plus_1_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $plus_1_sd[$i] . ']';
            $plus_2_sd[$i] = !isset($plus_2_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $plus_2_sd[$i] . ']';
            $plus_3_sd[$i] = !isset($plus_3_sd[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $plus_3_sd[$i] . ']';

            $array_anak[$i] = !isset($array_anak[$i]) ? '[' . $i . ',0]' : '[' . $i . ',' . $array_anak[$i] . ']';

        }

        ksort($min_3_sd);
        ksort($min_2_sd);
        ksort($min_1_sd);
        ksort($median);
        ksort($plus_1_sd);
        ksort($plus_2_sd);
        ksort($plus_3_sd);
        ksort($array_anak);

        $array_bb_tb = array();

        $array_bb_tb['min_3_sd']   = implode(',', $min_3_sd);
        $array_bb_tb['min_2_sd']   = implode(',', $min_2_sd);
        $array_bb_tb['min_1_sd']   = implode(',', $min_1_sd);
        $array_bb_tb['median']     = implode(',', $median);
        $array_bb_tb['plus_1_sd']  = implode(',', $plus_1_sd);
        $array_bb_tb['plus_2_sd']  = implode(',', $plus_2_sd);
        $array_bb_tb['plus_3_sd']  = implode(',', $plus_3_sd);
        $array_bb_tb['array_anak'] = implode(',', $array_anak);

        return $array_bb_tb;

    }

    public function perkembanganAnak(Request $request)
    {

        $pasien_id = $request->pasien_id;
        $pasien_jk = ($request->pasien_jk === 'L' ?'Laki-laki' : 'Perempuan');

        
        $array_bb_tb = $this->bb_tb($pasien_id, $pasien_jk);
        $array_bb_u = $this->bb_u($pasien_id, $pasien_jk);

        // var_dump($array_anak);

        return view('webview.perkembangan_anak',
            [
                'bb_tb_min_3_sd'   => $array_bb_tb['min_3_sd'],
                'bb_tb_min_2_sd'   => $array_bb_tb['min_2_sd'],
                'bb_tb_min_1_sd'   => $array_bb_tb['min_1_sd'],
                'bb_tb_median'     => $array_bb_tb['median'],
                'bb_tb_plus_1_sd'  => $array_bb_tb['plus_1_sd'],
                'bb_tb_plus_2_sd'  => $array_bb_tb['plus_2_sd'],
                'bb_tb_plus_3_sd'  => $array_bb_tb['plus_3_sd'],
                'bb_tb_array_anak' => $array_bb_tb['array_anak'],

                'bb_u_min_3_sd'   => $array_bb_u['min_3_sd'],
                'bb_u_min_2_sd'   => $array_bb_u['min_2_sd'],
                'bb_u_min_1_sd'   => $array_bb_u['min_1_sd'],
                'bb_u_median'     => $array_bb_u['median'],
                'bb_u_plus_1_sd'  => $array_bb_u['plus_1_sd'],
                'bb_u_plus_2_sd'  => $array_bb_u['plus_2_sd'],
                'bb_u_plus_3_sd'  => $array_bb_u['plus_3_sd'],
                'bb_u_array_anak' => $array_bb_u['array_anak'],
            ]
        );

    }
}
