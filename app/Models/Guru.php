<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    /** @use HasFactory<\Database\Factories\GuruFactory> */
    use HasFactory;

    protected $table = 'gurus';

    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nama_guru',
        'nip',
        'mapel',
        'foto'
    ];

    public function ekstrakurikulers()
    {
        return $this->hasMany(Ektrakurikuler::class, 'id_guru', 'id_guru');
    }
}
