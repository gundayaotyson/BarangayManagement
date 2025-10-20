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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $resident = Resident::where('Fname', $request->Fname)
                            ->where('lname', $request->lname)
                            ->where('birthday', $request->birthday)
                            ->first();

        if ($resident) {
            // If resident exists, just create a user account
            $user = User::create([
                'name' => $resident->Fname . ' ' . $resident->lname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'resident',
            ]);

        } else {
            // If resident does not exist, create both resident and user
            $resident = Resident::create([
                'Fname' => $request->Fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'email' => $request->email,
            ]);

            $user = User::create([
                'name' => $request->Fname . ' ' . $request->lname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'resident',
            ]);
        }

        Auth::login($user);

        return redirect()->route('resident.dashboard');
    }
}
