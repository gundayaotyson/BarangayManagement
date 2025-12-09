@extends('barangay_official.dashboard')

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Dashboard Overview</h1>
            <p class="mb-0 text-muted">Welcome back, {{ auth()->user()->name ?? 'Official' }}</p>
        </div>
        <div class="d-flex">
            <div class="dropdown me-2">
                               <div class="d-none d-sm-inline-block">
                                    <div class="bg-primary text-white p-3 rounded-lg">
                                        <i class="fas fa-calendar-alt fa-fw"></i>
                                        <span id="current-date">{{ now()->format('l, F j, Y') }}</span>
                                    </div>
                                </div>

                    <!-- <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <span id="current-date">{{ now()->format('l, F j, Y') }}</span>

                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">Last Month</a></li>
                        <li><a class="dropdown-item" href="#">This Quarter</a></li>
                    </ul> -->
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Total Complaints -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Total Complaints
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalComplaints }}</div>
                            <div class="mt-2">
                                <span class="badge bg-light text-primary">
                                    <i class="fas fa-trending-up me-1"></i>
                                    {{ number_format(($activeCases / max($totalComplaints, 1)) * 100, 0) }}% Active
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gavel fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Cases -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                Active Cases
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $activeCases }}</div>
                            <div class="mt-2">
                                <span class="badge bg-light text-warning">
                                    <i class="fas fa-clock me-1"></i>
                                    Requires Attention
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-circle fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settled Cases -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                Settled Cases
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $settledCases }}</div>
                            <div class="mt-2">
                                <span class="badge bg-light text-success">
                                    <i class="fas fa-check-circle me-1"></i>
                                    {{ number_format(($settledCases / max($totalComplaints, 1)) * 100, 0) }}% Rate
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Projects -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                Total Projects
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalProjects }}</div>
                            <div class="mt-2">
                                <span class="badge bg-light text-info">
                                    <i class="fas fa-tasks me-1"></i>
                                    {{ $ongoingProjects }} Ongoing
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-project-diagram fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Detailed Stats -->
    <div class="row g-4">
        <!-- Complaints Summary -->
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-chart-bar me-2"></i>
                        Complaints Overview
                    </h6>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                            View Options
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Monthly</a></li>
                            <li><a class="dropdown-item" href="#">Quarterly</a></li>
                            <li><a class="dropdown-item" href="#">Yearly</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="stat-card p-3 rounded-3 border-start border-3 border-info">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1">Scheduled Cases</p>
                                        <h3 class="fw-bold mb-0">{{ $scheduledCases }}</h3>
                                    </div>
                                    <div class="icon-circle bg-info">
                                        <i class="fas fa-calendar-check text-white"></i>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-info"
                                         style="width: {{ ($scheduledCases / max($totalComplaints, 1)) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="stat-card p-3 rounded-3 border-start border-3 border-warning">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1">In Progress</p>
                                        <h3 class="fw-bold mb-0">{{ $activeCases }}</h3>
                                    </div>
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-spinner text-white"></i>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-warning"
                                         style="width: {{ ($activeCases / max($totalComplaints, 1)) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="stat-card p-3 rounded-3 border-start border-3 border-success">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1">Resolved Rate</p>
                                        <h3 class="fw-bold mb-0">{{ number_format(($settledCases / max($totalComplaints, 1)) * 100, 1) }}%</h3>
                                    </div>
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-chart-line text-white"></i>
                                    </div>
                                </div>
                                <div class="progress mt-2" style="height: 5px;">
                                    <div class="progress-bar bg-success"
                                         style="width: {{ ($settledCases / max($totalComplaints, 1)) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-4 pt-3 border-top">
                        <h6 class="mb-3 fw-bold">Quick Actions</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{ route('brgycomplaint.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-eye me-2"></i>View All Complaints
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('brgycomplaint.store') }}" class="btn btn-primary w-100">
                                    <i class="fas fa-plus me-2"></i>New Complaint Case
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Summary -->
        <div class="col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-project-diagram me-2"></i>
                        Project Status
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Completion Progress</span>
                            <span class="fw-bold">{{ number_format(($completedProjects / max($totalProjects, 1)) * 100, 0) }}%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ ($completedProjects / max($totalProjects, 1)) * 100 }}%">
                            </div>
                            <div class="progress-bar bg-warning" role="progressbar"
                                 style="width: {{ ($ongoingProjects / max($totalProjects, 1)) * 100 }}%">
                            </div>
                        </div>
                    </div>

                    <div class="project-stats">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="icon-circle-sm bg-success">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Completed</h6>
                                <p class="text-muted mb-0">{{ $completedProjects }} Projects</p>
                            </div>
                            <span class="badge bg-success">{{ number_format(($completedProjects / max($totalProjects, 1)) * 100, 0) }}%</span>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="icon-circle-sm bg-warning">
                                    <i class="fas fa-spinner text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Ongoing</h6>
                                <p class="text-muted mb-0">{{ $ongoingProjects }} Projects</p>
                            </div>
                            <span class="badge bg-warning">{{ number_format(($ongoingProjects / max($totalProjects, 1)) * 100, 0) }}%</span>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="icon-circle-sm bg-danger">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0">Delayed</h6>
                                <p class="text-muted mb-0">{{ $delayedProjects }} Projects</p>
                            </div>
                            <span class="badge bg-danger">{{ number_format(($delayedProjects / max($totalProjects, 1)) * 100, 0) }}%</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('barangayprojects.store') }}" class="btn btn-outline-info w-100">
                            <i class="fas fa-arrow-right me-2"></i>Manage Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-circle-sm {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .border-left-primary { border-left: 4px solid #4e73df !important; }
    .border-left-warning { border-left: 4px solid #f6c23e !important; }
    .border-left-success { border-left: 4px solid #1cc88a !important; }
    .border-left-info { border-left: 4px solid #36b9cc !important; }

    .progress {
        border-radius: 10px;
        background-color: #eaecf4;
    }

    .project-stats {
        border-top: 1px solid #e3e6f0;
        padding-top: 1rem;
    }
</style>
@endsection
