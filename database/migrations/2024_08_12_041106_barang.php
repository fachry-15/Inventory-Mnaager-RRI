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
            $table->string('merek');
            $table->string('tipe');
            $table->string('kode_barang')->unique();
            $table->string('Processor')->nullable();
            $table->integer('RAM')->nullable();
            $table->integer('Storage')->nullable();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('penanggung_jawab')->nullable();
            $table->foreignId('ruangan_id')->constrained('ruangans')->onDelete('cascade');
            $table->string('bukti_gambar')->nullable();
            $table->date('tanggal_masuk');
            $table->integer('Tahun_perolehan')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('lokasi');
            $table->string('sumber_barang');
            $table->string('lampiran')->nullable();
            $table->integer('status')->nullable();
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
