<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tefa extends Model
{
    use HasFactory;

    protected $table = 'tefas';

    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'jurusan',
        'nama_produk',
        'deskripsi',
        'harga',
        'gambar',
        'status_aktif',
    ];

    protected $casts = [
        'harga' => 'integer',
        'status_aktif' => 'boolean',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'id_produk', 'id_produk');
    }
}