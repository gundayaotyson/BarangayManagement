<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BhwRequest;
 use App\Models\Pregnant;
 use App\Models\Resident;
class BHWController extends Controller
{
    public function dashboard()
    {
        return view('bhw.dashboard');
    }
    public function request()
    {
        $requests = BhwRequest::all();
        return view('bhw.Requestlist', compact('requests'));
    }
    public function home()
    {
        return view('bhw.home');
    }
    public function pregnant()
    {
          $pregnants = Pregnant::all();
     return view('bhw.pregnant', compact('pregnants'));
    }
    public function newdeliver()
    {
        return view('bhw.newdeliverpregnant');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'dob' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string|max:255',
            'purok_no' => 'required|string|max:255',
            'sitio' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'contact_no' => 'required|string|max:255',
            'chief_complaint' => 'required|string',
            'phil_no' => 'nullable|string|max:255',
        ]);

        BhwRequest::create($validatedData);

        return redirect()->route('resident.services')->with('success', 'BHW Service request submitted successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sched_date' => 'required|date',
        ]);

        $bhwRequest = BhwRequest::findOrFail($id);
        $bhwRequest->update([
            'sched_date' => $request->sched_date,
            'status' => 'Scheduled'
        ]);

        return redirect()->route('bhw.Requestlist')->with('success', 'Schedule has been set successfully!');
    }

    public function destroy($id)
    {
        $bhwRequest = BhwRequest::findOrFail($id);
        $bhwRequest->delete();

        return redirect()->route('bhw.Requestlist')->with('success', 'Request has been deleted successfully!');
    }


public function storePregnant(Request $request)
{
    // Validate inputs
    $validated = $request->validate([
        'resident_id' => 'required|exists:residents,id',
        'Fname' => 'required|string|max:255',
        'mname' => 'nullable|string|max:255',
        'lname' => 'required|string|max:255',
        'birthday' => 'required|date',
        'household_no' => 'required|string|max:255',
        'purok_no' => 'required|string|max:255',
        'sitio' => 'required|string|max:255',
        'LMP_date' => 'required|date',
        'EMC_date' => 'required|date',
    ]);

    // Save Pregnant record
    Pregnant::create($validated);

    return redirect()->back()->with('success', 'Pregnant record added successfully!');
}
// public function searchResidents(Request $request)
// {
//     $query = $request->get('query');

//     $residents = Resident::where('Fname', 'like', "%{$query}%")
//         ->orWhere('lname', 'like', "%{$query}%")
//         ->get();

//     return response()->json($residents);
// }
public function searchResidents(Request $request)
{
    $query = $request->get('query');

    $residents = Resident::where('fname', 'LIKE', "%{$query}%")
        ->orWhere('lname', 'LIKE', "%{$query}%")
        ->get(['id', 'fname', 'mname', 'lname', 'birthday', 'household_no', 'purok_no', 'sitio']);

    return response()->json($residents);
}



}
