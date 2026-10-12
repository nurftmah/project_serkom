<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $userId = DB::table('users')->orderBy('id')->value('id');

        if (!$userId) {
            throw new RuntimeException(
                'Data pengguna belum tersedia. Jalankan UserSeeder terlebih dahulu.'
            );
        }

        DB::table('beritas')->insert([
            [
                'id_berita' => 1,
                'judul' => 'Kegiatan Pembukaan Tahun Ajaran Baru',
                'slug' => 'kegiatan-pembukaan-tahun-ajaran-baru',
                'isi' => 'MTS AL-AZHAR melaksanakan kegiatan pembukaan tahun ajaran baru yang diikuti oleh seluruh siswa, guru, dan staf sekolah.',
                'tanggal' => '2026-07-15',
                'gambar' => '9UVFEZWJtbJSURpva9mMILV6aHjTLBUNFmlSgKVT.jpg',
                'status' => 'Publish',
                'id_user' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_berita' => 2,
                'judul' => 'Kegiatan Perlombaan Antar Kelas',
                'slug' => 'kegiatan-pembelajaran-antar-kelas',
                'isi' => 'Dalam rangka meningkatkan semangat kebersamaan dan kreativitas siswa, MTS AL-AZHAR mengadakan berbagai perlombaan antar kelas.',
                'tanggal' => '2026-08-10',
                'gambar' => 'lgcPR9wwKKd2hxP1mKJOEsL689lzAR7iUEusIqmp.jpg',
                'status' => 'Publish',
                'id_user' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_berita' => 3,
                'judul' => 'Ujian Tengah Semester',
                'slug' => 'ujian-tengah-semester',
                'isi' => 'Melaksanakan Ujian Tengah Semester untuk kelas VII-IX dilaksanakan pada 9-12 Oktober 2026.',
                'tanggal' => '2026-10-10',
                'gambar' => 'kcEjw1SBv7zf47VVANQ3wKz7C1L1dzO93ES7WcsT.jpg',
                'status' => 'Publish',
                'id_user' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_berita' => 4,
                'judul' => 'Pelepasan Kelas IX 2025',
                'slug' => 'pelepasan-kelas-ix-2025',
                'isi' => 'MTS AL-AZHAR menyelenggarakan acara kelulusan peserta didik kelas IX angkatan ke-29 pada Selasa, (2/6/2026).',
                'tanggal' => '2026-10-10',
                'gambar' => 'g1vPc17fCTntvbnpXYoD4B7QehptbgAK4rDWxql8.jpg',
                'status' => 'Publish',
                'id_user' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_berita' => 5,
                'judul' => 'serkom tanggal 13',
                'slug' => 'serkom-tanggal-13',
                'isi' => 'vbnjmkgbhnjklsdfgbhjkerty',
                'tanggal' => '2026-10-10',
                'gambar' => 'JSiKBvLTw5HcEjZ7ALqH96Pguv4csdNgf8CfXeT6.png',
                'status' => 'Draft',
                'id_user' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_berita' => 6,
                'judul' => 'ppdb',
                'slug' => 'ppdb-tahun-2026',
                'isi' => 'wertyuisdfghjksdfgh',
                'tanggal' => '2026-10-10',
                'gambar' => '8Y3vVIrmqBgoUaJAqLURGtIdJcduwOzrwvJSPI5x.png',
                'status' => 'Draft',
                'id_user' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
