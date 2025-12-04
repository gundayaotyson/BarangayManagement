@extends('bhw.dashboard')
@section('content')
<style>
/* Enhanced BHW Dashboard Styles */
:root {
    --primary: #4e73df;
    --primary-light: #9bb8f5;
    --primary-dark: #3a5ccc;
    --success: #1cc88a;
    --success-light: #7ae0b5;
    --info: #36b9cc;
    --info-light: #7cdbf2;
    --warning: #f6c23e;
    --warning-light: #f9d886;
    --danger: #e74a3b;
    --danger-light: #f4a79c;
    --dark: #5a5c69;
    --light: #f8f9fc;
    --white: #ffffff;
    --border-radius: 12px;
    --border-radius-sm: 8px;
    --box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    --box-shadow-lg: 0 8px 25px rgba(0,0,0,0.12);
    --transition: all 0.3s ease;
}

/* Base Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8f9fc;
}

.container-fluid {
    padding: 1.5rem;
}

/* Page Header */
.d-sm-flex.align-items-center.justify-content-between.mb-4 {
    margin-bottom: 2rem !important;
}

.h3.mb-0.text-gray-800.font-weight-bold {
    font-weight: 700 !important;
    color: #2e384d;
    margin-bottom: 0.5rem !important;
}

.mb-0.text-muted {
    color: #6c757d !important;
    font-size: 0.95rem;
}

.bg-primary.text-white.p-3.rounded-lg {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
    border: none;
    box-shadow: var(--box-shadow);
    border-radius: var(--border-radius) !important;
}

.rounded-lg {
    border-radius: var(--border-radius) !important;
}

/* Statistics Cards */
.card {
    transition: var(--transition);
    border-radius: var(--border-radius) !important;
    border: none;
    box-shadow: var(--box-shadow);
    margin-bottom: 1.5rem;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: var(--box-shadow-lg) !important;
}

.card.border-left-primary { border-left: 4px solid var(--primary) !important; }
.card.border-left-success { border-left: 4px solid var(--success) !important; }
.card.border-left-info { border-left: 4px solid var(--info) !important; }
.card.border-left-warning { border-left: 4px solid var(--warning) !important; }
.card.border-left-danger { border-left: 4px solid var(--danger) !important; }

.card-body {
    padding: 1.5rem;
    position: relative;
    z-index: 2;
}

.position-absolute.top-0.end-0.mt-3.me-3.opacity-10 {
    z-index: 1;
    font-size: 3.5rem !important;
    opacity: 0.15 !important;
}

.text-xs.font-weight-bold.text-uppercase.mb-1 {
    font-size: 0.8rem;
    font-weight: 600 !important;
    letter-spacing: 0.5px;
    margin-bottom: 0.75rem !important;
}

.h5.mb-0.font-weight-bold.text-gray-800 {
    font-size: 1.75rem;
    font-weight: 700 !important;
    color: #2e384d !important;
    margin-bottom: 1rem !important;
}

.mt-2.mb-0.text-muted.text-xs {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: #6c757d !important;
    margin-top: 0.75rem !important;
}

.text-primary-300 { color: var(--primary-light) !important; }
.text-success-300 { color: var(--success-light) !important; }
.text-info-300 { color: var(--info-light) !important; }
.text-warning-300 { color: var(--warning-light) !important; }
.text-danger-300 { color: var(--danger-light) !important; }

/* Tables */
.card.shadow.mb-4.border-0 {
    border-radius: var(--border-radius) !important;
    overflow: hidden;
}

.card-header.bg-white.py-3 {
    background: var(--white) !important;
    border-bottom: 1px solid #e3e6f0;
    padding: 1.25rem 1.5rem !important;
}

.card-header h6 {
    font-weight: 600 !important;
    color: #2e384d;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0 !important;
}

.btn.btn-sm.btn-primary {
    background: var(--primary);
    border: none;
    border-radius: var(--border-radius-sm);
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
    font-weight: 500;
    transition: var(--transition);
}

.btn.btn-sm.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(78, 115, 223, 0.3);
}

.table-responsive {
    border-radius: 0 0 var(--border-radius) var(--border-radius);
    overflow: hidden;
}

.table.table-hover.table-borderless {
    margin-bottom: 0 !important;
}

.table thead.bg-light {
    background-color: #f8f9fc !important;
}

.table th.border-0 {
    border: none !important;
    padding: 1rem 1.5rem;
    font-weight: 600;
    color: #6c757d;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table td {
    padding: 1.25rem 1.5rem;
    vertical-align: middle;
    border-top: 1px solid #e3e6f0;
}

.table tbody tr {
    transition: var(--transition);
}

.table tbody tr:hover {
    background-color: rgba(78, 115, 223, 0.05) !important;
}

.bg-primary.rounded-circle.p-2.me-3,
.bg-info.rounded-circle.p-2.me-3 {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50% !important;
}

.fw-bold.text-dark {
    font-weight: 600 !important;
    color: #2e384d !important;
    margin-bottom: 0.25rem;
}

.badge {
    font-size: 0.75rem;
    font-weight: 500;
    padding: 0.4rem 0.75rem;
    border-radius: var(--border-radius-sm);
}

.badge.bg-warning.text-dark {
    background-color: rgba(246, 194, 62, 0.15) !important;
    color: #856404 !important;
    border: 1px solid rgba(246, 194, 62, 0.3);
}

.badge.bg-success {
    background-color: rgba(28, 200, 138, 0.15) !important;
    color: #155724 !important;
    border: 1px solid rgba(28, 200, 138, 0.3);
}

.badge.bg-secondary {
    background-color: rgba(108, 117, 125, 0.15) !important;
    color: #383d41 !important;
    border: 1px solid rgba(108, 117, 125, 0.3);
}

.badge.bg-light.text-dark.border {
    background-color: #f8f9fc !important;
    color: #5a5c69 !important;
    border: 1px solid #e3e6f0 !important;
}

/* Quick Actions */
.card.shadow.border-0 {
    border-radius: var(--border-radius) !important;
}

.action-card {
    transition: var(--transition);
    border-radius: var(--border-radius) !important;
    border: 1px solid #e3e6f0;
    text-decoration: none;
    color: inherit;
    height: 100%;
}

.action-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--box-shadow-lg) !important;
    text-decoration: none;
    color: inherit;
}

.action-card .card-body {
    padding: 2rem 1.5rem !important;
    text-align: center;
}

.bg-primary.rounded-circle.p-3.mb-3.mx-auto,
.bg-success.rounded-circle.p-3.mb-3.mx-auto,
.bg-info.rounded-circle.p-3.mb-3.mx-auto {
    width: 70px !important;
    height: 70px !important;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50% !important;
    transition: var(--transition);
}

.action-card:hover .bg-primary.rounded-circle.p-3.mb-3.mx-auto {
    background: var(--primary-dark) !important;
    transform: scale(1.1);
}

.action-card:hover .bg-success.rounded-circle.p-3.mb-3.mx-auto {
    background: #17a673 !important;
    transform: scale(1.1);
}

.action-card:hover .bg-info.rounded-circle.p-3.mb-3.mx-auto {
    background: #2a9cb8 !important;
    transform: scale(1.1);
}

.fw-bold.text-dark.mb-1 {
    font-weight: 600 !important;
    color: #2e384d !important;
    margin-bottom: 0.5rem !important;
    font-size: 1rem;
}

/* Empty States */
.text-center.py-4.text-muted {
    padding: 3rem 1rem !important;
}

.text-center.py-4.text-muted i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem;
    }

    .d-sm-flex.align-items-center.justify-content-between.mb-4 {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }

    .d-none.d-sm-inline-block {
        display: block !important;
        width: 100%;
    }

    .bg-primary.text-white.p-3.rounded-lg {
        padding: 1rem !important;
        text-align: center;
    }

    .card-body {
        padding: 1.25rem;
    }

    .h5.mb-0.font-weight-bold.text-gray-800 {
        font-size: 1.5rem;
    }

    .position-absolute.top-0.end-0.mt-3.me-3.opacity-10 {
        font-size: 2.5rem !important;
        margin-top: 1rem !important;
        margin-right: 1rem !important;
    }

    .table th,
    .table td {
        padding: 0.75rem 1rem;
    }

    .card-header.bg-white.py-3 {
        padding: 1rem !important;
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start !important;
    }

    .action-card .card-body {
        padding: 1.5rem 1rem !important;
    }

    .bg-primary.rounded-circle.p-3.mb-3.mx-auto,
    .bg-success.rounded-circle.p-3.mb-3.mx-auto,
    .bg-info.rounded-circle.p-3.mb-3.mx-auto {
        width: 60px !important;
        height: 60px !important;
    }
}

@media (max-width: 576px) {
    .col-md-3.col-6.mb-3 {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .table-responsive {
        font-size: 0.85rem;
    }

    .d-flex.align-items-center {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.5rem;
    }

    .bg-primary.rounded-circle.p-2.me-3,
    .bg-info.rounded-circle.p-2.me-3 {
        margin-right: 0 !important;
        margin-bottom: 0.5rem;
    }
}

/* Animation for cards */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.5s ease-out;
}

/* Stagger animation for statistics cards */
.row .col-xl-3.col-md-6.mb-4:nth-child(1) .card { animation-delay: 0.1s; }
.row .col-xl-3.col-md-6.mb-4:nth-child(2) .card { animation-delay: 0.2s; }
.row .col-xl-3.col-md-6.mb-4:nth-child(3) .card { animation-delay: 0.3s; }
.row .col-xl-3.col-md-6.mb-4:nth-child(4) .card { animation-delay: 0.4s; }
</style>

<script>
// Enhanced JavaScript for current date
function updateCurrentDate() {
    const now = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', options);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCurrentDate();

    // Update every minute
    setInterval(updateCurrentDate, 60000);

    // Add loading animation to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
    });

    // Animate cards in
    setTimeout(() => {
        cards.forEach(card => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        });
    }, 100);
});
</script>
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
                        <!-- <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-primary-300"></i>
                        </div> -->
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
                            <!-- <i class="fas fa-clock fa-2x text-warning-300"></i> -->
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
                            <!-- <i class="fas fa-calendar-check fa-2x text-info-300"></i> -->
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
                            <!-- <i class="fas fa-female fa-2x text-success-300"></i> -->
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
                            <!-- <i class="fas fa-baby fa-2x text-primary-300"></i> -->
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
                            <!-- <i class="fas fa-male fa-2x text-info-300"></i> -->
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
                            <!-- <i class="fas fa-female fa-2x text-danger-300"></i> -->
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
                            <!-- <i class="fas fa-baby-carriage fa-2x text-success-300"></i> -->
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
