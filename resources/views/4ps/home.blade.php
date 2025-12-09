@extends('4ps.dashboard')
@section('content')
<style>
    :root {
        --primary-blue: #2c3e50ff;
        --gray: #007bff;
        --warning: #ffc107;
        --success: #28a745;
        --danger: #dc3545;
        --light-bg: #f8f9fa;
        --dark-text: #333;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    .dashboard-container {
        padding: 20px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .dashboard-title {
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 15px;
        font-size: 2.5rem;
        text-align: center;
    }

    .dashboard-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue), var(--success));
        border-radius: 2px;
    }

    .stat-card {
        border: none;
        border-radius: 15px;
        box-shadow: var(--shadow);
        transition: var(--transition);
        margin-bottom: 25px;
        overflow: hidden;
        background: white;
        position: relative;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .stat-card:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        border-radius: 15px 15px 0 0;
    }

    .card-residents:before { background: var(--primary-blue); }
    .card-requests:before { background: var(--gray); }
    .card-pending:before { background: var(--warning); }
    .card-accepted:before { background: var(--success); }
    .card-rejected:before { background: var(--danger); }

    .stat-card .card-header {
        background-color: var(--light-bg);
        border-bottom: 2px solid rgba(0,0,0,0.05);
        font-weight: 600;
        font-size: 1rem;
        padding: 1.2rem 1.5rem;
        text-align: center;
        color: var(--dark-text);
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .stat-card .card-body {
        text-align: center;
        padding: 2.5rem 1.5rem;
        position: relative;
    }

    .stat-card .card-title {
        font-size: 3rem;
        font-weight: 800;
        margin: 0;
        line-height: 1;
    }

    .card-residents .card-title {
        color: var(--primary-blue);
        text-shadow: 2px 2px 4px rgba(0, 123, 255, 0.1);
    }

    .card-requests .card-title {
        color: var(--gray);
        text-shadow: 2px 2px 4px rgba(108, 117, 125, 0.1);
    }

    .card-pending .card-title {
        color: var(--warning);
        text-shadow: 2px 2px 4px rgba(255, 193, 7, 0.1);
    }

    .card-accepted .card-title {
        color: var(--success);
        text-shadow: 2px 2px 4px rgba(40, 167, 69, 0.1);
    }

    .card-rejected .card-title {
        color: var(--danger);
        text-shadow: 2px 2px 4px rgba(220, 53, 69, 0.1);
    }

    .icon-wrapper {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 1.5rem;
        opacity: 0.2;
    }

    .card-residents .icon-wrapper { color: var(--primary-blue); }
    .card-requests .icon-wrapper { color: var(--gray); }
    .card-pending .icon-wrapper { color: var(--warning); }
    .card-accepted .icon-wrapper { color: var(--success); }
    .card-rejected .icon-wrapper { color: var(--danger); }

    /* Progress bar styles for additional visual representation */
    .progress-container {
        margin-top: 15px;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-size: 0.85rem;
        color: #666;
    }

    .progress {
        height: 6px;
        border-radius: 3px;
        background-color: #e9ecef;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        border-radius: 3px;
        transition: width 0.6s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2rem;
        }

        .stat-card .card-title {
            font-size: 2.5rem;
        }

        .col-md-2, .col-md-3 {
            margin-bottom: 15px;
        }
    }

    @media (max-width: 576px) {
        .stat-card .card-title {
            font-size: 2rem;
        }

        .stat-card .card-header {
            font-size: 0.9rem;
            padding: 1rem;
        }
    }

    /* Animation for numbers */
    @keyframes countUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card-title {
        animation: countUp 0.8s ease-out;
    }

    /* Additional styling for percentage indicators */
    .percentage-indicator {
        font-size: 0.9rem;
        font-weight: 600;
        margin-top: 8px;
        padding: 3px 10px;
        border-radius: 12px;
        display: inline-block;
    }

    .percentage-positive {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success);
    }

    .percentage-negative {
        background-color: rgba(220, 53, 69, 0.1);
        color: var(--danger);
    }
</style>

<div class="dashboard-container">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="dashboard-title">Welcome to 4PS Dashboard</h1>
                <p class="text-center text-muted">Overview of system statistics and activities</p>
            </div>
        </div>

        <div class="row">
            <!-- Total Residents Card -->
            <div class="col-md-3">
                <div class="card stat-card card-residents">
                    <div class="icon-wrapper">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-header">
                        Total 4PS Residents
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($totalResidents) }}</h5>
                        <p class="text-muted mb-0">Registered beneficiaries</p>

                        @if(isset($residentsGrowth))
                        <div class="progress-container">
                            <div class="progress-label">
                                <span>Growth</span>
                                <span class="{{ $residentsGrowth >= 0 ? 'percentage-positive' : 'percentage-negative' }}">
                                    {{ $residentsGrowth >= 0 ? '+' : '' }}{{ $residentsGrowth }}%
                                </span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ min(abs($residentsGrowth), 100) }}%;
                                    background-color: {{ $residentsGrowth >= 0 ? 'var(--success)' : 'var(--danger)' }};">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Total Requests Card -->
            <div class="col-md-3">
                <div class="card stat-card card-requests">
                    <div class="icon-wrapper">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="card-header">
                        Total Requests
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($totalRequests) }}</h5>
                        <p class="text-muted mb-0">All time submissions</p>

                        @if(isset($totalRequests) && isset($totalResidents) && $totalResidents > 0)
                        <div class="progress-container">
                            <div class="progress-label">
                                <span>Avg per resident</span>
                                <span>{{ number_format($totalRequests / $totalResidents, 1) }}</span>
                            </div>
                            <div class="progress">
                                @php
                                    $avgRequests = min(($totalRequests / $totalResidents) * 10, 100);
                                @endphp
                                <div class="progress-bar" style="width: {{ $avgRequests }}%; background-color: var(--gray);"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card -->
            <div class="col-md-2">
                <div class="card stat-card card-pending">
                    <div class="icon-wrapper">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="card-header">
                        Pending
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($pendingRequests) }}</h5>
                        <p class="text-muted mb-0">Awaiting review</p>

                        @if(isset($totalRequests) && $totalRequests > 0)
                        <div class="progress-container">
                            <div class="progress-label">
                                <span>Percentage</span>
                                <span>{{ number_format(($pendingRequests / $totalRequests) * 100, 1) }}%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ ($pendingRequests / $totalRequests) * 100 }}%;
                                    background-color: var(--warning);"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Accepted Requests Card -->
            <div class="col-md-2">
                <div class="card stat-card card-accepted">
                    <div class="icon-wrapper">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-header">
                        Accepted
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($acceptedRequests) }}</h5>
                        <p class="text-muted mb-0">Approved requests</p>

                        @if(isset($totalRequests) && $totalRequests > 0)
                        <div class="progress-container">
                            <div class="progress-label">
                                <span>Acceptance </span>
                                <span>{{ number_format(($acceptedRequests / $totalRequests) * 100, 1) }}%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ ($acceptedRequests / $totalRequests) * 100 }}%;
                                    background-color: var(--success);"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Rejected Requests Card -->
            <div class="col-md-2">
                <div class="card stat-card card-rejected">
                    <div class="icon-wrapper">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="card-header">
                        Rejected
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($rejectedRequests) }}</h5>
                        <p class="text-muted mb-0">Declined requests</p>

                        @if(isset($totalRequests) && $totalRequests > 0)
                        <div class="progress-container">
                            <div class="progress-label">
                                <span>Rejection Rate</span>
                                <span>{{ number_format(($rejectedRequests / $totalRequests) * 100, 1) }}%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ ($rejectedRequests / $totalRequests) * 100 }}%;
                                    background-color: var(--danger);"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional: Summary Section -->
        @if(isset($totalRequests) && $totalRequests > 0)
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background: var(--primary-blue); color: white;">
                        <h5 class="mb-0">Request Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <div class="p-3">
                                    <h3>{{ number_format(($acceptedRequests / $totalRequests) * 100, 1) }}%</h3>
                                    <p class="text-muted">Acceptance Rate</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3">
                                    <h3>{{ number_format(($pendingRequests / $totalRequests) * 100, 1) }}%</h3>
                                    <p class="text-muted">Pending Rate</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-3">
                                    <h3>{{ number_format(($rejectedRequests / $totalRequests) * 100, 1) }}%</h3>
                                    <p class="text-muted">Rejection Rate</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Font Awesome for icons (add in your main layout if not already included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
    // Optional: Add animation for counting numbers
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.card-title');
        counters.forEach(counter => {
            const target = parseInt(counter.innerText.replace(/,/g, ''));
            const duration = 2000; // 2 seconds
            const step = target / (duration / 16); // 60fps

            let current = 0;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    counter.innerText = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    counter.innerText = Math.floor(current).toLocaleString();
                }
            }, 16);
        });
    });
</script>
@endsection
