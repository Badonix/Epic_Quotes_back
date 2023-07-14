<?php

namespace App\Http\Controllers;

use App\Http\Requests\movies\CreateRequest;
use App\Http\Requests\movies\UpdateRequest;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Movie $movie)
    {
        $movieWithQuotes = Movie::with(['quotes.comments.user', 'quotes.likes'])->find($movie->id);
        return isset($movieWithQuotes) ? response($movieWithQuotes) : response("Movie not found", 404);
    }
    

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
            'budget'=> $validatedData['budget']
        ]);

        return response($movie, 201);
    }

    public function view()
    {
        $movies = Movie::with('quotes')->orderBy('created_at', 'desc')->get();
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
        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $movie->update([
                'banner' => $bannerPath,
            ]);
        }

        $movie->update([
            'title' => $attributes['title'],
            'release_year' => $attributes['release_year'],
            'genre' => $attributes['genre'],
            'description' => $attributes['description'],
            'director' => $attributes['director'],
            'budget' => $attributes['budget']
        ]);

        return response($movie);
    }
}
