<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPerawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_ticket',
        'barang_id',
        'jenis_perawatan',
        'diagnosa',
        'deskripsi_perawatan',
        'lampiran_file'
    ];

    public function barang()
    {
        return $this->belongsTo(barang::class, 'barang_id', 'id');
    }
}
