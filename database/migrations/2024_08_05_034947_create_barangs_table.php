<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kode_barang')->unique();
            $table->integer('jumlah_barang');
            $table->string('satuan_barang');
            $table->string('kategori_barang');
            $table->string('penanggung_jawab')->nullable();
            $table->foreignId('ruangan_id')->constrained('ruangans')->onDelete('cascade');
            $table->string('bukti_gambar')->nullable();
            $table->date('tanggal_masuk');
            $table->date('tanggal_maintenace')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
