<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Ketua;
use Illuminate\Database\Seeder;

class KetuaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ketua::create([
            "id_users" => 1,
            "nip" => "197104112021212007",
            "ttd" => "ttd",
            "tgl" => "19/4/2023",
            "tgl_sah" => "Cilacap, 19 April 2023",
            ]);
    }
}
