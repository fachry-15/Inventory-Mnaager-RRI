<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'RuanganAwal',
        'RuanganTujuan',
        'PenanggungJawab'
    ];

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'kode_barang');
    }
}
