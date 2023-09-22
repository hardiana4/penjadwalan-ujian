<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Ruangan::create([
            "ruangan" => "I 1.1",
            "id_gedung" => 1,
            ]);

         Ruangan::create([
            "ruangan" => "I 1.2",
            "id_gedung" => 1,
            ]);

         Ruangan::create([
            "ruangan" => "I 1.3",
            "id_gedung" => 1,
            ]);

         Ruangan::create([
            "ruangan" => "I 1.4",
            "id_gedung" => 1,
            ]);

         Ruangan::create([
            "ruangan" => "I 1.5",
            "id_gedung" => 1,
            ]);

         Ruangan::create([
            "ruangan" => "R 1.1",
            "id_gedung" => 2,
            ]);

         Ruangan::create([
            "ruangan" => "R 1.2",
            "id_gedung" => 2,
            ]);

         Ruangan::create([
            "ruangan" => "R 1.3",
            "id_gedung" => 2,
            ]);

         Ruangan::create([
            "ruangan" => "R 1.4",
            "id_gedung" => 2,
            ]);
    }
}
