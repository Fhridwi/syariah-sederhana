<?php

namespace App\Models;

use App\Models\JenisPembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TarifPembayaran extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'jenis_pembayaran_id', 'nominal'];
    protected $table = 'tarif_pembayaran';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class);
    }
}
