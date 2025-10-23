<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccountController;

//ADMIN CONTROLLERS
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\data_barang\LokawisataController;
use App\Http\Controllers\admin\barang_masuk\InboundController;
use App\Http\Controllers\admin\barang_keluar\OutboundController;
use App\Http\Controllers\admin\notifikasi\NotifikasiController;
use App\Http\Controllers\admin\stok_barang\StokBarangController;

//USER CONTROLLERS
use App\Http\Controllers\user\UserDashboardController;
use App\Http\Controllers\user\stok_barang\UserStokBarangController;
use App\Http\Controllers\user\notification\NotifController;
use App\Http\Controllers\user\requests\RequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.post');


Route::prefix('admin')->middleware(['auth'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //Akun
    Route::get('/accounts/admin', [AccountController::class, 'index_admin'])->name('accounts.admin');
    Route::get('/accounts/user', [AccountController::class, 'index_user'])->name('accounts.user');

    //Stok Barang
    Route::resource('/stok_barang', StokBarangController::class);
    // Route::get('/stok-barang', [StokBarangController::class, 'index'])->name('stok_barang.index');
    // Route::post('/stok-barang/store', [StokBarangController::class, 'store'])->name('stok_barang.store');
    // Route::put('/stok-barang/{id}', [StokBarangController::class, 'update'])->name('stok_barang.update');
    // Route::delete('/stok-barang/{id}', [StokBarangController::class, 'destroy'])->name('stok_barang.destroy');

    //Data Barang - Lokawisata
    Route::get('/data-barang/lokawisata', [LokawisataController::class, 'index'])->name('lokawisata');

    //Barang Masuk & Keluar
    Route::resource('/barang_masuk', InboundController::class);
    Route::resource('/barang_keluar', OutboundController::class); 
    
    //Notifikasi
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
});

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function () {

    //Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    //Stok Barang
    Route::get('/stok-barang', [UserStokBarangController::class, 'index'])->name('stok_barang');

    //Notifikasi
    Route::get('/notifikasi', [NotifController::class, 'index'])->name('notifikasi');

    //Request Barang
    Route::get('/request', [RequestController::class, 'index'])->name('request');
});
