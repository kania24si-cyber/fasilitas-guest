<?php

// database/migrations/xxxx_xx_xx_create_petugas_fasilitas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetugasFasilitasTable extends Migration
{
    public function up()
    {
        Schema::create('petugas_fasilitas', function (Blueprint $table) {
            $table->id('petugas_id');
            $table->unsignedBigInteger('fasilitas_id');
            $table->unsignedBigInteger('petugas_warga_id');
            $table->string('peran');
            $table->timestamps();

            // Foreign keys
            $table->foreign('fasilitas_id')->references('fasilitas_id')->on('fasilitas_umum')->onDelete('cascade');
            $table->foreign('petugas_warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('petugas_fasilitas');
    }

};