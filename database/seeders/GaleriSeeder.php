<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('galeris')->insert([
            [
                'id_galeri' => 1,
                'judul' => 'Kegiatan Upacara Sekolah',
                'keterangan' => 'Kegiatan upacara rutin yang dilaksanakan oleh seluruh warga sekolah.',
                'file' => 'bhV6Nw8mUQoTsIFZWQzv0mbY9TAcdpcmukAa7Bwr.jpg',
                'kategori' => 'Foto',
                'tanggal' => '2026-08-17',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_galeri' => 2,
                'judul' => 'Kegiatan Ekstrakurikuler',
                'keterangan' => 'Dokumentasi kegiatan ekstrakurikuler siswa MTS AL-AZHAR.fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120fungsi untuk membatasi teks,batasnya adlh 120',
                'file' => 'vnNFQIVjGFJIBvyxJMjnUfij3G3kWqG7CZwa4x7F.jpg',
                'kategori' => 'Foto',
                'tanggal' => '2026-08-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_galeri' => 3,
                'judul' => 'Suasana Ngerjain Tugas di Lab',
                'keterangan' => 'Kelas VII A dan VII B sedang mengerjakan tugas informatika di lab',
                'file' => 'EGJCopDmJtzP7eJVCmMIazqrPgeIRAKjoOUsT7bh.mp4',
                'kategori' => 'Video',
                'tanggal' => '2026-10-09',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_galeri' => 4,
                'judul' => 'Kegiatan Rapat Guru untuk Pembelajaran',
                'keterangan' => 'Rapat guru merupakan kegiatan rutin yang dilaksanakan untuk membahas perkembangan sekolah, mengevaluasi proses pembelajaran, serta meningkatkan kualitas pendidikan. Melalui rapat ini, para guru dan pihak sekolah berdiskusi serta bekerja sama dalam merencanakan kegiatan dan meningkatkan mutu pendidikan di MTS Al-Azhar.',
                'file' => '2xM1PTOZ6kyBFxXpGuHL0VvsNzZTZnCpl0ZG8Qjh.jpg',
                'kategori' => 'Foto',
                'tanggal' => '2026-10-10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_galeri' => 5,
                'judul' => 'Foto Bersama Guru dan Siswa',
                'keterangan' => 'Dokumentasi kebersamaan guru dan siswa dalam kegiatan sekolah sebagai bentuk kekompakan, kebersamaan, serta mempererat hubungan antara guru dan siswa.',
                'file' => 'AQmtZr7HF3st6MpTcSosSfb6Ox35Q1KkEQ5BKPJJ.jpg',
                'kategori' => 'Foto',
                'tanggal' => '2026-10-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
