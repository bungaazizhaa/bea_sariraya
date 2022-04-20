<?php

namespace Database\Seeders;

use App\Models\Univ;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Univ::create(
            [
                'nama_universitas' => 'Universitas Diponegoro',
            ],
        );

        Univ::create(
            [
                'nama_universitas' => 'Universitas Padjadjaran',
            ],
        );

        Univ::create(
            [
                'nama_universitas' => 'Universitas Negeri Semarang',
            ],
        );

        User::factory(5)->create();

        User::create(
            [
                'name' => 'Alvin Alvrahesta',
                'nim' => '21120118120025',
                'univ_id' => '1',
                'picture' => null,
                'email_verified_at' => now(),
                'email' => 'alvin.alvrahesta@gmail.com',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ]
        );
        User::create(
            [
                'role' => 'admin',
                'nim' => '000',
                'univ_id' => '1',
                'name' => 'Administrator',
                'picture' => null,
                'email_verified_at' => now(),
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
            ],
        );
    }
}
