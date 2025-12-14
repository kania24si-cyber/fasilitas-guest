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
        // Menggunakan Faker
        $faker = Faker::create('id_ID');

        // Ambil semua peminjaman fasilitas
        $peminjaman = PeminjamanFasilitas::all();

        // Buat data pembayaran fasilitas
        foreach ($peminjaman as $p) {
            // Menambahkan beberapa pembayaran untuk setiap peminjaman
            foreach (range(1, 3) as $i) {  // Menambahkan 3 pembayaran untuk setiap peminjaman
                PembayaranFasilitas::create([
                    'pinjam_id' => $p->pinjam_id,
                    'tanggal' => $faker->dateTimeThisYear()->format('Y-m-d'),
                    'jumlah' => $faker->randomFloat(2, 100000, 500000), // Menggunakan Faker untuk jumlah pembayaran
                    'metode' => $this->assignMetodePembayaran($faker), // Menggunakan Faker untuk memilih metode pembayaran
                    'keterangan' => $faker->sentence(6), // Menggunakan Faker untuk keterangan
                ]);

                // Menyimpan resi ke tabel media
                // Ambil pembayaran yang baru saja dibuat
                $pembayaran = PembayaranFasilitas::latest()->first();

                // Menyimpan resi pembayaran jika ada file
                if ($faker->boolean(50)) { // 50% kemungkinan ada resi
                    $this->saveResi($pembayaran, $faker);
                }
            }
        }
    }

    // Fungsi untuk memberi metode pembayaran acak
    private function assignMetodePembayaran($faker)
    {
        $metodes = ['Transfer Bank', 'Tunai', 'E-wallet', 'Debit'];
        return $faker->randomElement($metodes);
    }

    // Fungsi untuk menyimpan resi ke tabel media
    private function saveResi($pembayaran, $faker)
    {
        // Misalnya kita mengupload file acak untuk resi
        $fileTypes = ['image', 'pdf', 'docx', 'xlsx'];
        $fileType = $faker->randomElement($fileTypes);
        $fileName = 'resi_' . $faker->word . '.' . $fileType;

        DB::table('media')->insert([
            'ref_table' => 'pembayaran_fasilitas',
            'ref_id' => $pembayaran->bayar_id,
            'file_name' => $fileName,
            'mime_type' => $this->getMimeType($fileType),
            'caption' => 'Resi Pembayaran',
            'sort_order' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Fungsi untuk menentukan MIME type berdasarkan ekstensi file
    private function getMimeType($fileType)
    {
        switch ($fileType) {
            case 'pdf':
                return 'application/pdf';
            case 'image':
                return 'image/jpeg';  // Menyimpan sebagai image JPEG
            case 'docx':
                return 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            case 'xlsx':
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            default:
                return 'application/octet-stream';
        }
    }
}
