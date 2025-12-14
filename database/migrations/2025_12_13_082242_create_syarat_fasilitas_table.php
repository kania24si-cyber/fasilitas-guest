<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyaratFasilitasTable extends Migration
{
    public function up()
    {
        Schema::create('syarat_fasilitas', function (Blueprint $table) {
            $table->id('syarat_id');
            $table->unsignedBigInteger('fasilitas_id');
            $table->string('nama_syarat');
            $table->text('deskripsi');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('fasilitas_id')->references('fasilitas_id')->on('fasilitas_umum')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('syarat_fasilitas');
    }
}

