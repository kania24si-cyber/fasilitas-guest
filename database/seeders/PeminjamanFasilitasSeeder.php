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

        // Mengambil semua ID fasilitas dan warga dari database
        $fasilitasIDs = DB::table('fasilitas_umum')->pluck('fasilitas_id');
        $wargaIDs = DB::table('warga')->pluck('warga_id');

        // Loop untuk memasukkan 100 data peminjaman fasilitas
        foreach (range(1, 100) as $i) {
            // Menentukan tanggal mulai dan tanggal selesai peminjaman
            $tanggal_mulai = $faker->dateTimeThisYear();
            $tanggal_selesai = (clone $tanggal_mulai)->modify('+' . rand(1, 5) . ' days');

            // Menyimpan data peminjaman fasilitas ke dalam tabel
            DB::table('peminjaman_fasilitas')->insert([
                'warga_id' => $faker->randomElement($wargaIDs),  // ID warga
                'fasilitas_id' => $faker->randomElement($fasilitasIDs),  // ID fasilitas
                'tanggal_mulai' => $tanggal_mulai->format('Y-m-d'),  // Tanggal mulai peminjaman
                'tanggal_selesai' => $tanggal_selesai->format('Y-m-d'),  // Tanggal selesai peminjaman
                'tujuan' => $this->generateTujuan($faker),  // Tujuan peminjaman dalam bahasa Indonesia
                'total_biaya' => $faker->numberBetween(0, 500000),  // Total biaya peminjaman
                'status' => $faker->randomElement([
                'pending',
                'disetujui', // Disetujui, silahkan bayar
                'lunas',
                'ditolak'
            ]),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    // Fungsi untuk menghasilkan tujuan peminjaman dalam bahasa Indonesia
    private function generateTujuan($faker)
    {
        $tujuan = [
            'Acara pertemuan warga', 
            'Olahraga dan rekreasi', 
            'Pendidikan dan pelatihan', 
            'Pengajian dan kegiatan keagamaan', 
            'Pesta atau perayaan keluarga'
        ];
        return $faker->randomElement($tujuan);
    }
}
