<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $primaryKey = 'id_berita';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'tanggal',
        'gambar',
        'status',
        'id_user',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
