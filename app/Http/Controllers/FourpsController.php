<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class FourpsController extends Controller
{
    public function dashboard()
    {
        return view('4ps.dashboard');
    }
    public function ResidentList()
    {

        return view('4ps.residentlist');
    }

    public function home()
    {
        return view('4ps.home');
    }
}
