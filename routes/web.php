<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
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

Route::get('/level',[LevelController::class, 'index']);

Route::get('/kategori',[KategoriController::class, 'index']);

Route::get('/user',[UserController::class, 'index']);

Route::get('/barang',[BarangController::class, 'index']);

Route::get('/stok',[StokController::class, 'index']);

Route::get('/penjualan',[PenjualanController::class, 'index']);

Route::get('/detail_penjualan',[DetailPenjualanController::class, 'index']);

Route::get('/user/tambah', [UserController::class, 'tambah']);

Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

Route::put('/user/ubah/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/kategori/create', [KategoriController::class, 'create']);

Route::post('/kategori', [KategoriController::class, 'store']);

Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);

Route::put('/kategori/{id}/edit', [KategoriController::class, 'update']);

Route::delete('/kategori/{id}/delete', [KategoriController::class, 'delete']);