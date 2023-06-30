<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    protected $fillable = ['body', 'image', 'user_id', 'movie_id'];
    protected $casts = ["body" => "array"];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
}
