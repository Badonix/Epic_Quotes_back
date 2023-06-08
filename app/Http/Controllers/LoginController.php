<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function authenticate(LoginRequest $request){
        $credentials = $request->only('login', 'password');
        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? "email" : "username";
        $credentials[$field] = $credentials['login'];
        unset($credentials['login']);

        if (auth()->attempt($credentials)) {
            request()->session()->regenerate();
            return response(['user' => auth()->user()]);
        }
        return response(['message' => 'Invalid Credentials'], 401);

        return response('user not authenticated');
    }
}
