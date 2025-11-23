<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman_fasilitas', function (Blueprint $table) {

            // Primary Key
            $table->increments('pinjam_id');

            // Foreign Keys
            $table->unsignedInteger('warga_id');
            $table->unsignedInteger('fasilitas_id');

            // Data Peminjaman
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('tujuan', 200);
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->decimal('total_biaya', 10, 2)->nullable();
            $table->string('bukti_pembayaran')->nullable();

            $table->timestamps();

            // FOREIGN KEY: warga
            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->onDelete('cascade');

            // FOREIGN KEY: fasilitas
            $table->foreign('fasilitas_id')
                ->references('fasilitas_id')
                ->on('fasilitas_umum')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman_fasilitas');
    }
};
