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
        // Menggunakan Faker untuk menghasilkan data dalam bahasa Indonesia
        $faker = Faker::create('id_ID');

        // Mengambil semua data fasilitas dan warga
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();

        // Membuat data petugas fasilitas
        foreach ($fasilitas as $f) {
            foreach ($warga->random(2) as $w) {  // Ambil 2 warga secara acak untuk setiap fasilitas
                PetugasFasilitas::create([
                    'fasilitas_id' => $f->fasilitas_id,  // ID fasilitas
                    'petugas_warga_id' => $w->warga_id,  // ID warga
                    'peran' => $this->assignRole($faker) // Menggunakan Faker untuk memilih peran dalam bahasa Indonesia
                ]);
            }
        }
    }

    // Fungsi untuk memberi peran acak dalam bahasa Indonesia
    private function assignRole($faker)
    {
        // Daftar peran dalam bahasa Indonesia
        $roles = ['Penanggung Jawab', 'Pengelola', 'Admin', 'Operator'];
        return $faker->randomElement($roles);  // Memilih peran secara acak
    }
}
