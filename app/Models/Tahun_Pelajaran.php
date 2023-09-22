<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun_Pelajaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'tahun_awal',
        'tahun_akhir',
        'tahun_pelajaran',
    ];
    protected $table = 'tahun_pelajaran';
    protected $primaryKey = 'id_tp';
}
