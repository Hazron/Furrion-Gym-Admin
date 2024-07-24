<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RakBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'qty',
        'harga',
    ];
}
