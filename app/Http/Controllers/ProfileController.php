<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import User model
use Illuminate\Support\Facades\Storage; // Import Storage for file handling

class ProfileController extends Controller
{
    // Show Edit Profile Form
    public function editProfile()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('partials.profile', compact('user'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        $user = Auth::user(); // Get logged-in user

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // Handle Profile Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($user->image && Storage::disk('public')->exists('profile_images/' . $user->image)) {
                Storage::disk('public')->delete('profile_images/' . $user->image);
            }

            // Store new image
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = basename($imagePath);
        }

        // Update User Data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
