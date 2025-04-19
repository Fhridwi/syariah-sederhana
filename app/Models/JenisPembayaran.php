<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class JenisPembayaran extends Model
{
    use HasFactory;

    protected $fillable = ['pos_tagihan_id', 'tahun_ajaran_id', 'nama_pembayaran', 'tipe'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }


    public function posTagihan()
    {
        return $this->belongsTo(PosTagihan::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(Angkatan::class, 'tahun_ajaran_id');
    }
}
