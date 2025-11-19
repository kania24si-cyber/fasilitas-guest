<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FasilitasUmumSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            DB::table('fasilitas_umum')->insert([
                'nama'      => $faker->randomElement(['Aula Desa', 'Lapangan', 'Balai RW', 'Ruang Rapat', 'Perpustakaan']),
                'jenis'     => $faker->randomElement(['Bangunan', 'Ruangan', 'Area Terbuka']),
                'Alamat'    => $faker->streetAddress,
                'rt'        => $faker->numberBetween(1, 10),
                'rw'        => $faker->numberBetween(1, 5),
                'Kapasitas' => $faker->numberBetween(20, 300),
                'deskripsi' => $faker->sentence(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
