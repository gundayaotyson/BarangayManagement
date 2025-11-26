<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seniorservices;
use App\Models\Resident;
use App\Models\Senior;
use Carbon\Carbon;

class SeniorReqController extends Controller
{
    /**
     * Show the senior request form
     */
    public function request()
    {
        $requests = Seniorservices::latest()->get();
        $resident = auth()->user()->resident ?? null;

        $statusCounts = [
            'pending' => Seniorservices::where('status', 'pending')->count(),
            'processing' => Seniorservices::where('status', 'processing')->count(),
            'accept' => Seniorservices::where('status', 'accept')->count(),
            'rejected' => Seniorservices::where('status', 'rejected')->count(),
        ];

        return view('senior.Request', compact('resident', 'requests', 'statusCounts'));
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

        return redirect()->back()->with('success', 'Senior service request submitted successfully.');
    }

    /**
     * Update the status of a senior service request.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,accept,rejected'
        ]);

        $seniorRequest = Seniorservices::find($id);
        if (!$seniorRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Request not found.'
            ], 404);
        }

        $newStatus = $request->status;

        $seniorRequest->status = $newStatus;

        if ($newStatus === 'accept') {
            $seniorRequest->accept_date = now();

            // Check if senior already exists to avoid duplicates
            $existingSenior = Senior::where('osca_id', $seniorRequest->oscaId)->first();

            if (!$existingSenior) {
                Senior::create([
                    'resident_id' => $seniorRequest->resident_id,
                    'lastname' => $seniorRequest->last_name,
                    'firstname' => $seniorRequest->first_name,
                    'middlename' => $seniorRequest->middle_name,
                    'birthday' => $seniorRequest->dob,
                    'osca_id' => $seniorRequest->oscaId,
                    'fcap_id' => $seniorRequest->fcapId,
                ]);
            }
        } else {
            $seniorRequest->accept_date = null;
        }

        $seniorRequest->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully.',
            'request' => [
                'id' => $seniorRequest->id,
                'status' => $seniorRequest->status,
                'accept_date' => $seniorRequest->accept_date ? $seniorRequest->accept_date->format('Y-m-d') : null,
            ]
        ]);
    }

    /**
     * Delete a senior service request.
     */
    public function destroy($id)
    {
        $seniorRequest = Seniorservices::find($id);

        if (!$seniorRequest) {
            return redirect()->back()->with('error', 'Request not found.');
        }

        $seniorRequest->delete();

        return redirect()->route('senior.req.request')->with('success', 'Request deleted successfully.');
    }
}
