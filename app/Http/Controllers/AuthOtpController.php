<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserOtp;
use Carbon\Carbon;


class AuthOtpController extends Controller
{
    // return view of OTP Login Page
    public function login()
    {
        return view('auth.otp-login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generate(Request $request)
    {
        /* Validate Data */
        $request->validate([
            'mobile_no' => 'required|exists:users,mobile_no'
        ]);
  
        /* Generate An OTP */
        $userOtp = $this->generateOtp($request->mobile_no);
        $userOtp->sendSMS($request->mobile_no);
  
        return redirect()->route('otp.verification', ['user_id' => $userOtp->user_id])
                         ->with('success',  "رمز یکبار مصرف به شماره موبایل شما ارسال شد."); 
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generateOtp($mobile_no)
    {
        $user = User::where('mobile_no', $mobile_no)->first();
  
        /* User Does not Have Any Existing OTP */
        $userOtp = UserOtp::where('user_id', $user->id)->latest()->first();
  
        $now = Carbon::now();
  
        if($userOtp && $now->isBefore($userOtp->expire_at)){
            return $userOtp;
        }
  
        /* Create a New OTP */
        return UserOtp::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => $now->addMinutes(10)
        ]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function verification($user_id)
    {
        return view('auth.otp-verification')->with([
            'user_id' => $user_id
        ]);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function loginWithOtp(Request $request)
    {
        /* Validation */
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required'
        ]);  
  
        /* Validation Logic */
        $userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->first();
  
        $now = Carbon::now();
        if (!$userOtp) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }else if($userOtp && $now->isAfter($userOtp->expire_at)){
            return redirect()->route('otp.login')->with('error', 'Your OTP has been expired');
        }
        
        else{
            $user = User::whereId($request->user_id)->first();
  
            if($user){
                
                $userOtp->update([
                    'expire_at' => now()
                ]);
    
                Auth::login($user);
    
                return redirect('/dashboard');
            }
        }
        
  
        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }
}
