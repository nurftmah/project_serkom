<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gurus')->insert([
            [
                'id_guru' => 1,
                'nama_guru' => 'Ahmad Fauzi',
                'nip' => '198501012010001',
                'mapel' => 'Matematika',
                'foto' => '',
            ],
            [
                'id_guru' => 2,
                'nama_guru' => 'Siti Aminah',
                'nip' => '198603152012002',
                'mapel' => 'Bahasa Indonesia',
                'foto' => '',
            ],
        ]);
    }
}
