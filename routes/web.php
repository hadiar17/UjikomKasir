<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
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

Route::get('/', [DashboardController::class, 'index']);

Route::resource('produk',ProdukController::class);
Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');

Route::resource('penjualan',PenjualanController::class);
    Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::post('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');

Route::resource('detail_penjualan',DetailPenjualanController::class);
    Route::get('detail_penjualan', [DetailPenjualanController::class, 'index'])->name('detail_penjualan.index');