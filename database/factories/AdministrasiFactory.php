<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministrasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_pendaftaran' => strtoupper(mt_rand(1, 3) . uniqid()),
            'user_id' => mt_rand(1, 5),
            'periode_id' => mt_rand(1, 3),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'semester' => mt_rand(6, 8),
            'ipk' => $this->faker->randomFloat(3, 3, 4),
            'keahlian'  => $this->faker->randomElement(['Web Development', 'Desain Grafis', 'Manajemen Pemasaran']),
            'alamat' => $this->faker->address(),
            'file_cv' => uniqid() . '.pdf',
            'file_esai' => uniqid() . '.pdf',
            'file_portofolio' => uniqid() . '.pdf',
            'file_ktm' => uniqid() . '.png',
            'file_transkrip' => uniqid() . '.pdf',
            'no_wa' => '089' . mt_rand(000000000, 999999999),
            'instragram' => $this->faker->userName(),
            'facebook' => $this->faker->userName(),
            'status_adm' => $this->faker->randomElement(['lolos', 'gagal']),
            'catatan' => $this->faker->paragraph(2),
        ];
    }
}
