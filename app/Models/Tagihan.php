<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'santri_id',
        'jenis_pembayaran_id',
        'tarif_pembayaran_id',
        'nominal',
        'periode',
        'bulan_tagihan',
        'jatuh_tempo',
        'tahun_ajaran',
        'status'
    ];

    // Relasi ke tabel santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    // Relasi ke tabel jenis_pembayaran
    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class, 'jenis_pembayaran_id');
    }

    // Relasi ke tabel tarif_pembayaran
    public function tarifPembayaran()
    {
        return $this->belongsTo(TarifPembayaran::class, 'tarif_pembayaran_id');
    }
}
