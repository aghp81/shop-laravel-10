<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\VerificationCode;

class AuthOtpController extends Controller
{
    // return view of OTP Login Page
    public function login()
    {
        return view('auth.otp-login');
    }

    // Generate OTP
    public function generate(Request $request)
    {
        #validate Data
        $request->validate([
            'mobile_no' => 'required|exists:users,mobile_no'
        ]);

        # Generate An OTP
        $verificationCode = $this->generateOtp($request->mobile_no);

        # Return With OTP
        return redirect()->route('otp.verification')->with('success', $message);

    }

    public function generateOtp($mobile_no)
    {
        $user = User::where('mobile_no', $mobile_no)->first();

        # User Dose not Have Any Existing OTP
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        
        $now = Carbon::now();
        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }

        // Create a new OTP
        return VerificationCode::create([
            'user_id' => $user->id,
            'otp' => rand(123456,999999),
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);
    }
}
