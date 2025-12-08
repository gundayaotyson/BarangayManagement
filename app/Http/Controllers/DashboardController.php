<?php

namespace App\Http\Controllers;
use App\Models\Resident;
use App\Models\BarangayCase;
use App\Models\clearancereq;
use App\Models\Senior;
use App\Models\newdelivery;
use App\Models\Fourps;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
     public function index(){


        return view('admin.dashboard');
     }
     public function homepage(){
        $totalResidents = [
            'totalResidentsCount' => Resident::count(),
            'totalResidentsMale' => Resident::where('gender', 'Male')->count(),
            'totalResidentsFemale' => Resident::where('gender', 'Female')->count(),
            'totalSeniors' => Resident::where('birthday', '<=', Carbon::now()->subYears(60))->count(),
            'totalSeniorPensioners' => Senior::count(),
            'totalYouth' => Resident::where('birthday', '<=', Carbon::now()->subYears(15))->where('birthday', '>=', Carbon::now()->subYears(30))->count(),
            'totalHouseholds' => Resident::distinct('household_no')->count('household_no'),
            'totalFamilies' => Resident::select('household_no', 'lname')->distinct()->get()->count(),
            'householdsPerPurok' => Resident::select('purok_no', DB::raw('count(DISTINCT household_no) as household_count'))->groupBy('purok_no')->get(),
            'householdsPerSitio' => Resident::select('sitio', DB::raw('count(DISTINCT household_no) as household_count'))->whereNotNull('sitio')->groupBy('sitio')->get(),
            'recentRequests' => clearancereq::with('resident')->latest()->take(10)->get()
        ];


        return view("admin.home", $totalResidents);


     }
     public function Senior(){
        $seniors = Senior::all();
        return view("admin.senior", compact('seniors'));
     }
     public function BHWview(){
        $newdeliveries = newdelivery::all();
        $totalBabies = $newdeliveries->count();
        $totalBoys = $newdeliveries->where('gender', 'Male')->count();
        $totalGirls = $newdeliveries->where('gender', 'Female')->count();
        return view("admin.bhwview", compact('newdeliveries', 'totalBabies', 'totalBoys', 'totalGirls'));
     }
     public function Fourpsview(){
        $fourps = Fourps::with('resident')->get();
        $totalBeneficiaries = $fourps->count();
        $activeBeneficiaries = $fourps->where('status', 'active')->count();
        $inactiveBeneficiaries = $fourps->where('status', 'inactive')->count();
        return view("admin.4pslist", compact('fourps', 'totalBeneficiaries', 'activeBeneficiaries', 'inactiveBeneficiaries'));
     }

}
