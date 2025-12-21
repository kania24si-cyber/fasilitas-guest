<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PeminjamanFasilitas;
use App\Models\PembayaranFasilitas;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PembayaranFasilitasSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan Faker untuk menghasilkan data palsu dengan lokal Indonesia
        $faker = Faker::create('id_ID');  // Menggunakan lokal Indonesia agar data yang dihasilkan sesuai format Indonesia

        // Mengambil semua data peminjaman fasilitas
        $peminjaman = PeminjamanFasilitas::all();

        // Membuat data pembayaran fasilitas untuk setiap peminjaman
        foreach ($peminjaman as $p) {
            // Menambahkan beberapa pembayaran untuk setiap peminjaman
            foreach (range(1, 3) as $i) {  // Menambahkan 3 pembayaran untuk setiap peminjaman
                PembayaranFasilitas::create([
                    'pinjam_id' => $p->pinjam_id,  // ID peminjaman
                    'tanggal' => $faker->dateTimeThisYear()->format('Y-m-d'),  // Menghasilkan tanggal pembayaran
                    'jumlah' => $faker->numberBetween(0, 500000), // Menghasilkan jumlah pembayaran antara 100.000 - 500.000
                    'metode' => $this->assignMetodePembayaran($faker), // Menentukan metode pembayaran
                    'keterangan' => $this->generateKeterangan($faker), // Menghasilkan keterangan pembayaran dalam kalimat acak dalam bahasa Indonesia
                ]);

                // Menyimpan resi pembayaran ke tabel media
                // Mengambil pembayaran yang baru saja dibuat
                $pembayaran = PembayaranFasilitas::latest()->first();

                // Menyimpan resi pembayaran jika ada file
                if ($faker->boolean(50)) {  // 50% kemungkinan ada resi
                    $this->saveResi($pembayaran, $faker);
                }
            }
        }
    }

    // Fungsi untuk memberikan metode pembayaran secara acak
    private function assignMetodePembayaran($faker)
    {
        // Daftar metode pembayaran dalam bahasa Indonesia
        $metodes = ['Transfer Bank', 'Tunai', 'E-wallet', 'Debit'];  
        return $faker->randomElement($metodes);  // Menghasilkan salah satu metode pembayaran secara acak
    }

    // Fungsi untuk menghasilkan keterangan dalam bahasa Indonesia
    private function generateKeterangan($faker)
    {
        // Keterangan acak yang lebih bermakna dalam bahasa Indonesia
        $keterangan = [
            'Pembayaran untuk peminjaman fasilitas yang dilakukan pada tanggal yang telah ditentukan.',
            'Pembayaran ini mencakup biaya peminjaman fasilitas untuk penggunaan dalam jangka waktu tertentu.',
            'Pembayaran ini dilakukan untuk memastikan peminjaman fasilitas yang telah diproses sebelumnya.',
            'Pembayaran ini mencakup biaya sewa fasilitas yang digunakan oleh peminjam.',
            'Pembayaran dilakukan dengan metode yang dipilih oleh peminjam untuk mempermudah transaksi.'
        ];

        return $faker->randomElement($keterangan);  // Menghasilkan salah satu keterangan acak dalam bahasa Indonesia
    }

    // Fungsi untuk menyimpan resi ke tabel media
    private function saveResi($pembayaran, $faker)
    {
        // Jenis file yang akan diunggah sebagai resi
        $fileTypes = ['image', 'pdf', 'docx', 'xlsx'];  
        $fileType = $faker->randomElement($fileTypes);  // Memilih jenis file secara acak
        $fileName = 'resi_' . $faker->word . '.' . $fileType;  // Nama file acak

        // Menyimpan data resi ke dalam tabel media
        DB::table('media')->insert([
            'ref_table' => 'pembayaran_fasilitas',  // Tabel referensi
            'ref_id' => $pembayaran->bayar_id,  // ID referensi pembayaran
            'file_name' => $fileName,  // Nama file resi
            'mime_type' => $this->getMimeType($fileType),  // Menentukan MIME type berdasarkan ekstensi file
            'caption' => 'Resi Pembayaran',  // Keterangan file dalam bahasa Indonesia
            'sort_order' => 0,  // Urutan tampil file
            'created_at' => now(),  // Waktu pembuatan
            'updated_at' => now(),  // Waktu pembaruan
        ]);
    }

    // Fungsi untuk menentukan MIME type berdasarkan ekstensi file
    private function getMimeType($fileType)
    {
        // Menentukan MIME type berdasarkan ekstensi file
        switch ($fileType) {
            case 'pdf':
                return 'application/pdf';  // PDF
            case 'image':
                return 'image/jpeg';  // Menyimpan sebagai gambar JPEG
            case 'docx':
                return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';  // DOCX
            case 'xlsx':
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';  // XLSX
            default:
                return 'application/octet-stream';  // Default MIME type
        }
    }
}
