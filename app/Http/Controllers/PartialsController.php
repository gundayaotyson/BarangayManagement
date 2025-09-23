<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class PartialsController extends Controller
{
    public function editProfile()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('partials.profile', compact('user'));
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Get authenticated user

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
        }

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

}



