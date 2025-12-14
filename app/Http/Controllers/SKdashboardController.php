<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SKService;
use App\Models\SKProject;
use Carbon\Carbon;

class SKdashboardController extends Controller
{
    public function index(){
        return view('skuser.dashboard');
        
    }

    public function home(Request $request){
        $selectedYear = $request->input('year', Carbon::now()->year);
        $selectedMonth = $request->input('month');

        $projectsQuery = SKProject::whereYear('start_date', $selectedYear);

        if ($selectedMonth) {
            $projectsQuery->whereMonth('start_date', $selectedMonth);
        }

        $projects = $projectsQuery->get();

        $totalProjects = $projects->count();

        // Normalize status (to lowercase)
        $projectCounts = $projects->groupBy(function($item) {
            return strtolower(trim($item->status));
        })->map->count();

        $completedProjects = $projectCounts->get('completed', 0);
        $ongoingProjects   = $projectCounts->get('in progress', 0);
        $pendingProjects   = $projectCounts->get('not started', 0);
        $holdProjects      = $projectCounts->get('on hold', 0);

        // Group by month
        $projectsByMonth = $projects->groupBy(function ($project) {
            return Carbon::parse($project->start_date)->format('F Y');
        })->map->count();

        return view('skuser.home', compact(
            'totalProjects',
            'completedProjects',
            'ongoingProjects',
            'pendingProjects',
            'holdProjects',
            'selectedYear',
            'selectedMonth',
            'projectsByMonth'
        ));
    }

    public function projects(Request $request){
        $query = SKProject::query();

        if ($request->has('year') && $request->year != '') {
            $query->whereYear('start_date', $request->year);
        }

        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('start_date', $request->month);
        }

        $projects = $query->get();

        return view('skuser.projects', compact('projects'));
    }

    public function services(){
        $SKService = SkService::all();
        return view('skuser.services', compact('SKService'));
    }
}
