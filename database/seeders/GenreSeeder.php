<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('genres')->insert([
            [
                'nama_genre' => 'Aksi',
                'bobot' => 0.3,
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_genre' => 'Drama',
                'bobot' => 0.25,
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_genre' => 'Horror',
                'bobot' => 0.2,
                'tipe' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_genre' => 'Komedi',
                'bobot' => 0.15,
                'tipe' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_genre' => 'Romantis',
                'bobot' => 0.1,
                'tipe' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
