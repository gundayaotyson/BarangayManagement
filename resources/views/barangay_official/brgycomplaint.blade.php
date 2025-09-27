@extends('barangay_official.dashboard')

@section('content')
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --success-color: #27ae60;
        --danger-color: #e74c3c;
        --warning-color: #f39c12;
        --info-color: #1abc9c;
        --light-color: #f8f9fa;
        --dark-color: #343a40;
        --border-radius: 8px;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    /* Dashboard Header */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background:white;
        border-radius: var(--border-radius);
        color: var(--primary-color);

    }

    .dashboard-header h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 600;
    }

    .header-actions {
        display: flex;
        gap: 1rem;
    }

    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--box-shadow);
        transition: var(--transition);
        border-left: 4px solid var(--primary-color);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card.active {
        border-left-color: var(--danger-color);
    }

    .stat-card.settled {
        border-left-color: var(--success-color);
    }

    .stat-card.scheduled {
        border-left-color: var(--warning-color);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0.5rem 0;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Card Styling */
    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .card-header {
        background-color: white;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h2 {
        margin-right: 300px;
        font-size: 30px;
        /* font-weight: 600; */
        color: var(--primary-color);
    }

    /* Buttons */
    .btn {
        border-radius: var(--border-radius);
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
    }

    .btn-success {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-success:hover {
        background-color: var(--primary-color);
        transform: translateY(-2px);

    }

    .btn-primary {
        background-color: var(--secondary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }

    .btn-info {
        background-color: var(--info-color);
        color: white;
    }

    .btn-info:hover {
        background-color: #16a085;
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
    }

    /* Table Styling */
    .table-responsive {
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        vertical-align: middle;
        text-align: center;
        border: none;
    }

    .table tbody tr {
        transition: var(--transition);
    }

    .table tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.05);
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        text-align: center;
        border-top: 1px solid #f0f0f0;
    }

    /* Status Badges */
    .status-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.5rem 0.75rem;
        border-radius: 50px;
        text-transform: uppercase;
        display: inline-block;
    }

    .status-active {
        background-color: rgba(231, 76, 60, 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(231, 76, 60, 0.3);
    }

    .status-settled {
        background-color: rgba(39, 174, 96, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(39, 174, 96, 0.3);
    }

    .status-scheduled {
        background-color: rgba(243, 156, 18, 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(243, 156, 18, 0.3);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    /* Alert Styling */
    .alert {
        border-radius: var(--border-radius);
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        border: none;
        display: flex;
        align-items: center;
    }

    .alert-success {
        background-color: rgba(39, 174, 96, 0.1);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
    }

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1a2530 100%);
        color: white;
        border-radius: var(--border-radius) var(--border-radius) 0 0;
        padding: 1.25rem 1.5rem;
    }

    .modal-title {
        font-weight: 600;
        font-size: 1.3rem;
    }

    .btn-close {
        filter: invert(1);
    }

    /* Form Styling */
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--primary-color);
    }

    .form-control, .form-select, .form-textarea {
        border-radius: var(--border-radius);
        padding: 0.75rem 1rem;
        border: 1px solid #e0e0e0;
        transition: var(--transition);
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus, .form-textarea:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.15);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    /* Search and Filter */
    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* margin-bottom: 1.5rem; */
        padding: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .search-box {
        position:absolute;
        margin-right: 100px;
        flex-grow: 1;
        max-width: 300px;
    }

    .search-box input {
        padding-left: 2.5rem;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    .filter-select {
        min-width: 150px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .header-actions {
            width: 100%;
            justify-content: center;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }

        .table-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: 100%;
        }

        .card-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-sm {
            width: 100%;
            justify-content: center;
        }

        .table thead {
            display: none;
        }

        .table, .table tbody, .table tr, .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 1rem;
        }

        .table td {
            text-align: right;
            padding-left: 50%;
            position: relative;
            border-bottom: 1px solid #f0f0f0;
            padding: 0.75rem 1rem;
        }

        .table td::before {
            content: attr(data-label);
            position: absolute;
            left: 1rem;
            width: 45%;
            padding-right: 1rem;
            font-weight: 600;
            text-align: left;
        }
    }
</style>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Dashboard Header -->
<div class="dashboard-header">
    <div>
        <h1>Barangay Complaints Management</h1>
        <p class="mb-0">Manage and track all barangay complaints efficiently</p>
    </div>
    <div class="header-actions">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addComplaintModal">
            <i class="fas fa-plus me-1"></i> Register New Complaint
        </button>
    </div>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stat-card active">
        <div class="stat-label">Active Cases</div>
        <div class="stat-value">{{ $complaints->where('status', 'Active Case')->count() }}</div>
        <div class="stat-trend">
            <i class="fas fa-exclamation-circle me-1"></i> Requires immediate attention
        </div>
    </div>
    <div class="stat-card settled">
        <div class="stat-label">Settled Cases</div>
        <div class="stat-value">{{ $complaints->where('status', 'Settled Case')->count() }}</div>
        <div class="stat-trend">
            <i class="fas fa-check-circle me-1"></i> Successfully resolved
        </div>
    </div>
    <div class="stat-card scheduled">
        <div class="stat-label">Scheduled Cases</div>
        <div class="stat-value">{{ $complaints->where('status', 'Scheduled Case')->count() }}</div>
        <div class="stat-trend">
            <i class="fas fa-calendar-alt me-1"></i> Awaiting hearing
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Complaints</div>
        <div class="stat-value">{{ $complaints->count() }}</div>
        <div class="stat-trend">
            <i class="fas fa-chart-line me-1"></i> All recorded cases
        </div>
    </div>
</div>

<!-- Complaints Table Card -->
<div class="card">
    <div class="card-header">
        <h2 class="mb-0">Complaints Record</h2>
            <div class="table-controls">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="form-control" placeholder="Search complaints..." id="searchInput">
                </div>

            </div>
        <div class="table-controls">
            <select class="form-select filter-select" id="statusFilter">
                <option value="">All Statuses</option>
                <option value="Active Case">Active</option>
                <option value="Scheduled Case">Scheduled</option>
                <option value="Settled Case">Settled</option>
            </select>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover" id="complaintsTable">
                <thead>
                    <tr>
                        <th>Complainant</th>
                        <th>Complaint Type</th>
                        <th>Respondent</th>
                        <th>Victim</th>
                        <th>Date</th>
                        <th>Settled</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $complaint)
                        <tr>
                            <td data-label="Complainant">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-placeholder me-2">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $complaint->fullname }}</div>
                                        <small class="text-muted">{{ Str::limit($complaint->location, 15) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Complaint Type">{{ Str::limit($complaint->complaint, 25) }}</td>
                            <td data-label="Respondent">{{ $complaint->respondent }}</td>
                            <td data-label="Victim">{{ $complaint->victim ?: 'N/A' }}</td>
                            <td data-label="Date">{{ date('M d, Y', strtotime($complaint->date)) }}</td>
                            <td data-label="Settled">{{ $complaint->settled_date ? date('M d, Y', strtotime($complaint->settled_date)) : 'N/A' }}</td>
                            <td data-label="Status">
                                <span class="status-badge
                                    @if($complaint->status == 'Active Case') status-active
                                    @elseif($complaint->status == 'Settled Case') status-settled
                                    @else status-scheduled @endif">
                                    {{ $complaint->status }}
                                </span>
                            </td>
                            <td data-label="Actions">
                                <div class="action-buttons">
                                    <!-- View Details Button -->
                                    <button class="btn btn-info btn-sm viewComplaintBtn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewComplaintModal"
                                        data-complaint='{{ $complaint->toJson() }}'
                                        title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Edit Button -->
                                    <button class="btn btn-primary btn-sm editComplaintBtn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editComplaintModal"
                                        data-id="{{ $complaint->id }}"
                                        data-fullname="{{ $complaint->fullname }}"
                                        data-complaint="{{ $complaint->complaint }}"
                                        data-respondent="{{ $complaint->respondent }}"
                                        data-victim="{{ $complaint->victim }}"
                                        data-location="{{ $complaint->location }}"
                                        data-details="{{ $complaint->details }}"
                                        data-date="{{ $complaint->date }}"
                                        data-status="{{ $complaint->status }}"
                                        title="Edit Complaint">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('brgycomplaint.destroy', $complaint->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Complaint">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <h4>No complaints recorded</h4>
                                    <p>Start by registering a new complaint using the button above.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Complaint Modal -->
<div class="modal fade" id="addComplaintModal" tabindex="-1" aria-labelledby="addComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addComplaintModalLabel">Register New Complaint</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('brgycomplaint.store') }}" method="POST" id="addComplaintForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fullname" class="form-label">Complainant Full Name *</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date of Complaint *</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="respondent" class="form-label">Respondent Name *</label>
                            <input type="text" name="respondent" id="respondent" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="victim" class="form-label">Victim Name (if different)</label>
                            <input type="text" name="victim" id="victim" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="complaint" class="form-label">Complaint Type *</label>
                        <input type="text" name="complaint" id="complaint" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="location" class="form-label">Incident Location *</label>
                            <input type="text" name="location" id="location" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Case Status *</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active Case">Active</option>
                                <option value="Scheduled Case">Scheduled</option>
                                <option value="Settled Case">Settled</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="details" class="form-label">Case Details *</label>
                        <textarea name="details" id="details" class="form-control form-textarea" placeholder="Provide detailed information about the complaint..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Register Complaint
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Complaint Modal -->
<div class="modal fade" id="viewComplaintModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Complaint Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Complainant</h6>
                        <p id="view-fullname" class="fw-bold"></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Date Filed</h6>
                        <p id="view-date" class="fw-bold"></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Respondent</h6>
                        <p id="view-respondent" class="fw-bold"></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Victim</h6>
                        <p id="view-victim" class="fw-bold"></p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <h6 class="text-muted">Complaint Type</h6>
                        <p id="view-complaint" class="fw-bold"></p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-muted">Status</h6>
                        <p><span id="view-status" class="status-badge"></span></p>
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">Incident Location</h6>
                    <p id="view-location" class="fw-bold"></p>
                </div>

                <div id="view-settled-date-container" class="mb-3" style="display: none;">
                    <h6 class="text-muted">Settled Date</h6>
                    <p id="view-settled-date" class="fw-bold"></p>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">Case Details</h6>
                    <div id="view-details" class="p-3 bg-light rounded"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Complaint Modal -->
<div class="modal fade" id="editComplaintModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Complaint Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editComplaintForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-fullname" class="form-label">Complainant Full Name *</label>
                            <input type="text" name="fullname" id="edit-fullname" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-date" class="form-label">Date of Complaint *</label>
                            <input type="date" name="date" id="edit-date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-respondent" class="form-label">Respondent Name *</label>
                            <input type="text" name="respondent" id="edit-respondent" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-victim" class="form-label">Victim Name</label>
                            <input type="text" name="victim" id="edit-victim" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-complaint" class="form-label">Complaint Type *</label>
                        <input type="text" name="complaint" id="edit-complaint" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="edit-location" class="form-label">Incident Location *</label>
                            <input type="text" name="location" id="edit-location" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit-status" class="form-label">Case Status *</label>
                            <select name="status" id="edit-status" class="form-select" required>
                                <option value="Active Case">Active</option>
                                <option value="Scheduled Case">Scheduled</option>
                                <option value="Settled Case">Settled</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-details" class="form-label">Case Details *</label>
                        <textarea name="details" id="edit-details" class="form-control form-textarea" required></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set today's date as default for new complaints
        document.getElementById('date').valueAsDate = new Date();

        // View Complaint Modal
        document.querySelectorAll('.viewComplaintBtn').forEach(button => {
            button.addEventListener('click', function() {
                const complaint = JSON.parse(this.getAttribute('data-complaint'));

                document.getElementById('view-fullname').textContent = complaint.fullname;
                document.getElementById('view-date').textContent = new Date(complaint.date).toLocaleDateString('en-US', {
                    year: 'numeric', month: 'long', day: 'numeric'
                });
                document.getElementById('view-respondent').textContent = complaint.respondent;
                document.getElementById('view-victim').textContent = complaint.victim || 'N/A';
                document.getElementById('view-complaint').textContent = complaint.complaint;
                document.getElementById('view-location').textContent = complaint.location;
                document.getElementById('view-details').textContent = complaint.details;

                const statusBadge = document.getElementById('view-status');
                statusBadge.textContent = complaint.status;
                statusBadge.className = 'status-badge ';

                const settledDateContainer = document.getElementById('view-settled-date-container');
                const settledDate = document.getElementById('view-settled-date');

                if(complaint.status == 'Active Case') {
                    statusBadge.classList.add('status-active');
                    settledDateContainer.style.display = 'none';
                } else if(complaint.status == 'Settled Case') {
                    statusBadge.classList.add('status-settled');
                    if(complaint.settled_date) {
                        settledDate.textContent = new Date(complaint.settled_date).toLocaleDateString('en-US', {
                            year: 'numeric', month: 'long', day: 'numeric'
                        });
                    } else {
                        settledDate.textContent = 'Not specified';
                    }
                    settledDateContainer.style.display = 'block';
                } else {
                    statusBadge.classList.add('status-scheduled');
                    settledDateContainer.style.display = 'none';
                }
            });
        });

        // Edit Complaint Modal
        document.querySelectorAll('.editComplaintBtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const form = document.getElementById('editComplaintForm');

                form.setAttribute('action', `/brgycomplaint/${id}`);
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-fullname').value = this.getAttribute('data-fullname');
                document.getElementById('edit-complaint').value = this.getAttribute('data-complaint');
                document.getElementById('edit-respondent').value = this.getAttribute('data-respondent');
                document.getElementById('edit-victim').value = this.getAttribute('data-victim');
                document.getElementById('edit-location').value = this.getAttribute('data-location');
                document.getElementById('edit-details').value = this.getAttribute('data-details');
                document.getElementById('edit-date').value = this.getAttribute('data-date');
                document.getElementById('edit-status').value = this.getAttribute('data-status');
            });
        });

        // Delete Confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This complaint record will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const tableRows = document.querySelectorAll('#complaintsTable tbody tr');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value;

            tableRows.forEach(row => {
                const textContent = row.textContent.toLowerCase();
                const statusCell = row.querySelector('.status-badge').textContent;

                const matchesSearch = textContent.includes(searchTerm);
                const matchesStatus = statusValue === '' || statusCell === statusValue;

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('input', filterTable);
        statusFilter.addEventListener('change', filterTable);
    });
</script>
@endsection
