<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_invoice';

    protected $fillable = [
        'tanggal',
        'members_id',
        'nominal',
        'tipe_invoice',
        'bukti_pembayaran',
        'sesi_pt',
        'paket_member',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Members::class, 'members_id', 'id_members');
    }

    public function pt()
    {
        return $this->hasOne(PersonalTrainer::class, 'nama', 'members_id');
    }
}
