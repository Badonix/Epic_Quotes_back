<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request) {
        return $request->user()->load("notifications.sender");
    }

    public function update(UpdateRequest $request){
        $attributes = $request->validated();
        {
            $user = $request->user();
    
            if($request->filled('username')){
                $user->update($request->only('username'));
            }
            if($request->filled('email')){
                $user->update($request->only('email'));
            }    
            if ($request->hasFile('avatar')) {
                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $avatarPath;
            }
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->save();        
            $updatedUser = User::find($user->id);

            return response()->json(['message' => 'Profile updated successfully', 'user' => $updatedUser]);
        }
    }
}
