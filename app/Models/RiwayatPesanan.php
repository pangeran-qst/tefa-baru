<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPesanan extends Model
{
    use HasFactory;

    protected $table = 'tracking_pesanans';
    protected $primaryKey = 'id_tracking';

    protected $fillable = [
        'id_pesanan',
        'tanggal_tracking',
        'status',
        'keterangan',
        'lokasi',
    ];

    protected $casts = [
        'tanggal_tracking' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->belongsTo(
            Pesanan::class,
            'id_pesanan',
            'id_pesanan'
        );
    }
}