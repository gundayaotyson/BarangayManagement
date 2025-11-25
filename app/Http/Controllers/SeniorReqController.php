<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seniorservices;
use App\Models\Resident;
use Carbon\Carbon;

class SeniorReqController extends Controller
{
    /**
     * Show the senior request form
     */
    public function request()
    {
        $resident = auth()->user()->resident ?? null;

        // Get all requests for this resident
        $requests = Seniorservices::where('resident_id', $resident?->id)
                          ->latest()
                          ->get();


        return view('senior.Request', compact('resident', 'requests'));
    }

    /**
     * Store the senior service request
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'house_no' => 'required|string|max:50',
            'purok' => 'required|string',
                'oscaId' => 'required|string|max:255|unique:senior_services',
                'fcapId' => 'required|string|max:255|unique:senior_services',
        ]);

        // Find the resident if exists
        $resident = Resident::where('lname', $request->lastname)
                            ->where('Fname', $request->firstname)
                            ->when($request->filled('middlename'), function ($query) use ($request) {
                                return $query->where('mname', $request->middlename);
                            })
                            ->first();

        if (!$resident) {
            return redirect()->back()->withErrors(['resident' => 'Resident not found.']);
        }

        // Auto-set sitio based on Purok
        $sitio = match($request->purok) {
            'Purok 1' => 'Leksab',
            'Purok 2' => 'Taew',
            'Purok 3' => 'Pidlaoan',
            default => 'N/A',
        };

        // Create the senior service request
        Seniorservices::create([
            'resident_id' => $resident->id,
            'first_name' => $request->firstname,
            'middle_name' => $request->middlename,
            'last_name' => $request->lastname,
            'dob' => $request->dob,
            'age' => Carbon::parse($request->dob)->age,
            'gender' => $request->gender,
            'house_no' => $request->house_no,
            'purok' => $request->purok,
            'sitio' => $sitio,
            'oscaId' => $request->oscaId,
            'fcapId' => $request->fcapId,
            'status' => 'pending',
            'request_date' => now(),
            'accept_date' => null,
        ]);

        // Redirect back with success message

        return redirect()->back()->with('success', 'Senior service request submitted successfully.');
    }


}
