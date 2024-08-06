<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['nama_kategori' => 'Elektronik'],
            ['nama_kategori' => 'Pakaian'],
            ['nama_kategori' => 'Makanan'],
            ['nama_kategori' => 'Furnitur'],
            // Tambahkan kategori lainnya sesuai kebutuhan
        ];

        DB::table('kategoris')->insert($categories);
    }
}
