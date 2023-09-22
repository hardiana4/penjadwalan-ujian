<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Ketua extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_users',
        'nip',
        'ttd',
        'tgl',
        'tgl_sah',
    ];
    protected $table = 'ketua';
    protected $primaryKey = 'id_ketua';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users','id_users');
    }
}
