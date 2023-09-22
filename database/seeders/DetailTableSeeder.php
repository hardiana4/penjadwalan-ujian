<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Detail;

class DetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Detail::create([
            "id_users" => 1,
            "nama" => "Admin",
            ]);
        
        Detail::create([
            "id_users" => 2,
            "nama" => "Petugas",
            ]);
        
        Detail::create([
            "id_users" => 3,
            "nama" => "Keuangan",
            ]);
    }
}
