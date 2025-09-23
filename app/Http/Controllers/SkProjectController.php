<?php

namespace App\Http\Controllers;

use App\Models\SKProject;
use Illuminate\Http\Request;

class SKProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = SKProject::all();
        return view('skuser.projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skuser.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'purok' => 'required',
            'category' => 'required',
            'start_date' => 'required|date',
            'target_date' => 'required|date',
            'budget' => 'required|numeric',
            'status' => 'required',
        ]);

        SKProject::create($request->all());

        return redirect()->route('sk.projects')
                        ->with('success','Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SKProject $sKProject)
    {
        return view('skuser.projects.show', compact('sKProject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SKProject $sKProject)
    {
        return view('skuser.projects.edit', compact('sKProject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SKProject $sKProject)
    {
        $request->validate([
            'project_name' => 'required',
            'purok' => 'required',
            'category' => 'required',
            'start_date' => 'required|date',
            'target_date' => 'required|date',
            'budget' => 'required|numeric',
            'status' => 'required',
        ]);

        $sKProject->update($request->all());

        return redirect()->route('sk.projects')
                        ->with('success','Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SKProject $sKProject)
    {
        $sKProject->delete();

        return redirect()->route('sk.projects')
                        ->with('success','Project deleted successfully.');
    }

    public function getProject($id)
    {
        $project = SKProject::findOrFail($id);
        return response()->json($project);
    }
}
