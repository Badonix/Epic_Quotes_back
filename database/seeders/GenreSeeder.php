<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            'Action',
            'Comedy',
            'Drama',
            'Thriller',
            'Horror',
            'Romance',
            'Adventure',
            'Sci-Fi',
            'Fantasy',
            'Mystery',
        ];
        
        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
