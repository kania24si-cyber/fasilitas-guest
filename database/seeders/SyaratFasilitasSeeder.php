<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SyaratFasilitas;
use App\Models\FasilitasUmum;
use Faker\Factory as Faker;

class SyaratFasilitasSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan Faker
        $faker = Faker::create('id_ID');

        // Ambil semua fasilitas
        $fasilitas = FasilitasUmum::all();

        // Buat data syarat fasilitas
        foreach ($fasilitas as $f) {
            // Menambahkan beberapa syarat untuk setiap fasilitas
            foreach (range(1, 3) as $i) {  // Menambahkan 3 syarat untuk setiap fasilitas
                SyaratFasilitas::create([
                    'fasilitas_id' => $f->fasilitas_id,
                    'nama_syarat' => $this->generateNamaSyarat($faker),
                    'deskripsi' => $faker->sentence(10), // Menggunakan Faker untuk deskripsi syarat
                ]);
            }
        }
    }

    // Fungsi untuk menghasilkan nama syarat acak
    private function generateNamaSyarat($faker)
    {
        $syaratNames = [
            'Surat Permohonan',
            'KTP Pemohon',
            'Surat Pengantar',
            'Surat Keputusan',
            'Bukti Pembayaran',
            'Foto Lokasi',
            'Sertifikat Asli',
        ];

        // Menggunakan Faker untuk memilih nama syarat secara acak
        return $faker->randomElement($syaratNames);
    }
}

