<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prodi::create([
            "jenjang" => "D3",
            "nama_prodi" => "Teknik Informatika",
            "prodi" => "D3 Teknik Informatika",
            "singkatan" => "TI",
            ]);

        Prodi::create([
            "jenjang" => "D3",
            "nama_prodi" => "Teknik Mesin",
            "prodi" => "D3 Teknik Mesin",
            "singkatan" => "TM",
            ]);

        Prodi::create([
            "jenjang" => "D3",
            "nama_prodi" => "Teknik Elektronika",
            "prodi" => "D3 Teknik Elektronika",
            "singkatan" => "TE",
            ]);

        Prodi::create([
            "jenjang" => "D3",
            "nama_prodi" => "Teknik Listrik",
            "prodi" => "D3 Teknik Listrik",
            "singkatan" => "TL",
            ]);

        Prodi::create([
            "jenjang" => "D4",
            "nama_prodi" => "Teknik Pengendalian Pencemaran Lingkungan",
            "prodi" => "D4 Teknik Pengendalian Pencemaran Lingkungan",
            "singkatan" => "TPPL",
            ]);

        Prodi::create([
            "jenjang" => "D4",
            "nama_prodi" => "Rekayasa Keamanan Siber",
            "prodi" => "D4 Rekayasa Keamanan Siber",
            "singkatan" => "RKS",
            ]);

        Prodi::create([
            "jenjang" => "D4",
            "nama_prodi" => "Akuntansi Lembaga Keuangan Syariah",
            "prodi" => "D4 Akuntansi Lembaga Keuangan Syariah",
            "singkatan" => "ALKS",
            ]);
    }
}
