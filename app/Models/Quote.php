<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quote extends Model
{
    use HasFactory;
    protected $fillable = ['body', 'image', 'user_id', 'movie_id'];
    protected $casts = ["body" => "array"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, "post_id");
    }
    public function likes(){
        return $this->hasMany(Like::class, 'quote_id');
    }
    public function scopeSearchByTitle($query, $searchText)
    {
        return $query->whereHas('movie', function ($query) use ($searchText) {
            $query->where('title->en', 'like', '%' . $searchText . '%')
                ->orWhere('title->ka', 'like', '%' . $searchText . '%');
        });
    }
    public function scopeSearchByBody($query, $searchText)
    {
        return $query->where('body->en', 'like', '%' . $searchText . '%')
            ->orWhere('body->ka', 'like', '%' . $searchText . '%');
    }

    public function scopeSearch($query, $searchText)
    {
        return $query->whereHas('movie', function ($query) use ($searchText) {
            $query->where('title->en', 'like', '%' . $searchText . '%')
                ->orWhere('title->ka', 'like', '%' . $searchText . '%');
        })
        ->orWhere('body->en', 'like', '%' . $searchText . '%')
        ->orWhere('body->ka', 'like', '%' . $searchText . '%');
    }
}
