<?php

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

Route::get('/', function() {
	return view('home.main');
});

Route::get('/login', ['uses' => 'admin\AuthCtrl@getLogin','as' => 'login']);
Route::post('/login', ['uses' => 'admin\AuthCtrl@postLogin']);
Route::get('/logout', ['uses' => 'admin\AuthCtrl@getLogout','as' => 'logout']);

Route::get('/opd/pilihBidang/{id}', 'adminpemda\OPDCtrl@pilihBidang');
Route::get('/mapping/cariSasaran', 'adminpemda\MappingCtrl@cariSasaran');
Route::get('/adminpemda/pilihSasaranOpd/{id}', 'adminpemda\MappingCtrl@pilihSasaranOpd');

Route::get('/identifikasikegiatan/pilihProgram/{id}', 'opdkegiatan1\IdentifikasiKegiatanCtrl@pilihProgram');
Route::get('/identifikasikegiatan/pilihKegiatan/{idk}', 'opdkegiatan1\IdentifikasiKegiatanCtrl@pilihKegiatan');
Route::get('/identifikasikegiatan/pilihPemilik/{id}', 'opdkegiatan1\IdentifikasiKegiatanCtrl@pilihPemilik');
Route::get('/identifikasikegiatan/pilihRisiko/{id}', 'opdkegiatan1\IdentifikasiKegiatanCtrl@pilihRisiko');

Route::get('/identifikasiopd1/pilihPemilikUserOpd/{id}', 'useropd1\IdentifikasiOpd1Ctrl@pilihPemilikUserOpd');
Route::get('/identifikasiopd1/pilihRisiko/{id}', 'useropd1\IdentifikasiOpd1Ctrl@pilihRisiko');

Route::get('/analisisopd1/googlechartopd', array('as'=>'googlechartopd', 'uses' => 'useropd1\AnalisisOpd1Ctrl@googlechartopd'));

Route::get('/identifikasipemda1/pilihSasaran/{id}', 'userpemda1\IdentifikasiPemda1Ctrl@pilihSasaran');
Route::get('/identifikasipemda1/pilihTujuan/{id}', 'userpemda1\IdentifikasiPemda1Ctrl@pilihTujuan');
Route::get('/identifikasipemda1/pilihRisiko', 'userpemda1\IdentifikasiPemda1Ctrl@pilihRisiko');

Route::get('/analisispemda1/pilihTujuan/{id}', 'userpemda1\AnalisisPemda1Ctrl@pilihTujuan');
Route::get('/analisispemda1/pilihSasaran/{id}', 'userpemda1\AnalisisPemda1Ctrl@pilihSasaran');
Route::get('/analisispemda1/pilihPeriode/{id}', 'userpemda1\AnalisisPemda1Ctrl@pilihPeriode');
Route::get('/analisispemda1/googlechart', array('as'=>'googlechartpemda', 'uses' => 'userpemda1\AnalisisPemda1Ctrl@googlechart'));

Route::get('/analisiskegiatan1/pilihRisiko/{id}', 'opdkegiatan1\AnalisisKegiatanCtrl@pilihRisiko');
Route::get('/analisiskegiatan1/pilihPeriode/{id}', 'opdkegiatan1\AnalisisKegiatanCtrl@pilihPeriode');
Route::get('/analisiskegiatan1/googlechart', array('as'=>'googlechart', 'uses' => 'opdkegiatan1\AnalisisKegiatanCtrl@googlechart'));

Route::group(['middleware' => ['web', 'auth', 'roles']],function() {

	//Route role Admin Pemda
	Route::group(['prefix' => 'adminpemda', 'roles'=>'Admin Pemda'],function() {
		Route::get('home', ['uses' => 'admin\AppCtrl@getIndex', 'as' => 'adminpemda']);
		Route::resource('manajemen-user', 'adminpemda\UserCtrl');
		Route::resource('opd', 'adminpemda\OPDCtrl');
		Route::resource('baganrisiko', 'adminpemda\BaganrisikoCtrl');
		Route::resource('kategori', 'adminpemda\KategoriCtrl');
		Route::resource('misi', 'adminpemda\MisiCtrl');
		Route::resource('visi', 'adminpemda\VisiCtrl');
		Route::resource('tujuan', 'adminpemda\TujuanCtrl');
		Route::resource('sasaran', 'adminpemda\SasaranCtrl');
		Route::resource('program', 'adminpemda\ProgramCtrl');
		Route::resource('pemda', 'adminpemda\PemdaCtrl');
		Route::resource('mapping', 'adminpemda\MappingCtrl');
		
	});

	//Route role User Pemda 1
	Route::group(['prefix' => 'userpemda1', 'roles' => 'User Pemda 1'], function() {
		Route::get('home', ['uses' => 'admin\AppCtrl@getIndex', 'as' => 'userpemda1']);

		Route::resource('identifikasipemda1', 'userpemda1\IdentifikasiPemda1Ctrl');
		Route::get('cetakidentifikasipemda', 'userpemda1\IdentifikasiPemda1Ctrl@cetak');
		Route::get('createnewpemda', ['uses' => 'userpemda1\IdentifikasiPemda1Ctrl@create', 'as' => 'createnewpemda']);
		Route::get('tranIdentifikasiPemda', array('as'=>'tranIdentifikasiPemda', 'uses' => 'userpemda1\IdentifikasiPemda1Ctrl@transaksi'));
		Route::get('identifikasipemda1/create/{id}','userpemda1\IdentifikasiPemda1Ctrl@createby');

		Route::get('analisispemda1/create/{id}','userpemda1\AnalisisPemda1Ctrl@create');
		Route::resource('analisispemda1', 'userpemda1\AnalisisPemda1Ctrl');
		Route::get('cetakanalisispemda', 'userpemda1\AnalisisPemda1Ctrl@CetakAnalisis');
		Route::get('transaksi', array('as'=>'transaksipemda', 'uses' => 'userpemda1\AnalisisPemda1Ctrl@transaksi'));

		Route::resource('rtppemda1', 'userpemda1\RtpPemda1Ctrl');
		Route::get('rtppemda1/create/{id}','userpemda1\RtpPemda1Ctrl@create');
		Route::get('transRtpPemda',array('as'=>'transRtpPemda', 'uses' => 'userpemda1\RtpPemda1Ctrl@transaksiRTP'));
		Route::get('cetakrtppemda', 'userpemda1\RtpPemda1Ctrl@CetakRTP');
	});

	//Route role User Pemda 2
	Route::group(['prefix' => 'userpemda2', 'roles' => 'User Pemda 2'], function() {
		Route::get('home', ['uses' => 'admin\AppCtrl@getIndex', 'as' => 'userpemda2']);
		Route::resource('pemantauanpemda2', 'userpemda2\PemantauanPemda2Ctrl');
		Route::get('pantaupemda', array('as'=>'pantaupemda', 'uses' => 'userpemda2\PemantauanPemda2Ctrl@transaksi'));
		Route::get('pemantauanpemda2/create/{id}','userpemda2\PemantauanPemda2Ctrl@create');
		Route::get('cetakPantau', 'userpemda2\PemantauanPemda2Ctrl@cetakPantau');
	});

	//Route role Admin OPD
	Route::group(['prefix' => 'adminopd', 'roles' => 'Admin OPD'], function() {
		Route::get('home', ['uses' => 'admin\AppCtrl@getIndex', 'as' => 'adminopd']);
		Route::resource('misiopd', 'adminopd\MisiOPDCtrl');
		Route::resource('tujuanopd', 'adminopd\TujuanOPDCtrl');
		Route::resource('sasaranopd', 'adminopd\SasaranOPDCtrl');
		Route::resource('programopd', 'adminopd\ProgramOPDCtrl');
		Route::resource('kegiatanopd', 'adminopd\KegiatanOPDCtrl');
	});

	//Route role User OPD 1
	Route::group(['prefix' => 'useropd1', 'roles' => 'User OPD 1'], function() {
		Route::get('/home', ['uses' => 'admin\AppCtrl@getIndex', 'as' => 'useropd1']);

		Route::get('createnew', ['uses' => 'useropd1\IdentifikasiOpd1Ctrl@create', 'as' => 'createnew']);
		Route::resource('identifikasiopd1', 'useropd1\IdentifikasiOpd1Ctrl');
		Route::get('identifikasiopd1/create/{id}','useropd1\IdentifikasiOpd1Ctrl@createbyanalisis');
		Route::get('tranIdentifikasiOpd', array('as'=>'tranIdentifikasiOpd', 'uses' => 'useropd1\IdentifikasiOpd1Ctrl@transaksi'));
		Route::get('cetakidentifikasiopd', 'useropd1\IdentifikasiOpd1Ctrl@cetak');

		Route::resource('analisisopd1', 'useropd1\AnalisisOpd1Ctrl');
		Route::get('analisisopd1/create/{id}','useropd1\AnalisisOpd1Ctrl@create');
		Route::get('transaksiopd', array('as'=>'transaksiopd', 'uses' => 'useropd1\AnalisisOpd1Ctrl@transaksi'));
		Route::get('cetakanalisisopd', 'useropd1\AnalisisOpd1Ctrl@CetakAnalisis');
		Route::get('chartanalisisopd', 'useropd1\AnalisisOpd1Ctrl@Chart');

		Route::resource('rtpopd1', 'useropd1\RtpOpd1Ctrl');
		Route::get('rtpopd1/create/{id}','useropd1\RtpOpd1Ctrl@create');
		Route::get('tranRtpOpd',array('as'=>'tranRtpOpd', 'uses' => 'useropd1\RtpOpd1Ctrl@transaksiRTP'));
		Route::get('cetakrtpopd', 'useropd1\RtpOpd1Ctrl@CetakRTP');

	});

	//Route role User OPD 2
	Route::group(['prefix' => 'useropd2', 'roles' => 'User OPD 2'], function() {
		Route::get('home', ['uses' => 'admin\AppCtrl@getIndex', 'as' => 'useropd2']);
		Route::resource('pemantauanopd2', 'useropd2\PemantauanOpd2Ctrl');
		Route::get('pantauopd', array('as'=>'pantauopd', 'uses' => 'useropd2\PemantauanOpd2Ctrl@transaksi'));
		Route::get('pemantauanopd2/create/{id}','useropd2\PemantauanOpd2Ctrl@create');
		Route::get('cetakpantauopd', 'useropd2\PemantauanOpd2Ctrl@cetakPantau');
	});

	//Route role User OPD Kegiatan 1
	Route::group(['prefix' => 'useropdkegiatan1', 'roles' => 'User OPD Kegiatan 1'], function() {
		Route::get('home', ['uses' => 'admin\AppCtrl@getIndex', 'as' => 'opdkegiatan1']);

		Route::resource('identifikasikegiatan1', 'opdkegiatan1\IdentifikasiKegiatanCtrl');
		Route::get('cetakidentifikasi', 'opdkegiatan1\IdentifikasiKegiatanCtrl@Cetak');

		Route::resource('analisiskegiatan1', 'opdkegiatan1\AnalisisKegiatanCtrl');
		Route::get('analisiskegiatan1/create/{id}','opdkegiatan1\AnalisisKegiatanCtrl@create');
		Route::get('cetakanalisis', 'opdkegiatan1\AnalisisKegiatanCtrl@CetakAnalisis');
		Route::get('transaksi', array('as'=>'transaksi', 'uses' => 'opdkegiatan1\AnalisisKegiatanCtrl@transaksi'));

		Route::resource('rtpkegiatan1', 'opdkegiatan1\RtpKegiatanCtrl');
		Route::get('rtpkegiatan1/create/{id}','opdkegiatan1\RtpKegiatanCtrl@create');
		Route::get('trans_rtp',array('as'=>'trans_rtp', 'uses' => 'opdkegiatan1\RtpKegiatanCtrl@transaksiRTP'));
		Route::get('cetakRTP', 'opdkegiatan1\RtpKegiatanCtrl@CetakRTP');
		Route::get('chartRTP', 'opdkegiatan1\RtpKegiatanCtrl@chartRTP');

	});

	//Route role User OPD Kegiatan 2
	Route::group(['prefix' => 'useropdkegiatan2', 'roles' => 'User OPD Kegiatan 2'], function() {
		Route::get('home', ['uses' => 'admin\AppCtrl@getIndex', 'as' => 'opdkegiatan2']);
		Route::resource('pemantauankegiatan2', 'opdkegiatan2\PemantauanKegiatan');
		Route::get('pantaukegiatan', array('as'=>'pantaukegiatan', 'uses' => 'opdkegiatan2\PemantauanKegiatan@transaksi'));
		Route::get('pemantauankegiatan2/create/{id}','opdkegiatan2\PemantauanKegiatan@create');
		Route::get('pemantauankegiatan2/edit/{id}/{idm}','opdkegiatan2\PemantauanKegiatan@edit');
		Route::get('cetakPantau', 'opdkegiatan2\PemantauanKegiatan@cetakPantau');
	});

});
