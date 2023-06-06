<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request){
            $request->fulfill();
        
            return redirect("http://localhost:3000/verification-success");
    }
}
