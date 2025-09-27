<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkService;

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
        $skServices = SkService::all();
        return view('skuser.services', compact('skServices'));
    }
}
