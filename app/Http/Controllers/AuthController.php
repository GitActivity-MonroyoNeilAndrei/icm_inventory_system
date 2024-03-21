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
        return view('admin.auth.login');
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
            
            return redirect()->route('admin/dashboard')->with('success', 'Logged in successfully');
        }

        return redirect()->back()->with('fail', 'Incorrect Inputs');
    }
}
