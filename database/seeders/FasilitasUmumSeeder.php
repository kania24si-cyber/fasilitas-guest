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

        foreach (range(1, 100) as $i) {
            DB::table('fasilitas_umum')->insert([
                'nama'      => $faker->randomElement(['Aula Desa', 'Lapangan', 'Balai RW', 'Perpustakaan', 'Ruang Publik', 'Pusat Olahraga']),
                'jenis'     => $faker->randomElement(['Ruang Publik','Olahraga','Kesehatan','Pendidikan']),
                'alamat'    => $faker->streetAddress,
                'rt'        => $faker->numberBetween(1, 10),
                'rw'        => $faker->numberBetween(1, 5),
                'kapasitas' => $faker->numberBetween(10, 300),
                'deskripsi' => $faker->sentence(12),
                'media'     => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
