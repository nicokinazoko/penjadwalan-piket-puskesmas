<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama_pegawai');
            $table->unsignedBigInteger('id_jenis_kelamin');
            $table->unsignedBigInteger('id_jabatan');

            $table->foreign('id_jenis_kelamin')->references('id_jenis_kelamin')->on('jenis_kelamins');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
