<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKategoriLembursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_lemburs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_lembur')->unique();
            $table->integer('besaran_uang');
            $table->UnsignedInteger('id_jabatan');
            $table->foreign('id_jabatan')->references('id')->on('jabatans')->onDelete('CASCADE')->onUpdate('CASCADE');
            
            $table->UnsignedInteger('id_golongan');
            $table->foreign('id_golongan')->references('id')->on('golongans')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('kategori_lemburs');
    }
}
