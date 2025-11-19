<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PeminjamanFasilitasSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ambil seluruh id fasilitas sebagai foreign key
        $fasilitasIDs = DB::table('fasilitas_umum')->pluck('id');

        foreach (range(1, 20) as $i) {
            DB::table('peminjaman_fasilitas')->insert([
                'warga_id'        => $faker->numberBetween(1, 10), // sesuaikan jika ada tabel warga
                'fasilitas_id'    => $faker->randomElement($fasilitasIDs),
                'tanggal_mulai'   => $faker->date(),
                'tanggal_selesai' => $faker->date(),
                'tujuan'          => $faker->sentence(),
                'total_biaya'     => $faker->numberBetween(0, 500000),
                'status'          => $faker->randomElement(['pending', 'disetujui', 'ditolak']),
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
