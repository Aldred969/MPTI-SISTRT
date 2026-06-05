<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // <-- hash password

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::create([
            'nik' => '1234567890123456',
            'nama' => 'Admin Utama',
            'email' => 'admin@example.com',
            'no_hp' => '08123456789',
            'role' => 'admin',
            'password' => Hash::make('rahasia123'),
        ]);
    }
    
}
