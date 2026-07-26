<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Akun Admin
        User::create([
            'name'     => 'Administrator Desa',
            'email'    => 'admin@sebonglagoi.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);
    }
}
