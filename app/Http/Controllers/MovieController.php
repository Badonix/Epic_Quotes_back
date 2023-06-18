<?php

namespace App\Http\Controllers;

use App\Http\Requests\movies\CreateRequest;
use App\Http\Requests\movies\UpdateRequest;
use App\Models\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function view()
    {
        $movies = Movie::all();
        return response($movies, 200);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(['message' => 'Movie deleted successfully'], 200);
    }

    public function edit(UpdateRequest $request, Movie $movie)
    {
        $attributes = $request->validated();
        $bannerPath = $request->file('banner')->store('banners', 'public');
        $movie->update([
            'title' => $attributes['title'],
            'banner' => $bannerPath,
            'release_year' => $attributes['release_year'],
            'genre' => $attributes['genre'],
            'description' => $attributes['description'],
            'director' => $attributes['director'],
            'budget' => $attributes['budget'],
        ]);

        return response($movie);
    }

}
