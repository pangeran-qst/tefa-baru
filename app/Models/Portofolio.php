<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $table = 'portofolios';
    protected $primaryKey = 'id_portofolio';

    protected $fillable = [
        'id_produk',
        'jurusan',
        'judul_karya',
        'deskripsi',
        'klien',
        'tahun',
        'gambar',
        'link_proyek',
        'galeri_screenshot',
        'status_aktif',
    ];

    protected $casts = [
        'galeri_screenshot' => 'array',
        'status_aktif' => 'boolean',
    ];

    public function tefa()
    {
        return $this->belongsTo(
            Tefa::class,
            'id_produk',
            'id_produk'
        );
    }
}