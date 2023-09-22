<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_prodi',
        'id_users',
        'semester',
        'kode_kelas',
        'kelas',
        'matakuliah',
    ];
    protected $table= 'matakuliah';
    protected $primaryKey = 'id_matakuliah';

     public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi','id_prodi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users','id_users');
    }
}
