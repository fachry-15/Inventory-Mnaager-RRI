<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'status_peminjaman'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'kode_barang');
    }
}
