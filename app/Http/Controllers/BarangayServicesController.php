<?php

namespace App\Http\Controllers;


use App\Models\BarangayServices;
use Illuminate\Http\Request;

class BarangayServicesController extends Controller
{
    // Show the list of barangay services
    public function webgenerallayout(){
        $services = BarangayServices::all(); // Fetch all barangay services
        return view("webgenerallayout", compact('services'));
    }

    // Show the form to add a new barangay service
    public function brgyservices(){
        return view("admin.barangayservices"); // The view to add new service
    }

    // Store a new barangay service
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        // Create a new barangay service record in the database
        BarangayServices::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect back to the form with a success message
        return redirect()->route('brgyservices')->with('success', 'Barangay service added successfully!');
    }
}
