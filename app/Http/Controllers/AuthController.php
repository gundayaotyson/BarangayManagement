<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BarangayOfficial;
use Illuminate\Support\Facades\Hash;
use App\Models\Resident;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login Request
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Welcome Admin!');
            } elseif ($user->role === 'user') {
                return redirect()->route('skuser.dashboard')->with('success', 'Welcome User!');
            } elseif ($user->role === 'BHW') {
                return redirect()->route('bhw.dashboard')->with('success', 'Welcome BHW!');
            } elseif ($user->role === 'Senior') {
                return redirect()->route('senior.dashboard')->with('success', 'Welcome Senior!');
            } elseif ($user->role === '4ps') {
                return redirect()->route('4ps.dashboard')->with('success', 'Welcome 4ps!');
            } elseif ($user->role === 'resident') {
                    $resident = Resident::where('email', $user->email)->first();
                if (BarangayOfficial::where('resident_id', $resident->id)->exists()) {
                    return redirect()->route('barangay_official.dashboard', ['id' => $resident->id])->with('success', 'Welcome Barangay Official!');
                } else {
                    return redirect()->route('resident.dashboard')->with('success', 'Welcome Resident!');
                }
            }
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    // Show Registration Form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle Registration Request
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'resident',
        ]);

        Auth::login($user);

        return redirect()->route('resident.dashboard');
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out.');
    }
}
