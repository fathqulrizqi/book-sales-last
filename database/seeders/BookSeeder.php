<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Book::create([
        'title' => 'Harry Potter and the Sorcerer\'s Stone',
        'description' => 'An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.',
        'price' => 50000,
        'stock' => 50,
        'cover_photo' => 'https://upload.wikimedia.org/wikipedia/id/b/bf/Harry_Potter_and_the_Sorcerer%27s_Stone.jpg',
        'genre_id' => 1,
        'author_id' => 1,
    ]);

    Book::create([
        'title' => 'The Shining',
        'description' => 'A family heads to an isolated hotel for the winter where an evil and sinister presence influences the father into violence, while his psychic son sees horrific premonitions from both past and future.',
        'price' => 25000,
        'stock' => 30,
        'cover_photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCYVMBXDOXKabnDY38Q2nl2ABd6PCn8CR6Kg&s',
        'genre_id' => 2,
        'author_id' => 2,
    ]);

    Book::create([
        'title' => 'Laskar Pelangi',
        'description' => 'An inspiring story about the struggle of a group of students and their two teachers in a remote village in Belitung to keep their school alive.',
        'price' => 40000,
        'stock' => 75,
        'cover_photo' => 'https://upload.wikimedia.org/wikipedia/id/1/17/Laskar_Pelangi_film.jpg',
        'genre_id' => 3,
        'author_id' => 3,
    ]);
    }
}
