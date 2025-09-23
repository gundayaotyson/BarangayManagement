<?php

namespace App\Http\Controllers;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\ClearanceReq;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LegaldocumentsController extends Controller
{
    // Show Barangay Clearance Form
    public function BrgyClearance()
    {
        return view("admin.brgyclearance");
    }
    public function index()
    {

        return view('admin.brgyindigencyform');
    }

    // Store Barangay Clearance Request
    public function storeClearance(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'fullname' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'dateofbirth' => 'required|date',
                'placeofbirth' => 'required|string|max:255',
                'civil_status' => 'required|string',
                'gender' => 'required|in:male,female',
                'purpose' => 'required|string',
                'pickup_date' => 'required|date',
              ]);

                // Find matching resident by full name (with improved handling for not found)
                $fullname = strtolower(trim($request->fullname));
                $resident = Resident::get()->first(function ($r) use ($fullname) {
                    $name = strtolower(trim($r->Fname . ' ' . $r->lname));
                    return $name === $fullname;
                });
                if (!$resident) {
                    return redirect()->back()->with('error', 'Resident not found!');
                }

            // Generate a unique tracking code
            $trackingCode = strtoupper(Str::random(10));

            // Create a new clearance request record
            ClearanceReq::create([
             'resident_id' => $resident->id,
                'fullname' => $request->fullname,
                'address' => $request->address,
                'dateofbirth' => $request->dateofbirth,
                'placeofbirth' => $request->placeofbirth,
                'civil_status' => $request->civil_status,
                'gender' => $request->gender,
                'purpose' => $request->purpose,
                'pickup_date' => $request->pickup_date,
                'tracking_code' => $trackingCode,
                'status' => 'pending', // Default status

            ]);


            return redirect()->route('webgenerallayout')->with('success', 'Request Submitted Successfully! Your tracking code is: ' . $trackingCode);
        } catch (\Exception $e) {
            Log::error('Error storing Barangay Clearance request: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }

    }

    // View all clearance requests
    public function clearanceview()
{
    // Get all clearance requests with their associated residents
    $clearanceRequests = ClearanceReq::with('resident')->latest()->get();

    return view('admin.requesteddocument', compact('clearanceRequests'));
}

    // View a single clearance request for validation
    public function clearancevalidate()
    {
        return view('admin.clearancevalidate');
    }

  public function showClearance($id)
{
    // Get the clearance request with resident data
    $clearance = ClearanceReq::with('resident')->findOrFail($id);

    // Debugging - uncomment to check data
    // dd($clearance);

    return view('admin.clearancevalidate', compact('clearance'));
}

    // Update clearance status and set date_released when released
    public function updateClearanceStatus(Request $request, $id)
    {
        try {
            $clearance = ClearanceReq::findOrFail($id);
            $clearance->status = $request->status;

            if ($request->status === 'released') {
                $clearance->released_date = now(); // ✅ Fix column name
            }

            $clearance->save(); // ✅ Save the changes

            return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
        } catch (\Exception $e) {
            Log::error('Error updating clearance status: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to update status.']);
        }
    }
    public function destroy($id)
    {
        try {
            $clearance = ClearanceReq::findOrFail($id);
            $clearance->delete();

            return response()->json(['success' => true, 'message' => 'Clearance request deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting clearance request: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to delete request.']);
        }
    }
    // public function clearanceRequested()
    // {
    //     $clearanceRequests = Resident::latest()->get(); // Fetch all clearance requests

    //     return view('requestedclearance', compact('clearanceRequests'));
    // }
// Controller method

public function clearanceRequested()
{
    // Correct: Fetch clearance requests with resident info
    $clearanceRequests = ClearanceReq::with('resident')->latest()->get();

    return view('admin.requestedclearance', compact('clearanceRequests'));
}

public function indigencyRequested()
{
        $indigencyRequests   = ClearanceReq::with('resident')->latest()->get();

    // Get all full names from the clearancereq table
    // $fullNames = DB::table('clearancereq')->pluck('fullname')->toArray(); // Convert to array for IN clause

    // Fetch the clearance requests in a single query by using the 'IN' clause
    // $indigencyRequests = Resident::whereIn(DB::raw("CONCAT(Fname, ' ', lname)"), $fullNames)->get();
    // dd($indigencyRequests);
    return view('admin.requestedindigency', compact('indigencyRequests'));
}
public function showIndigency($id)
{
        $indigency = ClearanceReq::with('resident')->findOrFail($id);


    // $indigency = ClearanceReq::findOrFail($id);
    // dd($indigency);
    return view('admin.brgyindigencyform', compact('indigency'));
}


// public function clearanceRequested()
// {
//     $clearanceRequests = Clearancereq::with('resident')->latest()->get(); // eager load relation
//     return view('requestedclearance', compact('clearanceRequests'));
// }

public function trackClearance($trackingCode)
{
    // Query the clearance request by tracking code
    $clearanceRequest = ClearanceReq::where('tracking_code', $trackingCode)->first();

    if ($clearanceRequest) {
        // Return the required details
        return response()->json([
            'success' => true,
            'fullname' => $clearanceRequest->fullname,
            'service_type' => $clearanceRequest->service_type,  // Assuming this column exists
            'request_date' => $clearanceRequest->created_at->format('Y-m-d'),
            'pickup_date' => $clearanceRequest->pickup_date, // Assuming this column exists
            'status' => $clearanceRequest->status,
        ]);
    } else {
        // Return a response if no record is found
        return response()->json([
            'success' => false,
            'message' => 'No record found for this tracking code'
        ]);
    }
}



}
