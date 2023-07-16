<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Notification;
use App\Models\Quote;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Quote $quote, Request $request){
        $like = Like::create(["quote_id" => $quote->id, "user_id"=>$request->user()->id]);
        if($quote->user->id != $request->user()->id){
            $notification = Notification::create(['receiver_id'=>$quote->user->id, 'sender_id'=>$request->user()->id, "type"=>"like"]);
        }
        return response($like);
    }
    public function unlike(Quote $quote, Request $request){
        $unlike = Like::where('quote_id', $quote->id)->where("user_id", $request->user()->id)->delete();
        return response('Like Removed');
    }
}
