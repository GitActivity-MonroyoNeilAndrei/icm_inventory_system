<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function forgetPassword() {
        return view('auth.forget-password');
    }

    public function forgetPasswordPost(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.emailSent', ['token' => $token], function ($message) use ($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->route('forget.password')->with('success', 'we have send an email');
    }

    public function resetPassword($token) {
        return view('auth.new-password', compact('token'));
    }

    public function resetPasswordPost(Request $request) {
        $request->validate([
            'email' => 'exists:users',
            'password' => 'min:6|confirmed',
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token

        ])->first();

        if(!$updatePassword) {
            return redirect()->route('reset.password')->with('error', "Invalid");
        }

        // User::where('email', $request->email)->update(['password', $request->password]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = $request->password;

            $user->save();
        }

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('success', 'Password Reset Successfull');
    }

}
