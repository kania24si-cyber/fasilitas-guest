<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('fasilitas_umum', function (Blueprint $table) {
        $table->id('fasilitas_id');
        $table->string('nama');
        $table->string('jenis'); 
        $table->string('alamat');
        $table->string('rt')->nullable();
        $table->string('rw')->nullable();
        $table->integer('kapasitas')->nullable();
        $table->text('deskripsi')->nullable();
        $table->string('media')->nullable(); // Foto / SOP
        $table->timestamps();
    });
}
};