<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tahun_Pelajaran;

class TahunPelajaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tahun_Pelajaran::create([
            "tahun_awal" => "2022",
            "tahun_akhir" => "2023",
            "tahun_pelajaran" => "2022/2023",
            ]);
    }
}
