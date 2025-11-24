<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PeminjamanFasilitasSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $fasilitasIDs = DB::table('fasilitas_umum')->pluck('fasilitas_id');
        $wargaIDs = DB::table('warga')->pluck('warga_id');

        foreach (range(1, 100) as $i) {
            $tanggal_mulai = $faker->dateTimeThisYear();
            $tanggal_selesai = (clone $tanggal_mulai)->modify('+'.rand(1,5).' days');

            DB::table('peminjaman_fasilitas')->insert([
                'warga_id' => $faker->randomElement($wargaIDs),
                'fasilitas_id' => $faker->randomElement($fasilitasIDs),
                'tanggal_mulai' => $tanggal_mulai->format('Y-m-d'),
                'tanggal_selesai' => $tanggal_selesai->format('Y-m-d'),
                'tujuan' => $faker->sentence(),
                'total_biaya' => $faker->numberBetween(0, 500000),
                'status' => $faker->randomElement(['pending','disetujui','ditolak']),
                'bukti_pembayaran' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
