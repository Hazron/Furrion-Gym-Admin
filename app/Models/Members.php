<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function paket(): BelongsTo
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id_pakets');
    }
}
