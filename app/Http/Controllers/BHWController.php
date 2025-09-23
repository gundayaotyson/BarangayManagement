<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BHWController extends Controller
{
    public function dashboard()
    {
        return view('bhw.dashboard');
    }
}
