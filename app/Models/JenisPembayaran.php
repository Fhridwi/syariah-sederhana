<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPembayaran extends Model
{
    use HasFactory;

    protected $table = 'jenis_pembayaran';
    protected $fillable = ['pos_tagihan_id', 'tahun_ajaran_id', 'nama_pembayaran', 'tipe'];

    public function posTagihan()
    {
        return $this->belongsTo(PosTagihan::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(Angkatan::class, 'tahun_ajaran_id');
    }
}
