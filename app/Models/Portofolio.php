<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $table = 'portofolios';

    // Sesuaikan primary key ke id_portofolio
    protected $primaryKey = 'id_portofolio';

    protected $fillable = [
        'jurusan',
        'judul_karya',
        'deskripsi',
        'klien',
        'tahun',
        'gambar',
        'link_proyek',
        'status_aktif',
    ];
}