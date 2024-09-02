<?php

namespace App\Imports;

use App\Models\barang;
use App\Models\Kategori;
use App\Models\ruangan;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class BarangImport implements ToModel, WithValidation
{
    public function model(array $row)
    {
        // Validasi apakah kategori_id dan ruangan_id ada dalam database
        $kategori = Kategori::find($row[2]);
        $ruangan = ruangan::find($row[3]);

        if (!$kategori || !$ruangan) {
            // Jika kategori_id atau ruangan_id tidak valid, data tidak akan diinput
            return null;
        }

        return new Barang([
            'nama_barang' => $row[0],
            'kode_barang' => $row[1],
            'kategori_id' => $row[2],
            'ruangan_id' => $row[3],
            'bukti_gambar' => $row[4],
            'tanggal_masuk' => $row[5],
            'tanggal_maintenace' => $row[6],
            'tanggal_kadaluarsa' => $row[7],
        ]);
    }

    // Opsi tambahan: Validasi untuk memastikan kategori_id dan ruangan_id adalah integer
    public function rules(): array
    {
        return [
            '2' => ['required', 'integer', Rule::exists('kategoris', 'id')],
            '3' => ['required', 'integer', Rule::exists('ruangans', 'id')],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '2.exists' => 'Kategori ID tidak valid.',
            '3.exists' => 'Ruangan ID tidak valid.',
        ];
    }
}
