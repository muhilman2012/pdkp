<?php

use Illuminate\Support\Facades\Route;

//admin Controller
use App\Http\Controllers\admin\indexAdmin;
use App\Http\Controllers\admin\profileAdmin;
use App\Http\Controllers\auth\authAdmin;

//pages Controller
use App\Http\Controllers\pages\indexController;
use App\Http\Controllers\pages\layananController;
use App\Http\Controllers\auth\authUser;
use App\Http\Controllers\pages\profileUser;

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

//route user
Route::get('/', [authUser::class, 'index'])->name('pages.index');
Route::post('/store', [authUser::class, 'login'])->name('pages.index.store');
Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/dashboard', [indexController::class, 'dashboard'])->name('pages.dashboard');
    Route::get('/layanan', [indexController::class, 'layanan'])->name('pages.layanan');
    Route::get('/layanan/pegawai', [layananController::class, 'pegawai'])->name('layanan.pegawai');
    // profile routeing
    Route::get('/profile', [profileUser::class, 'index'])->name('pages.profile');

    Route::get('/logout', [indexController::class, 'logout'])->name('logout');
});

//route admin
Route::get('/admin/login', [authAdmin::class, 'login'])->name('admin.login');
Route::post('/admin/login/store', [authAdmin::class, 'loginPost'])->name('admin.login.store');
Route::group(['prefix' => 'admin',  'middleware' => 'auth:admin'], function () {
    Route::get('/dashboard', [indexAdmin::class, 'index'])->name('admin.index');
    // profile routeing
    Route::get('/profile', [profileAdmin::class, 'index'])->name('admin.profile');

    Route::get('/logout', [indexAdmin::class, 'logout'])->name('admin.logout');
});