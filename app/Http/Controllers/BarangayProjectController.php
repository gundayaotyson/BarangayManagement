<?php

namespace App\Http\Controllers;

use App\Models\BarangayProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangayProjectController extends Controller
{
    // Display all projects with analytics
    public function index()
    {
        // Get paginated projects for the table
        $projects = BarangayProject::latest()->paginate(10);

        // Initialize variables with default values
        $totalProjects = 0;
        $ongoingProjects = 0;
        $completedProjects = 0;
        $delayedProjects = 0;
        $totalBudget = 0;
        $totalUtilized = 0;
        $budgetUtilizationPercentage = 0;
        $avgCompletion = 0;
        $statusDistribution = [];
        $purokBudget = [];

        // Only calculate analytics if there are projects
        if ($projects->total() > 0) {
            // Analytics data
            $totalProjects = BarangayProject::count();
            $ongoingProjects = BarangayProject::where('status', 'Ongoing')->count();
            $completedProjects = BarangayProject::where('status', 'Completed')->count();
            $delayedProjects = BarangayProject::where('status', 'Delayed')->count();

            // Calculate budget utilization
            $totalBudget = BarangayProject::sum('total_budget');
            $totalUtilized = BarangayProject::sum('funds_utilized');
            $budgetUtilizationPercentage = $totalBudget > 0 ? ($totalUtilized / $totalBudget) * 100 : 0;

            // Calculate average completion percentage
            $avgCompletion = BarangayProject::avg('completion_percentage') ?? 0;

            // Get data for status distribution chart
            $statusDistribution = BarangayProject::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get();

            // Get data for budget allocation by purok chart
            $purokBudget = BarangayProject::select('purok', DB::raw('sum(total_budget) as total'))
                ->groupBy('purok')
                ->get();
        }

        return view('admin.barangayprojects', compact(
            'projects',
            'totalProjects',
            'ongoingProjects',
            'completedProjects',
            'delayedProjects',
            'totalBudget',
            'totalUtilized',
            'budgetUtilizationPercentage',
            'avgCompletion',
            'statusDistribution',
            'purokBudget'
        ));
    }

    // Show create form
    public function create()
    {
        return view('admin.barangayprojects.create');
    }

    // Store new project
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'purok' => 'required|in:Purok 1,Purok 2,Purok 3',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'target_completion_date' => 'required|date|after:start_date',
            'status' => 'required|in:Planned,Ongoing,Completed,Delayed,Cancelled',
            'completion_percentage' => 'required|numeric|min:0|max:100',
            'total_budget' => 'required|numeric|min:0',
            'funds_utilized' => 'required|numeric|min:0|lte:total_budget',
            'funding_source' => 'required|string|max:255',
            'project_lead' => 'required|string|max:255',

        ]);

        BarangayProject::create($validated);

        return redirect()->route('barangayprojects.index')
            ->with('success', 'Project created successfully!');
    }

    // Show edit form (for AJAX)
    public function edit($id)
    {
        $project = BarangayProject::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $project
        ]);
    }

    // Update project
    public function update(Request $request, $id)
    {
        $project = BarangayProject::findOrFail($id);

        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'purok' => 'required|in:Purok 1,Purok 2,Purok 3',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'target_completion_date' => 'required|date|after:start_date',
            'status' => 'required|in:Planned,Ongoing,Completed,Delayed,Cancelled',
            'completion_percentage' => 'required|numeric|min:0|max:100',
            'total_budget' => 'required|numeric|min:0',
            'funds_utilized' => 'required|numeric|min:0|lte:total_budget',
            'funding_source' => 'required|string|max:255',
            'project_lead' => 'required|string|max:255',

        ]);

        $project->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully!'
        ]);
    }

    // Delete project
    public function destroy($id)
    {
        $project = BarangayProject::findOrFail($id);
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully!'
        ]);
    }

    // Get project details for view
    public function getProject($id)
    {
        $project = BarangayProject::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $project
        ]);
    }
}
