<?php

namespace App\Http\Controllers;

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

        return view('4ps.residentlist');
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
}
