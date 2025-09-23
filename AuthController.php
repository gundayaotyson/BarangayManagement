<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login'); // Make sure you have a 'login.blade.php' inside 'resources/views/auth/'
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
            }
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the user
        $request->session()->invalidate(); // Destroys session
        $request->session()->regenerateToken(); // Prevents CSRF attacks

        return redirect()->route('login')->with('status', 'You have been logged out.');
    }
}
