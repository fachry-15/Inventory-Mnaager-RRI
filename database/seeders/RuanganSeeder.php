<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruangans = [
            ['nama_ruang' => 'Ruang A', 'kode_ruang' => 'A001', 'lantai' => '1'],
            ['nama_ruang' => 'Ruang B', 'kode_ruang' => 'B002', 'lantai' => '2'],
            ['nama_ruang' => 'Ruang C', 'kode_ruang' => 'C003', 'lantai' => '3'],
            ['nama_ruang' => 'Ruang D', 'kode_ruang' => 'D004', 'lantai' => '4'],
            // Tambahkan ruangan lainnya sesuai kebutuhan
        ];

        DB::table('ruangans')->insert($ruangans);
    }
}
