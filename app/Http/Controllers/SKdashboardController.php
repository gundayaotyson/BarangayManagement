<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SKdashboardController extends Controller
{
    public function index(){
        return view('skuser.dashboard');
     }

    public function home(){
        return view('skuser.home');
    }

    public function projects(){
        return view('skuser.projects');
    }

    public function services(){
        return view('skuser.services');
    }
}
