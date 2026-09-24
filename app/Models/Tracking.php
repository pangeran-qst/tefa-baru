<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'trackings';
    protected $primaryKey = 'id_tracking';

    protected $fillable = [
        'no_ticket',
        'id_user_petugas',
        'tanggal_waktu',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    public function ticket()
    {
        return $this->belongsTo(
            Ticket::class,
            'no_ticket',
            'no_ticket'
        );
    }

    public function petugas()
    {
        return $this->belongsTo(
            User::class,
            'id_user_petugas',
            'id_user'
        );
    }
}