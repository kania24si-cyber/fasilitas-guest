<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');  // Menggunakan locale bahasa Indonesia

        foreach (range(1, 100) as $i) {
            DB::table('warga')->insert([
                'no_ktp'        => $faker->nik(),  // Menghasilkan nomor KTP Indonesia
                'nama'          => $faker->name(),  // Nama acak yang sesuai dengan format Indonesia
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),  // Jenis kelamin dalam bahasa Indonesia
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),  // Agama dalam bahasa Indonesia
                'pekerjaan'     => $faker->jobTitle(),  // Pekerjaan acak dalam bahasa Indonesia
                'telp'          => $faker->phoneNumber(),  // Nomor telepon acak sesuai format Indonesia
                'email'         => $faker->unique()->safeEmail(),  // Email acak dan unik
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
