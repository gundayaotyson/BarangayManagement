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
     .status-ready{
        background-color: var(--primary-color);
        color: var(--light-color);
    }
      .status-processing{
        background-color: var(--warning-color);
        color: var(--light-color);
    }
      .status-released {
        background-color: var(--success-color);
        color: var(--light-color);
    }
</style>
<div class="requests-section">
       <h3 class="requests-title">My Certificate Requests</h3>
        <div class="table-container">
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
    </div>



    <div class="requests-section">
        <h3 class="requests-title"> SK Service Requests</h3>
        <div class="table-container">
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
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x mb-3 d-block"></i>
                                    No requests found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
