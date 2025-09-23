<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FourpsController extends Controller
{
    public function dashboard()
    {
        return view('4ps.dashboard');
    }
}
