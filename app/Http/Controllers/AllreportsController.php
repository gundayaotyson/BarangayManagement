<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllreportsController extends Controller
{
public function index(){
    return view("admin.partials.reports");
}
}
