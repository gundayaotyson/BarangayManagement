<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resident;
use App\Models\clearancereq;
use App\Models\SKService;
use App\Models\Seniorservices;
use App\Models\BhwRequest;
use App\Models\FourpsRequest;

class ResidentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $resident = Resident::where('email', $user->email)->first();

        if ($resident) {
            $clearanceCount = Clearancereq::where('resident_id', $resident->id)->where('status', '!=', 'expired')->count();
            $skServicesCount = SKService::where('resident_id', $resident->id)->where('status', '!=', 'expired')->count();
            $seniorRequestsCount = Seniorservices::where('resident_id', $resident->id)->where('status', '!=', 'expired')->count();
            $bhwRequestsCount = BhwRequest::where('resident_id', $resident->id)->where('status', '!=', 'expired')->count();

            $pendingClearance = Clearancereq::where('resident_id', $resident->id)->where('status', 'pending')->count();
            $pendingSk = SKService::where('resident_id', $resident->id)->where('status', 'pending')->count();
            $pendingSenior = Seniorservices::where('resident_id', $resident->id)->where('status', 'pending')->count();
            $pendingBhw = BhwRequest::where('resident_id', $resident->id)->where('status', 'pending')->count();

            $totalPendingRequests = $pendingClearance + $pendingSk + $pendingSenior + $pendingBhw;

            $scheduledClearance = Clearancereq::where('resident_id', $resident->id)->where('status', 'scheduled')->get();
            $scheduledSk = SKService::where('resident_id', $resident->id)->where('status', 'scheduled')->get();
            $scheduledSenior = Seniorservices::where('resident_id', $resident->id)->where('status', 'scheduled')->get();
            $scheduledBhw = BhwRequest::where('resident_id', $resident->id)->where('status', 'scheduled')->get();

            $scheduledRequests = $scheduledClearance->concat($scheduledSk)->concat($scheduledSenior)->concat($scheduledBhw);

            $expiredClearance = Clearancereq::where('resident_id', $resident->id)->where('status', 'expired')->count();
            $expiredSk = SKService::where('resident_id', $resident->id)->where('status', 'expired')->count();
            $expiredSenior = Seniorservices::where('resident_id', $resident->id)->where('status', 'expired')->count();
            $expiredBhw = BhwRequest::where('resident_id', $resident->id)->where('status', 'expired')->count();

            $totalExpiredRequests = $expiredClearance + $expiredSk + $expiredSenior + $expiredBhw;
            $releasedClearance = Clearancereq::where('resident_id', $resident->id)->where('status', 'released')->count();
            $releasedSk = SKService::where('resident_id', $resident->id)->where('status', 'released')->count();
            $releasedSenior = Seniorservices::where('resident_id', $resident->id)->where('status', 'released')->count();
            $releasedBhw = BhwRequest::where('resident_id', $resident->id)->where('status', 'released')->count();

            $totalReleasedRequests = $releasedClearance + $releasedSk + $releasedSenior + $releasedBhw;

        } else {
            $clearanceCount = 0;
            $skServicesCount = 0;
            $seniorRequestsCount = 0;
            $bhwRequestsCount = 0;
            $totalPendingRequests = 0;
            $scheduledRequests = collect();
            $totalExpiredRequests = 0;
            $totalReleasedRequests = 0;
        }

        $totalRequests = $clearanceCount + $skServicesCount + $seniorRequestsCount + $bhwRequestsCount;

        return view('resident.dashboard', compact('resident', 'totalRequests', 'totalPendingRequests', 'scheduledRequests', 'totalExpiredRequests', 'totalReleasedRequests'));
    }

    public function profile()
    {
        $user = Auth::user();
        $resident = Resident::where('email', $user->email)->first();
        return view('resident.profile', compact('resident'));
    }

    public function services()
    {
        $user = Auth::user();
        $resident = Resident::where('email', $user->email)->first();
        return view('resident.services', compact('resident'));
    }

    public function complaints()
    {
        $user = Auth::user();
        $resident = Resident::where('email', $user->email)->first();
        return view('resident.complaints', compact('resident'));
    }

    public function requests()
    {
        $user = Auth::user();
        $resident = Resident::where('email', $user->email)->first();

        if ($resident) {
            $requests = Clearancereq::where('resident_id', $resident->id)->get();
            $skServices = SKService::where('resident_id', $resident->id)->latest()->get();
            $seniorRequests = Seniorservices::where('resident_id', $resident->id)->latest()->get();
            $bhwRequests = BhwRequest::where('resident_id', $resident->id)->latest()->get();
            $fourpsRequests = FourpsRequest::where('resident_id', $resident->id)->latest()->get();
        } else {
            $requests = collect();
            $skServices = collect();
            $seniorRequests = collect();
            $bhwRequests = collect();
            $fourpsRequests = collect();
        }


        return view('resident.requests', compact('resident', 'fourpsRequests','requests', 'skServices', 'seniorRequests', 'bhwRequests'));
    }
    public function cancelRequest(Request $request, $id)
{
    $requestType = $request->input('type');
    $requestModel = null;

    switch ($requestType) {
        case 'clearance':
            $requestModel = Clearancereq::find($id);
            break;
        case 'sk':
            $requestModel = SKService::find($id);
            break;
        case 'senior':
            $requestModel = Seniorservices::find($id);
            break;
        case 'bhw':
            $requestModel = BhwRequest::find($id);
            break;
        case 'fourps':
            $requestModel = FourpsRequest::find($id);
            break;
        default:
            return redirect()->back()->with('error', 'Invalid request type.');
    }

    if ($requestModel) {
        $requestModel->delete();
        $requestModel->status = 'cancelled';
        $requestModel->save();
        return redirect()->back()->with('success', 'Request cancelled successfully.');
    }

    return redirect()->back()->with('error', 'Failed to cancel request.');
}




}
