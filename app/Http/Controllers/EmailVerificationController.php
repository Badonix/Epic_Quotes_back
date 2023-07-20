<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request){
            $request->fulfill();
            $spaDomain = env("SPA_DOMAIN");
            $successRoute = '/verification-success';
            return redirect()->to($spaDomain . $successRoute);
    }
}
