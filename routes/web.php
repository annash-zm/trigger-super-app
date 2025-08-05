<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FasilitatorController;
use App\Http\Controllers\PendampingController;
use App\Http\Controllers\PrapemicuanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->middleware('isAuth');
//Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'loginProcess']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('isLogin:pendamping')->group(function () {
    Route::get('/pendamping', [PendampingController::class, 'index'])
        ->name('pendamping');
    Route::get('/pra-pemicuan', [PendampingController::class, 'listKegiatan'])
        ->name('pendamping.listkegiatan');
    Route::get('/kategori-pemicuan/{id}', [PendampingController::class, 'selectInputPemicuan'])
        ->name('pendamping.kategoripemicuan');

    //Form Pra Pemicuan
    Route::get('/info-desa/{id}', [PendampingController::class, 'infodesa'])
        ->name('pendamping.infodesa');
    Route::get('/info-kelola-sampah/{id}', [PendampingController::class, 'infoKelolaSampah'])
        ->name('pendamping.infoKelolaSampah');
    Route::get('/pendanaan/{id}', [PendampingController::class, 'pendanaan'])
        ->name('pendamping.pendanaan');
    Route::get('/info-umum/{id}', [PendampingController::class, 'infoumum'])
        ->name('pendamping.infoumum');
});

//Fasilitator
Route::middleware('isLogin:fasilitator')->group(function () {
    Route::get('/fasilitator', [FasilitatorController::class, 'index'])->name('fasilitator');
    Route::get('/fasilitator/list-desa', [FasilitatorController::class, 'listdesa'])
        ->name('fasilitator.listdesa');
    Route::get('/fasilitator/input-hasil/{id}', [FasilitatorController::class, 'tohasilpemicuan'])
        ->name('fasilitator.hasilpemicuan');
});

//Admin
Route::middleware('isLogin:Admin')->group(function () {
    //dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    //users
    Route::get('/admin/pendamping', [AdminController::class, 'pendamping'])
        ->name('admin.pendamping');
    Route::get('/admin/fasilitator', [AdminController::class, 'fasilitator'])
        ->name('admin.fasilitator');
    Route::get('/admin/userAdmin', [AdminController::class, 'userAdmin'])
        ->name('admin.userAdmin');

    //form pra pemicuan
    Route::get('/admin/pra-pemicuan', [AdminController::class, 'pra_pemicuan'])
        ->name('admin.pra-pemicuan');
});

//routes access post data
Route::middleware('auth')->group(function () {
    Route::post('/addPemicuan', [PrapemicuanController::class, 'addPemicuan']);
    Route::post('/upload-dokumentasi', [PrapemicuanController::class, 'uploadDokumentasi']);

    //crud via admin page
    Route::post('/addUser', [AdminController::class, 'addUser']);
    Route::post('/getUser', [AdminController::class, 'getUser']);
    Route::post('/deleteUser', [AdminController::class, 'deleteUser']);

    //add pra pemicuan data
    Route::post('/admin/importprapemicuan', [PrapemicuanController::class, 'importPraPemicuan']);

    //pendamping
    Route::post('/pendamping/saveInfoUmum', [PendampingController::class, 'saveInfoUmum']);
    Route::post('/pendamping/saveInfoDesa', [PendampingController::class, 'saveInfoDesa']);
    Route::post('/pendamping/saveKelolaSampah', [PendampingController::class, 'saveKelolaSampah']);
    Route::post('/pendamping/saveInfoDana', [PendampingController::class, 'saveInfoDana']);
    Route::get('/pendamping/villageView', [PendampingController::class, 'villageView']);
    Route::post('/pendamping/delFotoSpot', [PendampingController::class, 'delFotoSpot']);


    //fasilitator
    Route::post('/fasilitator/hasilPemicuan', [FasilitatorController::class, 'hasilPemicuan']);
    Route::get('/fasilitator/search_desa', [FasilitatorController::class, 'search']);
    Route::post('/fasilitator/deleteFile', [FasilitatorController::class, 'deleteFile']);
});

Route::get('/todistrict', [PendampingController::class, 'todistrict']);
