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
            ["en"=>"Comedy", "ka"=>"კომედია"],
            ["en"=>'Drama', "ka"=>"დრამა"],
            ["en"=>'Thriller', "ka"=>"თრილერი"],
            ["en"=>'Horror', "ka"=>"საშინელება"],
            ["en"=>'Romance', "ka"=>"რომანტიკა"],
            ["en"=>'Adventure', "ka"=>"სათავგადასავლო"],
            ["en"=>'Sci-Fi', 'ka'=>"სამეცნიერო ფანტასტიკა"],
            ["en"=>'Fantasy', 'ka'=>"ფანტასტიკა"],
            ["en"=>'Mystery', "ka" =>"მისტიკა"],
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
