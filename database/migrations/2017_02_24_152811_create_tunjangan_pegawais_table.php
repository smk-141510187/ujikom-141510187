<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTunjanganPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tunjangan_pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->UnsignedInteger('id_tunjangan');
            $table->foreign('id_tunjangan')->references('id')->on('tunjangans')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->UnsignedInteger('id_pegawai')->unique();
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
        Schema::dropIfExists('tunjangan_pegawais');
    }
}
