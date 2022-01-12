<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPerhitunganGenetikasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_perhitungan_genetikas', function (Blueprint $table) {
            $table->datetime('tanggal_pembuatan_jadwal');
            $table->float('selisih_waktu', 5, 5);
            $table->integer('jumlah_populasi');
            $table->integer('jumlah_generasi');
            $table->float('crossover_rate', 5, 5);
            $table->float('mutation_rate', 5, 5);
            $table->integer('data_total');
            $table->integer('nilai_fitness_tiga');
            $table->integer('nilai_fitness_dua');
            $table->integer('nilai_fitness_satu');
            $table->integer('nilai_fitness_nol');
            $table->integer('nilai_fitness_min_satu');
            $table->integer('nilai_fitness_kosong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_perhitungan_genetikas');
    }
}
