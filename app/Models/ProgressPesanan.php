<?php

namespace App\Models;

use App\Models\RiwayatPesanan;
use App\Models\ProgressPesanan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressPesanan extends Model
{
    use HasFactory;

    protected $table = 'progress_pesanans';

    protected $primaryKey = 'id_progress';

    public $timestamps = false;

    protected $fillable = [
        'id_pesanan',
        'id_user',
        'progress',
        'tahap',
        'catatan',
        'tanggal_progress',
    ];

    protected $casts = [
        'progress' => 'integer',
        'tanggal_progress' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->belongsTo(
            Pesanan::class,
            'id_pesanan',
            'id_pesanan'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }
}