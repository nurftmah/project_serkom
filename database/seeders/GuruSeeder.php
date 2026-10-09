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
                'nama_guru' => 'Almadan Ikal',
                'nip' => '198501012010001',
                'mapel' => 'Matematika',
                'foto' => 'guru1.jpg',
            ],
            [
                'id_guru' => 2,
                'nama_guru' => 'Sri Lestari',
                'nip' => '198603152012002',
                'mapel' => 'Bahasa Indonesia',
                'foto' => 'guru2.jpg',
            ],
            [
                'id_guru' => 3,
                'nama_guru' => 'Dinan Ferdinan S.Pd',
                'nip' => '198603152012003',
                'mapel' => 'Bahasa Inggris',
                'foto' => 'guru3.jpg',
            ],
            [
                'id_guru' => 4,
                'nama_guru' => 'Naila Meriana S.Pd',
                'nip' => '198603152012004',
                'mapel' => 'Sejarah',
                'foto' => 'guru4.jpg',
            ],
            [
                'id_guru' => 5,
                'nama_guru' => 'Reni Mareni S.Pd',
                'nip' => '198603152012005',
                'mapel' => 'Aqidah',
                'foto' => 'guru5.jpg',
            ],
            [
                'id_guru' => 6,
                'nama_guru' => 'Sopyan Suryan',
                'nip' => '198603152012006',
                'mapel' => 'Akhlak',
                'foto' => 'guru6.jpg',
            ],
            [
                'id_guru' => 7,
                'nama_guru' => 'Tati Maryati',
                'nip' => '198603152012007',
                'mapel' => 'Prakarya',
                'foto' => 'guru7.jpg',
            ],
        ]);
    }
}
