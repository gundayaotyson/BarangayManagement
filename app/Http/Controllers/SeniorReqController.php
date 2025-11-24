<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seniorservices;
use App\Models\Resident;
use Carbon\Carbon;

class SeniorReqController extends Controller
{
    // Show the request form
    public function request()
    {
        return view('senior.Request');
    }

    // Save the senior request to the database
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'house_no' => 'required|string|max:50',
            'purok' => 'required|string',
            'oscaId' => 'required|string|max:255|unique:senior_services',
            'fcapId' => 'nullable|string|max:255|unique:senior_services',
        ]);

        // Find the resident if exists
        $resident = Resident::where('lname', $request->lastname)
                            ->where('Fname', $request->firstname)
                            ->when($request->filled('middlename'), function ($query) use ($request) {
                                return $query->where('mname', $request->middlename);
                            })
                            ->first();

        // Auto-set sitio based on Purok
        $sitio = match($request->purok) {
            'Purok 1' => 'Leksab',
            'Purok 2' => 'Taew',
            'Purok 3' => 'Pidlaoan',
            default => 'N/A',
        };

        // Create the senior service request
        Seniorservices::create([
            'resident_id' => $resident?->id,
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

        return redirect()->route('senior.req.request')->with('success', 'Senior service request submitted successfully.');
    }
}
