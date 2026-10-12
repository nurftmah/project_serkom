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
                'nama_guru' => 'Almadan Ikal S.Pd M.Pd',
                'nip' => '198501012010001',
                'mapel' => 'Matematika',
                'foto' => 'j9p5Jfd13DhEwarc39JKMepdQamIxIhIsuKh69JD.jpg',
            ],
            [
                'id_guru' => 2,
                'nama_guru' => 'Sri Lestari',
                'nip' => '198603152012002',
                'mapel' => 'Bahasa Indonesia',
                'foto' => '6fhknzVRoaKNg9F6tkTJclVieUejFyQuvqykzYpA.jpg',
            ],
            [
                'id_guru' => 3,
                'nama_guru' => 'Dinan Ferdinan S.Pd',
                'nip' => '198603152012003',
                'mapel' => 'Bahasa Inggris',
                'foto' => 'V7CEigiBbn5LDfpb91COSU0uEnPuL9JSsXAEMRFY.jpg',
            ],
            [
                'id_guru' => 4,
                'nama_guru' => 'Naila Meriana S.Pd',
                'nip' => '198603152012004',
                'mapel' => 'Sejarah',
                'foto' => 'J9j6UWfcWdFWiGmdV6PvIPN4nWeUfRdCsfILkuqr.jpg',
            ],
            [
                'id_guru' => 5,
                'nama_guru' => 'Reni Mareni S.Pd',
                'nip' => '198603152012005',
                'mapel' => 'Aqidah',
                'foto' => 'FE43TNzOjx1n2gmtwLuqfxqg4iMNAtuUyvL6z17m.jpg',
            ],
            [
                'id_guru' => 6,
                'nama_guru' => 'Sopyan Suryan',
                'nip' => '198603152012006',
                'mapel' => 'Akhlak',
                'foto' => 'SUNqiN3Ye5iaA3pNrcOVEP9p2kXpDp0VvDIhVHm4.jpg',
            ],
            [
                'id_guru' => 7,
                'nama_guru' => 'Tati Maryati',
                'nip' => '198603152012007',
                'mapel' => 'Prakarya',
                'foto' => 'ORgSMlSg7UDsbmwTtqIg6u1nHXH96y1VOb69CiKk.jpg',
            ],
            [
                'id_guru' => 8,
                'nama_guru' => 'Muhammad Arya S.Kom M.Kom',
                'nip' => '198603152012013',
                'mapel' => 'Informatika',
                'foto' => 'smJTf3DGhpWCYttwFcRX47qce1kxPfJARRSa9pYw.jpg',
            ],
        ]);
    }
}
