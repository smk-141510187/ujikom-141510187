<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenggajiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggajians', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jumlah_jam_lembur');
            $table->integer('jumlah_uang_lembur');
            $table->integer('gaji_pokok');
            $table->integer('gaji_total');
            $table->date('tanggal_pengambilan')->nullable();
            $table->boolean('status_pengambilan')->default(0);
            $table->string('petugas_penerima');
            $table->UnsignedInteger('id_tunjangan_pegawai');
            $table->foreign('id_tunjangan_pegawai')->references('id')->on('tunjangan_pegawais')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('penggajians');
    }
}
