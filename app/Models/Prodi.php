<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenjang',
        'nama_prodi',
        'prodi',
        'singkatan',
    ];
    protected $table = 'prodi';
    protected $primaryKey = 'id_prodi';

}
