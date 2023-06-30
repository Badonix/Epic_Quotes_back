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

}
