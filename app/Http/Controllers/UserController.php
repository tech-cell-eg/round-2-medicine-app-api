<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyPhoneRequest;
use App\Models\User;
use App\Notifications\Notifications;
use Illuminate\Http\Request;
use Notification;

class UserController extends Controller
{
    public function verifyPhoneOtp(VerifyPhoneRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->phone_otp === $request->phone_otp) {

            $user->update(['phone_otp' => null]); 
            return response()->json(['message' => 'Phone verified successfully']);

        } else {
            
            return response()->json(['message' => 'Invalid OTP'], 400);
        }
    }
}
