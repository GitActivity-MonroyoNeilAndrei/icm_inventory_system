<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    use HasFactory;

    public function login() 
    {
        return view('auth.login');
    }

    public function authenticate() 
    {
        $validated = request()->validate(
            [
                'email' => 'email',
                'password' => 'min:1'
            ]
        );

        if(auth()->attempt($validated)) {

            request()->session()->regenerate();

            $changePassword = auth()->user()->changePassword;
            $userId = auth()->user()->id;


            if(auth()->user()->status == 'deactivated') {
                return redirect()->back()->with('deactivated', 'This account has been Deactivated');
            }

            if(auth()->user()->role == 'admin') 
            {
                
                if($changePassword === 0) {
                    return redirect()->route('changePassword', $userId);
                }

                return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully');
            }

            if (auth()->user()->role == 'user') 
            {

                if($changePassword === 0) {
                    return redirect()->route('changePassword', $userId);
                }

                return redirect()->route('user.dashboard')->with('success', 'Logged in successfully');
            }
        }

        return redirect()->back()->with('fail', 'Incorrect Inputs');
    }


    public function logout()
    {
        Auth()->logout();

        return redirect()->route('login');
    }
}
