<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ResidentRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.resident-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'Fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string',
            'birthday' => 'required|date',
            'birthplace' => 'required|string|max:255',
            'civil_status' => 'required|string',
            'Citizenship' => 'required|string|max:255',
            'household_no' => 'required|string|max:255',
            'purok_no' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $resident = Resident::create([
            'Fname' => $request->Fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'birthplace' => $request->birthplace,
            'civil_status' => $request->civil_status,
            'Citizenship' => $request->Citizenship,
            'contact_number' => $request->contact_number,
            'occupation' => $request->occupation,
            'household_no' => $request->household_no,
            'purok_no' => $request->purok_no,
            'sitio' => $request->sitio,
            'email' => $request->email,
        ]);

        $user = User::create([
            'name' => $request->Fname . ' ' . $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'resident',
        ]);

        Auth::login($user);

        return redirect()->route('resident.dashboard');
    }
}
