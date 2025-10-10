<?php

namespace App\Http\Controllers;
use App\Models\Resident;
use App\Models\BarangayOfficial;
use Illuminate\Http\Request;

class BarangayofficialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officials = BarangayOfficial::with('resident')->get();

        return view('officialsandstaff.brgyofficials', compact('officials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
{
    $request->validate([
        'fname'      => 'required|string|max:255',
        'mname'      => 'nullable|string|max:255',
        'lname'      => 'required|string|max:255',
        'position'   => 'required|string|max:255',
        'term_start' => 'required|date',
        'term_end'   => 'required|date|after_or_equal:term_start',
        'status'     => 'required|in:Active,Inactive',
    ]);

    $position = $request->position;

    // Enforce one-time-only positions
    $uniquePositions = ['Barangay Captain', 'Barangay Treasurer', 'Barangay Secretary'];
    if (in_array($position, $uniquePositions)) {
        $exists = BarangayOfficial::where('position', $position)->exists();
        if ($exists) {
            return redirect()->back()
                ->withErrors(['position' => "A $position is already assigned. Only one is allowed."])
                ->withInput();
        }
    }

    // Enforce max 7 kagawads
    if ($position === 'Barangay Kagawad') {
        $kagawadCount = BarangayOfficial::where('position', 'Barangay Kagawad')->count();
        if ($kagawadCount >= 7) {
            return redirect()->back()
                ->withErrors(['position' => 'Maximum of 7 Barangay Kagawads allowed.'])
                ->withInput();
        }
    }

    // Match with resident
    $resident = Resident::where('fname', 'like', "%{$request->fname}%")
                        ->where('lname', 'like', "%{$request->lname}%")
                        ->first();


    BarangayOfficial::create([
        'fname'       => $request->fname,
        'mname'       => $request->mname,
        'lname'       => $request->lname,
        'position'    => $request->position,
        'term_start'  => $request->term_start,
        'term_end'    => $request->term_end,
        'status'      => $request->status,
        'resident_id' => $resident ? $resident->id : null,
    ]);

    return redirect()->route('barangayofficials.index')
        ->with('success', 'Barangay Official added successfully!');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

         // Retrieve the official using the ID
    $official = BarangayOfficial::findOrFail($id);

    // Return the data to the view (modal)
    return response()->json($official);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    $official = BarangayOfficial::findOrFail($id);


    // Validation
    $request->validate([
        'fname'      => 'required|string|max:255',
        'mname'      => 'nullable|string|max:255',
        'lname'      => 'required|string|max:255',
        'position'   => 'required|string|max:255',
        'term_start' => 'required|date',
        'term_end'   => 'required|date|after_or_equal:term_start',
        'status'     => 'required|in:Active,Inactive',
    ]);

    // Unique position check (exclude self)
    $uniquePositions = ['Barangay Captain', 'Barangay Treasurer', 'Barangay Secretary'];
    if (in_array($request->position, $uniquePositions)) {
        $exists = BarangayOfficial::where('position', $request->position)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['position' => "A {$request->position} is already assigned. Only one is allowed."])
                ->withInput();
        }
    }

    // Kagawad limit (exclude self)
    if ($request->position === 'Barangay Kagawad') {
        $kagawadCount = BarangayOfficial::where('position', 'Barangay Kagawad')
            ->where('id', '!=', $id)
            ->count();

        if ($kagawadCount >= 7) {
            return redirect()->back()
                ->withErrors(['position' => 'Maximum of 7 Barangay Kagawads allowed.'])
                ->withInput();
        }
    }

    // Build fullname from fname + mname + lname
    $fullname = trim("{$request->fname} {$request->mname} {$request->lname}");

    // Update official
    $official->update([
        'fullname'   => $fullname,
        'position'   => $request->position,
        'term_start' => $request->term_start,
        'term_end'   => $request->term_end,
        'status'     => $request->status,
        'resident_id'=> $official->resident_id, // kung may relation
    ]);

    return redirect()->route('barangayofficials.index')
        ->with('success', 'Barangay Official updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $official = BarangayOfficial::findOrFail($id);
        $official->delete();

    return redirect()->route('barangayofficials.index');

    }
    public function getResidentInfo($id)
    {
        $resident = Resident::findOrFail($id);
        return response()->json($resident);
    }

    public function dashboard()
    {
        return view('barangay_official.dashboard');
    }

}
