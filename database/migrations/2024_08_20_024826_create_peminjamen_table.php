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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id'); // Ubah tipe data menjadi string
            $table->foreign('barang_id')->references('kode_barang')->on('barangs')->onDelete('cascade');
            $table->string('status_peminjaman');
            $table->string('kegiatan');
            $table->date('tanggal_peminjaman');
            $table->string('mulai_acara');
            $table->string('selesai_acara');
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
        Schema::dropIfExists('peminjamen');
    }
};
