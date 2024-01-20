<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('/produk', App\Http\Controllers\ProdukController::class);
Route::resource('/pembeli', App\Http\Controllers\PembeliController::class);
Route::resource('/pembelis', App\Http\Controllers\PembelisController::class);
Route::resource('/kasir', App\Http\Controllers\KasirController::class);
Route::resource('/transaksi', App\Http\Controllers\TransaksiController::class);




Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/shop', 'App\Http\Controllers\HomeController@shop')->name('shop');

Route::get('pesan/{id}', 'App\Http\Controllers\PesanController@index');
Route::post('pesan/{id}', 'App\Http\Controllers\PesanController@pesan');
Route::get('check-out', 'App\Http\Controllers\PesanController@check_out');
Route::delete('check-out/{id}', 'App\Http\Controllers\PesanController@delete');

Route::get('konfirmasi-check-out', 'App\Http\Controllers\PesanController@konfirmasi');

Route::get('profile', 'App\Http\Controllers\ProfileController@index');
Route::get('edit-profile', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');;
Route::post('profile', 'App\Http\Controllers\ProfileController@update');

Route::get('history', 'App\Http\Controllers\HistoryController@index');
Route::get('history/{id}', 'App\Http\Controllers\HistoryController@detail');

