<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'kode_barang', 'jumlah_barang', 'satuan_barang', 'kategori_barang', 'ruangan_id', 'bukti_gambar', 'tanggal_masuk', 'tanggal_maintenace'];
}
