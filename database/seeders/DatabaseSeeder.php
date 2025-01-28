<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'al@al.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
            'jabatan' => 'Kepala Desa',
            'alamat' => 'Jl. Raya Desa',
            'telepon' => '08123456789',
            'foto' => 'default.jpg',
        ]);
    }
}
