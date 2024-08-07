<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\MuridController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('index');
});

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->middleware('role:admin')->group( function (){
        Route::resource('murid', MuridController::class);
        Route::resource('mitra', MitraController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('magang', MagangController::class);
        Route::get('/laporan', [MagangController::class, 'dataMagang'])->name('data-magang');
        Route::get('/get-guru', [MitraController::class, 'getGuru'])->name('get-guru');
        Route::get('/get-mitra', [MagangController::class, 'getMitra'])->name('get-mitra');
        Route::get('/get-siswa', [MagangController::class, 'getSiswa'])->name('get-siswa');
        Route::get('magang/create-from-mitra/{id?}', [MagangController::class, 'createFromMitra'])->name('magang.create-from-mitra');
        Route::get('kurangi-kuota', [MagangController::class, 'kurangiKuota'])->name('kurangi.kuota');
        Route::get('laporan/magang/{id?}', [MagangController::class, 'show'])->name('laporan.show');
    });
});
Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->middleware('role:siswa')->group( function (){
        Route::get('informasi-magang', [MuridController::class, 'infoMagangSiswa'])->name('infoMagang.siswa');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pendaftaran', [MuridController::class, 'daftar'])->name('murid.pendaftaran');
Route::post('/daftar', [MuridController::class, 'pendaftaran'])->name('daftar.murid');