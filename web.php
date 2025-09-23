<?php

use App\Http\Controllers\BarangaycomplaintsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartialsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentsController;
use App\Http\Controllers\AllreportsController;
use App\Http\Controllers\BarangayindigencyController;
use App\Http\Controllers\BarangayofficialsController;
use App\Http\Controllers\BarangayServicesController;
use App\Http\Controllers\ManageresidentsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LegaldocumentsController;
use App\Http\Controllers\SKdashboardController;
use App\Http\Controllers\BarangayProjectController;
use App\Http\Controllers\BHWController;
use App\Http\Controllers\SeniorController;
use App\Http\Controllers\FourpsController;
use App\Http\Controllers\ResidentController;
use Illuminate\Routing\RouteGroup;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Protected Routes (Only accessible when logged in)
Route::middleware(['auth'])->group(function () {
    Route::get('/reports', [AllreportsController::class, 'index'])->name('reports.index');
});

// Dashboard route (only for authenticated users)

Route::middleware(['auth'])->group(function () {
    Route::resource('/manageresidents', ManageresidentsController::class);
    Route::get('/residents', [ManageresidentsController::class, 'index'])->name('residents');
    Route::post('/  manageresidents',[ManageresidentsController::class,'store'])->name('. manageresidents.store ');
    ROute::put('/manageresidents/{manageresidents}',[ManageresidentsController::class,'update'])->name('manageresidents.update');
    Route::delete('/residents/{id}', [ManageresidentsController::class, 'destroy'])->name('residents.destroy');



    Route::get('/Senior', [DashboardController::class, 'Senior'])->name('senior');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'homepage'])->name('dashboard');
    Route::get('/admin/profile', [PartialsController::class, 'profile'])->name('admin.profile');

    // skRoutes
    Route::get('/user/dashboard', [SKdashboardController::class, 'index'])->name('skuser.dashboard');

    Route::resource('/brgycomplaint', BarangaycomplaintsController::class);
    Route::get('/brgycomplaint', [BarangaycomplaintsController::class, 'index'])->name('brgycomplaint.index');
    Route::post('/brgycomplaint', [BarangaycomplaintsController::class, 'store'])->name('brgycomplaint.store');
// Route::get('/brgycomplaint/{brgycomplaint}/edit', [BarangayComplaintController::class, 'edit'])->name('brgycomplaint.edit');
    Route::put('/brgycomplaint/{id}', [BarangaycomplaintsController::class, 'update'])->name('brgycomplaint.update');
    Route::delete('/brgycomplaint/{id}', [BarangaycomplaintsController::class, 'destroy'])->name('brgycomplaint.destroy');

    // officials and staff
    Route::resource('barangayofficials', BarangayOfficialsController::class);
    Route::get('barangayofficials/create', [BarangayOfficialsController::class, 'create'])->name('barangayofficials.create');
    Route::post('barangayofficials', [BarangayOfficialsController::class, 'store'])->name('barangayofficials.store');
    Route::get('/RequestedDocuments',[LegaldocumentsController::class,'clearanceview'])->name('requesteddocument');
    Route::delete('/barangayofficials/{id}', [BarangayOfficialsController::class, 'destroy'])->name('barangayofficials.destroy');
    Route::put('/barangayofficials/{id}', [BarangayOfficialsController::class, 'update'])->name('barangayofficials.update');
    Route::get('/resident-info/{id}', [BarangayofficialsController::class, 'getResidentInfo']);



    Route::get('/autocomplete-residents', [BarangayOfficialsController::class, 'autocompleteResidents'])->name('autocomplete.residents');

    Route::get('/bhw/dashboard', [BHWController::class, 'dashboard'])->name('bhw.dashboard');
    Route::get('/senior/dashboard', [SeniorController::class, 'dashboard'])->name('senior.dashboard');
    Route::get('/4ps/dashboard', [FourpsController::class, 'dashboard'])->name('4ps.dashboard');
    Route::get('/resident/dashboard', [ResidentController::class, 'dashboard'])->name('resident.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('partials.profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('partials.profile.update');
});

Route::get('/BarangayCobolServices/Clearance', [LegaldocumentsController::class, 'BrgyClearance'])->name('brgyclearance');
Route::post('/BarangayCobolServices/Clearance/submit', [LegaldocumentsController::class, 'storeClearance'])->name('clearance.store');

Route::get('/clearance/view/{id}', [LegaldocumentsController::class, 'showClearance'])
     ->name('clearance.view');
Route::patch('/update-clearance-status/{id}', [LegaldocumentsController::class, 'updateClearanceStatus'])->name('update-clearance-status');
Route::delete('/clearance/delete/{id}', [LegaldocumentsController::class, 'destroy'])->name('clearance.delete');
Route::get('/clearance-requests', [LegaldocumentsController::class, 'clearanceview'])->name('clearance.requests');
Route::get('/clearance-validation', [LegaldocumentsController::class, 'clearancevalidate'])->name('clearance.validate');
Route::get('/BarangayClearance',[LegaldocumentsController::class,'clearanceRequested'])->name('requestedclearance');
Route::get('/indigency/view/{id}', [LegaldocumentsController::class, 'showIndigency'])->name('indigency.view');
Route::get('/BarangayIndigency',[LegaldocumentsController::class,'indigencyRequested'])->name('requestedindigency');
Route::get('/BarangayCobolServices/Indigency', [LegaldocumentsController::class, 'index'])->name('brgyindigencyform');

// Add this to your routes/web.php
Route::get('/track-clearance/{trackingCode}', [LegaldocumentsController::class, 'trackClearance']);

Route::get('/barangayservices',[BarangayServicesController::class,'brgyservices'])->name('barangayservices');
Route::post('/add-barangay-service', [BarangayServicesController::class, 'store'])->name('brgyservices.store');
Route::get('/add-barangay-service', [BarangayServicesController::class, 'brgyservices'])->name('brgyservices');

Route::middleware(['auth'])->group(function(){
    Route::resource('barangay-projects', BarangayProjectController::class);
    // routes/web.php
// Add these routes to your web.php file

// Route::get('/barangayprojects', [BarangayProjectController::class, 'index'])->name('barangayprojects');
// // Add this to your routes/web.php
// Route::get('barangayprojects/create', [BarangayProjectController::class, 'create'])->name('barangayprojects.create');
// Route::post('/barangay-projects', [BarangayProjectController::class, 'store'])->name('barangayprojects.store');
// Route::get('/barangay-projects/{id}', [BarangayProjectController::class, 'show'])->name('barangayprojects.show');
// Route::put('/barangay-projects/{id}', [BarangayProjectController::class, 'update'])->name('barangayprojects.update');
// Route::delete('/barangay-projects/{id}', [BarangayProjectController::class, 'destroy'])->name('barangayprojects.destroy');
// Route::get('/barangayprojects/{id}/edit', [BarangayProjectController::class, 'edit']);
// Barangay Projects Routes
Route::get('/barangayprojects', [BarangayProjectController::class, 'index'])->name('barangayprojects.index');
Route::get('/barangayprojects/create', [BarangayProjectController::class, 'create'])->name('barangayprojects.create');
Route::post('/barangayprojects', [BarangayProjectController::class, 'store'])->name('barangayprojects.store');
Route::get('/barangayprojects/{id}/view', [BarangayProjectController::class, 'getProject'])->name('barangayprojects.view');
Route::get('/barangayprojects/{id}/edit', [BarangayProjectController::class, 'edit'])->name('barangayprojects.edit');
Route::put('/barangayprojects/{id}', [BarangayProjectController::class, 'update'])->name('barangayprojects.update');
Route::delete('/barangayprojects/{id}', [BarangayProjectController::class, 'destroy'])->name('barangayprojects.destroy');
});



//Route::middleware(['auth'])->group(function () {
 //   Route::get('/admin/profile', [AdminController::class, 'edit'])->name('admin.profile');
 //   Route::post('/admin/profile/update', [AdminController::class, 'update'])->name('admin.profile.update');
//});
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
