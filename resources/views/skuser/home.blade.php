@extends('skuser.dashboard')
@section('title', 'SK Home')
@section('content')

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #2c3e50;
        --primary-dark: #1a252f;
        --primary-light: #3498db;
        --secondary-color: #f7b801;
        --secondary-dark: #e0a800;
        --success-color: #27ae60;
        --info-color: #4895ef;
        --warning-color: #f39c12;
        --danger-color: #e74c3c;
        --text-color: #2c3e50;
        --text-light: #5a6c7d;
        --text-muted: #7f8c8d;
        --bg-color: #f5f7fb;
        --card-bg: #ffffff;
        --border-color: #e9ecef;
        --border-radius: 0.75rem;
        --border-radius-sm: 0.5rem;
        --transition: all 0.3s ease;
        --box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
        --box-shadow-sm: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.06);
    }

    body {
        background-color: var(--bg-color);
        color: var(--text-color);
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
    }

    .container {
        max-width: 1400px;
        padding: 2rem;
    }

    /* Header Section */
    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-title {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 2.25rem;
        margin-bottom: 0.5rem;
        position: relative;
    }

    .dashboard-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 2px;
    }

    .welcome-text {
        color: var(--text-light);
        font-size: 1.1rem;
        margin-bottom: 0;
        font-weight: 400;
    }

    /* Analytics Cards */
    .analytics-grid {
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: var(--card-bg);
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow-sm);
        transition: var(--transition);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--box-shadow);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--secondary-color);
    }

    .stat-card-primary::before { background: var(--primary-color); }
    .stat-card-success::before { background: var(--success-color); }
    .stat-card-info::before { background: var(--info-color); }
    .stat-card-warning::before { background: var(--warning-color); }
    .stat-card-danger::before { background: var(--danger-color); }

    .stat-card .card-body {
        padding: 1.75rem 1.5rem;
        position: relative;
    }

    .stat-card .card-icon {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        font-size: 2.5rem;
        opacity: 0.1;
        color: var(--primary-color);
    }

    .stat-card .card-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-card .card-label {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 0;
    }

    /* Filter Section */
    .filter-section {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow-sm);
        padding: 1.75rem;
        margin-bottom: 2.5rem;
        border: 1px solid var(--border-color);
    }

    .filter-section .form-label {
        font-weight: 600;
        color: var(--text-color);
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .filter-section .form-control,
    .filter-section .form-select {
        border: 2px solid var(--border-color);
        border-radius: var(--border-radius-sm);
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: var(--transition);
        background-color: #fff;
    }

    .filter-section .form-control:focus,
    .filter-section .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.15);
    }

    /* Chart Cards */
    .chart-card {
        background: var(--card-bg);
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow-sm);
        transition: var(--transition);
        height: 100%;
        margin-bottom: 2rem;
    }

    .chart-card:hover {
        box-shadow: var(--box-shadow);
    }

    .chart-card .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        border: none;
        padding: 1.25rem 1.5rem;
        border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    }

    .chart-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chart-card .card-title i {
        font-size: 1.2rem;
    }

    .chart-card .card-body {
        padding: 1.5rem;
    }

    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    /* Buttons */
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border: none;
        border-radius: var(--border-radius-sm);
        padding: 0.875rem 1.75rem;
        font-weight: 600;
        font-size: 0.95rem;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(44, 62, 80, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(44, 62, 80, 0.3);
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .container {
            padding: 1.5rem;
        }

        .stat-card .card-value {
            font-size: 2.25rem;
        }
    }

    @media (max-width: 992px) {
        .dashboard-title {
            font-size: 2rem;
        }

        .stat-card .card-value {
            font-size: 2rem;
        }

        .chart-container {
            height: 250px;
        }
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .dashboard-title {
            font-size: 1.75rem;
        }

        .welcome-text {
            font-size: 1rem;
        }

        .stat-card .card-body {
            padding: 1.5rem 1.25rem;
        }

        .stat-card .card-value {
            font-size: 1.75rem;
        }

        .stat-card .card-icon {
            font-size: 2rem;
            top: 1.25rem;
            right: 1.25rem;
        }

        .filter-section {
            padding: 1.5rem;
        }

        .chart-card .card-body {
            padding: 1.25rem;
        }

        .chart-container {
            height: 200px;
        }
    }

    @media (max-width: 576px) {
        .dashboard-title {
            font-size: 1.5rem;
        }

        .stat-card .card-value {
            font-size: 1.5rem;
        }

        .filter-section .row {
            gap: 1rem;
        }

        .filter-section .col-md-4 {
            width: 100%;
        }
    }

    /* Loading Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--bg-color);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }

    /* Status Badges */
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .badge-completed {
        background: rgba(39, 174, 96, 0.1);
        color: var(--success-color);
    }

    .badge-ongoing {
        background: rgba(72, 149, 239, 0.1);
        color: var(--info-color);
    }

    .badge-pending {
        background: rgba(243, 156, 18, 0.1);
        color: var(--warning-color);
    }

    .badge-hold {
        background: rgba(231, 76, 60, 0.1);
        color: var(--danger-color);
    }
</style>

<div class="container py-4">
    <!-- Header Section -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Welcome to the SK Dashboard</h1>
        <p class="welcome-text">Here's a comprehensive overview of your project analytics and performance metrics.</p>
    </div>

    <!-- Analytics Cards -->
    <div class="row analytics-grid g-4 gap-5">
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card stat-card stat-card-primary fade-in-up">
                <div class="card-body">
                    <i class="fas fa-clipboard-list card-icon"></i>
                    <div class="card-value">{{ $totalProjects }}</div>
                    <div class="card-label">Total Projects</div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card stat-card stat-card-success fade-in-up">
                <div class="card-body">
                    <i class="fas fa-check-circle card-icon"></i>
                    <div class="card-value">{{ $completedProjects }}</div>
                    <div class="card-label">Completed</div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card stat-card stat-card-info fade-in-up">
                <div class="card-body">
                    <i class="fas fa-spinner card-icon"></i>
                    <div class="card-value">{{ $ongoingProjects }}</div>
                    <div class="card-label">In Progress</div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card stat-card stat-card-warning fade-in-up">
                <div class="card-body">
                    <i class="fas fa-pause-circle card-icon"></i>
                    <div class="card-value">{{ $pendingProjects }}</div>
                    <div class="card-label">Not Started</div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="card stat-card stat-card-danger fade-in-up">
                <div class="card-body">
                    <i class="fas fa-exclamation-triangle card-icon"></i>
                    <div class="card-value">{{ $holdProjects }}</div>
                    <div class="card-label">On Hold</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section fade-in-up">
        <form method="GET" action="{{ route('sk.home') }}">
            <div class="row g-4 align-items-end">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="year" class="form-label">Filter by Year</label>
                        <select name="year" id="year" class="form-select">
                            @for ($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="month" class="form-label">Filter by Month</label>
                        <select name="month" id="month" class="form-select">
                            <option value="">All Months</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $selectedMonth == $i ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-2"></i>Apply Filters
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Charts Section -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card chart-card fade-in-up">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-chart-bar"></i>
                        Projects Timeline
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="projectsByMonthChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card chart-card fade-in-up">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-chart-pie"></i>
                        Project Status Distribution
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="projectsByStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Stats Section -->
    <div class="row mt-4 g-4">
        <div class="col-lg-8">
            <div class="card chart-card fade-in-up">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-trend-up"></i>
                        Monthly Progress Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="monthlyProgressChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card chart-card fade-in-up">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-calendar-check"></i>
                        Quick Stats
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                <span class="fw-semibold">Completion Rate</span>
                                <span class="badge bg-success">
                                    {{ $totalProjects > 0 ? round(($completedProjects / $totalProjects) * 100, 1) : 0 }}%
                                </span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                <span class="fw-semibold">Active Projects</span>
                                <span class="badge bg-info">{{ $ongoingProjects }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                <span class="fw-semibold">Need Attention</span>
                                <span class="badge bg-warning">{{ $holdProjects + $pendingProjects }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Chart data from PHP
    var projectsByMonthData = @json($projectsByMonth);
    var projectsByStatusData = {
        'Completed': {{ $completedProjects }},
        'Ongoing': {{ $ongoingProjects }},
        'Pending': {{ $pendingProjects }},
        'On Hold': {{ $holdProjects }}
    };

    // Projects by Month Chart (Bar Chart)
    var ctxMonth = document.getElementById('projectsByMonthChart').getContext('2d');
    new Chart(ctxMonth, {
        type: 'bar',
        data: {
            labels: Object.keys(projectsByMonthData),
            datasets: [{
                label: 'Number of Projects',
                data: Object.values(projectsByMonthData).map(months => months.length),
                backgroundColor: 'rgba(44, 62, 80, 0.8)',
                borderColor: 'rgba(44, 62, 80, 1)',
                borderWidth: 2,
                borderRadius: 4,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        font: {
                            family: "'Poppins', sans-serif"
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif"
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(44, 62, 80, 0.9)',
                    titleFont: {
                        family: "'Poppins', sans-serif"
                    },
                    bodyFont: {
                        family: "'Poppins', sans-serif"
                    }
                }
            }
        }
    });

    // Projects by Status Chart (Pie Chart)
    var ctxStatus = document.getElementById('projectsByStatusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: Object.keys(projectsByStatusData),
            datasets: [{
                label: 'Projects by Status',
                data: Object.values(projectsByStatusData),
                backgroundColor: [
                    'rgba(39, 174, 96, 0.8)',
                    'rgba(72, 149, 239, 0.8)',
                    'rgba(243, 156, 18, 0.8)',
                    'rgba(231, 76, 60, 0.8)'
                ],
                borderColor: [
                    'rgba(39, 174, 96, 1)',
                    'rgba(72, 149, 239, 1)',
                    'rgba(243, 156, 18, 1)',
                    'rgba(231, 76, 60, 1)'
                ],
                borderWidth: 2,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 12
                        },
                        padding: 20,
                        usePointStyle: true
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(44, 62, 80, 0.9)',
                    titleFont: {
                        family: "'Poppins', sans-serif"
                    },
                    bodyFont: {
                        family: "'Poppins', sans-serif"
                    }
                }
            },
            cutout: '60%'
        }
    });

    // Monthly Progress Chart (Line Chart)
    var ctxProgress = document.getElementById('monthlyProgressChart').getContext('2d');

    // Sample data for monthly progress - you can replace this with actual data from your backend
    var monthlyProgressData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        completed: [2, 3, 5, 4, 6, 8, 7, 9, 10, 8, 6, 7],
        ongoing: [8, 7, 6, 8, 7, 5, 6, 4, 3, 5, 7, 6]
    };

    new Chart(ctxProgress, {
        type: 'line',
        data: {
            labels: monthlyProgressData.labels,
            datasets: [
                {
                    label: 'Completed Projects',
                    data: monthlyProgressData.completed,
                    borderColor: 'rgba(39, 174, 96, 1)',
                    backgroundColor: 'rgba(39, 174, 96, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Ongoing Projects',
                    data: monthlyProgressData.ongoing,
                    borderColor: 'rgba(72, 149, 239, 1)',
                    backgroundColor: 'rgba(72, 149, 239, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif"
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: "'Poppins', sans-serif"
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            family: "'Poppins', sans-serif",
                            size: 12
                        },
                        usePointStyle: true
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(44, 62, 80, 0.9)',
                    titleFont: {
                        family: "'Poppins', sans-serif"
                    },
                    bodyFont: {
                        family: "'Poppins', sans-serif"
                    }
                }
            }
        }
    });

    // Add animation to cards on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all fade-in-up elements
        document.querySelectorAll('.fade-in-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    });

    // Filter form enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const yearSelect = document.getElementById('year');
        const monthSelect = document.getElementById('month');

        if (yearSelect && monthSelect) {
            yearSelect.addEventListener('change', function() {
                // You can add additional logic here if needed
                console.log('Year changed to:', this.value);
            });

            monthSelect.addEventListener('change', function() {
                // You can add additional logic here if needed
                console.log('Month changed to:', this.value);
            });
        }
    });

    // Responsive sidebar handling (if you have a sidebar)
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.querySelector('.sidebar-toggle');
        const mainContent = document.querySelector('.container');

        if (sidebarToggle && mainContent) {
            sidebarToggle.addEventListener('click', function() {
                mainContent.classList.toggle('sidebar-closed');
            });
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth < 768) {
                document.body.classList.add('mobile-view');
            } else {
                document.body.classList.remove('mobile-view');
            }
        });

        // Initial check
        if (window.innerWidth < 768) {
            document.body.classList.add('mobile-view');
        }
    });
</script>

@endsection
