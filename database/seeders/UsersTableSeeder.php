<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            User::create([
            "email" => "admin@gmail.com",
            "password" => Hash::make("111"),
            "level" => "admin",
            ]);

            User::create([
            "email" => "petugas@gmail.com",
            "password" => Hash::make("111"),
            "level" => "petugas",
            ]);

            User::create([
            "email" => "keuangan@gmail.com",
            "password" => Hash::make("111"),
            "level" => "keuangan",
            ]);
        }
}
