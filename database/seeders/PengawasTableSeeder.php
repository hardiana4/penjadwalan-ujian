<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengawas;

class PengawasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengawas::create([
            "id_prodi" => 1,
            "id_users" => 4,
            "id_detail" => 4,
            "kuota" => 3,
            "jabatan" => "Dosen",
            ]);

        Pengawas::create([
            "id_prodi" => 6,
            "id_users" => 5,
            "id_detail" => 5,
            "kuota" => 2,
            "jabatan" => "Teknisi",
            ]);

        Pengawas::create([
            "id_prodi" => 3,
            "id_users" => 6,
            "id_detail" => 6,
            "kuota" => 4,
            "jabatan" => "Teknisi",
            ]);

        Pengawas::create([
            "id_prodi" => 5,
            "id_users" => 7,
            "id_detail" => 7,
            "kuota" => 3,
            "jabatan" => "Dosen",
            ]);
    }
}
