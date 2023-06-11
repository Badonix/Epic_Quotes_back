<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'username' => $googleUser->name,
            'email' => $googleUser->email,
            'email_verified_at' => now(),
        ]);

        auth()->login($user);

        session()->regenerate();

        return response()->json($user)->withHeaders([
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Origin' => env('SPA_DOMAIN'),
        ])->withCookie(cookie('XSRF-TOKEN', csrf_token()));
    }
}
