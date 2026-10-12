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
                'id_guru' => 1,
                'jadwal_latihan' => 'Jumat, 14.00 - 16.00',
                'deskripsi' => 'Kegiatan kepramukaan untuk membentuk kemandirian, kedisiplinan, dan kerja sama siswa.',
                'gambar' => 'i6y6Cq2LN2ZWZUKXP2zd6Xk0ipgeGwvQPCYkpkiJ.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ekskul' => 2,
                'nama_ekskul' => 'Futsal',
                'slug' => 'futsal',
                'id_guru' => 3,
                'jadwal_latihan' => 'Sabtu, 08.00 - 10.00',
                'deskripsi' => 'Kegiatan olahraga futsal untuk mengembangkan kemampuan dan sportivitas siswa.',
                'gambar' => '09tBifmizs90zavFhSeUKreTrTFqg9JxPjtMKKdA.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ekskul' => 4,
                'nama_ekskul' => 'Paskib',
                'slug' => 'paskib',
                'id_guru' => 4,
                'jadwal_latihan' => 'Sabtu, 08.00 - 10.00',
                'deskripsi' => 'qwertyuiopsxdcfvbghjk',
                'gambar' => 'gtfJV2UcMcBk2grXy6JN8VcevJtNlJaYyNO2d9fw.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ekskul' => 5,
                'nama_ekskul' => 'PMR',
                'slug' => 'pmr',
                'id_guru' => 7,
                'jadwal_latihan' => 'Sabtu, 08.00 - 10.00',
                'deskripsi' => 'Kegiatan Palang Merah Remaja untuk melatih kepedulian, kedisiplinan, dan keterampilan pertolongan pertama.',
                'gambar' => 'jcI9PLK2A37Mucv7rjxeFIdqYJBUxKRc1Gll1dwB.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ekskul' => 6,
                'nama_ekskul' => 'Voli',
                'slug' => 'voli',
                'id_guru' => 8,
                'jadwal_latihan' => 'Kamis 14.00-16.00',
                'deskripsi' => 'Kegiatan olahraga bola voli untuk meningkatkan keterampilan, kerja sama tim, dan sportivitas siswa.',
                'gambar' => 'WGS0g7qNBIwrs2YA4buSKjGC9rlO4CijnQrLvORc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_ekskul' => 7,
                'nama_ekskul' => 'Sispala',
                'slug' => 'sispala',
                'id_guru' => 2,
                'jadwal_latihan' => 'Minggu,08.00-10.00',
                'deskripsi' => 'Kegiatan Siswa Pecinta Alam untuk menumbuhkan kepedulian terhadap lingkungan, melatih kemandirian, dan meningkatkan kerja sama.',
                'gambar' => '7Ze0pbekbHmCdYfMXWQnq7yW27p23yFPu7JRzfHz.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
