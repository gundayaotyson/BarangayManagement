<?php
namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\SKService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class SKServiceController extends Controller
{

public function store(Request $request)
{
    $request->validate([
        'school' => 'required|string|max:255',
        'school_year' => 'required|string|max:255',
        'type_of_service' => 'required|string|max:255',
        'attachment' => 'required|file|mimes:pdf|max:2048',

    ]);

    $user = Auth::user();
    $resident = Resident::where('email', $user->email)->first();

    if (! $resident) {
        return redirect()->back()->with('error', 'Resident record not found. Please update your profile before applying.');
    }

    $data = $request->only(['school', 'school_year', 'type_of_service']);
    $data['resident_id'] = $resident->id;
    $data['firstname']   = $resident->Fname;
    $data['lastname']    = $resident->lname;
    $data['status']      = 'Pending';

    if ($request->hasFile('attachment')) {
        $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
    }

    SKService::create($data);

    return redirect()->back()->with('success', 'SK Service request submitted successfully.');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,Approved,Released,Declined',
        ]);

        $service = SKService::findOrFail($id);
        $service->status = $request->status;

        if ($request->status == 'Released') {
            $service->released_date = now();
        }

        $service->save();

        return redirect()->back()->with('success', 'SK Service status updated successfully.');
    }

    public function destroy($id)
    {
        $service = SKService::findOrFail($id);
        $service->delete();

        return redirect()->back()->with('success', 'SK Service request deleted successfully.');
    }
      public function showAttachment($path)
    {
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->response($path);
    }
}
