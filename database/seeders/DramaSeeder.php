<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DramaSeeder extends Seeder
{
    public function run()
    {
        DB::table('dramas')->insert([
            [
                'nama_drama' => 'Sky Castle',
                'deskripsi' => 'Drama Korea tentang keluarga kaya yang berjuang agar anak-anaknya bisa masuk universitas terbaik.',
                'tahun' => 2018,
                'poster' => 'foto/Sky Castle.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_drama' => 'Crash Landing on You',
                'deskripsi' => 'Drama romantis antara wanita Korea Selatan dan tentara Korea Utara.',
                'tahun' => 2019,
                'poster' => 'foto/Crash Landing on You.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_drama' => 'Vincenzo',
                'deskripsi' => 'Drama komedi dan kriminal tentang pengacara mafia yang kembali ke Korea.',
                'tahun' => 2021,
                'poster' => 'foto/Vincenzo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_drama' => 'Itaewon Class',
                'deskripsi' => 'Drama tentang perjuangan seorang pemuda membuka restoran dan menghadapi rintangan bisnis.',
                'tahun' => 2020,
                'poster' => 'foto/Itaewon Class.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_drama' => 'Start-Up',
                'deskripsi' => 'Drama tentang para pemuda yang berjuang di dunia start-up dan teknologi.',
                'tahun' => 2020,
                'poster' => 'foto/Start-Up.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
