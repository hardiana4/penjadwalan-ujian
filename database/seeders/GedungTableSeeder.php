<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Gedung;
use Illuminate\Database\Seeder;

class GedungTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gedung::create([
            "gedung" => "Gedung Kuliah Bersama",
            "singkat" => "GKB",
            ]);

        Gedung::create([
            "gedung" => "Gedung Teknik Informatika dan Lingkungan",
            "singkat" => "GTIL",
            ]);
    }
}
