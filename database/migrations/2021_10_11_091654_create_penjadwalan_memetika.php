<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjadwalanMemetika extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjadwalan_memetika', function (Blueprint $table) {
            $table->id('id_penjadwalan_memetika');
            $table->unsignedBigInteger('id_pegawai');
            $table->unsignedBigInteger('id_piket');
            $table->string('kode_piket');
            $table->date('tanggal_penjadwalan');
            $table->dateTime('tanggal_pembuatan_jadwal');
            $table->foreign('id_pegawai')->references('id_pegawai')->on('pegawais');
            $table->foreign('id_piket')->references('id_piket')->on('pikets');
            $table->string('nilai_fitness');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjadwalan_memetika');
    }
}
