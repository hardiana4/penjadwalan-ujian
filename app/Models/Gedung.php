<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;
    protected $fillable = [
        'gedung',
        'singkat',
    ];
    protected $table = 'gedung';
    protected $primaryKey = 'id_gedung';

    public function ruangan()
    {
        return $this->hasOne(Ruangan::class, 'id_gedung','id_gedung');
    }
}
