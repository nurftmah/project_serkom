<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profils')->insert([
            [
                'id_profil' => 1,
                'nama_sekolah' => 'MTS AL-AZHAR',
                'kepala_sekolah' => 'Drs.Saepul Zamil S.pd M.pd',
                'foto' => 'da16Hwt5ynd0gb75d3I7TzHlNd8y1cLXHagGJRWM.jpg',
                'logo' => 'vKIsNpR9rd4Y70jiZ2F5JSFdGaVMTI452HE3SU9c.png',
                'npsn' => '20278569',
                'alamat' => 'Kp. Gunung Kicau Rt.04 Rw.01, Kec. Sukarame, Kab. Tasikmalaya, Prov. Jawa Barat',
                'kontak' => '081234567890',
                'visi' => 'Menjadi madrasah yang unggul, berprestasi, berkarakter, dan berakhlak mulia.',
                'misi' => 'Meningkatkan kualitas pembelajaran, membentuk peserta didik yang berkarakter, mengembangkan potensi siswa, serta menanamkan nilai-nilai keagamaan dalam kehidupan sehari-hari.',
                'tahun_berdiri' => 2000,
                'deskripsi' => 'MTS AL-AZHAR merupakan lembaga pendidikan yang berkomitmen memberikan pendidikan berkualitas serta membentuk peserta didik yang berprestasi, berkarakter, dan berakhlak mulia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
