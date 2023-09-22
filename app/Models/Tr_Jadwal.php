<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tr_Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tp',
        'id_trmatakuliah',
        'id_trruangan',
        'id_pengawas1',
        'id_pengawas2',
        'jenis',
        'kode',
    ];
    protected $table = 'tr_jadwal';
    protected $primaryKey = 'id_trjadwal';

    public function tapel()
    {
        return $this->belongsTo(Tahun_Pelajaran::class, 'id_tp','id_tp');
    }

    public function trmatakuliah()
    {
        return $this->belongsTo(Tr_Matakuliah::class, 'id_trmatakuliah','id_trmatakuliah');
    }

    public function trruangan()
    {
        return $this->belongsTo(Tr_Ruangan::class, 'id_trruangan','id_trruangan');
    }

    public function pengawas1()
    {
        return $this->belongsTo(Pengawas::class, 'id_pengawas1','id_pengawas');
    }

    public function pengawas2()
    {
        return $this->belongsTo(Pengawas::class, 'id_pengawas2','id_pengawas');
    }
}
