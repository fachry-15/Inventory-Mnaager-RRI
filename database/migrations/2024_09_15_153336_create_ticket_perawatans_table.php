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
        Schema::create('ticket_perawatans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ticket');
            $table->string('jenis_perawatan');
            $table->string('barang_id');
            $table->foreign('barang_id')->references('kode_barang')->on('barangs')->onDelete('cascade');
            $table->string('deskripsi_perawatan');
            $table->string('lampiran_file');
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
        Schema::dropIfExists('ticket_perawatans');
    }
};
