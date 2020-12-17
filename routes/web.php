<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/produk', 'ProdukController@index');
Route::get('/produk/tambah', 'ProdukController@create');
Route::post('/produk', 'ProdukController@store');
Route::get('/produk/{produk}/edit', 'ProdukController@edit');
Route::put('/produk/{produk}', 'ProdukController@update');
Route::delete('/produk/{produk}', 'ProdukController@destroy');
Route::post('/produk/cari', 'ProdukController@cari');

Route::get('/penjualan', 'RiwayatHarianController@penjualan');
Route::post('/penjualan/cari', 'RiwayatHarianController@cariPenjualan');

Route::get('/harian', 'RiwayatHarianController@index');
Route::get('/harian/{produk}', 'RiwayatHarianController@create');
Route::post('/harian/{produk}', 'RiwayatHarianController@store');
Route::get('/harian/{riwayatHarian}/edit', 'RiwayatHarianController@edit');
Route::put('/harian/{riwayatHarian}', 'RiwayatHarianController@update');
Route::delete('/harian/{riwayatHarian}', 'RiwayatHarianController@store');
// Route::post('/harian/cari', 'RiwayatHarianController@cari');

Route::get('/bulanan', 'RiwayatHarianController@indexBulanan');
