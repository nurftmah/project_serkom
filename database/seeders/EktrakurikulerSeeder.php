<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EktrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ektrakurikulers')->insert([
            [
                'id_ekskul' => 1,
                'nama_ekskul' => 'Pramuka',
                'slug' => 'pramuka',
                'id_guru' => DB::table('gurus')
                    ->where('nama_guru', 'Almadan Ikal')
                    ->value('id_guru'),
                'jadwal_latihan' => 'Jumat, 14.00 - 16.00',
                'deskripsi' => 'Kegiatan kepramukaan untuk membentuk kemandirian, kedisiplinan, dan kerja sama siswa.',
                'gambar' => 'pramuka.jfif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ekskul' => 2,
                'nama_ekskul' => 'Futsal',
                'slug' => 'futsal',
                'id_guru' => DB::table('gurus')
                    ->where('nama_guru', 'Dinan Ferdinan S.Pd')
                    ->value('id_guru'),
                'jadwal_latihan' => 'Sabtu, 08.00 - 10.00',
                'deskripsi' => 'Kegiatan olahraga futsal untuk mengembangkan kemampuan dan sportivitas siswa.',
                'gambar' => 'futsal.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
