<?php

namespace App\Models;


use App\Models\RiwayatPesanan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $primaryKey = 'id_pesanan';

    protected $fillable = [
        'id_user',
        'id_produk',
        'id_user_worker',
        'tanggal_pesan',
        'nama_pemesan',
        'email_pemesan',
        'no_hp_pemesan',
        'catatan_pesanan',
        'total_harga',
        'status',
    ];

    protected $casts = [
        'tanggal_pesan' => 'datetime',
        'total_harga' => 'integer',
    ];

    // Client yang melakukan pesanan
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }


    // Produk / layanan yang dipesan
    public function tefa()
    {
        return $this->belongsTo(
            Tefa::class,
            'id_produk',
            'id_produk'
        );
    }


    // Worker yang mengerjakan
    public function worker()
    {
        return $this->belongsTo(
            User::class,
            'id_user_worker',
            'id_user'
        );
    }


    // Ticket pesanan
    public function ticket()
    {
        return $this->hasOne(
            Ticket::class,
            'id_pesanan',
            'id_pesanan'
        );
    }


    public function riwayat()
    {
        return $this->hasMany(
            RiwayatPesanan::class,
            'id_pesanan',
            'id_pesanan'
        )->orderByDesc('tanggal_tracking');
    }

    public function progress()
    {
        return $this->hasMany(
            ProgressPesanan::class,
            'id_pesanan',
            'id_pesanan'
        )->latest('tanggal_progress');
    }

}