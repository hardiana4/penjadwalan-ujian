<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Gedung;
use App\Models\Ruangan;

class RuanganImport implements ToModel, WithStartRow
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
        $gedung = Gedung::where('singkat', $row[1])->first();
        $id_gedung = $gedung ? $gedung->id_gedung : null;
        $ruangan = $row[2];
        $existingRuangan = Ruangan::where('ruangan', $ruangan)->first();

        if (!$existingRuangan) {
            return new Ruangan([
                'ruangan' => $ruangan,
                'id_gedung' => $id_gedung,
            ]);
        } else {
            $existingRuangan->update([
                'id_gedung' => $id_gedung,
            ]);
        }
    }
}
