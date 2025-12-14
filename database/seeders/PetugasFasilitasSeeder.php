<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Faker\Factory as Faker;

class PetugasFasilitasSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan Faker
        $faker = Faker::create('id_ID');

        // Ambil semua fasilitas dan warga
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();

        // Buat data petugas fasilitas
        foreach ($fasilitas as $f) {
            foreach ($warga->random(2) as $w) {  // Ambil 2 warga secara acak untuk setiap fasilitas
                PetugasFasilitas::create([
                    'fasilitas_id' => $f->fasilitas_id,
                    'petugas_warga_id' => $w->warga_id,
                    'peran' => $this->assignRole($faker) // Menggunakan Faker untuk peran
                ]);
            }
        }
    }

    // Fungsi untuk memberi peran acak
    private function assignRole($faker)
    {
        // Menggunakan Faker untuk memilih peran secara acak
        $roles = ['Penanggung Jawab', 'Pengelola', 'Admin', 'Operator'];
        return $faker->randomElement($roles);
    }
}