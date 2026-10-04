<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prestasis')->insert([
            [
                'id_prestasi' => 1,
                'nama_prestasi' => 'Juara 1 Lomba Cerdas Cermat',
                'deskripsi' => 'Meraih juara pertama dalam perlombaan cerdas cermat tingkat kecamatan.',
                'foto' => '',
                'tahun_ajaran' => '2025',
            ],
            [
                'id_prestasi' => 2,
                'nama_prestasi' => 'Juara 2 Futsal',
                'deskripsi' => 'Meraih juara kedua dalam kompetisi futsal antar sekolah.',
                'foto' => '',
                'tahun_ajaran' => '2026',
            ],
        ]);
    }
}
