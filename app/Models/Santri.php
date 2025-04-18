<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Santri extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function tagihans()
{
    return $this->hasMany(Tagihan::class);
}

}
