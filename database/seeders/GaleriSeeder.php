<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('galeris')->insert([
            [
                'id_galeri' => 1,
                'judul' => 'Kegiatan Upacara Sekolah',
                'keterangan' => 'Kegiatan upacara rutin yang dilaksanakan oleh seluruh warga sekolah.',
                'file' => 'upacara.jfif',
                'kategori' => 'Foto',
                'tanggal' => '2026-08-17',
            ],
            [
                'id_galeri' => 2,
                'judul' => 'Kegiatan Ekstrakurikuler',
                'keterangan' => 'Dokumentasi kegiatan ekstrakurikuler siswa MTS AL-AZHAR.',
                'file' => 'kegiatan.jfif',
                'kategori' => 'Foto',
                'tanggal' => '2026-08-20',
            ]
        ]);
    }
}
