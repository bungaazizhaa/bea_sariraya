<?php

namespace Database\Factories;

use App\Models\Periode;
use Haruncpi\LaravelIdGenerator\IdGenerator;
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
        $getPeriodeAktif = Periode::where('status', '=', 'aktif')->first();
        $id = IdGenerator::generate(['table' => 'administrasis', 'field' => 'no_pendaftaran', 'reset_on_prefix_change' => true, 'length' => 7, 'prefix' => 'B' . $getPeriodeAktif->id_periode . '-']);
        static $no = 2;
        return [
            'no_pendaftaran' => $id . $no++,
            // 'user_id' => mt_rand(2, 7),
            'user_id' => $no++,
            // 'periode_id' => mt_rand(1, 1),
            'periode_id' => 1,
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
            'instagram' => $this->faker->userName(),
            'facebook' => $this->faker->userName(),
            'status_adm' => $this->faker->randomElement(['lolos', 'gagal']),
            'catatan' => $this->faker->sentence(1),
        ];
    }
}
