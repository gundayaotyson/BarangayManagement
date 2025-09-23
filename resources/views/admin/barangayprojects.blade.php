@extends('admin.dashboard')

@section('content')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS (v4 for data-dismiss, v5 uses data-bs-dismiss) -->




<style>
/* Base Styles */
:root {
    --primary: #2c3e50;
    --primary-light: #e6eaf8;
    --secondary: #3f37c9;
    --success: #27ae60;
    --info: #4895ef;
    --warning: #f39c12;
    --danger: #e74c3c;
    --light: #f8f9fa;
    --dark: #2c3e50;
    --gray: #6c757d;
    --gray-light: #e9ecef;
    --white: #ffffff;
    --shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    --shadow-sm: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    --border-radius: 0.375rem;
    --transition: all 0.3s ease;
}

body {
    font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    background-color: #f5f7fb;
    color: var(--dark);
    line-height: 1.6;
}

/* Layout */
.container-fluid {
    padding: 2rem;
    max-width: 1600px;
    margin: 0 auto;
}

/* Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--gray-light);
}

.page-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--dark);
    margin: 0;
}

/* Cards */
.card {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    margin-bottom: 1.5rem;
    background-color: var(--white);
}

.card:hover {
    box-shadow: var(--shadow);
    transform: translateY(-3px);
}

.card-header {
    background-color: var(--white);
    border-bottom: 1px solid var(--gray-light);
    padding: 1.25rem 1.5rem;
    border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    color: var(--primary);
}

.card-body {
    padding: 1.5rem;
}

/* Analytics Cards */
.analytics-card {
    border-left: 4px solid;
    transition: var(--transition);
    height: 100%;
}

.analytics-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
}

.analytics-card .card-body {
    padding: 1.25rem;
}

.analytics-card-primary {
    border-left-color: var(--primary);
}

.analytics-card-success {
    border-left-color: var(--success);
}

.analytics-card-info {
    border-left-color: var(--info);
}

.analytics-card-warning {
    border-left-color: var(--warning);
}

.analytics-card .card-icon {
    font-size: 2rem;
    opacity: 0.7;
    color: var(--gray);
}

.analytics-card .card-value {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0.5rem 0;
}

.analytics-card .card-label {
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--gray);
    font-weight: 600;
}

/* Progress Bars */
.progress {
    height: 0.75rem;
    border-radius: 10rem;
    background-color: var(--gray-light);
}

.progress-bar {
    border-radius: 10rem;
}

/* Badges */
.badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.35em 0.65em;
    border-radius: 10rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.badge-success {
    background-color: rgba(76, 201, 240, 0.1);
    color: var(--success);
}

.badge-info {
    background-color: rgba(72, 149, 239, 0.1);
    color: var(--info);
}

.badge-warning {
    background-color: rgba(248, 150, 30, 0.1);
    color: var(--warning);
}

.badge-danger {
    background-color: rgba(247, 37, 133, 0.1);
    color: var(--danger);
}

.badge-secondary {
    background-color: var(--gray-light);
    color: var(--gray);
}

/* Tables */
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: var(--dark);
    background-color: var(--white);
    border-collapse: separate;
    border-spacing: 0;
}

.table th {
    padding: 1rem;
    background-color: #2c3e50;
    color: var(  --primary-light);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
    border-bottom: 1px solid var(--gray-light);
    position: sticky;
    top: 0;
}

.table td {
    padding: 1rem;
    vertical-align: middle;
    border-top: 1px solid var(--gray-light);
}

.table-hover tbody tr:hover {
    background-color: rgba(67, 97, 238, 0.05);
}

.table-responsive {
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

/* Buttons */
.btn {
    border-radius: var(--border-radius);
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: var(--transition);
    border: none;
    box-shadow: none;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

.btn-primary {
    background-color: var(--dark);
}

.btn-primary:hover {
    background-color: var(--primary);
    transform: translateY(-2px);
}

.btn-outline-primary {
    border-color: var(--primary);
    color: var(--primary);
}

.btn-outline-primary:hover {
    background-color: var(--primary);
}

.btn-icon {
    width: 2rem;
    height: 2rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

/* Forms */
.form-control {
    border: 1px solid var(--gray-light);
    border-radius: var(--border-radius);
    padding: 0.5rem 0.75rem;
    transition: var(--transition);
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
    color: var(--dark);
}

/* Modals */
.modal-content {
    border: none;
    border-radius: var(--border-radius);
    box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.2);
}

.modal-header {
    border-bottom: 1px solid var(--gray-light);
    padding: 1.25rem 1.5rem;
}

.modal-title {
    font-weight: 600;
    color: var(--primary);
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    border-top: 1px solid var(--gray-light);
    padding: 1rem 1.5rem;
}

/* Filter Section */
.filter-section {
    background-color: var(--white);
    padding: 1rem;
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-sm);
}

.filter-section .form-control {
    background-color: var(--light);
}

/* Project Status Indicators */
.status-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 6px;
}

.status-completed {
    background-color: var(--success);
}

.status-ongoing {
    background-color: var(--info);
}

.status-delayed {
    background-color: var(--warning);
}

.status-cancelled {
    background-color: var(--danger);
}

/* Project Name */
.project-name {
    font-weight: 500;
    color: var(--primary);
}

/* Budget Display */
.budget-display {
    font-weight: 600;
    color: var(--dark);
}

/* Pagination */
.pagination {
    justify-content: center;
    margin-top: 1.5rem;
}

.page-item.active .page-link {
    background-color: var(--primary);
    border-color: var(--primary);
}

.page-link {
    color: var(--primary);
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .container-fluid {
        padding: 1.5rem;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .page-title {
        margin-bottom: 1rem;
    }

    .card-body {
        padding: 1rem;
    }

    .table-responsive {
        border: 1px solid var(--gray-light);
    }
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in {
    animation: fadeIn 0.3s ease-out;
}

/* Utility Classes */
.text-primary {
    color: var(--primary) !important;
}

.bg-primary-light {
    background-color: var(--primary-light);
}

.shadow-sm {
    box-shadow: var(--shadow-sm);
}

.mb-0 {
    margin-bottom: 0 !important;
}

.mt-3 {
    margin-top: 1rem !important;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: var(--gray-light);
}

::-webkit-scrollbar-thumb {
    background-color: var(--primary);
    border-radius: 10rem;
}

/* Loading Spinner */
.loading-spinner {
    display: inline-block;
    width: 1.25rem;
    height: 1.25rem;
    border: 0.2em solid rgba(67, 97, 238, 0.2);
    border-left-color: var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    vertical-align: middle;
    margin-right: 0.5rem;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>
<!-- Updated Header Section -->
<div class="container-fluid">
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-project-diagram me-2"></i>Barangay Projects Management
        </h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
            <i class="fas fa-plus me-2"></i>Add New Project
        </button>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Analytics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card analytics-card analytics-card-primary h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-label">Total Projects</div>
                            <div class="card-value">{{ $totalProjects }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card analytics-card analytics-card-success h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-label">Completed Projects</div>
                            <div class="card-value">{{ $completedProjects }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card analytics-card analytics-card-info h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-label">Ongoing Projects</div>
                            <div class="card-value">{{ $ongoingProjects }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card analytics-card analytics-card-warning h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-label">Delayed Projects</div>
                            <div class="card-value">{{ $delayedProjects }}</div>
                        </div>
                        <div class="card-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Budget and Completion Section -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-money-bill-wave me-2"></i>Budget Utilization
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="text-muted small mb-2">Total Budget</div>
                            <h3 class="text-primary">₱{{ number_format($totalBudget, 2) }}</h3>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="text-muted small mb-2">Funds Utilized</div>
                            <h3 class="text-primary">₱{{ number_format($totalUtilized, 2) }}</h3>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Utilization</span>
                            <span class="font-weight-bold">{{ number_format($budgetUtilizationPercentage, 2) }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                 role="progressbar" style="width: {{ $budgetUtilizationPercentage }}%"
                                 aria-valuenow="{{ $budgetUtilizationPercentage }}"
                                 aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-tasks me-2"></i>Overall Completion
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Average Completion</span>
                            <span class="font-weight-bold">{{ number_format($avgCompletion, 2) }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar"
                                 style="width: {{ $avgCompletion }}%"
                                 aria-valuenow="{{ $avgCompletion }}"
                                 aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="project-status-chart">
                        <div class="d-flex justify-content-between small">
                            <span class="me-3">
                                <i class="fas fa-circle text-success me-1"></i>
                                Completed ({{ $completedProjects }})
                            </span>
                            <span class="me-3">
                                <i class="fas fa-circle text-info me-1"></i>
                                Ongoing ({{ $ongoingProjects }})
                            </span>
                            <span>
                                <i class="fas fa-circle text-warning me-1"></i>
                                Delayed ({{ $delayedProjects }})
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="card">
        <div class="card-header">
            <h6 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>Projects List
            </h6>
        </div>
        <div class="card-body">
            <!-- Filter Options -->
            <div class="row mb-4 g-3">
                <div class="col-md-3">
                    <select id="statusFilter" class="form-control form-select">
                        <option value="">All Statuses</option>
                        <option value="Planned">Planned</option>
                        <option value="Ongoing">Ongoing</option>
                        <option value="Completed">Completed</option>
                        <option value="Delayed">Delayed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="purokFilter" class="form-control form-select">
                        <option value="">All Puroks</option>
                        <option value="Purok 1">Purok 1</option>
                        <option value="Purok 2">Purok 2</option>
                        <option value="Purok 3">Purok 3</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="categoryFilter" class="form-control form-select">
                        <option value="">All Categories</option>
                        <!-- Populated via JS -->
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search projects...">
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-hover" id="projectsTable">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Purok</th>
                            <th>Category</th>
                            <th>Start Date</th>
                            <th>Target Date</th>
                            <th>Progress</th>
                            <th>Budget</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td class="project-name">{{ $project->project_name }}</td>
                            <td>{{ $project->purok }}</td>
                            <td>{{ $project->category }}</td>
                            <td>{{ date('M d, Y', strtotime($project->start_date)) }}</td>
                            <td>{{ date('M d, Y', strtotime($project->target_completion_date)) }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1" style="height: 8px;">
                                        <div class="progress-bar
                                            @if($project->status == 'Completed') bg-success
                                            @elseif($project->status == 'Ongoing') bg-info
                                            @elseif($project->status == 'Delayed') bg-warning
                                            @elseif($project->status == 'Cancelled') bg-danger
                                            @else bg-primary @endif"
                                            role="progressbar"
                                            style="width: {{ $project->completion_percentage }}%"
                                            aria-valuenow="{{ $project->completion_percentage }}"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="ms-2 font-weight-bold">{{ $project->completion_percentage }}%</small>
                                </div>
                            </td>
                            <td class="budget-display">₱{{ number_format($project->total_budget, 2) }}</td>
                            <td>
                                <span class="badge
                                    @if($project->status == 'Completed') badge-success
                                    @elseif($project->status == 'Ongoing') badge-info
                                    @elseif($project->status == 'Delayed') badge-warning
                                    @elseif($project->status == 'Cancelled') badge-danger
                                    @else badge-secondary @endif">
                                    <span class="status-indicator
                                        @if($project->status == 'Completed') status-completed
                                        @elseif($project->status == 'Ongoing') status-ongoing
                                        @elseif($project->status == 'Delayed') status-delayed
                                        @elseif($project->status == 'Cancelled') status-cancelled @endif">
                                    </span>
                                    {{ $project->status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-outline-primary btn-icon view-project me-2"
                                            data-id="{{ $project->id }}" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-primary btn-icon edit-project me-2"
                                            data-id="{{ $project->id }}" title="Edit Project">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger btn-icon delete-project"
                                            data-id="{{ $project->id }}" title="Delete Project">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Add Project Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addProjectModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProjectModalLabel">Add New Project</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('barangayprojects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="project_name">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="purok">Purok</label>
                            <select class="form-control" id="purok" name="purok" required>
                                <option value="">Select Purok</option>
                                <option value="Purok 1">Purok 1</option>
                                <option value="Purok 2">Purok 2</option>
                                <option value="Purok 3">Purok 3</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="target_completion_date">Target Completion Date</label>
                            <input type="date" class="form-control" id="target_completion_date" name="target_completion_date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="Planned">Planned</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Delayed">Delayed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="completion_percentage">Completion Percentage</label>
                            <input type="number" class="form-control" id="completion_percentage" name="completion_percentage" min="0" max="100" value="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="total_budget">Total Budget</label>
                            <input type="number" class="form-control" id="total_budget" name="total_budget" step="0.01" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="funds_utilized">Funds Utilized</label>
                            <input type="number" class="form-control" id="funds_utilized" name="funds_utilized" step="0.01" min="0" value="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="funding_source">Funding Source</label>
                            <input type="text" class="form-control" id="funding_source" name="funding_source" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="project_lead">Project Lead</label>
                            <input type="text" class="form-control" id="project_lead" name="project_lead" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Project Modal -->
<div class="modal fade" id="viewProjectModal" tabindex="-1" role="dialog" aria-labelledby="viewProjectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProjectModalLabel">Project Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 id="view_project_name" class="mb-3"></h4>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Purok:</strong> <span id="view_purok"></span>
                        </div>
                        <div class="col-md-6">
                            <strong>Category:</strong> <span id="view_category"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <strong>Description:</strong>
                            <p id="view_description"></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Start Date:</strong> <span id="view_start_date"></span>
                        </div>
                        <div class="col-md-6">
                            <strong>Target Completion:</strong> <span id="view_target_completion_date"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status:</strong> <span id="view_status"></span>
                        </div>
                        <div class="col-md-6">
                            <strong>Completion:</strong> <span id="view_completion_percentage"></span>%
                            <div class="progress mt-2">
                                <div id="view_progress_bar" class="progress-bar" role="progressbar" style="width: 0%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Total Budget:</strong> ₱<span id="view_total_budget"></span>
                        </div>
                        <div class="col-md-6">
                            <strong>Funds Utilized:</strong> ₱<span id="view_funds_utilized"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Funding Source:</strong> <span id="view_funding_source"></span>
                        </div>
                        <div class="col-md-6">
                            <strong>Project Lead:</strong> <span id="view_project_lead"></span>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" role="dialog" aria-labelledby="editProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProjectModalLabel">Edit Project</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProjectForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="edit_project_name">Project Name</label>
                            <input type="text" class="form-control" id="edit_project_name" name="project_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_purok">Purok</label>
                            <select class="form-control" id="edit_purok" name="purok" required>
                                <option value="">Select Purok</option>
                                <option value="Purok 1">Purok 1</option>
                                <option value="Purok 2">Purok 2</option>
                                <option value="Purok 3">Purok 3</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_category">Category</label>
                            <input type="text" class="form-control" id="edit_category" name="category" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="edit_description">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_start_date">Start Date</label>
                            <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_target_completion_date">Target Completion Date</label>
                            <input type="date" class="form-control" id="edit_target_completion_date" name="target_completion_date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_status">Status</label>
                            <select class="form-control" id="edit_status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="Planned">Planned</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                                <option value="Delayed">Delayed</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_completion_percentage">Completion Percentage</label>
                            <input type="number" class="form-control" id="edit_completion_percentage" name="completion_percentage" min="0" max="100">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_total_budget">Total Budget</label>
                            <input type="number" class="form-control" id="edit_total_budget" name="total_budget" step="0.01" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_funds_utilized">Funds Utilized</label>
                            <input type="number" class="form-control" id="edit_funds_utilized" name="funds_utilized" step="0.01" min="0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_funding_source">Funding Source</label>
                            <input type="text" class="form-control" id="edit_funding_source" name="funding_source" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_project_lead">Project Lead</label>
                            <input type="text" class="form-control" id="edit_project_lead" name="project_lead" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Project</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-labelledby="deleteProjectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProjectModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this project? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteProjectForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
     // Initialize Bootstrap tooltips
    //  $('[data-toggle="tooltip"]').tooltip();
      // Populate category filter with unique categories
      let categories = [];
        $('#projectsTable tbody tr').each(function() {
            const category = $(this).find('td:nth-child(3)').text().trim();
            if (!categories.includes(category)) {
                categories.push(category);
            }
        });

        categories.sort().forEach(function(category) {
            $('#categoryFilter').append(`<option value="${category}">${category}</option>`);
        });

        // Filtering functionality
        $('#statusFilter, #purokFilter, #categoryFilter, #searchInput').on('change keyup', function() {
            const statusFilter = $('#statusFilter').val().toLowerCase();
            const purokFilter = $('#purokFilter').val().toLowerCase();
            const categoryFilter = $('#categoryFilter').val().toLowerCase();
            const searchText = $('#searchInput').val().toLowerCase();

            $('#projectsTable tbody tr').each(function() {
                const status = $(this).find('td:nth-child(4)').text().toLowerCase();
                const purok = $(this).find('td:nth-child(2)').text().toLowerCase();
                const category = $(this).find('td:nth-child(3)').text().toLowerCase();
                const projectName = $(this).find('td:nth-child(1)').text().toLowerCase();

                const statusMatch = !statusFilter || status.includes(statusFilter);
                const purokMatch = !purokFilter || purok.includes(purokFilter);
                const categoryMatch = !categoryFilter || category.includes(categoryFilter);
                const searchMatch = !searchText || projectName.includes(searchText);

                if (statusMatch && purokMatch && categoryMatch && searchMatch) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        // Show Add Project Modal
        $('#showAddProjectModal').on('click', function() {
            console.log('click');
            $('#addProjectModal').modal('show');
        });



    // View Project
    $(document).on('click', '.view-project', function() {
        const projectId = $(this).data('id');
        const modal = new bootstrap.Modal(document.getElementById('viewProjectModal'));

        $.ajax({
            url: `/barangayprojects/${projectId}/view`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const project = response.data;

                    $('#view_project_name').text(project.project_name);
                    $('#view_purok').text(project.purok);
                    $('#view_category').text(project.category);
                    $('#view_description').text(project.description);
                    $('#view_start_date').text(formatDate(project.start_date));
                    $('#view_target_completion_date').text(formatDate(project.target_completion_date));
                    $('#view_status').text(project.status);
                    $('#view_completion_percentage').text(project.completion_percentage);

                    const progressBar = $('#view_progress_bar');
                    progressBar.css('width', project.completion_percentage + '%');
                    progressBar.attr('aria-valuenow', project.completion_percentage);

                    $('#view_total_budget').text(formatNumber(project.total_budget));
                    $('#view_funds_utilized').text(formatNumber(project.funds_utilized));
                    $('#view_funding_source').text(project.funding_source);
                    $('#view_project_lead').text(project.project_lead);

                    // Update progress bar color based on status
                    progressBar.removeClass('bg-success bg-info bg-warning bg-danger');
                    switch(project.status) {
                        case 'Completed':
                            progressBar.addClass('bg-success');
                            break;
                        case 'Ongoing':
                            progressBar.addClass('bg-info');
                            break;
                        case 'Delayed':
                            progressBar.addClass('bg-warning');
                            break;
                        case 'Cancelled':
                            progressBar.addClass('bg-danger');
                            break;
                        default:
                            progressBar.addClass('bg-primary');
                    }

                    modal.show();
                } else {
                    throw new Error('Failed to load project data');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
                alert('Failed to load project details. Please try again.');
            }
        });
    });

    // Edit Project
    $(document).on('click', '.edit-project', function() {
        const projectId = $(this).data('id');
        const modal = new bootstrap.Modal(document.getElementById('editProjectModal'));

        $.ajax({
            url: `/barangayprojects/${projectId}/edit`,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const project = response.data;

                    // Populate form fields
                    $('#edit_project_name').val(project.project_name);
                    $('#edit_purok').val(project.purok);
                    $('#edit_category').val(project.category);
                    $('#edit_description').val(project.description);
                    $('#edit_start_date').val(project.start_date.split(' ')[0]);
                    $('#edit_target_completion_date').val(project.target_completion_date.split(' ')[0]);
                    $('#edit_status').val(project.status);
                    $('#edit_completion_percentage').val(project.completion_percentage);
                    $('#edit_total_budget').val(project.total_budget);
                    $('#edit_funds_utilized').val(project.funds_utilized);
                    $('#edit_funding_source').val(project.funding_source);
                    $('#edit_project_lead').val(project.project_lead);

                    // Update form action URL
                    $('#editProjectForm').attr('action', `/barangayprojects/${projectId}`);

                    modal.show();
                } else {
                    throw new Error('Failed to load project data');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
                alert('Failed to load project details for editing. Please try again.');
            }
        });
    });

    // Handle Edit Form Submission
    $('#editProjectForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        // Add method spoofing for PUT request
        const formData = form.serialize() + '&_method=PUT';

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#editProjectModal').modal('hide');
                    alert('Project updated successfully!');
                    location.reload(); // Refresh the page to see changes
                } else {
                    alert('Update failed: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON?.errors;
                if (errors) {
                    let errorMessages = [];
                    $.each(errors, function(key, value) {
                        errorMessages.push(value[0]);
                    });
                    alert('Validation errors:\n' + errorMessages.join('\n'));
                } else {
                    alert('Error: ' + (xhr.responseJSON?.message || 'Failed to update project'));
                }
            }
        });
    });

    // Delete Project
    $(document).on('click', '.delete-project', function() {
        const projectId = $(this).data('id');
        const modal = new bootstrap.Modal(document.getElementById('deleteProjectModal'));

        $('#deleteProjectForm').attr('action', `/barangayprojects/${projectId}`);
        modal.show();
    });

    // Handle Delete Form Submission
    $('#deleteProjectForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action');

        // Add method spoofing for DELETE request
        const formData = form.serialize() + '&_method=DELETE';

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#deleteProjectModal').modal('hide');
                    alert('Project deleted successfully!');
                    location.reload(); // Refresh the page to see changes
                } else {
                    alert('Delete failed: ' + (response.message || 'Unknown error'));
                }
            },
            error: function(xhr) {
                alert('Error: ' + (xhr.responseJSON?.message || 'Failed to delete project'));
            }
        });
    });

    // Helper function to format dates
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }

    // Helper function to format numbers
    function formatNumber(number) {
        if (!number) return '0.00';
        return parseFloat(number).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    // Status change event for edit form
    $('#edit_status').change(function() {
        if ($(this).val() === 'Completed') {
            $('#edit_completion_percentage').val(100);
        } else if ($(this).val() === 'Planned') {
            $('#edit_completion_percentage').val(0);
        }
    });
});
</script>

@endsection
