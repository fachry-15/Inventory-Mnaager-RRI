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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id');
            $table->foreign('barang_id')->references('kode_barang')->on('barangs')->onDelete('cascade');
            $table->string('RuanganAwal');
            $table->string('RuanganTujuan');
            $table->string('PenanggungJawab');
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
        Schema::dropIfExists('log_aktivitas');
    }
};
