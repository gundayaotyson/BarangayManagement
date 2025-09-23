<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Clearancereq;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ManageresidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residents = Resident::paginate(10);
        return view('admin.residents', compact('residents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.residentslist');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'Fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date',
            'birthplace' => 'required|string|max:255',
            'civil_status' => 'required|in:Single,Married,Widowed,Separated,Divorced',
            'contact_number' => 'nullable|string|max:15',
            'occupation' => 'nullable|string|max:255',
            'Citizenship' => 'required|string|max:255',
            'household_no' => 'required|string|max:255',
            'purok_no' => 'required|in:Purok 1,Purok 2,Purok 3',
            'sitio' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Calculate age using Carbon
        $age = Carbon::parse($request->birthday)->age;
               // Handle the image upload if a file is provided
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('resident_images', 'public');
            }
        // Create new resident instance
        $resident = new Resident();
        $resident->Fname = $request->input('Fname');
        $resident->mname = $request->input('mname');
        $resident->lname = $request->input('lname');
        $resident->gender = $request->input('gender');
        $resident->birthday = $request->input('birthday');
        $resident->birthplace = $request->input('birthplace');
        $resident->civil_status = $request->input('civil_status');
        $resident->contact_number = $request->input('contact_number');
        $resident->occupation = $request->input('occupation');
        $resident->Citizenship = $request->input('Citizenship');
        $resident->household_no = $request->input('household_no');
        $resident->purok_no = $request->input('purok_no');
        $resident->sitio = $request->input('sitio');
        $resident->religion = $request->input('religion');
        $resident->image = $imagePath;
        $resident->age = $age;

        // Save resident
        $resident->save();

        // Redirect back with success message
        return redirect()->route('residents')->with('success', 'Resident added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resident = Resident::findOrFail($id);
        return response()->json($resident);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resident = Resident::findOrFail($id);
        return response()->json($resident);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate form inputs
        $request->validate([
            'Fname' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date',
            'birthplace' => 'required|string|max:255',
            'civil_status' => 'required|in:Single,Married,Widowed,Separated,Divorced',
            'contact_number' => 'nullable|string|max:15',
            'occupation' => 'nullable|string|max:255',
            'Citizenship' => 'required|string|max:255',
            'household_no' => 'required|string|max:255',
            'purok_no' => 'required|in:Purok 1,Purok 2,Purok 3',
            'sitio' => 'nullable|string|max:255',
            'religion' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $resident = Resident::findOrFail($id);

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('resident_images', 'public');
            $resident->image = $imagePath; // Update image path
        }

        // Calculate age using Carbon
        $age = Carbon::parse($request->birthday)->age;

        // Find resident and update
        $resident->Fname = $request->input('Fname');
        $resident->mname = $request->input('mname');
        $resident->lname = $request->input('lname');
        $resident->gender = $request->input('gender');
        $resident->birthday = $request->input('birthday');
        $resident->birthplace = $request->input('birthplace');
        $resident->civil_status = $request->input('civil_status');
        $resident->contact_number = $request->input('contact_number');
        $resident->occupation = $request->input('occupation');
        $resident->Citizenship = $request->input('Citizenship');
        $resident->household_no = $request->input('household_no');
        $resident->purok_no = $request->input('purok_no');
        $resident->sitio = $request->input('sitio');
        $resident->religion = $request->input('religion');
        // $resident->age = $age;

        // Recalculate age
        $resident->age = Carbon::parse($request->birthday)->age;



        // Save updates
        $resident->save();

        return response()->json(['success' => 'Resident updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Resident::findOrFail($id);
        $item->delete();
        return response()->json(['success' => 'Resident deleted successfully!']);
    }

    public function clearanceRequested()
{
    // Eager load the 'resident' relationship
    $clearanceRequests = ClearanceReq::with('resident')->get();
    return view('admin.requestedclearance', compact('clearanceRequests'));
}

}
