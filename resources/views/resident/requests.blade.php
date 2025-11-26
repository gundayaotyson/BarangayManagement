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
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 4px 12px var(--shadow-color);
        border: 1px solid var(--border-color);
    }

    .requests-title {
        color: var(--dark-color);
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
        font-size: 1.5rem;
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
        background: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 2px 8px var(--shadow-color);
    }

    /* Desktop Table Styling */
    .desktop-table {
        width: 100%;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .table thead th {
        background: var(--dark-color);
        color: white;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        padding: 1rem 0.75rem;
        text-align: left;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 1rem 0.75rem;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
        font-size: 0.9rem;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table tbody tr:hover {
        background-color: var(--primary-light);
        transition: background-color 0.2s ease;
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .status-pending {
        background-color: var(--warning-color);
        color: white;
    }

    .status-approved {
        background-color: var(--primary-color);
        color: white;
    }

    .status-released {
        background-color: var(--success-color);
        color: white;
    }
    .status-accept {
        background-color: var(--success-color);
        color: white;
    }

    .status-declined {
        background-color: var(--danger-color);
        color: white;
    }

    .status-rejected {
        background-color: var(--danger-color);
        color: white;
    }

    .status-ready {
        background-color: var(--primary-color);
        color: white;
    }

    .status-processing {
        background-color: var(--warning-color);
        color: white;
    }
    .status-expired {
    background-color: #dc3545; /* Bootstrap red */
    color: #fff;
}

    /* Mobile Card Styling */
    .mobile-cards {
        display: none;
    }

    .mobile-request-card {
        background: white;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px var(--shadow-color);
        border-left: 4px solid var(--primary-color);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .mobile-request-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px var(--shadow-color);
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
        font-size: 0.85rem;
        min-width: 120px;
        flex-shrink: 0;
    }

    .mobile-request-value {
        color: var(--text-color);
        font-size: 0.85rem;
        text-align: right;
        flex: 1;
        word-break: break-word;
    }

    .mobile-status-badge {
        padding: 0.35rem 0.7rem;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
    }

    .no-requests-mobile {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
        background: white;
        border-radius: 0.75rem;
    }

    .no-requests-mobile i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
        color: var(--primary-color);
    }

    /* Responsive Breakpoints */

    /* Large Desktop (1200px and above) */
    @media (min-width: 1200px) {
        .table thead th,
        .table tbody td {
            padding: 1.25rem 1rem;
            font-size: 0.95rem;
        }

        .requests-section {
            padding: 2.5rem;
        }
    }

    /* Laptop (992px - 1199px) */
    @media (max-width: 1199px) and (min-width: 992px) {
        .table thead th,
        .table tbody td {
            padding: 0.875rem 0.625rem;
            font-size: 0.85rem;
        }

        .status-badge {
            font-size: 0.7rem;
            padding: 0.35rem 0.7rem;
        }
    }

    /* Tablet (768px - 991px) */
    @media (max-width: 991px) and (min-width: 768px) {
        .requests-section {
            padding: 1.5rem;
        }

        .table thead th,
        .table tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }

        .table thead th {
            font-size: 0.75rem;
        }

        .status-badge {
            font-size: 0.65rem;
            padding: 0.3rem 0.6rem;
        }
    }

    /* Mobile (768px and below) */
    @media (max-width: 768px) {
        .requests-section {
            padding: 1.25rem;
            margin-top: 1.5rem;
            border-radius: 0.75rem;
        }

        .requests-title {
            font-size: 1.25rem;
            margin-bottom: 1.25rem;
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

    }

    /* Small Mobile (576px and below) */
    @media (max-width: 576px) {
        .requests-section {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
        }

        .requests-title {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .mobile-request-card {
            padding: 1rem;
            margin-bottom: 0.875rem;
        }

        .mobile-request-row {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .mobile-request-label {
            min-width: auto;
            margin-bottom: 0.25rem;
            font-size: 0.8rem;
        }

        .mobile-request-value {
            text-align: left;
            width: 100%;
            font-size: 0.8rem;
        }

        .mobile-status-badge {
            font-size: 0.65rem;
            padding: 0.3rem 0.6rem;
        }

    }

    /* Extra Small Mobile (400px and below) */
    @media (max-width: 400px) {
        .requests-section {
            padding: 0.875rem;
        }

        .requests-title {
            font-size: 1rem;
        }

        .mobile-request-card {
            padding: 0.875rem;
        }

        .mobile-request-label {
            font-size: 0.75rem;
        }

        .mobile-request-value {
            font-size: 0.75rem;
        }

        .mobile-status-badge {
            font-size: 0.6rem;
            padding: 0.25rem 0.5rem;
        }

        .no-requests-mobile {
            padding: 2rem 0.875rem;
        }

        .no-requests-mobile i {
            font-size: 2.5rem;
        }

    }

    /* Print Styles */
    @media print {
        .requests-section {
            box-shadow: none;
            border: 1px solid #000;
            margin: 1rem 0;
        }

        .mobile-cards {
            display: none;
        }

        .desktop-table {
            display: table;
        }
    }

    /* Accessibility Improvements */
    @media (prefers-reduced-motion: reduce) {
        .mobile-request-card,
        .table tbody tr {
            transition: none;
        }
    }

    /* High Contrast Support */
    @media (prefers-contrast: high) {
        .table tbody tr:hover {
            background-color: #ffff00;
            color: #000000;
        }

        .mobile-request-card {
            border-left: 4px solid #000000;
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
                            <th>Full Name</th>
                            <th>Tracking Code</th>
                            <th>Purpose</th>
                            <th>Service Type</th>
                            <th>Requested Date</th>
                            <th>Pickup Date</th>
                            <th>Release Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Carbon\Carbon;
                        @endphp
                        @forelse ($requests as $request)
                                @php
                                    $status = $request->status;

                                    if ($request->released_date) {
                                        $released = Carbon::parse($request->released_date);
                                        // Check if released date is more than 7 days ago
                                        if ($released->diffInDays(now()) > 7) {
                                            $status = 'Expired';
                                        }
                                    }
                                @endphp

                                <tr>
                                    <td>{{ $request->Fname }} {{ $request->mname }} {{ $request->lname }}</td>
                                    <td>{{ $request->tracking_code }}</td>
                                    <td>{{ $request->purpose }}</td>
                                    <td>{{ $request->service_type }}</td>
                                    <td>{{ $request->requested_date }}</td>
                                    <td>{{ $request->pickup_date }}</td>
                                    <td>{{ $request->released_date ? \Carbon\Carbon::parse($request->released_date)->format('M d, Y') : 'N/A' }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($status) }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
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
    @php
        $status = $request->status;

        if ($request->released_date) {
            $released = Carbon::parse($request->released_date);
            // If more than 7 days have passed since release date
            if ($released->diffInDays(now()) > 7) {
                $status = 'Expired';
            }
        }
    @endphp

    <div class="mobile-request-card">
        <div class="mobile-request-row">
            <span class="mobile-request-label">Full Name:</span>
            <span class="mobile-request-value">{{ $request->Fname }} {{ $request->mname }} {{ $request->lname }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Tracking Code:</span>
            <span class="mobile-request-value">{{ $request->tracking_code }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Purpose:</span>
            <span class="mobile-request-value">{{ $request->purpose }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Service Type:</span>
            <span class="mobile-request-value">{{ $request->service_type }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Requested Date:</span>
            <span class="mobile-request-value">{{ $request->requested_date }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Pickup Date:</span>
            <span class="mobile-request-value">{{ $request->pickup_date }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Release Date:</span>
            <span class="mobile-request-value">
                {{ $request->released_date ? \Carbon\Carbon::parse($request->released_date)->format('M d, Y') : 'N/A' }}
            </span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Status:</span>
            <span class="mobile-request-value">
                <span class="mobile-status-badge status-{{ strtolower($status) }}">
                    {{ $status }}
                </span>
            </span>
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
                            @php
                                $status = $request->status;

                                if ($request->released_date) {
                                    $released = Carbon::parse($request->released_date);
                                    if ($released->diffInDays(now()) > 7) {
                                        $status = 'Expired';
                                    }
                                }
                            @endphp
                            <tr>
                                <td class="font-weight-medium">{{ $request->firstname }} {{ $request->lastname }}</td>
                                <td>{{ $request->school }}</td>
                                <td>{{ $request->school_year }}</td>
                                <td>{{ $request->type_of_service }}</td>
                                <td>{{ $request->created_at->format('M d, Y') }}</td>
                                <td>{{ $request->released_date ? \Carbon\Carbon::parse($request->released_date)->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($status) }}">
                                        {{ $status }}
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

@forelse ($requests as $request)
    @php
        $status = $request->status;

        if ($request->released_date) {
            $released = Carbon::parse($request->released_date);
            // If more than 7 days have passed since release date
            if ($released->diffInDays(now()) > 7) {
                $status = 'Expired';
            }
        }
    @endphp

    <div class="mobile-request-card">
        <div class="mobile-request-row">
            <span class="mobile-request-label">Full Name:</span>
            <span class="mobile-request-value">{{ $request->Fname }} {{ $request->mname }} {{ $request->lname }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Tracking Code:</span>
            <span class="mobile-request-value">{{ $request->tracking_code }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Purpose:</span>
            <span class="mobile-request-value">{{ $request->purpose }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Service Type:</span>
            <span class="mobile-request-value">{{ $request->service_type }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Requested Date:</span>
            <span class="mobile-request-value">{{ $request->requested_date }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Pickup Date:</span>
            <span class="mobile-request-value">{{ $request->pickup_date }}</span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Release Date:</span>
            <span class="mobile-request-value">
                {{ $request->released_date ? \Carbon\Carbon::parse($request->released_date)->format('M d, Y') : 'N/A' }}
            </span>
        </div>
        <div class="mobile-request-row">
            <span class="mobile-request-label">Status:</span>
            <span class="mobile-request-value">
                <span class="mobile-status-badge status-{{ strtolower($status) }}">
                    {{ $status }}
                </span>
            </span>
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

<!-- Senior Service Requests Section -->
<div class="requests-section">
    <h3 class="requests-title">Senior Service Requests</h3>
    <div class="table-container">
        <!-- Desktop Table View -->
        <div class="desktop-table">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>OSCA ID</th>
                            <th>FCAP ID</th>
                            <th>Date Requested</th>
                            <th>Accept Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($seniorRequests as $request)
                            <tr>
                                <td class="font-weight-medium">{{ $request->first_name }} {{ $request->last_name }}</td>
                                <td>{{ $request->oscaId }}</td>
                                <td>{{ $request->fcapId }}</td>
                                <td>{{ $request->request_date->format('M d, Y') }}</td>
                                <td>{{ $request->accept_date ? \Carbon\Carbon::parse($request->accept_date)->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($request->status) }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                    No senior service requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-cards">
            @forelse ($seniorRequests as $request)
                <div class="mobile-request-card">
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Full Name:</span>
                        <span class="mobile-request-value">{{ $request->first_name }} {{ $request->last_name }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">OSCA ID:</span>
                        <span class="mobile-request-value">{{ $request->oscaId }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">FCAP ID:</span>
                        <span class="mobile-request-value">{{ $request->fcapId }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Date Requested:</span>
                        <span class="mobile-request-value">{{ $request->request_date->format('M d, Y') }}</span>
                    </div>
                    <div class="mobile-request-row">
                        <span class="mobile-request-label">Accept Date:</span>
                        <span class="mobile-request-value">{{ $request->accept_date ? \Carbon\Carbon::parse($request->accept_date)->format('M d, Y') : 'N/A' }}</span>
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
                    <p class="mb-0">No senior service requests found</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
