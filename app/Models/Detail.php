<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_users',
        'nama',
    ];
    protected $table = 'detail';
    protected $primaryKey = 'id_detail';

}
