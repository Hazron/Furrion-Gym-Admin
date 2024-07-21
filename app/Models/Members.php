<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $primaryKey = 'id_members';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'email',
        'paket_id',
        'tanggal_daftar',
        'tanggal_selesai',
        'tanggal_perbarui',
        'status',
        'no_telpon',
        'qr_code',
        'kartu_member',
    ];
}
