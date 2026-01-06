<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function Annoucementview()
    {
        $announcements = Announcement::all();
        return view("admin.annoucement", compact('announcements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'required',
            'audience' => 'required',
            'venue' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ add
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('announcements', 'public');
        }

        Announcement::create($data);

        return redirect()->route('admin.annoucement')
                         ->with('success', 'Announcement created successfully.');
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'type' => 'required',
            'audience' => 'required',
            'venue' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ add
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('announcements', 'public');
        }

        $announcement->update($data);

        return redirect()->route('admin.annoucement')
                         ->with('success', 'Announcement updated successfully');
    }

    public function destroy(Announcement $announcement)
    {
        // Optional: delete photo file from storage
        if ($announcement->photo && \Storage::disk('public')->exists($announcement->photo)) {
            \Storage::disk('public')->delete($announcement->photo);
        }

        $announcement->delete();

        return redirect()->route('admin.annoucement')
                         ->with('success', 'Announcement deleted successfully');
    }
}
