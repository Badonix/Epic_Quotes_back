<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function view()
    {
        $comments = Comment::with('user')
            ->orderBy('created_at', 'desc') 
            ->get();
        return response($comments);
    }

    public function store(PostCommentRequest $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = $request->user()->id;
        $comment = Comment::create($attributes);
        return response($comment->load('user'));
    }
}
