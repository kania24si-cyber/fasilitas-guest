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
    Schema::create('media', function (Blueprint $table) {
        $table->id('media_id');
        $table->string('ref_table');        // contoh: fasilitas_umum, peminjaman_fasilitas
        $table->unsignedBigInteger('ref_id');
        $table->string('file_name');        // nama file yang disimpan
        $table->string('caption')->nullable();
        $table->string('mime_type')->nullable();
        $table->integer('sort_order')->default(0);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('media');
}
};