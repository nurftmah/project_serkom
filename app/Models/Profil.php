<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    /** @use HasFactory<\Database\Factories\ProfilFactory> */
    use HasFactory;

    protected $table = 'profils';
    protected $primaryKey = 'id_profil'; // Menyesuaikan migration Anda

    protected $fillable = [
        'nama_sekolah',
        'kepala_sekolah',
        'foto',
        'logo',
        'npsn',
        'alamat',
        'kontak',
        'visi',
        'misi',
        'tahun_berdiri',
        'deskripsi'
    ];
}
