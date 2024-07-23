<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RakBarang extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_barang = 'BRG' . Str::upper(Str::random(3));
        });
    }

    protected $fillable = [
        'nama_barang',
        'qty',
        'harga',
    ];
}
