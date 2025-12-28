<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
     public function Annoucementview(){
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

         ]);

         Announcement::create($request->all());

         return redirect()->route('admin.annoucement')
                         ->with('success','Announcement created successfully.');
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

         ]);

         $announcement->update($request->all());

         return redirect()->route('admin.annoucement')
                         ->with('success','Announcement updated successfully');
     }

     public function destroy(Announcement $announcement)
     {
         $announcement->delete();

         return redirect()->route('admin.annoucement')
                         ->with('success','Announcement deleted successfully');
     }
}
