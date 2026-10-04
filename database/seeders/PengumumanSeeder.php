<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengumumen')->insert([
            [
                'id_pengumuman' => 1,
                'judul' => 'Pelaksanaan Ujian Tengah Semester',
                'isi' => 'Ujian Tengah Semester akan dilaksanakan sesuai jadwal yang telah ditentukan oleh pihak sekolah.',
                'tanggal' => '2026-09-01',
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengumuman' => 2,
                'judul' => 'Libur Kegiatan Sekolah',
                'isi' => 'Siswa diharapkan memperhatikan jadwal libur dan kembali mengikuti kegiatan sekolah sesuai jadwal yang telah ditentukan.',
                'tanggal' => '2026-09-10',
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
