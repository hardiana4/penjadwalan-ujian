<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\User;
use App\Models\Detail;
use App\Models\Pengawas;
use App\Models\Prodi;
use Illuminate\Support\Facades\Hash;

class UsersDetailsPengawasImport implements ToModel, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 5;
    }

    public function model(array $row)
    {
        $password = "Abcd1234*";
        $level = "pengawas";

        $email = $row[4];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return null;
        }
        $existingUser = User::where('email', $email)->first();

        if (!$existingUser) {
            $user = User::create([
                'email' => $row[4],
                'password' => Hash::make($password),
                'level' => $level,
            ]);

            $detail = Detail::create([
                'id_users' => $user->id_users,
                'nama' => $row[1],
            ]);

            $prodi = Prodi::where('prodi', $row[2])->first();
            $id_prodi = $prodi ? $prodi->id_prodi : null;

            $pengawas = Pengawas::create([
                'id_prodi' => $id_prodi,
                'id_users' => $user->id_users,
                'id_detail' => $detail->id_detail,
                'jabatan' => $row[3],
                'kuota' => $row[5],
            ]);

        } else {
            $existingUser->update([
                'email' => $row[4],
                'level' => $level,
            ]);

            $detail = Detail::where('id_users', $existingUser->id_users)->first();
            if ($detail) {
                $detail->update([
                    'nama' => $row[1],
                ]);
            } else {
                $detail = Detail::create([
                    'id_users' => $existingUser->id_users,
                    'nama' => $row[1],
                ]);
            }

            $prodi = Prodi::where('prodi', $row[2])->first();
            $id_prodi = $prodi ? $prodi->id_prodi : null;

            $existingPengawas = Pengawas::where('id_users', $existingUser->id_users)->first();
            if ($existingPengawas) {
                $existingPengawas->update([
                    'id_prodi' => $id_prodi,
                    'jabatan' => $row[3],
                    'kuota' => $row[5],
                ]);
            } else {
                Pengawas::create([
                    'id_prodi' => $id_prodi,
                    'id_users' => $existingUser->id_users,
                    'id_detail' => $detail->id_detail,
                    'jabatan' => $row[3],
                    'kuota' => $row[5],
                ]);
            }
        }
    }

}
