<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BHWController extends Controller
{
    public function dashboard()
    {
        return view('bhw.dashboard');
    }
    public function request()
    {
        return view('bhw.Requestlist');
    }
    public function home()
    {
        return view('bhw.home');
    }
}
