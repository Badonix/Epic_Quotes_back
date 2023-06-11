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
            "email_verified_at" => now(),
            'google_token' => $googleUser->token,
            'google_refresh_token' => $googleUser->refreshToken,
        ]);

        auth()->login($user);

        session()->regenerate();

        // $spaDomain = env("SPA_DOMAIN");
        return response()->json($user)->withHeaders([
            'Access-Control-Allow-Credentials' => 'true', // Enable CORS credentials
            'Access-Control-Allow-Origin' => env('SPA_DOMAIN'), // Replace with your SPA domain
        ])->withCookie(cookie('XSRF-TOKEN', csrf_token())); // Attach the CSRF token cookie
    }
}
