<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Senior;
use Illuminate\Http\Request;

class SeniorController extends Controller
{
    public function dashboard()
    {
        return view('senior.dashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'birthday' => 'required|date',
            'osca_id' => 'required|string|max:255|unique:seniors',
            'fcap_id' => 'required|string|max:255|unique:seniors',
        ]);

        $resident = Resident::where('lname', $request->lastname)
                            ->where('Fname', $request->firstname)
                            ->when($request->filled('middlename'), function ($query) use ($request) {
                                return $query->where('mname', $request->middlename);
                            })
                            ->first();

        Senior::create([
            'resident_id' => $resident ? $resident->id : null,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'birthday' => $request->birthday,
            'osca_id' => $request->osca_id,
            'fcap_id' => $request->fcap_id,
        ]);

        return redirect()->route('senior.list')->with('success', 'Senior added successfully.');
    }

    public function list()
    {
        $seniors = Senior::with('resident')->latest()->get();
        return view('senior.list', compact('seniors'));
    }

    public function getSeniorJson(Senior $senior)
    {
        return response()->json($senior);
    }

    public function update(Request $request, Senior $senior)
    {
        $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'birthday' => 'required|date',
            'osca_id' => 'required|string|max:255|unique:seniors,osca_id,' . $senior->id,
            'fcap_id' => 'required|string|max:255|unique:seniors,fcap_id,' . $senior->id,
        ]);

        $resident = Resident::where('lname', $request->lastname)
                            ->where('Fname', $request->firstname)
                            ->when($request->filled('middlename'), function ($query) use ($request) {
                                return $query->where('mname', $request->middlename);
                            })
                            ->first();

        $senior->update([
            'resident_id' => $resident ? $resident->id : null,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'birthday' => $request->birthday,
            'osca_id' => $request->osca_id,
            'fcap_id' => $request->fcap_id,
        ]);

        return redirect()->route('senior.list')->with('success', 'Senior updated successfully.');
    }

    public function destroy(Senior $senior)
    {
        $senior->delete();
        return redirect()->route('senior.list')->with('success', 'Senior deleted successfully.');
    }
}
