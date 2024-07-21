<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'pakets';
    protected $primaryKey = 'id_pakets';

    protected $fillable = [
        'nama_paket',
        'durasi',
        'harga',
        'tanggal_berlaku',
        'status',
    ];

    protected $casts = [
        'tanggal_berlaku' => 'date',
        'harga' => 'decimal:2',
    ];
}
