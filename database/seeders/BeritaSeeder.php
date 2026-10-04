<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('beritas')->insert([
            [
                'id_berita' => 1,
                'judul' => 'Kegiatan Pembukaan Tahun Ajaran Baru',
                'slug' => 'kegiatan-pembukaan-tahun-ajaran-baru',
                'isi' => 'MTS AL-AZHAR melaksanakan kegiatan pembukaan tahun ajaran baru yang diikuti oleh seluruh siswa, guru, dan staf sekolah.',
                'tanggal' => '2026-07-15',
                'gambar' => '',
                'status' => 'Publish',
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_berita' => 2,
                'judul' => 'Kegiatan Perlombaan Antar Kelas',
                'slug' => 'kegiatan-pembelajaran-antar-kelas',
                'isi' => 'Dalam rangka meningkatkan semangat kebersamaan dan kreativitas siswa, MTS AL-AZHAR mengadakan berbagai perlombaan antar kelas.',
                'tanggal' => '2026-08-10',
                'gambar' => '',
                'status' => 'Publish',
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
