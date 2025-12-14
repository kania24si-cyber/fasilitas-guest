<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranFasilitasTable extends Migration
{
    public function up()
    {
        Schema::create('pembayaran_fasilitas', function (Blueprint $table) {
            $table->id('bayar_id');
            $table->unsignedBigInteger('pinjam_id');
            $table->date('tanggal');
            $table->decimal('jumlah', 15, 2); // Untuk jumlah pembayaran
            $table->string('metode');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pinjam_id')->references('pinjam_id')->on('peminjaman_fasilitas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran_fasilitas');
    }
}
