<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'tagihan_id',
        'santri_id',
        'nominal_pembayaran',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'penerima',
        'status',
        'keterangan_status',
        'created_at',
        'updated_at',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id');
    }

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }
}
