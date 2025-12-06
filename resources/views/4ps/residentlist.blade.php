    @extends('4ps.dashboard')

    @section('content')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #4361ee, #3a0ca3);
            --secondary-gradient: linear-gradient(135deg, #7209b7, #f72585);
            --success-gradient: linear-gradient(135deg, #4cc9f0, #4895ef);
            --warning-gradient: linear-gradient(135deg, #f8961e, #f3722c);
            --danger-gradient: linear-gradient(135deg, #ef476f, #ff0054);
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
            --card-bg: #ffffff;
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background: linear-gradient(135deg, #f6f9ff 0%, #edf2ff 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #333;
        }

        /* Glass Morphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-lg);
        }
        .ui-autocomplete {
    z-index: 9999 !important;
    max-height: 300px;
    overflow-y: auto;
    overflow-x: hidden;
}

.ui-autocomplete .ui-menu-item {
    padding: 10px;
    font-size: 14px;
}

.ui-autocomplete .ui-state-focus {
    background: linear-gradient(135deg, #4361ee, #3a0ca3);
    color: white;
    border: none;
}

        /* Enhanced Container */
        .container {
            max-width: 1400px;
            padding: 20px;
        }

        /* Modern Card Design */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-md);
            margin-bottom: 24px;
            transition: var(--transition);
            overflow: hidden;
            background: var(--card-bg);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            background: var(--primary-gradient);
            color: white;
            border-bottom: none;
            padding: 20px 24px;
            font-weight: 600;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
        }

        /* Enhanced Stats Cards */
        .stats-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 24px;
            text-align: center;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .stats-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
        }

        .stats-card:nth-child(2)::before { background: var(--success-gradient); }
        .stats-card:nth-child(3)::before { background: var(--warning-gradient); }
        .stats-card:nth-child(4)::before { background: var(--secondary-gradient); }

        .stats-number {
            font-size: 2.75rem;
            font-weight: 800;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
            line-height: 1;
            display: block;
        }

        .stats-label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* Enhanced Form Controls */
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            transition: var(--transition);
            font-size: 0.95rem;
            background: #fff;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            transform: translateY(-1px);
        }

        .form-control.is-invalid {
            border-color: #ef476f;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23ef476f'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23ef476f' stroke='none'/%3e%3c/svg%3e");
        }
        .card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                margin-bottom: 1.5rem;
            }

        /* Modern Buttons */
        .btn {
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: var(--primary-gradient);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
            color: white;
        }

        .btn-warning {
            background: var(--warning-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(248, 150, 30, 0.3);
        }

        .btn-warning:hover {
            color: white;
        }

        .btn-danger {
            background: var(--danger-gradient);
            box-shadow: 0 4px 15px rgba(239, 71, 111, 0.3);
            color: white;
        }

        .btn-danger:hover {
            color: white;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.875rem;
        }

        /* Enhanced Table */
        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            margin-bottom: 0;
            background: white;
        }

        .table thead {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
        }

        .table th {
            border: none;
            padding: 18px 16px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            color: white;
            border-bottom: none;
        }

        .table td {
            padding: 18px 16px;
            vertical-align: middle;
            border-color: #f1f5f9;
            font-weight: 500;
        }

        .table tbody tr {
            transition: background-color 0.2s;
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        /* Modern Badges */
        .badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-sm);
        }

        .badge.bg-success {
            background: var(--success-gradient) !important;
            color: white !important;
        }

        .badge.bg-primary {
            background: var(--primary-gradient) !important;
            color: white !important;
        }

        .badge.bg-secondary {
            background: linear-gradient(135deg, #64748b, #475569) !important;
            color: white !important;
        }

        .badge.bg-danger {
            background: var(--danger-gradient) !important;
            color: white !important;
        }

        /* Enhanced Modal */
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            overflow: hidden;
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: var(--primary-gradient);
            color: white;
            padding: 24px;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .modal-body {
            padding: 32px;
            background: #f8fafc;
        }

        .modal-footer {
            padding: 20px 32px;
            background: white;
            border-top: 1px solid #e2e8f0;
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* Section Titles */
        .section-title {
            color: var(--dark-color);
            font-weight: 700;
            margin-bottom: 24px;
            padding-bottom: 12px;
            position: relative;
            display: inline-block;
            font-size: 1.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        /* Resident Info Card */
        .resident-info-card {
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            border-left: 4px solid #4361ee;
            padding: 20px;
            margin: 24px 0;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .resident-info-card:hover {
            transform: translateX(4px);
        }

        .info-icon {
            color: #4361ee;
            margin-right: 12px;
            font-size: 1.2rem;
            background: rgba(67, 97, 238, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: flex-start;
        }

        .action-buttons .btn {
            min-width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 10px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 64px 32px;
            color: #64748b;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
            background: linear-gradient(135deg, #94a3b8, #64748b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Loading Animation */
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(67, 97, 238, 0.1);
            border-radius: 50%;
            border-top-color: #4361ee;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            border: none;
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            transition: var(--transition);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .fab:hover {
            transform: scale(1.1) rotate(90deg);
            box-shadow: 0 12px 25px rgba(67, 97, 238, 0.5);
        }

        /* Animations */
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

        .fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #3a0ca3, #4361ee);
        }

        /* Status Indicators */
        .status-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .status-active { background: #10b981; }
        .status-inactive { background: #6b7280; }
        .status-pending { background: #f59e0b; }

        /* Tooltip Enhancements */
        .tooltip {
            --bs-tooltip-bg: var(--dark-color);
            --bs-tooltip-color: white;
        }

        /* Focus States */
        *:focus {
            outline: 2px solid rgba(67, 97, 238, 0.5);
            outline-offset: 2px;
        }

        /* Smooth Transitions */
        a, button, .btn, .card, .stats-card {
            transition: var(--transition);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 12px;
            }

            .card-body {
                padding: 16px;
            }

            .table-responsive {
                border-radius: 8px;
                font-size: 0.875rem;
            }

            .table th,
            .table td {
                padding: 12px 8px;
            }

            .stats-card {
                padding: 20px 16px;
                margin-bottom: 16px;
            }

            .stats-number {
                font-size: 2rem;
            }

            .modal-body {
                padding: 20px;
            }

            .modal-header {
                padding: 16px;
            }

            .btn {
                padding: 10px 20px;
            }

            .section-title {
                font-size: 1.25rem;
            }

            .action-buttons {
                flex-wrap: wrap;
            }

            .action-buttons .btn {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 576px) {
            .modal-dialog {
                margin: 10px;
            }

            .modal-content {
                border-radius: 16px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }

            .action-buttons .btn {
                width: 100%;
                justify-content: center;
            }

            .fab {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }

            .resident-info-card .row > div {
                margin-bottom: 10px;
            }
        }

        /* Print Styles */
        @media print {
            .btn,
            .action-buttons,
            .modal,
            .fab {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                break-inside: avoid;
            }

            .table {
                box-shadow: none !important;
                border: 1px solid #ddd;
            }

            .stats-card {
                border: 1px solid #ddd !important;
            }
        }

        /* Autocomplete Styles */
        .ui-autocomplete {
            background: white;
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            border: 1px solid #e2e8f0;
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 9999 !important;
        }

        .ui-menu-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: var(--transition);
        }

        .ui-menu-item:last-child {
            border-bottom: none;
        }

        .ui-menu-item:hover {
            background: rgba(67, 97, 238, 0.1);
        }

        .ui-state-focus {
            background: var(--primary-gradient) !important;
            color: white !important;
            border: none !important;
            margin: 0 !important;
        }

        /* Additional Utility Classes */
        .text-gradient {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .shadow-hover:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        /* Search Input Styling */
        .search-container {
            position: relative;
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
    </style>

    <div class="container py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="section-title">
                    <i class="fas fa-users me-2 text-gradient"></i>4Ps Beneficiaries Management
                </h1>
                <p class="text-muted">Manage 4Ps beneficiaries and their information</p>
            </div>
            <button type="button" class="btn btn-primary d-none d-md-block" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="fas fa-plus-circle me-2"></i>Add New Beneficiary
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stats-card">
                    <div class="stats-number">{{ count($fourps) }}</div>
                    <div class="stats-label">Total Beneficiaries</div>
                    <i class="fas fa-users mt-3" style="font-size: 2rem; opacity: 0.2; color: #4361ee;"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $fourps->where('status', 'active')->count() }}</div>
                    <div class="stats-label">Active</div>
                    <i class="fas fa-check-circle mt-3" style="font-size: 2rem; opacity: 0.2; color: #4cc9f0;"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $fourps->where('status', 'inactive')->count() }}</div>
                    <div class="stats-label">Inactive</div>
                    <i class="fas fa-times-circle mt-3" style="font-size: 2rem; opacity: 0.2; color: #f8961e;"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $fourps->whereNotNull('resident_id')->count() }}</div>
                    <div class="stats-label">Resident Matched</div>
                    <i class="fas fa-link mt-3" style="font-size: 2rem; opacity: 0.2; color: #7209b7;"></i>
                </div>
            </div>
        </div>
            <!-- <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card stats-card">
                        <div class="stats-number stats-total">{{ count($fourps) }}</div>
                        <div class="stats-label">Total Beneficiaries</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card stats-card">
                        <div class="stats-number stats-pending">{{ $fourps->where('status', 'active')->count() }}</div>
                        <div class="stats-label">Active</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card stats-card">
                        <div class="stats-number stats-accepted">{{ $fourps->where('status', 'inactive')->count() }}</div>
                        <div class="stats-label">Inactive</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card stats-card">
                        <div class="stats-number stats-rejected">{{ $fourps->whereNotNull('resident_id')->count() }}</div>
                        <div class="stats-label">Resident Match</div>
                    </div>
                </div>
            </div> -->
        <!-- Beneficiaries Table -->
        <div class="card fade-in-up">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-list me-2"></i>4Ps Beneficiaries List
                </div>
                <div class="d-flex align-items-center">
                    <span class="badge bg-primary me-3">{{ count($fourps) }} Records</span>
                    <!-- <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Print
                    </button> -->
                </div>
            </div>
            <div class="card-body">
                @if(count($fourps) > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Purok No.</th>
                                <th>House No.</th>
                                <th>4Ps ID</th>
                                <th>Status</th>
                                <th>Resident Match</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fourps as $fourp)
                                <tr class="transition-all">
                                    <td><strong>#{{ $fourp->id }}</strong></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="status-indicator status-{{ $fourp->status }}"></div>
                                            {{ $fourp->fname }} {{ $fourp->mname }} {{ $fourp->lname }}
                                        </div>
                                    </td>
                                    <td>{{ $fourp->purok_no }}</td>
                                    <td>{{ $fourp->household_no }}</td>
                                    <td>
                                        <span class="badge bg-dark">{{ $fourp->fourps_id }}</span>
                                    </td>
                                    <td>
                                        @if ($fourp->status == 'active')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i>Active
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-times-circle me-1"></i>Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($fourp->resident)
                                            <span class="badge bg-success">
                                                <i class="fas fa-link me-1"></i>Matched
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-unlink me-1"></i>Not Matched
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button type="button" class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="{{ $fourp->id }}"
                                                data-fname="{{ $fourp->fname }}"
                                                data-mname="{{ $fourp->mname }}"
                                                data-lname="{{ $fourp->lname }}"
                                                data-purok_no="{{ $fourp->purok_no }}"
                                                data-household_no="{{ $fourp->household_no }}"
                                                data-fourps_id="{{ $fourp->fourps_id }}"
                                                data-status="{{ $fourp->status }}"
                                                data-resident_id="{{ $fourp->resident_id }}"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('4ps.residentlist.destroy', $fourp->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this beneficiary? This action cannot be undone.')"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h4>No Beneficiaries Found</h4>
                    <p class="text-muted">Start by adding your first 4Ps beneficiary.</p>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus-circle me-2"></i>Add First Beneficiary
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('4ps.residentlist.store') }}" method="POST" id="addForm">
                    @csrf
                    <input type="hidden" name="resident_id" id="resident_id">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-plus-circle me-2"></i>Add New 4Ps Beneficiary
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Resident Search Section -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="section-title">
                                    <i class="fas fa-user info-icon"></i>Resident Information
                                </h5>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="resident_name" class="form-label">Search Resident *</label>
                                <div class="search-container">
                                    <input type="text" id="resident_name" class="form-control" placeholder="Type resident name to search...">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                                <div class="form-text text-muted">Start typing to search for existing residents. If found, fields will auto-fill.</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="fname" class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="fname" name="fname" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mname" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="mname" name="mname">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lname" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="section-title">
                                    <i class="fas fa-home info-icon"></i>Address Information
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="purok_no" class="form-label">Purok No. *</label>
                                <select name="purok_no" id="purok_no" class="form-select" required>
                                    <option value="">Select Purok</option>
                                    <option value="Purok 1">Purok 1</option>
                                    <option value="Purok 2">Purok 2</option>
                                    <option value="Purok 3">Purok 3</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="household_no" class="form-label">House No. *</label>
                                <input type="text" class="form-control" id="household_no" name="household_no" required>
                            </div>
                        </div>

                        <!-- 4Ps Information -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="section-title">
                                    <i class="fas fa-id-card info-icon"></i>4Ps Information
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fourps_id" class="form-label">4Ps ID *</label>
                                <input type="text" class="form-control" id="fourps_id" name="fourps_id" required
                                    placeholder="e.g., 4PS-2024-001">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveButton">
                            <i class="fas fa-save me-2"></i>Save Beneficiary
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Edit 4Ps Beneficiary
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="resident_id" id="edit_resident_id">

                    <!-- Current Resident Information Card (if matched) -->
                    <div id="currentResidentInfo" class="resident-info-card" style="display: none;">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6><i class="fas fa-user-check info-icon"></i>Current Matched Resident</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearResidentMatch()">
                                <i class="fas fa-unlink me-1"></i>Unlink
                            </button>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <small class="text-muted">Name:</small>
                                <div id="currentResidentName" class="fw-semibold"></div>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Purok:</small>
                                <div id="currentResidentPurok" class="fw-semibold"></div>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">House No:</small>
                                <div id="currentResidentHouseNo" class="fw-semibold"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Resident Information -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="section-title">
                                <i class="fas fa-user info-icon"></i>Resident Information
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="edit_fname" class="form-label">First Name *</label>
                            <input type="text" class="form-control" id="edit_fname" name="fname" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_mname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="edit_mname" name="mname">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_lname" class="form-label">Last Name *</label>
                            <input type="text" class="form-control" id="edit_lname" name="lname" required>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="section-title">
                                <i class="fas fa-home info-icon"></i>Address Information
                            </h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_purok_no" class="form-label">Purok No. *</label>
                            <select class="form-select" id="edit_purok_no" name="purok_no" required>
                                <option value="">Select Purok</option>
                                <option value="Purok 1">Purok 1</option>
                                <option value="Purok 2">Purok 2</option>
                                <option value="Purok 3">Purok 3</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_household_no" class="form-label">House No. *</label>
                            <input type="text" class="form-control" id="edit_household_no" name="household_no" required>
                        </div>
                    </div>

                    <!-- 4Ps Information -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="section-title">
                                <i class="fas fa-id-card info-icon"></i>4Ps Information
                            </h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_fourps_id" class="form-label">4Ps ID *</label>
                            <input type="text" class="form-control" id="edit_fourps_id" name="fourps_id" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label">Status *</label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Beneficiary
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Floating Action Button (for mobile) -->
    <button class="fab d-md-none" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="fas fa-plus"></i>
    </button>


<script>
$(document).ready(function() {
    // Initialize autocomplete for resident search in ADD modal
    $("#resident_name").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('4ps.search.resident') }}",
                dataType: "json",
                data: {
                    query: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.fname + " " + (item.mname ? item.mname + " " : "") + item.lname +
                                   " (Purok: " + (item.purok_no || 'N/A') + ", House No: " + (item.household_no || 'N/A') + ")",
                            value: item.fname + " " + item.lname,
                            data: item
                        };
                    }));
                },
                error: function(xhr, status, error) {
                    console.error("Autocomplete error:", error);
                    response([]);
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            if (ui.item.data) {
                // Auto-fill the form fields
                $('#resident_id').val(ui.item.data.id);
                $('#fname').val(ui.item.data.fname);
                $('#mname').val(ui.item.data.mname || '');
                $('#lname').val(ui.item.data.lname);
                $('#purok_no').val(ui.item.data.purok_no);
                $('#household_no').val(ui.item.data.household_no);

                showNotification('success', 'Resident found and fields auto-filled!');
            }
        },
        focus: function(event, ui) {
            // Just update the input field with the name
            $(this).val(ui.item.value);
            return false;
        }
    }).autocomplete("instance")._renderItem = function(ul, item) {
        return $("<li>")
            .append("<div>" + item.label + "</div>")
            .appendTo(ul);
    };

    // Handle form submission for ADD modal
    $('#addForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalBtnText = submitBtn.html();

        // Show loading state
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                showNotification('success', response.success || 'Beneficiary added successfully!');
                $('#addModal').modal('hide');
                form[0].reset();

                // Reload the page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false);
                submitBtn.html(originalBtnText);

                if (xhr.status === 422) {
                    // Handle validation errors
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';

                    // Clear previous errors
                    form.find('.is-invalid').removeClass('is-invalid');
                    form.find('.invalid-feedback').remove();

                    // Display new errors
                    $.each(errors, function(key, value) {
                        const input = form.find(`[name="${key}"]`);
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback">${value[0]}</div>`);
                        errorMessage += value[0] + '<br>';
                    });

                    showNotification('error', errorMessage);
                } else {
                    showNotification('error', 'An error occurred while saving the beneficiary.');
                }
            }
        });
    });

    // Store original values when modal opens
    let originalValues = {};

    // Handle Edit Button Click
    $('.edit-btn').on('click', function() {
        const id = $(this).data('id');
        const fname = $(this).data('fname');
        const mname = $(this).data('mname');
        const lname = $(this).data('lname');
        const purok_no = $(this).data('purok_no');
        const household_no = $(this).data('household_no');
        const fourps_id = $(this).data('fourps_id');
        const status = $(this).data('status');
        const resident_id = $(this).data('resident_id');

        // Store original values
        originalValues = {
            id: id,
            fname: fname,
            mname: mname,
            lname: lname,
            purok_no: purok_no,
            household_no: household_no,
            fourps_id: fourps_id,
            status: status,
            resident_id: resident_id
        };

        // Populate form fields ONLY with 4Ps beneficiary data
        $('#edit_id').val(id);
        $('#edit_fname').val(fname);
        $('#edit_mname').val(mname || '');
        $('#edit_lname').val(lname);
        $('#edit_purok_no').val(purok_no);
        $('#edit_household_no').val(household_no);
        $('#edit_fourps_id').val(fourps_id);
        $('#edit_status').val(status);
        $('#edit_resident_id').val(resident_id || '');

        // Set form action
        $('#editForm').attr('action', `/4ps/residentlist/${id}`);

        // Show current resident info if matched (but don't populate form)
        if (resident_id) {
            fetchResidentDetails(resident_id);
        } else {
            $('#currentResidentInfo').hide();
        }

        // Reset any validation errors
        $('#editForm .is-invalid').removeClass('is-invalid');
        $('#editForm .invalid-feedback').remove();

        // Initialize autocomplete for EDIT modal resident search
        initializeEditResidentSearch();
    });

    // Function to fetch resident details - ONLY for display in info card
    function fetchResidentDetails(residentId) {
        $.ajax({
            url: `/4ps/residents/${residentId}/details`,
            type: 'GET',
            dataType: 'json',
            success: function(resident) {
                // Update the current resident info card ONLY
                $('#currentResidentName').text(`${resident.fname} ${resident.mname ? resident.mname + ' ' : ''}${resident.lname}`);
                $('#currentResidentPurok').text(resident.purok_no || 'N/A');
                $('#currentResidentHouseNo').text(resident.household_no || 'N/A');
                $('#currentResidentInfo').show();
            },
            error: function(xhr) {
                console.error('Error fetching resident details:', xhr.responseText);
                $('#currentResidentInfo').hide();
            }
        });
    }

    // Function to initialize resident search in EDIT modal
    function initializeEditResidentSearch() {
        // Create search input if it doesn't exist
        if (!$('#edit_resident_search_container').length) {
            $('#editForm .modal-body').prepend(``);

            // Initialize autocomplete for edit modal
            $("#edit_resident_search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('4ps.search.resident') }}",
                        dataType: "json",
                        data: {
                            query: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.fname + " " + (item.mname ? item.mname + " " : "") + item.lname +
                                           " (Purok: " + (item.purok_no || 'N/A') + ", House No: " + (item.household_no || 'N/A') + ")",
                                    value: item.fname + " " + item.lname,
                                    data: item
                                };
                            }));
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    if (ui.item.data) {
                        // Link the resident to the beneficiary
                        $('#edit_resident_id').val(ui.item.data.id);

                        // Update the current resident info card
                        $('#currentResidentName').text(`${ui.item.data.fname} ${ui.item.data.mname ? ui.item.data.mname + ' ' : ''}${ui.item.data.lname}`);
                        $('#currentResidentPurok').text(ui.item.data.purok_no || 'N/A');
                        $('#currentResidentHouseNo').text(ui.item.data.household_no || 'N/A');
                        $('#currentResidentInfo').show();

                        // Clear the search input
                        $(this).val('');

                        showNotification('success', 'Resident linked successfully!');
                    }
                    return false;
                }
            }).autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<div>" + item.label + "</div>")
                    .appendTo(ul);
            };
        }
    }

    // Function to clear resident match
    window.clearResidentMatch = function() {
        if (confirm('Are you sure you want to unlink this resident? This will only remove the connection, beneficiary data will remain unchanged.')) {
            $('#edit_resident_id').val('');
            $('#currentResidentInfo').hide();
            showNotification('info', 'Resident link removed.');
        }
    }

    // Handle edit form submission
    $('#editForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalBtnText = submitBtn.html();

        // Show loading state
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Updating...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                showNotification('success', response.success || 'Beneficiary updated successfully!');
                $('#editModal').modal('hide');

                // Reload the page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false);
                submitBtn.html(originalBtnText);

                if (xhr.status === 422) {
                    // Handle validation errors
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';

                    // Clear previous errors
                    form.find('.is-invalid').removeClass('is-invalid');
                    form.find('.invalid-feedback').remove();

                    // Display new errors
                    $.each(errors, function(key, value) {
                        const input = form.find(`[name="${key}"]`);
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback">${value[0]}</div>`);
                        errorMessage += value[0] + '<br>';
                    });

                    showNotification('error', errorMessage);
                } else {
                    showNotification('error', 'An error occurred while updating the beneficiary.');
                }
            }
        });
    });

    // Notification function
    function showNotification(type, message) {
        // Remove existing notifications
        $('.alert-notification').remove();

        const alertClass = type === 'success' ? 'alert-success' :
                          type === 'error' ? 'alert-danger' :
                          type === 'info' ? 'alert-info' : 'alert-warning';

        const icon = type === 'success' ? 'fa-check-circle' :
                    type === 'error' ? 'fa-exclamation-circle' :
                    type === 'info' ? 'fa-info-circle' : 'fa-exclamation-triangle';

        const notification = $(`
            <div class="alert ${alertClass} alert-notification alert-dismissible fade show position-fixed"
                 style="top: 20px; right: 20px; z-index: 9999; min-width: 300px; max-width: 400px;">
                <div class="d-flex align-items-center">
                    <i class="fas ${icon} me-2"></i>
                    <div>${message}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);

        $('body').append(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.alert('close');
        }, 5000);
    }

    // Reset forms when modals are closed
    $('#addModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#resident_id').val('');
        $('#addForm .is-invalid').removeClass('is-invalid');
        $('#addForm .invalid-feedback').remove();
    });

    $('#editModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#currentResidentInfo').hide();
        $('#editForm .is-invalid').removeClass('is-invalid');
        $('#editForm .invalid-feedback').remove();
        $('#edit_resident_search_container').remove();
        originalValues = {};
    });

    // Confirm before deleting
    $(document).on('submit', 'form[action*="destroy"]', function(e) {
        e.preventDefault();
        const form = $(this);

        if (confirm('Are you sure you want to delete this beneficiary? This action cannot be undone.')) {
            form.unbind('submit').submit();
        }
    });

    // Initialize tooltips
    $('[title]').tooltip({
        trigger: 'hover',
        placement: 'top'
    });
});
</script>

 @endsection
