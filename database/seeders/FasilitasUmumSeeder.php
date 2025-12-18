<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FasilitasUmumSeeder extends Seeder
{
    // Fungsi untuk menjalankan seeder
    public function run()
    {
        // Membuat objek Faker dengan lokal Indonesia
        $faker = Faker::create('id_ID');  

        // Loop untuk memasukkan data ke dalam tabel fasilitas_umum
        foreach (range(1, 100) as $i) {
            DB::table('fasilitas_umum')->insert([
                'nama'      => $faker->randomElement([
                    'Aula Desa', 'Lapangan', 'Balai RW', 'Perpustakaan', 'Ruang Publik', 'Pusat Olahraga'
                ]),  // Nama fasilitas yang dihasilkan secara acak
                'jenis'     => $faker->randomElement([
                    'Ruang Publik', 'Olahraga', 'Kesehatan', 'Pendidikan'
                ]),  // Jenis fasilitas yang dihasilkan secara acak
                'alamat'    => $faker->streetAddress,  // Alamat yang dihasilkan acak
                'rt'        => $faker->numberBetween(1, 10),  // Nomor RT acak (1-10)
                'rw'        => $faker->numberBetween(1, 5),   // Nomor RW acak (1-5)
                'kapasitas' => $faker->numberBetween(10, 300),  // Kapasitas yang dihasilkan acak (10-300 orang)
                'deskripsi' => $this->generateDescription($faker),  // Deskripsi dalam bahasa Indonesia
                'created_at' => now(),  // Waktu pembuatan data
                'updated_at' => now(),  // Waktu pembaruan data
            ]);
        }
    }

    // Fungsi untuk menghasilkan deskripsi dalam bahasa Indonesia
    private function generateDescription($faker)
    {
        $jenis = $faker->randomElement(['Ruang Publik', 'Olahraga', 'Kesehatan', 'Pendidikan']);
        
        switch ($jenis) {
            case 'Ruang Publik':
                return 'Fasilitas ini adalah ruang publik yang dapat digunakan untuk berbagai kegiatan masyarakat, seperti pertemuan atau acara komunitas.';
            case 'Olahraga':
                return 'Fasilitas olahraga ini menyediakan berbagai sarana untuk berolahraga, seperti lapangan futsal, tenis, dan lainnya.';
            case 'Kesehatan':
                return 'Fasilitas ini merupakan tempat pelayanan kesehatan untuk masyarakat, seperti puskesmas atau klinik desa.';
            case 'Pendidikan':
                return 'Fasilitas pendidikan ini digunakan untuk kegiatan belajar mengajar, seperti ruang kelas atau pusat belajar masyarakat.';
            default:
                return 'Deskripsi fasilitas umum yang bisa digunakan untuk berbagai kegiatan yang mendukung kehidupan sosial masyarakat.';
        }
    }
}
