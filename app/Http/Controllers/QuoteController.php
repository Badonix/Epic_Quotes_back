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
        $bannerPath = $request->file('image')->store('images', 'public');
    
        $quote = Quote::create([
            'body' => json_encode($validatedData['body']),
            'image' => $bannerPath,
            'movie_id' => $validatedData['movie_id'],
            'user_id' => $validatedData['user_id']
        ]);
    
        return response($quote, 201);
    }
    public function view(){
        $quotes = Quote::orderBy('created_at', 'desc')->get();
        return response($quotes);
    }

    public function destroy(Quote $quote){
        $quote->delete();
        return response()->json(['message' => 'Quote deleted successfully'], 200);
    }

    public function edit(Quote $quote, UpdateRequest $request){
        $attributes = $request->validated();
        if ($request->hasFile('image')) {
            $bannerPath = $request->file('image')->store('images', 'public');
            $quote->update([
                'banner' => $bannerPath,
            ]);
        }

        $quote->update([
            'body' => $attributes['body'],
            'movie_id' => $attributes['movie_id'],
            'user_id' => $attributes['user_id']
        ]);

        return response($quote);
    }

    public function index(Quote $quote){
        return isset($quote) ? response($quote) : response("Quote not found", 404);
    }    
}
