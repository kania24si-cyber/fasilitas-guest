<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Guest Bina Desa',
            'email' => 'kania24si@mahasiswa.pcr.ac.id',
            'password' => Hash::make('Guest12345'),
        ]);
    }
}
