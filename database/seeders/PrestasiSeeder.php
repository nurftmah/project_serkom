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
                'slug' => 'juara-1-lomba-cerdas-cermat',
                'deskripsi' => 'Meraih juara pertama dalam perlombaan cerdas cermat tingkat kecamatan.',
                'foto' => 'xjSmSVQ2QT3ibamhmiaMhb36t8TSyGiJ6Ev6oBd9.jpg',
                'tahun_ajaran' => '2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prestasi' => 2,
                'nama_prestasi' => 'Juara 2 Futsal',
                'slug' => 'juara-2-futsal',
                'deskripsi' => 'Meraih juara kedua dalam kompetisi futsal antar sekolah.',
                'foto' => 'VDGUYPhT0K0OCxkDV019pPiaQIyUfXA851F0xZle.jpg',
                'tahun_ajaran' => '2026',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prestasi' => 3,
                'nama_prestasi' => 'Juara III nomor 50 Meter Gaya Dada Putr',
                'slug' => 'juara-iii-nomor-50-meter-gaya-dada-putr',
                'deskripsi' => 'Siswa kelas VII tersebut berhasil meraih Juara III nomor 50 Meter Gaya Dada Putra dan Juara III nomor 200 Meter Gaya Dada Putra',
                'foto' => '1aOoDnYi2VjreBCvwYsdMe2xJ6v0bxZ7JiAnPvLd.jpg',
                'tahun_ajaran' => '2025',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prestasi' => 4,
                'nama_prestasi' => 'juara 1 panjat tebing',
                'slug' => 'juara-1-panjat-tebing',
                'deskripsi' => 'Lomba panjat tebing merupakan kegiatan olahraga yang menguji kekuatan fisik, ketangkasan, keseimbangan, serta keberanian peserta dalam mencapai puncak dinding panjat. Kegiatan ini juga melatih konsentrasi, kedisiplinan, dan semangat pantang menyerah dalam meraih prestasi.',
                'foto' => 'xbONCbIbJjDGgNo0l1VQPccRrv8N6a5pw9y4KNLa.jpg',
                'tahun_ajaran' => '2026',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prestasi' => 5,
                'nama_prestasi' => 'Juara 1 Atlet Lari',
                'slug' => 'juara-1-atlet-lari',
                'deskripsi' => 'Siswa kelas VI A meraih juara 1 atlet lari tingkat Kabupaten',
                'foto' => 'o2DfP0bTsk98dEyMdwsFc5dHJ1z22K70GKcez4LX.jpg',
                'tahun_ajaran' => '2026',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
