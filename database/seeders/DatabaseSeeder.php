<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([ProdiTableSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([DetailTableSeeder::class]);
        $this->call([KetuaTableSeeder::class]);
        $this->call([SesiTableSeeder::class]);
        $this->call([GedungTableSeeder::class]);
        $this->call([RuanganTableSeeder::class]);
        $this->call([TahunPelajaranTableSeeder::class]);
    }
}
