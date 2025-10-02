<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;
use App\Models\Clearancereq;
use App\Models\SKService;

class ResidentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $resident = Resident::where('email', $user->email)->first();
        return view('resident.dashboard', compact('resident'));
    }

   public function services()
{
    $user = Auth::user();

    // Prefer a relation if you later add user_id & relation
    // $resident = $user->resident ?? Resident::where('email', $user->email)->first();

    // For now: find by email (backwards-compatible with your current code)
    $resident = Resident::where('email', $user->email)->first();

    // If no resident found, return empty collection for $skServices (avoid null errors)
    if ($resident) {
        $skServices = SKService::where('resident_id', $resident->id)->latest()->get();
    } else {
        $skServices = collect(); // empty collection
    }

    return view('resident.services', compact('resident', 'skServices'));
}

    public function complaints()
    {
        return view('resident.complaints');
    }

    public function requests()
    {
        $user = Auth::user();
        $resident = Resident::where('email', $user->email)->first();

        if ($resident) {
            $requests = Clearancereq::where('resident_id', $resident->id)->get();
        } else {
            $requests = collect(); // Empty collection if no resident found
        }

        return view('resident.requests', compact('resident', 'requests'));
    }

}
