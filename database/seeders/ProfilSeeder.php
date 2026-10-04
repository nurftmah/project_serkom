<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profils')->insert([
            'id_profil' => 1,
            'nama_sekolah' => 'MTS AL-AZHAR',
            'kepala_sekolah' => 'Nama Kepala Sekolah',
            'foto' => '',
            'logo' => 'logo_mts.png',
            'npsn' => '1234567890',
            'alamat' => 'Tasikmalaya, Jawa Barat',
            'kontak' => '081234567890',
            'visi' => 'Menjadi madrasah yang unggul, berprestasi, berkarakter, dan berakhlak mulia.',
            'misi' => 'Meningkatkan kualitas pembelajaran, membentuk peserta didik yang berkarakter, mengembangkan potensi siswa, serta menanamkan nilai-nilai keagamaan dalam kehidupan sehari-hari.',
            'tahun_berdiri' => 2000,
            'deskripsi' => 'MTS AL-AZHAR merupakan lembaga pendidikan yang berkomitmen memberikan pendidikan berkualitas serta membentuk peserta didik yang berprestasi, berkarakter, dan berakhlak mulia.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
