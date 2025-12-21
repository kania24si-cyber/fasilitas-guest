<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman_fasilitas', function (Blueprint $table) {
            $table->increments('pinjam_id');
            $table->unsignedBigInteger('warga_id');
            $table->unsignedBigInteger('fasilitas_id'); // Pastikan tipe data sama

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('tujuan', 200);
            $table->enum('status', ['pending', 'disetujui', 'lunas', 'ditolak'])->default('pending');
            $table->decimal('total_biaya', 15, 2)->nullable();

            $table->timestamps();

            // Foreign Key: warga
            $table->foreign('warga_id')
                  ->references('warga_id')
                  ->on('warga')
                  ->onDelete('cascade');

            // Foreign Key: fasilitas
            $table->foreign('fasilitas_id')
                  ->references('fasilitas_id')
                  ->on('fasilitas_umum')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman_fasilitas');
    }
};