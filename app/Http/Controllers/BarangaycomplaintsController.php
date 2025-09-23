<?php

namespace App\Http\Controllers;
use App\Models\BarangayComplaint;
use Illuminate\Http\Request;

class BarangaycomplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = BarangayComplaint::all();
        return view('admin.brgycomplaint', compact('complaints'));
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
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'complaint' => 'required|string',
            'respondent' => 'required|string',
            'victim' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'details' => 'required|string',
            'status' => 'required|in:Active Case,Settled Case,Scheduled Case',
        ]);

        BarangayComplaint::create($validatedData);

        return redirect()->back()->with('success', 'Complaint added successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $complaint = BarangayComplaint::findOrFail($id);

        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'complaint' => 'required|string',
            'respondent' => 'required|string',
            'victim' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'details' => 'required|string',
            'status' => 'required|in:Active Case,Settled Case,Scheduled Case',
        ]);

        $complaint->update($validatedData);

        return redirect()->route('brgycomplaint.index')->with('success', 'Complaint updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $complaint = BarangayComplaint::findOrFail($id);
        $complaint->delete();

        return redirect()->route('brgycomplaint.index')->with('success', 'Complaint deleted successfully.');
    }
}
