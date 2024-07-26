<?php

use Illuminate\Support\Facades\Route;

//admin Controller
use App\Http\Controllers\admin\indexAdmin;
use App\Http\Controllers\admin\profileAdmin;
use App\Http\Controllers\auth\authAdmin;
use App\Http\Controllers\admin\usersAdmin;
use App\Http\Controllers\admin\pengemudiAdmin;
use App\Http\Controllers\admin\kendaraanAdmin;
use App\Http\Controllers\admin\permintaanAdmin;

//pages Controller
use App\Http\Controllers\pages\indexController;
use App\Http\Controllers\pages\layananController;
use App\Http\Controllers\pages\permintaan\pegawaiController;
use App\Http\Controllers\pages\permintaan\eselonController;
use App\Http\Controllers\pages\permintaan\tamuController;
use App\Http\Controllers\pages\permintaan\wapresController;
use App\Http\Controllers\auth\authUser;
use App\Http\Controllers\auth\authPengemudi;
use App\Http\Controllers\pages\profileUser;
use App\Http\Controllers\PengemudiController;

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
Route::get('/', [authUser::class, 'showLoginForm'])->name('login');
Route::post('/store', [authUser::class, 'login'])->name('pages.index.store');
Route::post('/login', [authUser::class, 'login'])->name('login.post');
// Route::get('/login', [authUser::class, 'index'])->name('login'); // Pastikan ada route ini
// Route::get('/pengemudi/login', [authPengemudi::class, 'index'])->name('pengemudi.login'); // Route login pengemudi
Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/dashboard', [indexController::class, 'dashboard'])->middleware('auth')->name('pages.dashboard');
    Route::get('/history', [indexController::class, 'history'])->middleware('auth')->name('pages.history');
    Route::get('/detail/{id_permintaan}', [indexController::class, 'detail'])->middleware('auth')->name('pages.detail');
    Route::post('/detail/{id_permintaan}/review', [indexController::class, 'storeReview'])->middleware('auth')->name('permintaan.review.store');
    Route::get('/detail/{id_permintaan}/cancel', [indexController::class, 'cancel'])->middleware('auth')->name('permintaan.cancel');   
    Route::get('/layanan', [indexController::class, 'layanan'])->name('pages.layanan');
    Route::get('/layanan/pegawai', [pegawaiController::class, 'index'])->name('layanan.pegawai');
    Route::post('/layanan/pegawai/store', [pegawaiController::class, 'store'])->name('layanan.pegawai.store');
    Route::get('/layanan/eselon', [eselonController::class, 'index'])->name('layanan.eselon');
    Route::post('/layanan/eselon/store', [eselonController::class, 'store'])->name('layanan.eselon.store');
    Route::get('/layanan/tamu', [tamuController::class, 'index'])->name('layanan.tamu');
    Route::post('/layanan/tamu/store', [tamuController::class, 'store'])->name('layanan.tamu.store');
    Route::get('/layanan/wapres', [wapresController::class, 'index'])->name('layanan.wapres');
    Route::post('/layanan/wapres/store', [wapresController::class, 'store'])->name('layanan.wapres.store');

    // profile routeing
    Route::get('/profile', [profileUser::class, 'index'])->name('pages.profile');
    Route::get('/profile/edit', [profileUser::class, 'edit'])->middleware('auth')->name('pages.editprofile');
    Route::post('/profile/update', [profileUser::class, 'update'])->middleware('auth')->name('pages.profile.update');

    Route::post('/logout', [authUser::class, 'logout'])->name('logout.user');

});

// route pengemudi
Route::group(['middleware' => 'auth:pengemudi'], function () {
    Route::get('/dashboard/pengemudi', [PengemudiController::class, 'index'])->name('pengemudi.dashboard');
    Route::get('/pengemudi/history', [PengemudiController::class, 'history'])->middleware('auth')->name('pengemudi.history');
    Route::get('/permintaan/{id_permintaan}/detail', [PengemudiController::class, 'show'])->middleware('auth')->name('pengemudi.detail');
    Route::post('/permintaan/{id_permintaan}/update-status', [PengemudiController::class, 'updateStatus'])->name('pengemudi.permintaan.updateStatus');
    
    Route::post('/pengemudi/logout', [authPengemudi::class, 'logout'])->name('logout.pengemudi');
});

//route admin
Route::get('/admin/login', [authAdmin::class, 'login'])->name('admin.login');
Route::post('/admin/login/store', [authAdmin::class, 'loginPost'])->name('admin.login.store');
Route::group(['prefix' => 'admin',  'middleware' => 'auth:admin'], function () {
    Route::get('/dashboard', [indexAdmin::class, 'index'])->name('admin.index');
    // profile routeing
    Route::get('/profile', [profileAdmin::class, 'index'])->name('admin.profile');

    // users menu routing
    Route::get('/dashboard/users', [usersAdmin::class, 'index'])->name('admin.users');
    Route::get('/dashboard/users/tambah', [usersAdmin::class, 'create'])->name('admin.users.create');
    Route::post('/dashboard/users/tambah/store', [usersAdmin::class, 'store'])->name('admin.users.create.store');
    Route::get('/dashboard/users/ubah/{id}', [usersAdmin::class, 'edit'])->name('admin.users.edit');
    Route::put('/dashboard/users/perbarui/{id}', [usersAdmin::class, 'update'])->name('admin.users.update');
    Route::get('/dashboard/users/detail/{id}', [usersAdmin::class, 'show'])->name('admin.users.detail');
    Route::get('/dashboard/users/upload/editore', [usersAdmin::class, 'editor'])->name('admin.users.upload.editor');

    // pengemudi menu routing
    Route::get('/dashboard/pengemudi', [pengemudiAdmin::class, 'index'])->name('admin.pengemudi');
    Route::get('/dashboard/pengemudi/tambah', [pengemudiAdmin::class, 'create'])->name('admin.pengemudi.create');
    Route::post('/dashboard/pengemudi/tambah/store', [pengemudiAdmin::class, 'store'])->name('admin.pengemudi.create.store');
    Route::get('/dashboard/pengemudi/ubah/{id}', [pengemudiAdmin::class, 'edit'])->name('admin.pengemudi.edit');
    Route::put('/dashboard/pengemudi/perbarui/{id}', [pengemudiAdmin::class, 'update'])->name('admin.pengemudi.update');
    Route::get('/dashboard/pengemudi/detail/{id}', [pengemudiAdmin::class, 'show'])->name('admin.pengemudi.detail');
    Route::get('/dashboard/pengemudi/upload/editore', [pengemudiAdmin::class, 'editor'])->name('admin.pengemudi.upload.editor');

    // kendaraan menu routing
    Route::get('/dashboard/kendaraan', [kendaraanAdmin::class, 'index'])->name('admin.kendaraan');
    Route::get('/dashboard/kendaraan/tambah', [kendaraanAdmin::class, 'create'])->name('admin.kendaraan.create');
    Route::post('/dashboard/kendaraan/tambah/store', [kendaraanAdmin::class, 'store'])->name('admin.kendaraan.create.store');
    Route::get('/dashboard/kendaraan/ubah/{id}', [kendaraanAdmin::class, 'edit'])->name('admin.kendaraan.edit');
    Route::put('/dashboard/kendaraan/perbarui/{id}', [kendaraanAdmin::class, 'update'])->name('admin.kendaraan.update');
    Route::get('/dashboard/kendaraan/detail/{id}', [kendaraanAdmin::class, 'show'])->name('admin.kendaraan.detail');
    Route::get('/dashboard/kendaraan/upload/editore', [kendaraanAdmin::class, 'editor'])->name('admin.kendaraan.upload.editor');

    // permintaan menu routing
    Route::get('/dashboard/permintaan', [permintaanAdmin::class, 'index'])->name('admin.permintaan');
    Route::get('/dashboard/permintaan/tambah', [permintaanAdmin::class, 'create'])->name('admin.permintaan.create');
    Route::post('/dashboard/permintaan/tambah/store', [permintaanAdmin::class, 'store'])->name('admin.permintaan.create.store');
    Route::get('/dashboard/permintaan/ubah/{id}', [permintaanAdmin::class, 'edit'])->name('admin.permintaan.edit');
    Route::put('/dashboard/permintaan/perbarui/{id}', [permintaanAdmin::class, 'update'])->name('admin.permintaan.update');
    Route::get('/dashboard/permintaan/detail/{id}', [permintaanAdmin::class, 'show'])->name('admin.permintaan.detail');
    Route::get('/dashboard/permintaan/upload/editore', [permintaanAdmin::class, 'editor'])->name('admin.permintaan.upload.editor');
    Route::get('/dashboard/permintaan/reports', [indexAdmin::class, 'permintaanReport'])->name('admin.reports.permintaan');
    Route::get('/dashboard/permintaan/reports/permintaan/export', [indexAdmin::class, 'exportPermintaanToCSV'])->name('admin.reports.permintaan.export');

    Route::get('/logout', [indexAdmin::class, 'logout'])->name('admin.logout');
});