<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
    Route::get('/admin/accounts', [App\Http\Controllers\AccountController::class, 'index_admin'])->name('admin.accounts');
    Route::get('/user/accounts', [App\Http\Controllers\AccountController::class, 'index_user'])->name('user.accounts');
});