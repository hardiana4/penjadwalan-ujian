<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_prodi',
        'id_users',
        'id_detail',
        'kuota',
        'jabatan',
    ];
    protected $table = 'pengawas';
    protected $primaryKey = 'id_pengawas';

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi','id_prodi');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_users','id_users');
    }

    public function detail()
    {
        return $this->belongsTo(Detail::class, 'id_detail','id_detail');
    }
}
