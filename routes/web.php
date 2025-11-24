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
use App\Http\Controllers\SKProjectController;
use App\Http\Controllers\BarangayProjectController;
use App\Http\Controllers\BHWController;
use App\Http\Controllers\SeniorController;
use App\Http\Controllers\FourpsController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ResidentRegistrationController;
use App\Http\Controllers\SKServiceController;

// Public Routes
Route::get('/', [BarangayServicesController::class, 'webgenerallayout'])->name('webgenerallayout');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('resident/register', [ResidentRegistrationController::class, 'showRegistrationForm'])->name('resident.register');
Route::post('resident/register', [ResidentRegistrationController::class, 'register']);

// Protected Routes (Only for authenticated users)
Route::middleware(['auth'])->group(function () {

    // Reports
    Route::get('/reports', [AllreportsController::class, 'index'])->name('reports.index');

    // Manage Residents
    Route::resource('/manageresidents', ManageresidentsController::class);
    Route::get('/residents', [ManageresidentsController::class, 'index'])->name('residents');
    Route::post('/manageresidents', [ManageresidentsController::class, 'store'])->name('manageresidents.store');
    Route::put('/manageresidents/{manageresidents}', [ManageresidentsController::class, 'update'])->name('manageresidents.update');
    Route::delete('/residents/{id}', [ManageresidentsController::class, 'destroy'])->name('residents.destroy');

    // SK Routes
    Route::get('/user/dashboard', [SKdashboardController::class, 'index'])->name('skuser.dashboard');
    Route::get('/sk-dashboard/home', [SKdashboardController::class, 'home'])->name('sk.home');
    Route::get('/sk-dashboard/projects', [SKdashboardController::class, 'projects'])->name('sk.projects');
    Route::post('/sk-dashboard/projects', [SKProjectController::class, 'store'])->name('sk.projects.store');
    Route::get('/sk-dashboard/projects/{sKProject}', [SKProjectController::class, 'show'])->name('sk.projects.show');
    Route::get('/sk-dashboard/projects/{sKProject}/edit', [SKProjectController::class, 'edit'])->name('sk.projects.edit');
    Route::put('/sk-dashboard/projects/{sKProject}', [SKProjectController::class, 'update'])->name('sk.projects.update');
    Route::delete('/sk-dashboard/projects/{sKProject}', [SKProjectController::class, 'destroy'])->name('sk.projects.destroy');
    Route::get('/sk-dashboard/services', [SKdashboardController::class, 'services'])->name('sk.services');
    Route::get('/sk-dashboard/projects/{id}/view', [SKProjectController::class, 'getProject'])->name('sk.projects.view');
    Route::get('/sk-profile', [ProfileController::class, 'editskProfile'])->name('skuser.profile');
    Route::post('/sk-services', [SKServiceController::class, 'store'])->name('sk-services.store');
    Route::put('/sk-services/{id}', [SKServiceController::class, 'update'])->name('skuser.services.update');
    Route::delete('/sk-services/{id}', [SKServiceController::class, 'destroy'])->name('skuser.services.destroy');
    Route::get('/sk-services/attachments/{path}', [SKServiceController::class, 'showAttachment'])->where('path', '.*')->name('sk.attachment');

    // Barangay Officials & Complaints
    Route::resource('barangayofficials', BarangayOfficialsController::class);
    Route::get('barangayofficials/create', [BarangayOfficialsController::class, 'create'])->name('barangayofficials.create');
    Route::post('barangayofficials', [BarangayOfficialsController::class, 'store'])->name('barangayofficials.store');
    Route::get('/RequestedDocuments', [LegaldocumentsController::class, 'clearanceview'])->name('requesteddocument');
    Route::delete('/barangayofficials/{id}', [BarangayOfficialsController::class, 'destroy'])->name('barangayofficials.destroy');
    Route::put('/barangayofficials/{id}', [BarangayOfficialsController::class, 'update'])->name('barangayofficials.update');
    Route::get('/resident-info/{id}', [BarangayOfficialsController::class, 'getResidentInfo']);

    Route::resource('/brgycomplaint', BarangaycomplaintsController::class);
    Route::get('/brgycomplaint', [BarangaycomplaintsController::class, 'index'])->name('brgycomplaint.index');
    Route::post('/brgycomplaint', [BarangaycomplaintsController::class, 'store'])->name('brgycomplaint.store');
    Route::put('/brgycomplaint/{id}', [BarangaycomplaintsController::class, 'update'])->name('brgycomplaint.update');
    Route::delete('/brgycomplaint/{id}', [BarangaycomplaintsController::class, 'destroy'])->name('brgycomplaint.destroy');

    Route::get('/autocomplete-residents', [BarangayOfficialsController::class, 'autocompleteResidents'])->name('autocomplete.residents');

    // BHW Routes
    Route::get('/bhw/dashboard', [BHWController::class, 'dashboard'])->name('bhw.dashboard');
    Route::get('/bhwprofile', [ProfileController::class, 'editbhwProfile'])->name('bhw.profile');

    // Senior Routes
    Route::get('/Senior', [DashboardController::class, 'Senior'])->name('senior');
    Route::get('/senior/homepage', [SeniorController::class, 'homepage'])->name('senior.homepage');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'homepage'])->name('dashboard');
    Route::get('/admin/profile', [PartialsController::class, 'profile'])->name('admin.profile');
    Route::get('/senior/dashboard', [SeniorController::class, 'dashboard'])->name('senior.dashboard');
    Route::get('/senior/list', [SeniorController::class, 'list'])->name('senior.list');
    Route::post('/senior/store', [SeniorController::class, 'store'])->name('senior.store');
    // Route::get('seniors/{senior}/resident', [SeniorController::class, 'getSeniorResident'])->name('senior.resident');
    // Get Senior JSON
Route::get('/seniors/{senior}/json', [SeniorController::class, 'getSeniorJson'])->name('senior.json');

// Get Resident Details for a Senior
Route::get('/seniors/{id}/resident', [SeniorController::class, 'residentDetails'])->name('senior.resident');


    Route::put('seniors/{senior}', [SeniorController::class, 'update'])->name('senior.update');
    Route::delete('seniors/{senior}', [SeniorController::class, 'destroy'])->name('senior.destroy');
    Route::get('/senior-profile', [ProfileController::class, 'editseniorProfile'])->name('senior.profile');
    Route::get('/seniors/{senior}/resident', [SeniorController::class, 'showResident'])->name('senior.show_resident');

    // 4Ps Routes
    Route::get('/4ps/dashboard', [FourpsController::class, 'dashboard'])->name('4ps.dashboard');
    Route::get('/4psprofile', [ProfileController::class, 'edit4psProfile'])->name('4ps.profile');
    Route::get('/4ps/residentlist', [FourpsController::class, 'ResidentList'])->name('4ps.residentlist');
    Route::get('/4ps/home', [FourpsController::class, 'home'])->name('4ps.home');

    // Resident Routes
    Route::get('/resident/dashboard', [ResidentController::class, 'dashboard'])->name('resident.dashboard');
    Route::get('/resident-profile', [ProfileController::class, 'residentProfile'])->name('resident.profile');
    Route::get('/resident/services', [ResidentController::class, 'services'])->name('resident.services');
    Route::get('/resident/complaints', [ResidentController::class, 'complaints'])->name('resident.complaints');
    Route::get('/resident/requests', [ResidentController::class, 'requests'])->name('resident.requests');

    // Barangay Official Dashboard
    Route::get('/barangay-official/dashboard', [BarangayofficialsController::class, 'dashboard'])->name('barangay_official.dashboard');
    Route::get('/officials-profile', [ProfileController::class, 'editofficialsProfile'])->name('barangayofficials.profile');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('partials.profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('partials.profile.update');

    // Barangay Projects
    Route::resource('barangay-projects', BarangayProjectController::class);
    Route::get('/barangayprojects', [BarangayProjectController::class, 'index'])->name('barangayprojects.index');
    Route::get('/barangayprojects/create', [BarangayProjectController::class, 'create'])->name('barangayprojects.create');
    Route::post('/barangayprojects', [BarangayProjectController::class, 'store'])->name('barangayprojects.store');
    Route::get('/barangayprojects/{id}/view', [BarangayProjectController::class, 'getProject'])->name('barangayprojects.view');
    Route::get('/barangayprojects/{id}/edit', [BarangayProjectController::class, 'edit'])->name('barangayprojects.edit');
    Route::put('/barangayprojects/{id}', [BarangayProjectController::class, 'update'])->name('barangayprojects.update');
    Route::delete('/barangayprojects/{id}', [BarangayProjectController::class, 'destroy'])->name('barangayprojects.destroy');
});

// Public Document & Services Routes
Route::get('/BarangayCobolServices', [BarangayServicesController::class, 'webgenerallayout'])->name('webgenerallayout');
Route::get('/BarangayCobolServices/Clearance', [LegaldocumentsController::class, 'BrgyClearance'])->name('brgyclearance');
Route::post('/BarangayCobolServices/Clearance/submit', [LegaldocumentsController::class, 'storeClearance'])->name('clearance.store');
Route::post('/legal-documents/store-clearance', [LegaldocumentsController::class, 'storeClearance'])->name('legal-documents.store-clearance');
Route::get('/clearance/view/{id}', [LegaldocumentsController::class, 'showClearance'])->name('clearance.view');
Route::get('/residency/view/{id}', [LegaldocumentsController::class, 'showResidencyCert'])->name('residency.view');
Route::patch('/update-clearance-status/{id}', [LegaldocumentsController::class, 'updateClearanceStatus'])->name('update-clearance-status');
Route::delete('/clearance/delete/{id}', [LegaldocumentsController::class, 'destroy'])->name('clearance.delete');
Route::get('/clearance-requests', [LegaldocumentsController::class, 'clearanceview'])->name('clearance.requests');
Route::get('/clearance-validation', [LegaldocumentsController::class, 'clearancevalidate'])->name('clearance.validate');
Route::get('/BarangayClearance', [LegaldocumentsController::class, 'clearanceRequested'])->name('requestedclearance');
Route::get('/indigency/view/{id}', [LegaldocumentsController::class, 'showIndigency'])->name('indigency.view');
Route::get('/BarangayIndigency', [LegaldocumentsController::class, 'indigencyRequested'])->name('requestedindigency');
Route::get('/BarangayResidency', [LegaldocumentsController::class, 'residencyRequested'])->name('requestedresidency');
Route::get('/BarangayBusinessPermit', [LegaldocumentsController::class, 'businessPermitRequested'])->name('requestedbusinesspermit');
Route::get('/BarangayCobolServices/Indigency', [LegaldocumentsController::class, 'index'])->name('brgyindigencyform');
Route::get('/BarangayCobolServices/BarangayPermit', [LegaldocumentsController::class, 'BrgyBussinesspermit'])->name('requestedbussniesspermit');
Route::get('/BarangayCobolServices/residency', [LegaldocumentsController::class, 'ResidencyRequest'])->name('requestedresidency');
Route::get('/admin/requests/residency', [LegaldocumentsController::class, 'ResidencyRequest'])->name('admin.requests.residency');
Route::get('/business-permit/view/{id}', [LegaldocumentsController::class, 'showBusinessPermit'])->name('business-permit.view');
Route::get('/track-clearance/{trackingCode}', [LegaldocumentsController::class, 'trackClearance']);
Route::get('/barangayservices', [BarangayServicesController::class, 'brgyservices'])->name('barangayservices');
Route::post('/add-barangay-service', [BarangayServicesController::class, 'store'])->name('brgyservices.store');
Route::get('/add-barangay-service', [BarangayServicesController::class, 'brgyservices'])->name('brgyservices');
