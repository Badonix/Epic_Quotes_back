<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\SendPasswordResetRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class PasswordResetController extends Controller
{
    public function send(SendPasswordResetRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
        ? response('Instructions sent', 200)
        : response('User not found', 404);

    }
    public function index(string $token, Request $request)
    {

        $spaDomain = env("SPA_DOMAIN");
        $email = $request->input('email');
        $user = Password::getUser(['email' => $email]);
        if (Password::tokenExists($user, $token)) {
            $resetRoute = '/reset-password/' . $token . "?email=" . $email;
            $redirectTo = $spaDomain . $resetRoute;
            return redirect($redirectTo);
        }
        return redirect($spaDomain . '/reset-password/expired');
    }

    public function reset(PasswordResetRequest $request) {
   
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return response($status);
    }
}
