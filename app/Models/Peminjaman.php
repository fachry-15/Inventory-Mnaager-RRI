<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'status_peminjaman', 'kegiatan', 'tanggal_peminjaman', 'mulai_acara', 'selesai_acara'];

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'kode_barang');
    }
}
