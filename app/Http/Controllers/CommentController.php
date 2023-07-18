<?php

namespace App\Http\Controllers;

use App\Events\NotificationCreated;
use App\Events\PostCommented;
use App\Http\Requests\PostCommentRequest;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Quote;

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
        $post = Quote::findOrFail($attributes['post_id']);
        $comment = $post->comments()->create($attributes);
        if ($post->user_id != $request->user()->id) {
            $notification = Notification::create([
                'receiver_id' => $post->user_id,
                'sender_id' => $request->user()->id,
                'type' => 'comment',
            ]);
            event(new NotificationCreated($notification->load("sender")));
        }
        event(new PostCommented($post->id, $comment->load('user')));
        return response($comment->load('user'));
    }
}
