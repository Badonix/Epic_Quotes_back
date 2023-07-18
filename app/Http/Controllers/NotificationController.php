<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function view(Notification $notification, Request $request){
        if($request->user()->id == $notification['receiver_id']){
            $notification->read=true;
            $notification->save();
        }
        return response($notification->load('sender'));
    }

    public function clear(Request $request){
        $userId = $request->user()->id;
        Notification::where('receiver_id', $userId)->update(['read' => true]);
    
        return response()->json(['success' => true]);
    }
}
