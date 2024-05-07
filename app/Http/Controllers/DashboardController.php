<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        if(auth()->user()->role === 'admin') {
            return view('admin.dashboard');
        } else if (auth()->user()->role === 'operational head') {
            return view('op.dashboard');
        }
    }

    public function opIndex() {
        return view('op.dashboard');
    }
}
