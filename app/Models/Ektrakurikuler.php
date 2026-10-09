<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ektrakurikuler extends Model
{
    use HasFactory;

    protected $table = 'ektrakurikulers';

    protected $primaryKey = 'id_ekskul';

    protected $fillable = [
        'nama_ekskul',
        'id_guru',
        'slug',
        'jadwal_latihan',
        'deskripsi',
        'gambar',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
}
