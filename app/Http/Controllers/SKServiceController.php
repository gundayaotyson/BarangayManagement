<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\SKService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SKServiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'school_year' => 'required|string|max:255',
            'type_of_service' => 'required|string|max:255',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = Auth::user();
        $resident = Resident::where('email', $user->email)->first();

        $data = $request->all();
        $data['resident_id'] = $resident->id;
        $data['status'] = 'Pending';

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $data['attachment'] = $path;
        }

        SKService::create($data);

        return redirect()->back()->with('success', 'SK Service request submitted successfully.');
    }
}
