<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SyaratFasilitas;
use App\Models\FasilitasUmum;
use Faker\Factory as Faker;

class SyaratFasilitasSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan Faker untuk menghasilkan data dalam bahasa Indonesia
        $faker = Faker::create('id_ID');  // Menggunakan locale bahasa Indonesia

        // Mengambil semua data fasilitas dari tabel fasilitas_umum
        $fasilitas = FasilitasUmum::all();

        // Membuat data syarat fasilitas untuk setiap fasilitas
        foreach ($fasilitas as $f) {
            // Menambahkan beberapa syarat untuk setiap fasilitas
            foreach (range(1, 3) as $i) {  // Menambahkan 3 syarat untuk setiap fasilitas
                SyaratFasilitas::create([
                    'fasilitas_id' => $f->fasilitas_id,  // ID fasilitas
                    'nama_syarat' => $this->generateNamaSyarat($faker),  // Nama syarat dalam bahasa Indonesia
                    'deskripsi' => $this->generateDeskripsiSyarat($faker),  // Deskripsi syarat dalam bahasa Indonesia
                ]);
            }
        }
    }

    // Fungsi untuk menghasilkan nama syarat acak dalam bahasa Indonesia
    private function generateNamaSyarat($faker)
    {
        // Daftar nama syarat dalam bahasa Indonesia
        $syaratNames = [
            'Surat Permohonan',
            'KTP Pemohon',
            'Surat Pengantar',
            'Surat Keputusan',
            'Bukti Pembayaran',
            'Foto Lokasi',
            'Sertifikat Asli',
        ];

        // Menggunakan Faker untuk memilih nama syarat secara acak
        return $faker->randomElement($syaratNames);
    }

    // Fungsi untuk menghasilkan deskripsi syarat dalam bahasa Indonesia
    private function generateDeskripsiSyarat($faker)
    {
        $deskripsiSyarat = [
            'Dokumen ini harus diajukan oleh pemohon sebagai permohonan resmi untuk mendapatkan fasilitas.',
            'KTP pemohon diperlukan sebagai bukti identitas resmi untuk memastikan keabsahan permohonan.',
            'Surat pengantar dari instansi terkait diperlukan untuk mendukung permohonan fasilitas ini.',
            'Surat keputusan yang diterbitkan oleh instansi yang berwenang harus dilampirkan dalam pengajuan.',
            'Bukti pembayaran yang sah harus disertakan untuk memvalidasi pembayaran biaya yang terkait dengan fasilitas.',
            'Foto lokasi fasilitas yang akan digunakan harus disertakan untuk memastikan kesesuaian dengan lokasi yang diinginkan.',
            'Sertifikat asli fasilitas yang bersangkutan harus dilampirkan untuk membuktikan kepemilikan dan keabsahan fasilitas tersebut.',
        ];

        // Menggunakan Faker untuk memilih deskripsi syarat secara acak
        return $faker->randomElement($deskripsiSyarat);
    }
}
