<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        if(auth()->user()->role === 'admin') {
            return view('admin.dashboard');
        } else if (auth()->user()->role === 'user') {
            return view('user.dashboard');
        }
    }

    public function userIndex() {
        return view('user.dashboard');
    }
}
