<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DetailPenjualanController;

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

// Route untuk menampilkan halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk mengirimkan data login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::resource('dashboard', DashboardController::class);
Route::resource('produk', ProdukController::class);
Route::resource('penjualan', PenjualanController::class);
Route::resource('detail_penjualan', DetailPenjualanController::class);
Route::resource('users', UserController::class);

Route::middleware(['auth'])->group(function () {
    // Definisikan route untuk admin dan pegawai di sini
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    // Definisikan route untuk admin di sini
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/penjualan', [PenjualanController::class, 'create'])->name('penjualan.create');
    Route::get('/detail_penjualan', [DetailPenjualanController::class, 'index'])->name('detail_penjualan.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::middleware(['auth', 'role:pegawai'])->group(function () {
    // Definisikan route untuk pegawai di sini
    Route::get('/penjualan', [PenjualanController::class, 'create'])->name('penjualan.create');
});



// Route::get('/', [DashboardController::class, 'index']);

// Route::resource('produk',ProdukController::class);
//     Route::get('produk', [ProdukController::class, 'index'])->name('produk.index');

// Route::resource('penjualan',PenjualanController::class);
//     Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
//     Route::post('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');

// Route::resource('detail_penjualan',DetailPenjualanController::class);
//     Route::get('detail_penjualan', [DetailPenjualanController::class, 'index'])->name('detail_penjualan.index');

// Route::resource('users',UserController::class);
//     Route::get('users', [UserController::class, 'index'])->name('users.index');