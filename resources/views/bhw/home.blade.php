@extends('bhw.dashboard')
@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">BHW Dashboard</h1>
            <p class="mb-0 text-muted">Welcome back, {{ Auth::user()->name ?? 'BHW' }}! Here's your community overview.</p>
        </div>
        <div class="d-none d-sm-inline-block">
            <div class="bg-primary text-white p-3 rounded-lg">
                <i class="fas fa-calendar-alt fa-fw"></i>
                <span id="current-date">{{ now()->format('l, F j, Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Statistics Row 1 -->
    <div class="row">
        <!-- Total Requests -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 position-relative overflow-hidden">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRequests }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <i class="fas fa-history fa-sm"></i>
                                <span>All time records</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-primary-300"></i>
                        </div>
                    </div>
                </div>
                <!-- Animated background element -->
                <div class="position-absolute top-0 end-0 mt-3 me-3 opacity-10">
                    <i class="fas fa-clipboard-list fa-3x"></i>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 position-relative overflow-hidden">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingRequests }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <i class="fas fa-clock fa-sm"></i>
                                <span>Requires attention</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-warning-300"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 mt-3 me-3 opacity-10">
                    <i class="fas fa-clock fa-3x"></i>
                </div>
            </div>
        </div>

        <!-- Scheduled Requests -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 position-relative overflow-hidden">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Scheduled Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $scheduledRequests }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <i class="fas fa-calendar fa-sm"></i>
                                <span>Upcoming appointments</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-info-300"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 mt-3 me-3 opacity-10">
                    <i class="fas fa-calendar-check fa-3x"></i>
                </div>
            </div>
        </div>

        <!-- Total Pregnant -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 position-relative overflow-hidden">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pregnant</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPregnant }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <i class="fas fa-heart fa-sm"></i>
                                <span>Under care</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-success-300"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 mt-3 me-3 opacity-10">
                    <i class="fas fa-female fa-3x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Row 2 -->
    <div class="row">
        <!-- Total New Delivery -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 position-relative overflow-hidden">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                New Deliveries</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalNewDelivery }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <i class="fas fa-baby-carriage fa-sm"></i>
                                <span>Recent births</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-baby fa-2x text-primary-300"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 mt-3 me-3 opacity-10">
                    <i class="fas fa-baby fa-3x"></i>
                </div>
            </div>
        </div>

        <!-- Male Babies -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 position-relative overflow-hidden">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Male Babies</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $maleBabies }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <i class="fas fa-mars fa-sm"></i>
                                <span>Total boys</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-male fa-2x text-info-300"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 mt-3 me-3 opacity-10">
                    <i class="fas fa-male fa-3x"></i>
                </div>
            </div>
        </div>

        <!-- Female Babies -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 position-relative overflow-hidden">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Female Babies</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $femaleBabies }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <i class="fas fa-venus fa-sm"></i>
                                <span>Total girls</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-danger-300"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 mt-3 me-3 opacity-10">
                    <i class="fas fa-female fa-3x"></i>
                </div>
            </div>
        </div>

        <!-- Total Babies -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 position-relative overflow-hidden">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Babies</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $maleBabies + $femaleBabies }}</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <i class="fas fa-baby-carriage fa-sm"></i>
                                <span>All time</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-baby-carriage fa-2x text-success-300"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 mt-3 me-3 opacity-10">
                    <i class="fas fa-baby-carriage fa-3x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Tables Row -->
    <div class="row">
        <!-- Recent Requests -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4 border-0">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between border-0">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-list-alt me-2"></i>Recent Requests
                    </h6>
                    <a href="{{ route('bhw.Requestlist') }}" class="btn btn-sm btn-primary">
                        View All <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 ps-4">Requestor</th>
                                    <th class="border-0">Service Type</th>
                                    <th class="border-0 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentRequests->take(5) as $request)
                                    <tr class="border-bottom">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle p-2 me-3">
                                                    <i class="fas fa-user text-white fa-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark">{{ $request->resident->Fname }} {{ $request->resident->lname }}</div>
                                                    <small class="text-muted">{{ $request->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">{{ $request->service_type }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($request->status == 'Pending')
                                                <span class="badge bg-warning text-dark">{{ $request->status }}</span>
                                            @elseif($request->status == 'Scheduled')
                                                <span class="badge bg-success">{{ $request->status }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $request->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2"></i>
                                            <p>No recent requests found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Schedules -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4 border-0">
                <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between border-0">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar me-2"></i>Recent Schedules
                    </h6>
                    <a href="{{ route('bhw.Requestlist') }}" class="btn btn-sm btn-primary">
                        View All <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-borderless mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 ps-4">Requestor</th>
                                    <th class="border-0">Schedule Date</th>
                                    <th class="border-0 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentSchedules->take(5) as $schedule)
                                    <tr class="border-bottom">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-info rounded-circle p-2 me-3">
                                                    <i class="fas fa-user text-white fa-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark">{{ $schedule->resident->Fname }} {{ $schedule->resident->lname }}</div>
                                                    <small class="text-muted">{{ $schedule->service_type }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold">{{ \Carbon\Carbon::parse($schedule->sched_date)->format('M j, Y') }}</div>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($schedule->sched_date)->format('g:i A') }}</small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-success">{{ $schedule->status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">
                                            <i class="fas fa-calendar-times fa-2x mb-2"></i>
                                            <p>No scheduled appointments</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-6 mb-3">
                            <a href="{{ route('bhw.Requestlist') }}" class="card action-card text-decoration-none">
                                <div class="card-body text-center p-4">
                                    <div class="bg-primary rounded-circle p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                        <i class="fas fa-clipboard-list text-white fa-lg"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">Manage Requests</h6>
                                    <small class="text-muted">View all service requests</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <a href="{{ route('bhw.pregnant') }}" class="card action-card text-decoration-none">
                                <div class="card-body text-center p-4">
                                    <div class="bg-success rounded-circle p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                        <i class="fas fa-female text-white fa-lg"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">Pregnant Records</h6>
                                    <small class="text-muted">Manage pregnant women</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <a href="{{ route('bhw.newdeliverpregnant') }}" class="card action-card text-decoration-none">
                                <div class="card-body text-center p-4">
                                    <div class="bg-info rounded-circle p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                        <i class="fas fa-baby text-white fa-lg"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">New Deliveries</h6>
                                    <small class="text-muted">Record baby births</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 mb-3">
                            <a href="#" class="card action-card text-decoration-none">
                                <div class="card-body text-center p-4">
                                    <div class="bg-warning rounded-circle p-3 mb-3 mx-auto" style="width: 60px; height: 60px;">
                                        <i class="fas fa-chart-bar text-white fa-lg"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">Reports</h6>
                                    <small class="text-muted">Generate reports</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: 12px;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }

    .border-left-primary { border-left: 4px solid #4e73df !important; }
    .border-left-success { border-left: 4px solid #1cc88a !important; }
    .border-left-info { border-left: 4px solid #36b9cc !important; }
    .border-left-warning { border-left: 4px solid #f6c23e !important; }
    .border-left-danger { border-left: 4px solid #e74a3b !important; }

    .text-primary-300 { color: #9bb8f5 !important; }
    .text-success-300 { color: #7ae0b5 !important; }
    .text-info-300 { color: #7cdbf2 !important; }
    .text-warning-300 { color: #f9d886 !important; }
    .text-danger-300 { color: #f4a79c !important; }

    .bg-primary-300 { background-color: #9bb8f5 !important; }
    .bg-success-300 { background-color: #7ae0b5 !important; }

    .table-hover tbody tr:hover {
        background-color: rgba(78, 115, 223, 0.05);
    }

    .rounded-lg {
        border-radius: 15px !important;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }

        .h5 {
            font-size: 1.1rem;
        }

        .text-xs {
            font-size: 0.7rem;
        }
    }
</style>

<script>
    // Update current date
    function updateCurrentDate() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);
    }

    // Update every minute
    setInterval(updateCurrentDate, 60000);
</script>
@endsection
