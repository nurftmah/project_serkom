<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswas')->insert([
            [
                'id_siswa' => 1,
                'nisn' => '0012345678',
                'nama_siswa' => 'Muhammad Rizky',
                'jenis_kelamin' => 'Laki-Laki',
                'kelas' => 'IX A',
                'tahun_masuk' => 2024,
            ],
            [
                'id_siswa' => 2,
                'nisn' => '0012345679',
                'nama_siswa' => 'Aulia Putri',
                'jenis_kelamin' => 'Perempuan',
                'kelas' => 'IX B',
                'tahun_masuk' => 2024,
            ],
             [
                'id_siswa' => 3,
                'nisn' => '0012345671',
                'nama_siswa' => 'Arsha Alghifar',
                'jenis_kelamin' => 'Laki-Laki',
                'kelas' => 'VII A',
                'tahun_masuk' => 2026,
            ],
            [
                'id_siswa' => 4,
                'nisn' => '0012345672',
                'nama_siswa' => 'Felisha Aura',
                'jenis_kelamin' => 'Perempuan',
                'kelas' => 'VIII B',
                'tahun_masuk' => 2025,
            ],
            [
                'id_siswa' => 5,
                'nisn' => '0012345673',
                'nama_siswa' => 'Lashia Caira',
                'jenis_kelamin' => 'Perempuan',
                'kelas' => 'IX B',
                'tahun_masuk' => 2024,
            ],
        ]);
    }
}
