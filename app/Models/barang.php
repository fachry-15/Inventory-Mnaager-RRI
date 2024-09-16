<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_barang', 'kode_barang', 'merek', 'ruangan_id', 'kategori_id', 'bukti_gambar', 'tanggal_masuk', 'lokasi', 'sumber_barang', 'lampiran', 'status'];


    public function ruangans()
    {
        return $this->belongsTo(ruangan::class, 'ruangan_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
