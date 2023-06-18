<?php

namespace App\Http\Controllers;

use App\Http\Requests\movies\CreateRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function store(CreateRequest $request)
    {
        $validatedData = $request->validated();

        $bannerPath = $request->file('banner')->store('banners', 'public');

        $movie = Movie::create([
            'title' => $validatedData['title'],
            'banner' => $bannerPath,
            'release_year' => $validatedData['release_year'],
            'genre' => $validatedData['genre'],
            'description' => $validatedData['description'],
            'director' => $validatedData['director'],
            'budget' => $validatedData['budget'],
        ]);

        return response($movie, 201);
    }
}
