<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(array('GET', 'POST'), '/', 'WebController@index'); #login
Route::get('/logout', 'WebController@logout');

Route::group(['prefix' => 'dokter'], function () {
    #
    Route::get('/', 'DokterController@index');
    #
    Route::get('/antrian', 'DokterController@antrian');
    Route::get('/antrian-ajax', 'DokterController@antrianAjax');
    #
    Route::get('/daftar-data-pasien', 'DokterController@daftarDataPasien');
    #
    Route::get('/rekam-medis/{pasien_id}', 'DokterController@rekamMedis');
    #
    Route::get('/form-imunisasi-ajax/{pasien_id}', 'DokterController@formImunisasiAjax');
    Route::post('/imunisasi-simpan/{pasien_id}', 'DokterController@imunisasiSimpan');
    #
    Route::post('/pemeriksaan-simpan/{pasien_id}', 'DokterController@pemeriksaanSimpan');
    #
    Route::get('/riwayat-pemeriksaan-ajax/{pasien_id}', 'DokterController@riwayatPemeriksaanAjax');
    Route::get('/riwayat-imunisasi-ajax/{pasien_id}', 'DokterController@riwayatImunisasiAjax');
    Route::get('/riwayat-antropometri-ajax/{pasien_id}', 'DokterController@riwayatAntropometriAjax');

    #
    Route::match(array('GET', 'POST'), '/profile', 'DokterController@profile');
});

Route::group(['prefix' => 'apoteker'], function () {
    Route::get('/', 'ApotekerController@index');
    #
    Route::get('/set-selesai/{antrian_id}', 'ApotekerController@antrianSetSelesai');
    #
    Route::get('/antrian', 'ApotekerController@antrian');
    Route::get('/antrian-ajax', 'ApotekerController@antrianAjax');
    #
    Route::get('/detail-resep-ajax/{pasien_id}/{jenis}', 'ApotekerController@resepDetail');
    // Route::get('/resep-detail', 'ApotekerController@resepDetail');
    #
    Route::get('/cetak-resep/{pasien_id}/{jenis}', 'ApotekerController@cetakResep');
    #
    Route::match(array('GET', 'POST'), '/profile', 'ApotekerController@profile');
});

Route::group(['prefix' => 'resepsionis'], function () {
    Route::get('/', 'ResepsionisController@index');
    #
    Route::get('/ortu', 'ResepsionisController@ortu');
    Route::match(array('GET', 'POST'), '/ortu-tambah', 'ResepsionisController@ortuTambah');
    Route::match(array('GET', 'POST'), '/ortu-edit/{id}', 'ResepsionisController@ortuEdit');
    Route::get('/ortu-hapus/{id}', 'ResepsionisController@ortuHapus');
    #
    Route::get('/pasien/{ortu_id}', 'ResepsionisController@pasien');
    Route::match(array('GET', 'POST'), '/pasien-tambah/{ortu_id}', 'ResepsionisController@pasienTambah');
    Route::match(array('GET', 'POST'), '/pasien-edit/{ortu_id}/{pasien_id}', 'ResepsionisController@pasienEdit');
    Route::get('/pasien-hapus/{ortu_id}/{pasien_id}', 'ResepsionisController@pasienHapus');
    #
    Route::get('/antrian', 'ResepsionisController@antrian');
    Route::get('/antrian-ajax', 'ResepsionisController@antrianAjax');
    Route::get('/tambah-data-antrian/{pasien_id}/{jenis}', 'ResepsionisController@antrianTambahData');
    Route::get('/set-diperiksa/{antrian_id}', 'ResepsionisController@antrianSetDiperiksa');
    Route::post('/simpan-antropometri', 'ResepsionisController@simpanAntropometri');
    Route::get('/data-pasien-json', 'ResepsionisController@dataPasienJson');
    #
    Route::match(array('GET', 'POST'), '/profile', 'ResepsionisController@profile');

});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    #
    Route::get('/pengguna', 'AdminController@pengguna');
    Route::match(array('GET', 'POST'), '/pengguna-tambah', 'AdminController@penggunaTambah');
    Route::match(array('GET', 'POST'), '/pengguna-edit/{id}', 'AdminController@penggunaEdit');
    #
    Route::match(array('GET', 'POST'), '/laporan-bulanan', 'AdminController@laporanBulanan');
    #
    Route::match(array('GET', 'POST'), '/profile', 'AdminController@profile');
});

Route::group(['prefix' => 'webview'], function () {
    Route::get('/jadwal-imunisasi', 'WebViewController@jadwalImunisasi');
    Route::get('/perkembangan-anak', 'WebViewController@perkembanganAnak');
});
