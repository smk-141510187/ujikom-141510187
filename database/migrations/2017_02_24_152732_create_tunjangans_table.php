<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTunjangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tunjangans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_tunjangan')->unique();
            $table->string('status');
            $table->integer('jumlah_anak');
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
        Schema::dropIfExists('tunjangans');
    }
}
