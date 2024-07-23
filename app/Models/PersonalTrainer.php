<?php
// Model PersonalTrainer
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalTrainer extends Model
{
    use HasFactory;

    protected $table = 'personal_trainers';

    protected $fillable = [
        'sesi',
        'nama',
        'personal_trainer',
        'status',
        'maksimal_visit',
        'visit',
        'tanggal_mulai',
    ];
}
