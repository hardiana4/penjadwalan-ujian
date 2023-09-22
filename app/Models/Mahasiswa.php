<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_mahasiswa',
        'npm',
        'id_prodi',
        'kode_kelas',
        'kelas',
        'semester',
        'id_pengawas',
        'status',
    ];
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi','id_prodi');
    }

    public function user()
    {
        return $this->belongsTo(Pengawas::class, 'id_pengawas','id_pengawas');
    }
}
