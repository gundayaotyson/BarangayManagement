<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BhwRequest;
use App\Models\Pregnant;
use App\Models\Resident;
use App\Models\newdelivery;

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
        $totalRequests = BhwRequest::count();
        $pendingRequests = BhwRequest::where('status', 'Pending')->count();
        $scheduledRequests = BhwRequest::where('status', 'Scheduled')->count();
        $totalPregnant = Pregnant::count();
        $totalNewDelivery = newdelivery::count();
        $maleBabies = newdelivery::where('gender', 'Male')->count();
        $femaleBabies = newdelivery::where('gender', 'Female')->count();
        $recentRequests = BhwRequest::with('resident')->orderBy('created_at', 'desc')->get();
        $recentSchedules = BhwRequest::with('resident')->where('status', 'Scheduled')->orderBy('sched_date', 'desc')->get();

        return view('bhw.home', compact(
            'totalRequests',
            'pendingRequests',
            'scheduledRequests',
            'totalPregnant',
            'totalNewDelivery',
            'maleBabies',
            'femaleBabies',
            'recentRequests',
            'recentSchedules'
        ));
    }

    public function pregnant()
    {
        $pregnants = Pregnant::all();
        return view('bhw.pregnant', compact('pregnants'));
    }

    public function newdeliver()
    {
        $newdeliveries = newdelivery::all();
        return view('bhw.newdeliverpregnant', compact('newdeliveries'));
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
            'resident_id' => 'nullable|exists:residents,id',
            'Fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'age' => 'required|integer',
            'household_no' => 'required|string|max:255',
            'purok_no' => 'required|string|max:255',
            'sitio' => 'required|string|max:255',
            'LMP_date' => 'required|date',
            'EMC_date' => 'required|date',
        ]);

        // Save Pregnant record
        Pregnant::create($validated);

        return redirect()->route('bhw.pregnant')->with('success', 'Pregnant record added successfully!');
    }

    public function updatePregnant(Request $request, $id)
    {
        // Validate inputs
        $validated = $request->validate([
            'resident_id' => 'nullable|exists:residents,id',
            'Fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'age' => 'required|integer',
            'household_no' => 'required|string|max:255',
            'purok_no' => 'required|string|max:255',
            'sitio' => 'required|string|max:255',
            'LMP_date' => 'required|date',
            'EMC_date' => 'required|date',
        ]);

        // Find and update Pregnant record
        $pregnant = Pregnant::findOrFail($id);
        $pregnant->update($validated);

        return redirect()->route('bhw.pregnant')->with('success', 'Pregnant record updated successfully!');
    }

    public function destroyPregnant($id)
    {
        $pregnant = Pregnant::findOrFail($id);
        $pregnant->delete();

        return redirect()->route('bhw.pregnant')->with('success', 'Pregnant record deleted successfully!');
    }

    public function storeNewDelivery(Request $request)
    {
        $validatedData = $request->validate([
            'resident_id' => 'nullable|exists:residents,id',
            'pregnants_id' => 'nullable|exists:pregnants,id',

            'p_fname' => 'required|string|max:255',
            'p_mname' => 'nullable|string|max:255',
            'p_lname' => 'required|string|max:255',

            'age' => 'required|integer',
            'birthday' => 'required|date',

            'purok_no' => 'required|string',
            'sitio' => 'required|string',
            'household_no' => 'required|string',

            'placeofbirth' => 'required|string',
            'typeof_birth' => 'required|string',

            'c_fname' => 'required|string',
            'c_mname' => 'nullable|string',
            'c_lname' => 'required|string',

            'c_birthday' => 'required|date',
            'time' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'gender' => 'required',
        ]);

        // Auto-detect pregnancy
        if (!$request->pregnants_id && $request->resident_id) {
            $preg = Pregnant::where('resident_id', $request->resident_id)->first();
            $validatedData['pregnants_id'] = $preg ? $preg->id : null;
        }

        newdelivery::create($validatedData);

        return redirect()->route('bhw.newdeliverpregnant')
            ->with('success', 'New delivery record saved successfully!');
    }

    public function updateNewDelivery(Request $request, $id)
    {
        $validatedData = $request->validate([
            'resident_id' => 'nullable|exists:residents,id',
            'pregnants_id' => 'nullable|exists:pregnants,id',

            'p_fname' => 'required|string|max:255',
            'p_mname' => 'nullable|string|max:255',
            'p_lname' => 'required|string|max:255',

            'age' => 'required|integer',
            'birthday' => 'required|date',

            'purok_no' => 'required|string',
            'sitio' => 'required|string',
            'household_no' => 'required|string',

            'placeofbirth' => 'required|string',
            'typeof_birth' => 'required|string',

            'c_fname' => 'required|string',
            'c_mname' => 'nullable|string',
            'c_lname' => 'required|string',

            'c_birthday' => 'required|date',
            'time' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'gender' => 'required',
        ]);

        // Auto-detect pregnancy if missing
        if (!$request->pregnants_id && $request->resident_id) {
            $preg = Pregnant::where('resident_id', $request->resident_id)->first();
            $validatedData['pregnants_id'] = $preg ? $preg->id : null;
        }

        $delivery = newdelivery::findOrFail($id);
        $delivery->update($validatedData);

        return redirect()->route('bhw.newdeliverpregnant')
            ->with('success', 'New delivery record updated successfully!');
    }

  public function searchResidents(Request $request)
{
    $query = $request->get('query');
    $resident_id = $request->get('resident_id');

    if ($resident_id) {
        // Search by specific ID
        $residents = Resident::where('id', $resident_id)
            ->get(['id', 'fname', 'mname', 'lname', 'birthday', 'household_no', 'purok_no', 'sitio']);
    } else {
        // Search by name
        $residents = Resident::where('fname', 'LIKE', "%{$query}%")
            ->orWhere('mname', 'LIKE', "%{$query}%")
            ->orWhere('lname', 'LIKE', "%{$query}%")
            ->get(['id', 'fname', 'mname', 'lname', 'birthday', 'household_no', 'purok_no', 'sitio']);
    }

    return response()->json($residents);
}
}
