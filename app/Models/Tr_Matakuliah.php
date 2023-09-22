<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tr_Matakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_prodi',
        'semester',
        'id_matakuliah',
        'id_pengawas',
        'kode_kelas',
        'kelas',
        'tgl_ujian',
        'hari',
        'id_sesi',
    ];
    protected $table = 'tr_matakuliah';
    protected $primaryKey = 'id_trmatakuliah';

    public function pengawas()
    {
        return $this->belongsTo(Pengawas::class, 'id_pengawas','id_pengawas');
    }

    public function matkul()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah','id_matakuliah');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi','id_prodi');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'id_sesi','id_sesi');
    }
}
