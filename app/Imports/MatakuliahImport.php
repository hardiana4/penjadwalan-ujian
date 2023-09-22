<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Matakuliah;
use App\Models\Prodi;

class MatakuliahImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function startRow(): int
    {
        return 5;
    }

    public function model(array $row)
    {
        $prodi = Prodi::where('prodi', $row[1])->first();
        $id_prodi = $prodi ? $prodi->id_prodi : null;

        $semester = $row[2];
        $matakuliah = $row[3];
        $existingMatakuliah = Matakuliah::where('id_prodi', $id_prodi)
            ->where('semester', $semester)
            ->where('matakuliah', $matakuliah)
            ->first();

        if (!$existingMatakuliah) {
            return new Matakuliah([
                'id_prodi' => $id_prodi,
                'semester' => $semester,
                'matakuliah' => $matakuliah,
            ]);
        } else {
            $existingMatakuliah->update([
                'id_prodi' => $id_prodi,
                'semester' => $semester,
                'matakuliah' => $matakuliah,
            ]);
        }
    }

}
