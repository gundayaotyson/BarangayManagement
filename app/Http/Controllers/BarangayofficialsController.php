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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'term_start' => 'required|date',
            'term_end' => 'required|date|after_or_equal:term_start',
            'status' => 'required|in:Active,Inactive',
        ]);
        $position = $request->position;

        // Enforce one-time-only positions
        $uniquePositions = ['Barangay Captain', 'Barangay Treasurer', 'Barangay Secretary'];
        if (in_array($position, $uniquePositions)) {
            $exists = BarangayOfficial::where('position', $position)->exists();
            if ($exists) {
                return redirect()->back()->withErrors(['position' => "A $position is already assigned. Only one is allowed."])->withInput();
            }
        }

        // Enforce max 7 kagawads
        if ($position === 'Barangay Kagawad') {
            $kagawadCount = BarangayOfficial::where('position', 'Barangay Kagawad')->count();
            if ($kagawadCount >= 7) {
                return redirect()->back()->withErrors(['position' => 'Maximum of 7 Barangay Kagawads allowed.'])->withInput();
            }
        }
        $fullNameParts = explode(' ', $request->fullname);
        $firstName = $fullNameParts[0];
        $lastName = $fullNameParts[count($fullNameParts) - 1];
        $middleName = count($fullNameParts) > 2 ? $fullNameParts[1] : '';

        // More flexible lookup
        $resident = Resident::where('fname', 'like', "%$firstName%")
                            ->where('lname', 'like', "%$lastName%")
                            ->first();
        // Find resident with matching fullname
        // $resident = Resident::whereRaw("CONCAT(fname, ' ', mname, ' ', lname) = ?", [$request->fullname])->first();


        BarangayOfficial::create([
            'fullname'     => $request->fullname,
            'position'     => $request->position,
            'term_start'   => $request->term_start,
            'term_end'     => $request->term_end,
            'status'       => $request->status,
            'resident_id'  => $resident ? $resident->id : null,
        ]);

        return redirect()->route('barangayofficials.index')->with('success', 'Barangay Official added successfully!');
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
        $request->validate([
            'fullname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'term_start' => 'required|date',
            'term_end' => 'required|date|after:term_start',
            'status' => 'required|in:Active,Inactive',
        ]);


        $official = BarangayOfficial::findOrFail($id);
        $official->update($request->all());

        return redirect()->route('barangayofficials.index');
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
