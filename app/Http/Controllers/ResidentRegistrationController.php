<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resident;
use App\Models\BarangayOfficial;
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

    // Check if the registering person is a barangay official
    $isOfficial = BarangayOfficial::where('fname', $request->Fname)
                                    ->where('lname', $request->lname)
                                    ->exists();

    // The role will always be 'resident'
    $role = 'resident';

    // Check if resident already exists
    $resident = Resident::where('Fname', $request->Fname)
                        ->where('lname', $request->lname)
                        ->where('birthday', $request->birthday)
                        ->first();

    if ($resident) {

        // ✅ If resident exists → update their email
        $resident->update([
            'email' => $request->email
        ]);

        // Create user account linked to existing resident
        $user = User::create([
            'name' => $resident->Fname . ' ' . $resident->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role, // Role is set to 'resident'
            'resident_id' => $resident->id,
        ]);

    } else {

        // ❌ Resident does not exist → create new one
        $resident = Resident::create([
            'Fname' => $request->Fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'email' => $request->email,
        ]);

        // Create user account linked to new resident
        $user = User::create([
            'name' => $request->Fname . ' ' . $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role, // Role is set to 'resident'
            'resident_id' => $resident->id,
        ]);
    }

    Auth::login($user);

    // Redirect based on whether they are an official, even if role is 'resident'
    if ($isOfficial) {
        return redirect()->route('barangay_official.dashboard');
    }

    return redirect()->route('resident.dashboard');
}

}
