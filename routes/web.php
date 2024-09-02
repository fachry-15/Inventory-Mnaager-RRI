<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KaryawanControllers;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KembalikanControllers;
use App\Http\Controllers\PdfController;
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
Route::post('/pemindahanmanual', [PengambilanControllers::class, 'store'])->name('pemindahanmanual.store');
Route::get('/karyawan', [KaryawanControllers::class, 'index'])->name('karyawan');
// routes/web.php
Route::get('/generate-qrcode/{kode}', [BarangController::class, 'generateQRCode']);
Route::get('/pemindahanotomatis', [PengambilanControllers::class, 'pengambilanotomatis'])->name('pemindahanotomatis');
Route::post('/scan', [PengambilanControllers::class, 'scan'])->name('scan');
Route::delete('/item/{id}', [PengambilanControllers::class, 'destroy'])->name('peminjaman.destroy');
Route::get('/pengembalian', [KembalikanControllers::class, 'index'])->name('pengembalian');
Route::get('/pengembalianotomatis', [KembalikanControllers::class, 'kembalikanotomatis'])->name('pengembalianotomatis');
Route::post('/update-status', [KembalikanControllers::class, 'updateStatus'])->name('update.status');


Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::post('/karyawan/tambah', [KaryawanControllers::class, 'store'])->name('buatakun');
Route::post('/karyawan/store', [KaryawanControllers::class, 'store'])->name('tambahkaryawan');
Route::post('/karyawan/{id}', [KaryawanControllers::class, 'update'])->name('karyawan.update');
Route::delete('/karyawan/{id}', [KaryawanControllers::class, 'destroy'])->name('karyawan.destroy');
Route::get('/export-pdf', [PdfController::class, 'generatePDF'])->name('export.pdf');

require __DIR__ . '/auth.php';
