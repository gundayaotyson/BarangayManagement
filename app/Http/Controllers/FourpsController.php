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
        return view('4ps.home');
    }
    public function requestslist()
    {
        $requests = FourpsRequest::with('resident')->paginate(10);

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
            'house_no' => 'required',
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
            'fname' => 'required',
            'mname' => 'required',
            'lname' => 'required',
            'purok_no' => 'required',
            'house_no' => 'required',
            'fourps_id' => 'required|unique:fourps,fourps_id',
            'status' => 'required',
        ]);

        Fourps::create($request->all());

        return redirect()->route('4ps.residentlist')
            ->with('success', '4Ps beneficiary added successfully.');
    }


    public function DestroyReslist(Fourps $fourp)
    {
        $fourp->delete();

        return redirect()->route('4ps.residentlist')
            ->with('success', '4Ps beneficiary deleted successfully.');
    }

    public function searchResidents(Request $request)
    {
        $searchTerm = $request->input('term');
        $residentId = $request->input('resident_id');

        // If searching by specific resident ID (for edit modal)
        if ($residentId) {
            $resident = Resident::find($residentId);
            if ($resident) {
                return response()->json([[
                    'id' => $resident->id,
                    'fname' => $resident->fname,
                    'mname' => $resident->mname,
                    'lname' => $resident->lname,
                    'purok_no' => $resident->purok_no,
                    'house_no' => $resident->house_no,
                ]]);
            }
            return response()->json([]);
        }

        // If searching by name
        $residents = Resident::where('fname', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('lname', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('mname', 'LIKE', '%' . $searchTerm . '%')
            ->select('id', 'fname', 'mname', 'lname', 'purok_no', 'house_no')
            ->limit(10)
            ->get();

        $formattedResidents = [];
        foreach ($residents as $resident) {
            $formattedResidents[] = [
                'id' => $resident->id,
                'fname' => $resident->fname,
                'mname' => $resident->mname,
                'lname' => $resident->lname,
                'purok_no' => $resident->purok_no,
                'house_no' => $resident->house_no,
            ];
        }

        return response()->json($formattedResidents);
    }
}
