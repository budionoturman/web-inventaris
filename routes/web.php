<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KondisiBarangController;
use App\Http\Controllers\Pdf\PdfController;
use App\Http\Controllers\Pegawai\PegawaiPeminjamanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\Select\SelectController;
use App\Http\Controllers\UserController;
use App\Models\Pengadaan;
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

// route authentication
Route::get('login', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::post('login', [AuthController::class, 'authentication']);
Route::post('logout',[AuthController::class, 'logout']);


// route dashboard
Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index']);

    Route::resource('users', UserController::class);
    Route::resource('/jurusans', JurusanController::class);
    Route::resource('/kategoris', KategoriController::class);
    Route::resource('/barangs', BarangController::class);
    
    Route::get('/stoks', [BarangController::class, 'stok']);

    Route::resource('/peminjams', PeminjamanController::class);
    Route::any('/proses/{id}',[PeminjamanController::class, 'proses']);
    Route::any('/batalkan/{id}',[PeminjamanController::class, 'batalkan']);

    Route::get('pengembalians', [PengembalianController::class, 'index']);
    Route::any('kembalikan/{id}',[PengembalianController::class, 'kembalikan']);
    Route::any('storekembali', [PengembalianController::class, 'storekembali']);
    Route::get('history', [PengembalianController::class, 'history']);

    Route::get('kondisi-barangs', [KondisiBarangController::class, 'index']);
    Route::get('kondisi-barangs/{id}/perbaikan', [KondisiBarangController::class, 'perbaikan']);
    Route::put('kondisi-barangs/{id}', [KondisiBarangController::class, 'saveperbaikan']);
    Route::get('kondisi-barangs/{id}/tidak-perbaikan', [KondisiBarangController::class, 'tidakperbaikan']);
    Route::put('kondisi-barangs/{id}/tambah-pengadaan', [KondisiBarangController::class, 'pengadaan']);

    Route::get('pengadaans', [PengadaanController::class, 'index']);
    Route::get('pengadaans/create', [PengadaanController::class, 'create']);
    Route::post('pengadaans', [PengadaanController::class, 'store']);
    Route::get('pengadaans/{id}', [PengadaanController::class, 'show']);
    Route::post('pengadaans/setujui/{id}', [PengadaanController::class, 'setujui']);
    Route::post('pengadaans/tolak/{id}', [PengadaanController::class, 'tolak']);  
    Route::get('histories/pengadaan', [PengadaanController::class, 'history']);

    //Route Pdf//
    Route::get('pengadaans/cetak/{id}', [PdfController::class, 'cetakPengadaan']);
    Route::get('/barangs-cetak', [PdfController::class, 'cetakbarangs']); 
});

// route pegawai

Route::middleware('auth')->group(function() {
    Route::resource('pegawai/peminjams', PegawaiPeminjamanController::class);
    Route::get('pegawai/history', [PegawaiPeminjamanController::class, 'history']);
});

// selectpicker
Route::get('/getrole', [SelectController::class, 'getrole']);
Route::get('/getjurusan', [SelectController::class, 'getjurusan']);
Route::get('/getkategori', [SelectController::class, 'getkategori']);
Route::get('/getpegawai', [SelectController::class, 'getpegawai']);
Route::get('/getbarang', [SelectController::class, 'getbarang']);
