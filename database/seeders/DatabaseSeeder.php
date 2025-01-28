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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'al@al.com',
        //     'password' => bcrypt('123'),
        //     'role' => 'admin',
        //     'jabatan' => 'Kepala Desa',
        //     'alamat' => 'Jl. Raya Desa',
        //     'telepon' => '08123456789',
        //     'foto' => 'default.jpg',

        // ]);

        $posts = [
            [
                'name' => 'Test User 1',
                'email' => 'al1@al.com',
                'password' => bcrypt('123'),
                'role' => 'admin',
                'id_jabatan' => 1,
                'alamat' => 'Jl. Raya Desa',
                'telepon' => '08123456789',
                'foto' => 'default.jpg',

            ],
            [
                'name' => 'Test User 2',
                'email' => 'al2@al.com',
                'password' => bcrypt('123'),
                'role' => 'user',
                'id_jabatan' => 1,
                'alamat' => 'Jl. Raya Desa',
                'telepon' => '08123456789',
                'foto' => 'default.jpg',

            ],
            [
                'name' => 'Test User 3',
                'email' => 'al3@al.com',
                'password' => bcrypt('123'),
                'role' => 'admin',
                'id_jabatan' => 1,
                'alamat' => 'Jl. Raya Desa',
                'telepon' => '08123456789',
                'foto' => 'default.jpg',

            ],
            [
                'name' => 'Test User 4',
                'email' => 'al4@al.com',
                'password' => bcrypt('123'),
                'role' => 'user',
                'jabatan' => 1,
                'alamat' => 'Jl. Raya Desa',
                'telepon' => '08123456789',
                'foto' => 'default.jpg',

            ],
        ];

        foreach ($posts as $post) {
            User::factory()->create($post);
        }
    }
}
