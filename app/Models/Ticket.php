<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $primaryKey = 'no_ticket';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'no_ticket',
        'id_pesanan',
        'tanggal_buat',
    ];

    protected $casts = [
        'tanggal_buat' => 'datetime',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class, 'no_ticket', 'no_ticket');
    }
}