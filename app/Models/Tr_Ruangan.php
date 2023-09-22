<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tr_Ruangan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kelas',
        'id_ruangan',
    ];
    protected $table = 'tr_ruangan';
    protected $primaryKey = 'id_trruangan';

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan','id_ruangan');
    }
}
