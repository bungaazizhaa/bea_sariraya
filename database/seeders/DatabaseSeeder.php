<?php

namespace Database\Seeders;

use App\Models\Administrasi;
use App\Models\Univ;
use App\Models\User;
use App\Models\Periode;
use App\Models\Prodi;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // Periode::create(
        //     [
        //         'id_periode' => '1',
        //         'name' => 'batch-1',
        //         'tm_adm' => '2022-09-15',
        //         'ta_adm' => '2022-09-25',
        //         'tp_adm' => '2022-09-29',
        //         'status_adm' => null,
        //         'ts_adm' => null,
        //         'tm_wwn' => '2022-10-05',
        //         'ta_wwn' => '2022-10-10',
        //         'tp_wwn' => '2022-10-15',
        //         'status_wwn' => null,
        //         'ts_wwn' => null,
        //         'tm_png' => '2022-10-25',
        //         'ta_png' => '2022-10-29',
        //         'tp_png' => '2022-10-30',
        //         'status_png' => null,
        //         'ts_png' => null,
        //         'status' => 'aktif',
        //     ],
        // );
        // Periode::create(
        //     [
        //         'id_periode' => '2',
        //         'name' => 'batch-2',
        //         'tm_adm' => '2022-04-26',
        //         'ta_adm' => '2022-04-29',
        //         'tp_adm' => '2022-04-30',
        //         'status_adm' => null,
        //         'ts_adm' => null,
        //         'tm_wwn' => '2022-05-10',
        //         'ta_wwn' => '2022-05-20',
        //         'tp_wwn' => '2022-05-25',
        //         'status_wwn' => null,
        //         'ts_wwn' => null,
        //         'tm_png' => '2022-06-05',
        //         'ta_png' => '2022-06-15',
        //         'tp_png' => '2022-06-20',
        //         'status_png' => null,
        //         'ts_png' => null,
        //         'status' => 'aktif',
        //     ],
        // );
        // Periode::create(
        //     [
        //         'id_periode' => '3',
        //         'name' => 'batch-3',
        //         'tm_adm' => '2022-06-16',
        //         'ta_adm' => '2022-06-27',
        //         'tp_adm' => '2022-06-28',
        //         'status_adm' => null,
        //         'ts_adm' => null,
        //         'tm_wwn' => '2022-07-02',
        //         'ta_wwn' => '2022-07-04',
        //         'tp_wwn' => '2022-07-06',
        //         'status_wwn' => null,
        //         'ts_wwn' => null,
        //         'tm_png' => '2022-07-08',
        //         'ta_png' => '2022-07-10',
        //         'tp_png' => '2022-07-12',
        //         'status_png' => null,
        //         'ts_png' => null,
        //         'status' => 'nonaktif'
        //     ],
        // );

        Univ::create(['nama_universitas' => 'Institut Pertanian Bogor',],);
        Univ::create(['nama_universitas' => 'Institut Teknologi Bandung',],);
        Univ::create(['nama_universitas' => 'Institut Teknologi Sepuluh Nopember',],);
        Univ::create(['nama_universitas' => 'Universitas Ahmad Dahlan',],);
        Univ::create(['nama_universitas' => 'Universitas Airlangga',],);
        Univ::create(['nama_universitas' => 'Universitas Atma Jaya Yogyakarta',],);
        Univ::create(['nama_universitas' => 'Universitas Andalas',],);
        Univ::create(['nama_universitas' => 'Universitas Bina Nusantara',],);
        Univ::create(['nama_universitas' => 'Universitas Brawijaya',],);
        Univ::create(['nama_universitas' => 'Universitas Diponegoro',],);
        Univ::create(['nama_universitas' => 'Universitas Dian Nuswantoro',],);
        Univ::create(['nama_universitas' => 'Universitas Gadjah Mada',],);
        Univ::create(['nama_universitas' => 'Universitas Gunadarma',],);
        Univ::create(['nama_universitas' => 'Universitas Hasanuddin',],);
        Univ::create(['nama_universitas' => 'Universitas Indonesia',],);
        Univ::create(['nama_universitas' => 'Universitas Islam Indonesia',],);
        Univ::create(['nama_universitas' => 'Universitas Jambi',],);
        Univ::create(['nama_universitas' => 'Universitas Jenderal Soedirman',],);
        Univ::create(['nama_universitas' => 'Universitas Jember',],);
        Univ::create(['nama_universitas' => 'Universitas Kristen Satya Wacana',],);
        Univ::create(['nama_universitas' => 'Universitas Lambung Mangkurat',],);
        Univ::create(['nama_universitas' => 'Universitas Lampung',],);
        Univ::create(['nama_universitas' => 'Universitas Mercu Buana',],);
        Univ::create(['nama_universitas' => 'Universitas Muhammadiyah Yogyakarta',],);
        Univ::create(['nama_universitas' => 'Universitas Mulawarman',],);
        Univ::create(['nama_universitas' => 'Universitas Negeri Manado',],);
        Univ::create(['nama_universitas' => 'Universitas Negeri Malang',],);
        Univ::create(['nama_universitas' => 'Universitas Negeri Jakarta',],);
        Univ::create(['nama_universitas' => 'Universitas Negeri Semarang',],);
        Univ::create(['nama_universitas' => 'Universitas Negeri Surabaya',],);
        Univ::create(['nama_universitas' => 'Universitas Negeri Yogyakarta',],);
        Univ::create(['nama_universitas' => 'Universitas Nusa Cendana',],);
        Univ::create(['nama_universitas' => 'Universitas Padjadjaran',],);
        Univ::create(['nama_universitas' => 'Universitas Pendidikan Indonesia',],);
        Univ::create(['nama_universitas' => 'Universitas Sam Ratulangi',],);
        Univ::create(['nama_universitas' => 'Universitas Sebelas Maret',],);
        Univ::create(['nama_universitas' => 'Universitas Sriwijaya',],);
        Univ::create(['nama_universitas' => 'Universitas Syiah Kuala',],);
        Univ::create(['nama_universitas' => 'Universitas Telkom',],);
        Univ::create(['nama_universitas' => 'Universitas Udayana',],);

        Prodi::create(['nama_prodi' => 'Arsitektur',],);
        Prodi::create(['nama_prodi' => 'Desain Komunikasi Visual',],);
        Prodi::create(['nama_prodi' => 'Desain Grafis',],);
        Prodi::create(['nama_prodi' => 'Ilmu Komputer',],);
        Prodi::create(['nama_prodi' => 'Manajemen Pemasaran',],);
        Prodi::create(['nama_prodi' => 'Seni Rupa',],);
        Prodi::create(['nama_prodi' => 'Sistem Informasi',],);
        Prodi::create(['nama_prodi' => 'Sistem Komputer',],);
        Prodi::create(['nama_prodi' => 'Teknik Komputer',],);
        Prodi::create(['nama_prodi' => 'Teknik Informatika',],);
        Prodi::create(['nama_prodi' => 'Teknologi Informasi',],);
        User::create(
            [
                'role' => 'admin',
                'nim' => null,
                'univ_id' => null,
                'prodi_id' => null,
                'name' => 'Administrator',
                'picture' => 'admin.png',
                'email_verified_at' => now(),
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'remember_token' => '',
            ],
        );

        // User::create(
        //     [
        //         'name' => 'Budi Sanjaya',
        //         'nim' => '21120118120024',
        //         'univ_id' => '1',
        //         'prodi_id' => '1',
        //         'picture' => null,
        //         'email_verified_at' => now(),
        //         'email' => 'alvin.alvrahesta.dev@gmail.com',
        //         'password' => bcrypt('12345678'),
        //         'remember_token' => null,
        //     ]
        // );
        // User::factory(20)->create();
        // Administrasi::factory(4)->create();
    }
}
