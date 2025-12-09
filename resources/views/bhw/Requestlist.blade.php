@extends('bhw.dashboard')
@section('content')
    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<style>
/* ============================================
   PROFESSIONAL DESIGN SYSTEM
============================================ */
:root {
    /* Color Palette - Using your provided colors */
    --primary-color: #2c3e50;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --success-color: #2ecc71;
    --warning-color: #f39c12;
    --light-color: #ecf0f1;
    --dark-color: #2c3e50;
    --card-bg: #ffffff;
    --border-radius: 16px;
    --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);

    /* Additional colors */
    --gray-100: #f8f9fa;
    --gray-200: #e9ecef;
    --gray-300: #dee2e6;
    --gray-600: #6c757d;
    --gray-800: #343a40;

    /* Theme */
    --header-bg: linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%);
    --body-bg: #f5f7fb;

    /* Spacing */
    --spacing-xs: 0.25rem;
    --spacing-sm: 0.5rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --spacing-xl: 2rem;
}

/* ============================================
   BASE STYLES & RESET
============================================ */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: var(--body-bg);
    color: var(--gray-800);
    font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
    line-height: 1.6;
    font-size: 14px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* ============================================
   LAYOUT & CONTAINER
============================================ */
.container-fluid {
    padding: var(--spacing-xl);
    max-width: 100%;
    min-height: 100vh;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--spacing-xl);
    padding-bottom: var(--spacing-md);
    border-bottom: 1px solid var(--gray-200);
}

.page-header h1 {
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.75rem;
    margin: 0;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ============================================
   PROFESSIONAL FILTER SYSTEM
============================================ */
.filter-system {
    display: flex;
    gap: var(--spacing-md);
    padding: var(--spacing-lg);
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: var(--spacing-xl);
    border: 1px solid rgba(44, 62, 80, 0.1);
    align-items: flex-end;
}

.filter-group {
    flex: 1;
    min-width: 180px;
}

.filter-label {
    display: block;
    margin-bottom: var(--spacing-sm);
    font-weight: 600;
    color: var(--primary-color);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-select {
    width: 100%;
    padding: 10px 16px;
    border: 2px solid rgba(52, 152, 219, 0.2);
    border-radius: 8px;
    background: var(--card-bg);
    color: var(--primary-color);
    font-size: 14px;
    font-weight: 500;
    transition: var(--transition);
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%232c3e50' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
}

.filter-select:focus {
    outline: none;
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.filter-select option {
    padding: 8px;
    background: var(--card-bg);
    color: var(--primary-color);
}

/* Search Box */
.search-box {
    flex: 2;
    min-width: 300px;
    position: relative;
}

.search-box input {
    width: 100%;
    padding: 10px 16px 10px 44px;
    border: 2px solid rgba(52, 152, 219, 0.2);
    border-radius: 8px;
    background: var(--card-bg);
    color: var(--primary-color);
    font-size: 14px;
    transition: var(--transition);
}

.search-box input:focus {
    outline: none;
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
}

.search-box i {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--secondary-color);
    font-size: 14px;
}

/* Refresh Button */
.refresh-btn {
    padding: 10px 24px;
    background: linear-gradient(135deg, var(--secondary-color) 0%, #2980b9 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}

.refresh-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(52, 152, 219, 0.3);
}

.refresh-btn:active {
    transform: translateY(0);
}

.refresh-btn i {
    font-size: 14px;
}

/* Active Filters Display */
.active-filters {
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-sm);
    margin-top: var(--spacing-md);
    padding-top: var(--spacing-md);
    border-top: 1px solid var(--gray-200);
}

.filter-tag {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    background: rgba(52, 152, 219, 0.1);
    border: 1px solid rgba(52, 152, 219, 0.2);
    border-radius: 20px;
    font-size: 12px;
    font-weight: 500;
    color: var(--secondary-color);
    gap: 6px;
}

.filter-tag .remove {
    color: var(--accent-color);
    cursor: pointer;
    font-size: 14px;
    line-height: 1;
}

.filter-tag .remove:hover {
    color: #c0392b;
}

/* ============================================
   STATS SUMMARY
============================================ */
.stats-summary {
    display: flex;
    gap: var(--spacing-md);
    margin-bottom: var(--spacing-xl);
}

.stat-card {
    flex: 1;
    background: var(--card-bg);
    padding: var(--spacing-md);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    border-left: 4px solid var(--secondary-color);
    transition: var(--transition);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
}

.stat-card.total {
    border-left-color: var(--primary-color);
}

.stat-card.scheduled {
    border-left-color: var(--success-color);
}

.stat-card.pending {
    border-left-color: var(--warning-color);
}

.stat-card.weekly {
    border-left-color: var(--secondary-color);
}

.stat-card h3 {
    font-size: 0.875rem;
    color: var(--gray-600);
    margin-bottom: var(--spacing-xs);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-card .count {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark-color);
}

/* ============================================
   ADVANCED TABLE STYLES
============================================ */
.table-container {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    overflow: hidden;
    position: relative;
}

.table-header {
    padding: var(--spacing-lg);
    background: linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-header h2 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
}

.table-responsive {
    overflow-x: auto;
    max-height: 600px;
}

.table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 0;
}

.table thead {
    position: sticky;
    top: 0;
    z-index: 10;
}

.table thead th {
    background: linear-gradient(135deg, var(--primary-color) 0%, #2c3e50 100%);
    color: white;
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 16px 13px;
    border: none;
    white-space: nowrap;
    /* position: relative; */
}

.table thead th::after {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    height: 60%;
    width: 1px;
    background: rgba(255,255,255,0.2);
}

.table thead th:last-child::after {
    display: none;
}

.table tbody tr {
    border-bottom: 1px solid var(--gray-200);
    transition: var(--transition);
    background: var(--card-bg);
}

.table tbody tr:hover {
    background: linear-gradient(90deg, rgba(52, 152, 219, 0.04) 0%, rgba(52, 152, 219, 0.08) 100%);
    transform: scale(1.002);
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.table tbody td {
    padding: 16px 12px;
    border: none;
    color: var(--gray-800);
    font-size: 0.875rem;
    vertical-align: middle;
}

/* ============================================
   ENHANCED STATUS BADGES
============================================ */
.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    gap: 6px;
}

.status-badge::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
}

.status-badge.scheduled {
    background: rgba(46, 204, 113, 0.1);
    color: var(--success-color);
    border: 1px solid rgba(46, 204, 113, 0.2);
}

.status-badge.scheduled::before {
    background: var(--success-color);
}

.status-badge.pending {
    background: rgba(243, 156, 18, 0.1);
    color: #856404;
    border: 1px solid rgba(243, 156, 18, 0.2);
}

.status-badge.pending::before {
    background: var(--warning-color);
}

.status-badge.urgent {
    background: rgba(231, 76, 60, 0.1);
    color: var(--accent-color);
    border: 1px solid rgba(231, 76, 60, 0.2);
}

.status-badge.urgent::before {
    background: var(--accent-color);
}

/* Service Tags */
.service-tag {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(52, 152, 219, 0.1);
    color: var(--secondary-color);
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid rgba(52, 152, 219, 0.2);
}

/* ============================================
   ACTION BUTTONS
============================================ */
.action-cell {
    min-width: 140px;
}

.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
    align-items: center;
}

.action-btn {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.action-btn i {
    font-size: 14px;
    position: relative;
    z-index: 1;
}

.btn-edit {
    background: linear-gradient(135deg, var(--secondary-color) 0%, #2980b9 100%);
    color: white;
}

.btn-edit:hover {
    background: linear-gradient(135deg, #2980b9 0%, #1f6390 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
}

.btn-delete {
    background: linear-gradient(135deg, var(--accent-color) 0%, #c0392b 100%);
    color: white;
}

.btn-delete:hover {
    background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
}

/* ============================================
   EMPTY STATE
============================================ */
.empty-state {
    padding: var(--spacing-xl);
    text-align: center;
    color: var(--gray-600);
}

.empty-state i {
    font-size: 48px;
    color: var(--gray-300);
    margin-bottom: var(--spacing-md);
}

.empty-state h3 {
    font-size: 1.25rem;
    margin-bottom: var(--spacing-sm);
    color: var(--primary-color);
}

.empty-state p {
    font-size: 0.875rem;
    margin-bottom: var(--spacing-lg);
}

/* ============================================
   RESPONSIVE DESIGN
============================================ */
@media (max-width: 1200px) {
    .container-fluid {
        padding: var(--spacing-lg);
    }

    .stats-summary {
        flex-wrap: wrap;
    }

    .stat-card {
        min-width: calc(50% - var(--spacing-md));
    }
}

@media (max-width: 992px) {
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--spacing-md);
    }

    .filter-system {
        flex-wrap: wrap;
    }

    .filter-group, .search-box {
        min-width: calc(50% - var(--spacing-md));
    }

    .refresh-btn {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: var(--spacing-md);
    }

    .stat-card {
        min-width: 100%;
    }

    .filter-system {
        padding: var(--spacing-md);
    }

    .filter-group, .search-box {
        min-width: 100%;
    }

    /* Hide less important columns on mobile */
    .table thead th:nth-child(2), /* DOB */
    .table tbody td:nth-child(2),
    .table thead th:nth-child(3), /* Age */
    .table tbody td:nth-child(3),
    .table thead th:nth-child(7), /* Contact */
    .table tbody td:nth-child(7),
    .table thead th:nth-child(11), /* Philhealth */
    .table tbody td:nth-child(11) {
        display: none;
    }
}

@media (max-width: 576px) {
    body {
        font-size: 13px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }

    .action-btn {
        width: 32px;
        height: 32px;
    }
}

/* ============================================
   ANIMATIONS
============================================ */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table tbody tr {
    animation: fadeIn 0.3s ease-out;
    animation-fill-mode: both;
}

.table tbody tr:nth-child(1) { animation-delay: 0.1s; }
.table tbody tr:nth-child(2) { animation-delay: 0.2s; }
.table tbody tr:nth-child(3) { animation-delay: 0.3s; }
.table tbody tr:nth-child(4) { animation-delay: 0.4s; }
.table tbody tr:nth-child(5) { animation-delay: 0.5s; }

/* ============================================
   SCROLLBAR STYLING
============================================ */
.table-responsive::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: var(--gray-100);
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: var(--gray-400);
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: var(--gray-500);
}
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>BHW Requests </h1>
        <div class="table-actions">
            <button class="refresh-btn" onclick="refreshData()">
                <i class="fas fa-sync-alt"></i> Refresh Data
            </button>
        </div>
    </div>



    <!-- Active Filters Display -->
    <div id="activeFilters" class="active-filters" style="display: none;">
        <!-- Active filters will appear here -->
    </div>

    <!-- Stats Summary -->
    <div class="stats-summary">
        <div class="stat-card total">
            <h3>Total Requests</h3>
            <div class="count" id="totalCount">{{ isset($requests) ? $requests->count() : 0 }}</div>
        </div>
        <div class="stat-card scheduled">
            <h3>Scheduled</h3>
            <div class="count" id="scheduledCount">0</div>
        </div>
        <div class="stat-card pending">
            <h3>Pending</h3>
            <div class="count" id="pendingCount">0</div>
        </div>
        <div class="stat-card weekly">
            <h3>This Week</h3>
            <div class="count" id="weeklyCount">0</div>
        </div>
    </div>
    <!-- Professional Filter System -->
    <div class="filter-system">
        <div class="filter-group">
            <label class="filter-label">Status</label>
            <select id="statusFilter" class="filter-select">
                <option value="">All Status</option>
                <option value="scheduled">Scheduled</option>
                <option value="pending">Pending</option>
                <!-- <option value="urgent">Urgent</option> -->
            </select>
        </div>

        <div class="filter-group">
            <label class="filter-label">Service Type</label>
            <select id="serviceFilter" class="filter-select">
                <option value="">All Services</option>
                @if(isset($requests))
                    @foreach($requests->pluck('service_type')->unique()->filter() as $service)
                        <option value="{{ $service }}">{{ $service }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="search-box">
            <label class="filter-label">Search Requests</label>
            <input type="text" id="searchInput" placeholder="Search by name, complaint, or contact...">
                <!-- <i class="fas fa-search"></i> -->
        </div>
    </div>
    <!-- Table Container -->
    <div class="table-container">
        <div class="table-header">
            <h2>Patient Requests</h2>

            <div class="filter-info">
                <span id="filteredCount">{{ isset($requests) ? $requests->count() : 0 }}</span> of
                <span id="totalItems">{{ isset($requests) ? $requests->count() : 0 }}</span> requests
            </div>

        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>DOB</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Service</th>
                        <th>Contact</th>
                        <th>Complaint</th>
                        <th>Status</th>
                        <th>Schedule</th>
                        <th>Philhealth</th>
                        <th class="action-cell">Actions</th>
                    </tr>
                </thead>
                <tbody id="requestsTable">
                    @if(isset($requests) && !$requests->isEmpty())
                        @foreach($requests as $request)
                            <tr data-status="{{ $request->sched_date ? 'scheduled' : ($request->status == 'urgent' ? 'urgent' : 'pending') }}"
                                data-service="{{ $request->service_type }}"
                                data-search="{{ strtolower($request->fname . ' ' . $request->lname . ' ' . $request->contact_no . ' ' . $request->chief_complaint) }}">
                                <td>
                                    <div class="patient-info">
                                        <strong>{{ $request->fname }} {{ $request->lname }}</strong>
                                        <div class="text-muted" style="font-size: 0.75rem;">{{ $request->mname }}</div>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($request->dob)->format('M d, Y') }}</td>
                                <td>{{ $request->age }}</td>
                                <td>
                                    <span class="gender-badge">{{ $request->gender }}</span>
                                </td>
                                <td>
                                    <div class="address-truncate" title="{{ $request->purok_no }}, {{ $request->sitio }}">
                                        {{ Str::limit($request->purok_no . ', ' . $request->sitio, 20) }}
                                    </div>
                                </td>
                                <td>
                                    <span class="service-tag">{{ $request->service_type }}</span>
                                </td>
                                <td>{{ $request->contact_no }}</td>
                                <td>
                                    <div class="complaint-truncate" title="{{ $request->chief_complaint }}">
                                        {{ Str::limit($request->chief_complaint, 25) }}
                                    </div>
                                </td>
                                <td>
                                    @if($request->sched_date)
                                        <span class="status-badge scheduled">Scheduled</span>
                                    @elseif($request->status == 'urgent')
                                        <span class="status-badge urgent">Urgent</span>
                                    @else
                                        <span class="status-badge pending">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($request->sched_date)
                                        <div class="scheduled-date">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ \Carbon\Carbon::parse($request->sched_date)->format('M d, Y') }}
                                        </div>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>{{ $request->phil_no ?: 'N/A' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button"
                                                class="action-btn btn-edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $request->id }}"
                                                title="Edit Schedule">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('bhw.request.destroy', $request->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirmAction('delete')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="action-btn btn-delete"
                                                    title="Delete Request">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr id="emptyStateRow">
                            <td colspan="12">
                                <div class="empty-state">
                                    <i class="fas fa-clipboard-list"></i>
                                    <h3>No Requests Found</h3>
                                    <p>There are currently no patient requests in the system.</p>
                                    <button class="refresh-btn" onclick="refreshData()">
                                        <i class="fas fa-sync-alt"></i> Refresh
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals -->
@if(isset($requests) && !$requests->isEmpty())
    @foreach($requests as $request)
        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $request->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Schedule Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="patient-summary mb-4 p-3 bg-light rounded">
                            <h6>Patient Information</h6>
                            <p class="mb-1"><strong>Name:</strong> {{ $request->fname }} {{ $request->lname }}</p>
                            <p class="mb-1"><strong>Service:</strong> {{ $request->service_type }}</p>
                            <p class="mb-0"><strong>Complaint:</strong> {{ $request->chief_complaint }}</p>
                        </div>

                        <form action="{{ route('bhw.request.update', $request->id) }}" method="POST" id="scheduleForm{{ $request->id }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="form-label">Schedule Date</label>
                                <input type="date"
                                       name="sched_date"
                                       class="form-control"
                                       value="{{ $request->sched_date }}"
                                       min="{{ date('Y-m-d') }}"
                                       required>
                                <small class="text-muted">Select a future date for the appointment</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Notes (Optional)</label>
                                <textarea name="notes"
                                          class="form-control"
                                          rows="3"
                                          placeholder="Add any additional notes or instructions...">{{ $request->notes ?? '' }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-calendar-check me-2"></i> Set Schedule
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<!-- ============================================
     ADVANCED JAVASCRIPT FUNCTIONALITY
============================================ -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize counts and filters
    updateStatistics();
    initializeFilters();

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if(searchInput) {
        searchInput.addEventListener('input', debounce(function(e) {
            const searchTerm = e.target.value.toLowerCase();
            updateActiveFilters('search', searchTerm);
            applyFilters();
        }, 300));
    }

    // Filter change functionality
    const statusFilter = document.getElementById('statusFilter');
    const serviceFilter = document.getElementById('serviceFilter');

    if(statusFilter) {
        statusFilter.addEventListener('change', function() {
            updateActiveFilters('status', this.value);
            applyFilters();
        });
    }

    if(serviceFilter) {
        serviceFilter.addEventListener('change', function() {
            updateActiveFilters('service', this.value);
            applyFilters();
        });
    }

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Update statistics
function updateStatistics() {
    const scheduledCount = document.querySelectorAll('.status-badge.scheduled').length;
    const pendingCount = document.querySelectorAll('.status-badge.pending').length;
    const urgentCount = document.querySelectorAll('.status-badge.urgent').length;
    const totalRows = document.querySelectorAll('#requestsTable tr[data-status]').length;

    // Calculate this week's requests (simulated)
    const weeklyCount = Math.floor(totalRows * 0.3); // 30% of total for demo

    document.getElementById('scheduledCount').textContent = scheduledCount;
    document.getElementById('pendingCount').textContent = pendingCount;
    document.getElementById('weeklyCount').textContent = weeklyCount;
    document.getElementById('totalCount').textContent = totalRows;
}

// Initialize filters
function initializeFilters() {
    // Store original rows for filtering
    const rows = document.querySelectorAll('#requestsTable tr[data-status]');
    window.originalRows = Array.from(rows).map(row => ({
        element: row,
        status: row.getAttribute('data-status'),
        service: row.getAttribute('data-service'),
        search: row.getAttribute('data-search')
    }));

    // Update filtered count
    updateFilteredCount(rows.length);
}

// Apply combined filters
function applyFilters() {
    const statusFilter = document.getElementById('statusFilter')?.value || '';
    const serviceFilter = document.getElementById('serviceFilter')?.value || '';
    const searchTerm = document.getElementById('searchInput')?.value.toLowerCase() || '';

    let visibleCount = 0;

    window.originalRows.forEach(rowData => {
        const row = rowData.element;
        const matchesStatus = !statusFilter || rowData.status === statusFilter;
        const matchesService = !serviceFilter || rowData.service?.toLowerCase().includes(serviceFilter.toLowerCase());
        const matchesSearch = !searchTerm || rowData.search?.includes(searchTerm);

        if(matchesStatus && matchesService && matchesSearch) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    updateFilteredCount(visibleCount);
    updateEmptyState(visibleCount);
}

// Update filtered count display
function updateFilteredCount(count) {
    const totalItems = window.originalRows?.length || 0;
    document.getElementById('filteredCount').textContent = count;
    document.getElementById('totalItems').textContent = totalItems;

    // Update header color based on filtered results
    const header = document.querySelector('.table-header');
    if(count < totalItems) {
        header.style.background = 'linear-gradient(135deg, var(--warning-color) 0%, #e67e22 100%)';
    } else {
        header.style.background = 'linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%)';
    }
}

// Update active filters display
function updateActiveFilters(type, value) {
    const activeFiltersContainer = document.getElementById('activeFilters');

    if(type === 'search' && value) {
        let searchFilter = activeFiltersContainer.querySelector('.filter-tag[data-type="search"]');
        if(!searchFilter) {
            searchFilter = document.createElement('span');
            searchFilter.className = 'filter-tag';
            searchFilter.setAttribute('data-type', 'search');
            searchFilter.innerHTML = `
                Search: "${value}"
                <span class="remove" onclick="clearFilter('search')">&times;</span>
            `;
            activeFiltersContainer.appendChild(searchFilter);
        } else {
            searchFilter.innerHTML = `
                Search: "${value}"
                <span class="remove" onclick="clearFilter('search')">&times;</span>
            `;
        }
    } else if(type === 'status' && value) {
        let statusFilter = activeFiltersContainer.querySelector('.filter-tag[data-type="status"]');
        if(!statusFilter) {
            statusFilter = document.createElement('span');
            statusFilter.className = 'filter-tag';
            statusFilter.setAttribute('data-type', 'status');
            statusFilter.innerHTML = `
                Status: ${value.charAt(0).toUpperCase() + value.slice(1)}
                <span class="remove" onclick="clearFilter('status')">&times;</span>
            `;
            activeFiltersContainer.appendChild(statusFilter);
        } else {
            statusFilter.innerHTML = `
                Status: ${value.charAt(0).toUpperCase() + value.slice(1)}
                <span class="remove" onclick="clearFilter('status')">&times;</span>
            `;
        }
    } else if(type === 'service' && value) {
        let serviceFilter = activeFiltersContainer.querySelector('.filter-tag[data-type="service"]');
        if(!serviceFilter) {
            serviceFilter = document.createElement('span');
            serviceFilter.className = 'filter-tag';
            serviceFilter.setAttribute('data-type', 'service');
            serviceFilter.innerHTML = `
                Service: ${value}
                <span class="remove" onclick="clearFilter('service')">&times;</span>
            `;
            activeFiltersContainer.appendChild(serviceFilter);
        } else {
            serviceFilter.innerHTML = `
                Service: ${value}
                <span class="remove" onclick="clearFilter('service')">&times;</span>
            `;
        }
    }

    // Show/hide active filters container
    const hasActiveFilters = activeFiltersContainer.children.length > 0;
    activeFiltersContainer.style.display = hasActiveFilters ? 'flex' : 'none';
}

// Clear specific filter
function clearFilter(type) {
    switch(type) {
        case 'status':
            document.getElementById('statusFilter').value = '';
            break;
        case 'service':
            document.getElementById('serviceFilter').value = '';
            break;
        case 'search':
            document.getElementById('searchInput').value = '';
            break;
    }

    // Remove filter tag
    const filterTag = document.querySelector(`.filter-tag[data-type="${type}"]`);
    if(filterTag) {
        filterTag.remove();
    }

    // Update filters
    updateActiveFilters(type, '');
    applyFilters();
}

// Clear all filters
function clearAllFilters() {
    document.getElementById('statusFilter').value = '';
    document.getElementById('serviceFilter').value = '';
    document.getElementById('searchInput').value = '';

    document.getElementById('activeFilters').innerHTML = '';
    document.getElementById('activeFilters').style.display = 'none';

    applyFilters();
}

// Update empty state message
function updateEmptyState(visibleCount) {
    const emptyStateRow = document.getElementById('emptyStateRow');
    if(!emptyStateRow && visibleCount === 0 && window.originalRows?.length > 0) {
        // Create empty state row
        const tbody = document.querySelector('#requestsTable');
        const row = document.createElement('tr');
        row.id = 'emptyStateRow';
        row.innerHTML = `
            <td colspan="12">
                <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <h3>No Matching Requests</h3>
                    <p>No requests match your current filter criteria.</p>
                    <button class="refresh-btn" onclick="clearAllFilters()">
                        <i class="fas fa-times"></i> Clear Filters
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    } else if(emptyStateRow && visibleCount > 0) {
        emptyStateRow.remove();
    }
}

// Refresh data function
function refreshData() {
    const refreshBtn = document.querySelector('.refresh-btn');
    const originalHTML = refreshBtn.innerHTML;

    refreshBtn.disabled = true;
    refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';

    // Clear filters
    clearAllFilters();

    // Simulate API call
    setTimeout(() => {
        // In real application, this would be an AJAX call
        // For now, we'll just reset the view

        // Update statistics
        updateStatistics();

        // Reset button
        refreshBtn.disabled = false;
        refreshBtn.innerHTML = originalHTML;

        // Show success message
        showNotification('Data refreshed successfully!', 'success');
    }, 1500);
}

// Show notification
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());

    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        </div>
    `;

    // Add styles
    const styles = document.createElement('style');
    styles.textContent = `
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            background: var(--card-bg);
            border-radius: 8px;
            box-shadow: var(--box-shadow);
            z-index: 9999;
            transform: translateX(120%);
            transition: transform 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }

        .notification-success {
            border-left-color: var(--success-color);
        }

        .notification-error {
            border-left-color: var(--accent-color);
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification-content {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .notification-content i {
            font-size: 16px;
        }
    `;

    if(!document.querySelector('#notification-styles')) {
        styles.id = 'notification-styles';
        document.head.appendChild(styles);
    }

    document.body.appendChild(notification);

    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);

    // Hide after delay
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Debounce function for search
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Confirm action
function confirmAction(action) {
    const messages = {
        'delete': 'Are you sure you want to delete this request? This action cannot be undone.',
        'schedule': 'Are you sure you want to schedule this appointment?',
        'cancel': 'Are you sure you want to cancel this appointment?'
    };

    return confirm(messages[action] || 'Are you sure?');
}
</script>
@endsection
