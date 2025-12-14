@extends('admin.dashboard')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        --secondary-gradient: linear-gradient(135deg, #4361ee 0%, #3a56d4 100%);
        --success-gradient: linear-gradient(135deg, #28a745 0%, #23923d 100%);
        --warning-gradient: linear-gradient(135deg, #f8961e 0%, #e68a1a 100%);
        --danger-gradient: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
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

    /* Page Header */
    .page-header {
        background: var(--primary-gradient);
        color: white;
        padding: 2rem;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(100px, -100px);
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 600px;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
        border-left: 4px solid;
        position: relative;
        overflow: hidden;
    }

    .stat-card.total {
        border-left-color: #2c3e50;
    }

    .stat-card.active {
        border-left-color: #28a745;
    }

    .stat-card.inactive {
        border-left-color: #f8961e;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .stat-icon {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        font-size: 2.5rem;
        opacity: 0.1;
        color: var(--dark-color);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 1rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .stat-change {
        font-size: 0.85rem;
        color: #28a745;
        margin-top: 0.5rem;
    }

    .stat-change.negative {
        color: #dc3545;
    }

    /* Content Card */
    .content-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        padding: 1.5rem;
        margin-bottom: 2rem;
        transition: var(--transition);
    }

    .content-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--light-color);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark-color);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
    }

    /* Buttons */
    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: var(--secondary-gradient);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }

    .btn-warning {
        background: var(--warning-gradient);
        color: white;
    }

    .btn-danger {
        background: var(--danger-gradient);
        color: white;
    }

    .btn-outline {
        background: transparent;
        border: 2px solid #4361ee;
        color: #4361ee;
    }

    .btn-outline:hover {
        background: #4361ee;
        color: white;
    }

    .btn-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }

    /* Filters */
    .filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-label {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.9rem;
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: white;
        font-size: 0.9rem;
        min-width: 150px;
        transition: var(--transition);
    }

    .filter-select:focus {
        outline: none;
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    /* Search */
    .search-container {
        position: relative;
        flex: 1;
        min-width: 300px;
    }

    .search-wrapper {
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .search-input:focus {
        outline: none;
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.9rem;
    }

    .clear-search {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        display: none;
    }

    /* Table */
    .table-container {
        overflow-x: auto;
        border-radius: 8px;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table thead {
        background: var(--primary-gradient);
    }

    .table th {
        background-color: var( --dark-color);
        padding: 1rem;
        text-align: left;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
    }

    .table tbody tr {
        transition: var(--transition);
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border: none;
    }

    /* Resident Info */
    .resident-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .resident-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--secondary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
    }

    .resident-details h4 {
        margin: 0;
        font-weight: 600;
        color: var(--dark-color);
    }

    .resident-details p {
        margin: 0.25rem 0 0 0;
        font-size: 0.85rem;
        color: #666;
    }

    /* Status Badge */
    .status-badge {
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-badge.active {
        background: rgba(46, 204, 113, 0.1);
        color: #28a745;
        border: 1px solid rgba(46, 204, 113, 0.2);
    }

    .status-badge.inactive {
        background: rgba(243, 156, 18, 0.1);
        color: #f39c12;
        border: 1px solid rgba(243, 156, 18, 0.2);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
        color: var(--dark-color);
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    /* Search Results Info */
    .search-results-info {
        padding: 0.75rem 0;
        margin-bottom: 1rem;
        color: #666;
        font-size: 0.9rem;
        border-bottom: 1px solid #f1f5f9;
    }

    /* No Results State */
    .no-results-state {
        text-align: center;
        padding: 2rem;
        color: #666;
        display: none;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: var(--border-radius);
        border: none;
        overflow: hidden;
        box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem;
        border-bottom: none;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .modal-body {
        padding: 2rem;
    }

    /* Form Controls */
    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        transition: var(--transition);
        font-size: 0.95rem;
        background: #fff;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }

    /* Section Title */
    .section-title {
        color: var(--dark-color);
        font-weight: 700;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        position: relative;
        display: inline-block;
        font-size: 1.25rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: #4361ee;
        border-radius: 2px;
    }

    /* Form Section */
    .form-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e2e8f0;
    }

    /* Autocomplete */
    .ui-autocomplete {
        z-index: 99999 !important;
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        background: white;
        border-radius: 8px;
        box-shadow: var(--shadow-lg);
        border: 1px solid #e2e8f0;
    }

    .ui-autocomplete .ui-menu-item {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        cursor: pointer;
        transition: var(--transition);
        font-size: 14px;
    }

    .ui-autocomplete .ui-menu-item:hover {
        background: rgba(67, 97, 238, 0.1);
    }

    /* Animations */
    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
        }

        .page-header h1 {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .card-actions {
            width: 100%;
            justify-content: flex-start;
        }

        .filters {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-group {
            width: 100%;
        }

        .filter-select {
            width: 100%;
        }

        .search-container {
            min-width: 100%;
        }

        .table {
            font-size: 0.9rem;
        }

        .table th,
        .table td {
            padding: 0.75rem;
        }
    }

    @media (max-width: 480px) {
        .page-header {
            padding: 1rem;
        }

        .page-header h1 {
            font-size: 1.75rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .stat-icon {
            font-size: 2rem;
        }

        .content-card {
            padding: 1rem;
        }
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header fade-in">
        <h1><i class="fas fa-users-medical"></i> 4Ps Beneficiaries List</h1>
        <p>Manage and monitor Pantawid Pamilyang Pilipino Program beneficiaries with real-time statistics and insights.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid fade-in" style="animation-delay: 0.1s;">
        <div class="stat-card total">
            <i class="fas fa-users stat-icon"></i>
            <div class="stat-value">{{ number_format($totalBeneficiaries) }}</div>
            <div class="stat-label">Total Beneficiaries</div>
            <div class="stat-change">
                <i class="fas fa-arrow-up"></i> Updated Today
            </div>
        </div>

        <div class="stat-card active">
            <i class="fas fa-check-circle stat-icon"></i>
            <div class="stat-value">{{ number_format($activeBeneficiaries) }}</div>
            <div class="stat-label">Active Beneficiaries</div>
            <div class="stat-change">
                <i class="fas fa-chart-line"></i> {{ number_format(($activeBeneficiaries/$totalBeneficiaries)*100, 1) }}% of total
            </div>
        </div>

        <div class="stat-card inactive">
            <i class="fas fa-times-circle stat-icon"></i>
            <div class="stat-value">{{ number_format($inactiveBeneficiaries) }}</div>
            <div class="stat-label">Inactive Beneficiaries</div>
            <div class="stat-change">
                <i class="fas fa-chart-bar"></i> {{ number_format(($inactiveBeneficiaries/$totalBeneficiaries)*100, 1) }}% of total
            </div>
        </div>
    </div>

    <!-- Quick Stats Footer -->
    <div class="row fade-in" style="animation-delay: 0.3s;">
        <div class="col-md-4">
            <div class="content-card" style="text-align: center; padding: 1rem;">
                <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                    <i class="fas fa-chart-pie"></i> Active Rate
                </div>
                <div style="font-size: 2rem; font-weight: 700; color: #28a745;">
                    {{ number_format(($activeBeneficiaries/$totalBeneficiaries)*100, 1) }}%
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="content-card" style="text-align: center; padding: 1rem;">
                <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                    <i class="fas fa-user-check"></i> Resident Match
                </div>
                <div style="font-size: 2rem; font-weight: 700; color: #4361ee;">
                    {{ number_format(($fourps->where('resident_id', '!=', null)->count()/$totalBeneficiaries)*100, 1) }}%
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="content-card" style="text-align: center; padding: 1rem;">
                <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                    <i class="fas fa-calendar-alt"></i> This Month
                </div>
                <div style="font-size: 2rem; font-weight: 700; color: #f8961e;">
                    {{ $fourps->where('created_at', '>=', now()->startOfMonth())->count() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="content-card fade-in" style="animation-delay: 0.2s;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-list"></i>
                <span>Beneficiaries List</span>
                <span class="badge bg-primary" style="background: #4361ee; color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem;">
                    {{ $totalBeneficiaries }} Records
                </span>
            </div>

            <div class="card-actions">
                   <button type="button" class="btn btn-primary d-none d-md-block" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus-circle me-2"></i>Add New Beneficiary
                </button>
                <button class="btn btn-success" onclick="exportCSV()">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>


                <button class="btn btn-primary" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <div class="filter-group">
                <span class="filter-label">Status:</span>
                <select class="filter-select" id="statusFilter">
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label">Month:</span>
                <select class="filter-select" id="monthFilter">
                    <option value="all">All Months</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>

            </div>
            <div class="filter-group">
                <span class="filter-label">Purok:</span>
                <select class="filter-select" id="purokFilter">
                    <option value="all">All Puroks</option>
                    <option value="Purok 1">Purok 1</option>
                    <option value="Purok 2">Purok 2</option>
                    <option value="Purok 3">Purok 3</option>
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label">Sort By:</span>
                <select class="filter-select" id="sortFilter">
                    <option value="name_asc">Name (A-Z)</option>
                    <option value="name_desc">Name (Z-A)</option>
                    <option value="date_asc">Date Added (Oldest)</option>
                    <option value="date_desc">Date Added (Newest)</option>
                    <option value="status">Status</option>
                </select>
            </div>
            <div class="search-container">
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search beneficiaries by name, 4Ps ID...">
                    <button type="button" class="clear-search" id="clearSearchBtn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Search Results Info -->
        <div class="search-results-info" id="searchResultsInfo" style="display: none;">
            Showing <strong id="resultsCount">0</strong> of <strong>{{ $fourps->count() }}</strong> records
            <span id="searchTermText"></span>
        </div>

        <!-- No Results State -->
        <div class="no-results-state" id="noResultsState">
            <i class="fas fa-search"></i>
            <h4>No Beneficiaries Found</h4>
            <p>No beneficiaries match your search criteria. Try adjusting your filters or search term.</p>
            <button class="btn btn-outline" id="clearFiltersBtn">
                <i class="fas fa-times"></i> Clear All Filters
            </button>
        </div>

        <!-- Beneficiaries Table -->
        <div class="table-container">
            @if($fourps->count() > 0)
            <table class="table" id="beneficiariesTable">
                <thead>
                    <tr>
                        <th>Beneficiary Information</th>
                        <th>4Ps ID</th>
                        <th>Status</th>
                        <th>Purok</th>
                        <th>Date Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="beneficiariesTableBody">
                    @foreach ($fourps as $beneficiary)
                    <tr class="fade-in beneficiary-row"
                        style="animation-delay: {{ $loop->index * 0.05 }}s;"
                        data-fullname="{{ strtolower(($beneficiary->resident ? $beneficiary->resident->Fname . ' ' . $beneficiary->resident->mname . ' ' . $beneficiary->resident->lname : '(No associated resident)')) }}"
                        data-firstname="{{ strtolower($beneficiary->resident ? $beneficiary->resident->Fname : '') }}"
                        data-lastname="{{ strtolower($beneficiary->resident ? $beneficiary->resident->lname : '') }}"
                        data-fourps-id="{{ strtolower($beneficiary->fourps_id ?? '') }}"
                        data-status="{{ strtolower($beneficiary->status ?? '') }}"
                        data-purok="{{ strtolower($beneficiary->resident ? $beneficiary->resident->purok_no : '') }}"
                        data-created-at="{{ $beneficiary->created_at ? $beneficiary->created_at->format('Y-m-d') : '' }}"
                        data-registered-date="{{ $beneficiary->created_at ? $beneficiary->created_at->timestamp : 0 }}">
                        <td>
                            <div class="resident-info">
                                <div class="resident-avatar">
                                    @if ($beneficiary->resident)
                                    {{ substr($beneficiary->resident->Fname, 0, 1) }}{{ substr($beneficiary->resident->lname, 0, 1) }}
                                    @else
                                    NA
                                    @endif
                                </div>
                                <div class="resident-details">
                                    <h4>
                                        @if ($beneficiary->resident)
                                        {{ $beneficiary->resident->Fname }} {{ $beneficiary->resident->mname }} {{ $beneficiary->resident->lname }}
                                        @else
                                        <span style="color: #999;">(No associated resident)</span>
                                        @endif
                                    </h4>
                                    @if ($beneficiary->resident)
                                    <p>
                                        <i class="fas fa-home"></i>
                                        {{ $beneficiary->resident->purok_no ?? 'N/A' }} •
                                        <i class="fas fa-hashtag"></i>
                                        {{ $beneficiary->resident->household_no ?? 'N/A' }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $beneficiary->fourps_id ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            @if ($beneficiary->status == 'active')
                            <span class="status-badge active">
                                <i class="fas fa-check-circle"></i> Active
                            </span>
                            @elseif ($beneficiary->status == 'inactive')
                            <span class="status-badge inactive">
                                <i class="fas fa-times-circle"></i> Inactive
                            </span>
                            @else
                            <span class="status-badge inactive">
                                <i class="fas fa-clock"></i> Pending
                            </span>
                            @endif
                        </td>
                        <td>
                            @if ($beneficiary->resident && $beneficiary->resident->purok_no)
                            <span style="font-weight: 600; color: #4361ee;">
                                {{ $beneficiary->resident->purok_no }}
                            </span>
                            @else
                            <span style="color: #999;">N/A</span>
                            @endif
                        </td>
                        <td>
                            {{ $beneficiary->created_at ? $beneficiary->created_at->format('M d, Y') : 'N/A' }}
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button type="button" class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-id="{{ $beneficiary->id }}"
                                    data-fname="{{ $beneficiary->fname }}"
                                    data-mname="{{ $beneficiary->mname }}"
                                    data-lname="{{ $beneficiary->lname }}"
                                    data-purok_no="{{ $beneficiary->purok_no }}"
                                    data-household_no="{{ $beneficiary->household_no }}"
                                    data-fourps_id="{{ $beneficiary->fourps_id }}"
                                    data-status="{{ $beneficiary->status }}"
                                    data-resident_id="{{ $beneficiary->resident_id }}"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('4ps.residentlist.destroy', $beneficiary->id) }}" method="POST" style="display: inline-block;">
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
            @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>No Beneficiaries Found</h3>
                <p>There are no 4Ps beneficiaries in the system yet.</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus"></i> Add First Beneficiary
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
                <input type="hidden" name="is_manual_entry" id="is_manual_entry" value="0">
                <input type="hidden" name="resident_id" id="resident_id">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i>Add New 4Ps Beneficiary
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Resident Search Section -->
                    <div class="form-section">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5 class="section-title">
                                    <i class="fas fa-user me-2"></i>Resident Information
                                </h5>
                                <p class="text-muted mb-3">Search for an existing resident or enter details manually</p>
                            </div>
                        </div>

                        <!-- Search Section -->
                        <div class="row mb-4" id="searchSection">
                            <div class="col-md-12 mb-3">
                                <label for="resident_name" class="form-label">Search Existing Resident</label>
                                <div class="search-wrapper">
                                    <input type="text" id="resident_name" class="form-control" placeholder="Type resident name to search...">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                                <div class="form-text text-muted">Start typing to search for existing residents. If found, fields will auto-fill.</div>
                            </div>
                        </div>

                        <!-- Auto-filled fields -->
                        <div class="row" id="autoFilledFields">
                            <div class="col-md-4 mb-3">
                                <label for="fname" class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="fname" name="fname" required readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mname" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="mname" name="mname" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lname" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="lname" name="lname" required readonly>
                            </div>
                        </div>

                        <!-- Auto-filled address fields -->
                        <div class="row" id="autoFilledAddress">
                            <div class="col-md-6 mb-3">
                                <label for="purok_no" class="form-label">Purok No. *</label>
                                <input type="text" class="form-control" id="purok_no" name="purok_no" required readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="household_no" class="form-label">House No. *</label>
                                <input type="text" class="form-control" id="household_no" name="household_no" required readonly>
                            </div>
                        </div>
                    </div>

                    <!-- 4Ps Information -->
                    <div class="form-section">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="section-title">
                                    <i class="fas fa-id-card me-2"></i>4Ps Information
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fourps_id" class="form-label">4Ps ID *</label>
                                <input type="text" class="form-control" id="fourps_id" name="fourps_id" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
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
            <form action="" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">
                <input type="hidden" name="resident_id" id="edit_resident_id">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Edit 4Ps Beneficiary
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Resident Information -->
                    <div class="form-section">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5 class="section-title">
                                    <i class="fas fa-user me-2"></i>Resident Information
                                </h5>
                            </div>
                        </div>

                        <div class="row">
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

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_purok_no" class="form-label">Purok No. *</label>
                                <input type="text" class="form-control" id="edit_purok_no" name="purok_no" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_household_no" class="form-label">House No. *</label>
                                <input type="text" class="form-control" id="edit_household_no" name="household_no" required>
                            </div>
                        </div>
                    </div>

                    <!-- 4Ps Information -->
                    <div class="form-section">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="section-title">
                                    <i class="fas fa-id-card me-2"></i>4Ps Information
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_fourps_id" class="form-label">4Ps ID *</label>
                                <input type="text" class="form-control" id="edit_fourps_id" name="fourps_id" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_status" class="form-label">Status *</label>
                                <select class="form-select" id="edit_status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="updateButton">
                        <i class="fas fa-save me-2"></i>Update Beneficiary
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>View 4Ps Beneficiary Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="resident-info mb-4">
                            <div class="resident-avatar" style="width: 60px; height: 60px; font-size: 1.5rem;" id="view_avatar">
                                NA
                            </div>
                            <div class="resident-details">
                                <h3 id="view_fullname" style="font-size: 1.75rem; margin-bottom: 0.25rem;"></h3>
                                <p id="view_address" style="font-size: 1rem;"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-section">
                            <h6 class="section-title" style="font-size: 1rem;">Personal Information</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td style="width: 40%; color: #666;">First Name:</td>
                                    <td style="font-weight: 600;" id="view_fname"></td>
                                </tr>
                                <tr>
                                    <td style="color: #666;">Middle Name:</td>
                                    <td style="font-weight: 600;" id="view_mname"></td>
                                </tr>
                                <tr>
                                    <td style="color: #666;">Last Name:</td>
                                    <td style="font-weight: 600;" id="view_lname"></td>
                                </tr>
                                <tr>
                                    <td style="color: #666;">Purok:</td>
                                    <td style="font-weight: 600;" id="view_purok"></td>
                                </tr>
                                <tr>
                                    <td style="color: #666;">House No:</td>
                                    <td style="font-weight: 600;" id="view_household"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-section">
                            <h6 class="section-title" style="font-size: 1rem;">4Ps Information</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td style="width: 40%; color: #666;">4Ps ID:</td>
                                    <td style="font-weight: 600;" id="view_fourps_id"></td>
                                </tr>
                                <tr>
                                    <td style="color: #666;">Status:</td>
                                    <td id="view_status"></td>
                                </tr>
                                <tr>
                                    <td style="color: #666;">Date Registered:</td>
                                    <td style="font-weight: 600;" id="view_created_at"></td>
                                </tr>
                                <tr>
                                    <td style="color: #666;">Last Updated:</td>
                                    <td style="font-weight: 600;" id="view_updated_at"></td>
                                </tr>
                            </table>
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
<script>
    // Month filter for beneficiariesTable
document.getElementById("monthFilter").addEventListener("change", function() {
    const selectedMonth = this.value; // "all" or "1"-"12"

    // Loop through all table rows
    document.querySelectorAll("#beneficiariesTable tbody tr").forEach(row => {
        const createdAtStr = row.getAttribute("data-created-at"); // get the created_at date
        if (!createdAtStr) return;

        const createdAt = new Date(createdAtStr);
        const month = createdAt.getMonth() + 1; // JS months are 0-based

        // Show row if "all" is selected or month matches
        if (selectedMonth === "all" || month.toString() === selectedMonth) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

</script>
<script>
function exportCSV() {
    const table = document.getElementById("beneficiariesTable");
    const purokSelected = document.getElementById("purokFilter").value;
    const monthSelected = document.getElementById("monthFilter").value; // 1-12 or "all"
    let csv = [];

    // ===== GET HEADERS (EXCLUDE ACTION) =====
    let headers = [];
    table.querySelectorAll("thead th").forEach((th, index) => {
        if (th.innerText.trim().toLowerCase() !== "actions") {
            headers.push('"' + th.innerText.trim() + '"');
        }
    });
    csv.push(headers.join(","));

    // ===== GET ROWS =====
    table.querySelectorAll("tbody tr").forEach(row => {
        const rowPurok = row.querySelector("td:nth-child(4)").innerText.trim(); // Purok column
        const createdAt = row.querySelector("td:nth-child(5)").innerText.trim(); // Date Registered column
        let rowMonth = 0;

        if (createdAt) {
            // Get month number from date (format: "M d, Y" e.g., "Dec 14, 2025")
            const dateObj = new Date(createdAt);
            rowMonth = dateObj.getMonth() + 1; // getMonth() is 0-indexed
        }

        // ===== FILTER BY PUROK AND MONTH =====
        if ((purokSelected !== "all" && rowPurok !== purokSelected) ||
            (monthSelected !== "all" && rowMonth.toString() !== monthSelected)) {
            return;
        }

        let rowData = [];

        row.querySelectorAll("td").forEach((td, index) => {
            // Skip last column (Actions)
            if (index === row.cells.length - 1) return;

            // Remove .resident-avatar content
            let tdClone = td.cloneNode(true);
            tdClone.querySelectorAll('.resident-avatar').forEach(el => el.remove());

            let text = tdClone.innerText
                .replace(/\n/g, " ")
                .replace(/\s+/g, " ")
                .trim();

            rowData.push('"' + text + '"');
        });

        csv.push(rowData.join(","));
    });

    // ===== DOWNLOAD CSV =====
    let csvContent = csv.join("\n");
    let blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    let url = URL.createObjectURL(blob);

    let link = document.createElement("a");
    link.setAttribute("href", url);

    let filename = "Beneficiaries_";
    if (purokSelected === "all" && monthSelected === "all") {
        filename += "All.csv";
    } else if (purokSelected === "all") {
        filename += "Month_" + monthSelected + ".csv";
    } else if (monthSelected === "all") {
        filename += purokSelected.replace(" ", "_") + ".csv";
    } else {
        filename += purokSelected.replace(" ", "_") + "_Month_" + monthSelected + ".csv";
    }

    link.setAttribute("download", filename);
    link.style.visibility = "hidden";

    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>




<script>
    $(document).ready(function() {
        // Initialize autocomplete for resident search
        $("#resident_name").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('4ps.search_residents') }}",
                    type: "GET",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item.Fname + ' ' + item.mname + ' ' + item.lname + ' - ' + item.purok_no,
                                value: item.Fname + ' ' + item.mname + ' ' + item.lname,
                                id: item.id,
                                fname: item.Fname,
                                mname: item.mname,
                                lname: item.lname,
                                purok_no: item.purok_no,
                                household_no: item.household_no
                            };
                        }));
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                // Fill the form fields with selected resident data
                $('#resident_id').val(ui.item.id);
                $('#fname').val(ui.item.fname);
                $('#mname').val(ui.item.mname);
                $('#lname').val(ui.item.lname);
                $('#purok_no').val(ui.item.purok_no);
                $('#household_no').val(ui.item.household_no);
                $('#is_manual_entry').val('0');

                // Make fields readonly
                $('#fname, #mname, #lname, #purok_no, #household_no').prop('readonly', true);

                // Show success message
                showToast('Resident found! Fields have been auto-filled.', 'success');
            },
            open: function() {
                $(this).autocomplete('widget').css('z-index', 99999);
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div><strong>" + item.fname + " " + item.lname + "</strong><br>" +
                    "<small>Purok: " + item.purok_no + " | House No: " + item.household_no + "</small></div>")
                .appendTo(ul);
        };

        // Handle clear search button
        $('#clearSearchBtn').click(function() {
            $('#searchInput').val('');
            $(this).hide();
            filterTable();
        });

        // Show/hide clear search button based on input
        $('#searchInput').on('input', function() {
            if ($(this).val().length > 0) {
                $('#clearSearchBtn').show();
            } else {
                $('#clearSearchBtn').hide();
            }
            filterTable();
        });

        // Filter table function
        function filterTable() {
            var searchTerm = $('#searchInput').val().toLowerCase();
            var statusFilter = $('#statusFilter').val();
            var purokFilter = $('#purokFilter').val();
            var sortFilter = $('#sortFilter').val();

            var visibleRows = 0;
            var rows = $('.beneficiary-row');

            rows.each(function() {
                var row = $(this);
                var fullname = row.data('fullname') || '';
                var firstname = row.data('firstname') || '';
                var lastname = row.data('lastname') || '';
                var fourpsId = row.data('fourps-id') || '';
                var status = row.data('status') || '';
                var purok = row.data('purok') || '';
                var createdAt = row.data('created-at') || '';

                var matchesSearch = searchTerm === '' ||
                    fullname.includes(searchTerm) ||
                    firstname.includes(searchTerm) ||
                    lastname.includes(searchTerm) ||
                    fourpsId.includes(searchTerm);

                var matchesStatus = statusFilter === 'all' || status === statusFilter;
                var matchesPurok = purokFilter === 'all' || purok === purokFilter.toLowerCase();

                if (matchesSearch && matchesStatus && matchesPurok) {
                    row.show();
                    visibleRows++;
                } else {
                    row.hide();
                }
            });

            // Sort rows
            sortTable(sortFilter);

            // Update search results info
            if (searchTerm !== '') {
                $('#searchResultsInfo').show();
                $('#resultsCount').text(visibleRows);
                $('#searchTermText').text(' for "' + searchTerm + '"');
            } else {
                $('#searchResultsInfo').hide();
            }

            // Show/hide no results state
            if (visibleRows === 0) {
                $('#noResultsState').show();
                $('#beneficiariesTable').hide();
            } else {
                $('#noResultsState').hide();
                $('#beneficiariesTable').show();
            }
        }

        // Sort table function
        function sortTable(sortBy) {
            var rows = $('.beneficiary-row:visible').get();

            rows.sort(function(a, b) {
                var aData = $(a).data();
                var bData = $(b).data();

                switch (sortBy) {
                    case 'name_asc':
                        return aData.fullname.localeCompare(bData.fullname);
                    case 'name_desc':
                        return bData.fullname.localeCompare(aData.fullname);
                    case 'date_asc':
                        return aData.registeredDate - bData.registeredDate;
                    case 'date_desc':
                        return bData.registeredDate - aData.registeredDate;
                    case 'status':
                        return aData.status.localeCompare(bData.status);
                    default:
                        return 0;
                }
            });

            $.each(rows, function(index, row) {
                $('#beneficiariesTableBody').append(row);
            });
        }

        // Initialize filters
        $('#statusFilter, #purokFilter, #sortFilter').change(function() {
            filterTable();
        });

        // Clear all filters
        $('#clearFiltersBtn').click(function() {
            $('#searchInput').val('');
            $('#statusFilter').val('all');
            $('#purokFilter').val('all');
            $('#sortFilter').val('name_asc');
            $('#clearSearchBtn').hide();
            filterTable();
        });

        // Refresh button
        $('#refreshBtn').click(function() {
            $(this).addClass('loading');
            $(this).html('<i class="fas fa-spinner fa-spin"></i> Refreshing...');

            setTimeout(function() {
                location.reload();
            }, 1000);
        });

        // Edit modal handler
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var fname = $(this).data('fname');
            var mname = $(this).data('mname');
            var lname = $(this).data('lname');
            var purok_no = $(this).data('purok_no');
            var household_no = $(this).data('household_no');
            var fourps_id = $(this).data('fourps_id');
            var status = $(this).data('status');
            var resident_id = $(this).data('resident_id');

            $('#edit_id').val(id);
            $('#edit_fname').val(fname);
            $('#edit_mname').val(mname);
            $('#edit_lname').val(lname);
            $('#edit_purok_no').val(purok_no);
            $('#edit_household_no').val(household_no);
            $('#edit_fourps_id').val(fourps_id);
            $('#edit_status').val(status);
            $('#edit_resident_id').val(resident_id);

            // Set form action
            $('#editForm').attr('action', "{{ url('4ps/residentlist') }}/" + id);
        });

        // View modal handler
        $('.view-btn').click(function() {
            var id = $(this).data('id');
            var fname = $(this).data('fname');
            var mname = $(this).data('mname');
            var lname = $(this).data('lname');
            var purok_no = $(this).data('purok_no');
            var household_no = $(this).data('household_no');
            var fourps_id = $(this).data('fourps_id');
            var status = $(this).data('status');
            var created_at = $(this).data('created_at');
            var updated_at = $(this).data('updated_at');

            // Set avatar
            var avatarText = (fname.charAt(0) + lname.charAt(0)).toUpperCase();
            $('#view_avatar').text(avatarText);

            // Set other details
            $('#view_fullname').text(fname + ' ' + mname + ' ' + lname);
            $('#view_address').html('<i class="fas fa-home"></i> ' + purok_no + ' • <i class="fas fa-hashtag"></i> ' + household_no);
            $('#view_fname').text(fname);
            $('#view_mname').text(mname);
            $('#view_lname').text(lname);
            $('#view_purok').text(purok_no);
            $('#view_household').text(household_no);
            $('#view_fourps_id').text(fourps_id);

            // Set status badge
            var statusHtml = '';
            if (status == 'active') {
                statusHtml = '<span class="status-badge active"><i class="fas fa-check-circle"></i> Active</span>';
            } else if (status == 'inactive') {
                statusHtml = '<span class="status-badge inactive"><i class="fas fa-times-circle"></i> Inactive</span>';
            } else {
                statusHtml = '<span class="status-badge inactive"><i class="fas fa-clock"></i> Pending</span>';
            }
            $('#view_status').html(statusHtml);

            $('#view_created_at').text(created_at);
            $('#view_updated_at').text(updated_at);
        });

        // Form validation
        $('#addForm, #editForm').submit(function(e) {
            var form = $(this);
            var isValid = true;

            form.find('input[required], select[required]').each(function() {
                if ($(this).val() === '') {
                    $(this).addClass('is-invalid');
                    isValid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                showToast('Please fill all required fields marked with *', 'error');
                return false;
            }

            // Show loading state
            var submitBtn = form.find('button[type="submit"]');
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Saving...');
        });

        // Reset add modal when closed
        $('#addModal').on('hidden.bs.modal', function() {
            $('#addForm')[0].reset();
            $('#resident_id').val('');
            $('#is_manual_entry').val('0');
            $('#fname, #mname, #lname, #purok_no, #household_no').prop('readonly', false);

            var submitBtn = $('#saveButton');
            submitBtn.prop('disabled', false);
            submitBtn.html('<i class="fas fa-save me-2"></i>Save Beneficiary');
        });

        // Toast notification function
        function showToast(message, type = 'success') {
            var toast = $('<div class="toast-notification toast-' + type + '">' + message + '</div>');
            $('body').append(toast);

            toast.css({
                'position': 'fixed',
                'top': '20px',
                'right': '20px',
                'padding': '15px 20px',
                'background': type === 'success' ? '#28a745' : '#dc3545',
                'color': 'white',
                'border-radius': '8px',
                'box-shadow': '0 4px 12px rgba(0,0,0,0.15)',
                'z-index': 99999,
                'font-weight': '500',
                'max-width': '300px'
            });

            setTimeout(function() {
                toast.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 3000);
        }

        // Keyboard shortcuts
        $(document).keydown(function(e) {
            // Ctrl/Cmd + F to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                $('#searchInput').focus();
            }

            // Ctrl/Cmd + N to open add modal
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                $('#addModal').modal('show');
            }

            // Escape to clear search
            if (e.key === 'Escape' && $('#searchInput').is(':focus')) {
                $('#searchInput').val('');
                filterTable();
            }
        });

        // Initialize table filtering
        filterTable();
    });
</script>
@endsection
