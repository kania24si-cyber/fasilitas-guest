<?php

namespace Database\Seeders;

use Intervention\Image\Facades\Image;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');  // Menggunakan locale bahasa Indonesia
        $roles = ['Guest', 'Admin'];  // Peran yang tersedia (Guest dan Admin)

        // Membuat foto profil default untuk user pertama
        $this->createProfilePicture('profile_picture_1.jpg');

        // User default (admin/guest)
        User::create([
            'name' => 'Guest Bina Desa',
            'email' => 'kania24si@mahasiswa.pcr.ac.id',
            'password' => Hash::make('Guest12345'),
            'role' => 'Admin',
            'profile_picture' => 'storage/profile_pictures/profile_picture_101.jpg',  // Path ke gambar di storage
        ]);

        // Generate 100 user acak
        foreach (range(1, 100) as $i) {
            // Membuat path gambar profil untuk setiap user
            $imagePath = $this->createProfilePicture('profile_picture_' . ($i + 1) . '.jpg');

            // Menyimpan data pengguna dengan gambar profil
            User::create([
                'name' => $faker->name,  // Nama pengguna yang dihasilkan oleh Faker
                'email' => $faker->unique()->safeEmail,  // Email acak dan unik
                'password' => Hash::make('Password123'),  // Password default untuk semua user Faker
                'role' => $faker->randomElement($roles),  // Pilih role secara acak dari Guest dan Admin
                'profile_picture' => $imagePath,  // Path foto profil
            ]);
        }
    }

    // Fungsi untuk membuat foto profil dummy
    private function createProfilePicture($filename)
    {
        // Menggunakan locale Indonesia untuk Faker
        $faker = Faker::create('id_ID');  // Pastikan Faker juga menggunakan locale 'id_ID'
        
        // Menggunakan URL Gravatar berdasarkan email yang di-hash
        $emailHash = md5(strtolower(trim($faker->unique()->safeEmail)));  // Membuat hash email
        $gravatarUrl = 'https://www.gravatar.com/avatar/' . $emailHash . '?s=200';

        // Path tempat menyimpan gambar di storage
        $path = 'profile_pictures/' . $filename;

        // Pastikan folder 'profile_pictures' ada di dalam storage
        $directory = storage_path('app/public/profile_pictures');
        if (!is_dir($directory)) {
            mkdir($directory, 0775, true); // Membuat folder jika belum ada
        }

        // Mengambil gambar dari URL dan menyimpannya di storage
        file_put_contents(storage_path('app/public/' . $path), file_get_contents($gravatarUrl));

        return 'storage/' . $path;  // Path yang digunakan untuk disimpan di database
    }
}
