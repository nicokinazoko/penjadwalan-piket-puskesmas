<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjadwalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjadwalans', function (Blueprint $table) {
            $table->id('id_penjadwalans');
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_piket');
            $table->date('tanggal_penjadwalan');

            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais');
            $table->foreign('id_piket')->references('id_piket')->on('pikets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjadwalans');
    }
}
