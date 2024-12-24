<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
          'name' => 'Fiksi',
          'description' => 'Karya imajinatif dalam bentuk prosa atau puisi yang menceritakan tokoh, peristiwa, dan latar yang tidak sepenuhnya faktual.',
        ]);

        Genre::create([
          'name' => 'Horror',
          'description' => 'Genre yang bertujuan menciptakan rasa takut, ngeri, dan mencekam melalui unsur-unsur supranatural, kekerasan, atau psikologis.',
        ]);

        Genre::create([
          'name' => 'Romance',
          'description' => 'Genre yang berfokus pada hubungan percintaan dan emosi yang kuat antara dua tokoh, sering kali dengan konflik dan rintangan yang harus diatasi.',
        ]);
    }
}
