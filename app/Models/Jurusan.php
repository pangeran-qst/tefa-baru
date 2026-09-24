<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusans';

    protected $primaryKey = 'id_jurusan';

    protected $fillable = [
        'kode',
        'nama_jurusan',
        'ketua_kajur',
        'worker',
        'produk',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
