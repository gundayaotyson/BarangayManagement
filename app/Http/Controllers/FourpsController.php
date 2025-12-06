<?php

namespace App\Http\Controllers;

use App\Models\Fourps;
use App\Models\FourpsRequest;
use App\Models\Resident;
use Illuminate\Http\Request;

class FourpsController extends Controller
{
    public function dashboard()
    {
        return view('4ps.dashboard');
    }

    public function ResidentList()
    {
        $fourps = Fourps::with('resident')->get();
        $residents = Resident::all();
        return view('4ps.residentlist', compact('fourps', 'residents'));
    }

    public function home()
    {
        $totalResidents = Fourps::count();
        $totalRequests = FourpsRequest::count();
        $pendingRequests = FourpsRequest::where('status', 'pending')->count();
        $acceptedRequests = FourpsRequest::where('status', 'accepted')->count();
        $rejectedRequests = FourpsRequest::where('status', 'rejected')->count();

        return view('4ps.home', compact(
            'totalResidents',
            'totalRequests',
            'pendingRequests',
            'acceptedRequests',
            'rejectedRequests'
        ));
    }

    public function requestslist()
    {
        $requests = FourpsRequest::with('resident')->where('status', '!=', 'accepted')->paginate(10);
        return view('4ps.requestslist', compact('requests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'lastname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'fourps_id' => 'required',
            'purok_no' => 'required',
            'household_no' => 'required',
        ]);

        FourpsRequest::create($request->all());

        return redirect()->route('resident.services')
            ->with('success', 'Request created successfully.');
    }

    public function update(Request $request, FourpsRequest $fourpsRequest)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $fourpsRequest->update($request->all());

        if ($request->status == 'accepted') {
            Fourps::create([
                'resident_id' => $fourpsRequest->resident_id,
                'fname' => $fourpsRequest->firstname,
                'mname' => $fourpsRequest->middlename,
                'lname' => $fourpsRequest->lastname,
                'purok_no' => $fourpsRequest->purok_no,
                'household_no' => $fourpsRequest->house_no,
                'fourps_id' => $fourpsRequest->fourps_id,
                'status' => 'Active',
            ]);
        }

        return redirect()->route('4ps.requestslist')
            ->with('success', 'Request updated successfully.');
    }

    public function cancel(FourpsRequest $fourpsRequest)
    {
        $fourpsRequest->update(['status' => 'cancelled']);

        return redirect()->route('4ps.requestslist')
            ->with('success', 'Request cancelled successfully.');
    }

    public function storeReslist(Request $request)
    {
        $request->validate([
            'resident_id' => 'nullable|exists:residents,id',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'purok_no' => 'required|string|max:50',
            'household_no' => 'required|string|max:50',
            'fourps_id' => 'required|string|max:100|unique:fourps,fourps_id',
            'status' => 'required|in:active,inactive',
        ]);

        Fourps::create($request->all());

        return redirect()->route('4ps.residentlist')
            ->with('success', '4Ps beneficiary added successfully.');
    }

    public function updateReslist(Request $request, $id)
    {
        $fourps = Fourps::findOrFail($id);

        $request->validate([
            'resident_id' => 'nullable|exists:residents,id',
            'fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'purok_no' => 'required|string|max:50',
            'household_no' => 'required|string|max:50',
            'fourps_id' => 'required|string|max:100|unique:fourps,fourps_id,' . $id,
            'status' => 'required|in:active,inactive',
        ]);

        $fourps->update($request->all());

        return redirect()->route('4ps.residentlist')
            ->with('success', '4Ps beneficiary updated successfully.');
    }

    public function DestroyReslist(Fourps $fourp)
    {
        $fourp->delete();
        return redirect()->route('4ps.residentlist')->with('success', '4Ps beneficiary deleted successfully.');
    }

  public function searchResident(Request $request)
    {
        if ($request->has('resident_id')) {
            $resident = Resident::select('id','fname','mname','lname','purok_no','household_no')
                ->where('id', $request->resident_id)
                ->first();
            return $resident ? response()->json([$resident]) : response()->json([]);
        }

        $query = $request->input('query', '');
        if (empty($query)) return response()->json([]);

        $residents = Resident::select('id','fname','mname','lname','purok_no','household_no')
            ->where('fname', 'LIKE', "%{$query}%")
            ->orWhere('mname', 'LIKE', "%{$query}%")
            ->orWhere('lname', 'LIKE', "%{$query}%")
            ->orWhereRaw("CONCAT(fname,' ',lname) LIKE ?", ["%{$query}%"])
            ->orWhereRaw("CONCAT(fname,' ',mname,' ',lname) LIKE ?", ["%{$query}%"])
            ->limit(10)
            ->get();

        return response()->json($residents);
    }


    public function getResident(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id'
        ]);

        $resident = Resident::select('id','Fname as fname','mname','lname','purok_no','household_no')
            ->where('id', $request->resident_id)
            ->first();

        if ($resident) {
            return response()->json($resident);
        }

        return response()->json(['error' => 'Resident not found'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fourps = Fourps::with('resident')->findOrFail($id);
        return view('4ps.show', compact('fourps'));
    }

    /**
     * Edit form for the specified resource.
     */
    public function edit($id)
    {
        $fourps = Fourps::findOrFail($id);
        $residents = Resident::all();
        return view('4ps.edit', compact('fourps', 'residents'));
    }
}
