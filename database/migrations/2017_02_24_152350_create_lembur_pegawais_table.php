<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLemburPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lembur_pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jumlah_jam');
            $table->UnsignedInteger('id_kategori_lembur');
            $table->foreign('id_kategori_lembur')->references('id')->on('kategori_lemburs')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->UnsignedInteger('id_pegawai');
            $table->foreign('id_pegawai')->references('id')->on('pegawais')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('lembur_pegawais');
    }
}
