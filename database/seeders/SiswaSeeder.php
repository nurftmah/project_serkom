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
                'tahun_masuk' => 2024,
            ],
            [
                'id_siswa' => 2,
                'nisn' => '0012345679',
                'nama_siswa' => 'Aulia Putri',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2024,
            ],
        ]);
    }
}
