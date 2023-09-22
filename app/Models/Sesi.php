<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;
    protected $fillable = [
        'urutan',
        'waktu_awal',
        'waktu_akhir',
        'sesi',
    ];
    protected $table = 'sesi';
    protected $primaryKey = 'id_sesi';
}
