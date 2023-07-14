<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quotes\CreateRequest;
use App\Http\Requests\Quotes\UpdateRequest;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function store(CreateRequest $request)
    {
        $validatedData = $request->validated();
        $imagePath = $request->file('image')->store('images', 'public');

        $quote = Quote::create([
            'body' => $validatedData['body'],
            'image' => $imagePath,
            'movie_id' => $validatedData['movie_id'],
            'user_id' => $request->user()->id
        ]);

        return response()->json($quote->load('user', 'movie', 'comments', 'likes'), 201);
    }
    public function view()
    {
        $quotes = Quote::with(['movie','likes', 'user', 'comments' => function ($query) {
            $query->with('user')->latest();
        }])
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        return response($quotes);
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return response()->json(['message' => 'Quote deleted successfully'], 200);
    }

    public function edit(Quote $quote, UpdateRequest $request)
    {

        $attributes = $request->validated();
        if ($request->hasFile('image')) {
            $quotePath = $request->file('image')->store('images', 'public');
            $quote->update([
                'image' => $quotePath,
            ]);
        }

        $quote->update([
            'body' => $attributes['body'],
            'movie_id' => $attributes['movie_id'],
            'user_id' => $request->user()->id
        ]);

        return response($quote);
    }

    public function index(Quote $quote)
    {
        return isset($quote) ? response($quote->load(['user', 'comments'])) : response("Quote not found", 404);
    }
}
