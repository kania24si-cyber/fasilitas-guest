<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambahkan user Guest Bina Desa
        User::create([
            'name' => 'Guest Bina Desa',
            'email' => 'kania24si@mahasiswa.pcr.ac.id',
            'password' => Hash::make('Guest12345'), // otomatis terenkripsi bcrypt
        ]);

        // Optional: user test bawaan
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
