<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = ["title" => "array", "description" => "array", "director" => "array"];

    public function quotes(){
        return $this->hasMany(Quote::class, "movie_id");
    }

    public function scopeSearchByTitle($query, $searchText)
    {
        return $query->where('title->en', 'like', '%' . $searchText . '%')
            ->orWhere('title->ka', 'like', '%' . $searchText . '%');
    }
    

}
