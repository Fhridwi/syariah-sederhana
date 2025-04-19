<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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

    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->id)) {
            $model->id = (string) Str::uuid();
        }
    }); 
}

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
    public function angkatan()
    {
        return $this->belongsTo(angkatan::class, 'tahun_ajaran');
    }

    public function pembayaran()
{
    return $this->hasOne(Pembayaran::class);
}

}
