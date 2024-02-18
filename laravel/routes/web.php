<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\StokController;
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
    return view('login');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('login','index')->name('login');
    Route::post('login/proses','proses');
    Route::get('logout','logout');
});

Route::group(['middleware' => ['cekUserLogin:1']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/registrasi',[AdminController::class, 'regist']);
    Route::post('createuser', [LoginController::class, 'createuser'])->name('admin.store');
    
});
Route::group(['middleware' => ['cekUserLogin:2']],function(){
    Route::resource('petugas',PetugasController::class);
    
});

Route::post('produk/create', [AdminController::class, 'create']);
Route::get('barang/{produkid}/edit', [AdminController::class, 'edit']);
Route::get('produk/{produkid}/edit', [PetugasController::class, 'edit']);
Route::put('/barang/{produkid}', [AdminController::class, 'update']);
Route::put('/produk/{produkid}', [PetugasController::class, 'update']);
Route::delete('/barang/{produkid}', [AdminController::class, 'destroy']);
Route::delete('/produk/{produkid}', [PetugasController::class, 'destroy']);

Route::get('/stok',[StokController::class , 'index']);
Route::get('stok/{produkid}/add', [StokController::class, 'adddata']);
Route::put('stok/{produkid}/', [StokController::class, 'tambahi']);
Route::get('stok/{produkid}/reduce', [StokController::class, 'reducedata']);
Route::put('stok/{produkid}/kurang', [StokController::class, 'kurangi']);

Route::get('/detailpembelian',[PetugasController::class , 'look']);