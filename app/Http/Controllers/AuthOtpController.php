<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthOtpController extends Controller
{
    // return view of OTP Login Page
    public function login()
    {
        return view('auth.otp-login');
    }
}
