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
                'status' => 'Publish',
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengumuman' => 2,
                'judul' => 'Libur Kegiatan Sekolah',
                'isi' => 'Siswa diharapkan memperhatikan jadwal libur dan kembali mengikuti kegiatan sekolah sesuai jadwal yang telah ditentukan.',
                'tanggal' => '2026-09-10',
                'status' => 'Publish',
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengumuman' => 3,
                'judul' => 'Pengumuman Penerimaan Siswa Baru',
                'isi' => 'MTS Al-Azhar membuka penerimaan peserta didik baru tahun ajaran mendatang. Calon siswa dan orang tua dapat memperoleh informasi mengenai persyaratan serta jadwal pendaftaran melalui pihak sekolah.',
                'tanggal' => '2026-07-10',
                'status' => 'Publish',
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengumuman' => 4,
                'judul' => 'Kegiatan Rapat Guru',
                'isi' => 'Informasi kegiatan rapat guru untuk membahas program dan evaluasi pembelajaran sekolah.',
                'tanggal' => '2026-10-10',
                'status' => 'Publish',
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengumuman' => 5,
                'judul' => 'Informasi Kegiatan Sekolah',
                'isi' => 'Siswa diharapkan mengikuti informasi terbaru mengenai kegiatan sekolah melalui pengumuman resmi.',
                'tanggal' => '2026-10-11',
                'status' => 'Publish',
                'id_user' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
