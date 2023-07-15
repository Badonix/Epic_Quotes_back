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
            $quotes = Quote::searchByTitle($movieName)->get();
        } elseif (Str::startsWith($searchText, '#')) {
            $quoteBody = Str::substr($searchText, 1);
            $quotes = Quote::searchByBody($quoteBody)->get();
        } else {
            $quotes = Quote::search($searchText)->get();
        }
        return response($quotes->load('movie', 'user', 'likes', 'comments.user'));
    }

    public function movies(SearchRequest $request)
    {
        $movieName = $request['search'];
    
        $movies = Movie::searchByTitle($movieName)->get();
    
        return response($movies);
    }
    

}
