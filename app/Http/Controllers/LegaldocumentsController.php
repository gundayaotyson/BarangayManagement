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
    public function ResidencyRequest()
    {
        $residencyRequests = ClearanceReq::with('resident')
        ->where('service_type', 'Barangay Residency')
        ->latest()
        ->get();

    return view('admin.requestedresidency', compact('residencyRequests'));
    }
    public function showBusinessPermit($id)
{
    $business_permit = ClearanceReq::with('resident')->findOrFail($id);
    return view('admin.brgybussniesspermitform', compact('business_permit'));
}

    // Show Barangay Business Permit request page
    public function BrgyBussinesspermit()
    {
        $businessPermitRequests = ClearanceReq::with('resident')
        ->where('service_type', 'Barangay Business Permit')
        ->latest()
        ->get();

    return view('admin.requestedbussnesspermit', compact('businessPermitRequests'));
    }
    // Show Barangay Indigency Form
    public function index()
    {

        return view('admin.brgyindigencyform');
    }

    // Store Barangay Clearance Request
    public function storeClearance(Request $request)
    {
        try {
            $request->validate([
                'resident_id' => 'nullable|exists:residents,id',
                'Fname' => 'required|string|max:255',
                'mname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'dateofbirth' => 'required|date',
                'placeofbirth' => 'required|string|max:255',
                'civil_status' => 'required|string',
                'gender' => 'required|in:Male,Female',
                'purpose' => 'required|string',
                'pickup_date' => 'required|date',
                'service_type' => 'required|string',
                'business_name' => 'nullable|string',
                'business_type' => 'nullable|string',
                'business_address' => 'nullable|string',
                'res_started_living' => 'nullable|string',
                'cert_use_date' => 'nullable|date',
              ]);

                $resident = Resident::where('Fname', $request->Fname)->where('lname', $request->lname)->first();
                if (!$resident) {
                    return redirect()->back()->with('error', 'Resident not found!');
                }

            $trackingCode = strtoupper(Str::random(10));
            ClearanceReq::create([
             'resident_id' => $resident->id,
                'Fname' => $request->Fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'address' => $request->address,
                'dateofbirth' => $request->dateofbirth,
                'placeofbirth' => $request->placeofbirth,
                'civil_status' => $request->civil_status,
                'gender' => $request->gender,
                'purpose' => $request->purpose,
                'pickup_date' => $request->pickup_date,
                'tracking_code' => $trackingCode,
                'status' => 'pending',
                'service_type' => $request->service_type,
                'business_name' => $request->business_name,
                'business_type' => $request->business_type,
                'business_address' => $request->business_address,
                'res_started_living' => $request->res_started_living,
                'cert_use_date' => $request->cert_use_date,

            ]);

            return redirect()->back()->with('success', 'Request Submitted Successfully! Your tracking code is: ' . $trackingCode);
        } catch (\Exception $e) {
            Log::error('Error storing Barangay Clearance request: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }

    }

    // View all clearance requests
    public function clearanceview()
{
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
    $clearance = ClearanceReq::with('resident')->findOrFail($id);

    return view('admin.clearancevalidate', compact('clearance'));
}

    // Update clearance status and set date_released when released
    public function updateClearanceStatus(Request $request, $id)
    {
        try {
            $clearance = ClearanceReq::findOrFail($id);
            $clearance->status = $request->status;

            if ($request->status === 'released') {
                $clearance->released_date = now();
            }

            $clearance->save();

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

public function clearanceRequested()
{
    $clearanceRequests = ClearanceReq::with('resident')
     ->where('service_type', 'Barangay Clearance')
    ->latest()->get();

    return view('admin.requestedclearance', compact('clearanceRequests'));
}

public function indigencyRequested()
{

    $indigencyRequests = ClearanceReq::with('resident')
        ->where('service_type', 'Certificate of Indigency')
        ->latest()
        ->get();
    return view('admin.requestedindigency', compact('indigencyRequests'));
}
public function showIndigency($id)
{
        $indigency = ClearanceReq::with('resident')->findOrFail($id);

    return view('admin.brgyindigencyform', compact('indigency'));
}


public function showResidencyCert($id)
{
    $residency = ClearanceReq::with('resident')->findOrFail($id);
    return view('admin.brgycertresidency', compact('residency'));
}

public function residencyRequested()
{
    $residencyRequests = ClearanceReq::with('resident')
        ->where('service_type', 'Barangay Residency')
        ->latest()
        ->get();

    return view('admin.requestedresidency', compact('residencyRequests'));
}

public function businessPermitRequested()
{
    $businessPermitRequests = ClearanceReq::with('resident')
        ->where('service_type', 'Barangay Business Permit')
        ->latest()
        ->get();

    return view('admin.requestedbussnesspermit', compact('businessPermitRequests'));
}


public function trackClearance($trackingCode)
{
    $clearanceRequest = ClearanceReq::where('tracking_code', $trackingCode)->first();

    if ($clearanceRequest) {
        return response()->json([
            'success' => true,
            'fullname' => $clearanceRequest->Fname . ' ' . $clearanceRequest->mname . ' ' . $clearanceRequest->lname,
            'service_type' => $clearanceRequest->service_type,
            'request_date' => $clearanceRequest->created_at->format('Y-m-d'),
            'pickup_date' => $clearanceRequest->pickup_date,
            'status' => $clearanceRequest->status,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'No record found for this tracking code'
        ]);
    }
}

}
