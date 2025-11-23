<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        foreach (range(1, 20) as $i) {
            DB::table('warga')->insert([
                'no_ktp'        => $faker->nik(), // nomor KTP valid format Indonesia
                'nama'          => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan'     => $faker->jobTitle(),
                'telp'          => $faker->phoneNumber(),
                'email'         => $faker->unique()->safeEmail(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
