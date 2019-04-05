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

Route::group(['middleware' => 'auth'], function(){
	Route::resource('produk', 'ProdukController', ['except' => ['index','show']]);
	Route::get('/produk/{id}/destroy', 'ProdukController@destroy');
	
	Route::resource('pekerja', 'PekerjaController');
	Route::get('/pekerja/{id}/destroy', 'PekerjaController@destroy');
	Route::get('/pembeli', 'PekerjaController@pembeli');

	Route::get('/setting/{id}', 'HomeController@setting');
	Route::put('/Setting-edit/{id}', 'HomeController@updateProfile');

	Route::resource('pesanan', 'PesananController');
	Route::post('/bayar-produk', 'PesananController@bayarProduk');
	Route::get('/transaksi-pembayaran', 'TransaksiController@pembayaranProduk');
	Route::post('/pembayaran/upload', 'TransaksiController@pembayaranUpload');
	Route::get('/transaksi-berhasil', 'TransaksiController@ucapanBerhasil');
	Route::get('/history', 'TransaksiController@historyPesanan');
	
	Route::resource('transaksi', 'TransaksiController');
	Route::resource('Setting', 'SettingController', ['except' => ['index','show']]);
	Route::resource('Transaction', 'TransactionController', ['except' => ['index','show']]);
	Route::resource('Order', 'OrderController', ['except' => ['index','show']]);
	Route::resource('Profile', 'ProfileController', ['except' => ['index','show']]);

	Route::put('/Data/keamanan/{id}', 'PekerjaController@update_keamanan');
});


Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::resource('produk', 'ProdukController', ['only' => ['index','show']]);

// hapus nantik

Auth::routes();

// Route::group(['middleware' => 'mimin'], function(){
// 	Route::get('/mimin', 'MiminController@dasboard');
// });


// Route::get('/notifications/{id}', 'HomeController@notifications');

// Route::resource('/Product', 'ProductController', ['only' => ['index','show']]);
// Route::resource('/Setting', 'SettingController', ['only' => ['index','show']]);
// Route::resource('/Transaction', 'TransactionController', ['only' => ['index','show']]);
// Route::resource('/Order', 'OrderController', ['only' => ['index','show']]);
// Route::resource('/Profile', 'ProfileController', ['only' => ['index','show']]);


