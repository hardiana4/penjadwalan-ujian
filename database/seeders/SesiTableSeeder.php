<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sesi;

class SesiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Sesi::create([
            "urutan" => "1",
            "waktu_awal" => "08.00",
            "waktu_akhir" => "09.30",
            "sesi" => "08.00 - 09.30",
            ]);

         Sesi::create([
            "urutan" => "2",
            "waktu_awal" => "10.00",
            "waktu_akhir" => "11.30",
            "sesi" => "10.00 - 11.30",
            ]);

         Sesi::create([
            "urutan" => "3",
            "waktu_awal" => "13.30",
            "waktu_akhir" => "15.00",
            "sesi" => "13.30 - 15.00",
            ]);
    }
}
