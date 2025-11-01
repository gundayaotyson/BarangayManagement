@extends('resident.resident-layout')

@section('content')
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
        --border-color: #ddd;
        --shadow-color: rgba(0, 0, 0, 0.1);
    }

    .requests-section {
        background: var(--light-color);
        border-radius: 1rem;
        padding: 2rem;
        margin-top: 3rem;
    }

    .requests-title {
        color: var(--dark-color);
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .requests-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
        border-radius: 3px;
    }

    .table-container {
        background: var(--light-color);
        overflow: hidden;
        box-shadow: 0 5px 20px var(--shadow-color);
    }

    .table thead th {
        background: var(--dark-color);
        color: var(--light-color);
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
        padding: 1rem;
    }

    .table tbody td {
        padding: 1rem;
        border-color: var(--border-color);
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: var(--light-color);
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending {
        background-color: var(--warning-color);
        color: var(--light-color);
    }

    .status-approved {
        background-color: var(--primary-color);
        color: var(--light-color);
    }

    .status-released {
        background-color: var(--success-color);
        color: var(--light-color);
    }

    .status-declined {
        background-color: var(--danger-color);
        color: var(--light-color);
    }

    .status-rejected {
        background-color: var(--danger-color);
        color: var(--light-color);
    }

    .status-ready {
        background-color: var(--primary-color);
        color: var(--light-color);
    }

    .status-processing {
        background-color: var(--warning-color);
        color: var(--light-color);
    }

    /* Mobile Responsive Styles */
    .mobile-request-card {
        background: white;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 10px var(--shadow-color);
        border-left: 4px solid var(--primary-color);
    }

    .mobile-request-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border-color);
    }

    .mobile-request-row:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .mobile-request-label {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.875rem;
        min-width: 120px;
    }

    .mobile-request-value {
        color: var(--text-color);
        font-size: 0.875rem;
        text-align: right;
        flex: 1;
    }

    .mobile-status-badge {
        padding: 0.35rem 0.7rem;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
    }

    .desktop-table {
        display: table;
    }

    .mobile-cards {
        display: none;
    }

    .no-requests-mobile {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
    }

    .no-requests-mobile i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* Responsive Breakpoints */
    @media (max-width: 768px) {
        .requests-section {
            padding: 1.25rem;
            margin-top: 2rem;
        }

        /* Hide desktop table on mobile */
        .desktop-table {
            display: none;
        }

        /* Show mobile cards on mobile */
        .mobile-cards {
            display: block;
        }

        .mobile-request-card:last-child {
            margin-bottom: 0;
        }

        .requests-title {
            font-size: 1.25rem;
            margin-bottom: 1.25rem;
        }
    }

    @media (max-width: 576px) {
        .requests-section {
            padding: 1rem;
            border-radius: 0.75rem;
        }

        .mobile-request-card {
            padding: 1rem;
        }

        .mobile-request-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .mobile-request-label {
            min-width: auto;
            margin-bottom: 0.25rem;
        }

        .mobile-request-value {
            text-align: left;
            width: 100%;
        }
    }

    @media (max-width: 400px) {
        .mobile-request-card {
            padding: 0.875rem;
        }

        .mobile-request-label {
            font-size: 0.8rem;
        }

        .mobile-request-value {
            font-size: 0.8rem;
        }

        .mobile-status-badge {
            font-size: 0.65rem;
            padding: 0.3rem 0.6rem;
        }
    }
</style>

<!-- Certificate Requests Section -->
<div class="requests-section">
    <h3 class="requests-title">My Certificate Requests</h3>
    <div class="table-container">

        <!-- Desktop Table View -->
        <div class="desktop-table">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Tracking Code</th>
                            <th>Purpose</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <th>Pickup Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $request)
                            <tr>
                                <td>{{ $request->tracking_code }}</td>
                                <td>{{ $request->purpose }}</td>
                                <td>{{ $request->requested_date }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($request->status) }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                                <td>{{ $request->pickup_date }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                    No requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-cards">
            @forelse ($requests as $request)
                <div class="mobile-request-card">
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Tracking Code:</span>
                        <span class="mobile-request-value">{{ $request->tracking_code }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Purpose:</span>
                        <span class="mobile-request-value">{{ $request->purpose }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Requested Date:</span>
                        <span class="mobile-request-value">{{ $request->requested_date }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Status:</span>
                        <span class="mobile-request-value">
                            <span class="mobile-status-badge status-{{ strtolower($request->status) }}">
                                {{ $request->status }}
                            </span>
                        </span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Pickup Date:</span>
                        <span class="mobile-request-value">{{ $request->pickup_date }}</span>
                    </div>
                </div>
            @empty
                <div class="no-requests-mobile">
                    <i class="fas fa-inbox"></i>
                    <p class="mb-0">No certificate requests found</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- SK Service Requests Section -->
<div class="requests-section">
    <h3 class="requests-title">SK Service Requests</h3>
    <div class="table-container">

        <!-- Desktop Table View -->
        <div class="desktop-table">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>School</th>
                            <th>Year</th>
                            <th>Service Type</th>
                            <th>Date Requested</th>
                            <th>Released Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($skServices as $request)
                            <tr>
                                <td class="font-weight-medium">{{ $request->firstname }} {{ $request->lastname }}</td>
                                <td>{{ $request->school }}</td>
                                <td>{{ $request->school_year }}</td>
                                <td>{{ $request->type_of_service }}</td>
                                <td>{{ $request->created_at->format('M d, Y') }}</td>
                                <td>{{ $request->released_date ? $request->released_date->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($request->status) }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                    No requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-cards">
            @forelse ($skServices as $request)
                <div class="mobile-request-card">
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Full Name:</span>
                        <span class="mobile-request-value font-weight-medium">{{ $request->firstname }} {{ $request->lastname }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">School:</span>
                        <span class="mobile-request-value">{{ $request->school }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">School Year:</span>
                        <span class="mobile-request-value">{{ $request->school_year }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Service Type:</span>
                        <span class="mobile-request-value">{{ $request->type_of_service }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Date Requested:</span>
                        <span class="mobile-request-value">{{ $request->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Released Date:</span>
                        <span class="mobile-request-value">{{ $request->released_date ? $request->released_date->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Status:</span>
                        <span class="mobile-request-value">
                            <span class="mobile-status-badge status-{{ strtolower($request->status) }}">
                                {{ $request->status }}
                            </span>
                        </span>
                    </div>
                </div>
            @empty
                <div class="no-requests-mobile">
                    <i class="fas fa-inbox"></i>
                    <p class="mb-0">No SK service requests found</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
