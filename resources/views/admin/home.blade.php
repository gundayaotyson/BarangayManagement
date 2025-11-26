@extends('admin.dashboard')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
    :root {
        --primary-color: #3498db;
        --primary-dark: #2980b9;
        --secondary-color: #2ecc71;
        --success-color: #27ae60;
        --danger-color: #e74c3c;
        --warning-color: #f39c12;
        --dark-color: #2c3e50;
        --light-color: #ecf0f1;
        --text-color: #333;
        --text-muted: #6c757d;
        --primary-light: #e3f2fd;
        --border-color: #e9ecef;
        --shadow-color: rgba(0, 0, 0, 0.1);
        --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        --card-shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.1);
        --border-radius: 16px;
        --gradient-primary: linear-gradient(135deg, #3498db, #2980b9);
        --gradient-success: linear-gradient(135deg, #2ecc71, #27ae60);
        --gradient-warning: linear-gradient(135deg, #f39c12, #e67e22);
        --gradient-info: linear-gradient(135deg, #9b59b6, #8e44ad);
    }

    /* Modern Welcome Header */
    .welcome-header {
        background: var(--dark-color);
        border-radius: var(--border-radius);
        padding: 40px;
        margin-bottom: 30px;
        color: white;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }

    .welcome-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .welcome-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .welcome-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0;
    }

    /* Modern Stats Grid - Keeping your existing data */
    .modern-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .modern-stat-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 30px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .modern-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow-hover);
    }

    .modern-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--gradient-primary);
    }

    .modern-stat-card:nth-child(2)::before {
        background: var(--gradient-success);
    }

    .modern-stat-card:nth-child(3)::before {
        background: var(--gradient-warning);
    }

    .modern-stat-card:nth-child(4)::before {
        background: var(--gradient-info);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        background: var(--primary-light);
        color: var(--primary-color);
        font-size: 1.5rem;
        margin-top: -11px;
        margin-left: 73px;
    }

    .modern-stat-card:nth-child(2) .stat-icon {
        background: rgba(46, 204, 113, 0.1);
        color: var(--success-color);
    }

    .modern-stat-card:nth-child(3) .stat-icon {
        background: rgba(243, 156, 18, 0.1);
        color: var(--warning-color);
    }

    .modern-stat-card:nth-child(4) .stat-icon {
        background: rgba(155, 89, 182, 0.1);
        color: #9b59b6;
    }

    .modern-stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 8px;
    }

    .modern-stat-label {
        font-size: 17px;
        color: var(--text-muted);
        margin-bottom: 12px;
        font-weight: 500;
        display: flex;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .trend-up {
        color: var(--success-color);
    }

    /* Quick Actions Section */
    .quick-actions-section {
        background: white;
        border-radius: var(--border-radius);
        padding: 30px;
        box-shadow: var(--card-shadow);
        border: 1px solid var(--border-color);
        margin-bottom: 40px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark-color);
        margin: 0;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
    }

    .action-btn {
        display: flex;
        align-items: center;
        padding: 20px;
        background: #f8f9fa;
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        transition: all 0.3s ease;
        text-decoration: none;
        color: var(--dark-color);
        font-weight: 600;
    }

    .action-btn:hover {
        background: var(--primary-light);
        border-color: var(--primary-color);
        transform: translateY(-2px);
        color: var(--primary-color);
    }

    .action-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: var(--primary-light);
        color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 1.1rem;
    }

    /* Enhanced existing styles - keeping all your functionality */
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Enhanced Stats Cards */
    .stats-row {
        margin-bottom: 30px;
    }

    .stat-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        height: 100%;
        margin-bottom: 20px;
        background: white;
        border-left: 4px solid var(--primary-color);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow-hover);
    }

    .stat-card .card-header {
        background-color: var(--light-color);
        border-bottom: 1px solid var(--border-color);
        font-weight: 600;
        color: var(--dark-color);
        padding: 15px 20px;
        border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    }

    .stat-card .card-body {
        padding: 25px 20px;
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-color);
        text-align: center;
    }

    /* Chart Cards */
    .chart-card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        margin-bottom: 30px;
        height: 100%;
        background: white;
    }

    .chart-card .card-header {
        background-color: var(--light-color);
        border-bottom: 1px solid var(--border-color);
        font-weight: 600;
        color: var(--dark-color);
        padding: 15px 20px;
        border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    }

    .chart-card .card-body {
        padding: 20px;
    }

    /* List Groups */
    .purok-list, .sitio-list {
        max-height: 300px;
        overflow-y: auto;
    }

    .list-group-item {
        border: 1px solid var(--border-color);
        padding: 12px 15px;
        transition: all 0.2s ease;
        background: white;
    }

    .list-group-item:hover {
        background-color: var(--primary-light);
        transform: translateX(5px);
    }

    .badge-count {
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 20px;
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
    }

    /* Service Requests Section */
    .requests-section {
        margin-top: 40px;
    }

    .view-all-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .view-all-btn:hover {
        background-color: var(--primary-dark);
        color: white;
        transform: translateY(-2px);
    }

    /* Request Cards */
    .request-card {
        border: none;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        transition: all 0.3s ease;
        margin-bottom: 15px;
        background: white;
        border-left: 4px solid var(--primary-color);
    }

    .request-card:hover {
        box-shadow: var(--card-shadow-hover);
        transform: translateX(5px);
    }

    .request-card .card-body {
        padding: 20px;
    }

    .request-info h5 {
        color: var(--dark-color);
        font-weight: 600;
        margin-bottom: 8px;
    }

    .request-meta {
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .request-date {
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    /* Status Badges */
    .status-badge {
        padding: 0.6em 1.2em;
        font-size: 0.85em;
        border-radius: 50rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-processing {
        background-color: var(--primary-light);
        color: var(--primary-dark);
        border: 1px solid var(--primary-color);
    }

    .status-approved {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .status-completed {
        background-color: #d4edda;
        color: var(--success-color);
        border: 1px solid #c3e6cb;
    }

    .status-rejected {
        background-color: #f8d7da;
        color: var(--danger-color);
        border: 1px solid #f5c6cb;
    }

    .status-default {
        background-color: #e2e3e5;
        color: #383d41;
        border: 1px solid #d6d8db;
    }

    /* Empty State */
    .empty-state {
        padding: 40px 20px;
        text-align: center;
        color: var(--text-muted);
    }

    .empty-state p {
        margin-bottom: 0;
        font-size: 1.1rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 15px;
        }

        .welcome-header {
            padding: 30px 20px;
            text-align: center;
        }

        .welcome-header h1 {
            font-size: 2rem;
        }

        .modern-stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .modern-stat-card {
            padding: 20px;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .view-all-btn {
            width: 100%;
            text-align: center;
        }

        .stat-card .card-body {
            font-size: 1.8rem;
        }

        .request-card .card-body {
            padding: 15px;
        }

        .request-card .d-flex {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .status-badge {
            align-self: flex-start;
        }

        .action-buttons {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Modern Welcome Header -->
    <div class="welcome-header">
        <h1>Welcome to Admin Dashboard</h1>
        <p>Manage barangay operations, residents, and services efficiently.</p>
    </div>

    <!-- Modern Stats Grid (Additional to your existing stats) -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="modern-stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="modern-stat-label">Total Residents</div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="modern-stat-number">{{ number_format($totalResidentsCount) }}</div>
                <div class="modern-stat-label">Registered Residents</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="modern-stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="modern-stat-label">Total Male Residents</div>
                    <div class="stat-icon">
                        <i class="fas fa-male"></i>
                    </div>
                </div>
                <div class="modern-stat-number">{{ number_format($totalResidentsMale) }}</div>
                <div class="modern-stat-label">Registered Male Residents</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="modern-stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="modern-stat-label">Total Female Residents</div>
                    <div class="stat-icon">
                        <i class="fas fa-female"></i>
                    </div>
                </div>
                <div class="modern-stat-number">{{ number_format($totalResidentsFemale) }}</div>
                <div class="modern-stat-label">Registered Female Residents</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="modern-stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="modern-stat-label">Total Seniors</div>
                    <div class="stat-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <div class="modern-stat-number">{{ number_format($totalSeniors) }}</div>
                <div class="modern-stat-label">Registered Senior Residents</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="modern-stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="modern-stat-label">Total Youth</div>
                    <div class="stat-icon">
                        <i class="fas fa-child"></i>
                    </div>
                </div>
                <div class="modern-stat-number">{{ number_format($totalYouth) }}</div>
                <div class="modern-stat-label">Registered Youth Residents</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="modern-stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="modern-stat-label">Total Households</div>
                    <div class="stat-icon">
                        <i class="fas fa-home"></i>
                    </div>
                </div>
                <div class="modern-stat-number">{{ number_format($totalHouseholds) }}</div>
                <div class="modern-stat-label">Total Households</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="modern-stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="modern-stat-label">Total Seniors</div>
                    <div class="stat-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <div class="modern-stat-number">{{ number_format($totalSeniorPensioners) }}</div>
                <div class="modern-stat-label">Registered Senior Residents Pensioners</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>
        <!-- <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="modern-stat-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="modern-stat-label">Total Families</div>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="modern-stat-number">{{ number_format($totalFamilies) }}</div>
                <div class="modern-stat-label">Total Families</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div> -->
    </div>

    <!-- Quick Actions Section with Bootstrap -->
    <!-- <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="quick-actions-section">
                <div class="section-header">
                    <h3 class="section-title">Quick Actions</h3>
                </div>
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <a href="#" class="action-btn">
                            <div class="action-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            Add Resident
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="#" class="action-btn">
                            <div class="action-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            Service Requests
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="#" class="action-btn">
                            <div class="action-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            Reports
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="#" class="action-btn">
                            <div class="action-icon">
                                <i class="fas fa-cog"></i>
                            </div>
                            Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Households Information -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="chart-card card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Households per Purok</span>
                    <span class="badge bg-primary">{{ $householdsPerPurok->count() }} Puroks</span>
                </div>
                <div class="card-body">
                    <ul class="list-group purok-list">
                        @foreach($householdsPerPurok as $purok)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Purok {{ $purok->purok_no }}
                                <span class="badge badge-count rounded-pill">{{ $purok->household_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-card card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Households per Sitio</span>
                    <span class="badge bg-primary">{{ $householdsPerSitio->count() }} Sitios</span>
                </div>
                <div class="card-body">
                    <ul class="list-group sitio-list">
                        @foreach($householdsPerSitio as $sitio)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $sitio->sitio }}
                                <span class="badge badge-count rounded-pill">{{ $sitio->household_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Requests Section -->
    <div class="requests-section">
        <div class="section-header">
            <h4>Recent Service Requests</h4>
            <a href="#" class="view-all-btn">View All</a>
        </div>

        <div class="row g-3">
            @forelse($recentRequests as $request)
                <div class="col-12">
                    <div class="request-card card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="request-info">
                                    <h5 class="card-title">{{ $request->service_type }}</h5>
                                    <p class="request-meta mb-1">
                                        Requested by {{ $request->resident->name ?? ($request->Fname . ' ' . $request->lname) }}
                                    </p>
                                    <p class="request-date mb-0">
                                        {{ $request->created_at->format('Y-m-d') }}
                                    </p>
                                </div>
                                <div>
                                    @php
                                        $statusClass = 'status-default';
                                        $statusText = strtolower($request->status ?? '');
                                        if ($statusText === 'approved') {
                                            $statusClass = 'status-approved';
                                        } elseif ($statusText === 'processing') {
                                            $statusClass = 'status-processing';
                                        } elseif ($statusText === 'pending') {
                                            $statusClass = 'status-pending';
                                        } elseif ($statusText === 'completed') {
                                            $statusClass = 'status-completed';
                                        } elseif ($statusText === 'rejected') {
                                            $statusClass = 'status-rejected';
                                        }
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">{{ ucfirst($request->status) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card">
                        <div class="card-body empty-state">
                            <p class="mb-0">No recent service requests found.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
