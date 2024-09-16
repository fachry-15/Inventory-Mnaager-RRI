<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Kategori;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd($row);

        // Mengambil data ruangan dan kategori berdasarkan nama di file Excel
        $ruangan = Ruangan::where('nama_ruang', $row['ruangan'])->first();
        $kategori = Kategori::where('nama_kategori', $row['kategori'])->first();

        // Pastikan ruangan dan kategori ditemukan
        if (!$ruangan || !$kategori) {
            throw new \Exception('Ruangan atau Kategori tidak ditemukan.');
        }

        // Generate kode barang otomatis
        $kodeBarang = 'BRG-' . time() . '-' . strtoupper(substr(md5(rand()), 0, 6));

        // Format tanggal
        $tanggalMasuk = now(); // Defaulting to current time if not provided
        $tanggalMaintenance = $row['tanggal_maintenance'] ? Carbon::createFromTimestamp($row['tanggal_maintenance'])->format('Y-m-d H:i:s') : null;

        // Simpan barang ke database
        $barang = Barang::create([
            'nama_barang'        => $row['nama_barang'],
            'merek'              => $row['merek_barang'], // Changed from 'merek' to 'merek_barang'
            'kode_barang'        => $kodeBarang,
            'ruangan_id'         => $ruangan->id,
            'kategori_id'        => $kategori->id,
            'penanggung_jawab'   => $row['nama_penanggung_jawb'], // Adjusted field name
            'tanggal_masuk'      => $tanggalMasuk,
            'tanggal_maintenace' => $tanggalMaintenance,
        ]);

        // Generate dan simpan barcode
        $qrCode = QrCode::format('png')->size(200)->generate($kodeBarang);
        $fileName = $kodeBarang . '.png';
        $path = public_path('barcodes/' . $fileName);
        file_put_contents($path, $qrCode);

        return $barang;
    }
}
