<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Mahasiswa;
use App\Models\Pengawas;
use App\Models\Prodi;

class MahasiswaImport implements ToModel, WithStartRow
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
        $pengawas = Pengawas::join('detail', 'detail.id_detail', '=', 'pengawas.id_detail')
            ->select('pengawas.id_pengawas')
            ->where('detail.nama', $row[6])
            ->first();
        $id_pengawas = $pengawas ? $pengawas->id_pengawas : null;

        $prodi = Prodi::where('prodi', $row[3])->first();
        $id_prodi = $prodi ? $prodi->id_prodi : null;

        $semester = $row[4];
        $kode_kelas = $row[5];
        $singkatan = Prodi::where('id_prodi', $id_prodi)->value('singkatan');
        $status = "1";

        if ($semester == "I (Satu)" || $semester == "II (Dua)") {
            $kelas = $singkatan . ".1" . $kode_kelas;
        } elseif ($semester == "III (Tiga)" || $semester == "IV (Empat)") {
            $kelas = $singkatan . ".2" . $kode_kelas;
        } elseif ($semester == "V (Lima)" || $semester == "VI (Enam)") {
            $kelas = $singkatan . ".3" . $kode_kelas;
        } else {
            $kelas = $singkatan . ".4" . $kode_kelas;
        }

        $npm = $row[2];
        $existingMahasiswa = Mahasiswa::where('npm', $npm)->first();

        if (!$existingMahasiswa) {
            return new Mahasiswa([
                'id_pengawas' => $id_pengawas,
                'id_prodi' => $id_prodi,
                'nama_mahasiswa' => $row[1],
                'npm' => $npm,
                'semester' => $semester,
                'kode_kelas' => $kode_kelas,
                'kelas' => $kelas,
                'status' => $status,
            ]);
        } else {
            $existingMahasiswa->update([
                'id_pengawas' => $id_pengawas,
                'id_prodi' => $id_prodi,
                'nama_mahasiswa' => $row[1],
                'semester' => $semester,
                'kode_kelas' => $kode_kelas,
                'kelas' => $kelas,
                'status' => $status,
            ]);
        }
    }


}
