<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeniorController extends Controller
{
    public function dashboard()
    {
        return view('senior.dashboard');
    }
}
