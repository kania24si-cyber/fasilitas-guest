<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $roles = ['Guest', 'Admin'];
        // User default (admin/guest)
        User::create([
            'name' => 'Guest Bina Desa',
            'email' => 'kania24si@mahasiswa.pcr.ac.id',
            'password' => Hash::make('Guest12345'),
            'role' => 'Guest',
        ]);

        // Generate 100 user random
        foreach (range(1, 100) as $i) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('Password123'), // password default untuk semua user faker
                'role' => $faker->randomElement($roles), // pilih role secara random,
            ]);
        }
    }
}
