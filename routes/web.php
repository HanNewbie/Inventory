<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\stok_barang\StokBarangController;
use App\Http\Controllers\admin\data_barang\LokawisataController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\user\UserDashboardController;
use App\Http\Controllers\user\stok_barang\UserStokBarangController;
use App\Http\Controllers\user\notification\NotifController;
use App\Http\Controllers\user\requests\RequestController;
use App\Http\Controllers\AccountController;

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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.post');

Route::get('/admin/dashboard', function () {
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    if (auth()->user()->role !== 'user') {
        abort(403, 'Unauthorized');
    }
    return view('user.dashboard');
})->middleware('auth')->name('user.dashboard');

route::middleware(['auth'])->group(function () {

    Route::get('/accounts/admin', [AccountController::class, 'index_admin'])->name('admin.accounts');
     //DASHBOARD
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    //STOK BARANG
    Route::get('/admin/stok_barang', [StokBarangController::class, 'index'])->name('admin.stok_barang');
    //STOK BARANG
    Route::get('/admin/data_barang/lokawisata', [LokawisataController::class, 'index'])->name('admin.lokawisata');

    Route::get('/accounts/user', [AccountController::class, 'index_user'])->name('user.accounts');
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');  
    Route::get('/user/stok_barang', [UserStokBarangController::class, 'index'])->name('user.stok_barang');
    Route::get('/user/notification', [NotifController::class, 'index'])->name('user.notif');
    Route::get('/user/request', [RequestController::class, 'index'])->name('user.request');
});