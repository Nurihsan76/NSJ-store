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


Route::get('/harian', 'RiwayatHarianController@index');
Route::get('/harian/{produk}', 'RiwayatHarianController@create');
Route::post('/harian/{produk}', 'RiwayatHarianController@store');

Route::get('/bulanan', 'RiwayatHarianController@indexBulanan');
