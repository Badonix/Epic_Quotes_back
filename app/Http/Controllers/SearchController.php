<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $searchText = $request['search'];
        if (Str::startsWith($searchText, '@')) {
            $movieName = Str::substr($searchText, 1);
            $quotes = Quote::whereHas('movie', function ($query) use ($movieName) {
                $query->where('title->en', 'like', '%' . $movieName . '%')
                      ->orWhere('title->ka', 'like', '%' . $movieName . '%');
            })->get();
        } elseif (Str::startsWith($searchText, '#')) {
            $quoteBody = Str::substr($searchText, 1);
            $quotes = Quote::where('body->en', 'like', '%' . $quoteBody . '%')
                          ->orWhere('body->ka', 'like', '%' . $quoteBody . '%')
                          ->get();
        }else {
            $quotes = Quote::whereHas('movie', function ($query) use ($searchText) {
                $query->where('title->en', 'like', '%' . $searchText . '%')
                      ->orWhere('title->ka', 'like', '%' . $searchText . '%');
            })->orWhere('body->en', 'like', '%' . $searchText . '%')
              ->orWhere('body->ka', 'like', '%' . $searchText . '%')
              ->get();
        }
        return response($quotes->load('movie', 'user', 'likes', 'comments.user'));
    }

    public function movies(SearchRequest $request)
    {
        $movieName = $request['search'];
    
        $movies = Movie::where(function ($query) use ($movieName) {
            $query->where('title->en', 'like', '%' . $movieName . '%')
                  ->orWhere('title->ka', 'like', '%' . $movieName . '%');
        })->get();
    
        return response($movies);
    }
    

}
