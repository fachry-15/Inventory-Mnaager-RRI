<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengambilanControllers;
use App\Http\Controllers\PindahBarangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan');
Route::post('/update-ruang/{id}', [RuanganController::class, 'update'])->name('update.ruang');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/barang', [BarangController::class, 'index'])->name('barang');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/pindahbarang', [PindahBarangController::class, 'index'])->name('pindahbarang');
Route::get('/pemindahan', [PengambilanControllers::class, 'index'])->name('pemindahan');
Route::get('/pemindahanmanual', [PengambilanControllers::class, 'pengambilanmanual'])->name('pemindahanmanual');
// routes/web.php
Route::get('/generate-qrcode/{kode}', [BarangController::class, 'generateQRCode']);




require __DIR__ . '/auth.php';

Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
